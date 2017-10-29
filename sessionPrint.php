<?php
  session_start();
?>
<html>
<body>
  <h1>Session Dump: All Session Variables</h1>
  <?php
    print_r($_SESSION);
    echo "<br />";
    if (!isset($_SESSION['LoginID']) || empty($_SESSION['LoginID']) ) {
      echo "User not logged in";
    }
    else {
      echo "User Logged in : ", $_SESSION["LoginID"];
    }
  ?>
</body>
</html>
