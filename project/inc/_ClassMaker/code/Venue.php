

    public function getTypeStr() {
        if ($_SESSION['lang'] == 'zh') {
            return $this->getType()->getChiName();
        } else {
            return $this->getType()->getEngName();
        }
    }
    
    