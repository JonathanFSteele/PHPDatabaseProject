<?php
  session_start();
  require 'MySqlInfo.php';
  //Declaration of Variables for Register.
  $LoginID = "";
  $LoginIDErr = "";
  $Email = "";
  $EmailErr = "";
  $Name = "";
  $NameErr = "";
  $LoginPassword = "";
  $LoginPasswordErr = "";
  $VerifyLoginPassword = "";
  $VerifyLoginPasswordErr = "";
  $CheckLoginID = "";
  $CheckEmail = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function Input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    // Check if LoginID is empty
    if (empty($_POST["LoginID"])) {
      $LoginIDErr = "LoginID is required";
    } else {
      $LoginID = Input($_POST["LoginID"]);
      // echo $LoginID."<br />";
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$LoginID)) {
        $LoginIDErr = "Only letters and white space allowed";
      }
    }
    // Check if Email is empty
    if (empty($_POST["Email"])) {
      $EmailErr = "Email is required";
    } else {
      $Email = Input($_POST["Email"]);
      // echo $Email."<br />";
    }
    // Check if Name is empty
    if (empty($_POST["Name"])) {
      $NameErr = "Name is required";
    } else {
      $Name = Input($_POST["Name"]);
      // echo $Name."<br />";
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$Name)) {
        $NameErr = "Only letters and white space allowed";
      }
    }
    // Check if LoginPassword is empty
    if (empty($_POST["LoginPassword"])) {
      $LoginPasswordErr = "Password is required";
    } else {
      $LoginPassword = Input($_POST["LoginPassword"]);
      // echo $LoginPassword."<br />";
    }
    // Check if VerifyLoginPassword is empty
    if (empty($_POST["VerifyLoginPassword"])) {
      $VerifyLoginPasswordErr = "Verified Login Password is required";
    } else {
      $VerifyLoginPassword = Input($_POST["VerifyLoginPassword"]);
      // echo $VerifyLoginPassword."<br />";
    }

  try {
    if($LoginPassword == $VerifyLoginPassword)
    {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $ExistCheckStmt = $conn->prepare("SELECT LoginID, Email FROM Player WHERE LoginID = :RegisterID OR Email = :RegisterEmail");
      $ExistCheckStmt->bindParam(':RegisterID', $LoginID);
      $ExistCheckStmt->bindParam(':RegisterEmail', $Email);
      $ExistCheckStmt->execute();
      $count = $ExistCheckStmt->rowCount();
      //print_r($count);
      if($count == 0){
        $LoginIDErr = "";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO Player(LoginID, Email, Name, Password) VALUES(:RegisterID, :RegisterEmail, :RegisterName, :RegisterPassword)");
        $stmt->bindParam(':RegisterID', $LoginID);
        $stmt->bindParam(':RegisterEmail', $Email);
        $stmt->bindParam(':RegisterName', $Name);
        $stmt->bindParam(':RegisterPassword', $LoginPassword);
        $stmt->execute();
        header("Location: login.php?msg=New+User+Created+Successfully.");
      }
      else {
        $LoginIDErr = "User Already Exists";
      }
    }
    else {
      $VerifyLoginPasswordErr = "Passwords dont match..";
    }
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
  $conn = null;
  }

?>
<head>
  <title>Request a User Account</title>
  <?php require "master_head.php"  ?>
</head>
<body style="margin-top: 150px;">
  <h1 style="text-align: center;">Elite Basketball Management</h1>
  <br />
  <br />
  <br />
  <div style="margin-left: 35%; margin-right: 35%;">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <h2 style="text-align: center;">Request Player Account</h2>
      <br />
      <label class="sr-only">Login ID</label>
      <input class="form-control" name="LoginID" placeholder="Login ID" value="<?php echo $LoginID ?>" required autofocus autocomplete="off" />
      <span style="color:red;"><?php echo $LoginIDErr ?></span>
      <br />
      <label class="sr-only">Email</label>
      <input class="form-control" name="Email" placeholder="Email" value="<?php echo $Email ?>" required autofocus autocomplete="off" />
      <span style="color:red;"><?php echo $EmailErr ?></span>
      <br />
      <label class="sr-only">Name</label>
      <input class="form-control" name="Name" placeholder="Name" value="<?php echo $Name ?>" required autofocus autocomplete="off" />
      <span style="color:red;"><?php echo $NameErr ?></span>
      <br />
      <label class="sr-only">Password</label>
      <input class="form-control" name="LoginPassword" type="password" placeholder="Password" value="<?php echo $LoginPassword ?>" required autofocus autocomplete="off" />
      <span style="color:red;"><?php echo $LoginPasswordErr ?></span>
      <br />
      <label class="sr-only">Verify Password</label>
      <input class="form-control" name="VerifyLoginPassword" type="password" placeholder="Verify Password" value="<?php echo $VerifyLoginPassword ?>" required autofocus autocomplete="off" />
      <span style="color:red;"><?php echo $VerifyLoginPasswordErr ?></span>
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Submit">Request</button>
      <br />
      <div style="text-align: center;">
        <a href="playerOrManager.php">Back</a>
      </div>
    </form>
  </div>
  <footer class="footer" style="background-color: #e9ecef; margin-top: 200px;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
