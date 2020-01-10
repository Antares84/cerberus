<?php

### Not updated due to new methods - considered deprecated unless requested

	$UserID=isset($_POST['UserID']) ? escData($_POST['UserID']) : "";
	$Bypass=isset($_POST['Bypass']) ? escData($_POST['Bypass']) : 0;
	$Out=-1;

	if(isset($_POST['submit'])){
		if(strlen($UserID)<1){die("Invalid User!");}
		if($Bypass>1){die("Invalid Input!");}

		$sql = ("SELECT UserUID FROM ".$cfg["Users"]." WHERE UserID = ?");
		$stnt = odbc_prepare($cxn2,$sql);
		$args = array($UserID);
		$res = odbc_execute($stmt,$args);
		
		if(!odbc_num_rows($stmt)){
			die("Invalid User!");}
		$row = odbc_fetch_array($res);

		$res2=odbc_exec($cxn2, "EXEC PS_UserData.dbo.usp_ChangeUserCountry '".$row['UserUID']."','".$Bypass."'");
		if($res2===false){
			die("Something's happened! Notify a Dev or an Admin.");
			createLog($_SESSION['UserID'], "Faction change failed on User: ".$UserID". Reason: Query_Error().");
		}
		$row2=odbc_fetch_array($res2);

		if($row2['Result']===0){
			echo "Faction Change Failed! Insufficient Points!";
			createLog($_SESSION['UserID'],"Faction change failed on User: ".$UserID.". Reason: insufficient AP available to change faction.");
		}
		else if($row2['Result'] === 1) {
			echo "Faction Change Successful!";
			createLog($_SESSION['UserID'], "Faction Change: Success User: ".$UserID);
		} else {
			echo "Unknown response recieved. Notify a Dev or an Admin.";
			createLog($_SESSION['UserID'], "Faction Change: Unknown Response User: ".$UserID);
		}
	} else {
		echo '<div id="page-wrapper">';
			echo '<div id="content">';
				echo '<div id="title">Change Player Faction</div>';
				echo '<br />';
				echo '<form class="content-form" action="" method="POST">';
					echo '<table class="content-form-table">';
						echo '<tr>';
							echo '<td>Insert Account UserID</td>';
							echo '<td><input type="text" name="UserID"/></td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td>Choose Price Option</td>';
							echo '<td>';
								echo '<center>';
									echo '<select name="Bypass">';
										echo '<option value="0">Charge 1K DP</option>';
										echo '<option value="1">Free</option>';
									echo '</select>';
								echo '</center>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';
					echo '<br />';
					echo '<input type="submit" value="Submit" name="submit" />';
				echo '</form>';
			echo '</div>';
		echo '</div>';
	}
?>
</center>