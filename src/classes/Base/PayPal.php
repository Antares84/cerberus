<?php
	class PayPal{

		public $_array;

		private $use_local_certs = false;

		private $VERIFY_URI;
		private $SANDBOX_VERIFY_URI;
		private $VALID;
		private $INVALID;

		# Public Methods
		public function __construct($Arrays,$db,$Modules,$Setting){
			$this->Arrays	=	$Arrays;
			$this->db		=	$db;
			$this->Modules	=	$Modules;
			$this->Setting	=	$Setting;

			$this->_class_info();
		}
		public function _class_info($level=false){
			if($level){
				echo '<b>ClassInfo Level: '.$level.'<br>';
			}
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
				default	:	return $this->_build();	break;
			}
		}
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
		public function _Mthds($_array=false){
			$class_methods	=	get_class_methods($this);

			if($_array){
				echo '<div class="col-md-12">';
					echo '<b>Methods & Details for class ('.get_class($this).'):</b><br>';

				#	$this->_build();

					echo '<pre>';
						echo 'Pre Node<br>';
						var_dump($this->_array);
					echo '</pre>';
				echo '</div>';
			}
			else{
				echo '<div class="col-md-12">';
					echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
					echo '<pre>';
					foreach($class_methods as $method_name){
						echo $method_name.'<br>';
					}
					echo '</pre>';
				echo '</div>';
				exit;
			}
		}

		# Private Methods
		private function _build(){
			if($this->_array){$this->_array=null;}
			$this->_a=array();

			$class_methods	=	get_class_methods($this);

			foreach($class_methods as $method_name){
				if(in_array($method_name,$this->Arrays->pp_index)){
					try{
						$this->$method_name(true);
			#			echo $method_name.'<br>';
					}
					catch(exception $e){
						throw new SystemException('Error in <b>'.get_class($this),0,0,__FILE__,__LINE__);
					}
				}
				$this->_do_close();
			}

			$this->_do_close(true);
		}
		private function _do_close($push=false){
			$this->_array=$this->_a;

			if($push){unset($this->_a);}
		}
		private function _do_query($database,$data,$alert){
			$res	=	$this->db->_do_query($database,0,$data);

			if($alert){
				if(!$res){
					throw new SystemException('Unable to load var <b>'.$data.'</b> from database!',0,0,__FILE__,__LINE__);
				}
				else{
					return $res;
				}
			}
			else{
				return $res;
			}
		}
		private function _pp_donate(){								#0
			$this->_a[]	=	$this->_do_query('SETTINGS_MAIN','PAYPAL_DONATE',1);
		}
		private function _pp_debug(){								#1
			$this->_a[]	=	$this->_do_query('SETTINGS_MAIN','PAYPAL_DEBUG',1);
		}
		private function _pp_receiver(){							#2
			$this->_a[]	=	$this->_do_query('SETTINGS_MAIN','PAYPAL_RECEIVER',1);
		}
		# Sets the IPN verification to sandbox mode (for use when testing,
		# should not be enabled in production).
		# @return void
		private function _pp_sandbox(){								#3
			$this->_a[]	=	$this->_do_query('SETTINGS_MAIN','PAYPAL_SANDBOX',1);
		}
		private function _pp_send_conf_email(){						#4
			$this->_a[]	=	$this->_do_query('SETTINGS_MAIN','PAYPAL_CONF_EMAIL',1);
		}
		private function _pp_sandbox_uri(){							#5
			$this->_a[]	=	$this->_do_query('SETTINGS_MAIN','PAYPAL_SANDBOX_URI',1);
		}
		private function _pp_standard_uri(){						#6
			$this->_a[]	=	$this->_do_query('SETTINGS_MAIN','PAYPAL_STANDARD_URI',1);
		}
		# Determine endpoint to post the verification data to.
		# @return string
		private function _pp_uri(){									#7
			$this->_do_close();
			if($this->_array[3]){
				$this->_a[]	=	$this->_array[5];
			}
			else{
				$this->_a[]	=	$this->_array[6];
			}
		}
		private function _pp_valid(){								#8
			$this->_a[] = 'VERIFIED';
		}
		private function _pp_invalid(){								#9
			$this->_a[] = 'INVALID';
		}

		function DONATE_INFO($Key){
			$sql	=	("
							SELECT RowID,Reward,Price
							FROM ".$this->db->get_TABLE("DONATE_OPTIONS")."
							WHERE RowID=?
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($Key);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if($data = odbc_fetch_array($stmt)){
					if($this->PAYPAL_DEBUG){
						# Error Checking
						echo "UserUID: ".$_SESSION["UserUID"]."<br>";
						echo "E-Mail: ".$this->PAYPAL_RECEIVER."<br><br>";

						echo "RowID: ".$data["RowID"]."<br>";
						echo "Price: ".$data["Price"]."<br>";
						echo "Reward: ".$data["Reward"]."<br><br>";

						echo "Site URI: ".$this->Setting->SITE_DOMAIN."<br>";
						echo 'Donation URI: '.$this->Setting->SITE_DOMAIN.'/?'.$this->Setting->PAGE_PREFIX.'=DONATE<br>';
						echo 'Donation Return URI: '.$this->Setting->SITE_DOMAIN.'/?'.$this->Setting->PAGE_PREFIX.'=COMPLETE_DONATION<br>';
						echo 'Notify URI: '.$this->Setting->SITE_DOMAIN.'/'.$this->Plugins->get_PAYPAL_IPN_DIR().'listener_adv.php<br>';
						echo 'PayPal URI: '.$this->PAYPAL_URI.'<br><br>';

						echo 'Paypal Debug: '.$this->PAYPAL_DEBUG.'<br><br>';

						if($this->PAYPAL_CONF_EMAIL){
							echo 'PayPal Confirmation Email: Enabled';
						}else{
							echo 'PayPal Confirmation Email: Disabled';
						}
					}
					else{
						# Submit To PayPal
						$paypalurl	=	$this->PAYPAL_URI."/?cmd=_donations&amount=".urlencode($data['Price'])."&business=".urlencode($this->PAYPAL_RECEIVER)."&item_name=".urlencode($data['Reward'])."%20Points&item_number=".urlencode($data['RowID']."_".$_SESSION['UserUID'])."&return=".$this->Setting->SITE_DOMAIN."/?".$this->Setting->PAGE_PREFIX."=COMPLETE_DONATION&rm=1&notify_url=".$this->Setting->SITE_DOMAIN."/".$this->Plugins->get_PAYPAL_IPN_DIR()."listener_adv.php&cancel_return=".$this->Setting->SITE_DOMAIN."/?".$this->Setting->PAGE_PREFIX."=DONATE&no_note=1&currency_code=USD";

#						echo $paypalurl;
						header('Refresh: 3;url='.$paypalurl);
					}
				}else{
					die("Reward ID Does not exist!");
				}
			}
		}
		# Sets curl to use php curl's built in certs (may be required in some environments).
		# @return void
		public function usePHPCerts(){
			$this->use_local_certs = false;
		}
		public function getPaypalUri(){
			if($this->PAYPAL_SANDBOX){
				return $this->PAYPAL_SANDBOX_URI;
			}
			return $this->PAYPAL_STANDARD_URI;
		}
		# Verification Function
		# Sends the incoming post data back to PayPal using the cURL library.
		# @return bool
		# @throws Exception
		public function verifyIPN(){
			if(!count($_POST)){
				throw new Exception("Missing POST Data");
			}
			$raw_post_data	=	file_get_contents('php://input');
			$raw_post_array	=	explode('&',$raw_post_data);
			$myPost			=	array();
			foreach($raw_post_array as $keyval){
				$keyval	=	explode('=',$keyval);
				if(count($keyval) == 2){
					# Since we don't want the plus in the datetime string to be encoded to a space, we manually encode it.
					if($keyval[0] === 'payment_date'){
						if(substr_count($keyval[1],'+') === 1){
							$keyval[1] = str_replace('+','%2B',$keyval[1]);
						}
					}
					$myPost[$keyval[0]] = urldecode($keyval[1]);
				}
			}
			# Build the body of the verification post request, adding the _notify-validate command.
			$req = 'cmd=_notify-validate';
			$get_magic_quotes_exists = false;
			if(function_exists('get_magic_quotes_gpc')){
				$get_magic_quotes_exists = true;
			}
			foreach($myPost as $key=>$value){
				if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1){
					$value = urlencode(stripslashes($value));
				}else{
					$value = urlencode($value);
				}
				$req .= "&$key=$value";
			}
			# Post the data back to PayPal, using curl. Throw exceptions if errors occur.
			$ch = curl_init($this->getPaypalUri());
			curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$req);
			curl_setopt($ch,CURLOPT_SSLVERSION,6);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
			# This is often required if the server is missing a global cert bundle, or is using an outdated one.
			if($this->use_local_certs){
				curl_setopt($ch,CURLOPT_CAINFO, __DIR__ ."cert/cacert.pem");
			}
			curl_setopt($ch, CURLOPT_FORBID_REUSE,1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,30);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
			$res = curl_exec($ch);

			if(!($res)){
				$errno = curl_errno($ch);
				$errstr = curl_error($ch);
				curl_close($ch);
				throw new Exception("cURL error: [$errno] $errstr");
			}

			$info = curl_getinfo($ch);

			$http_code = $info['http_code'];

			if($http_code != 200){
				throw new Exception("PayPal responded with http code $http_code");
			}

			curl_close($ch);
			# Check if PayPal verifies the IPN data, and if so, return true.
			if($res == $this->VALID){
				return true;
			}else{
				return false;
			}
		}
	}
?>