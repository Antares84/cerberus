<?php
	# Note: perhaps add hidden table-row with decrypted pw for viewing/ticket assistance
	require_once('../../Autoloader.php');

	$Arrays		=	new Arrays();
	$DirLister	=	new DirectoryLister($Arrays);
	$Browser	=	new Browser();
	$Dirs		=	new Dirs($Arrays);
	$db			=	new Database();
	$Select		=	new Select();

	$Colors		=	new Colors($db);
	$Data		=	new Data($DirLister);
	$Theme		=	new Theme($Arrays,$db,$Dirs);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($Arrays,$db,$Dirs,$Theme);
	$Tooltips	=	new Tooltips($Colors);
	$Tpl		=	new Template($Colors,$Messenger,$Select,$Style,$Theme,$Tooltips);
	$Setting	=	new Setting($Arrays,$db);
	$User		=	new User($Browser,$db,$Setting);
	$SQL		=	new SQL($Arrays,$Colors,$Data,$db,$Setting,$Tpl,$User);

	if($Setting->_array["DEBUG"] === "1" || $Setting->_array["DEBUG"] === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->_array["DEBUG"] === "2"){
			die();
		}
	}

	$output		=	false;

	if(isset($_POST) && !empty($_POST)){
		$UserUID = $_POST['id'];

		$sql	=	('
						SELECT *
						FROM '.$db->_table_list("SH_USERDATA").'
						WHERE UserUID=?
						ORDER BY UserUID ASC
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($UserUID);
		$prep	=	odbc_execute($stmt,$args);

		$output = '<table class="table table-sm table-dark text-white">';
		while($data=odbc_fetch_array($stmt)){
			$output .= '<tr>';
				$output .= '<td class="tar">UserID : </td>';
				$output .= '<td>'.$data["UserID"].'</td>';
			$output .= '</tr>';

			$output .= '<tr>';
				$output .= '<td class="tar">Password : </td>';
				$output .= '<td>'.$data["Pw"].'</td>';
			$output .= '</tr>';

			$output .= '<tr>';
				$output .= '<td class="tar">Email : </td>';
				$output .= '<td>'.$data["Email"].'</td>';
			$output .= '</tr>';

			$output .= '<tr>';
				$output .= '<td class="tar">Admin : </td>';
				$output .= '<td>'.$Tpl->_status_2_text_admin($data["Status"]).'</td>';
			$output .= '</tr>';

			$output .= '<tr>';
				$output .= '<td class="tar">Status : </td>';
				$output .= '<td>'.$data["Status"].'</td>';
			$output .= '</tr>';

			$output .= '<tr>';
				$output .= '<td class="tar">Registered IP : </td>';
				$output .= '<td>'.$data["RegIP"].'</td>';
			$output .= '</tr>';
		}
		$output .= '</table>';

		echo $output;
		exit;
	}
?>