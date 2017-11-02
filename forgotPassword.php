<?php
  require 'MySqlInfo.php';
  require "changePassword.php";
  $EmailAddress = "";
  $EmailAddressErr = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function Input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    if (empty($_POST["EmailAddress"])) {
      $EmailAddressErr = "EmailAddress is required";
    } else {
      $EmailAddress = Input($_POST["EmailAddress"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$EmailAddress)) {
        $EmailAddressErr = "Only letters and white space allowed";
      }
    }

    //echo "WE ARE POSTING ".$EmailAddress;
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $ExistCheckStmt = $conn->prepare("SELECT Email FROM Player WHERE Email = :EmailAddress");
    $ExistCheckStmt->bindParam(':EmailAddress', $EmailAddress);
    $ExistCheckStmt->execute();
    $count = $ExistCheckStmt->rowCount();
    //echo "<br />count: ".$count;
    if($count == 1)
    {
      //echo "WE ARE CHANGING PAGES";
      $_SESSION['GlobalEmail'] = $EmailAddress;
      header("Location: resetPassword.php");
    }
    $conn = null;
  }
?>
<head>
  <title>Forgot Password</title>
  <?php require "master_head.php";  ?>
</head>
<body style="margin-top: 150px;">
  <h1 style="text-align: center;">Elite Basketball Management</h1>
  <br />
  <br />
  <br />
  <div style="margin-left: 35%; margin-right: 35%;">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <h2 style="text-align: center;">Forgot Password</h2>
      <br />
      <label class="sr-only">Email Address</label>
      <input class="form-control" name="EmailAddress" placeholder="Email Address" value="<?php echo $EmailAddress ?>" required autofocus autocomplete="off" />
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit">Reset</button>
      <br />
      <div style="text-align: center;">
        <a href="login.php">Back</a>
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
