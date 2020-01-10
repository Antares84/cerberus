<?php
	define('IN_CMS',true);
	require_once('../../../../../../autoloader.php');

	$PHP		=	new classes\utils\PHP();
	$Arrays		=	new classes\base\Arrays;
	$Dirs		=	new classes\base\Dirs($Arrays);
	$DirLister	=	new classes\utils\DirectoryLister($Arrays);
	$Browser	=	new classes\utils\Browser;
	$MSSQL		=	new classes\db\MSSQL;
	$Select		=	new classes\display\Select;
	$Colors		=	new classes\utils\Colors($MSSQL);
	$Data		=	new classes\utils\Data($DirLister);
	$Theme		=	new classes\settings\Theme($Arrays,$MSSQL,$Dirs);
	$Messenger	=	new classes\utils\Messenger($Browser);
	$Style		=	new classes\settings\Style($Arrays,$MSSQL,$Dirs,$Theme);
	$Tooltips	=	new classes\utils\Tooltips($Colors);
	$Tpl		=	new classes\utils\Template($Colors,$Messenger,$Select,$Style,$Theme,$Tooltips);
	$Setting	=	new classes\settings\Settings($Arrays,$MSSQL);
	$User		=	new classes\utils\User($Browser,$MSSQL,$Setting);
	$SQL		=	new classes\db\SQL($Arrays,$Colors,$Data,$MSSQL,$Setting,$Tpl,$User);
	$Session	=	new classes\utils\Session2($Data,$Browser,$MSSQL,$Setting,$SQL,$User);

	$err		=	array();
	$error		=	false;

	if($Setting->_arr["DEBUG"] === "1" || $Setting->_arr["DEBUG"] === "2"){
		echo '<pre>';
			echo '_POST<br>';
			echo var_dump($_POST);
			echo '_GET<br>';
			echo var_dump($_GET);
			echo '_REQUEST<br>';
			echo var_dump($_REQUEST);
		echo '</pre>';

		if($Setting->_arr["DEBUG"] === "2"){
			exit;
		}
	}

	if(isset($_POST) && !empty($_POST)){
		$UserID	=	isset($_POST["UserID"])	?	trim($Data->_do('escData',$_POST["UserID"],__FILE__,__LINE__))	:	false;
		$Pw		=	isset($_POST["Pw"])		?	trim($Data->_do('escData',$_POST["Pw"],__FILE__,__LINE__))		:	false;
		$SID	=	isset($_POST["SID"])	?	trim($Data->_do('escData',$_POST["SID"],__FILE__,__LINE__))		:	false;
		$e		=	isset($_POST["e"])		?	trim($Data->_do('escData',$_POST["e"],__FILE__,__LINE__))		:	false;

		echo 'Session ID: '.$SID;
		$Tpl->_do_alert('5','SL-0x00',$error);

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
			echo $Tpl->_do_alert('5','SL-0x04',$error);
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
			echo $Tpl->_do_alert('5','SL-0x08',$error);
		}

		if(count($err) == 0){
			echo $Tpl->_do_alert('5','SL-0x09',$error);
			$sql	=	('
							SELECT *
							FROM '.$MSSQL->_table_list('WEB_PRESENCE').'
							WHERE UserID=? AND Pw=?
			');
			$stmt	=	odbc_prepare($MSSQL->conn,$sql);
			$args	=	array($UserID,$Pw);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					if($userInfo = odbc_fetch_array($stmt)){
						echo $Tpl->_do_alert('5','SL-0x10',$e);
						if($userInfo["Status"] == 0 || $userInfo["Status"] == 16 || $userInfo["Status"] == 32 || $userInfo["Status"] == 64){
							echo $Tpl->_do_alert('5','SL-0x11',$error);

							$Session->_do_login($userInfo["UserUID"],$userInfo["UserID"],$userInfo["Status"],$userInfo["AdminLevel"],$userInfo["Email"],$SID);
							echo $Tpl->_do_alert('2','SL-0x12',$error);

							echo '<pre>';
								var_dump($_SESSION);
							echo '</pre>';
						}
						elseif($userInfo['Status'] < 0){
							# Game acct locked by admin
							echo $Tpl->_do_alert('3','SL-0x15',$error);
							$Session->_store_session_acct("Login from banned account for $UserID from $UserIP.");
						}
						else{
							echo $Tpl->_do_alert('3','SL-0x14',$e);
							$Session->_store_session_acct("Login attempt from account with invalid status for $UserID from $UserIP.");
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