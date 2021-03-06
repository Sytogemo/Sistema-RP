<?php if (!defined('BASE_PATH')) exit('Not allowed.');
	
	class Application
	{
		var $uri;
		var $model;
		
		function __construct($uri)
		{
			$this->uri = $uri;
		}
		
		function loadController($class)
		{
			$file = "application/controller/".$this->uri['controlador'].".php";
				
			if(!file_exists($file)) die();
		    
			require_once($file);

			$controller = new $class();

			if(method_exists($controller, $this->uri['metodo']))
			{
			 	$controller->{$this->uri['metodo']}($this->uri['variable']);
			}else{
				$controller->index($this->uri['variable']);	
			}
		}
		
		function loadView($view,$vars="")
		{
			if(is_array($vars) && count($vars) > 0)
				extract($vars, EXTR_PREFIX_SAME, "wddx");
			require_once('view/'.$view.'.php');
		}
		
		function loadModel($model)
		{
			require_once('model/'.$model.'.php');
			$this->$model = new $model;
		}
	}

?>