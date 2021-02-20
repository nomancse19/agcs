<?php
class session{
    public static function intit(){
        session_start();
    }
    public static function set($key,$val){
        $_SESSION[$key]=$val;
    }
    public static function get($key){
        if(isset( $_SESSION[$key])){
            return  $_SESSION[$key];
        }
        else {
            return FALSE;
        }
    }
    public static function destroy(){
        session_destroy();
        header("Location:index.php");
    }
    
    public static function checksession(){
        self::intit();
        if(self::get("login")==FALSE){
            self::destroy();
             header("Location:index.php");
        }
    }
     public static function sessiontime(){
         $expire=900;
        if(self::get("active")){
          $inactive=time()-self::get("active");
          if($inactive>=$expire){
              self::destroy();
              header("Location:index.php?returnmsg=".  urlencode("Your Session Time Has Expired!! Please Login Again")); 
          }
          else{
              self::set("active", time());
          }
             
         }
         
    }


}

?>