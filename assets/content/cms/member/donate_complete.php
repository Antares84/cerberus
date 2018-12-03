<?php
#	User::get_Auth();

	$sql	=	("
					SELECT TOP 1 *
					FROM ".$this->db->get_TABLE("LOG_PAYMENTS")."
					ORDER BY PaymentDate DESC
	");
	$stmt	=	odbc_prepare($this->db->conn,$sql);
	$args	=	array();
	$prep	=	odbc_execute($stmt,$args);

	$Title	=	$this->Tpl->Titlebar("Donation Success");
	echo '<div class="row">';
		echo '<div class="col-md-12">';
		if($prep){
			if($data = odbc_fetch_array($stmt)){
				$Body	=	'Thank you, <font class="b blue">'.$_SESSION["UserID"].'</font>, for your donation.<br>';
				$Body	.=	'Your donation to <font class="b blue">'.$this->Setting->SITE_TITLE.'</font> has been completed.<br>';
				$Body	.=	'Payment Amount: '.$data["Paid"].'<br>';
				$Body	.=	'Points Purchased: '.$data["Reward"].'<br><br>';
				$Body	.=	'Transaction ID: '.$data["TransID"].'<br>';

				echo $this->Tpl->PAGE_CARD($Title,"",$Body,"");
			}
		}
		echo '</div>';
	echo '</div>';