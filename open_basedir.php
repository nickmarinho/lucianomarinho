<?php
echo 'open_basedir = "' . ini_get('open_basedir') .'"'. "\n";
ini_set('open_basedir', ':/dev/urandom');
echo 'open_basedir = "' . ini_get('open_basedir') .'"'. "\n";
echo 'ini_get_all = ';
echo "<pre>";
$inis = ini_get_all();
print_r($inis);
echo "</pre>";