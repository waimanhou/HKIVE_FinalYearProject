<?php

/*
  abstract class DataBoundObject

  Example:

  class User extends DataBoundObject{
  protected $userNo;
  protected $Name;

  function DefineTableName(){return "Account";}

  function DefineRelationMap(){return array("userID"=>"userNo","name"=>"Name");}
  //[DB field name]=>[Variable Name];

  function DefinePrimaryKey(){return "id";}   //if composite PK, pass an array
  }

  $db=new DB();
  $u=new User($db,123);
  $u->getName(); //return name;
  $u->setName("Peter");//set the name;
  $u->save(); //commit

 */

//define("DEBUG_MODE",true);

class RecordNotFoundException extends Exception {

}

class FieldNoFoundException extends Exception {

}

abstract class DataBoundObject {

    protected $_ID;
    protected $_DB;
    protected $_tableName;
    protected $_relationMap; //array, key = field name; value = variable name
    protected $_loaded;
    protected $_modifiedRelations;
    protected $_PKFields;
    protected $_markForRealDeleted = false;
    protected $_lastCount;
    protected $UPDATED;
    protected $UPDATEDBY;
    protected $CREATED;
    protected $CREATEDBY;
    protected $DELETED;
    protected $DELETEDBY;

    abstract protected function DefineTableName();

    abstract protected function DefineRelationMap();

    abstract protected function DefinePrimaryKey();

    public function __construct(DB $DB, $id = NULL) {
        $this->_tableName = strtolower($this->DefineTableName());
        $this->_relationMap = $this->DefineRelationMap();
        $this->_DB = $DB;
        $this->_loaded = false;
        $this->_modifiedRelations = array();
        $this->_PKFields = $this->DefinePrimaryKey();

        if (!isset($this->_relationMap['UPDATED'])) {
            $this->_relationMap['UPDATED'] = "UPDATED";
        }
        if (!isset($this->_relationMap['UPDATEDBY'])) {
            $this->_relationMap['UPDATEDBY'] = "UPDATEDBY";
        }
        if (!isset($this->_relationMap['CREATED'])) {
            $this->_relationMap['CREATED'] = "CREATED";
        }
        if (!isset($this->_relationMap['CREATEDBY'])) {
            $this->_relationMap['CREATEDBY'] = "CREATEDBY";
        }
        if (!isset($this->_relationMap['DELETED'])) {
            $this->_relationMap['DELETED'] = "DELETED";
        }
        if (!isset($this->_relationMap['DELETEDBY'])) {
            $this->_relationMap['DELETEDBY'] = "DELETEDBY";
        }

        if (!is_array($this->_PKFields)) {
            $this->_PKFields = array($this->_PKFields);
        }
        if (isset($id)) {
            $this->_ID = $id;

            if (count($this->_PKFields) == 1 && !is_array($this->_ID)) {
                $this->_ID = array($this->_PKFields[0] => $this->_ID);
            } else {

                if (!is_array($this->_ID)) {
                    die(DEBUG_MODE ? "Error! Wrong number of PKs" : "Error occured");
                }

                foreach ($this->_ID as $key => $value) {
                    if (!in_array($key, $this->_PKFields)) {
                        die(DEBUG_MODE ? "Error occured, the key `$key` is not found in the PK Fields list of {$this->_tableName}" : "Error occured");
                    }
                }
            }
        }
    }

    private function pkwhere() {
        $query = "";
        foreach ($this->_ID as $key => $value) {
            $query .= " `$key` = \"" . addslashes($value) . "\" and";
        }
        $query = substr($query, 0, strlen($query) - 3);
        return $query;
    }

    public function Load() {
        if (isset($this->_ID)) {
            $query = "SELECT `";
            foreach ($this->_relationMap as $key => $value) {
                $query .= "$key`,`";
            }
            $query = substr($query, 0, strlen($query) - 2);
            $query .= " FROM " . $this->_tableName . " WHERE " . $this->pkwhere();
            $row = $this->_DB->fetch_first($query);
            if (!$row) {
                //die(DEBUG_MODE===true?'Error occured, record not found.':'Error occured');
                if(DEBUG_MODE){
                    debug2file("{$this->_tableName}:".  implode(",", $this->_ID));
                }
                throw new RecordNotFoundException();
            }
            //if(isset($row['deleted']) && $row['deleted']){
            //    die(DEBUG_MODE===true?'Error occured, record deleted.':'Error occured');
            //}
            foreach ($row as $key => $value) {
                $member = $this->_relationMap[$key];
                if (property_exists($this, $member)) {
                    $this->$member = $value;
                };
            };
            $this->_loaded = true;
        };
    }

