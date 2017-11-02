<?php
  require 'MySqlInfo.php';
  require "changePassword.php";
  $ChosenEmail = $_SESSION['GlobalEmail'];
  $CurrentTable = $_SESSION['Table'];
  //echo "Global Email: ".$ChosenEmail;
  //echo "Global Table: ".$CurrentTable;
  $newPassword = "";
  $newPasswordErr = "";
  $verifyPassword = "";
  $verifyPasswordErr = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function Input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    if (empty($_POST["newPassword"])) {
      $newPasswordErr = "newPassword is required";
    } else {
      $newPassword = Input($_POST["newPassword"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$newPassword)) {
        $newPasswordErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["verifyPassword"])) {
      $verifyPasswordErr = "verifyPassword is required";
    } else {
      $verifyPassword = Input($_POST["verifyPassword"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$verifyPassword)) {
        $verifyPasswordErr = "Only letters and white space allowed";
      }
    }
    //echo "<br />newPassword: ".$newPassword;
    //echo "<br />verifyPassword: ".$verifyPassword;

    if($newPassword == $verifyPassword)
    {
      if($CurrentTable == 0)
      {
        //echo "WE ARE POSTING ".$EmailAddress;
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $UpdateColumn = $conn->prepare("UPDATE Player SET Password=:Password WHERE Email = :EmailAddress");
        $UpdateColumn->bindParam(':EmailAddress', $ChosenEmail);
        $UpdateColumn->bindParam(':Password', $newPassword);
        $UpdateColumn->execute();

        header("Location: login.php");
      } else {
        //echo "WE ARE POSTING ".$EmailAddress;
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $UpdateColumn = $conn->prepare("UPDATE Manager SET Password=:Password WHERE Email = :EmailAddress");
        $UpdateColumn->bindParam(':EmailAddress', $ChosenEmail);
        $UpdateColumn->bindParam(':Password', $newPassword);
        $UpdateColumn->execute();

        header("Location: login.php");
      }

      $conn = null;
    }
    else {
      $verifyPasswordErr = "";
    }
  }

?>
<head>
  <title>Reset Password</title>
  <?php require "master_head.php"  ?>
</head>
<body style="margin-top: 150px;">
  <h1 style="text-align: center;">Elite Basketball Management</h1>
  <br />
  <br />
  <br />
  <div style="margin-left: 35%; margin-right: 35%;">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <h2 style="text-align: center;">Reset Password</h2>
      <br />
      <label class="sr-only">New Password</label>
      <input class="form-control" name="newPassword" placeholder="New Password" type="password" max="6" value="<?php echo $newPassword ?>" required autofocus autocomplete="off" />
      <br />
      <label class="sr-only">Verify Password</label>
      <input class="form-control" name="verifyPassword" placeholder="Verify Password" type="password" max="6" value="<?php echo $verifyPassword ?>" required autofocus autocomplete="off" />
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      <br />
    </form>
  </div>
  <footer class="footer" style="background-color: #e9ecef; margin-top: 200px;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
