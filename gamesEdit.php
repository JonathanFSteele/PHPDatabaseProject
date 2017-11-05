<?php
    require 'MySqlInfo.php';
    require 'authLibraries.php';
    redirectIfNotInRole("Manager");

    //$LoginRowID = $_SESSION['LoginRowID'];
    $ID = $_GET['Update'];
    $Date= "";
    $PlayingVenue= "";
    $OpponentTeam = "";
    $Result = "";

    //Generate stuff on page again...
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM Game WHERE GameID=:ID");
    $stmt->bindParam(':ID', $ID);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        $Date = $v[Date];
        $PlayingVenue = $v[PlayingVenue];
        $OpponentTeam = $v[OpponentTeam];
        $Result = $v[Result];
        //print_r($v);
      }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      function Input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $Date = Input($_POST["Date"]);

      $PlayingVenue = Input($_POST["PlayingVenue"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$PlayingVenue)) {
        $PlayingVenueErr = "Only letters and white space allowed";
      }

      $OpponentTeam = Input($_POST["OpponentTeam"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$OpponentTeam)) {
        $OpponentTeamErr = "Only letters and white space allowed";
      }

      $Result = Input($_POST["Result"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$Result)) {
        $ResultErr = "Only letters and white space allowed";
      }

      try {
          //echo "ID: ".$ID;
          if($ID == 0)
          {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $UpdateStats = $conn->prepare("INSERT INTO Game (Date, PlayingVenue, OpponentTeam, Result) VALUES (:Date, :PlayingVenue, :OpponentTeam, :Result)");
            $UpdateStats->bindParam(':Date', $Date);
            $UpdateStats->bindParam(':PlayingVenue', $PlayingVenue);
            $UpdateStats->bindParam(':OpponentTeam', $OpponentTeam);
            $UpdateStats->bindParam(':Result', $Result);
            $UpdateStats->execute();

            header("Location: games.php?msg=Added+New+Game");
          }
          else {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $UpdateStats = $conn->prepare("UPDATE Game SET Date=:Date, PlayingVenue=:PlayingVenue, OpponentTeam=:OpponentTeam, Result=:Result WHERE GameID=:ID");
            $UpdateStats->bindParam(':ID', $ID);
            $UpdateStats->bindParam(':Date', $Date);
            $UpdateStats->bindParam(':PlayingVenue', $PlayingVenue);
            $UpdateStats->bindParam(':OpponentTeam', $OpponentTeam);
            $UpdateStats->bindParam(':Result', $Result);
            $UpdateStats->execute();

            header("Location: games.php?msg=Updated+Existing+Game");
          }

      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
    }
?>
<head>
  <title>Game Add/Edit</title>
  <?php require "master_head.php"  ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Game Add/Edit</h1>
    </div>
  </div>
  <div class="container">
    <form method="post" action="<?php echo 'gamesEdit.php?Update='.$ID;?>">
      <div class="form-group">
        <label for="TrainingName">Date</label>
        <input type="date" name="Date" class="form-control" id="Date" aria-describedby="DateHelp" value="<?php echo $Date ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">Every Training Name must be unique</small> -->
      </div>
      <div class="form-group">
        <label for="PlayingVenue">Playing Venue</label>
        <input type="text" name="PlayingVenue" class="form-control" id="PlayingVenue" aria-describedby="PlayingVenueHelp" value="<?php echo $PlayingVenue ?>">
      </div>
      <div class="form-group">
        <label for="OpponentTeam">OpponentTeam</label>
        <input type="text" name="OpponentTeam" class="form-control" id="exampleInputEmail1" aria-describedby="OpponentTeamHelp" value="<?php echo $OpponentTeam ?>">
      </div>
      <div class="form-group">
        <label for="Result">Result</label>
        <!-- <input type="text" name="Result" class="form-control" id="exampleInputEmail1" aria-describedby="ResultHelp" value="<?php echo $Result ?>"> -->
        <select name="Result">
          <?php 
          if($Result == "Win") echo "<option selected>Win</option>"; else echo "<option>Win</option>";
          if($Result == "Lose") echo "<option selected>Lose</option>"; else echo "<option>Lose</option>";
          if($Result == "Tie") echo "<option selected>Tie</option>"; else echo "<option>Tie</option>";
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update/Add</button>
    </form>
  </div>
  <footer class="footer" style="background-color: #e9ecef;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
