<?php
	namespace classes\db;
	if(!defined('IN_CMS')){
		exit('DB_MySQL: unauthorized access detected, exiting...');
	}

	#############################################################################################
	#	Title: DB_MySQL.php																#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS MySQL database class, used for loading all MySQL database resources			#
	#	Last Update Date: 09.29.2019	1129													#
	#############################################################################################
	class MySQL{

		/* Host name of the MySQL server */
		$host = 'localhost';

		/* MySQL account username */
		$user = 'myUser';

		/* MySQL account password */
		$passwd = 'myPasswd';

		/* The schema you want to use */
		$schema = 'mySchema';

		/* The PDO object */
		$pdo = NULL;

		/* Connection string, or "data source name" */
		$dsn = 'mysql:host=' . $host . ';dbname=' . $schema;

		/* Connection inside a try/catch block */
		try{
			/* PDO object creation */
			$pdo = new PDO($dsn, $user,  $passwd);
   
			/* Enable exceptions on errors */
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e){
			/* If there is an error an exception is thrown */
			echo 'Database connection failed.';
			die();
		}

		protected $dsn;protected $user;protected $pwd;

		public function __construct(){}
	}
?>