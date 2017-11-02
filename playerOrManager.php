<head>
  <title>Are you a Player or a Manager?</title>
  <?php require "master_head.php"  ?>
</head>
<body style="margin-top: 150px;">
  <h1 style="text-align: center;">Elite Basketball Management</h1>
  <h2 style="text-align: center;">Are you signing up as a player or a Manager?</h2>
  <br />
  <br />
  <br />
  <div style="margin-left: 35%; margin-right: 35%;">
      <div class="row">
        <div class="col-md-6">
          <form action="requestPlayer.php">
            <button class="btn btn-lg btn-primary btn-block">Player</button>
          </form>
        </div>
        <div class="col-md-6">
          <form action="register.php">
            <button class="btn btn-lg btn-info btn-block">Manager</button>
          </form>
        </div>
      </div>
      <br />
      <div style="text-align: center;">
        <a href="login.php">Back</a>
      </div>
  </div>
  <footer class="footer" style="background-color: #e9ecef; margin-top: 200px;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
