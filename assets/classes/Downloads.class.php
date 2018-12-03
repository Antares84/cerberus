<?php
	# Access Security
	if($cfg["BROWSER_SECURE_CHECK"] != 1){
		die('You have entered a restricted area.<br />
			 Direct access is not allowed.<br />
			 Area: Class - Downloads'
		);
	}

	# Download Links | Used on the "Downloads" page for your downloads for your menbers. Edit them for your client links.
	# Add the link that you want for the MEGA logo on the Downloads page.
	$cfg["DL_1_FILENAME"]	=	'ShaiyaTundra.rar';
	$cfg["DL_1_TYPE"]		=	'MediaFire';
	$cfg["DL_1_URL"]		=	'http://www.mediafire.com/file/olij6zsex4qlpgo/Shaiya+Tundra.rar';
	$cfg["DL_1_SIZE"]		=	'(974.47MB)';
	# Add the link that you want for the uTorrent logo on the Downloads page.
	$cfg["DL_2_FILENAME"]	=	'ShaiyaTundra.rar';
	$cfg["DL_2_TYPE"]		=	'MEGA';
	$cfg["DL_2_URL"]		=	'https://mega.nz/#!GN83gRgA!BtwpRRWjIlEk00TH4tijlBwiGA2HThdh3V3r4W0Bhzw';
	$cfg["DL_2_SIZE"]		=	'(974.47MB)';
	# Add the link that you want for the Shaiya logo on the Downloads page.
	$cfg["DL_3_FILENAME"]	=	'ShaiyaTundra.rar';
	$cfg["DL_3_TYPE"]		=	'GDrive';
	$cfg["DL_3_URL"]		=	'https://drive.google.com/open?id=0B1y3WB4yCLOJRFQ0dnQ5SXRCQTg';
	$cfg["DL_3_SIZE"]		=	'(974.47MB)';
?>