    public function Save() {
        if (isset($this->_ID)) {
            if ($this->_markForRealDeleted === true) {
                return;
            }

            $this->setUPDATED(date("Y-m-d H:i:s"));
            $this->setUPDATEDBY(isset($_SESSION['userId']) ? $_SESSION['userId'] : 0);

            $query = 'UPDATE `' . $this->_tableName . '` SET ';

            foreach ($this->_relationMap as $key => $value) {
                if (in_array($value, $this->_modifiedRelations)) {
                    //$query .= '"' . $key . "\" = $value, ";
                    if (is_null($this->$value)) {
                        $query .= "`$key`=null,";
                    } else {
                        $value = addslashes($this->$value);
                        $query .= "`$key`=\"$value\",";
                    }
                };
            }

            $query = substr($query, 0, strlen($query) - 1);
            $query .= ' WHERE ' . $this->pkwhere();
            $this->_DB->query($query);
            if ($this->_DB->affected_rows() > 0) {
                return true;
            }
            return false;
        } else {

            $query = "INSERT INTO `" . $this->_tableName . "` (";

            $this->setCREATED(date("Y-m-d H:i:s"));
            $this->setCREATEDBY(isset($_SESSION['userId']) ? $_SESSION['userId'] : 0);

            $cList = "";
            $vList = "";
            foreach ($this->_relationMap as $key => $value) {
                if (isset($this->$value)) {
                    $cList.="`$key`,";
                    $vList.='"' . addslashes($this->$value) . '",';
                }
            }
            $cList = substr($cList, 0, strlen($cList) - 1);
            $vList = substr($vList, 0, strlen($vList) - 1);
            $query.="$cList)VALUES($vList);";
            $this->_DB->query($query);
            if (count($this->_PKFields) == 1) {
                $id = $this->_DB->insert_id();
                if ($id != 0) {
                    $this->_ID = array();
                    $this->_ID[$this->_PKFields[0]] = $id;
                    $pkf = $this->_PKFields[0];
                    $this->$pkf = $id;
                }
                //        print_r( $this->_PKFields);
            }
        }
    }

    public function delete() {
        if (property_exists($this, "DELETED")) {
            $this->setDELETED(date("Y-m-d H:i:s"));
            $this->setDELETEDBY(isset($_SESSION['userid']) ? $_SESSION['userid'] : 0);
        } else {
            throw new FieldNoFoundException();
            //   $this->_markForRealDeleted=true;
        }
    }

    public function __destruct() {
        /* if($this->_markForRealDeleted===true) {
          $query="DELETE FROM `".$this->_tableName."` WHERE ".$this->pkwhere();
          $this->_DB->query($query);
          } */
    }

    public function __call($func, $args) {
		//debug2file($func);
        $type = substr($func, 0, 3);
        $member = substr($func, 3);
        if (!property_exists($this, $member)) {
            $member{0} = strtolower($member{0});
        }
        if (!property_exists($this, $member)) {
            throw new Exception("$member not found");
        }
        switch ($type) {
            case "set":
                return($this->SetAccessor($member, $args[0]));
                break;
            case "get":
                return($this->GetAccessor($member));
        }
        return(false);
    }

    private function SetAccessor($member, $value) {
        if (property_exists($this, $member)) {
            $this->$member = $value;
            $this->_modifiedRelations[] = $member;
            return true;
        } else {
            return(false);
        }
    }

    private function GetAccessor($member) {
        if ($this->_loaded != true) {
            $this->Load();
        }
        if (property_exists($this, $member)) {
            return $this->$member;
        } else {
            return(false);
        }
    }

    protected function make($id, $value_array) {
        //debug2file(print_r($value_array,true));
        $obj = get_class($this);
        $obj = new $obj($this->_DB, $id);
        $obj->_loaded = true;
        foreach ($value_array as $key => $value) {  //$value_array:  fieldname=>value
            //debug2file($value);
            $member = $obj->_relationMap[$key];
            $obj->$member = $value;
        };

        return $obj;
    }

    public function isColExists($s) {
        return array_key_exists($s, $this->_relationMap);
    }

    public function isVarExists($s) {
        return in_array($s, $this->_relationMap);
    }

    public function searchMatch($keywords, $include_deleted=false) {
        $sql = "SELECT * from {$this->_tableName} where 1 ";
        foreach ($keywords as $key => $value) {
            if ($value != null) {
                $sql.="and `$key` = '" . addslashes($value) . "' ";
            } else {
                $sql.="and `$key` is null ";
            }
        }
        if (!$include_deleted) {
            $sql.="and deleted is null ";
        }
        $sql.="limit 1";
        $result = $this->_DB->query($sql);

        if ($row = $this->_DB->fetch_array($result)) {
            $pk = array();
            foreach ($this->_PKFields as $key => $value) {
                $pk[$value] = $row[$value];
            }
            return $this->make($pk, $row);
        } else {
            return false;
        }
    }

