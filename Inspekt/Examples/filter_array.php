<?php

require_once('Inspekt.php');

echo "<p>Filtering an arbitrary array using Inspekt::noTags()</p>\n\n";

$d = array();
$d['input'] = '<img>yes</img>';
$d[] = array('foo', 'bar<br />', 'yes<P>');
$d['x']['woot'] = array('booyah'=>'bar',
						'ultimate'=>'<strong>hi there!</strong>',
						);

echo "<pre>BEFORE:"; echo print_r($d, true); echo "</pre>\n";

$newd = Inspekt::noTags($d);

echo "<pre>AFTER:"; echo print_r($newd, true); echo "</pre>\n";
