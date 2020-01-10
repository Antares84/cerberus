<?php
	# Content
	echo '<div class="separator_10"></div>';

	echo '<div class="biker-club-we">';

		echo '<div class="container hidden-sm-down">';
			echo '<div class="row">';
				echo '<div class="col-md-12">';
					echo '<img src="'.$this->Style->IMAGES_DIR().'advertisment.png" class="img-fluid" alt="IMG" />';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		echo '<div class="separator_10"></div>';

		echo '<div class="container">';
			echo '<div class="row event_block m_lr_0">';
				echo '<div class="col-md-4 col-sm-4 col-xs-12 white wow fadeInLeft" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo '<h2><b>Full Throttle</b> Warranty</h2>';
					echo '<h3>UPCOMING EVENTS</h3>';
					echo 'Please see us at your local bike show or call <b>Anthony</b> to advertise your local motorcycle event at no cost. Contact information can be found <a href="?'.$this->Setting->PAGE_PREFIX.'=ContactUs">here</a>.<br><br>Please inquire about paid advertising as well.';
					echo '<div class="separator_10"></div>';

					echo '<center>';
						echo '<button class="btn btn-default">';
							echo '<a class="tac" href="?'.$this->Setting->PAGE_PREFIX.'=Blog&cat=ule">View Our Upcoming Events</a>';
						echo '</button>';
					echo '</center>';
					echo '<div class="separator_10"></div>';
				echo '</div>';

				$sql	=	('
								SELECT TOP 1 *
								FROM '.$this->db->get_TABLE("BLOG_CONTENT").'
								WHERE topic_cat=?
								ORDER BY topic_postdate DESC
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array("ule");
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					while($data=odbc_fetch_array($stmt)){
					echo '<div class="col-md-4 col-xs-12 white wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
						echo '<h3>'.$data["topic_title"].'</h3>';
						echo '<span class="fa fa-map-marker"></span>&nbsp;&nbsp;'.$data["topic_event_address1"].'<br>';
						echo '<span class="fa fa-map-marker"></span>&nbsp;&nbsp;'.$data["topic_event_address2"].'<br>';
						echo '<span class="fa fa-clock-o"></span>&nbsp;'.$data["topic_event_length"].'<br>';
#						echo '<span class="fa fa-calendar-o"></span> "EVENT_START_DATE"';
					echo '</div>';

					echo '<div class="col-md-4 col-xs-12 p_t_b_5 wow fadeInLeft" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					if($this->FS->ds_U_E_IMG($this->Style->EVENTS_DIR().$data["topic_id"]) !== NULL){
						echo '<img src="'.$this->Style->EVENTS_DIR().$data["topic_id"]."/".$this->FS->ds_U_E_IMG($this->Style->EVENTS_DIR().$data["topic_id"]).'" class="img-responsive" id="'.$data["topic_id"].'" alt="Event IMG" />';
					}
					echo '</div>';
					}
				}
			echo '</div>';
		echo '</div>';

		echo '<section class="we-are we-are--home we-are--home2">';
			echo '<div class="container">';
				echo '<h2 class="title title--main wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s"><span class="title__bold">Full Throttle</span> Warranty<span class="line line--title"><span class="line__first"></span><span class="line__second"></span></span></h2>';
				echo '<p class="text text--anons white wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo 'FTW’s Extended Warranty Plan allows you to ride with security against expensive repair costs while on your journey.';
				echo '</p>';
			echo '</div>';
		echo '</section>'; #<!--we-are-->
	echo '</div>'; #<!--biker-club-we-->

	echo '<div class="images">';
		echo '<div class="row row--no-padding">';
			echo '<div class="col-xs-4 wow fadeInLeft" data-wow-delay="0.7s" data-wow-duration="1.5s">';
				echo '<div class="images__one">';
					echo '<img src="'.$this->Style->MEDIA_DIR().'530x360/box_1_3.png" class="img-responsive" alt="bike"/>';
				echo '</div>';
			echo '</div>';
			echo '<div class="col-xs-4 wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
				echo '<div class="images__one">';
					echo '<img src="'.$this->Style->MEDIA_DIR().'530x360/bike2.jpg" class="img-responsive" alt="bike"/>';
				echo '</div>';
			echo '</div>';
			echo '<div class="col-xs-4 wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
				echo '<div class="images__one">';
					echo '<img src="'.$this->Style->MEDIA_DIR().'530x360/box_3_3.png" class="img-responsive" alt="bike"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>'; # images

	echo '<section class="info-blocks info-blocks--home2">';
		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-xs-4 wow fadeInLeft" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo '<div class="info-block">';
						echo '<h3 class="title title--block"><span class="title__bold">TOP </span>Class</h3>';
						echo '<p class="text">
							No Dealership Inspection required for purchase.<br>
							30 Days and 500 miles later your coverage begins.<br>
							<h5 style="margin-left:75px;color:#fff !important;">FAST EASY CLAIMS</h5>
							<br>
						</p>';
						echo '<a href="?'.$this->Setting->PAGE_PREFIX.'=Contract" class="btn button button--red button--main">Read More</a>';
					echo '</div>';
				echo '</div>';
				echo '<div class="col-xs-4 wow fadeInDown" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo '<div class="info-block">';
						echo '<h3 class="title title--block"><span class="title__bold">Warranty </span>Options</h3>';
						echo '<p class="text">
							1-5 Year Factory Warranty<br>
							Approximate pricing based on year, make & model of your motorcycle.*<br>
							Warranties are refundable and transferable<br>
							<small>*Small Fee applies</small>
						</p>';
