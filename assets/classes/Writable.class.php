<?php
	class Writable{

		$Shaiya_Patch_Dir	=	$_SERVER['DOCUMENT_ROOT']."Shaiya/";

		function is_Writable_Shaiya(){
			$newFileName = '/var/www/your/file.txt';
			if(!is_writable(dirname($newFileName))){
				echo dirname($newFileName).' must writable!!!';
			}
			else{
				echo dirname($newFileName).' is writable.';
			}
		}
	}
?>