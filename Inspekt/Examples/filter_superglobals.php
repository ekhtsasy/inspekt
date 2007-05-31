<?php
/**
 * Demonstration of:
 * - helper "make*Cage()" methods to create input cage from superglobal
 * - cleanup of HTTP_*_VARS
 * - cage filter methods
 * - "Array Query" method of accessing deep keys in multidim arrays
 */


set_include_path(get_include_path().PATH_SEPARATOR.dirname(dirname(__FILE__)));

require_once('Inspekt.php');

//echo "<pre>"; echo var_dump($_SERVER); echo "</pre>\n";

$serverCage = Inspekt::makeServerCage();

echo "<pre>"; echo var_dump($serverCage); echo "</pre>\n";

echo 'Digits:'.$serverCage->getDigits('QUERY_STRING').'<p/>';
echo 'Alpha:'.$serverCage->getAlpha('QUERY_STRING').'<p/>';
echo 'Alnum:'.$serverCage->getAlnum('QUERY_STRING').'<p/>';
echo 'Raw:'.$serverCage->getRaw('QUERY_STRING').'<p/>';

echo '<pre>$_SERVER:'; echo var_dump($_SERVER); echo "</pre>\n";
echo '<pre>HTTP_SERVER_VARS:'; echo var_dump($HTTP_SERVER_VARS); echo "</pre>\n";

var_dump($serverCage->getAlnum('/argv/0'));