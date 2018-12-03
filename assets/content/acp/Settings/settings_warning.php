<?php
	$this->User->Auth();
	$this->LogSys->createLog("accessed ACP Settings");

	# CONTENT
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			$this->Tpl->TitleBar("Settings - Notice");
			echo '<div class="black_base">';
				echo '<p class="badge-danger p_all_5">';
					echo 'Changing any settings here can have an adverse or otherwise unwanted effect on your website.<br>';
					echo 'Be careful what you change so that you don\'t harm the functionality of your site.';
				echo '</p>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	echo '<div class="separator_10"></div>';

	$this->Tpl->TitleBar("Settings");
	echo $this->Tpl->Separator('10');
	echo '<div class="row">';
		$this->SQL->SettingsCards("SETTINGS",0);
	echo '</div>';
?>