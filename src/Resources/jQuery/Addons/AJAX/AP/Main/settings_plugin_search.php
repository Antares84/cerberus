<?php
	require_once('Autoloader.class.php');
	$db			=	new Database();
	$ScanDir	=	new ScanDirs();

	$dir	=	"../../../assets/plugins";
	$file_ext = array("php");
	$files	=	$ScanDir->scan($dir,$file_ext);
#	$file_strip	=	substr($files,0,10);
#	echo $file_strip;
	foreach($files as $plugin){
		echo '<pre>';
			require_once($plugin.'?key=install');
#			echo $plugin.'?mode=install';
		echo '</pre>';
	}

#	echo '<pre>';
#		echo $files;
#		echo var_dump($files);
#	echo '</pre>';
#	die();
?>