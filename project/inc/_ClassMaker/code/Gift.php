

    public function getName(){
      return $_SESSION['lang'] =='zh' ? $this->getChiName():$this->getEngName();
    }

    