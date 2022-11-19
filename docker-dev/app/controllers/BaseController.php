
<?php
require_once(dirname(__FILE__). "./../models/Todo.php");
require_once(dirname(__FILE__). "./../validations/TodoValidation.php");


class BaseController
{
	public function getCurrentPage() {

		if ( isset( $_GET[ 'page' ] )
		&&	is_numeric( $_GET[ 'page' ] )) {
			$page = $_GET[ 'page' ];
		}else {
			$page = 1;
		}

		return $page;

	}

	
	


}
