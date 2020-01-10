<?php
	$sql	=	("
					SELECT TOP 20 Text1,Text2,Text3,MapID,ActionTime
					FROM ".$this->db->get_TABLE("SH_ACTIONLOG")."
					WHERE ActionType=? AND Text2=?
					ORDER BY row DESC"
	);
	$stmt	=	odbc_prepare($this->db->conn,$sql);
	$args	=	array('173','death');
	$prep	=	odbc_execute($stmt,$args);

	# Content
	$this->Tpl->Titlebar('Boss Records');
	echo '<div class="row">';
		echo '<div class="col-md-12">';
			echo $this->BossRecord->get_Record();
		echo '</div>';
	echo '</div>';
?>