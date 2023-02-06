<?php
require_once(dirname(__FILE__). "./../models/User.php");

class LoginValidation {
    public function checkPass( $data ) {

        $user = new User();
        $result = $user->password( $data );

        if( $result !== false ) {
           return true; 
        } else {
            return false;
        }
    }
}
?>