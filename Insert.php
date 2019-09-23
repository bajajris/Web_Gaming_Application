<?php

//database connect variables
$user = "bajajris_guest";
$passwd = "Rishabh@2001";
$hostname = "localhost";
//input from form
$name = $_POST["name"];
$password = $_POST["password"];
$email = $_POST["email"];
$gender = $_POST["gender"];
try {//connect to database
    $conn = new PDO("mysql:host=$hostname;dbname=bajajris_Practice", $user, $passwd);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
try {
    //prepare sql query
    $statement = $conn->prepare("INSERT INTO Validate (Username,Password,Email,Gender) VALUES (:user,:pass,:email,:gender)");
    //param associative array for inserting values into the table
    $param = array(":user" => $name, ":pass" => $password, ":email" => $email, ":gender" => $gender);
    $execOk = $statement->execute($param);
    if ($execOk) {
        // if successful include loginpage.html for verification
        include 'loginpage.html';
    } else {
        // error executing query:
        print_r($conn->errorInfo());
        $statement->debugDumpParams();
    }
} catch (Exception $e) {
    //catch exception
    echo "<h1>The User already exists</h1>";
    echo "<a href='index.html'>GO BACK</a>";
}
?>