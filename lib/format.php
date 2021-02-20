<?php  
class format{
    public function formatdate($date){
       return date('d-m-Y', strtotime($date));
    }
     public function formatdatetime($date){
       return date('d-m-Y h:i:s a', strtotime($date));
    }
    public function md5check($md5 ='') {
  return strlen($md5) == 32 && ctype_xdigit($md5);
}
}

?>