<?php
require 'vendor/autoload.php';

use App\BracketBalancer;

$bracketBalancer = new BracketBalancer('{asfd}');

$bracketBalancer->validate();

$bracketBalancer = new BracketBalancer('(a{s[fd');

$bracketBalancer->validate();

$bracketBalancer = new BracketBalancer('(asfd}');

$bracketBalancer->validate();

$bracketBalancer = new BracketBalancer('asfd}');

$bracketBalancer->validate();
