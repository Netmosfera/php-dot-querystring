<?php

final class DotQueryString
{
  static function decode($querystring)
  {
    $bracketSyntax = preg_replace('/[.]([^.]*?)(?=[=.&]|$)/', '%5B\1%5D', $dotSyntax);
    parse_str($bracketSyntax, $array);
    return $array;
  }
  
  static function encode($data, $numericPrefix = NULL, $separator = NULL, $encoding = NULL){
    $data = http_build_query($data, $numericPrefix, $separator, $encoding);
    return preg_replace('/%5B(.*?)%5D/', '.\1', $data);
  }
}
