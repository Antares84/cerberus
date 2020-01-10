<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class FileReader{
		/**
		 * @params string The file full path
		 * @return    string
		 * @throws   Exception
		*/
		public function read($file){
			$realFile = realpath($file);
			if(!file_exists($realFile)){
				throw new Exception(sprintf('The file "%s" does not exist', $file));
			}

			return file_get_contents($realFile);
		}
	}
?>