<?php
	require_once('../../Autoloader.php');

	$Browser	=	new Browser();
	$Dirs		=	new Dirs();
	$db			=	new Database();
	$Select		=	new Select();

	$Data		=	new Data($db);
	$Theme		=	new Theme($db);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($db,$Dirs,$Theme);
	$Tpl		=	new Template($Data,$Messenger,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);

#	if($Setting->_stng_array[15] === "1" || $Setting->_stng_array[15] === "2"){
		echo 'POST Dump<br>';
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
		echo '<br>';

		$params=json_decode(json_encode($_POST), true);
		echo 'JSON Params Dump<br>';
		echo '<pre>';
			echo var_dump($params);
		echo '</pre>';

#		if($Setting->_stng_array[15] === "2"){
			die();
#		}
#	}

	if(isset($_POST["RowID"])){
		$RowID	=	isset($_POST["RowID"])	?	trim($_POST["RowID"])	:	false;
		$VALUE	=	isset($_POST["VALUE"])	?	trim($_POST["VALUE"])	:	false;
		$DB		=	isset($_POST["DB"])		?	trim($_POST["DB"])		:	false;

		$sql	=	('
						UPDATE '.$db->get_TABLE($DB).'
						SET VALUE=?
						WHERE RowID=?
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($VALUE,$RowID);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			$Tpl->_do_alert('2','AJAX-0x09',$error);
		}else{
			$Tpl->_do_alert('3','AJAX-0x10',$error);
		}
	}
?>