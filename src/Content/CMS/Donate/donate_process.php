<?php
	$Key		=	isset($_GET["Key"])	?	$this->Data->urlsafe_b64decode($_GET["Key"])	:	"";
	$errors		=	array();

	echo '<div class="card no_bg no_border no_radius">';
		echo '<div class="card-header card_border tac title ntitle no_radius">'.$this->Setting->SITE_TITLE.' Processing Your Donation...</div>';
		echo '<div class="card-block card_border content_bg content no_radius">';
			echo '<div class="card-text">';
				echo 'We are now processing your donation. You will be re-directed to PayPal to complete the process.<br><br>';

				$this->PayPal->DONATE_INFO($Key);
			echo '</div>';
		echo '</div>';
		echo '<div class="card-footer card_border content_bg footer text-muted no_radius">';
			echo '';
		echo '</div>';
	echo '</div>';
?>