<?php

namespace WesNetmo\ParseDotStr {

    /**
     * @param $dotSyntax
     * @return mixed
     */
    function parse_dot_str($dotSyntax)
    {
        $bracketSyntax = preg_replace('/[.]([^.]*?)(?=[=.&]|$)/', '[\1]', $dotSyntax);
        parse_str($bracketSyntax, $array);
        return $array;
    }
}
