<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Select		=	new Select();
	$Data		=	new Data($db);
	$Theme		=	new Theme($db);
	$Style		=	new Style($db,$Theme);
	$Tpl		=	new Template($Data,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			$info			=	explode("~",$_POST['id']);
			echo var_dump($info);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	list($RowID,$PLUGIN_VERSION,$PLUGIN_DATE,$PLUGIN_ORDER,$PLUGIN_OPT_0,$PLUGIN_OPT_1,$PLUGIN_OPT_2,$PLUGIN_OPT_3,$PLUGIN_OPT_4,$PLUGIN_OPT_5,$PLUGIN_OPT_6,$PLUGIN_OPT_7,$PLUGIN_OPT_8,$PLUGIN_OPT_9) = explode("~",$_POST['id']);

	if(isset($_POST)){
		$info			=	explode("~",$_POST['id']);
		$RowID			=	isset($info[0])		?	trim($info[0])	:	false;
		$PLUGIN_VERSION	=	isset($info[1])		?	trim($info[1])	:	false;
		$PLUGIN_DATE	=	isset($info[2])		?	trim($info[2])	:	false;
		$PLUGIN_ORDER	=	isset($info[3])		?	trim($info[3])	:	false;
		$PLUGIN_OPT_0	=	isset($info[4])		?	trim($info[4])	:	false;
		$PLUGIN_OPT_1	=	isset($info[5])		?	trim($info[5])	:	false;
		$PLUGIN_OPT_2	=	isset($info[6])		?	trim($info[6])	:	false;
		$PLUGIN_OPT_3	=	isset($info[7])		?	trim($info[7])	:	false;
		$PLUGIN_OPT_4	=	isset($info[8])		?	trim($info[8])	:	false;
		$PLUGIN_OPT_5	=	isset($info[9])		?	trim($info[9])	:	false;
		$PLUGIN_OPT_6	=	isset($info[10])	?	trim($info[10])	:	false;
		$PLUGIN_OPT_7	=	isset($info[11])	?	trim($info[11])	:	false;
		$PLUGIN_OPT_8	=	isset($info[12])	?	trim($info[12])	:	false;
		$PLUGIN_OPT_9	=	isset($info[13])	?	trim($info[13])	:	false;

		#	input_group($ID,$PLACEHOLDER,$VALUE,$ATTRIB,$PREPEND,$APPEND,$WIDTH=false)

		echo '<div class="row">';
			echo '<div class="col-md-4"></div>';
			echo '<div class="col-md-8">';
		if(!empty($RowID)){
			if(!empty($PLUGIN_VERSION)){
				echo '<font class="b_i">Plugin Version: </font>'.$PLUGIN_VERSION.'<br>';
			}
			if(!empty($PLUGIN_DATE)){
				echo '<font class="b_i">Plugin Date: </font>'.$PLUGIN_DATE.'<br>';
			}
			if(!empty($PLUGIN_ORDER)){
				echo '<font class="b_i">Plugin Order: </font>'.$PLUGIN_ORDER.'<br>';
			}
			if(!empty($PLUGIN_OPT_0)){
				echo '<font class="b_i">Plugin Option 0: </font>'.$PLUGIN_OPT_0.'<br>';
			}
			if(!empty($PLUGIN_OPT_1)){
				echo '<font class="b_i">Plugin Option 1: </font>'.$PLUGIN_OPT_1.'<br>';
			}
			if(!empty($PLUGIN_OPT_2)){
				echo '<font class="b_i">Plugin Option 2: </font>'.$PLUGIN_OPT_2.'<br>';
			}
			if(!empty($PLUGIN_OPT_3)){
				echo '<font class="b_i">Plugin Option 3: </font>'.$PLUGIN_OPT_3.'<br>';
			}
			if(!empty($PLUGIN_OPT_4)){
				echo '<font class="b_i">Plugin Option 4: </font>'.$PLUGIN_OPT_4.'<br>';
			}
			if(!empty($PLUGIN_OPT_5)){
				echo '<font class="b_i">Plugin Option 5: </font>'.$PLUGIN_OPT_5.'<br>';
			}
			if(!empty($PLUGIN_OPT_6)){
				echo '<font class="b_i">Plugin Option 6: </font>'.$PLUGIN_OPT_6.'<br>';
			}
			if(!empty($PLUGIN_OPT_7)){
				echo '<font class="b_i">Plugin Option 7: </font>'.$PLUGIN_OPT_7.'<br>';
			}
			if(!empty($PLUGIN_OPT_8)){
				echo '<font class="b_i">Plugin Option 8: </font>'.$PLUGIN_OPT_8.'<br>';
			}
			if(!empty($PLUGIN_OPT_9)){
				echo '<font class="b_i">Plugin Option 9: </font>'.$PLUGIN_OPT_9.'<br>';
			}
		}
		echo '</div></div>';
	}
	else{
		echo 'Unable to locate RowID in post data!';
		exit();
	}
?>