<?php
	class FileStore{
		function get_IMAGE($dir,$width,$height=NULL){
			$ret = NULL;
			$contents = scandir($dir);

			foreach($contents as $file){
				$ext = pathinfo($file,PATHINFO_EXTENSION);

				@list($filename,$f_width,$f_height) = explode("_",$file);

				$h	=	$f_height;
				$w	=	substr($f_width,0,3);

				if($ext == "jpg" || $ext == "png"){
					if($h == $height){
						if($w == $width){
							$ret.=$file;
						}
					}
					elseif($w == $width){
						$ret.=$file;
					}
				}
			}
			return $ret;
		}
		function get_IMG_DIAG($dir,$width,$height=NULL){
			$ret = NULL;
			$contents = scandir($dir);

			echo '<ul>';
			foreach ($contents as $file){
				$ext = pathinfo($file,PATHINFO_EXTENSION);

				@list($filename,$f_width,$f_height) = explode("_",$file);

				$h	=	$f_height;
				$w	=	substr($f_width,0,3);

				if($ext == "jpg" || $ext == "png"){
					if($height == $h){
						$ret.='entered height check';
						if($h == $height && $h !== NULL && $h !== ""){
							if($w == $width && $w !== NULL && $w !== ""){
								$ret.=$file;
							}
						}
					}
					elseif($width == $w){
						$ret.='entered width check';
						if($w == $width && $w !== NULL && $w !== ""){
							$ret.=$file;
						}
					}
					else{
						$ret.='<li>Image width is invalid.</li>';
						$ret.='<li>Valid image height for this component is <b>'.$height.'</b>.</li>';
						$ret.='<li>Valid image width for this component is <b>'.$width.'</b>.</li>';
						$ret.='<li>Detected height <b>'.$h.'</b> and width <b>'.$w.'</b>.</li>';
						$ret.='<li>Targeted dir is <b>'.$dir.'</b>.</li>';
					}
				}
			}
			echo '</ul>';
			return $ret;
		}
		# Upcoming Events Image (Home Page)
		function ds_U_E_IMG($dir){
			$height	=	"370";
			$width	=	"275";

			return $this->get_IMAGE($dir,$width);
			//return $this->get_IMAGE($dir,$height,$width);
			//return $this->get_IMG_DIAG($dir,$height,$width);
		}
		# Topic Image (Blog)
		function ds_T_IMG($dir){
			$height	=	"350";
			$width	=	"850";

			return $this->get_IMAGE($dir,$width);
			//return $this->get_IMAGE($dir,$height,$width);
			//return $this->get_IMG_DIAG($dir,$width);
		}
		function list_zipfiles($mydirectory){
			// directory we want to scan
			$dircontents = scandir($mydirectory);

			// list the contents
			echo '<ul>';
			foreach ($dircontents as $file) {
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if ($extension == 'zip') {
					echo "<li>$file </li>";
				}
			}
			echo '</ul>';
		}
		function list_php_files($mydirectory){
			// directory we want to scan
			$files = scandir($mydirectory);

			// list the contents
			echo '<ul>';
			foreach ($files as $file) {
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if($extension == 'php'){
					echo "<li>$file </li>";
				}
			}
			echo '</ul>';
		}
	}
?>