#						echo '<a href="article.html" class="btn button button--red button--main">Read More</a>';
					echo '</div>';
				echo '</div>';
				echo '<div class="col-xs-4 wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo '<div class="info-block">';
						echo '<h3 class="title title--block"><span class="title__bold">Additional</span> Services</h3>';
						echo '<p class="text">';
							echo 'Did you know that parts and components under your contract are identical to those covered by the Original Vehicle manufacturers warranty?';
						echo '</p>';
						echo '<p class="text">';
							echo 'In addition to the warranty, if your motorcycle requires repair due to a breakdown, we will reimburse you for a rental for up to 5 days.';
						echo '</p>';
						echo '<p class="text">';
							echo 'We will also pay or reimburse you for towing, and if you are more than 100 miles away from home, we will reimburse you for hotel and food expenses for up to five (5) days. (See contract for details.)
						</p>';
					#	echo '<a href="article.html" class="btn button button--red button--main">Read More</a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</section>'; # info-blocks

	#Plugins::get_plugin_numbers();

	/* echo '<div class="home-reviews dark-bg">';
		echo '<div class="container">';
			echo '<div class="home-reviews__quote triangle triangle--services"><span class="fa  fa-quote-right"></span></div>';
			echo '<div class="owl-carousel js-home-reviews enable-owl-carousel" data-auto-play="5000" data-stop-on-hover="true" data-items="2" data-pagination="true" data-navigation="false" data-items-desktop="2" data-items-desktop-small="2" data-items-tablet="1" data-items-tablet-small="1" >';
				echo '<div>';
					echo '<div class="home-reviews__review wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
						echo '<div class="home-reviews__person">';
							echo '<div class="person person--first"></div>';
						echo '</div>';
						echo '<div class="home-reviews__text">';
							echo '<p>Proin blandit quam molestie luctus vehicula orci massa interdum justo nec rutrum risus augue ut nisl  ultric lacu at  Etiam eleifend nisl nec lectus aecen as sit amet donec erat. Fusce quis nisl ac sapien tristiqu</p>';
						echo '</div>';
						echo '<div class="home-reviews__author">';
							echo 'Martin Hasman';
						echo '</div>';
						echo '<div class="home-reviews__position">';
							echo 'Owner Ducati S600VX';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div>';
					echo '<div class="home-reviews__review wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
						echo '<div class="home-reviews__person">';
							echo '<div class="person person--second"></div>';
						echo '</div>';
						echo '<div class="home-reviews__text">';
							echo '<p>Proin blandit quam molestie luctus vehicula orci massa interdum justo nec rutrum risus augue ut nisl  ultric lacu at  Etiam eleifend nisl nec lectus aecen as sit amet donec erat. Fusce quis nisl ac sapien tristiqu</p>';
						echo '</div>';
						echo '<div class="home-reviews__author">';
							echo 'Ben Thomas';
						echo '</div>';
						echo '<div class="home-reviews__position">';
							echo 'Owner Honda CB1000R';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div>';
					echo '<div class="home-reviews__review wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
						echo '<div class="home-reviews__person">';
							echo '<div class="person person--first"></div>';
						echo '</div>';
						echo '<div class="home-reviews__text">';
							echo '<p>Proin blandit quam molestie luctus vehicula orci massa interdum justo nec rutrum risus augue ut nisl  ultric lacu at  Etiam eleifend nisl nec lectus aecen as sit amet donec erat. Fusce quis nisl ac sapien tristiqu</p>';
						echo '</div>';
						echo '<div class="home-reviews__author">';
							echo 'Martin Hasman';
						echo '</div>';
						echo '<div class="home-reviews__position">';
							echo 'Owner Ducati S600VX';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div>';
					echo '<div class="home-reviews__review wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
						echo '<div class="home-reviews__person">';
							echo '<div class="person person--second"></div>';
						echo '</div>';
						echo '<div class="home-reviews__text">';
							echo '<p>Proin blandit quam molestie luctus vehicula orci massa interdum justo nec rutrum risus augue ut nisl ultric lacu at Etiam eleifend nisl nec lectus aecen as sit amet donec erat. Fusce quis nisl ac sapien tristiqu</p>';
						echo '</div>';
						echo '<div class="home-reviews__author">';
							echo 'Ben Thomas';
						echo '</div>';
						echo '<div class="home-reviews__position">';
							echo 'Owner Honda CB1000R';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>'; # home-reviews */

	/*
	echo '<section class="services">';
		echo '<div class="container">';
			echo '<div class="services__main">';
				echo '<h2 class="title title--main wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s"><span class="title__bold">Biker</span>ClubServices<span class="line line--title"><span class="line__first"></span><span class="line__second"></span></span></h2>';
				echo '<p class="text text--anons wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">Nullam ac velit. Fusce consequat ipsum non ipsum. Nam ullamcorper ipsum quis erat. Aliquam non elit. In vitae dui sagittis cursus. Duis convallis rutrum mauris. Maecenas eu neque lacinia.</p>';
				echo '<div class="row">';
					echo '<div class="col-sm-7 col-xs-12 wow fadeInLeft" data-wow-delay="0.7s" data-wow-duration="1.5s">';
						echo '<div class="services__img">';
							echo '<img class="img-responsive" src="'.$this->Style->MEDIA_DIR().'motorcycles/moto-red.png" alt="bike" />';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-sm-5 col-xs-12 wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
						echo '<div class="services__info">';
							echo '<div class="services__info-block wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
								echo '<h5 class="clearfix services__title"><a class="pull-left no-decoration js-toggle" href="#">Motorcycle Inspection</a><a class="square square--toggle pull-right js-toggle"><span class="fa fa-plus"></span></a></h5>';
								echo '<div class="services__text triangle triangle--services">Nunc molestie sapien tempor placerat Cras et lectus. Etiam sit amet turpis. Suspendisse et erat. Ut  Proin a ipsum vitae orci porta tristique nam. Class aptent taciti sociosqu ad sodales f';
								echo '</div>';
							echo '</div>';
							echo '<div class="services__info-block wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
								echo '<h5 class="clearfix services__title"><a class="pull-left no-decoration js-toggle" href="#">Finance And Insurance</a><a class="square square--toggle pull-right js-toggle"><span class="fa fa-plus"></span></a></h5>';
								echo '<div class="services__text triangle triangle--services">Nunc molestie sapien tempor placerat Cras et lectus. Etiam sit amet turpis. Suspendisse et erat. Ut  Proin a ipsum vitae orci porta tristique nam. Class aptent taciti sociosqu ad sodales f';
								echo '</div>';
							echo '</div>';
							echo '<div class="services__info-block wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
								echo '<h5 class="clearfix services__title"><a class="pull-left no-decoration js-toggle" href="#">Ready For the Racing</a><a class="square square--toggle pull-right js-toggle"><span class="fa fa-plus"></span></a></h5>';
								echo '<div class="services__text triangle triangle--services">Nunc molestie sapien tempor placerat Cras et lectus. Etiam sit amet turpis. Suspendisse et erat. Ut  Proin a ipsum vitae orci porta tristique nam. Class aptent taciti sociosqu ad sodales f';
								echo '</div>';
							echo '</div>';
							echo '<div class="services__info-block wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
								echo '<h5 class="clearfix services__title"><a class="pull-left no-decoration js-toggle" href="#">Tyre And Oil Change</a><a class="square square--toggle pull-right js-toggle"><span class="fa fa-plus"></span></a></h5>';
								echo '<div class="services__text triangle triangle--services">Nunc molestie sapien tempor placerat Cras et lectus. Etiam sit amet turpis. Suspendisse et erat. Ut  Proin a ipsum vitae orci porta tristique nam. Class aptent taciti sociosqu ad sodales f';
								echo '</div>';
							echo '</div>';
							echo '<div class="services__info-block wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
								echo '<h5 class="clearfix services__title"><a class="pull-left no-decoration js-toggle" href="#">Parts Replacement</a><a class="square square--toggle pull-right js-toggle"><span class="fa fa-plus"></span></a></h5>';
								echo '<div class="services__text triangle triangle--services">Nunc molestie sapien tempor placerat Cras et lectus. Etiam sit amet turpis. Suspendisse et erat. Ut  Proin a ipsum vitae orci porta tristique nam. Class aptent taciti sociosqu ad sodales f';
								echo '</div>';
							echo '</div>';
							echo '<div class="services__info-block wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
								echo '<h5 class="clearfix services__title"><a class="pull-left no-decoration js-toggle" href="#"> Accident Repairs And Quotes</a><a class="square square--toggle pull-right js-toggle"><span class="fa fa-plus"></span></a></h5>';
								echo '<div class="services__text triangle triangle--services">Nunc molestie sapien tempor placerat Cras et lectus. Etiam sit amet turpis. Suspendisse et erat. Ut  Proin a ipsum vitae orci porta tristique nam. Class aptent taciti sociosqu ad sodales f';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</section>'; # services
	*/

	/* echo '<section class="listings">';
		echo '<div class="container">';
			echo '<header class="tab-header clearfix wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
				echo '<h2 class="title title--main pull-left"><span class="title__bold">Biker</span>ClubListings<span class="line line--title"><span class="line__first"></span><span class="line__second"></span></span></h2>';
				echo '<div class="tab-toggles pull-right js-isotope-btns">';
					echo '<a href="#" class="button button--grey button--main btn js-isotope-btn" data-sort-by="name">BY TYPE</a>';
					echo '<a href="#" class="button button--grey button--main btn button--active js-isotope-btn" data-sort-by="original-order">BY NEWEST</a>';
				echo '</div>';
			echo '</header>';
			echo '<p class="text text--anons wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">Nullam ac velit. Fusce consequat ipsum non ipsum. Nam ullamcorper ipsum quis erat. Aliquam non elit. In vitae dui sagittis cursus. Duis convallis rutrum mauris. Maecenas eu neque lacinia.</p>';
			echo '<div class="row isotope">';
				echo '<div class="col-md-3 col-xs-6 isotope-item wow fadeInLeft" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo '<a href="shop.html" class="listing-anons equal-height-item listing-anons--home triangle triangle--big line-down no-decoration">';
						echo '<div class="listing-anons__img">';
							echo '<img src="'.$this->Style->MEDIA_DIR().'270x230/listing1.jpg" class="img-responsive" alt="bike" />';
						echo '</div>';
						echo '<div class="listing-anons__title">';
							echo '<h4 class="name">DIRT BIKE MOTORCYCLES</h4>';
						echo '</div>';
						echo '<div class="listing-anons__hidden">';
							echo '<h3>DIRT BIKE MOTORCYCLES</h3>';
							echo '<p>Nunc molestie sapien temporplace</p>';
						echo '</div>';
					echo '</a>';
				echo '</div>';
				echo '<div class="col-md-3 col-xs-6 isotope-item wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo '<a href="shop.html" class="listing-anons equal-height-item listing-anons--home triangle triangle--big line-down no-decoration">';
						echo '<div class="listing-anons__img">';
							echo '<img src="'.$this->Style->MEDIA_DIR().'270x230/listing3.jpg" class="img-responsive" alt="bike" />';
						echo '</div>';
						echo '<div class="listing-anons__title">';
							echo '<h4 class="name">SPORTBIKE MOTORCYCLES</h4>';
						echo '</div>';
						echo '<div class="listing-anons__hidden">';
							echo '<h3>SPORTBIKE MOTORCYCLES</h3>';
							echo '<p>Nunc molestie sapien temporplace</p>';
						echo '</div>';
					echo '</a>';
				echo '</div>';
				echo '<div class="col-md-3 col-xs-6 isotope-item wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo '<a href="shop.html" class="listing-anons equal-height-item listing-anons--home triangle triangle--big line-down no-decoration">';
						echo '<div class="listing-anons__img">';
							echo '<img src="'.$this->Style->MEDIA_DIR().'270x230/listing4.jpg" class="img-responsive" alt="bike" />';
						echo '</div>';
						echo '<div class="listing-anons__title">';
							echo '<h4 class="name">CRUISER BIKES</h4>';
						echo '</div>';
						echo '<div class="listing-anons__hidden">';
							echo '<h3>CRUISER BIKES</h3>';
							echo '<p>Nunc molestie sapien temporplace</p>';
						echo '</div>';
					echo '</a>';
				echo '</div>';
				echo '<div class="col-md-3 col-xs-6 isotope-item wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo '<a href="shop.html" class="listing-anons equal-height-item listing-anons--home triangle triangle--big line-down no-decoration">';
						echo '<div class="listing-anons__img">';
							echo '<img src="'.$this->Style->MEDIA_DIR().'270x230/listing2.jpg" class="img-responsive" alt="bike" />';
						echo '</div>';
						echo '<div class="listing-anons__title">';
							echo '<h4 class="name">MINI &amp; POCKET BIKES</h4>';
						echo '</div>';
						echo '<div class="listing-anons__hidden">';
							echo '<h3>MINI &amp; POCKET BIKES</h3>';
							echo '<p>Nunc molestie sapien temporplace</p>';
						echo '</div>';
					echo '</a>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</section>'; # listings */

	echo '<section class="blog blog--home">';
		echo '<div class="container-fluid no-padding">';
			echo '<div class="row row--no-padding">';
				echo '<div class="col-lg-2 col-xs-12 wow fadeInLeft" data-wow-delay="0.7s" data-wow-duration="1.5s">';
			#		echo '<div class="blog__info">';
			#			echo '<h2 class="title title--main"><span class="title__bold">FTW</span> Blog<span class="line line--small"><span class="line__second"></span><span class="line__first"></span></span></h2>';
					#	echo '<p class="text">Nullam ac velit. Fusce consequat ipsum non ipsum. Nam ullamcorper ipsum quis erat am non sed ipsum elit.</p>';
			#			echo '<a href="?'.$this->Setting->PAGE_PREFIX.'=Blog" class="button btn button--main button--red">VISIT BLOG</a>';
			#		echo '</div>';
				echo '</div>';
				echo '<div class="col-lg-8 col-xs-12">';
					echo '<div class="row row--no-padding">';
						echo '<div class="col-sm-6 col-xs-12 wow fadeInDown" data-wow-delay="0.7s" data-wow-duration="1.5s">';
						#	echo '<a href="#" class="blog-anons no-decoration">';
								echo '<div class="blog-anons__img">';
									echo '<img src="'.$this->Style->MEDIA_DIR().'575x250/blog-anons1.jpg" class="img-responsive" alt="bike" />';
								echo '</div>';
						#		echo '<div class="blog-anons__hidden triangle triangle--bigger">';
						#			echo '<div class="blog-anons__text">';
						#				echo '<h3>AUGUE DUI CONVALLIS VAMUS</h3>';
						#				echo '<div class="blog-anons__info">';
						#					echo '<span><span class="fa fa-calendar-o"></span>MAR 23, 2015</span>';
						#					echo '<span><span class="fa fa-comment-o"></span>20</span>';
						#				echo '</div>';
						#			echo '</div>';
						#		echo '</div>';
						#	echo '</a>';
						echo '</div>';
						echo '<div class="col-sm-6 col-xs-12 wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
						#	echo '<a href="#" class="blog-anons no-decoration">';
								echo '<div class="blog-anons__img">';
									echo '<img src="'.$this->Style->MEDIA_DIR().'575x250/box_2_4.png" class="img-responsive" alt="bike" />';
								echo '</div>';
						#		echo '<div class="blog-anons__hidden triangle triangle--bigger">';
						#			echo '<div class="blog-anons__text">';
						#				echo '<h3>AUGUE DUI CONVALLIS VAMUS</h3>';
						#				echo '<div class="blog-anons__info">';
						#					echo '<span><span class="fa fa-calendar-o"></span>MAR 23, 2015</span>';
						#					echo '<span><span class="fa fa-comment-o"></span>20</span>';
						#				echo '</div>';
						#			echo '</div>';
						#		echo '</div>';
						#	echo '</a>';
						echo '</div>';
						echo '<div class="col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
						#	echo '<a href="#" class="blog-anons no-decoration">';
								echo '<div class="blog-anons__img">';
									echo '<img src="'.$this->Style->MEDIA_DIR().'575x250/box_3_4.png" class="img-responsive" alt="bike" />';
								echo '</div>';
						#		echo '<div class="blog-anons__hidden triangle triangle--bigger">';
						#			echo '<div class="blog-anons__text">';
						#				echo '<h3>AUGUE DUI CONVALLIS VAMUS</h3>';
						#				echo '<div class="blog-anons__info">';
						#					echo '<span><span class="fa fa-calendar-o"></span>MAR 23, 2015</span>';
						#					echo '<span><span class="fa fa-comment-o"></span>20</span>';
						#				echo '</div>';
						#			echo '</div>';
						#		echo '</div>';
						#	echo '</a>';
						echo '</div>';
						echo '<div class="col-sm-6 col-xs-12 wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
						#	echo '<a href="#" class="blog-anons no-decoration">';
								echo '<div class="blog-anons__img">';
									echo '<img src="'.$this->Style->MEDIA_DIR().'575x250/blog-anons4.jpg" class="img-responsive" alt="bike" />';
								echo '</div>';
						#		echo '<div class="blog-anons__hidden triangle triangle--bigger">';
						#			echo '<div class="blog-anons__text">';
						#				echo '<h3>AUGUE DUI CONVALLIS VAMUS</h3>';
						#				echo '<div class="blog-anons__info">';
						#					echo '<span><span class="fa fa-calendar-o"></span>MAR 23, 2015</span>';
						#					echo '<span><span class="fa fa-comment-o"></span>20</span>';
						#				echo '</div>';
						#			echo '</div>';
						#		echo '</div>';
						#	echo '</a>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</section>'; # blog

