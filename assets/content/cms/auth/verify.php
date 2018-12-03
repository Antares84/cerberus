<?php
	if(isset($_REQUEST["Key"]) && !empty($_REQUEST["Key"])){
		$Key = $this->Data-escData(trim($_REQUEST["Key"]));

		$Verify	=	("SELECT RowID FROM ".$this->db-get_TABLE("SH_USERDATA")." WHERE RecoveryKey=? AND EmailVerified=?");
		$stmt	=	odbc_prepare($this->db->conn,$Verify);
		$args	=	array($Key,0);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			while($data = odbc_fetch_array($stmt)){
				echo "Account for ".$data["UserID"]." located, updating permissions...<br />";
				$Update	=	("UPDATE ".$this->db-get_TABLE("SH_USERDATA")."
							  SET Status=?,EmailVerified=?
							  WHERE RowID=?");
				$stmt	=	odbc_prepare($cxn,$updateUser);
				$args	=	array(0,0,$data["RowID"]);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					echo "Congratulations! Your account has been successfully activated!";
				}else{
					echo "Cannot verify account right now, please try again later.";
				}
			}
			odbc_close($cxn);
		}else{
			echo 'An error has occured. Please notify an Admin.';
		}
	}else{
		echo 'Key can\'t be empty!';
	}
?>