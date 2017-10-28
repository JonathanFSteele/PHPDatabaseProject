<?php echo "hello world -JonathanS" ?>
<br />
<?php
echo "Host:", $_SERVER['HTTP_HOST'], "<br />";
echo "Query string:", $_SERVER['QUERY_STRING'], "<br />";
echo "Requst test= ", $_REQUEST['test'], "<br />";

$x = 5 * 5;

echo $x;
echo "<br />";
$name = "Jonathan";
echo "variable name = $name<br />";
echo "<br />";

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
 <?php include 'footer.php';?>
