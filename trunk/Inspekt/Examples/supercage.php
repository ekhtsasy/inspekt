<?php

set_include_path(get_include_path().PATH_SEPARATOR.dirname(dirname(__FILE__)));

require_once('Inspekt.php');

$superCage = Inspekt::makeSuperCage();

echo "<pre>"; echo var_dump($superCage); echo "</pre>\n";

echo 'Digits:'.$superCage->server->getDigits('QUERY_STRING').'<p/>';
echo 'Alpha:'.$superCage->server->getAlpha('QUERY_STRING').'<p/>';
echo 'Alnum:'.$superCage->server->getAlnum('QUERY_STRING').'<p/>';
echo 'Raw:'.$superCage->server->getRaw('QUERY_STRING').'<p/>';