<?php
require_once '../inc/functions.php';
require_once '../inc/config.php';
require_once '../classes/DBData.php';

$DBData = new DBData($config);

// Vos essais ici
// ...

echo '<pre>';
print_r($DBData->bestFrMovie());
echo '</pre>';

/*
 * Tests
 * Pas touche !
 */
displayExo(3, $DBData->bestFrMovie()->title === 'Amélie');
