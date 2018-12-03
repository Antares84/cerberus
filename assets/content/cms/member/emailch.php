<?php
#	SQLSRV Converted E-Mail Update System
	$Email = isset($_POST['Email-New']) ? escData(trim($_POST['Email-New'])) : '';
	$EmVer = 1;
	$UserUID = $_SESSION['ID'];
	if (isset($_POST['Sub_Email'])) {
		$sql = "UPDATE SDM_UserData.dbo.Users_Master
			    SET Email = '".$Email."', EmailVerified = 1
				WHERE UserUID = '".$_SESSION['uuid']."'";
		$res = odbc_exec($dbConn, $sql);
#		if (!$res) {
#			print("SQL statement failed with error:\n");
#			print(odbc_error($dbConn).": ".odbc_errormsg($dbConn)."\n");
#		} else {
#			$number_of_rows = odbc_num_rows($res);
#			print("'".$number_of_rows."' rows updated.\n");
#		}
		odbc_close($dbConn);
	}
	header('location:?p=member_profile&#tabs-3');
?>