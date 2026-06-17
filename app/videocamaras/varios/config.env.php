<?
class development{
	
  var $HOST 		= "10.25.28.93";
  var $DB_USER	= "root";
  var $DB_PASS	= "0000";
  var $DB 			= "DB_PROSERVIPOL_V3";
  
  public function getHost(){
  	return $this->HOST;
  }
  
  public function getUser(){
    return $this->DB_USER;
  }
  
 	public function getPass(){
    return $this->DB_PASS;
  }
  
  public function getDB(){
    return $this->DB;
  }
}

class production{
	
  var $HOST 		= "172.21.111.67";
  var $DB_USER	= "proservipolv3";
  var $DB_PASS	= "carta77";
  var $DB 			= "DB_PROSERVIPOL_V3";
  
  public function getHost(){
    return $this->HOST;
  }
  
  public function getUser(){
    return $this->DB_USER;
  }
  
  public function getPass(){
    return $this->DB_PASS;
  }
  
  public function getDB(){
    return $this->DB;
  }
}

class personal{
	
  //var $HOST 		= "168.88.11.21";
  var $HOST 		= "172.21.104.13";
  var $DB_USER	= "proservipol2016";
  var $DB_PASS	= "proservipol2016";
  var $DB 			= "DB_Personal";
  
  public function getHost(){
    return $this->HOST;
  }
  
  public function getUser(){
    return $this->DB_USER;
  }
  
  public function getPass(){
    return $this->DB_PASS;
  }
  
  public function getDB(){
    return $this->DB;
  }
}

class L3{
	
  var $HOST 		= "168.88.13.37";
  var $DB_USER	= "proservipol_SAM1";
  var $DB_PASS	= "SAM20836";
  var $DB 			= "DB_PROSERVIPOL_V3_DESARRROLLO_1";
  
  public function getHost(){
    return $this->HOST;
  }
  
  public function getUser(){
    return $this->DB_USER;
  }
  
  public function getPass(){
    return $this->DB_PASS;
  }
  
  public function getDB(){
    return $this->DB;
  }
}

class L4{
	
  var $HOST 		= "168.88.13.5";
  var $DB_USER	= "ap_proservipol";
  var $DB_PASS	= "@ap@";
  var $DB 			= "DB_L4";
  
  public function getHost(){
    return $this->HOST;
  }
	
  public function getUser(){
    return $this->DB_USER;
  }
  
  public function getPass(){
    return $this->DB_PASS;
  }
  
  public function getDB(){
    return $this->DB;
  }
}

class selime{
	
  var $HOST 		= "168.88.130.19";
  var $DB_USER	= "proservipol";
  var $DB_PASS	= "servipol";
  var $DB 			= "SELIME";
  
  public function getHost(){
    return $this->HOST;
  }
  
  public function getUser(){
    return $this->DB_USER;
  }
  
  public function getPass(){
    return $this->DB_PASS;
  }
  
  public function getDB(){
    return $this->DB;
  }
}
?>