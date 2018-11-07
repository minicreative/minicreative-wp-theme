<?php

// Include compiler files
include __DIR__ . '/compile/Colors.php';
include __DIR__ . '/compile/Compiler.php';
include __DIR__ . '/compile/Formatter.php';
include __DIR__ . '/compile/Formatter/Compressed.php';
include __DIR__ . '/compile/Formatter/Crunched.php';
include __DIR__ . '/compile/Formatter/Expanded.php';
include __DIR__ . '/compile/Formatter/Nested.php';
include __DIR__ . '/compile/Parser.php';
include __DIR__ . '/compile/Server.php';

// Map classes
class scssc extends \Leafo\ScssPhp\Compiler {}
class scss_parser extends \Leafo\ScssPhp\Parser {}
class scss_formatter extends \Leafo\ScssPhp\Formatter\Expanded {}
class scss_formatter_nested extends \Leafo\ScssPhp\Formatter\Nested {}
class scss_formatter_compressed extends \Leafo\ScssPhp\Formatter\Compressed {}
class scss_formatter_crunched extends \Leafo\ScssPhp\Formatter\Crunched {}
class scss_server extends \Leafo\ScssPhp\Server {}

// Setup server
$scss = new scssc();
$scss->setFormatter("scss_formatter_compressed");
$server = new scss_server("../scss/", null, $scss);
$server->serve();

?>