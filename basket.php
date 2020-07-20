<?php
include("db.php");
$pagename = "Smart Basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
include("detectlogin.php");
echo "<h4>" . $pagename . "</h4>";
if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] != "Administrator") {
    if (isset($_POST['del_prodid'])) {
        $delprodid = $_POST['del_prodid'];
        unset($_SESSION['basket'][$delprodid]);
        echo "1 item removed from the basket";
    }
    $totalPrice = 0;

    if (isset($_POST['h_prodid']) && isset($_POST['reQuantity'])) { //display name of the page on the web page
        $newprodid = $_POST['h_prodid'];
        $reququantity = $_POST['reQuantity'];
        // echo "Id of the product selected: ".$newprodid.'<br>';
        // echo "Quantity of selected product: ".$reququantity. "<br>";
        //create a new cell in the basket session array. Index this cell with the new product id.
        //Inside the cell store the required product quantity
        $_SESSION['basket'][$newprodid] = $reququantity;
        //echo "<p>The doc id ".$newdocid." has been ".$_SESSION['basket'][$newdocid];
        echo "<p>1 item added to the basket<br>";
    } else {
        echo "<p>Current basket unchanged.</p>";
    }
    echo "<table>
    <tr><th>Product Name</th><th >Price</th><th>Quantity</th><th>Subtotal</th><th></th></tr>";
    if (isset($_SESSION['basket'])) {
        foreach ($_SESSION['basket'] as $index => $value) {
            // echo $index . '<br>';
            // echo $value;
            $SQL = "SELECT prodName, prodPrice FROM Product WHERE prodId='" . $index . "';";
            $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error("Error"));
            //create an array of records (2 dimensional variable) called $arrayp.
            //populate it with the records retrieved by the SQL query previously executed.
            //Iterate through the array i.e while the end of the array has not been reached, run through it

            while ($arrayp = mysqli_fetch_array($exeSQL)) {
                echo "<tr><td >" . $arrayp['prodName'] . "</td>";
                echo "<td>" . $arrayp['prodPrice'] . "</td>";
                echo "<td>" . $value . "</td>";
                $subTotal = $value * $arrayp['prodPrice'];
                echo "<td >" . $subTotal . "</td>";
                echo "<td >";
                echo "<form action=basket.php method=post>";
                echo "<input type=submit value='Remove'>";
                //pass the product id to the next page basket.php as a hidden value
                echo "<input type=hidden name='del_prodid' value=" . $index . ">";
                echo "</form>";
                $totalPrice = $totalPrice + $subTotal;
                echo "</td></tr>";
            }
        }
        echo "<tr><td align='right' colspan=3>
    <b>Total</b></td>";
        echo "<td><b>" . $totalPrice . "</b></td><td></td></tr>";
        echo "</table><br>";
        echo "<a href='clearbasket.php'>CLEAR BASKET</a><br><br>";
    } else {
        echo "Empty Basket <br><br>";
        echo "<tr><th align='right' colspan=3>
    TOTAL</th>";
        echo "<td><b>" . $totalPrice . "</b></td><td></td></tr>";
        echo "</table><br>";
    }
    if (isset($_SESSION['userid'])) {
        echo "<br><br><br>To finalise your order: <a href=checkout.php>Checkout</a>";
    } else {
        echo "<br><br><br>New homteq customers: <a href=signup.php>Sign up</a>";
        echo "<br><br>Returning homteq customers: <a href=login.php>Login</a>";
    }
} else {
    echo "Only Customers can buy products";
}
include("footfile.html"); //include head layout
echo "</body>";
