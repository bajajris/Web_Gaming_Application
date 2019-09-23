<?php
session_start(); // start the session
$_SESSION['game'] = $_GET["gamename"]; // get session of game value from GET of game name from form
$gameVar = $_SESSION['game'];
 // check the type of game chosenby user
if ($gameVar == "Casino_Craps") {
    include 'Casino_Craps.html';
} elseif ($gameVar == "Tic_Tac_Toe") {
    include 'Tic_Tac_Toe.html';
}
