<?php
	# Class Autoloader
	function __autoload($ClassName){
		$ClassName = str_replace("..","",$ClassName);
		require_once("../../assets/classes/$ClassName.class.php");
#		echo "<b>Loaded: $ClassName.class.php</b><br>";
	}
?>