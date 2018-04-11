


    public function getQA() {
        $aqa = new ActivityQA($this->_DB);
        return $aqa->vsearch(
                array(
                    'where'=>'actId='.$this->getActId(),
                    'limit'=>-1
                ));/*
        return $aqa->vsearch(
        );*/
    }
    
    
    
