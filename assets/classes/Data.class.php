<?php
	class Data{
		function __construct($db){
			$this->db	=	$db;
		}
		function escData($data){
			if(!isset($data) or empty($data)){
				return '';
			}

			if(is_numeric($data)){
				return $data;
			}

			$non_displayables = array(
										'/%0[0-8bcef]/',
										'/%1[0-9a-f]/',
										'/[\x00-\x08]/',
										'/\x0b/',
										'/\x0c/',
										'/[\x0e-\x1f]/'
//										'/<p\b[^>]*>(.*?)<\/p>/i'
			);

			foreach($non_displayables as $regex){
				$data = preg_replace($regex,'',$data);
				$data = str_replace("'","''",$data);
			}
			# Remove any indentations
			$data = str_replace("	","&#09;",$data);
			$data = str_replace("		","&#09;&#09;",$data);
			#$data = str_replace("     ","&nbsp;&nbsp;",$data);
			$data = str_replace("\t","&#09;",$data);
			$data = str_replace("\t\t","&#09;&#09;",$data);
			# Next replace unify all new-lines into unix LF
			$data = str_replace("\r","\n",$data);
			$data = str_replace("\n\n","\n",$data);
			# Replace all new lines with the unicode
			$data = str_replace("\n","<br>",$data);
			# Replace any new line entities between >< with a new line
			$data = str_replace(">&#10;<",">\n<",$data);

			return $data;
		}
		function xml_parser($data){
		#	$data = str_replace(array("\r","\n") , "<br>", $data);
			$data = str_replace("\t","&#09;",$data);

			return $data;
		}
		function getDateDiff($date1){
			# Time Difference
			$return = '~ ';
			$date1 = new DateTime($date1);
			$date2 = new DateTime(strtotime(time()));
			$diff = $date1->diff($date2);

			if ($diff->y != 0) {$diff->y == 1 ? $return .= '1y ' : $return .= $diff->y . 'y ';}
			if ($diff->m != 0) {$diff->m == 1 ? $return .= '1m ' : $return .= $diff->m . 'm ';}
			if ($diff->y != 0) {return $return . '';}
			if ($diff->d != 0) {$diff->d == 1 ? $return .= '1d ' : $return .= $diff->d . 'd ';}
			if ($diff->m != 0) {return $return . '';}
			if ($diff->h != 0) {$diff->h == 1 ? $return .= '1h ' : $return .= $diff->h . 'h ';}
			if ($diff->y == 0 && $diff->m == 0 && $diff->d != 0) {return $return . '';}
			if ($diff->i != 0) {$diff->i == 1 ? $return .= '1m ' : $return .= $diff->i . 'm ';}
			if ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h != 0) {return $return . '';}
			if ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i != 0) {return $return . '';}
			if ($diff->s != 0) {$diff->s == 1 ? $return .= '1s ' : $return .= $diff->s . 's ';}
			return $return . '';
		}
		function setPriorityLevel($data){
			switch ($data) {
				case 4 :
					echo '<span class="label label-info">';
				break;
				case 3 :
					echo '<span class="label label-success">';
				break;
				case 2 :
					echo '<span class="label label-warning">';
				break;
				case 1 :
					echo '<span class="label label-important">';
				break;
			}
		}
		function setPriority($data){
			# Ticket Priority Level Switch
			switch ($data) {
				case 1 :
					return "Critical";
				break;
				case 2 :
					return "High";
				break;
				case 3 :
					return "Normal";
				break;
				case 4 :
					return "Low";
				break;
			}
		}
		function messageStatus($data){
			switch ($data) {
				case "Open" :
					echo '<span class="label label-important tac">Open';
				break;
				case "Pending" :
					echo '<span class="label label-success">Pending';
				break;
				case "Close" :
					echo '<span class="label label-info tac">Closed';
				break;
				case "Spam" :
					echo '<span class="label label-default tac">Spam';
				break;
			}
		}
		function format_phone($data,$country){
			$function = 'format_phone_'.$country;
			if(function_exists($function)){
				return $function($data);
			}

			return $data;
		}
		function format_phone_us($data){
			# note: making sure we have something
			if(!isset($data{3})){
				return '';
			}
			# note: strip out everything but numbers
			$data	=	preg_replace("/[^0-9]-/","",$data);
			$length	=	strlen($data);
			switch($length){
				case 7: return preg_replace("/([0-9]{3})([0-9]{4})/","$1 - $2",$data);break;
				case 10: return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/","($1) $2 - $3",$data);break;
				case 11: return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/","$1($2) $3 - $4",$data);break;
				default: return $data;break;
			}
		}
		function urlsafe_b64encode($string){
			$data = base64_encode($string);
			$data = str_replace(array('+','/','='),array('-','_',''),$data);

			return $data;
		}
		function urlsafe_b64decode($string){
			$data = str_replace(array('-','_'),array('+','/'),$string);
			$mod4 = strlen($data) % 4;
			if($mod4){
				$data .= substr('====', $mod4);
			}
			return base64_decode($data);
		}
		function convert_month_to_text($data){
			switch($data){
				case '01': return 'January';break;
				case '02': return 'February';break;
				case '03': return 'March';break;
				case '04': return 'April';break;
				case '05': return 'May';break;
				case '06': return 'June';break;
				case '07': return 'July';break;
				case '08': return 'August';break;
				case '09': return 'September';break;
				case '10': return 'October';break;
				case '11': return 'November';break;
				case '12': return 'December';break;
			}
			
			return $data;
		}
		function rand_str(){
			$alpha_num			=	'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$pass				=	array(); //remember to declare $pass as an array
			$alpha_num_length	=	strlen($alpha_num) - 1; //put the length -1 in cache

			for ($i=0;$i<64;$i++){
				$n		=	rand(0, $alpha_num_length);
				$pass[]	=	$alpha_num[$n];
			}

			return implode($pass); //turn the array into a string
		}
		function member_id_rand(){
			$random_string	=	rand(0,9).rand(0,9).rand(0,9).'-'.
								rand(0,9).rand(0,9).rand(0,9).'-'.
								rand(0,9).rand(0,9).rand(0,9).'-'.
								rand(0,9).rand(0,9).rand(0,9).'-'.
								rand(0,9).rand(0,9).rand(0,9);
			
			return $this->verify_member_id_rand($random_string);
		}
		function verify_member_id_rand($data){
			$ret	=	'An error has occured...';
			$sql	=	('SELECT MemberID FROM '.$this->db->get_TABLE("USER_DATA").' WHERE MemberID = ?');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($data);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					$this->member_id_rand();
				}
				else{
//					$ret	=	'match not found';
					$ret	=	$data;
				}
			}

			return $ret;
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
		function bit_2_text($data){
			switch($data){
				case "1"		:	return '<badge class="badge badge-success m_t_2">Yes</badge>';	break;
				case "0"		:	return '<badge class="badge badge-danger m_t_2">No</badge>';	break;
			}
		}
		function bit_2_text2($data){
			switch($data){
				case "1"		:	return 'Yes';	break;
				case "0"		:	return 'No';	break;
				default			:	return $data;
			}
		}
		function ENABLE($data){
			switch($data){
				case "1"		:	return 'Enabled';	break;
				case "0"		:	return 'Disabled';	break;
				case "true"		:	return 'Enabled';	break;
				case "false"	:	return 'Disabled';	break;
				default			:	return $data;
			}
		}
		function msg_2_text($data){
			switch($data){
				case	"0"		:	return 'data-toggle="tooltip" data-placement="bottom" title="Hooray!"';
			}
		}
		function gen_blog_post_id($len){
			$string	=	"";
			$chars	=	"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			for($i=0;$i<$len;$i++){
				$string	.=	substr($chars,rand(0,strlen($chars)),1);
			}

			return $string;
		}
		function chat_color($num){
			switch($num){
				case 1:		return 'normal';	break;
				case 2:		return 'whisper';	break;
				case 3:		return 'guild';		break;
				case 4:		return 'party';		break;
				case 5:		return 'trade';		break;
				case 6:		return 'yelling';	break;
				case 7:		return 'area';		break;
			}
		}
		function status_2_text($status){
			switch($status){
				case 0	:	return 'Guest';										break;
				case 1	:	return '<span class="sky-blue">SEO</span>';			break;
				case 2	:	return '<span class="green">Add Later</span>';		break;
				case 3	:	return '<span class="gold">Administrator</span>';	break;
				case 4	:	return '<span class="red">Developer</span>';		break;
			}
		}
		function online_status_2_text($data){
			switch($data){
				case 0 : return "<span class=\"label label-danger\">Offline</span>";break;
				case 1 : return "<span class=\"label label-success\">Online</span>";break;
			}
		}
		function tracker($Status){
			# Issue Tracker Functions
			switch($Status){
				case 0:	return 'Status: New';		break;
				case 1:	return 'Status: Updated';	break;
				case 2:	return 'Status: Closed';	break;
				case 3:	return 'Status: Undefined';	break;
			}
		}
		function dept($Dept){
			switch($Dept){
				case 0:		return 'Accounting';	break;
				case 1:		return 'Billing';		break;
				case 2:		return 'Graphics';		break;
				case 3:		return 'General';		break;
				case 4:		return 'Suggestions';	break;
			}
		}
		function object2array($object){
			$return = NULL;

			if(is_array($object)){
				foreach($object as $key => $value)
				$return[$key] = $this->object2array($value);
			}
			else{
				$var = get_object_vars($object);

				if($var){
					foreach($var as $key => $value)
						$return[$key] = ($key && !$value) ? NULL : $this->object2array($value);
					}
					else{
						return $object;
					}
			}

			return $return;
		} 
		# MISC
		function Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
		function _get_class_methods(){
			$class_methods	=	get_class_methods($this);
			echo '<div class="col-md-12">';
				echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
				echo '<pre>';
				foreach($class_methods as $method_name){
					echo $method_name.'<br>';
				}
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}
?>