<?php
	$this->User->Auth();

	$page		=	1;
	$persite	=	25;
	$where		=	"";
	$addlink	=	"";
	$scripturl	=	$_SERVER['PHP_SELF'];
#	$pvp		=	5;

	# check level area
#	if(isset($_GET['pvp']) && !empty($_GET['pvp']) && preg_match('#^[0-9]*$#',$_GET['pvp'])){
#		$pvp	=	$_GET['pvp'];
#		if($pvp == 1){$where='AND [c].[Level] BETWEEN 1 AND 15';}
#		elseif($pvp == 2){$where='AND [c].[Level] BETWEEN 16 AND 30';}
#		elseif($pvp == 3){$where='AND [c].[Level] BETWEEN 31 AND 45';}
#		elseif($pvp == 4){$where='AND [c].[Level] > 46';}
#	}

	$page		=	1;
	$persite	=	25;
	$addlink	=	"";
	$scripturl	=	$_SERVER['PHP_SELF'];

	# Get Current Page
	if(isset($_GET['page']) && !empty($_GET['page']) && preg_match('#^[0-9]*$#',$_GET['page'])){
		$page		= $_GET['page'];
		$addlink	= '&amp;page='.$page;
	}

	$begin	=	($page - 1)	*	$persite;
	$max	=	$page		*	$persite;

	$CARD_BODY		=	$this->SQL->_get_members_list($begin,$max,$this->PAGE_INDEX);
	$CARD_FOOTER	=	$this->SQL->_get_members_cnt($persite,$page,$this->PAGE_INDEX);

	echo $this->Cards->_do_build_card('members','Members Listing',$CARD_BODY,'',$CARD_FOOTER);

/*
	$this->User->get_Auth();

	$page		=	1;
	$persite	=	25;
	$where		=	"";
	$addlink	=	"";
	$scripturl	=	$_SERVER['PHP_SELF'];
	$pvp		=	5;

	# check level area
	if(isset($_GET['pvp']) && !empty($_GET['pvp']) && preg_match('#^[0-9]*$#',$_GET['pvp'])){
		$pvp	=	$_GET['pvp'];
		if($pvp == 1){$where='AND [c].[Level] BETWEEN 1 AND 15';}
		elseif($pvp == 2){$where='AND [c].[Level] BETWEEN 16 AND 30';}
		elseif($pvp == 3){$where='AND [c].[Level] BETWEEN 31 AND 45';}
		elseif($pvp == 4){$where='AND [c].[Level] > 46';}
	}
	# check current page
	if(isset($_GET['page']) && !empty($_GET['page']) && preg_match('#^[0-9]*$#',$_GET['page'])){
		$page		= $_GET['page'];
		$addlink	= '&amp;page='.$page;
	}
	# calculate begin and end
	$begin	=	($page - 1)	*	$persite;
	$max	=	$page		*	$persite;

	echo '<div class="card no_bg no_border no_radius">';
		echo '<div class="card-header card_border tac title no_radius">';
			echo 'Members List';
		echo '</div>';

		echo '<div class="card-block card_border content_bg content no_radius pContent">';
			echo '<div class="card-text">';
				echo '<table id="myTable" class="table table-sm table-inverse acp_table">';
					echo '<thead>';
						echo '<tr>';
							echo '<th class="tac">Name</th>';
						if($this->User->get_isAdmin()){
							echo '<th class="tac">Member ID</th>';
						}
							echo '<th class="tac">Status</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					$sql	=	("SELECT top $max *
								  FROM ".$this->db->get_TABLE("USER_DATA")." $where
								  ORDER BY UserUID ASC");
					$res	=	odbc_exec($this->db->conn,$sql);

					for(
						$i=1;
						$data = odbc_fetch_array($res);
						$i++
					){
						if($i >= $begin){
							# online status
							if(isset($data['Leave'])){
								if($data['Leave'] == 0){
									$online = '<font color="'.$this->Colors->get_COLOR("Red").'">Offline</font>';
								}
								else{
									$online = '<font color="'.$this->Colors->get_COLOR("Green").'">Online</font>';
								}
							}
							else{
								$online = '<font color="#014b9d">Unknown</font>';
							}
						echo '<tr>';
							echo '<td class="tac">'.$data["DisplayName"].'</td>';
						if($this->User->get_isAdmin()){
							echo '<td class="tac">'.$data["MemberID"].'</td>';
						}
							echo '<td class="tac">'.$online.'</td>';
						echo '</tr>';
						}
					}
					echo '</tbody>';
				echo '</table>';
			echo '</div>';
		echo '</div>';

		# show next pages
		$csql	=	("SELECT Count(UserUID) AS [Count]
					  FROM ".$this->db->get_TABLE("USER_DATA")."
					  WHERE Status = 0 $where");
		$cres	=	odbc_exec($this->db->conn,$csql);

		$cfet	=	odbc_fetch_array($cres);
		$ccount	=	$cfet['Count'];
		$cpages	=	$ccount/$persite;

		echo '<div class="card-footer card_border content_bg footer no_radius pContent">';
			echo '<div class="tac b_i">';
				echo '<nav aria-label="Page navigation example">';
					echo '<ul class="pagination justify-content-center">';
						echo $this->User->pagination($page,ceil($cpages),$url='?'.$this->Setting->PAGE_PREFIX.'='.$this->PageIndex.'&membber_page='.$pvp);
					echo '</ul>';
				echo '</nav>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
*/
?>