<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 'on');
  require 'authLibraries.php';
  redirectIfNotInRole("Manager");
?>
<head>
  <title>Games</title>
  <?php require "master_head.php"  ?>
  <?php require 'MySqlInfo.php' ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Games</h1>
    </div>
  </div>
  <div class="container">
    <?php

    class TableRows extends RecursiveIteratorIterator
    {
        public function __construct($it)
        {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        public function current()
        {
            return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
        }

        public function beginChildren()
        {
            echo "<tr>";
        }

        public function endChildren()
        {
            echo "</tr>" . "\n";
        }
    }
    //
    // echo "LoginID: ".$_SESSION["LoginID"];
    // $LoginIDLocal = $_SESSION["LoginID"];
//    $LoggedInID = $_SESSION["LoginRowID"];
    $LoginID = $_SESSION["LoginID"];
    // try {
    //     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     $LoggedInUser = $conn->prepare("SELECT ID FROM Player WHERE LoginID=:LoginID");
    //     $LoggedInUser->bindParam(':LoginID', $LoginIDLocal);
    //     $LoggedInUser->execute();
    //
    //     // set the resulting array to associative
    //     $result = $LoggedInUser->setFetchMode(PDO::FETCH_ASSOC);
    //     $LoggedInID = (int)$result;
    // } catch (PDOException $e) {
    //     echo "Error: " . $e->getMessage();
    // }

    //************************************************************
    // Game Table
    //************************************************************
    echo "<h2>Game Table</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>GameID</th><th>Date</th><th>Result</th><th>PlayingVenue</th><th>OpponentTeam</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM Game");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // Play Table
    //************************************************************
    echo "<h2>Play Table</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>PlayerID</th><th>GameID</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM Play");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    // function myTest()
    // {
    //     global $name;
    //     echo "inside myTest() function. $name<br />";
    //     echo "testing ","and again.<br />";
    //     echo "testing " . $name . " in an sentence.<br />";
    //     global $x;
    //     var_dump($x);
    // }
    //
    // function arrayTests()
    // {
    //     echo "-------- arrayTests function ---------<br /><br />";
    //     $cars = array("Volvo","BMW", "Toyota");
    //     var_dump($cars);
    //     echo "<br />";
    //     for ($x = 0; $x <count($cars); $x++) {
    //         echo "I like $cars[$x] <br />";
    //     }
    //     foreach ($cars as $car) {
    //         echo "car: $car <br />";
    //     }
    //     echo "<br /><br />";
    // }
    //
    // //myTest();
    // arrayTests();
    //
    // class Car
    // {
    //     public function Car()
    //     {
    //         $this->model = "VW";
    //         $this->color = "blue";
    //     }
    // }
    // function testCar()
    // {
    //     $herbie = new Car();
    //     var_dump($herbie);
    //     echo "<br />";
    //     echo "car color: $herbie->color<br />";
    // }
    //
    // testCar();

    ?>
  </div>
  <footer class="footer" style="background-color: #e9ecef;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
