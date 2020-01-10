<?php
	$this->User->Auth();

	$rewardSelect	=	isset($_POST["RewardID"])	?	$this->Data->escData(trim($_POST["RewardID"]))	:	"";

	if(isset($_POST["PayPalBtn"]) && !empty($_POST["PayPalBtn"])){
		header('location: ?'.$this->Setting->PAGE_PREFIX.'=PROCESS_DONATION&Key='.$this->Data->urlsafe_b64encode($rewardSelect));
	}
	else{
#		echo $this->MailSys->MAILDIAG();
#		echo '<div class="separator_50"></div>';
		echo $this->Tpl->PAGE_CARD($this->Setting->SITE_TITLE.' Donations',"",$this->Donate->DonateOptions(),"");
	}
?>