<?php
	$errors = array();
	$opw=escData(htmlentities($_POST['oldpw']));
	$npw=escData(htmlentities($_POST['newpw']));
	$UserID=$_SESSION["uid"];
	
#	$res= odbc_exec($conn,"SELECT * FROM PS_UserData.dbo.Users_Master WHERE UserID='".$UserID."' AND Pw='".$opw."'");
#	if(odbc_num_rows($res)==0){$_SESSION["msg"]='Unable to change the password. Please provide the correct old Password';
#	}else{
#		odbc_exec($conn,"UPDATE PS_UserData.dbo.Users_Master SET Pw='".$npw."' WHERE UserID='".$UserID."'");
#		$_SESSION["msg"]="Password changed successfully. Please allow up to 1 minute for the changes to take effect.";
#	}
#	header("location:usercp.php");

	$sql1 = odbc_prepare($dbConn,"SELECT UserID, PwPlain FROM SDM_UserData.dbo.Users_Master WHERE UserID='".$UserID."' AND PwPlain='".$opw."'");
	$res1 = odbc_execute($sql1);
	$results = odbc_num_rows($sql1);
	if(odbc_num_rows($sql1)==0){
# Error Checking
		echo 'Error';die();
	}else{
		$sql = ('UPDATE SDM_UserData.dbo.Users_Master SET Pw=? WHERE UserID=?');
		$stmt = odbc_prepare($dbConn, $sql);
		$args = array($npw,$UserID);
		$res = odbc_execute($stmt,$args);
# Error Checking
#		$sql = odbc_prepare($dbConn,"SELECT * FROM SDM_UserData.dbo.Users_Master WHERE UserID='".$UserID."' AND PwPlain='".$npw."'");
#		$res = odbc_execute($stmt,$args);
#		$data = odbc_num_rows($sql);
#		if(odbc_num_rows($sql)==1){
#			echo 'Completed';
#		}else{
#			echo 'Update Failed';
#		}
	}
	header('location:?p=member_profile');
?>