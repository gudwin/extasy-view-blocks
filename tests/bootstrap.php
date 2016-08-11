<?php
use Faid\Configure\Configure;

require_once 'vendor/autoload.php';

Configure::write('SimpleCache', array(
    'Engine' => '\\Faid\\Cache\\Engine\\FileCache',
    'FileCache' => array(
        'BaseDir' =>realpath( __DIR__ . '/../tmp/'). '/'
    ),
));