<?php
	# Content
	echo "<div id=\"page-wrapper\">";
		echo "<div class=\"container-fluid\">";
			echo "<div class=\"row\">";
				echo "<div class=\"col-lg-12\">";
					echo '<h1 class="page-header">'.$Settings->PageTitle;if(!empty($Settings->PageSub)){echo '<small> - '.$Settings->PageSub.'</small>';}echo '</h1>';
					echo "<ol class=\"breadcrumb\">";
						echo "<li class=\"active\"><i class=\"fa fa-dashboard\"></i>  <a href=\"?id=Dashboard\">Dashboard</a></li>";
					echo "</ol>";
					echo "<div class=\"black_base bordered_tf_lc_rc_bc\">";
						echo "<div id=\"title\" class=\"tac\">Welcome</div>";
						echo "<div id=\"content-wrapper\">";
							echo "<p>";
								echo "The folder <b>SQL</b> has been detected at <i>add dirname</i>.<br>";
								echo "Please run any scripts that you find in the <b>SQL</b> folder, and then delete it in order to continue.";
							echo "</p>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
?>