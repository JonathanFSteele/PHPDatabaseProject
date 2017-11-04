<?php
    require 'MySqlInfo.php';
    require 'authLibraries.php';
    redirectIfNotInRole("Manager");

    //$LoginRowID = $_SESSION['LoginRowID'];
    $ID = $_GET['Update'];
    $TrainingName = "";
    $Instruction = "";
    $TimePeriodInHour = "";

    //Generate stuff on page again...
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM Training WHERE ID=:ID");
    $stmt->bindParam(':ID', $ID);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        $TrainingName = $v[TrainingName];
        $Instruction = $v[Instruction];
        $TimePeriodInHour = $v[TimePeriodInHour];
        //print_r($v);
      }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      function Input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $TrainingName = Input($_POST["TrainingName"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$TrainingName)) {
        $TrainingNameErr = "Only letters and white space allowed";
      }

      $Instruction = Input($_POST["Instruction"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$Instruction)) {
        $InstructionErr = "Only letters and white space allowed";
      }

      $TimePeriodInHour = Input($_POST["TimePeriodInHour"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$TimePeriodInHour)) {
        $TimePeriodInHourErr = "Only letters and white space allowed";
      }

      try {
          //echo "ID: ".$ID;
          if($ID == 0)
          {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $UpdateStats = $conn->prepare("INSERT INTO Training (TrainingName, Instruction, TimePeriodInHour) VALUES (:TrainingName, :Instruction, :TimePeriodInHour)");
            $UpdateStats->bindParam(':TrainingName', $TrainingName);
            $UpdateStats->bindParam(':Instruction', $Instruction);
            $UpdateStats->bindParam(':TimePeriodInHour', $TimePeriodInHour);
            $UpdateStats->execute();

            header("Location: training.php?msg=Added+New+Training");
          }
          else {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $UpdateStats = $conn->prepare("UPDATE Training SET TrainingName=:TrainingName, Instruction=:Instruction, TimePeriodInHour=:TimePeriodInHour WHERE ID=:ID");
            $UpdateStats->bindParam(':ID', $ID);
            $UpdateStats->bindParam(':TrainingName', $TrainingName);
            $UpdateStats->bindParam(':Instruction', $Instruction);
            $UpdateStats->bindParam(':TimePeriodInHour', $TimePeriodInHour);
            $UpdateStats->execute();

            header("Location: training.php?msg=Updated+Existing+Training");
          }

      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
    }
?>
<head>
  <title>Training Add/Edit</title>
  <?php require "master_head.php"  ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Training Add/Edit</h1>
    </div>
  </div>
  <div class="container">
    <form method="post" action="<?php echo 'trainingEdit.php?Update='.$ID;?>">
      <div class="form-group">
        <label for="TrainingName">Training Name</label>
        <input type="text" name="TrainingName" class="form-control" maxlength="16" id="TrainingName" aria-describedby="TrainingNameHelp" value="<?php echo $TrainingName ?>">
        <small id="emailHelp" class="form-text text-muted">Every Training Name must be unique</small>
      </div>
      <div class="form-group">
        <label for="Instruction">Instruction</label>
        <input type="textarea" name="Instruction" class="form-control" id="Instruction" aria-describedby="InstructionHelp" value="<?php echo $Instruction ?>">
      </div>
      <div class="form-group">
        <label for="TimePeriodInHour">TimePeriod In Hour</label>
        <input type="number" name="TimePeriodInHour" class="form-control" id="exampleInputEmail1" aria-describedby="TimePeriodInHourHelp" value="<?php echo $TimePeriodInHour ?>">
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
