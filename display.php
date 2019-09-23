<?php

session_start(); // start session

//database connect variables
$user = "bajajris_guest";
$passwd = "Rishabh@2001";
$hostname = "localhost";
//input from form
$name = $_SESSION["name"];
$game = $_SESSION["game"];
$wins = $_GET["totalWins"];
$_SESSION['totalWins'] = $wins;
$validated = false;

try {
    //connect to database
    $conn = new PDO("mysql:host=$hostname;dbname=bajajris_Practice", $user, $passwd);
// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
try {
        //prepare sql query
    $statement = $conn->prepare("SELECT Player,Game FROM Winners");
    $execOk = $statement->execute();  // execute statement
    global $validated;
    if ($execOk) {
        // check every row in table
        while ($row = $statement->fetch()) {
            // check if player name and game name are similar or not
            if ($name == $row["Player"] && $game == $row["Game"]) {
                $validated = true;
            }
        }
        //if both different insert into winners table
        if ($validated == false) {
            include 'newPlayerWin.php';
        } else {
            // else update game wins value
            include 'updateWin.php';
        }
    } else {
// error executing query:
        print_r($conn->errorInfo());
        $statement->debugDumpParams();
        echo "<a href='loginpage.html'>Login</a>" . "<br>";
    }
} catch (Exception $e) {
    // catch exception
    echo 'Message: ' . $e->getMessage();
    echo "Bad input";
}
