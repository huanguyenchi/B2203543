<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
//https://www.php.net/manual/en/timezones.asia.php
$t = date("H");


echo 'Bay gio la: '.$t.' gio';
$s='';
if ($t < 11) {
 $s="sang";
} elseif ($t < 17) {
 $s= "chieu";
} else {
 $s ="toi";
 }
echo '<br> Chuc buoi '. $s. ' vui ve';
?>


