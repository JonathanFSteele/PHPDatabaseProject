<!doctype html>
<html lang="en">
  <head>
    <title>Hello, world!</title>
    <?php require "master_head.php"  ?>
  </head>
  <body>
    <?php require "master_navbar.php" ?>
    <div class="container">

      <h1>Hello, world! <?php echo "I'm doing PHP"?></h1>
      <h5 class="text-muted">This is an example of bootstrap integrated with php
        with header and footer include files. Hope its a useful example.</h3>
      <br />
      <div class="alert alert-primary" role="alert">
        This is a primary alert—check it out!
      </div>
      <div class="alert alert-secondary" role="alert">
        This is a secondary alert—check it out!
      </div>

      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Well done!</h4>
        <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
        <hr>
        <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Username</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
      </table>


      <div class="card text-center">
        <div class="card-header">
          Featured
        </div>
        <div class="card-body">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">
            <button type="button" class="btn btn-primary">Primary</button>
            <button type="button" class="btn btn-secondary">Secondary</button>
            <button type="button" class="btn btn-success">Success</button>
          </p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <div class="card-footer text-muted">
          2 days ago
        </div>
      </div><!--end of card-->

    </div>


    <?php include "master_foot.php" ?>
  </body>
</html>
