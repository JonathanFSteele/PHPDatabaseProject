<?php
  session_start();
  require 'MySqlInfo.php';
  $LoginID = "";
  $loginpassword = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    if (empty($_POST["loginid"])) {
      $emailErr = "LoginID is required";
    } else {
      $LoginID = test_input($_POST["loginid"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$LoginID)) {
        $emailErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["loginpassword"])) {
      $loginpasswordErr = "Password is required";
    } else {
      $loginpassword = test_input($_POST["loginpassword"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$loginpassword)) {
        $passwordErr = "Only letters and white space allowed";
      }
    }
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM Player WHERE LoginID=:loginid AND Password=:loginpassword");
      $stmt->bindParam(':loginid', $LoginID);
      $stmt->bindParam(':loginpassword', $loginpassword);
      $stmt->execute();
      $LoginSuccessTF = false;
      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
          // echo $v;
          $LoginSuccessTF = true;
      }
      //Successfull Login if LoginSuccessTF = True
      if($LoginSuccessTF)
      {
        // Set session variables
        $_SESSION["LoginID"] = $LoginID;
        $_SESSION["Role"]= "Player"; //This should come from the database

        if (headers_sent()) {
          die("Redirect failed. Please click on this link: <a href=index.php>Index</a>");
        }
        else{
          header("Location: index.php");
          //header("Location: sessionPrint.php");
        }
      }

  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
  $conn = null;
  echo "</table>";
  }

?>
<head>
  <title>Login</title>
  <?php require "master_head.php"  ?>
</head>
<body style="margin-top: 150px;">
  <h1 style="text-align: center;">Elite Basketball Management</h1>
  <br />
  <br />
  <br />
  <div style="margin-left: 35%; margin-right: 35%;">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <h2 style="text-align: center;">Login</h2>
      <br />
      <label class="sr-only">LoginID</label>
      <input class="form-control" name="loginid" placeholder="Login ID" value="<?php echo $LoginID ?>" required autofocus autocomplete="off" />
      <br />
      <label class="sr-only">Password</label>
      <input class="form-control" name="loginpassword" placeholder="Password" value="<?php echo $loginpassword ?>" required autofocus autocomplete="off" />
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Submit">Login</button>
      <br />
      <div style="text-align: center;">
        <div class="row">
          <div class="col-md-6">
            <a href="register.php">Register</a>
          </div>
          <div class="col-md-6">
            <a href="forgotPassword.php">Forgot Password</a>
          </div>
        </div>
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
