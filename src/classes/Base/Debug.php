<?php
	namespace classes\Base;
	if(!defined('IN_CMS')){
		exit('DEBUG: unauthorized access detected, exiting...');
	}

	class Debug{
		public function __construct($Browser,$DateTime,$Dirs,$MSSQL,$Paging,$Session,$Setting,$Style,$Theme,$Tpl,$User,$Version){
			if(isset($Browser) && !empty($Browser)){$this->Browser=$Browser;}
			if(isset($DateTime) && !empty($DateTime)){$this->DateTime=$DateTime;}
			if(isset($Dirs) && !empty($Dirs)){$this->Dirs=$Dirs;}
			if(isset($MSSQL) && !empty($MSSQL)){$this->MSSQL=$MSSQL;}
			if(isset($Paging) && !empty($Paging)){$this->Paging=$Paging;}
			if(isset($Session) && !empty($Session)){$this->Session=$Session;}
			if(isset($Setting) && !empty($Setting)){$this->Setting=$Setting;}
			if(isset($Style) && !empty($Style)){$this->Style=$Style;}
			if(isset($Theme) && !empty($Theme)){$this->Theme=$Theme;}
			if(isset($Tpl) && !empty($Tpl)){$this->Tpl=$Tpl;}
			if(isset($User) && !empty($User)){$this->User=$User;}
			if(isset($Version) && !empty($Version)){$this->Version=$Version;}
		}
		public function _run($class,$level){
			echo $this->_viewport($class,$level);
		}
		private function _viewport($class,$level){
			echo '<div class="container">';
				echo '<div class="row">';
					$this->Tpl->Titlebar('Execution Debugging','w_100_p');
					echo '<div class="table table-responsive">';
						echo '<table class="table table-sm table-striped table-dark tac acp_table">';
							echo '<thead>';
								echo '<tr>';
									echo '<th>Execution Class</th>';
									echo '<th>Execution Level</th>';
								echo '<tr>';
							echo '</thead>';
							echo '<tbody>';
								echo '<tr>';
									echo '<td class="tac">'.$class.'</td>';
									echo '<td class="tac">'.$level.'</td>';
								echo '</tr>';
							echo '</tbody>';
						echo '</table>';
					echo '</div>';

					echo '<div class="table table-responsive">';
						echo '<table class="table table-sm table-striped table-dark">';
							echo '<tr>';
								return $this->$class->_class_info($level);
							echo '</tr>';
						echo '</table>';
				echo '</div>';

				echo '<div class="row">';
					echo '<div class="col-md-4">';
						echo 'Display Builder - Execution Debugging<br>';
						echo 'Execution Class: '.$class.'<br>';
						echo 'Execution Level: '.$level.'<br><br>';
					echo '</div>';

					echo '<div class="col-md-8">';
						
						return $this->$class->_class_info($level);
					echo '</div>';
				echo '</div>';
			echo '</div>';
			exit;
		}
	}
?>