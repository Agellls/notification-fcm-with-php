<?php
require_once("vendor/autoload.php");

use Minishlink\WebPush\VAPID;

print_r(VAPID::createVapidKeys());

/*
Array
    [publicKey] => BBv6JEfNJBInA1vTKz_NyOixgvTSBk4xdLFFJ3HCcEQMmS5EfyGu7bcK8ZbOCEpjTwpMFeBu8YAh1fny6xAvxZc
    [privateKey] => N6T_nOBwSvvCs7-87f2bkEQrbatqemKqkKLLTSCJovs
*/