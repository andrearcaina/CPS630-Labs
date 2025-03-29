<?php

$salt = base64_encode(random_bytes(12));

$hashed = md5("admin".$salt);

echo $salt;
echo "\n";
echo $hashed;

?>