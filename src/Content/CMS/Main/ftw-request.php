<?php
	# Content
	echo "<section class=\"contract\">";
		echo "<div class=\"container\">";
			echo "<center>";
				echo "<div class=\"quote_request\">";
					#<!-- SHOW ERROR/SUCCESS MESSAGES -->
					echo "<div class=\"field_separator\"></div>";
					echo "<div id=\"messages\" class=\"well col-md-4 tac fn\" ng-show=\"message\">{{message}}</div>";
					echo "<div class=\"field_separator\"></div>";

					#<!-- FORM -->
					echo "<form ng-submit=\"processForm()\" ng-hide=\"message\">";
						echo "<h2>Request A Warranty</h2>";
						echo "<div class=\"mb_20\"></div>";
					# Personal Info
						echo "<h4>Personal Information</h4>";
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\" { 'has-error' : errorsales_code } \">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Sales Code</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-list\"></i></span>";
									echo "<input name=\"sales_code\" placeholder=\"Enter Sales Code\" class=\"form-control\" type=\"text\" ng-model=\"formData.sales_code\">";
									echo "<span class=\"help-block\" ng-show=\"errorsales_code\">{{ errorsales_code }}</span>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						# First Name
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\"{ 'has-error' : errorfirst_name }\">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">First Name *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-user\"></i></span>";
									echo "<input name=\"first_name\" placeholder=\"First Name\" class=\"form-control\" type=\"text\" ng-model=\"formData.first_name\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errorfirst_name\">{{ errorfirst_name }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						# Last Name
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\"{ 'has-error' : errorlast_name }\">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\" >Last Name *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-user\"></i></span>";
									echo "<input name=\"last_name\" placeholder=\"Last Name\" class=\"form-control\" type=\"text\" ng-model=\"formData.last_name\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errorlast_name\">{{ errorlast_name }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						# Phone Number 1
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\" { 'has-error' : errorphone_1 } \">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Primary Phone *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-earphone\"></i></span>";
									echo "<input name=\"phone_1\" id=\"phone_1\" placeholder=\"(999) 999-9999\" class=\"form-control\" type=\"text\" ng-model=\"formData.phone_1\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errorphone_1\">{{ errorphone_1 }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						# Phone Number 2
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\" { 'has-error' : errorphone_2 } \">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Secondary Phone</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-earphone\"></i></span>";
									echo "<input name=\"phone_2\" id=\"phone_2\" placeholder=\"(999) 999-9999\" class=\"form-control\" type=\"text\" ng-model=\"formData.phone_2\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errorphone_2\">{{ errorphone_2 }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						# Address 1
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\" { 'has-error' : erroraddress_1 } \">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Address 1 *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-home\"></i></span>";
									echo "<input name=\"address_1\" placeholder=\"123 Park Ave.\" class=\"form-control\" type=\"text\" ng-model=\"formData.address_1\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"erroraddress_1\">{{ erroraddress_1 }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						# Address 2
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\" { 'has-error' : erroraddress_2 } \">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Address 2</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-home\"></i></span>";
									echo "<input name=\"address_2\" placeholder=\"Apt. Number, etc.\" class=\"form-control\" type=\"text\" ng-model=\"formData.address_2\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"erroraddress_2\">{{ erroraddress_2 }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						
						# City
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\" { 'has-error' : errorcity } \">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">City *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-map-marker\"></i></span>";
									echo "<input name=\"city\" placeholder=\"City\" class=\"form-control\" type=\"text\" ng-model=\"formData.city\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errorcity\">{{ errorcity }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						# State
						echo Display::ds_SelectStates();
						# Zipcode
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\" { 'has-error' : errorzip } \">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Zip Code *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-map-marker\"></i></span>";
									echo "<input name=\"zip\" placeholder=\"01234\" class=\"form-control\" type=\"text\" ng-model=\"formData.zip\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errorzip\">{{ errorzip }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						# E-Mail Address
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\" { 'has-error' : errore_mail } \">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">E-Mail *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-envelope\"></i></span>";
									echo "<input name=\"e_mail\" placeholder=\"E-Mail Address\" class=\"form-control\" type=\"text\" ng-model=\"formData.e_mail\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errore_mail\">{{ errore_mail }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";

					# Vehicle Information
						echo "<h4>Motorcycle Information</h4>";
						# Motorcycle Make
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\"{'has-error':errormot_make}\">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Motorcycle Make *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-list\"></i></span>";
									echo "<input name=\"mot_make\" placeholder=\"Make\" class=\"form-control\" type=\"text\" ng-model=\"formData.mot_make\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errormot_make\">{{ errormot_make }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";

						# Motorcycle Model
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\"{'has-error':errormot_model}\">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Motorcycle Model *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-list\"></i></span>";
									echo "<input name=\"mot_model\" placeholder=\"Model\" class=\"form-control\" type=\"text\" ng-model=\"formData.mot_model\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errormot_model\">{{ errormot_model }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						
						# Motorcycle Year
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\"{ 'has-error' :errormot_year }\">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Motorcycle Year *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-list\"></i></span>";
									echo "<input name=\"mot_year\" placeholder=\"Year\" class=\"form-control\" type=\"text\" ng-model=\"formData.mot_year\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errormot_year\">{{ errormot_year }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						
						# Motorcycle VIN
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\"{ 'has-error' :errormot_vin }\">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Motorcycle VIN</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-list\"></i></span>";
									echo "<input name=\"mot_vin\" placeholder=\"VIN Number\" class=\"form-control\" type=\"text\" ng-model=\"formData.mot_vin\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errormot_vin\">{{ errormot_vin }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						
						# Motorcycle Odometer
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\"{ 'has-error' :errormot_odometer }\">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Motorcycle Odometer *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-list\"></i></span>";
									echo "<input name=\"mot_odometer\" placeholder=\"Motorcycle Odometer\" class=\"form-control\" type=\"text\" ng-model=\"formData.mot_odometer\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errormot_odometer\">{{ errormot_odometer }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";

					# Warranty Options
						echo "<h4>Warranty Options</h4>";
						echo Display::ds_SelectWarrantyOptions();
					# Payment Information
