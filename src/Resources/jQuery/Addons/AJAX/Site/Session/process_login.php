<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Browser	=	new Browser();
	$Select		=	new Select();

	$Data		=	new Data($db);
	$Theme		=	new Theme($db);

	$Style		=	new Style($db,$Theme);
	$Template	=	new Template($Data,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Template);
	$User		=	new User($Browser,$Data,$db,$Setting);
	$Session	=	new Session($db,$Browser,$Setting,$User);
	$Messenger	=	new Messenger($Browser,$Setting,$User);

#	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo '_POST<br>';
			echo var_dump($_POST);
			echo '_GET<br>';
			echo var_dump($_GET);
			echo '_REQUEST<br>';
			echo var_dump($_REQUEST);
		echo '</pre>';
		die();
#	}
	if($Setting->DEBUG === "2"){
		die();
	}

	if(isset($_POST) && !empty($_POST)){
		$UserID	=	isset($_POST["UserID"])	?	$Data->escData(trim($_POST["UserID"]))	:	false;
		$Pw		=	isset($_POST["Pw"])		?	$Data->escData(trim($_POST["Pw"]))		:	false;

		if(!isset($_SESSION["MESSAGES"])){
			$_SESSION["MESSAGES"] = $Messenger->Init();
		}
		elseif(isset($_SESSION["MESSAGES"]) && !empty($_SESSION["MESSAGES"])){
			echo '<div class="container no_padding msg_container">';
				echo '<div class="row msg_data" style="border:1px solid lime;">';
					echo '<div class="col-md-12">';
						echo $Messenger->Display($_SESSION["MESSAGES"]);
						#$Messenger->Close();
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}

		if(empty($UserID) || $UserID == ""){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x01';
		}elseif(strlen($UserID) < 3 || strlen($UserID) > 16 ){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x02';
		}elseif(ctype_alnum($UserID) === false){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x03';
		}

		if(empty($Pw)){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x04';
		}elseif(strlen($Pw) < 3 || strlen($Pw) > 16){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x05';
		}elseif(ctype_alnum($Pw) === false){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x06';
		}

		echo '<pre>';
			var_dump($_SESSION["MESSAGES"]['type']);
		echo '</pre>';

		if(count($_SESSION["MESSAGES"]['type']) == 0){
			$sql	=	('
							SELECT *
							FROM '.$db->get_TABLE('WEB_PRESENCE').'
							WHERE UserID=? AND Pw=?
			');
			$stmt	=	odbc_prepare($db->conn,$sql);
			$args	=	array($UserID,$Pw);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					if($userInfo = odbc_fetch_array($stmt)){
						if($userInfo["Status"] == 0 || $userInfo["Status"] == 16 || $userInfo["Status"] == 32 || $userInfo["Status"] == 64){
							session_name("CMS_SESS_VALIDATED");

							$_SESSION["UserUID"]		=	$userInfo["UserUID"];
							$_SESSION["UserID"]			=	$userInfo["UserID"];
							$_SESSION["Status"]			=	$userInfo["Status"];
							$_SESSION["AdminLevel"]		=	$userInfo["AdminLevel"];
							$_SESSION["Email"]			=	$userInfo["Email"];

							$_SESSION["CMS_SID"]		=	$Session->CREATE_SESSION($userInfo["UserID"]);
							$Session->STORE_SESSION('Logged In - UserID/Pw Access for '.$userInfo["UserID"].' from '.$Browser->UserIP);

							$_SESSION["MESSAGES"]["type"][].='3';
							$_SESSION["MESSAGES"]["body"][].='SL-0x08';

	#						header('location: ?'.$Setting->PAGE_PREFIX.'=HOME');
						}
						elseif($userInfo['Status'] < 0){
							# Acct locked by admin
							$_SESSION["MESSAGES"]["type"][].='0';
							$_SESSION["MESSAGES"]["body"][].='SL-0x07';
							$Session->STORE_SESSION("Login attempt failed on banned account for $UserID from $UserIP.");
						}
						else{
							$_SESSION["MESSAGES"]["type"][].='3';
							$_SESSION["MESSAGES"]["body"][].='L-0x08';
						}
					}
					else{
#						echo 'prep failed';
	#					$_SESSION["MESSAGES"]["type"][].='0';
	#					$_SESSION["MESSAGES"]["body"][].='L-0x09';
					}
				}
				else{
					echo 'Account not found!';
				}
			}
			else{
				echo 'Prep failed';
			}
		}
		else{
			echo 'Auth failed';
			#		header('location: ?'.$Setting->PAGE_PREFIX.'=Auth&Valid=false');
		}
	}
?>