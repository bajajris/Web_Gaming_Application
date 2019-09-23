<?php
session_start(); // start session
//database connect variables
$user = "bajajris_guest";
$passwd = "Rishabh@2001";
$hostname = "localhost";
$validated = "false";
$log = $_POST["loginInput"];
$pass = $_POST["passwordInput"];
$_SESSION["name"] = $_POST["loginInput"];
$num = 1; // error display 

try {//connect to database
    $conn = new PDO("mysql:host=$hostname;dbname=bajajris_Practice", $user, $passwd);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
try {
    //prepare sql query
    $statement = $conn->prepare("SELECT Username,Password FROM Validate;");
    $execOk = $statement->execute();
    if ($execOk) { //    "Connected successfully"
        while ($row = $statement->fetch()) {
            if ($log == $row["Username"] && $pass == $row["Password"]) {
//                ask for game name if user validated
                include "playerInfo.html";
                global $num;
                $num=0;
            }
        }
        if ($num === 1) {
            //else display message and ask to go back
            echo "<h1>Wrong Password</h1>"."<br>";
            echo "<a href='loginpage.html'>GO BACK</a>";
        }
    } else {
        // error executing query:
        print_r($conn->errorInfo());
        $statement->debugDumpParams();
    }
} catch (Exception $e) {
    //catch exception
    echo 'Message: ' . $e->getMessage();
    echo "Bad input";
}
?>