<?php

namespace MF\Model;

use App\Connection;

class Container {

	public static function getModel($model, $bd = '') { 
		$class = "\\App\\Models\\".ucfirst($model);
		if(isset($_SESSION['filial']) && $bd == '') {
			$conn = Connection::getDb($_SESSION['filial']);		
		}		
		else {
			$conn = Connection::getDb($bd);
		}
		return new $class($conn);
	}
}


?>