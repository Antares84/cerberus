<?php
	#	Require ReCaptcha 2.0 Autoloader
	require_once __DIR__ . '\ReCaptcha_2.0\re-autoload-2.0.php';
	# Register API keys at https://www.google.com/recaptcha/admin
#	$siteKey = '';
	$siteKey = '6LeFmSQTAAAAAP2qgHQ7lTpxXBsPPWSLqbmb9oNK';
	$secret = '6LeFmSQTAAAAAEMdg7EFDAgspl-YweSQ9-6P0Kbh';
	# reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
	$lang = 'en';

	# Content
	if($siteKey === '' || $secret === ''):
		echo '<div id="auth-reg">';
			echo '<h2 class="tac">Error: ReCaptcha Security Unavailable!</h2>';
			echo '<p>ReCaptcha key not found! This is a problem.</p>';
			echo '<p>If you do not already have keys, visit <tt><a href = "https://www.google.com/recaptcha/admin">https://www.google.com/recaptcha/admin</a></tt> to generate them.</p>';
			echo '<p>Update your database configuration and set the respective keys for <tt>siteKey</tt> and <tt>secret</tt>.</p>';
			echo '<p>Once settings for <tt>siteKey</tt> and <tt>secret</tt> are completed, reload this page to continue.</p>';
		echo '</div>';
	elseif (isset($_POST['g-recaptcha-response'])):
		echo '<h2><tt>POST</tt> data</h2>';
		echo '<tt><pre>'.var_export($_POST).'</pre></tt>';
		$recaptcha = new \ReCaptcha\ReCaptcha($secret);

		# Make the call to verify the response and also pass the user's IP address
		$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

	if ($resp->isSuccess()):
		# If the response is a success, that's it!
		echo '<h2>Success!</h2>';
		echo '<p>That is it. Everything is working. Go integrate this into your real project.</p>';
		echo '<p><a href="/">Try again</a></p>';
	else:
		# If it's not successful, then one or more error codes will be returned.
		echo '<h2>Something went wrong</h2>';
		echo '<p>The following error was returned: ';foreach ($resp->getErrorCodes() as $code) {echo '<tt>' , $code , '</tt> ';}echo '</p>';
		echo '<p>Check the error code reference at <tt><a href="https://developers.google.com/recaptcha/docs/verify#error-code-reference">https://developers.google.com/recaptcha/docs/verify#error-code-reference</a></tt>.';
		echo '<p><strong>Note:</strong> Error code <tt>missing-input-response</tt> may mean the user just did not complete the reCAPTCHA.</p>';
		echo '<p><a href="/">Try again</a></p>';
	endif;
	else:
		# Main Content
		echo '<div id="auth-reg">';
			echo '<div class="outer">';
				echo '<div class="inner">';
					if(count($errors)){echo '<div id="dialog-confirm" title="NOTICE">';foreach($errors as $error){echo err_msg_reg($error);}echo '</div>';}
					echo '<div id="formContainer">';
						echo '<div class="bg">';
							echo '<form action="" method="post" id="login" >';
								echo '<p class="tac pt-10 pb-10">Starfleet Temporal D.E.C. | Registration</p>';
								echo '<fieldset>';
									echo '<input type="text" class="tac" name="username" placeholder="Desired UserID" />';
									echo '<input type="password" class="tac" name="password" placeholder="Desired Password" />';
									echo '<input type="password" class="tac" name="password2" placeholder="Re-Enter Desired Password" />';
									echo '<br /><br />';
									echo '<div class="g-recaptcha" data-sitekey="'.$siteKey.'" data-theme="dark"></div>';
									echo '<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl='.$lang.'"></script>';
									echo '<p><input type="submit" value="Submit" /></p>';
								echo '</fieldset>';
							echo '</form>';
						echo '</div>';
					echo '</div>';
				echo '</div>'; ###
			echo '</div>';
		echo '</div>';
	endif;
?>