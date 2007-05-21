<?php

set_include_path(get_include_path().PATH_SEPARATOR.dirname(dirname(__FILE__)));

require_once('../Inspekt.php');

echo "<pre>"; echo var_dump($_SERVER); echo "</pre>\n";

$fServer = Inspekt::getInputServer();

echo "<pre>"; echo var_dump($fServer); echo "</pre>\n";

echo 'Digits:'.$fServer->getDigits('HTTP_ACCEPT_CHARSET').'<p/>';
echo 'Alpha:'.$fServer->getAlpha('HTTP_ACCEPT_CHARSET').'<p/>';
echo 'Alnum:'.$fServer->getAlnum('HTTP_ACCEPT_CHARSET').'<p/>';
echo 'Raw:'.$fServer->getRaw('HTTP_ACCEPT_CHARSET').'<p/>';

echo '<pre>$_SERVER:'; echo var_dump($_SERVER); echo "</pre>\n";
echo '<pre>HTTP_SERVER_VARS:'; echo var_dump($HTTP_SERVER_VARS); echo "</pre>\n";
