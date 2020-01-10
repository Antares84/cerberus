<?php
	# Initialize Session
	session_start();
	ob_start();

	# Set Home
	define("DOC_ROOT","./");

	# Direct-load Autoloaders
	require_once(DOC_ROOT.'Assets/Resources/Classes/Autoloader.class.php');

	$Browser	=	new Browser;
	$Data		=	new Data;
	$db			=	new Database;
	$Dirs		=	new Dirs;
	$Setting	=	new Setting($db);
	$Theme		=	new Theme($db);
	$Cards		=	new Cards($Data,$Setting);
	$Paging		=	new Paging($db,$Setting);
	$Style		=	new Style($db,$Dirs,$Theme);
	$Tpl		=	new Template(
									'', # $Messenger,
									'', # $Select,
									$Style,
									$Theme,
									'' # $Tooltips
	);
	$Display	=	new Display(
	
				'', # Arrays,
				'', # BossRecord
				$Browser, # Browser
				$Cards, # Cards
				'', # Colors
				$Data, # Data
				$db, # db
				$Dirs, # Dirs
				'', # Donate
				'', # LogSys
				'', # MailSys
				'', # Messenger
				'', # Modal
				'', # Modules
				'', # Nav
				'', # Notices
				$Paging, # Paging
				'', # PayPal
				'', # PHP
				'', # PvP
				'', # Read
				'', # Select
				'', # Session
				$Setting, # Setting
				'', # ShChar
				'', # ShUser
				'', # SQL
				$Style, # Style
				'', # Tbl
				'', # Tpl
				$Theme, # Theme
				'', # Tooltips
				'', # User
				'', # Version
				'', # Wow
				'' # XML
	);

	$Display->_do('head_pagination');
	$Display->_do('head_title');
	$Display->_do('head_stylesheets',true);
	$Display->_do('head_js');

	$CARD_TITLE	=	'Browser Info';
	$CARD_BODY	=	'<div class="table-responsive">';
		$CARD_BODY	=	'<table class="table table-sm table-striped">';
			$CARD_BODY	.=	'<tbody>';
				$CARD_BODY	.=	'<tr>';
					$CARD_BODY	.=	'<td>OS:</td>';
					$CARD_BODY	.=	'<td>'.$Browser->OS_Platform.'</td>';
				$CARD_BODY	.=	'</tr>';
				$CARD_BODY	.=	'<tr>';
					$CARD_BODY	.=	'<td>Type:</td>';
					$CARD_BODY	.=	'<td>'.$Browser->BrowserType.'</td>';
				$CARD_BODY	.=	'</tr>';
				$CARD_BODY	.=	'<tr>';
					$CARD_BODY	.=	'<td>UserAgent:</td>';
					$CARD_BODY	.=	'<td>'.$Browser->UserAgent.'</td>';
				$CARD_BODY	.=	'</tr>';
				$CARD_BODY	.=	'<tr>';
					$CARD_BODY	.=	'<td>Your IP:</td>';
					$CARD_BODY	.=	'<td>'.$Browser->UserIP.'</td>';
				$CARD_BODY	.=	'</tr>';
			$CARD_BODY	.=	'</tbody>';
		$CARD_BODY	.=	'</table>';
	$CARD_BODY	.=	'</div>';

	# CONTENT
	$Tpl->_do_build_bg('CMS');
	echo '<div class="container-fluid page-wrapper">';
		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-md-3"></div>';
				echo '<div class="col-md-6">';
					echo $Cards->_do_build_card('page',$CARD_TITLE,$CARD_BODY);
				echo '</div>';
			echo '</div>';
			$Tpl->Separator('15');

			echo '<div class="row">';
				echo '<div class="col-md-12">';
					#$Tpl->_do_alert(5,'This data is not saved or recorded. Enjoy this free service.');
					echo '<div class="tac f_20">';
						$Tpl->_badge(5,'Your data is not saved or recorded. Enjoy this free service.');
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>