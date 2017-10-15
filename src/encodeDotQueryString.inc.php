<?php declare(strict_types = 1);

namespace PHPToolBucket\DotQueryString;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

/**
 * @TODOC
 *
 * @param           Mixed[]                                 $data                           `Array<Int|String, *recurse*>`
 * @TODOC
 *
 * @param           String                                  $numericPrefix                  `String`
 * @TODOC
 *
 * @param           String                                  $separator                      `String`
 * The key-value pair separator; defaults to `"&"`.
 *
 * @param           Int                                     $encoding
 * One of `PHP_QUERY_RFC1738` (spaces as `+`) or `PHP_QUERY_RFC3986` (spaces as `%20`)
 *
 * @return          String
 * @TODOC
 */
function encodeDotQueryString(
    Array $data,
    String $numericPrefix = "",
    ?String $separator = "&",
    Int $encoding = PHP_QUERY_RFC1738
): String{
    $data = http_build_query($data, $numericPrefix, $separator, $encoding);
    return preg_replace('/%5B(.*?)%5D/', '.\1', $data);
}

