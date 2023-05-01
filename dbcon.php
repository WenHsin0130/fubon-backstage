<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

$factory = (new Factory)
    ->withServiceAccount('fubonagent-yqqh-firebase-adminsdk-yqiao-3a2f047222.json')
    ->withDatabaseUri('https://fubonagent-yqqh-default-rtdb.firebaseio.com/');

$database = $factory->createDatabase();
$auth = $factory->createAuth();

?>