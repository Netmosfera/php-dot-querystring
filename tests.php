<?php

function parse_dot_str($str){
	parse_str(preg_replace('/[.]([^.]*?)(?=[=.&]|$)/', '%5B\1%5D', $str), $result);
	return $result;
}

$php_string[] = "a=20&b=21&c=22";				$dot_string[] = "a=20&b=21&c=22";
$php_string[] = "a=20&a=21&a=22";				$dot_string[] = "a=20&a=21&a=22";

$php_string[] = "a[a]=20&a[]=21";				$dot_string[] = "a.a=20&a.=21";
$php_string[] = "a[77]=20&a[]=21";				$dot_string[] = "a.77=20&a.=21";
$php_string[] = "a[]=19&a[77]=20&a[]=21";			$dot_string[] = "a.=19&a.77=20&a.=21";

$php_string[] = "a[b][]=1&a[b][]=2&a[b]=3&a[b][]=4";		$dot_string[] = "a.b.=1&a.b.=2&a.b=3&a.b.=4";

$php_string[] = "a[][]=20&a[][]=21";				$dot_string[] = "a..=20&a..=21";
$php_string[] = "a[]=10&a[][]=20&a[][]=21";			$dot_string[] = "a.=10&a..=20&a..=21";

$php_string[] = "[a]=20";					$dot_string[] = ".a=20";
$php_string[] = "[a][b]=20";					$dot_string[] = ".a.b=20";
$php_string[] = "[a][]=20";					$dot_string[] = ".a.=20";
$php_string[] = "[][]=20";					$dot_string[] = "..=20";
$php_string[] = "[][]=20&a=10";					$dot_string[] = "..=20&a=10";
$php_string[] = "b=20&[][]=20&a=10";				$dot_string[] = "b=20&..=20&a=10";

foreach($dot_string as $i => $s){

	$a = parse_dot_str($dot_string[$i]);
	parse_str($php_string[$i], $b);

	echo "<textarea cols=80 rows=5>"; print_r($a); print_r($b); echo "</textarea>";
	echo "<div>" . ($a === $b ? "OK" : "<b>FAIL</b>") . "<br><br></div>";

}
