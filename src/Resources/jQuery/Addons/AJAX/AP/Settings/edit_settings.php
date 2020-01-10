<?php
	require_once('../../Autoloader.php');

	$Arrays		=	new Arrays();
	$Browser	=	new Browser();
	$Dirs		=	new Dirs();
	$db			=	new Database();
	$Select		=	new Select();

	$Data		=	new Data($db);
	$Theme		=	new Theme($db);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($db,$Dirs,$Theme);
	$Tpl		=	new Template($Data,$Messenger,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);
//	$SQL		=	new SQL($Data,$db,$Setting,$Tpl);

#	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
#	}

	list($RowID,$DESC,$VALUE,$SETTING,$DB) = explode("~",$_POST['id']);

	echo '<form class="ajax">';
		echo '<div class="row">';
		#	input_group($ID,$PLACEHOLDER,$VALUE,$ATTRIB=false,$PREPEND=false,$APPEND=false,$STYLE=false)
			echo '<input id="RowID" name="RowID" type="hidden" value="'.$RowID.'"/>';

			$Tpl->input_group('DESC',$DESC,'','readonly','<i class="fa fa-info-circle"></i>','','mb-3');

			if(in_array($SETTING,$Arrays->_get_Array('enabled'))){
				$Select->_get_select('enable');
			}
			elseif(in_array($SETTING,$Arrays->_get_Array('sidebar'))){
				$Select->_get_select('sidebar_pos');
			}
			elseif(in_array($SETTING,$Arrays->_get_Array('bg_color'))){
				$Select->_get_select('background_color');
			}
			elseif(in_array($SETTING,$Arrays->_get_Array('text'))){
				echo 'text output';
				$Tpl->input_group($SETTING,'',$VALUE,'');
/*
				echo '<small class="form-text text-muted">';
					echo 'Can be a http(s) link, or just the image filename itself';
				echo '</small>';
*/
			}
/*
			elseif(in_array($SETTING,$Arrays->_get_Array('theme'))){
				$Select->_get_select('cms_theme');
			}
*/
			else{
				echo 'Undefined';
			}

			echo '<input id="DB" name="DB" type="hidden" value="'.$DB.'"/>';
		echo '</div>';

		echo '<div class="text-center f_20 mt-3">';
			echo '<button type="button" class="badge badge-primary" id="stng_submit"><i class="fa fa-check-circle"></i> Update Setting</button>';
		echo '</div>';
	echo '</form>';
?>