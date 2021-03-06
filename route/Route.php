<?php

    class Route
    {
        private $dirController = 'controller/';
        private $action = '';
        private $controller = NULL;
        private $defaultControllerName = 'UserController';

	public function __construct($dirController)
	{
            $this->dirController = $dirController;
	}

        public function start()
        {
            $route = NULL;
            $delimiter = '?/';
            $params = [];
            $controllerName = $this->defaultControllerName;
            if (($pos = strpos($_SERVER['REQUEST_URI'], $delimiter)) !== false) {
                $route = substr($_SERVER['REQUEST_URI'], $pos + strlen($delimiter));
            }
            if (is_null($route)) {
                $route = $_SERVER['REQUEST_URI'];
            }
            $route = explode('/', $route);
            if (!empty($route[0])) {
                $controllerName = ucfirst($route[0]) . 'Controller';
            }
            $controllerFile = $this->dirController . $controllerName . '.php';
            $action = $route[1];
            $params = $this->getParams();
            if (!empty($route[2])) {
                $params['paramName'] = $route[2];
            }
            if (!empty($route[3])) {
                $params['paramValue'] = $route[3];
            }
            if (is_file($controllerFile)) {
                require_once $controllerFile;
                if (class_exists($controllerName)) {
                    $this->controller = new $controllerName();
                    if (method_exists($this->controller, $action)) {
                        $this->controller->$action($params);
                    } else {
                        $this->controller->defaultAction();
                    }
                } else {
                    $this->controller = null;
                }
            }
        }

        private function getParams()
        {
            $params = [];
            switch($_SERVER['REQUEST_METHOD']) {
                case "GET" :
                    $params = filter_input_array(INPUT_GET, $_GET);
                    break;
                case "POST" :
                    $params = filter_input_array(INPUT_POST, $_POST);
                    break;
                default :
                    $params = filter_input_array(INPUT_GET, $_GET);
                    break;
            }
            return $params;
        }

    }
