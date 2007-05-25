<?php

require_once('Inspekt.php');

echo "<p>Filtering an arbitrary array using Inspekt::noTags()</p>\n\n";

$d = array();
$d['input'] = '<img id="475">yes</img>';
$d[] = array('foo', 'bar<br />', 'yes<P>', 1776);
$d['x']['woot'] = array('booyah'=>'meet at the bar at 7:30 pm',
						'ultimate'=>'<strong>hi there!</strong>',
						);

echo "<pre>BEFORE:"; echo print_r($d, true); echo "</pre>\n";

$newd = Inspekt::noTags($d);

echo "<pre>noTags:"; echo print_r($newd, true); echo "</pre>\n";

$newd = Inspekt::getDigits($d);

echo "<pre>getDigits:"; echo print_r($newd, true); echo "</pre>\n";

$filter_d = new Inspekt_Input($d);

echo "<pre>getAlpha('/x/woot')"; echo var_dump($filter_d->getAlpha('/x/woot')); echo "</pre>\n";