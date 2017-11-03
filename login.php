<?php
  //Start the session
  // error_reporting(E_ALL);
  // ini_set('display_errors', 'on');
  session_start();

  require 'MySqlInfo.php';
  $LoginID = "";
  $LoginPassword = "";
  $LoginErr = "";
  $LoginPasswordErr = "";
  $LoginRowID = 0;
  $LoginRole = "";
  $LoginName = "";
  $MainErr = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    if (empty($_POST["LoginID"])) {
      $LoginErr = "LoginID is required";
    } else {
      $LoginID = test_input($_POST["LoginID"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$LoginID)) {
        $LoginErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["LoginPassword"])) {
      $LoginPasswordErr = "Password is required";
    } else {
      $LoginPassword = test_input($_POST["LoginPassword"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$LoginPassword)) {
        $LoginPasswordErr = "Only letters and white space allowed";
      }
    }

  try {

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
          $ApprovedTF = $v[ApprovedTF];
          if($ApprovedTF == '1') //Check to see if the user is approved
          {
            $LoginSuccessTF = true;
            //echo "LoginSuccessful?: ".$LoginSuccessTF;
          }
          $LoginRowID = $v[ID];
          $Email = $v[Email];
          $LoginName = $v[Name];
          $LoginRole = $v[Role];
          $Password = $v[Password];
          $Birthday = $v[Birthday];
          $Address = $v[Address];
          $PhoneNumber = $v[PhoneNumber];
          $PlayPos = $v[PlayPos];
          //print_r($v);
      }

      //Successfull Login if LoginSuccessTF = True
      if($LoginSuccessTF)
      {
        // Set session variables
        $_SESSION["LoginID"] = $LoginID;
        $_SESSION["LoginRowID"] = $LoginRowID;
        $_SESSION["LoginName"] = $LoginName;
        $_SESSION["Role"]= $LoginRole; //This should come from the database
        $_SESSION["Email"] = $Email;
        $_SESSION["Password"] = $Password;
        $_SESSION["Birthday"] = $Birthday;
        $_SESSION["Address"] = $Address;
        $_SESSION["PhoneNumber"] = $PhoneNumber;
        $_SESSION["PlayPos"] = $PlayPos;

        //ADD THE REST OF THEM HERE
        //echo "Loggin In...";
        header("Location: index.php");
        //header("Location: sessionPrint.php");
      }
      else {
        if($ApprovedTF == '0'){
          $MainErr = "Your Account has not been approved Yet";
        }
        else{
          $MainErr = "Your Login or Password is Incorrect. Try Again.";
        }
        session_unset();
        session_destroy();
      }
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
  $conn = null;
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
      <!-- <?php echo "<h1>".$_REQUEST[msg]."</h1>" ?> -->
      <h2 style="text-align: center;">Login</h2>
      <?php echo "<h5 style='color:red; text-align: center;'>".$MainErr."</h5>" ?>
      <br />
      <label class="sr-only">LoginID</label>
      <input class="form-control" name="LoginID" placeholder="Login ID" value="<?php echo $LoginID ?>" required autofocus autocomplete="off" />
      <?php echo "<span style='color:red;'>".$LoginErr."</span>" ?>
      <br />
      <label class="sr-only">Password</label>
      <input class="form-control" name="LoginPassword" type="password" placeholder="Password" value="<?php echo $LoginPassword ?>" required autofocus autocomplete="off" />
      <?php echo "<span style='color:red;'>".$LoginPasswordErr."</span>" ?>
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Submit">Login</button>
      <br />
      <div style="text-align: center;">
        <div class="row">
          <div class="col-md-6">
            <a href="playerOrManager.php">Dont have an Account?</a>
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
