<?php
	if(isset($MSG["MESSAGES"])){
		unset($MSG["MESSAGES"]);
		$MSG["MESSAGES"] = $Messages->init_messages();
	}elseif(!isset($MSG["MESSAGES"])){
		$MSG["MESSAGES"] = $Messages->init_messages();
	}

	$MSG["MESSAGES"]["type"][].='0';
	$MSG["MESSAGES"]["body"][].='EM-0x05';

	if(isset($MSG["MESSAGES"])){
		echo '<div class="black_base bordered_tf_lc_rc_bc">';
			echo '<div class="container">';
				echo $Messages->ds_messages($MSG["MESSAGES"]);
				$Messages->get_messages_close();
			echo '</div>';
		echo '</div>';
	}
?>