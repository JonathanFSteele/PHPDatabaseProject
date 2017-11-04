<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 'on');
  require 'authLibraries.php';
  redirectIfNotInRole("Manager");
?>
<head>
  <title>Player Management</title>
  <?php require "master_head.php"  ?>
  <?php require 'MySqlInfo.php' ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Management</h1>
    </div>
  </div>
  <div style="margin-left: 10px;">
    <?php

    function getStatTable($PlayerID)
    {
      global $username, $password, $servername, $dbname;
      //echo "Calling getStatTable: ".$PlayerID;
      $conn1 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $SelectStmt = $conn1->prepare("SELECT * FROM Stats WHERE PlayerID=:PlayerID");
      $SelectStmt->bindParam(':PlayerID', $PlayerID);
      $SelectStmt->execute();
      $rows = "";
      $count = 0;
      $result = $SelectStmt->setFetchMode(PDO::FETCH_ASSOC);
      foreach (new RecursiveArrayIterator($SelectStmt->fetchAll()) as $k=>$v) {
          $Year = $v[Year];
          $TotalPoints = $v[TotalPoints];
          $ASPG = $v[ASPG];
          $rows .= "<tr><td>".$Year."</td><td>".$TotalPoints."</td><td>".$ASPG."</td></tr>";
          $count += 1;
      }
      $conn1 = null;
      if($count > 0)
      {
        return "<td style='border:1px solid black;'><table>
                  <tr><th>Year</th><th>Total Points</th><th>ASPG</th></tr>
                  ".$rows."
                </table></td>";
      }
      else {
        return "<td style='border:1px solid black;''></td>";
      }
    }

    class TableRows extends RecursiveIteratorIterator
    {
        public function __construct($it)
        {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        public function current()
        {
          if(parent::key() == 'ID'){
            $this->id = parent::current();
          }
          if(parent::key() == 'Password')
          {
            return "<td style='border:1px solid black;'><form method='post' action='resetPlayerPassword.php'><input style='width: 90px;' name='newPassword' type='password' maxlength='8' /><button type='submit' class='btn-warning' name='subBtn' value='".  $this->id ."'>Reset</button></form></td>";
          }
          if(parent::key() == 'Stats')
          {
            return getStatTable($this->id);
          }
          if(parent::key() == 'ApprovedTF')
          {
            if(parent::current() == '0')
            {
              return "<td style='border:1px solid black;'><form method='post' action='activatePlayer.php'><button type='submit' class='btn-primary' name='subBtn' value='".  $this->id ."'>Approve</button></form></td>";
            }
            else {
              return "<td style='border:1px solid black;'><b style='color: green'>Approved</b></td>";
            }
          }
          else {
            return "<td style='border:1px solid black;'>" . parent::current() . "</td>";
          }

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
    // Player Table
    //************************************************************
    echo "<h2>Players</h2>";
    echo "<h5 style='color: green;'>".$_GET["msg"]."</h5>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>ID</th><th>Login</th><th>Name</th><th>Password</th><th>Email</th><th>Birthday</th><th>Address</th><th>PhoneNumber</th><th>Position</th><th>Approved TF</th><th>Stats</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM PlayerView");
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
    ?>
  </div>
  <footer class="footer" style="background-color: #e9ecef;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
