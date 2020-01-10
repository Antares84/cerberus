<?php
#	echo '<div class="view">';
#		echo '<div class="full-bg-img flex-center">';
#			echo '<ul class="black_base">';
#				echo '<li style="color:#fff;"><h1 class="h1-responsive wow fadeInDown b_i" data-wow-delay="0.2s">'.$this->Setting->SITE_TITLE.'</h1></li>';
#				echo '<li class="b_i" style="color:#fff;"><p class="wow fadeInDown" data-wow-delay="0.3s">We are currently under maintenance.</p></li>';
#				echo '<li class="b_i" style="color:#fff;"><p class="wow fadeInDown" data-wow-delay="0.4s">Please check back later.</p></li>';
#			echo '</ul>';
#		echo '</div>';
#	echo '</div>';

	echo '<div class="view">';
		echo '<video class="video-intro" poster="https://mdbootstrap.com/img/Photos/Others/background.jpg" playsinline autoplay muted loop>';
			echo '<source src="https://mdbootstrap.com/img/video/Lines-min.mp4" type="video/mp4">';
		echo '</video>';

		echo '<div class="mask rgba-black-light d-flex justify-content-center align-items-center">';
			echo '<div class="text-center white-text mx-5 wow fadeIn">';
				echo '<h1 class="display-4 mb-4">';
					echo '<strong>Maintenance Underway</strong>';
				echo '</h1>';

				echo '<p id="time-counter" class="border border-light my-4"></p>';

				echo '<h4 class="mb-4">';
					echo '<strong>We\'re working hard to finish the updates for this site.</strong>';
				echo '</h4>';

				echo '<h4 class="mb-4 d-none d-md-block">';
				#	echo '<strong>Until then have a look at our Free Bootstrap 4 tutorials</strong>';
				echo '</h4>';

			#	echo '<a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-lg">Start free tutorial';
			#		echo '<i class="fa fa-graduation-cap ml-2"></i>';
			#	echo '</a>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>