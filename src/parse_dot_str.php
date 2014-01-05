<?php

namespace parse_dot_query_string{
	function merge_arrays_deep(){
		$arrays = func_get_args();
		$merged = array();
		while($arrays){
			$array = array_shift($arrays);
			if(!$array) continue;
			foreach($array as $key => $value)
				if(is_array($value) && array_key_exists($key, $merged) && is_array($merged[$key]))
					$merged[$key] = merge_arrays_deep($merged[$key], $value);
				else
					$merged[$key] = $value;
		}
		return $merged;
	}

	function set_array_keys($value, $prefix){

		if(is_array($value)){
			$clean_array = array();
			foreach($value as $key => $value){
				if(strpos($key, $prefix) === 0)
					$clean_array[] = set_array_keys($value, $prefix);
				else
					$clean_array[$key] = set_array_keys($value, $prefix);
			}
			return $clean_array;
		}
		else
			return $value;
	}
}

namespace{
	function parse_dot_str($str){
		$uid = uniqid(null, true) . "_";
		$count = 0;
		$querystring = array();
		$variables = explode("&", $str);
		foreach($variables as $variable){
			$pieces			= explode("=", $variable, 2);
			$result			= array();
			$pointer		= &$result;
			foreach(explode(".", $pieces[0]) as $k)
				$pointer	= &$pointer[$k === "" ? $uid . $count++ : urldecode($k)];
			$pointer		= isset($pieces[1]) ? urldecode($pieces[1]) : "";
			$querystring	= \parse_dot_query_string\merge_arrays_deep($querystring, $result);
		}
		return \parse_dot_query_string\set_array_keys($querystring, $uid);
	}
}
