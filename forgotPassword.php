<head>
  <title>Forgot Password</title>
  <?php require "master_head.php"  ?>
</head>
<body style="margin-top: 150px;">
  <h1 style="text-align: center;">Elite Basketball Management</h1>
  <br />
  <br />
  <br />
  <div style="margin-left: 35%; margin-right: 35%;">
    <form>
      <h2 style="text-align: center;">Forgot Password</h2>
      <br />
      <label class="sr-only">Email Address</label>
      <input class="form-control" placeholder="Email Address" required autofocus autocomplete="off" />
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit">Reset</button>
      <br />
      <div style="text-align: center;">
        <a href="login">Back</a>
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
