<?php declare(strict_types = 1);

namespace PHPToolBucket\DotQueryString;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

/**
 * @TODOC
 *
 * @param           String                                  $queryString                    `String`
 * @TODOC
 *
 * @return          Mixed[]                                                                 `Array<Int|String, *recurse*>`
 * @TODOC
 */
function decodeDotQueryString(String $queryString): Array{
    $bracketSyntax = preg_replace('/[.]([^.]*?)(?=[=.&]|$)/', '%5B\1%5D', $queryString);
    parse_str($bracketSyntax, $array);
    return $array;
}
