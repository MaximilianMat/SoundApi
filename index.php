<?php
	require_once("autoload.php");

	session_start();

	// alle Requests zusammenfügen und an die Controller-Klasse übergeben
	$request = array_merge($_GET, $_POST);

	if((!isset($_SESSION['authenticated']) || !($_SESSION['authenticated'] == true))
		&& !(isset($request['controller']) && $request['controller'] == 'api')
		&& !(isset($request['controller']) && $request['controller'] == 'register')){
		$controller = new loginController($request);
		echo $controller->display();
		die();
	}

	// Parameter controller (z.B. contact)
	if(isset($request['controller']))
	{
		$controllerName = $request['controller']."Controller";

		/**
		 * Sofern sich der $controllerName.php im Array($arrayFilesToLoad) befindet,
		 * wird versucht eine Controller-Instanz zu erstellen.
		 */
		if(in_array($controllerName.".php", $arrayFilesToLoad['file']))
		{
			$controller = new $controllerName($request);
		}else
		{
			exit("Fehler: kann $controllerName nicht laden...");
		}


	}else
	{
		$controller = new indexController($request);
	}

	// Ausgabe
	echo $controller->display();



?>
