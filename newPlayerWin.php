<html>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "styles_hall_of_fame.css" /><!-- link styles -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        session_start(); // start session

        $user = "bajajris_guest";
        $passwd = "Rishabh@2001";
        $hostname = "localhost";
//echo "$input";
        $name = $_SESSION["name"];
        $game = $_SESSION["game"];
        $wins = $_SESSION["totalWins"];

        try {
            // connect to database
            $conn = new PDO("mysql:host=$hostname;dbname=bajajris_Practice", $user, $passwd);
// set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        try {    //prepare sql query
            $statement = $conn->prepare("INSERT INTO Winners (Player,Game,Wins) VALUES (:name,:game,:wins)");
            $param = array(":name" => $name, ":game" => $game, ":wins" => $wins);
            // insert into winners when info submitted
            $execOk = $statement->execute($param);
            if ($execOk) {
                //if successful display hall of fame page
                include("hall_of_fame.php");
            } else {
                // error executing query:
                print_r($conn->errorInfo());
                $statement->debugDumpParams();
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            echo "Bad input";
        }
        ?>
    </body>
</html>