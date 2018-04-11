<?php

require_once(realpath(dirname(__FILE__)) . "/config.inc.php");

class DB {

    private $querynum = 0;
    private $link;
    private $histories;
    private $dbname;
    private $dbhost;
    private $dbuser;
    private $dbpw;
    private $dbcharset;
    private $pconnect;
    private $tablepre;
    private $time;
    private $goneaway = 5;
    private $strKey;
    private static $connections = array();
    private static $allquerynum = 0;

    function __construct($connect=true) {
        if ($connect) {
            $this->connect(DBHOST, DBUSER, DBPW, DBNAME, DBCHARSET, DBPCONNECT, DBTABLEPRE);
        }
    }

    private function getDbPw() {
        $func = $this->dbpw;
        return $func();
    }

    function connect($dbhost=-1, $dbuser='', $dbpw='', $dbname = '', $dbcharset = '', $pconnect = 0, $tablepre='', $time = 0) {
        /* if($dbhost==-1){
          include(realpath(dirname(__FILE__))."\dbconfig.inc.php");
          } */
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        //$this->dbpw = $dbpw;
        $this->dbname = $dbname;
        $this->dbcharset = $dbcharset;
        $this->pconnect = $pconnect;
        $this->tablepre = $tablepre;
        $this->time = $time;


        $func = uniqid("pw");
        eval("function {$func}(){return {$dbpw};}");
        $this->dbpw = $func;

        $this->strKey = md5(serialize(array($dbhost, $dbuser, $dbpw, $dbname, $dbcharset, $pconnect, $tablepre, $time)));
        if (isset(self::$connections[$this->strKey])) {
            $this->link = self::$connections[$this->strKey];
            //echo "OLD LINK REUSED<br>";
            return;
        }
        //echo "NEW LINK CREATED<br>";
        if ($pconnect) {
            if (!$this->link = mysql_pconnect($dbhost, $dbuser, $dbpw)) {
                $this->halt('Can not connect to MySQL server');
            }
        } else {
            if (!$this->link = mysql_connect($dbhost, $dbuser, $dbpw, 1)) {
                $this->halt('Can not connect to MySQL server');
            }
        }
        if ($this->version() > '4.1') {
            if ($dbcharset) {
                mysql_query("SET character_set_connection = " . $dbcharset . ",
                                    character_set_results = " . $dbcharset . ",
                                     character_set_client = binary", $this->link);
            }

            if ($this->version() > '5.0.1') {
                mysql_query("SET sql_mode =''", $this->link);
            }
        }
        if ($dbname) {
            mysql_select_db($dbname, $this->link);
        }

        self::$connections[$this->strKey] = $this->link;
    }

    function getStrKey() {
        return $this->strKey;
    }

    function getConn() {
        return $this->conn;
    }

    function getHistory() {
        return $this->histories;
    }

    function getQueryCount() {
        return $this->querynum;
    }

    function getAllQueryCount() {
        return self::$allquerynum;
    }

    function fetch_array($query, $result_type = MYSQL_ASSOC) {
        return mysql_fetch_array($query, $result_type);
    }

    function result_first($sql) {
        return $this->result($this->query($sql), 0);
    }

    function fetch_first($sql) {
        return $this->fetch_array($this->query($sql));
    }

    function fetch_all($sql, $id = '') {
        $arr = array();
        $query = $this->query($sql);
        while ($data = $this->fetch_array($query)) {
            $id ? $arr[$data[$id]] = $data : $arr[] = $data;
        }
        return $arr;
    }

    function query($sql, $type = '', $cachetime = FALSE) {
        $func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query') ? 'mysql_unbuffered_query' : 'mysql_query';

        if (DEBUG_MODE) {
            $query_start_time = microtime();
        }

        if (!($query = $func($sql, $this->link)) && $type != 'SILENT') {
            $this->halt('MySQL Query Error', $sql);
        }
        if (DEBUG_MODE) {
            $query_end_time = microtime();
            list($usec, $sec) = explode(" ", $query_start_time);
            list($usec2, $sec2) = explode(" ", $query_end_time);
            $used_time = ((float) $usec2 + (float) $sec2) - ((float) $usec + (float) $sec);
        }

        $this->querynum++;
        self::$allquerynum++;
        $this->histories[] = $sql;
        if (DEBUG_MODE) {
            $this->debug_history[] = array(
                "query_time" => $used_time,
                debug_backtrace(false)
            );
        }
        return $query;
    }

    function affected_rows() {
        return mysql_affected_rows($this->link);
    }

    function error() {
        return (($this->link) ? mysql_error($this->link) : mysql_error());
    }

    function errno() {
        return intval(($this->link) ? mysql_errno($this->link) : mysql_errno());
    }

    function result($query, $row) {
        return mysql_result($query, $row);
    }

    function num_rows($query) {
        return mysql_num_rows($query);
    }

    function num_fields($query) {
        return mysql_num_fields($query);
    }

    function free_result($query) {
        return mysql_free_result($query);
    }

    function insert_id() {
        return mysql_insert_id($this->link);
    }

    function fetch_row($query) {
        return mysql_fetch_row($query);
    }

    function fetch_fields($query) {
        return mysql_fetch_field($query);
    }

    function version() {
        return mysql_get_server_info($this->link);
    }

    function close() {
        unset(self::$connections[$this->strKey]);
        return mysql_close($this->link);
    }

    private function halt($message = '', $sql = '') {

        $error = mysql_error();
        $errorno = mysql_errno();
        if ($errorno == 2006 && $this->goneaway-- > 0) {
            $this->close();
            $this->connect($this->dbhost, $this->dbuser, $this->$this->getDbPw(), $this->dbname, $this->dbcharset, $this->pconnect, $this->tablepre, $this->time);
            $this->query($sql);
        } else {
            if (DEBUG_MODE) {
                $s = '<b>Error:</b>' . $error . '<br />';
                $s .= '<b>Errno:</b>' . $errorno . '<br />';
                $s .= '<b>SQL:</b>:' . $sql;
            } else {
                $s = 'Error Occurred';
            }
            $fp = fopen(realpath(dirname(__FILE__)) . "/_logs/MySQL_Error_log.php", 'a+');
            fwrite($fp, "<? \n\$log[]=");
            fwrite($fp, var_export(array(date("jS F,Y H:i:s"), $_SERVER["REQUEST_URI"],DEBUG_MODE?"DEBUG MODE":"NORMAL MODE", debug_backtrace(false)), true));
            fwrite($fp, "\n?>");
            fclose($fp);
            exit($s);
        }
    }

    function __destruct() {
        if (DEBUG_MODE) {
            date_default_timezone_set("Asia/Hong_Kong");
            //$msg=str_replace("\n","\r\n",var_export($this->histories,true));
            $fp = fopen(realpath(dirname(__FILE__)) . "/_logs/.ht.SQL log from class.DB.php.htm", 'a+');

            /* fwrite($fp,"==========================================\r\n");
              fwrite($fp,date("jS F,Y H:i:s e")."\r\n");
              fwrite($fp,$msg);
              fwrite($fp,"\r\n"); */
            fwrite($fp, "<style>*{font-family:consolas;font-size:9pt;}</style>");
            fwrite($fp, "<table border=1 cellpadding=2 cellspacing=0>");
            fwrite($fp, "<tr><td colspan=4>" . date("jS F,Y H:i:s") . " @ " . $_SERVER["REQUEST_URI"] . "</td></tr>");
            for ($i = 0; $i < count($this->histories); $i++) {
                fwrite($fp, "<tr><td>{$i}</td><td><pre>{$this->histories[$i]}</pre></td>");
                fwrite($fp, "<td>{$this->debug_history[$i]['query_time']}</td><td><pre>");
                fwrite($fp, ($this->debug_backtrace_formatter($this->debug_history[$i][0])));
                fwrite($fp, "</div></td>");
                fwrite($fp, "</tr>");
            }
            fwrite($fp, "</table><br>");
            fclose($fp);
        }
    }

    private function debug_backtrace_formatter($arg) {
        $r = "";
        $file = "";
        foreach ($arg as $key => $ary) {
            if ($ary['file'] != $file) {
                $r.= "\n" . $ary['file'] . "\n";
                $file = $ary['file'];
            }

            $r.= "  Line " . sprintf("%-5s", $ary['line']) . " " . $ary['class'] . $ary['type'] . $ary['function'] . "(\"" . implode("\",\"", $ary['args']) . "\")";
            $r.= "\n";
        }
        return $r;
    }

}

?>