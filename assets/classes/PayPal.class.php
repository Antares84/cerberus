<?php
	class PayPal{

		public $PAYPAL_DONATE;public $PAYPAL_DEBUG;public $PAYPAL_RECEIVER;
		public $PAYPAL_SANDBOX_URI;public $PAYPAL_STANDARD_URI;public $PAYPAL_URI;
		public $PAYPAL_SANDBOX;public $PAYPAL_CONF_EMAIL;
		private $use_local_certs = false;

		private $VERIFY_URI;private $SANDBOX_VERIFY_URI;
		private $VALID;private $INVALID;

		function __construct($db,$Plugins,$Setting){
			$this->db		=	$db;
			$this->Plugins	=	$Plugins;
			$this->Setting	=	$Setting;

			$this->get_PAYPAL_DEBUG();
			$this->get_PAYPAL_RECEIVER();
			$this->get_PAYPAL_SANDBOX();
			$this->get_PAYPAL_CONF_EMAIL();
			$this->get_PAYPAL_SANDBOX_URI();
			$this->get_PAYPAL_STANDARD_URI();
			$this->PAYPAL_URI();
			

			$this->get_VALID();$this->get_INVALID();
		}
		function _get_PAYPAL_DONATE(){
			$this->PAYPAL_DONATE = $this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_DONATE");
		}
		function get_PAYPAL_DEBUG(){
			$this->PAYPAL_DEBUG = $this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_DEBUG");
		}
		function get_PAYPAL_RECEIVER(){
			$this->PAYPAL_RECEIVER	=	$this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_RECEIVER");
		}
		function get_PAYPAL_SANDBOX(){
			$this->PAYPAL_SANDBOX	=	$this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_SANDBOX");
		}
		function get_PAYPAL_CONF_EMAIL(){
			$this->PAYPAL_CONF_EMAIL	=	$this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_CONF_EMAIL");
		}
		function get_PAYPAL_SANDBOX_URI(){
			$this->PAYPAL_SANDBOX_URI	=	$this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_SANDBOX_URI");
		}
		function get_PAYPAL_STANDARD_URI(){
			$this->PAYPAL_STANDARD_URI	=	$this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_STANDARD_URI");
		}
		function PAYPAL_URI(){
			if($this->PAYPAL_SANDBOX){
				$this->PAYPAL_URI	=	$this->PAYPAL_SANDBOX_URI;
			}
			else{
				$this->PAYPAL_URI	=	$this->PAYPAL_STANDARD_URI;
			}
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
		function get_VALID(){
			$this->VALID = 'VERIFIED';
		}
		function get_INVALID(){
			$this->INVALID = 'INVALID';
		}
		# Sets the IPN verification to sandbox mode (for use when testing,
		# should not be enabled in production).
		# @return void
		public function useSandbox(){
			$this->PAYPAL_SANDBOX;
		}
		# Sets curl to use php curl's built in certs (may be required in some environments).
		# @return void
		public function usePHPCerts(){
			$this->use_local_certs = false;
		}
		# Determine endpoint to post the verification data to.
		# @return string
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
			$raw_post_data = file_get_contents('php://input');
			$raw_post_array = explode('&',$raw_post_data);
			$myPost = array();
			foreach($raw_post_array as $keyval){
				$keyval = explode('=',$keyval);
				if(count($keyval) == 2){
					# Since we do not want the plus in the datetime string to be encoded to a space, we manually encode it.
					if($keyval[0] === 'payment_date'){
						if(substr_count($keyval[1],'+') === 1){
							$keyval[1] = str_replace('+','%2B',$keyval[1]);
						}
					}
					$myPost[$keyval[0]] = urldecode($keyval[1]);
				}
			}
			// Build the body of the verification post request, adding the _notify-validate command.
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
			// Post the data back to PayPal, using curl. Throw exceptions if errors occur.
			$ch = curl_init($this->getPaypalUri());
			curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$req);
			curl_setopt($ch,CURLOPT_SSLVERSION,6);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
			// This is often required if the server is missing a global cert bundle, or is using an outdated one.
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
			// Check if PayPal verifies the IPN data, and if so, return true.
			if($res == $this->VALID){
				return true;
			}else{
				return false;
			}
		}
	}
?>