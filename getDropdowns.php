<?php
require 'MySqlInfo.php';
function getPlayerDropdown()
{
  global $username, $password, $servername, $dbname;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT ID, Name FROM Player ORDER BY Name ASC");
        $stmt->execute();

        $rows = "";
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
            $PlayerID = $v[ID];
            $Name = $v[Name];
            $rows .= "<option value='".$PlayerID."'>".$Name."</td></option>";
            //print_r($v);
        }
        return "<select name='PlayerID'>
               <option value='-1'>Select a User</option>
               ".$rows."
             </select>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getTrainingDropdown()
{
  global $username, $password, $servername, $dbname;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT ID, TrainingName FROM Training ORDER BY TrainingName ASC");
        $stmt->execute();

        $rows = "";
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
            $TrainingID= $v[ID];
            $TrainingName = $v[TrainingName];
            $rows .= "<option value='".$TrainingID."'>".$TrainingName."</td></option>";
            //print_r($v);
        }
        return "<select name='TrainingID'>
               <option value='-1'>Select Training</option>
               ".$rows."
             </select>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getGamesDropdown()
{
  global $username, $password, $servername, $dbname;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT GameID ,PlayingVenue, Date FROM Game ORDER BY Date DESC");
        $stmt->execute();

        $rows = "";
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
            $GameID=$v[GameID];
            $Date=$v[Date];
            $PlayingVenue=$v[PlayingVenue];
            $rows .= "<option value='".$GameID."'>".$PlayingVenue." | ".$Date."</td></option>";
            //print_r($v);
        }
        return "<select name='GameID'>
               <option value='-1'>Select Game</option>
               ".$rows."
             </select>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// echo getGamesDropdown();
// echo getPlayerDropdown();
// echo getTrainingDropdown();
