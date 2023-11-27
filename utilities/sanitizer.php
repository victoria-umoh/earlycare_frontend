<?php

function sanitizer($banned_string){
$search = ["bitch", "bastard", "motherfucker", "evil", "dead", "fuck", "hell", "nigga", "ass", "kill", "shit"];
$replace = ["bi**h", "b*st*rd", "m*th*rf**ker", "ev*l", "d*ad", "f**k", "h*ll", "ni**a", "a**", "ki**", "sh*t"];

$good_string = $banned_string;

$good_string = strip_tags($banned_string);
$good_string = htmlspecialchars($good_string);
$good_string = str_ireplace($search, $replace, $good_string);
$good_string = ucwords($good_string);
$good_string = ucfirst($good_string);

return $good_string;

}

?>