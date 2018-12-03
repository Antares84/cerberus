<?php
	require_once('Autoloader.class.php');
	$Browser	=	new Browser();
	$db			=	new Database();

	$Colors		=	new Colors($db);
	$Data		=	new Data($db);
	$Setting	=	new Setting($db);
	$Theme		=	new Theme($db);

	$Style		=	new Style($db,$Theme);
	$Modal		=	new Modal($Colors,$Style);
	$Template	=	new Template($Setting,$Style,$Theme);
	$User		=	new User($Browser,$Data,$db,$Setting);
	$SQL		=	new SQL($Data,$db,$Setting,$Template,$User);
	$Plugins	=	new Plugins($db,$Modal,$SQL,$Style,$Template);

	$PLUGIN_NAME	=	'DropFinder';

	if($Setting->DEBUG === "1"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
	}
	if($Setting->DEBUG === "2"){
		die();
	}

	echo '<form class="search">';
		echo '<div class="form-group row">';
			$Template->input_group('Item','Item Name','','','<i class="fa fa-info-circle"></i>','');
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
				url: "<?php echo $Plugins->get_PLUGINS_DIR().$PLUGIN_NAME; ?>/ajax/search_submit.php",
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