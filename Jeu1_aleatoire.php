<?php
session_start();

$sequence = array();  // vidé le tableau 
for ($i = 0; $i < 4; $i++) { // bouble de 4
    $sequence[] = rand(1, 9); // met les 4 chiffre au hasard dans un tableau 
}


session_destroy();
?>