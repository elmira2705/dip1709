<?php
    spl_autoload_register(
    		function($className){
    			$fileName = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    			if (file_exists("./controller/$fileName.php")) {
    				require_once "./controller/$fileName.php";
    			}
          elseif (file_exists("./route/$fileName.php")) {
    				require_once "./route/$fileName.php";
          }
    			elseif (file_exists("./model/$fileName.php")) {
    				require_once "./model/$fileName.php";
    			}
          elseif (file_exists("./view/$fileName.php")) {
    				require_once "./view/$fileName.php";
    			}
    			else
    				die('Подключить '. $className. ' не удалось.');
    		}
    	);
