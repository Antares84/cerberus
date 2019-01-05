<center>
<?php

	$char  = escData(trim($_REQUEST['char']));
	$count = 0;
	if((isset($_POST['submit'])) || strlen($char)>1){
		if(strlen($char)<1){die("Invalid Char Name.");}
		$res=sqlsrv_query($link, "SELECT * FROM [PS_GameData].[dbo].[Chars] WHERE CharName = ? ", array($char));
		$detail=sqlsrv_fetch_array($res);
		$columns=array('UserID','UserUID','CharID','CharName','Slot','Family','Grow','Hair','Face','Size','Job','Sex','Level','StatPoint','SkillPoint','Str','Dex','Rec','Int','Luc','Wis','Map','Dir','Exp','Money','PosX','PosY','Posz','K1','K2','K3','K4','KillLevel','DeadLevel','OldCharName');
		if(!sqlsrv_has_rows($res)){die("User ".$char." does not exist");}
		else{
			echo 'Current Status of '.$char;
			echo '<form action="panel.php?action=player_edit_admin" method="POST">';
				echo '<table cellspacing=1 cellpadding=1>';
				foreach($columns as $value){
					echo '<tr>';
						echo '<th>'.$count.'</th>';
						echo '<th>'.$value.' :</th>';
					if(in_array($value,$greyed)){
						echo '<td>';
							echo '<input type="text" readonly="readonly" style="background:#D0D0D0;" name="'.$value.'" value="'.$detail[$value].'"/>';
						echo '</td>';
						echo '</tr>';
					}else{
						echo '<td>';
							echo '<input type="text" name="'.$value.'" value="'.$detail[$value].'"/>';
						echo '</td>';
						echo '</tr>';
					}
					$count++;
				}
				echo '</table>';
				echo '<input type="submit" style="background: transparent linear-gradient(red, black, red) repeat scroll 0% 0%; font-size: 14px; font-family: Tillana, cursive; border: 1px solid #61C4E0; border-radius: 5px; color: white; text-align: center;" name="submit2" value="Submit">';
			echo '</form>';
		}
	}elseif(isset($_POST['submit2'])){
		$charid=$_POST['CharID'];
		$Report="";
		$coloums=array('CharName','Grow','Hair','Face','Size','Job','Sex','Level','StatPoint','SkillPoint','Str','Dex','Rec','Int','Luc','Wis','Map','Dir','Exp','Money','PosX','PosY','Posz','K1','K2','K3','K4','KillLevel','DeadLevel','OldCharName');
		foreach($coloums as $value){
			odbc_exec($cxn2, "UPDATE PS_GameData.dbo.Chars SET ".$value." = ? WHERE CharID = ?", array($_REQUEST[$value], $charid));
		}
		foreach($_POST as $Name=>$Value){
			if($Name!="submit2"){
				echo $Name.'='.$Value.'<br>';
				$Report.=$Name."=>".$Value.";";
			}
		}
	}else{
		echo '<div id="pl_edit_wrapper">';
			echo '<center><br />';
			echo '<h1>Edit Player</h1>';
			echo '<form action="panel.php?action=panel_edit_admin" method="POST">';
				echo '<table>';
					echo '<tr>';
						echo '<td>Character Name:</td>';
						echo '<td><input type="text" name="char" /></td>';
					echo '</tr>';
				echo '</table>';
				echo '<input type="submit" value="Submit" name="submit" />';
			echo '</form>';
			echo '</center>';
		echo '</div>';
	}
?>