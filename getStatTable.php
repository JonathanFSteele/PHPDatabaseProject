<?php
require 'MySqlInfo.php';
function getStatTable($PlayerID)
{
  global $username, $password, $servername, $dbname;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        echo "Got to Line 8";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM Stats WHERE PlayerID=:PlayerID");
        $stmt->bindParam(':PlayerID', $PlayerID);
        $stmt->execute();

        $rows = "";
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
            $Year = $v[Year];
            echo "<br />YEAR: ".$Year."<br />";
            $TotalPoints = $v[TotalPoints];
            $ASPG = $v[ASPG];
            print_r($v);
            $rows .= "<tr><td>".$Year."</td><td>".$TotalPoints."</td><td>".$ASPG."</td></tr>";
        }
        echo "<table>
               <tr><th>Year</th><th>Total Points</th><th>ASPG</th></tr>
               ".$rows."
             </table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

getStatTable(1);
