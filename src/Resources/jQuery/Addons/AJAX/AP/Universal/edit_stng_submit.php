<?php
	require_once('../../Autoloader.php');

	$Arrays		=	new Arrays();
	$DirLister	=	new DirectoryLister($Arrays);
	$Browser	=	new Browser();
	$Dirs		=	new Dirs($Arrays);
	$db			=	new Database();
	$Select		=	new Select();

	$Colors		=	new Colors($db);
	$Data		=	new Data($DirLister);
	$Theme		=	new Theme($Arrays,$db);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($Arrays,$db,$Dirs,$Theme);
	$Tooltips	=	new Tooltips($Colors);
	$Tpl		=	new Template($Messenger,$Select,$Style,$Theme,$Tooltips);
	$Setting	=	new Setting($Arrays,$db);
	$User		=	new User($Browser,$db,$Setting);
	$SQL		=	new SQL($Arrays,$Colors,$Data,$db,$Setting,$Tpl,$User);

	$err		=	array();
	$error		=	false;

	if($Setting->_array[12] === "1" || $Setting->_array[12] === "2"){
		echo 'POST Dump<br>';
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
		echo '<br>';

#		if($Setting->_array[12] === "2"){
		#	die();
#			exit;
#		}
	}

	if(isset($_POST) && !empty($_POST)){
		$RowID	=	isset($_POST["RowID"])	?	trim($Data->_do('escData',$_POST["RowID"]))	:	false;
		$VALUE	=	isset($_POST["VALUE"])	?	trim($Data->_do('escData',$_POST["VALUE"]))	:	false;
		$DB		=	isset($_POST["DB"])		?	trim($Data->_do('escData',$_POST["DB"]))	:	false;

		$Tpl->_do_alert('1','AJAX-0x03',$error);

		if(empty($RowID) || $RowID == ""){
			$err[].='SUB_1';
			$Tpl->_do_alert('3','AJAX-0x04');
		}elseif(empty($VALUE) || $VALUE == ""){
			$err[].='SUB_2';
			$Tpl->_do_alert('3','AJAX-0x05',$error);
		}elseif(empty($DB) || $DB == ""){
			$err[].='SUB_3';
			$Tpl->_do_alert('3','AJAX-0x06',$error);
		}elseif(count($err)<1){
			$Tpl->_do_alert('5','AJAX-0x07',$error);
		}

		if(count($err) == 0){
			$Tpl->_do_alert('5','AJAX-0x08',$error);

			$sql	=	('
							UPDATE '.$db->_table_list($DB).'
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
	}
?>