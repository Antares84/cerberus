<?php
	class Modal{

	/*
		@Size	(void)	modal-sm || modal-lg
		@Pos	(void)	modal-dialog-centered
		@ID		(bool)
		@Icon	(void)	can use either FontAwesome or FontIcons
		@Title	(bool)
	*/

		function __construct($Colors,$Paging,$Style){
			$this->Colors		=	$Colors;
			$this->Paging		=	$Paging;
			$this->Style		=	$Style;
		}
		function Display($Zone,$ID,$Icon,$Pos=NULL,$Size,$Title){
			echo '<div class="modal fade" id="'.$ID.'" tabindex="-1" role="dialog" aria-labelledby="'.$ID.'" aria-hidden="true">';
				echo '<div class="modal-dialog'.$this->ModalPos($Pos).$this->ModalSize($Size).'" role="document">';
					echo '<div class="modal-content" style="'.$this->Colors->GetBgRGBa("Black","4").'">';
						echo $this->ModalHeader($ID,$Icon,$Title);
						echo $this->ModalBody($Zone);
						echo $this->ModalFooter();
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		function ModalPos($data){
			switch($data){
				case '0':	return '';							break;
				case '1':	return ' modal-dialog-centered ';	break;
			}
		}
		function ModalSize($data){
			switch($data){
				case '0':	return '';			break;
				case '1':	return ' modal-sm';	break;
				case '2':	return ' modal-lg';	break;
			}
		}
		function ModalHeader($ID,$Icon,$Title){
			echo '<div class="modal-header">';
				echo '<h5 class="modal-title" id="'.$ID.'">'.$Icon.' '.$Title.'</h5>';
				echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
					echo '<span class="text-white" aria-hidden="true"><i class="fa fa-times-circle"></i></span>';
				echo '</button>';
			echo '</div>';
		}
		function ModalBody($Zone){
			echo '<div class="modal-body">';
				echo '<div class="container-fluid">';
					echo '<div id="modal-loader">';
						echo '<div class="row">';
							echo '<div class="col-md-6"></div>';
							echo '<div class="col-md-2">';
								echo '<div class="bt-spinner"></div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '<div id="dynamic-content"></div>';
				echo '</div>';
			echo '</div>';
		}
		function ModalFooter(){
			echo '<div class="modal-footer">';
				echo '<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>';
			#	echo '<button type="button" class="btn btn-primary">Save changes</button>';
			echo '</div>';
		}
	}
?>