<?php
#	define('IN_CMS',true);
	require_once('autoloader.class.php');

	$Arrays		=	new classes\Base\Arrays;
	$Select		=	new classes\Display\Select;
	$DirLister	=	new classes\Utils\DirectoryLister($Arrays);
	$Data		=	new classes\Utils\Data($DirLister);
	$Dirs		=	new classes\Base\Dirs($Arrays);
	$Browser	=	new classes\Utils\Browser;
	$Messenger	=	new classes\Utils\Messenger($Browser);
	$MSSQL		=	new classes\DB\MSSQL;
	$Colors		=	new classes\Utils\Colors($MSSQL);
	$Tooltips	=	new classes\Utils\Tooltips($Colors);
	$Setting	=	new classes\Settings\Settings($Arrays,$MSSQL);
	$Paging		=	new classes\Utils\Paging($Arrays,$MSSQL,$Dirs,$Setting);
	$Theme		=	new classes\Settings\Theme($Arrays,$MSSQL,$Dirs);
	$Style		=	new classes\Settings\Style($Arrays,$MSSQL,$Dirs,$Theme);
	$Modal		=	new classes\Utils\Modal($Colors,$Dirs,$Paging,$Setting,$Style);
	$Tpl		=	new classes\Utils\Template($Colors,$Messenger,$Select,$Style,$Theme,$Tooltips);
	$User		=	new classes\Utils\User($Browser,$MSSQL,$Setting);
	$SQL		=	new classes\DB\SQL($Arrays,$Colors,$Data,$MSSQL,$Setting,$Tpl,$User);
	$Modules	=	new classes\Modules\Modules($Data,$Dirs,$Modal,$MSSQL,$Setting,$Tpl);

	$MODULE_NAME='DropFinder';

	if($Setting->_arr["DEBUG"] === "1"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
	}
	if($Setting->_arr["DEBUG"] === "2"){
		die();
	}

	echo '<form class="search">';
		echo '<div class="form-group row">';
			$Tpl->input_group('Item','Item Name','','','<i class="fa fa-info-circle"></i>','');
		echo '</div>';

		echo '<div class="form-group row tac">';
			echo '<button type="button" class="btn btn-sm btn-primary m_auto" id="submit_search"><i class="fa fa-search"></i> Search</button>';
		echo '</div>';

	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#submit_search").click(function(){
			e.preventDefault();

			$.ajax({
				type: "POST",
				url: "<?php echo $Dirs->_arr["MODULES"].$MODULE_NAME; ?>/ajax/search_submit.php",
				data: $('form.search').serialize(),
				success: function(message){
					$('#plugin_modal #dynamic-content').html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>