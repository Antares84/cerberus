<?php
#	if(!defined('IN_CMS')){
#		exit('AJAX AUTOLOADER: unauthorized access detected, exiting...');
#	}

	# Autoloader
	function loadClass($className){
		$debug = false;

		$fileName	=	'';
		$namespace	=	'';

		// Sets the include path as the "src" directory
		$includePath=$_SERVER["DOCUMENT_ROOT"].'/src';

		if($debug === true){
			echo $includePath.'<br>';
		}

		if(false!==($lastNsPos=strripos($className,'\\'))){
			$namespace	=	substr($className,0,$lastNsPos);
			$className	=	substr($className,$lastNsPos+1);
			$fileName	=	str_replace('\\',DIRECTORY_SEPARATOR,$namespace).DIRECTORY_SEPARATOR;
		}

		$fileName.=str_replace('_',DIRECTORY_SEPARATOR,$className).'.php';
		$fullFileName=$includePath.DIRECTORY_SEPARATOR.$fileName;

		if($debug === true){
			echo 'Filename: '.$fileName.'<br>';
			echo 'Full Filename: '.$fullFileName.'<br>';
			echo 'Class Name: '.$className.'<br>';
		}

		if(file_exists($fullFileName)){
			require $fullFileName;
		}
		else{
			echo 'AJAX AUTOLOADER: Class "'.$className.'" does not exist.';
		}
	}

	spl_autoload_register('loadClass'); // Registers the autoloader
?>