/*						echo "<h4>Payment Information</h4>";
						# Credit Card Number
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\"{ 'has-error' :errorcc_number }\">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Credit Card Number *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-list\"></i></span>";
									echo "<input name=\"cc_number\" placeholder=\"0123 4523 5223 5520\" class=\"form-control\" type=\"text\" ng-model=\"formData.cc_number\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errorcc_number\">{{ errorcc_number }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						
						# Expiration Date
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\"{ 'has-error' :errorcc_exp_date }\">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Expiration Date *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-list\"></i></span>";
									echo "<input name=\"cc_exp_date\" placeholder=\"01/23\" class=\"form-control\" type=\"text\" ng-model=\"formData.cc_exp_date\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errorcc_exp_date\">{{ errorcc_exp_date }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
						
						# Card CV2
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\"{ 'has-error' :errorcc_cv2 }\">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">CV2 Code *</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
								echo "<div class=\"input-group\">";
									echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-list\"></i></span>";
									echo "<input name=\"cc_cv2\" placeholder=\"012\" class=\"form-control\" type=\"text\" ng-model=\"formData.cc_cv2\">";
								echo "</div>";
								echo "<span class=\"help-block\" ng-show=\"errorcc_cv2\">{{ errorcc_cv2 }}</span>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
*/
						# Best Time To Call Block
						echo "<div id=\"name-group\" class=\"form-group\" ng-class=\" { 'has-error' : errorsales_code } \">";
							echo "<label class=\"col-md-4 control-label tar mtb_8_0\">Best Time To Call</label>";
							echo "<div class=\"col-md-4 inputGroupContainer\">";
							#	echo "<div class=\"input-group\">";
									echo "<textarea name=\"sales_comment\" class=\"form-control\" id=\"exampleTextarea\" rows=\"3\" ng-model=\"formData.sales_comment\" placeholder=\"Best Time To Call?\"></textarea>";
									echo "<span class=\"help-block\" ng-show=\"errorsales_comment\">{{ errorsales_comment }}</span>";
							#	echo "</div>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";

						# Submit Form
						echo "<div class=\"form-group\">";
							echo "<label class=\"col-md-4 control-label\"></label>";
							echo "<div class=\"col-md-4\">";
								echo "<button type=\"submit\" class=\"btn btn-warning\" >Send <span class=\"glyphicon glyphicon-send\"></span></button>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"field_separator\"></div>";
					echo "</form>";
				#	echo '<pre>{{ formData }}</pre>';
				echo "</div>";
			echo "</center>";
		echo "</div>";
	echo "</section>";
?>