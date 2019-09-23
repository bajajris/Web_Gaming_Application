<html>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "styles_hall_of_fame.css" /><!-- link styles -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        //database connect variables
        $user = "bajajris_guest";
        $passwd = "Rishabh@2001";
        $hostname = "localhost";
        echo "<h1>HALL OF FAME</h1>";
        try {
            //conect database
            $conn = new PDO("mysql:host=$hostname;dbname=bajajris_Practice", $user, $passwd);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //    echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        try {
                //prepare sql query
            $statement = $conn->prepare("SELECT * FROM Winners ORDER BY WINS DESC LIMIT 10");
            $execOk = $statement->execute(); //execute query
            // displaying a table with top 10 values in Hall of fame page
            echo "<table border=2px;>";
            echo "<tr><th>" . "Player Name" . "</th><th>" . "Game Name" . "</th><th>" . "Wins" . "</th></tr>";  //$row['index'] the index here is a field name
//displaying each column and row
            if ($execOk) {
                while ($row = $statement->fetch()) {
                    echo "<tr><td>" . $row['Player'] . "</td><td>" . $row['Game'] . "</td><td>" . $row['Wins'] . "</td></tr>";  //$row['index'] the index here is a field name
                }
                echo "</table>";
                echo "<nav><a href='loginpage.html'>LOGOUT</a></nav>";
                echo "<nav><a href='playerInfo.html'>CHOOSE GAME</a></nav>";

                // do whatever you like with the results
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
    </body>
</html>
