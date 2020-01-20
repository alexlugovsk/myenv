<?php


require_once './vendor/autoload.php';
require_once './vendor/vlucas/phpdotenv/src/Dotenv.php';


class MyENV
{
    // в качестве параметра используется любой ключ из env файлов. Возвращает значение ключа.
    public static function get($env) {
    	self::loadENV(); /* Каждый раз при запросе переменной ищем и записываем данные, для того что бы всегда получать актуальные */
    	$env = getenv($env); 	
        return $env; 
    }

    private static function loadENV () {
    	$env_only = MyENV::findAllEnv();
		foreach ($env_only as $key) {
			$dotenv = Dotenv\Dotenv::createImmutable('./', $key);
			$dotenv->load();
		}
    }

	private static function findAllEnv() {

		$path = $_SERVER["DOCUMENT_ROOT"];
		$directory = new \RecursiveDirectoryIterator($path);
		$iterator = new \RecursiveIteratorIterator($directory);
		$env_only = array();

		foreach ($iterator as $info) {

			$file_formal = substr($info->getfileName(), strrpos($info->getfileName(), ".") + 1);

			$name_search = array("env");
			foreach($name_search as $key_name) {

				if($file_formal == $key_name) {
			
					array_push($env_only, $info->getfileName());

				}


			}

		}

		return $env_only;

	}

}
