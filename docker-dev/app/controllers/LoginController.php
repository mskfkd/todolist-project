<?php
require_once (dirname(__FILE__). "./../models/Todo.php");
require_once (dirname(__FILE__). "./../validations/LoginValidation.php");

class LoginController{
    public function password( $data ) {

        $password = $_POST[ "password" ];

        $validations = new LoginValidation();
        $result = $validations->checkPass( $password ); 

        if( $result === true ) {
            return true;
        } else {
            return $result;
        }

    }
}
?>