/*
	echo '<section class="partners">';
		echo '<div class="container">';
			echo '<h2 class="title title--main wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s"><span class="title__bold">Biker</span> Club\'s Trusted Partners<span class="line line--title line--center"><span class="line__first"></span><span class="line__second"></span></span></h2>';
			echo '<p class="text--small wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">Nullam ac velit. Fusce consequat ipsum non ipsum. Nam ullamcorper ipsum quis erat. Aliquam non elit vitae dui sagittis cursus. Duis convallis rutrum mauris. Maecenas eu neque lacinia.</p>';
			echo '<div class="row">';
				echo '<div class="col-xs-10 col-xs-offset-1 wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo '<div class="brand">';
						echo '<img src="'.$this->Style->MEDIA_DIR().'logos/luxe.png" alt="brand" />';
					echo '</div>';
					echo '<div class="brand">';
						echo '<img src="'.$this->Style->MEDIA_DIR().'logos/wuezon.png" alt="brand" />';
					echo '</div>';
					echo '<div class="brand">';
						echo '<img src="'.$this->Style->MEDIA_DIR().'logos/motox.png" alt="brand" />';
					echo '</div>';
					echo '<div class="brand">';
						echo '<img src="'.$this->Style->MEDIA_DIR().'logos/dna.png" alt="brand" />';
					echo '</div>';
					echo '<div class="brand">';
						echo '<img src="'.$this->Style->MEDIA_DIR().'logos/mint.png" alt="brand" />';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</section>'; # partners
*/

	echo '<section class="signup">';
		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-lg-5 col-md-6 col-xs-12 wow fadeInLeft" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo '<div class="signup__desc">';
						echo '<h2 class="title title--main">';
							echo '<span class="fa fa-envelope-o"></span>';
							echo '<span class="title__bold black">Newsletter</span>';
						echo '</h2>';
						echo '<p class="text--small">Subscribe to our weekly newsletter to get notified and stay updated with the latest <b>FTW</b> news and sporting events.</p>';
					echo '</div>';
				echo '</div>';
				echo '<div class="col-lg-7 col-md-6 col-xs-12 wow fadeInRight" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo '<form action="/" method="post" class="sign-form">';
						echo '<div class="relative-pos">';
							echo '<div class="input-triangle"></div>';
							echo '<input class="sign-input" type="text" name="sign" placeholder="Enter your email address" />';
						echo '</div>';
						echo '<button type="submit" class="btn button button--red button--sign triangle triangle--12">SUBSCRIBE</button>';
					echo '</form>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</section>'; # signup
?>