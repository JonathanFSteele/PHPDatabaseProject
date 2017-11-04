<?php
    require 'MySqlInfo.php';
    require 'authLibraries.php';
    redirectIfNotLoggedIn();

    $LoginRowID = $_SESSION['LoginRowID'];
    $LoginID = "";
    $LoginErr = "";
    $LoginName = "";
    $LoginNameErr = "";
    $Email = "";
    $EmailErr = "";
    $Birthday = "";
    $Address = "";
    $AddressErr = "";
    $PhoneNumber = "";
    $PhoneNumberErr = "";
    $PlayPos = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      function Input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $LoginID = Input($_POST["LoginID"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$LoginID)) {
        $LoginErr = "Only letters and white space allowed";
      }

      $LoginName = Input($_POST["LoginName"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$LoginName)) {
        $LoginNameErr = "Only letters and white space allowed";
      }

      $Email = Input($_POST["Email"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$Email)) {
        $EmailErr = "Only letters and white space allowed";
      }

      $Birthday = Input($_POST["Birthday"]);
      if($Birthday == undefined || $Birthday == "")
      {
        $Birthday = null;
      }
      $Address = Input($_POST["Address"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$Address)) {
        $AddressErr = "Only letters and white space allowed";
      }

      $PhoneNumber = Input($_POST["PhoneNumber"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$PhoneNumber)) {
        $PhoneNumberErr = "Only letters and white space allowed";
      }

      $PlayPos = Input($_POST["PlayPos"]);
      if($PlayPos == '')
      {
        $PlayPos = null;
      }

      $Password = Input($_POST["Password"]);
      if($Password == '')
      {
        $Password = $_SESSION["Password"];
      }

      try {
          //echo "WE ARE POSTING ".$EmailAddress;
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $UpdateStats = $conn->prepare("UPDATE Player SET LoginID=:LoginID, Name=:LoginName, Email=:Email, Birthday=:Birthday, Address=:Address, PhoneNumber=:PhoneNumber, PlayPos=:PlayPos, Password=:Password WHERE ID=:LoginRowID");
          $UpdateStats->bindParam(':LoginID', $LoginID);
          $UpdateStats->bindParam(':LoginName', $LoginName);
          $UpdateStats->bindParam(':Email', $Email);
          $UpdateStats->bindParam(':Birthday', $Birthday);
          $UpdateStats->bindParam(':Address', $Address);
          $UpdateStats->bindParam(':PhoneNumber', $PhoneNumber);
          $UpdateStats->bindParam(':PlayPos', $PlayPos);
          $UpdateStats->bindParam(':LoginRowID', $LoginRowID);
          $UpdateStats->bindParam(':Password', $Password);
          $UpdateStats->execute();

          //Generate stuff on page again...
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM UserView WHERE LoginID=:LoginID AND Password=:LoginPassword");
          $stmt->bindParam(':LoginID', $LoginID);
          $stmt->bindParam(':LoginPassword', $LoginPassword);
          $stmt->execute();

          $LoginSuccessTF = false;

          // set the resulting array to associative
          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
          foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
              $LoginID = $v.[LoginID];
              $Email = $v[Email];
              $LoginName = $v[Name];
              $Password = $v[Password];
              $Birthday = $v[Birthday];
              $Address = $v[Address];
              $PhoneNumber = $v[PhoneNumber];
              $PlayPos = $v[PlayPos];
              //print_r($v);
          }

          $_SESSION["LoginID"] = $LoginID;
          $_SESSION["LoginName"] = $LoginName;
          $_SESSION["Email"] = $Email;
          $_SESSION["Password"] = $Password;
          $_SESSION["Birthday"] = $Birthday;
          $_SESSION["Address"] = $Address;
          $_SESSION["PhoneNumber"] = $PhoneNumber;
          $_SESSION["PlayPos"] = $PlayPos;

      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }

    }
?>
<head>
  <title>Profile</title>
  <?php require "master_head.php"  ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Profile</h1>
    </div>
  </div>
  <div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <div class="form-group">
        <label for="exampleInputEmail1">Login ID</label>
        <input type="text" name="LoginID" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['LoginID'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" name="LoginName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['LoginName'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['Email'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Birthday</label>
        <input type="date" name="Birthday" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['Birthday'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Address</label>
        <input type="text" name="Address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['Address'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Phone Number</label>
        <input type="text" name="PhoneNumber" class="form-control" aria-describedby="emailHelp" value="<?php echo $_SESSION['PhoneNumber'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <?php
      if($_SESSION['Role'] == 'Player' )
      {
          echo '<div class="form-group">';
          echo '<label for="exampleInputEmail1">Play Pos</label>';
          echo '<select class="form-control" name="PlayPos" id="sel1" value="<?php echo $_SESSION[`PlayPos`] ?>">';

          if($_SESSION['PlayPos'] == null)
          {
            echo "<option selected value=''>None</option>";
          }
          else {
            echo "<option value=''>None</option>";
          }

          if($_SESSION['PlayPos'] == "point guard")
          {
            echo "<option selected>point guard</option>";
          }
          else {
            echo "<option>point guard</option>";
          }

          if($_SESSION['PlayPos'] == "shooting guard")
          {
            echo "<option selected>shooting guard</option>";
          }
          else {
            echo "<option>shooting guard</option>";
          }

          if($_SESSION['PlayPos'] == "small forward")
          {
            echo "<option selected>small forward</option>";
          }
          else {
            echo "<option>small forward</option>";
          }

          if($_SESSION['PlayPos'] == "power forward")
          {
            echo "<option selected>power forward</option>";
          }
          else {
            echo "<option>power forward</option>";
          }

          if($_SESSION['PlayPos'] == "center")
          {
            echo "<option selected>center</option>";
          }
          else {
            echo "<option>center</option>";
          }
          echo "</select>";
          echo "</div>";
        }
      ?>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="Password" class="form-control" id="exampleInputPassword1">
        <small id="passwordHelp" class="form-text text-muted">Leave Password Blank, if you want it to stay the same. Fill it in to change your password.</small>
      </div>
      <button type="submit" class="btn btn-primary">Change Stats</button>
    </form>
  </div>
  <footer class="footer" style="background-color: #e9ecef;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
