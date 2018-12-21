<?php
	require_once('../../Autoloader.php');
	session_start();ob_start();

	$db			=	new Database();
	$Browser	=	new Browser();
	$Select		=	new Select();

	$Data		=	new Data($db);
	$Theme		=	new Theme($db);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($db,$Theme);
	$Tpl		=	new Template($Data,$Messenger,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);
	$User		=	new User($Browser,$Data,$db,$Setting);
	$Session	=	new Session($db,$Browser,$Setting,$User);

	$err		=	array();
	$error		=	false;

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo '_POST<br>';
			echo var_dump($_POST);
			echo '_GET<br>';
			echo var_dump($_GET);
			echo '_REQUEST<br>';
			echo var_dump($_REQUEST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(isset($_POST) && !empty($_POST)){
		$UserID	=	isset($_POST["UserID"])	?	$Data->escData(trim($_POST["UserID"]))	:	false;
		$Pw		=	isset($_POST["Pw"])		?	$Data->escData(trim($_POST["Pw"]))		:	false;
		$e		=	isset($_POST["e"])		?	$Data->escData(trim($_POST["e"]))		:	false;

		$Tpl->_do_alert('1','SL-0x00',$error);

		if(empty($UserID) || $UserID == ""){
			$err[].='UN_1';
			$Tpl->_do_alert('3','SL-0x01',$error);
		}elseif(strlen($UserID) < 3 || strlen($UserID) > 16 ){
			$err[].='UN_2';
			$Tpl->_do_alert('3','SL-0x02',$error);
		}elseif(ctype_alnum($UserID) === false){
			$err[].='UN_3';
			$Tpl->_do_alert('3','SL-0x03',$error);
		}elseif(count($err)<1){
			echo $Tpl->_do_alert('1','SL-0x04',$error);
		}

		if(empty($Pw)){
			$err[].='PW_1';
			echo $Tpl->_do_alert('3','SL-0x05',$error);
		}elseif(strlen($Pw) < 3 || strlen($Pw) > 16){
			$err[].='PW_2';
			echo $Tpl->_do_alert('3','SL-0x06',$error);
		}elseif(ctype_alnum($Pw) === false){
			$err[].='PW_3';
			echo $Tpl->_do_alert('3','SL-0x07',$error);
		}else{
			echo $Tpl->_do_alert('1','SL-0x08',$error);
		}

		if(count($err) == 0){
			echo $Tpl->_do_alert('1','SL-0x09',$error);
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
						echo $Tpl->_do_alert('1','SL-0x10',$e);
						if($userInfo["Status"] == 0 || $userInfo["Status"] == 16 || $userInfo["Status"] == 32 || $userInfo["Status"] == 64){
							echo $Tpl->_do_alert('1','SL-0x11',$error);

							$Session->_do_login($userInfo["UserUID"],$userInfo["UserID"],$userInfo["Status"],$userInfo["AdminLevel"],$userInfo["Email"]);
							echo $Tpl->_do_alert('1','SL-0x12',$error);
						}
						elseif($userInfo['Status'] < 0){
							# Game acct locked by admin
							echo $Tpl->_do_alert('3','SL-0x15',$error);
							$Session->STORE_SESSION("Login from banned account for $UserID from $UserIP.");
						}
						else{
							echo $Tpl->_do_alert('3','SL-0x14',$e);
							$Session->STORE_SESSION("Login attempt from account with invalid status for $UserID from $UserIP.");
						}
					}
				}
				else{
					echo $Tpl->_do_alert('3','SL-0x13',$e);
				}
			}
		}
		else{
			echo '<pre>';
				var_dump($err);
			echo '</pre>';
		}
	}
?>