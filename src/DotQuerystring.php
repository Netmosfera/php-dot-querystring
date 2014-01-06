<?php

final class DotQueryString
{
	static function decode($querystring){
		$bracketSyntax = preg_replace('/[.]([^.]*?)(?=[=.&]|$)/', '%5B\1%5D', $querystring);
		parse_str($bracketSyntax, $array);
		return $array;
	}

	static function encode($data, $numericPrefix = "", $separator = NULL, $encoding = NULL){
		$encoding = $encoding === NULL ? PHP_QUERY_RFC1738 : $encoding;
		$separator = $separator === NULL ? ini_get("arg_separator.output") : $separator;
		$data = http_build_query($data, $numericPrefix, $separator, $encoding);
		return preg_replace('/%5B(.*?)%5D/', '.\1', $data);
	}
}
