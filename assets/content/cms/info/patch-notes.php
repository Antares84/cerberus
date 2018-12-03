<?php
	$sql	=	('
					SELECT TOP 25 *
					FROM '.$this->db->get_TABLE("PATCH_NOTES").'
					ORDER BY Date DESC
	');
	$stmt	=	odbc_prepare($this->db->conn,$sql);
	$args	=	array();
	$prep	=	odbc_execute($stmt,$args);

	if($prep){
		while($row = odbc_fetch_array($stmt)){
			echo $this->Tpl->PAGE_CARD($row['Title'],"",$row['Detail'],$row['Date']);
		}
	}else{
		echo $this->Tpl->PAGE_CARD("Patch Notes","","There is currently no Patch Notes to show.","");
	}
?>