    /*
     *
     * searchf(
     *  array(
     *    'field_list'=>array(
     *       'case1'=>123,                         //    'case1'=>'=123'
     *       'case2'=>array('>',123),              //    'case2'=>'>123'
     *       'case3'=>array('like','%asdf%')       //    'case3'=>" like '%asd%'"
     *       'case4'=>array('like',array("%abc%",'%def%','%ghi%')), // where ... and (case4 like ... or case4 like ... or case4 like ....)
     *       'case5'=>array('=',null),   // where case5 is null,
     *       'case6'=>array('!=',null)   // where case6 is not null
     *       'case7'=>array('<>',null)   // where case7 is not null
     *     ),
     *    'order'=>array(
     *       'name'=>'asc',         //default ASC
     *       'id'=>'desc'
     *     ),
     *    'glue'=>'and',
     *    'page'=>array(10,2), //(page#,recPerPage   first page is page 1) or 'range'=array(60,30) show id=60 to 90
     *    'show_deleted'=>false // default false
     *  )
     * )
     *
     */

    public function searchf($args) {
        // debug2file(var_export($args, 1));
        ///$sql = "select * from {$this->_tableName} where 1 ";
        $SqlSelect = "select * from `{$this->_tableName}` ";
        $SqlWhere = "where 1 ";
        if (!$args['show_deleted']) {
            $SqlWhere.= "and `DELETED` is null ";
        }
        if (!$args['field_list']) {
            $args['field_list'] = array();
        }
        $SqlWhere.="and ( ";
        if(!$args['glue']){
            $args['glue']='and';
        }
        $glue=$args['glue'];

        if(strtoupper($glue)=="OR"){
            $SqlWhere.="0 ";
        }else{
            $SqlWhere.="1 ";
        }

        foreach ($args['field_list'] as $k => $v) {
            if (!is_array($v)) {
                $v = array('=', $v);        //convert Case 1 into Case 2
            }
            if (is_array($v[1])) {          //Case 4 BEGIN
                $SqlWhere.="$glue ( 0 ";
                foreach ($v[1] as $kk => $vv) {
                    $SqlWhere.="or `$k` {$v[0]} \"" . addslashes($vv) . "\" ";
                }
                $SqlWhere.=")";                  //Case 4 END
            } else {
                if (!is_null($v[1])) {
                    $SqlWhere.="$glue `$k` {$v[0]} \"" . addslashes($v[1]) . "\" ";    //Case 2,3
                } else {
                    if ($v[0] == '=') {
                        $SqlWhere.="$glue `$k` is null ";      //Case 5
                    } else {
                        $SqlWhere.="$glue `$k` is not null ";   //Case 6,7
                    }
                }
            }
        }

        $SqlWhere.=") ";

        $SqlOrderBy = "ORDER BY ";
        if ($args['order']) {
            foreach ($args['order'] as $k => $v) {
                $v = strtolower($v) == "desc" ? "desc" : "asc";
                $SqlOrderBy.="`$k` $v, ";
            }
        }
        foreach ($this->_PKFields as $k => $v) {
            $SqlOrderBy.="`$v`, ";
        }
        $SqlOrderBy = substr($SqlOrderBy, 0, -2); // delete the 2 char (comma + space)
        $SqlOrderBy.=" ";

        $start = 0;
        $count = "18446744073709551615"; // should be quoted, other it will become exp format
        $range = $args['range'];
        if ($args['page']) {
            $range = $args['page'];
            $range[0]--;
            $range[0]*=$range[1];
            $range[1];   //debug2file(var_export($range,true));//var_dump($range);die();
        }
        $start = $range[0] ? $range[0] : $start;
        $count = $range[1] ? $range[1] : $count;
        $SqlLimit.="limit $start,$count;";
        //echo $SqlSelect.$SqlWhere.$SqlOrderBy.$SqlLimit;

        $result = $this->_DB->query($SqlSelect . $SqlWhere . $SqlOrderBy . $SqlLimit);

        ///////////to be improved_BEGIN
        $lastSearchCount = $this->_DB->fetch_first("select count(*) as c from `{$this->_tableName}` {$SqlWhere}");
        $lastSearchCount = $lastSearchCount['c'];
        $this->_lastCount = $lastSearchCount;
        ///////////to be improved_END


        $list = array();
        while ($row = $this->_DB->fetch_array($result)) {
            $pk = array();
            foreach ($this->_PKFields as $key => $value) {
                $pk[$value] = $row[$value];
            }
            $list[] = $this->make($pk, $row);
        }
        return $list;
    }

