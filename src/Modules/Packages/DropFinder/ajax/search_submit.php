<?php
	require_once("Autoloader.class.php");
	$db			=	new Database();
	$Data		=	new Data($db);
	$Setting	=	new Setting($db);
	$Theme		=	new Theme($db);
	$Layout		=	new Layout($db);
	$Colors		=	new Colors($Data,$db);
	$Style		=	new Style($db,$Layout);
	$Template	=	new Template($Setting,$Style,$Theme);
	$Plugins	=	new Plugins($db,$Setting,$Style,$Colors);

	$Item	=	isset($_POST["Item"])	?	$Data->escData(trim($_POST["Item"]))	:	"";
	$ItemName	=	$Data->escData($Item);

	$Template->Titlebar('List of Monsters That Drop <span class="b_i">'.$ItemName.'</span>');
	echo '<div class="row">';
		echo '<div class="col-md-12">';
			if(isset($Item) && !empty($Item)){
				$ItemName	=	$Data->escData($Item);

				$sql	=	("SELECT Grade FROM ".$db->get_TABLE("SH_ITEMS")." WHERE ItemName LIKE ?");
				$stmt	=	odbc_prepare($db->conn,$sql);
				$args	=	array("%$ItemName%");
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					if(odbc_num_rows($stmt) === 0){
						echo 'The desired item, <span class="b_i">'.$ItemName.'</span>, could not be located.<br>Please check the spelling and try again.';
					}
					else{
						$sql	=	("
										SELECT m.MobID,m.MobName,m.HP,m.Level,m.Attrib,mi.DropRate,mi.ItemOrder
										FROM ".$db->get_TABLE("SH_MOBS")." AS m
										INNER JOIN ".$db->get_TABLE("SH_MOBITEMS")." AS mi ON mi.MobID=m.MobID
										WHERE Grade = (SELECT Grade FROM ".$db->get_TABLE("SH_ITEMS")." WHERE ItemName LIKE '".$ItemName."')
										ORDER BY mi.DropRate DESC
						");
						$res	=	odbc_exec($db->conn,$sql);

						if($res){
							$Element	=	array(0=>'None',1=>'Fire',2=>'Water',3=>'Earth',4=>'Wind');

							if(odbc_num_rows($res) > 0){
								echo '<div class="table-responsive">';
									echo '<table id="mytable" class="table table-sm acp_table">';
										echo '<thead>';
											echo '<tr>';
												echo '<th>Mob Name</th>';
												echo '<th>Mob HP</th>';
												echo '<th>Mob Level</th>';
												echo '<th>Mob Element</th>';
												echo '<th>Drop %</th>';
											echo '</tr>';
										echo '</thead>';
										echo '<tbody>';
										while($data=odbc_fetch_array($res)){ 
											echo '<tr>';
												echo '<td>'.$data["MobName"].'</td>';
												echo '<td class="tac">'.number_format($data["HP"]).'</td>';
												echo '<td class="tac">'.$data["Level"].'</td>';
												echo '<td class="tac">'.$Element[$data["Attrib"]].'</td>';
												$DropRate=$data["DropRate"];
												if($data["ItemOrder"] > 4){$DropRate=($DropRate/100000);}
												if($DropRate > 100){$DropRate=100;}
												echo '<td class="tac">'.$DropRate.'%</td>';
											echo "</tr>";
										}
										echo '</tbody>';
									echo "</table>";
								echo '</div>';
							}
							else{
								echo '<div class="tac">Sorry, a monster couldn\'t be found that drops <span class="b_i">'.$ItemName.'</span>.</div>';
							}
						}
					}
				}
			}
			else{
				echo '<div class="tac">Item name must be filled in! Can\'t search without knowing what you\'re looking for.</div>';
			}
		echo '</div>';
	echo '</div>';
?>