<?php

use app\FileStore\FileStore;

include __DIR__ . '/../../vendor/autoload.php';


$file = new FileStore('dataTest.txt');


foreach ($file->generator() as $line) {
    echo $line;
}