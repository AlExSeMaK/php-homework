<?php

require_once 'Cars.php';
require_once 'Garag.php';

$mers = new Cars('Мерседес');
var_dump($mers);
$bmv = new Cars('bmv');

$garag = new Garag([$bmv, $mers], 'гараж');
var_dump($garag);
