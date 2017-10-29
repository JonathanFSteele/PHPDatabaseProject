<head>
  <title>Home</title>
  <?php require "master_head.php"  ?>
  <?php require 'MySqlInfo.php' ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Home</h1>
    </div>
  </div>
  <div class="container">
    <?php

    echo "LoginID: ".$_SESSION["LoginID"];

    echo "Host:", $_SERVER['HTTP_HOST'], "<br />";
    echo "Query string:", $_SERVER['QUERY_STRING'], "<br />";
    echo "Requst test= ", $_REQUEST['test'], "<br />";

    function myTest()
    {
        global $name;
        echo "inside myTest() function. $name<br />";
        echo "testing ","and again.<br />";
        echo "testing " . $name . " in an sentence.<br />";
        global $x;
        var_dump($x);
    }

    function arrayTests()
    {
        echo "-------- arrayTests function ---------<br /><br />";
        $cars = array("Volvo","BMW", "Toyota");
        var_dump($cars);
        echo "<br />";
        for ($x = 0; $x <count($cars); $x++) {
            echo "I like $cars[$x] <br />";
        }
        foreach ($cars as $car) {
            echo "car: $car <br />";
        }
        echo "<br /><br />";
    }

    //myTest();
    arrayTests();

    class Car
    {
        public function Car()
        {
            $this->model = "VW";
            $this->color = "blue";
        }
    }
    function testCar()
    {
        $herbie = new Car();
        var_dump($herbie);
        echo "<br />";
        echo "car color: $herbie->color<br />";
    }

    testCar();

    ?>
  </div>
  <footer class="footer" style="background-color: #e9ecef;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
