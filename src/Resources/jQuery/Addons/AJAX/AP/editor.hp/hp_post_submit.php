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
	$Theme		=	new Theme($Arrays,$db,$Dirs);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($Arrays,$db,$Dirs,$Theme);
	$Tooltips	=	new Tooltips($Colors);
	$Tpl		=	new Template($Messenger,$Select,$Style,$Theme,$Tooltips);
	$Setting	=	new Setting($Arrays,$db);
	$User		=	new User($Browser,$db,$Setting);
	$SQL		=	new SQL($Arrays,$Colors,$Data,$db,$Setting,$Tpl,$User);

#	if($Setting->_array["DEBUG"] === "1" || $Setting->_array["DEBUG"] === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

#		if($Setting->_array["DEBUG"] === "2"){
			exit;
#		}
#	}

	if(isset($_POST) && !empty($_POST)){
		$titleAdd	=	isset($_POST['titleAdd'])	?	$Data->_do('escData',trim(htmlentities($_POST['titleAdd'])))	:	false;
		$mce_0		=	isset($_POST['mce_0'])		?	$Data->_do('escData',trim(html_entity_decode($_POST['mce_0'])))		:	false;

		$sql	=	('
						INSERT INTO '.$db->_table_list("HOMEPAGE").'
							(Title,Detail)
						VALUES
							(?,?)
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($titleAdd,$mce_0);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i> Post submitted successfully.');
		}
		else{
			$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Post submission failed.');
		}
	}
?>