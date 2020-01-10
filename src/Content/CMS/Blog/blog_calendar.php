<?php
	if(!isset($_GET["calendar_id"])) {
		$result = $this->Calendar->getDefaultCalendar();
	}else{
		$result = $this->Calendar->setCalendar($_GET["calendar_id"]);
	}

	# Content
	echo '<div class="blog-page">';
		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-md-9 col-sm-8 col-xs-7">'; ?>
					<script language="javascript" type="text/javascript">
						var today = new Date();
						var currentMonth;
						var currentYear = today.getFullYear();
						var pageX;
						var pageY;

						var events_day_white_bg = '<?php echo $this->Colors->getDayWhiteBg(); ?>';
						var events_day_white_bg_hover = '<?php echo $this->Colors->getDayWhiteBgHover(); ?>';
						var events_day_black_bg = '<?php echo $this->Colors->getDayBlackBg(); ?>';
						var events_day_black_bg_hover = '<?php echo $this->Colors->getDayBlackBgHover(); ?>';
						var events_day_white_line1_color = '<?php echo $this->Colors->getDayWhiteLine1Color(); ?>';
						var events_day_white_line1_color_hover = '<?php echo $this->Colors->getDayWhiteLine1ColorHover(); ?>';
						var events_day_white_line2_color = '<?php echo $this->Colors->getDayWhiteLine2Color(); ?>';
						var events_day_white_line2_color_hover = '<?php echo $this->Colors->getDayWhiteLine2ColorHover(); ?>';
						var events_day_black_line1_color = '<?php echo $this->Colors->getDayBlackLine1Color(); ?>';
						var events_day_black_line1_color_hover = '<?php echo $this->Colors->getDayBlackLine1ColorHover(); ?>';
						var events_day_black_line2_color = '<?php echo $this->Colors->getDayBlackLine2Color(); ?>';
						var events_day_black_line2_color_hover = '<?php echo $this->Colors->getDayBlackLine2ColorHover(); ?>';
						var events_calendar_list_buttons_bg = '<?php echo $this->Colors->getCalendarListButtonsBg(); ?>';
						var events_calendar_list_buttons_bg_hover = '<?php echo $this->Colors->getCalendarListButtonsBgHover(); ?>';
						var events_calendar_list_buttons_color = '<?php echo $this->Colors->getCalendarListButtonsColor(); ?>';
						var events_calendar_list_buttons_color_hover = '<?php echo $this->Colors->getCalendarListButtonsColorHover(); ?>';

						(function($){
							<?php if(isset($_GET["_escaped_fragment_"]) && $_GET["_escaped_fragment_"]!=''){ ?>
								queryStr = '<?php echo $_GET["_escaped_fragment_"];?>';
								arrParam = queryStr.split("_");
								openEvent(arrParam[1],arrParam[2],arrParam[3],arrParam[4],arrParam[5],arrParam[6]);
								getMonthName(arrParam[2]);
							<?php }else{ ?>
								//check pathname to load events from external link
								var pathname = window.location.toString();
								var n = pathname.indexOf("!");
								var queryStr = "";
								if(n >= 0){
									queryStr=pathname.substring((n + 1),pathname.length);
									arrParam = queryStr.split("_");

									openEvent(arrParam[1],arrParam[2],arrParam[3],arrParam[4],arrParam[5],arrParam[6]);
									getMonthName(arrParam[2]);
								}else{
									getMonthName(today.getMonth()+1);
									<?php if(!isset($_GET["action"])){
										if($this->Calendar->getEventsDefaultView() == '1'){ ?>
											getMonthCalendar((today.getMonth() + 1),today.getFullYear(),'<?php echo $this->Calendar->getCalendarId(); ?>');
										<?php }else{ ?>
											getMonthName(today.getMonth() + 1);
											getMonthCalendar((today.getMonth() + 1),today.getFullYear(),'<?php echo $this->Calendar->getCalendarId(); ?>');
											getEventsHomeList(<?php echo $this->Calendar->getCalendarId(); ?>,1,'<?php echo $this->Lang->getListViewOption(); ?>','<?php echo $this->Lang->getListViewShowMonth(); ?>');
										<?php
										}
									} ?>
									$('#calendar_id').val('<?php echo $this->Calendar->getCalendarId(); ?>');
								}
							<?php } ?>
							$("#search_field").keyup(function(event){
								if(event.keyCode == 13){
									$("#search_button").click();
								}
							});
							$('#search_button').bind('click',function(){
								searchEventsList($('#search_field').val(),$('#calendar_id').val(),1);
							});

							<?php if(isset($_GET["action"])){
								switch($_GET["action"]){
									case 'eventslist':
										if(isset($_GET["filter"])){ ?>
											getEventsHomeList(<?php echo $_GET["calendar_id"]; ?>,<?php echo $_GET["pag"]; ?>,'<?php echo $_GET["filter"]; ?>','<?php echo $this->Colors->getListViewShowMonth(); ?>');
										<?php }else if(isset($_GET["text"])){ ?>
											searchEventsList('<?php echo $_GET["text"]; ?>',<?php echo $_GET["calendar_id"]; ?>,<?php echo $_GET["pag"]; ?>);
										<?php }else{ ?>
											getMonthName(<?php echo $_GET["month"]; ?>);
											getEventsList(<?php echo $_GET["year"]; ?>,<?php echo $_GET["month"]; ?>,<?php echo $_GET["day"]; ?>,<?php echo $_GET["calendar_id"]; ?>,<?php echo $_GET["pag"]; ?>);
										<?php }
									break;
									case 'closeevents':
										if(isset($_GET["filter"])){ ?>
											getEventsHomeList(<?php echo $_GET["calendar_id"]; ?>,<?php echo $_GET["pag"]; ?>,'<?php echo $_GET["filter"]; ?>','<?php echo $this->Colors->getListViewShowMonth(); ?>');
										<?php }else if(isset($_GET["text"])){
											if($this->Colors->getEventsDefaultView() == '1'){ ?>
												closeEvents(<?php echo date('Y'); ?>,<?php echo date('m'); ?>,<?php echo date('d'); ?>,<?php echo $_GET["calendar_id"]; ?>);
											<?php }else{ ?>
												getEventsHomeList(<?php echo $_GET["calendar_id"]; ?>,1,'<?php echo $this->Colors->getListViewOption(); ?>','<?php echo $this->Colors->getListViewShowMonth(); ?>');
											<?php }
										}else{ ?>
											closeEvents(<?php echo $_GET["year"]; ?>,<?php echo $_GET["month"]; ?>,<?php echo $_GET["day"]; ?>,<?php echo $_GET["calendar_id"]; ?>);
										<?php }
									break;
								}
							} ?>
						});

						function getMonthName(month){
							var m = new Array();
							m[0] ="<?php echo $this->Lang->getLabel("JANUARY"); ?>";
							m[1] ="<?php echo $this->Lang->getLabel("FEBRUARY"); ?>";
							m[2] ="<?php echo $this->Lang->getLabel("MARCH"); ?>";
							m[3] ="<?php echo $this->Lang->getLabel("APRIL"); ?>";
							m[4] ="<?php echo $this->Lang->getLabel("MAY"); ?>";
							m[5] ="<?php echo $this->Lang->getLabel("JUNE"); ?>";
							m[6] ="<?php echo $this->Lang->getLabel("JULY"); ?>";
							m[7] ="<?php echo $this->Lang->getLabel("AUGUST"); ?>";
							m[8] ="<?php echo $this->Lang->getLabel("SEPTEMBER"); ?>";
							m[9] ="<?php echo $this->Lang->getLabel("OCTOBER"); ?>";
							m[10] ="<?php echo $this->Lang->getLabel("NOVEMBER"); ?>";
							m[11] ="<?php echo $this->Lang->getLabel("DECEMBER"); ?>";
							$('#month_name').html(m[(month-1)]);
							currentMonth = month;
						}

						function setCalendar(calendar_id){
							if($('#events_home_container').css('display') == 'block'){
								getEventsHomeList(calendar_id,1,'<?php echo $this->Lang->getListViewOption(); ?>','<?php echo $this->Lang->getListViewShowMonth(); ?>');
							}else{
								getMonthCalendar((today.getMonth()+1),today.getFullYear(),calendar_id);
							}
							$('#calendar_id').val(calendar_id);
						}
					</script> <?php
					#<!-- ===============================================================
					#box preview available time slots
					#================================================================ -->
					echo '<div class="box_preview_container_all" id="box_slots" style="display:none">';
						echo '<div class="box_preview_title" id="popup_title">';
							echo $this->Lang->getLabel("INDEX_EVENTS_PREVIEW");
						echo '</div>';
						echo '<div class="box_preview_events_container" id="events_popup"></div>';
					echo '</div>';

					#<!-- ===============================================================
					#events calendar begins here
					#================================================================ -->
					echo '<div class="main_container" id="container_all">';
						#<!-- =======================================
						#header (month + navigation + select)
						#======================================== -->
						echo '<div class="header_container">';
							#<!-- month and navigation -->
							$display = "";
							if($this->Lang->getEventsDefaultView() == '0' && $this->Lang->getListViewShowMonth() == '0'){
								$display="display:none";
							}
							echo '<div class="month_container_all">';
								echo '<div id="navigation_container" style="'.$display.'">';
									#<!-- month -->
									echo '<div class="month_container month_container_custom">';
										echo '<div class="font_custom month_name month_name_custom" id="month_name"></div>';
										echo '<div class="font_custom month_year year_name_custom" id="month_year"></div>';
									echo '</div>';
									#<!-- navigation -->
									echo '<div class="month_nav_container" id="month_nav">';
										echo '<div class="mont_nav_button_container" id="month_nav_prev">';
											echo '<a href="javascript:getPreviousMonth('.$this->Calendar->getCalendarId().');" class="month_nav_button month_nav_button_prev month_navigation_button_custom"><img src="'.$this->Style->get_STYLE_IMAGES_DIR().'calendar/prev.png" /></a>';
										echo '</div>';
										echo '<div class="mont_nav_button_container" id="month_nav_next">';
											echo '<a href="javascript:getNextMonth('.$this->Calendar->getCalendarId().');" class="month_nav_button month_nav_button_next month_navigation_button_custom"><img src="'.$this->Style->get_STYLE_IMAGES_DIR().'calendar/next.png" /></a>';
										echo '</div>';
									echo '</div>';
									echo '<div class="cleardiv"></div>';
								echo '</div>';
								if($this->Lang->getShowViewButtons() == 1){
									#<!-- view type -->
									echo '<div class="view_type_container" id="view_buttons">';
										echo '<div class="view_type_button">';
											echo "<a href=\"javascript:getCalendarView((today.getMonth()+1),today.getFullYear(),$('#calendar_id').val());\" style=\"background-color:".$this->Colors->getCalendarListButtonsBgHover()."\" id=\"view_calendar\" class=\"calendar_list_buttons_style\">".$this->Lang->getLabel("VIEW_CALENDAR")."</a>";
										echo '</div>';
										echo '<div class="view_type_button">';
											echo "<a href=\"javascript:getEventsHomeList($('#calendar_id').val(),1,'".$this->Lang->getListViewOption()."','".$this->Lang->getListViewShowMonth()."');\" id=\"view_list\" class=\"calendar_list_buttons_style\">".$this->Lang->getLabel("VIEW_LIST")."</a>";
										echo '</div>';
										echo '<div class="cleardiv"></div>';
									echo '</div>';
								}
							echo '</div>';
							echo '<input type="hidden" name="calendar_id" id="calendar_id" value="" />';
							echo '<div class="select_search_container">';
								if($this->Lang->getShowCalendarSelection() == 1){
									#<!-- select -->
									echo '<div class="select_container_all">';
										echo '<div class="select_calendar_container" id="calendar_select">';
											$arrayCalendars = $this->Lists->getCalendarsList('ORDER BY CalendarOrder');
											if(count($arrayCalendars) > 0){
												echo '<select name="calendar" onchange="javascript:setCalendar(this.options[this.selectedIndex].value);">';
													foreach($arrayCalendars as $calendarId => $calendar){
														echo '<option value="'.$calendarId.'"';
														if($calendarId == $calendarObj->getCalendarId()){
															echo "selected";
														}
														echo '>'.$calendar["calendar_title"].'</option>';
													}
												echo '</select>';
											}
										echo '</div>';
										#<!-- select message -->
										echo '<div class="select_calendar_message" id="calendar_select_label">';
											echo $this->Lang->getLabel("SELECT_CALENDAR");
										echo '</div>';
										echo '<div class="cleardiv"></div>';
									echo '</div>';
								}
								if($this->Calendar->getShowSearchBox() == 1){
									#<!-- search -->
									echo '<div class="search_container" id="search_event_field">';
										echo '<div class="search_input_button">';
											echo '<input type="button" id="search_button" class="preview_event_button readmore_button readmore_button_style" value="'.$this->Lang->getLabel("SEARCH").'" />';
										echo '</div>';
										echo '<div class="search_input">';
											echo '<input type="text" name="search_field" id="search_field" style="background:#FFFFFF;width:150px;float:left;margin-right:10px"/>';
										echo '</div>';
										#<!-- select message -->
										echo '<div class="select_calendar_message" id="search_event_label" >';
											echo $this->Lang->getLabel("SEARCH_EVENT");
										echo '</div>';
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
						echo '<div class="cleardiv"></div>';
						#<!-- =======================================
						#calendar
						#======================================== -->
						echo '<div class="calendar_container_all">';
							#<!-- days name -->
							echo '<div class="name_days_container" id="name_days_container">';
								if($this->Calendar->getDateFormat() == "UK" || $this->Calendar->getDateFormat() == "EU"){
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("MONDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("TUESDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("WEDNESDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("THURSDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("FRIDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("SATURDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom" style="margin-right: 0px;">'.$this->Lang->getLabel("SUNDAY").'</div>';
								}else{
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("SUNDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("MONDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("TUESDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("WEDNESDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("THURSDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom">'.$this->Lang->getLabel("FRIDAY").'</div>';
									echo '<div class="font_custom day_name weekdays_custom" style="margin-right: 0px;">'.$this->Lang->getLabel("SATURDAY").'</div>';
								}
								echo '<div class="cleardiv"></div>';
							echo '</div>';
							#<!-- days -->
							echo '<div class="days_container_all" id="calendar_container"></div>';
							echo '<div class="events_container_all" id="events_container" style="display:none"></div>';
							echo '<div class="events_container_all" id="event_container" style="display:none"></div>';
							echo '<div class="events_container_all" id="events_home_container" style="display:none"></div>';
							echo '<div class="cleardiv"></div>';
						echo '</div>';
						echo '<div class="cleardiv"></div>';
						if($this->Calendar->getAllowUsersInsertion() == 1){
							#<!-- add event -->
							echo '<div class="user_addevent_button user_addevent_button_custom">';
								echo '<a href="user_event.php">'.$this->Lang->getLabel("USER_ADD_EVENT_BUTTON").'</a>';
							echo '</div>';
						}
					echo '</div>';
					#<!-- ===============================================================
					#events calendar ends here
					#================================================================ -->
					#<!-- preloader -->
					echo '<div id="modal_loading" class="modal_loading" style="display:none">';
						echo '<img src="'.$this->Style->get_STYLE_IMAGES_DIR().'calendar/loading.png" border=0 />';
					echo '</div>';
				echo '</div>';

/*
				echo '<div class="col-md-3 col-sm-4 col-xs-5">';
					echo '<aside class="blog-aside">';
						# Categories
						echo '<div class="blog-aside__block wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
							echo '<h3 class="blog-title">Categories<span class="line line--title line--blog-title"><span class="line__first"></span><span class="line__second"></span></span></h3>';
							echo '<div class="categories">';
								echo '<div class="categories__one">';
									echo '<header class="categories__head clearfix">';
										echo '<h5 class="pull-left"><a class="no-decoration" href="?id=Blog&amp;cat=mr">Members\' Rides</a></h5>';
										echo '<div class="categories__count pull-right">['.SQL::get_count_members_rides().']</div>';
									echo '</header>';
									echo '<p class="categories__desc">Post your riding experiences.</p>';
								echo '</div>';
								echo '<div class="categories__one">';
									echo '<header class="categories__head clearfix">';
										echo '<h5 class="pull-left"><a class="no-decoration" href="?id=Blog&amp;cat=mn">Monthly Newsletters</a></h5>';
										echo '<div class="categories__count pull-right">['.SQL::get_count_monthly_newsletters().']</div>';
									echo '</header>';
								echo '</div>';
								echo '<div class="categories__one">';
									echo '<header class="categories__head clearfix">';
										echo '<h5 class="pull-left"><a class="no-decoration" href="?id=Blog&amp;cat=rdr">Recalls, Defects & Repairs</a></h5>';
										echo '<div class="categories__count pull-right">['.SQL::get_count_recalls().']</div>';
									echo '</header>';
									echo '<p class="categories__desc">Information On Recalls, Defects & Repairs</p>';
								echo '</div>';
								echo '<div class="categories__one">';
									echo '<header class="categories__head clearfix">';
										echo '<h5 class="pull-left"><a class="no-decoration" href="?id=Blog&amp;cat=sm">Swap Meets</a></h5>';
										echo '<div class="categories__count pull-right">['.SQL::get_count_swap_meets().']</div>';
									echo '</header>';
									echo '<p class="categories__desc">';
										echo 'Members\' Buy, Sell & Trading Area';
									echo '</p>';
								echo '</div>';
								echo '<div class="categories__one">';
									echo '<header class="categories__head clearfix">';
										echo '<h5 class="pull-left"><a class="no-decoration" href="?id=Blog&amp;cat=ule">Upcoming Local Events</a></h5>';
										echo '<div class="categories__count pull-right">['.SQL::get_count_upcoming_local_events().']</div>';
									echo '</header>';
									echo '<p class="categories__desc">Poker Runs & Other Events</p>';
								echo '</div>';
								
							echo '</div>';
						echo '</div>';

						echo '<div class="blog-aside__block wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
							echo '<div class="aside-tabs">';
								echo '<div class="aside-tabs__links">';
									echo '<a href="#" class="no-decoration aside-tabs__active-link js-tab-link" data-for="#block1">Popular</a>';
									echo '<a href="#" class="no-decoration js-tab-link" data-for="#block2">Recent</a>';
								echo '</div>';
								echo '<div class="aside-tabs__blocks js-tab-block" id="block1">';
									echo '<div class="aside-tabs__block">';
										echo '<div class="row row--no-padding">';
											echo '<div class="col-xs-4">';
												echo '<img src="'.$cfg["FTW_MEDIA"].'72x72/popular1.jpg" alt="moto" class="img-responsive" />';
											echo '</div>';
											echo '<div class="col-xs-7">';
												echo '<div class="aside-tabs__anons">';
													echo '<p><a class="no-decoration" href="article.html">Nunc molestie sapien tempor placerat ...</a></p>';
													echo '<div class="aside-tabs__date">March 30, 2015</div>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
									echo '<div class="aside-tabs__block">';
										echo '<div class="row row--no-padding">';
											echo '<div class="col-xs-4">';
												echo '<img src="'.$cfg["FTW_MEDIA"].'72x72/popular2.jpg" alt="moto" class="img-responsive" />';
											echo '</div>';
											echo '<div class="col-xs-7">';
												echo '<div class="aside-tabs__anons">';
													echo '<p> <a class="no-decoration" href="article.html">Cras et lectus. Etiam amet turpis diset ...</a></p>';
													echo '<div class="aside-tabs__date">March 30, 2015</div>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
									echo '<div class="aside-tabs__block">';
										echo '<div class="row row--no-padding">';
											echo '<div class="col-xs-4">';
												echo '<img src="'.$cfg["FTW_MEDIA"].'72x72/popular3.jpg" alt="moto" class="img-responsive" />';
											echo '</div>';
											echo '<div class="col-xs-7">';
												echo '<div class="aside-tabs__anons">';
													echo '<p><a class="no-decoration" href="article.html">Nunc molestie sapien tempor placerat ...</a></p>';
													echo '<div class="aside-tabs__date">March 30, 2015</div>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
									echo '<div class="aside-tabs__block">';
										echo '<div class="row row--no-padding">';
											echo '<div class="col-xs-4">';
												echo '<img src="'.$cfg["FTW_MEDIA"].'72x72/popular4.jpg" alt="moto" class="img-responsive" />';
											echo '</div>';
											echo '<div class="col-xs-7">';
												echo '<div class="aside-tabs__anons">';
													echo '<p><a class="no-decoration" href="article.html">Amet turpis disce erat Ut proin a ipsum</a></p>';
													echo '<div class="aside-tabs__date">March 30, 2015</div>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<div class="aside-tabs__blocks js-tab-block" id="block2">';
									echo '<div class="aside-tabs__block">';
										echo '<div class="row row--no-padding">';
											echo '<div class="col-xs-4">';
												echo '<img src="'.$cfg["FTW_MEDIA"].'72x72/popular2.jpg" alt="moto" class="img-responsive" />';
											echo '</div>';
											echo '<div class="col-xs-7">';
												echo '<div class="aside-tabs__anons">';
													echo '<p><a class="no-decoration" href="article.html"> Cras et lectus. Etiam amet turpis diset ...</a></p>';
													echo '<div class="aside-tabs__date">March 30, 2015</div>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
									echo '<div class="aside-tabs__block">';
										echo '<div class="row row--no-padding">';
											echo '<div class="col-xs-4">';
												echo '<img src="'.$cfg["FTW_MEDIA"].'72x72/popular3.jpg" alt="moto" class="img-responsive" />';
											echo '</div>';
											echo '<div class="col-xs-7">';
												echo '<div class="aside-tabs__anons">';
													echo '<p><a class="no-decoration" href="article.html">Nunc molestie sapien tempor placerat ...</a></p>';
													echo '<div class="aside-tabs__date">March 30, 2015</div>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
									echo '<div class="aside-tabs__block">';
										echo '<div class="row row--no-padding">';
											echo '<div class="col-xs-4">';
												echo '<img src="'.$cfg["FTW_MEDIA"].'72x72/popular4.jpg" alt="moto" class="img-responsive" />';
											echo '</div>';
											echo '<div class="col-xs-7">';
												echo '<div class="aside-tabs__anons">';
													echo '<p><a class="no-decoration" href="article.html">Amet turpis disce erat Ut proin a ipsum</a></p>';
													echo '<div class="aside-tabs__date">March 30, 2015</div>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					
						# Photos
						echo '<div class="blog-aside__block wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
							echo '<h3 class="blog-title">Photos<span class="line line--title line--blog-title"><span class="line__first"></span><span class="line__second"></span></span></h3>';
							echo '<div class="blog-aside__photos">';
								echo '<div class="row row--small-padding">';
									echo '<div class="col-xs-4">';
										echo '<a class="fancyimage" data-fancybox-group="group" href="'.$cfg["FTW_MEDIA"].'530x360/bike1.jpg"><img alt="bike" class="img-responsive" src="'.$cfg["FTW_MEDIA"].'80x80/photo1.jpg" /></a>';
									echo '</div>';
									echo '<div class="col-xs-4">';
										echo '<a class="fancyimage" data-fancybox-group="group" href="'.$cfg["FTW_MEDIA"].'530x360/bike1.jpg"><img alt="bike" class="img-responsive" src="'.$cfg["FTW_MEDIA"].'80x80/photo2.jpg" /></a>';
									echo '</div>';
									echo '<div class="col-xs-4">';
										echo '<a class="fancyimage" data-fancybox-group="group" href="'.$cfg["FTW_MEDIA"].'530x360/bike1.jpg"><img alt="bike" class="img-responsive" src="'.$cfg["FTW_MEDIA"].'80x80/photo3.jpg" /></a>';
									echo '</div>';
									echo '<div class="col-xs-4">';
										echo '<a class="fancyimage" data-fancybox-group="group" href="'.$cfg["FTW_MEDIA"].'530x360/bike1.jpg"><img alt="bike" class="img-responsive" src="'.$cfg["FTW_MEDIA"].'80x80/footer1.jpg" /></a>';
									echo '</div>';
									echo '<div class="col-xs-4">';
										echo '<a class="fancyimage" data-fancybox-group="group" href="'.$cfg["FTW_MEDIA"].'530x360/bike1.jpg"><img alt="bike" class="img-responsive" src="'.$cfg["FTW_MEDIA"].'80x80/footer2.jpg" /></a>';
									echo '</div>';
									echo '<div class="col-xs-4">';
										echo '<a class="fancyimage" data-fancybox-group="group" href="'.$cfg["FTW_MEDIA"].'530x360/bike1.jpg"><img alt="bike" class="img-responsive" src="'.$cfg["FTW_MEDIA"].'80x80/footer3.jpg" /></a>';
									echo '</div>';
									echo '<div class="col-xs-4">';
										echo '<a class="fancyimage" data-fancybox-group="group" href="'.$cfg["FTW_MEDIA"].'530x360/bike1.jpg"><img alt="bike" class="img-responsive" src="'.$cfg["FTW_MEDIA"].'80x80/photo4.jpg" /></a>';
									echo '</div>';
									echo '<div class="col-xs-4">';
										echo '<a class="fancyimage" data-fancybox-group="group" href="'.$cfg["FTW_MEDIA"].'530x360/bike1.jpg"><img alt="bike" class="img-responsive" src="'.$cfg["FTW_MEDIA"].'80x80/photo5.jpg" /></a>';
									echo '</div>';
									echo '<div class="col-xs-4">';
										echo '<a class="fancyimage" data-fancybox-group="group" href="'.$cfg["FTW_MEDIA"].'530x360/bike1.jpg"><img alt="bike" class="img-responsive" src="'.$cfg["FTW_MEDIA"].'80x80/photo6.jpg" /></a>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="blog-aside__block wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
							echo '<h3 class="blog-title">Tags<span class="line line--title line--blog-title"><span class="line__first"></span><span class="line__second"></span></span></h3>';
							echo '<div class="blog-aside__tags">';
								echo '<a href="#" class="btn button button--grey button--tag triangle">Latest Bikes</a>';
								echo '<a href="#" class="btn button button--grey button--tag triangle">Motorcycles</a>';
								echo '<a href="#" class="btn button button--grey button--tag triangle">SEO</a>';
								echo '<a href="#" class="btn button button--grey button--tag triangle">Races</a>';
								echo '<a href="#" class="btn button button--grey button--tag triangle">Club Membership</a>';
								echo '<a href="#" class="btn button button--grey button--tag triangle">Event</a>';
								echo '<a href="#" class="btn button button--grey button--tag triangle">Upcoming Events</a>';
								echo '<a href="#" class="btn button button--grey button--tag triangle">2015 Bikes</a>';
							echo '</div>';
						echo '</div>';
						
						# Advertisements Block
						echo '<div class="blog-aside__block wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
							echo '<h3 class="blog-title">Advertise Here<span class="line line--title line--blog-title"><span class="line__first"></span><span class="line__second"></span></span></h3>';
							echo '<ul class="js-latest-slider enable-bx-slider" data-auto="false" data-auto-hover="true" data-mode="horizontal" data-pager="false" data-pager-custom="null" data-prev-selector="null" data-next-selector="null">';
								echo '<li>';
									echo '<div class="latest-model">';
										echo '<div class="latest-model__img">';
											echo '<img alt="bike" class="img-responsive" src="'.$this->Style->get_STYLE_IMAGES_DIR().'270x270/A&I_logo2_270x270.png" />';
										echo '</div>';
										echo '<div class="latest-model__info">';
											echo '<h5>Asphalt & Iron – A Life Behind Bars</h5>';
											echo '<p class="blog-text">';
												echo '<b>The Ultimate Social Network for Bikers, By Bikers</b><br>';
												echo '<b><a class="no-decoration" href="http://www.asphaltandiron.com">Asphalt & Iron Home</a></b><br>';
												echo '<b><a class="no-decoration" href="http://www.facebook.com/asphaltandiron">Visit Us On Facebook</a></b><br>';
												echo '<b><a href="mailto:info@asphaltandiron.com" target="_top">Send Us An Message</a></b>';
											echo '</p>';
										echo '</div>';
									echo '</div>';
								echo '</li>';
							echo '</ul>';

							echo '<ul class="js-latest-slider enable-bx-slider" data-auto="false" data-auto-hover="true" data-mode="horizontal" data-pager="false" data-pager-custom="null" data-prev-selector="null" data-next-selector="null">';
								echo '<li>';
									echo '<div class="latest-model">';
										echo '<div class="latest-model__img">';
											echo '<img alt="bike" class="img-responsive" src="'.$this->Styles->fetch_WS_STYLES_MEDIA_DIR().'270x270/mickeys_1.png" />';
										echo '</div>';
									echo '</div>';
								echo '</li>';
							echo '</ul>';

							echo '<ul class="js-latest-slider enable-bx-slider" data-auto="false" data-auto-hover="true" data-mode="horizontal" data-pager="false" data-pager-custom="null" data-prev-selector="null" data-next-selector="null">';
								echo '<li>';
									echo '<div class="latest-model">';
										echo '<div class="latest-model__img">';
											echo '<img alt="bike" class="img-responsive" src="'.$this->Styles->fetch_WS_STYLES_MEDIA_DIR().'270x270/mickeys_2.png" />';
										echo '</div>';
									echo '</div>';
								echo '</li>';
							echo '</ul>';

							echo '<ul class="js-latest-slider enable-bx-slider" data-auto="false" data-auto-hover="true" data-mode="horizontal" data-pager="false" data-pager-custom="null" data-prev-selector="null" data-next-selector="null">';
								echo '<li>';
									echo '<div class="latest-model">';
										echo '<div class="latest-model__info">';
											echo '<h5>Howells Cycle</h5>';
											echo '<p class="blog-text">';
												echo '<b>Address</b><br>';
												echo '8142 FM 16<br>';
												echo 'Van, TX 75790<br><br>';
												echo '<b>Phone</b><br>';
												echo '(903) 963-8953<br><br>';
												echo '<b>Business Hours</b><br>';
												echo 'Open M-F 9am to 5pm<br>';
												echo 'Lunch 12 -1<br>';
												echo 'Sat 9 -12<br>';
												echo 'Closed Sun & Mon<br><br>';
												echo 'We are Excited to Now be Offering Tires for your Car, Truck, SUV, Trailers and More!<br>';
												echo '<b><a class="no-decoration" href="http://www.howellscycle.com">Visit Us Online</a></b><br>';
											echo '</p>';
										echo '</div>';
									echo '</div>';
								echo '</li>';
							echo '</ul>';

							echo '<ul class="js-latest-slider enable-bx-slider" data-auto="false" data-auto-hover="true" data-mode="horizontal" data-pager="false" data-pager-custom="null" data-prev-selector="null" data-next-selector="null">';
								echo '<li>';
									echo '<div class="latest-model">';
										echo '<div class="latest-model__img">';
											echo '<img alt="bike" class="img-responsive" src="'.$this->Styles->fetch_WS_STYLES_MEDIA_DIR().'270x270/toys4bigboys_270x270.png" />';
										echo '</div>';
										echo '<div class="latest-model__info">';
											echo '<h5>Toys For Big Boys</h5>';
											echo '<p class="blog-text">';
												echo '<b>Address</b><br>';
												echo '2701 NW 2nd Ave Suite 213<br>';
												echo 'Boca Raton, FL 33431<br><br>';
												echo '<b>Phone</b><br>';
												echo 'Phone: 1-855-553-TOYS(8697)<br><br>';
												echo '<b>URL</b><br>';
												echo '<b><a class="no-decoration" href="http://www.toysforboys.com">Visit Us!</a></b><br><br>';
												echo '<b>Contact</b><br>';
												echo '<b><a href="mailto:Contact@toysforbigboys.com" target="_top">Send Us An Message</a></b>';
											echo '</p>';
										echo '</div>';
									echo '</div>';
								echo '</li>';
							echo '</ul>';

							echo '<ul class="js-latest-slider enable-bx-slider" data-auto="false" data-auto-hover="true" data-mode="horizontal" data-pager="false" data-pager-custom="null" data-prev-selector="null" data-next-selector="null">';
								echo '<li>';
									echo '<div class="latest-model">';
										echo '<div class="latest-model__img">';
											echo '<a href="http://wheelsontheroad.com"><img alt="bike" class="img-responsive" src="'.$this->Styles->fetch_WS_STYLES_MEDIA_DIR().'270x270/mike.png" /></a>';
										echo '</div>';
									echo '</div>';
								echo '</li>';
							echo '</ul>';

						echo '</div>';
					echo '</aside>';
				echo '</div>';
				*/
			echo '</div>';
		echo '</div>';
	echo '</div>'; # blog-page
?>