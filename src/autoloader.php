<?php
	if(!defined('IN_CMS')){
		exit('CORE AUTOLOADER: unauthorized access detected, exiting...');
	}

	# Autoloader
	function loadClass($className){
		$debug		=	'0';
		$fileName	=	'';
		$namespace	=	'';

		// Sets the include path as the "src" directory
		$includePath=dirname(__FILE__).DIRECTORY_SEPARATOR;
		if($debug=='1'){
			echo $includePath.'<br>';
		}

		if(false!==($lastNsPos=strripos($className,'\\'))){
			$namespace	=	substr($className,0,$lastNsPos);
			$className	=	substr($className,$lastNsPos+1);
			$fileName	=	str_replace('\\',DIRECTORY_SEPARATOR,$namespace).DIRECTORY_SEPARATOR;
		}

		$fileName.=str_replace('_',DIRECTORY_SEPARATOR,$className).'.php';
		$fullFileName=$includePath.DIRECTORY_SEPARATOR.$fileName;

		if($debug=='1' || $debug=='2'){
			echo 'Filename: '.$fileName.'<br>';
			echo 'Full Filename: '.$fullFileName.'<br>';
			echo 'Class Name: '.$className.'<br>';
		}

		if(file_exists($fullFileName)){
			require $fullFileName;

			if($debug=='1'){
				echo $fullFileName.'<br>';
			}
			if($debug=='2'){
				$crc	=	sha1(file_get_contents($fullFileName));
				echo $fullFileName.' => '.$crc.'<br><br>';
			}
		}
		else{
			echo 'CORE AUTOLOADER:<br>Class "'.$className.'" does not exist or could not be found.';
		}
	}

	spl_autoload_register('loadClass'); // Registers the autoloader
?>