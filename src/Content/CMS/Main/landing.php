<?php
	echo '<div class="view">';
		echo '<div class="full-bg-img flex-center">';
			echo '<ul class="black_base">';
				echo '<li style="color:#fff;"><h1 class="h1-responsive wow fadeInDown b_i" data-wow-delay="0.2s">Welcome to '.$this->Setting->SITE_TITLE.'</h1></li>';
				echo '<li class="b_i" style="color:#fff;"><p class="wow fadeInDown" data-wow-delay="0.3s">'.$this->Setting->SITE_TITLE.' features Adult-themed content.</li>';
				echo '<li class="b_i" style="color:#fff;"><p class="wow fadeInDown" data-wow-delay="0.4s">You must be eighteen (18) or older to enter.</li>';
				echo '<li class="b_i" style="color:#fff;"><p class="wow fadeInDown" data-wow-delay="0.5s">Are you 18+?</p></li>';
				echo '<li>';
					echo '<a href="?'.$this->Setting->PAGE_PREFIX.'=Home" class="btn btn-sm btn-success wow fadeInLeft" data-wow-delay="1s">Yes!</a>';
					echo '<a href="https://google.com" class="btn btn-sm btn-danger wow fadeInRight" data-wow-delay="1s">No, get me out of here!</a>';
				echo '</li>';
			echo '</ul>';
		echo '</div>';
	echo '</div>';
?>