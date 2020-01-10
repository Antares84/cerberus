<?php
function escData($data)
{
	if (!isset($data) or empty($data))
		return '';
	if (is_numeric($data))
		return $data;
	$non_displayables = array(
		'/%0[0-8bcef]/', // url encoded 00-08, 11, 12, 14, 15
		'/%1[0-9a-f]/', // url encoded 16-31
		'/[\x00-\x08]/', // 00-08
		'/\x0b/', // 11
		'/\x0c/', // 12
		'/[\x0e-\x1f]/' // 14-31
	);
	foreach ($non_displayables as $regex)
		$data = preg_replace($regex, '', $data);
	$data = str_replace("'", "''", $data);
	return $data;
}

function createLog($UserID, $Action, $conn)
{
	sqlsrv_query($conn, "INSERT INTO [SDM_AdminPanel].[dbo].[Log] (UserID, UserIP, Action) VALUES (?, ?, ?)", array($UserID, $_SERVER['REMOTE_ADDR'], $Action));
}

function createSession($UserID)
{
	return md5($UserID.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
}

function checkSession($UserID, $Session)
{
	if(md5($UserID.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']) === $Session)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function returnUserRank($UserID)
{
	if(in_array($UserID, array('XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX,')))
	{
		return 4;
	}
	
	global $link;
	
	$res = sqlsrv_query($link, "SELECT Rank FROM SDM_AdminPanel.dbo.Users WHERE UserID = ?", array($UserID));
	if(sqlsrv_has_rows($res))
	{
		$row = sqlsrv_fetch_array($res);
		return $row['Rank'];
	}
	else
	{
		return 0;
	}
}

function returnPageRank($Page)
{
	global $link;
	
	$res = sqlsrv_query($link, "SELECT Rank FROM SDM_AdminPanel.dbo.Pages WHERE Page = ?", array($Page));
	if(sqlsrv_has_rows($res))
	{
		$row = sqlsrv_fetch_array($res);
		return $row['Rank'];
	}
	else
	{
		return 0;
	}
}

function returnName($UserID)
{
	global $link;
	
	$res = sqlsrv_query($link, "SELECT CharName FROM SDM_AdminPanel.dbo.Users WHERE UserID = ?", array($UserID));
	if(sqlsrv_has_rows($res))
	{
		$row = sqlsrv_fetch_array($res);
		return $row['CharName'];
	}
	else
	{
		return "[GM]Generic";
	}
}
?>