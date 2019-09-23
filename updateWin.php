<html>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "styles_hall_of_fame.css" /><!-- link styles -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        session_start(); // start the session

        // PDO variables to use
        $user = "bajajris_guest";
        $passwd = "Rishabh@2001";
        $hostname = "localhost";
        $name = $_SESSION["name"];
        $game = $_SESSION["game"];
        $wins = $_SESSION["totalWins"];

        try {    //prepare sql query
            $conn = new PDO("mysql:host=$hostname;dbname=bajajris_Practice", $user, $passwd);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //    echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        try {
            // prepare sql statement
            $statement = $conn->prepare("UPDATE Winners set Wins = Wins + :wins where Player=:name AND Game=:game");
                //update win value if player already exists
            $param = array(":wins" => $wins, ":name" => $name,":game"=>$game);
            $execOk = $statement->execute($param);
            if ($execOk) {
                //if successful display hall of fame
                include("hall_of_fame.php");
            } else {
                // error executing query:
                print_r($conn->errorInfo());
                $statement->debugDumpParams();
            }
        } catch (Exception $e) {
            // catch exception
            echo 'Message: ' . $e->getMessage();
            echo "Bad input";
        }
        ?>
    </body>
</html>
