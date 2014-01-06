<?php

final class DotQueryString
{
	/**
	 * @param string
	 * @return array
	 */
	static function decode($querystring)
	{
		$bracketSyntax = preg_replace('/[.]([^.]*?)(?=[=.&]|$)/', '%5B\1%5D', $querystring);
		parse_str($bracketSyntax, $array);
		return $array;
	}

	/**
	 * @param array|object
	 * @param string
	 * @param string|null When NULL is provided, ini value arg_separator.output is used
	 * @param int|null When NULL is provided PHP_QUERY_RFC1738 is used
	 * @return string
	 * @link http://php.net/http_build_query
	 */
	static function encode($data, $numericPrefix = '', $separator = null, $encoding = null)
	{
		$encoding = is_null($encoding) ? PHP_QUERY_RFC1738 : $encoding;
		$separator = is_null($separator) ? ini_get('arg_separator.output') : $separator;
		$data = http_build_query($data, $numericPrefix, $separator, $encoding);
		return preg_replace('/%5B(.*?)%5D/', '.\1', $data);
	}
}