    public function vsearch($args) {
        //var_dump($args);
        if ($args == null) {
            $args = array();
        }

        $keyword = array_key_exists('keyword', $args) ? $args['keyword'] : '';
        $fieldname_array = array_key_exists('fieldname_array', $args) ? $args['fieldname_array'] : false;
        $operator = array_key_exists('operator', $args) ? $args['operator'] : '';
        $join_operator = array_key_exists('join_operator', $args) ? $args['join_operator'] : 'OR';
        $where = array_key_exists('where', $args) ? $args['where'] : false;
        //var_dump($where);
        $limit = array_key_exists('limit', $args) ? $args['limit'] : '10';
        $orderby = array_key_exists('orderby', $args) ? $args['orderby'] : -1;
        $each = array_key_exists('each', $args) ? $args['each'] : -1;
        $page = array_key_exists('page', $args) ? $args['page'] : -1;
        $order = array_key_exists('order', $args) ? $args['order'] : 'ASC';
        return $this->search($keyword, $fieldname_array, $operator, $join_operator, $where, $limit, $orderby, $each, $page, $order);
    }

    public function search($keyword, $fieldname_array=false, $operator = "", $join_operator = "OR", $where = false, $limit="10", $orderby=-1, $each=-1, $page=-1, $order='ASC') {

        if ($where === false) {
            $where = " deleted is null ";
        } else if ($where == "") {
            $where = '1';
        }

        if ($keyword != "") {

            while (list($key, $fieldname) = each($fieldname_array)) {
                if ($operator == "" || $operator == "LIKE")
                    $fieldname_array[$key] = $fieldname . " LIKE '%" . $keyword . "%'";
                else
                    $fieldname_array[$key] = $fieldname . " " . $operator . " '" . $keyword . "'";
            }

            $search_criteria = implode(" " . $join_operator . " ", $fieldname_array);
        }else {
            $search_criteria = '1';
        }
        //echo __LINE__."\n";
        //$mli_list = array();
        $sql = "SELECT * FROM " . $this->_tableName . " WHERE " . $where . " AND ( " . $search_criteria . " )";
        if ($orderby != -1) {//echo __LINE__."\n";
            if (strtoupper($order) != "ASC") {//echo __LINE__."\n";
                $order = "DESC";
            }
            if (array_key_exists($orderby, $this->_relationMap)) {//echo __LINE__."\n";
                $sql.=" ORDER BY $orderby $order";
            } else if (is_numeric($orderby)) {//echo __LINE__."\n";
                $orderby = intval($orderby);
                if ($orderby > 0 && $orderby <= count($this->_relationMap)) {//echo __LINE__."\n";
                    $sql.=" ORDER BY $orderby $order";
                }
            }
        }

        if ($each != -1 && $page != -1) {
            $sql.= " LIMIT " . ( ($page - 1) * $each) . "," . $each;
        } else if ($limit != -1) {
            $sql.= " LIMIT $limit;";
        }
        //$result = db_query($sql);
        $result = $this->_DB->query($sql);

        ///////////to be improved_BEGIN
        $lastSearchCount = $this->_DB->fetch_first("SELECT count(*) as c FROM " . $this->_tableName . " WHERE " . $where . " AND ( " . $search_criteria . " )");
        $lastSearchCount = $lastSearchCount['c'];
        $this->_lastCount = $lastSearchCount;
        ///////////to be improved_END

        /*
          while ($row = db_fetch_array($result)) {
          array_push($mli_list,$row["MLI"]);
          }

          return $mli_list;
         */
        $list = array();
        while ($row = $this->_DB->fetch_array($result)) {
            $pk = array();
            foreach ($this->_PKFields as $key => $value) {
                $pk[$value] = $row[$value];
            }
            $list[] = $this->make($pk, $row);
        }
        return $list;
    }

    public function getLastCount() {
        return $this->_lastCount;
    }

    public function __toString() {
        //return $this->_tablename . "_" . $this->_ID;
        /* $v = "[{$this->_tableName}: ";
          $v.= implode(",", $this->_ID);
          $v.="] ";
          foreach ($this->_relationMap as $key => $value) {
          $func="get".$value;
          $func{3}=strtoupper($func{3});
          $v.="\n\t$value = {$this->$func()}, \t"; //"$value." = ".$this->$value ."\t";"
          }
          $v.="\n";
          return $v; */
        return $this->_ID;
    }

}

?>