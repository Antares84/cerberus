<?php
	class Forum{
		function __construct($db,$Setting){
			$this->db		=	$db;
			$this->Setting	=	$Setting;
		}
		function get_sql_resources_cnt($persite,$page,$PageIndex){
			$csql	=	('
							SELECT Count(TopicID) AS [Count]
							FROM '.$this->db->get_TABLE("FORUM")
			);
			$cres	=	odbc_exec($this->db->conn,$csql);

			$cfet	=	odbc_fetch_array($cres);
			$ccount	=	$cfet['Count'];
			$cpages	=	$ccount/$persite;

			echo '<div class="card-footer card_border content_bg footer no_radius pContent">';
				echo '<div class="tac b_i">';
					echo '<nav aria-label="Page navigation example">';
						echo '<ul class="pagination justify-content-center">';
							echo $this->User->pagination($page,ceil($cpages),$url='?'.$this->Setting->PAGE_PREFIX.'='.$PageIndex);
						echo '</ul>';
					echo '</nav>';
				echo '</div>';
			echo '</div>';
		}
		function get_sql_resources_show_post($TopicID){
			$sql	=	('
							SELECT top 1 TopicTitle,TopicBody
							FROM '.$this->db->get_TABLE("FORUM").'
							WHERE TopicID=?
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($TopicID);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				while($data = odbc_fetch_array($stmt)){
					echo '<div class="card no_bg no_border no_radius">';
						echo '<div class="card-header card_border tac title no_radius">'.$data["TopicTitle"].'</div>';
						echo '<div class="card-block card_border content_bg content no_radius pContent">';
							echo '<div class="card-text p_10_15">';
								echo $data["TopicBody"];
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
		}
	}