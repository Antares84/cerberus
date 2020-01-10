<?php
	# Access Security
	if($cfg["SysApp_SECURE"] != 1){
		die('You have entered a restricted area.<br />
			 Direct access is not allowed.<br />
			 Area: Fn - Pages'
		);
	}

	function fetchPage(){
		global $cxn1;
		global $cfg;
		$cfg["PageTitle"]=false;
		$cfg["PageSub"]=false;
		$cfg["PageURI"]=false;
		$p = isset($_GET['pid']) ? $_GET['pid'] : false;
		if(!$p){$p='Index';}
		$sql=("SELECT * FROM ".$cfg["ACP_Pages"]." WHERE PageIndex=?");
		$stmt=odbc_prepare($cxn1,$sql);
		$args=array($p);
		$res=odbc_execute($stmt,$args);
		while($row=odbc_fetch_array($stmt)){
			$array_pages = array($row["PageIndex"]=>$row["PageURI"]);
			$cfg["PageTitle"]=$row["PageTitle"];
			$cfg["PageSub"]=$row["PageSub"];
			$cfg["PageURI"]=$row["PageURI"];
		}
		if(!array_key_exists($p,$array_pages)){
			$cfg["page"]=$cfg["CMS_ACP"]."main/acp_error.php";
		}
		elseif(!is_file($array_pages[$p])){
			$cfg["page"]=$cfg["CMS_ACP"]."main/acp_error.php";
		}
		else{
			$cfg["page"]=$array_pages[$p];
		}
	}
?>