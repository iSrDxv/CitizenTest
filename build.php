<?php

// https://github.com/dresnite/skyblock/blob/stable/build.php

$output = "citizen.phar";

if(is_file($output)) {
    unlink($output);
}

$phar = new Phar($output);
$phar->startBuffering();
$phar->buildFromDirectory(__DIR__);
$phar->stopBuffering();

echo "PocketMine-MP Plugin: phar file has been built";
