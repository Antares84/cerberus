<?php
	class Browser{

		public $OS_Platform;
		public $BrowserType;
		public $UserAgent;
		public $UserIP;

		function __construct(){
			$this->get_UA();
			$this->get_OS_Type();
			$this->get_Browser_Type();
			$this->get_RealIpAddr();
		}
		function get_UA(){
			if(isset($_SERVER['HTTP_USER_AGENT'])){
				$this->UserAgent = $_SERVER['HTTP_USER_AGENT'];
			}
		}
		function get_OS_Type(){
			$OS_Platform	=	"Unknown OS Platform";
			$OS_Arr			=	array(
										'/windows nt 10/i'=>'Windows 10',
										'/windows nt 6.3/i'=>'Windows 8.1',
										'/windows nt 6.2/i'=>'Windows 8',
										'/windows nt 6.1/i'=>'Windows 7',
										'/windows nt 6.0/i'=>'Windows Vista',
										'/windows nt 5.2/i'=>'Windows Server 2003/XP x64',
										'/windows nt 5.1/i'=>'Windows XP',
										'/windows xp/i'=>'Windows XP',
										'/windows nt 5.0/i'=>'Windows 2000',
										'/windows me/i'=>'Windows ME',
										'/win98/i'=>'Windows 98',
										'/win95/i'=>'Windows 95',
										'/win16/i'=>'Windows 3.11',
										'/macintosh|mac os x/i'=>'Mac OS X',
										'/mac_powerpc/i'=>'Mac OS 9',
										'/linux/i'=>'Linux',
										'/ubuntu/i'=>'Ubuntu',
										'/iphone/i'=>'iPhone',
										'/ipod/i'=>'iPod',
										'/ipad/i'=>'iPad',
										'/android/i'=>'Android',
										'/blackberry/i'=>'BlackBerry',
										'/webos/i'=>'Mobile',
										'/x11/i'=>'ChromeOS'
			);

			foreach($OS_Arr as $RegEx=>$Value){
				if(preg_match($RegEx,$this->UserAgent)){
					$this->OS_Platform = $Value;
				}
			}
		}
		function get_Browser_Type(){
			$Browser		=	"Unknown Browser";
			$Browser_Arr	=	array(
										'/msie/i'=>'Internet Explorer',
										'/firefox/i'=>'Firefox',
										'/safari/i'=>'Safari',
										'/chrome/i'=>'Chrome',
										'/edge/i'=>'Edge',
										'/opera/i'=>'Opera',
										'/netscape/i'=>'Netscape',
										'/maxthon/i'=>'Maxthon',
										'/konqueror/i'=>'Konqueror',
										'/mobile/i'=>'Handheld Browser'
			);

			foreach($Browser_Arr as $RegEx=>$Value){
				if(preg_match($RegEx,$this->UserAgent)){
					$this->BrowserType = $Value;
				}
			}
		}
		function get_RealIpAddr(){
			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
				$this->UserIP	=	$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				$this->UserIP	=	$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			elseif(!empty($_SERVER['REMOTE_HOST'])){
				$this->UserIP	=	$_SERVER['REMOTE_HOST'];
			}
			else{
				$this->UserIP	=	$_SERVER['REMOTE_ADDR'];
			}
		}
		function listMyProperties(){
			echo '<b>Browser Class => Display Properties:</b>';
			echo '<pre>';
				print_r(get_object_vars($this));
			echo '</pre>';
		}
	}
?>