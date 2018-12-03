<?php
	class Blog{
		function get_blog_articles($cat){
			if($cat == ''){$cat = 'ule';}

			$sql	=	("SELECT * FROM ".$this->db->db_get_table('FTW_BLOG_CONTENT')." WHERE blog_category = ?");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($cat);
			$prep	=	odbc_execute($stmt,$args);

			if(!$prep || odbc_num_rows($stmt) == 0){
				echo '<h3 class="article-title wow slideInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">FTW Blog</h3>';
				echo '<p class="blog-text blog-text--article wow slideInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">';
					echo 'It\'s lonely here! Maybe someone should post something...';
				echo '</p>';
			}
			else{
				while($data = odbc_fetch_array($stmt)){
					echo '<div class="article" id="'.$data['blog_post_id'].'">';
						echo '<div class="blog-date triangle triangle--big wow slideInLeft" data-wow-delay="0.7s" data-wow-duration="1.5s">';
							echo '<div class="blog-date__num">'.date("d", strtotime($data['blog_timestamp'])).'</div>';
							echo '<div class="blog-date__month-year">'.$this->data->convert_month_to_text(date("m", strtotime($data['blog_timestamp']))).'</div>';
							echo '<div class="blog-date__month-year">'.date("Y", strtotime($data['blog_timestamp'])).'</div>';
						echo '</div>';

					if(isset($data['blog_image']) && !empty($data['blog_image'])){
						echo '<div class="article__img wow slideInLeft" data-wow-delay="0.7s" data-wow-duration="1.5s">';
							echo '<img src="'.$this->settings->WS_STYLES_EVENTS_DIR.$data['blog_image'].'" alt="" class="img-responsive" />';
						echo '</div>';
					}else{
						echo '<div class="article__img wow slideInLeft separator s_60 o_red_5" data-wow-delay="0.7s" data-wow-duration="1.5s"></div>';
					}
						echo '<h3 class="article-title wow slideInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">'.$data['blog_title'].'</h3>';
						echo '<p class="blog-text blog-text--article wow slideInUp" data-wow-delay="0.7s" data-wow-duration="1.5s">'.$data['blog_content'].'</p>';
					echo '</div>';
				}
				odbc_free_result($stmt);
				#odbc_close($cxn);
			}
		}
	}
?>