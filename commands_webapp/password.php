<?php
function randomstring($car) {
$string = "";
$chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNPQRSTUVWXY12345689";
srand((double)microtime()*1000000);
for($i=0; $i<$car; $i++) {
$string .= $chaine[rand()%strlen($chaine)];
}
return $string;
}
?>