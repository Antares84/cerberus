<?php
	$rec_key	=	isset($_GET['key'])	?	$this->Data->escData(trim($_GET['key']))	:	"";

	if(isset($_GET['key']) && !empty($_GET['key'])){
		echo "key used";
		
	}
?>