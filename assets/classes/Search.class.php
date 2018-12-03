<?php
	class Search{
		
		private $SHOW_PATH;
		private $SHOW_PARENT_LINK;
		private $SHOW_HIDDEN_ENTRIES;
		
		function __construct(){
			$this->show_path();
			$this->show_parent_link();
			$this->show_hidden_entry();
		}
		function show_path(){
			$this->SHOW_PATH = true;
		}
		function show_parent_link(){
			$this->SHOW_PARENT_LINK = false;
		}
		function show_hidden_entry(){
			$this->SHOW_HIDDEN_ENTRIES = false;
		}
		function get_grouped_entries($path) {
			list($dirs,$files)=$this->collect_directories_and_files($path);
			$dirs	=	$this->filter_directories($dirs);
			$files	=	$this->filter_files($files);
			return array_merge(array_fill_keys($dirs,false),array_fill_keys($files,FALSE));
		}
		function collect_directories_and_files($path){
			# Retrieve directories and files inside the given path.
			# Also, `scandir()` already sorts the directory entries.
			$entries = scandir($path);
			return $this->array_partition($entries,function($entry){return is_dir($entry);});
		}
		function array_partition($array, $predicate_callback){
			# Partition elements of an array into two arrays according
			# to the boolean result from evaluating the predicate.
			$results = array_fill_keys(array(1,0),array());
			foreach($array as $element){
				array_push($results[(int)$predicate_callback($element)],$element);
			}
			return array($results[1],$results[0]);
		}
		function filter_directories($dirs){
			# Exclude directories. Adjust as necessary.
			return array_filter($dirs,function($dir){
				return $dir!='.'&& ($this->SHOW_PARENT_LINK || $dir!='..') && !$this->is_hidden($dir);});
		}
		function filter_files($files){
			# Exclude files. Adjust as necessary.
			return array_filter($files,function($file){return !$this->is_hidden($file);});
		}
		function is_hidden($entry){
			return !$this->SHOW_HIDDEN_ENTRIES && substr($entry,0,1) == '.' && $entry!='.' && $entry!='..' && $entry!=is_dir;
		}
		function listMyProperties(){
			echo "<b>Class=>Display Properties:</b> ";
			echo "<pre>";
				print_r(get_object_vars($this));
			echo "</pre>";
		}
	}
?>