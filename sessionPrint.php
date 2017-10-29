<?php
  session_start();
?>
<html>
<body>
  <h1>Session Dump: All Session Variables</h1>
  <?php
  print_r($_SESSION);
  ?>
</body>
</html>
