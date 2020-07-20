<?php
include("db.php");
$pagename = "Order Confirmation"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
include("detectlogin.php");
echo "<h4>" . $pagename . "</h4>";
if ($_SESSION["user_type"] != "Administrator") { //display name of the page on the web page
    $currentdatetime = date('Y-m-d H:i:s');
    $query = "INSERT INTO Orders (userId,orderDateTime,orderStatus) VALUES('" . $_SESSION['userid'] . "','" . $currentdatetime . "','Placed');";
    $result = mysqli_query($conn, $query);
    $errorCode = mysqli_errno($conn);
    if ($result == TRUE && $errorCode == 0) {
        $query = "SELECT orderNo,orderDateTime FROM w1714855_0.Orders WHERE '" . $_SESSION['userid'] . "' ORDER BY orderDateTime DESC LIMIT 1;";
        $exeSQL = mysqli_query($conn, $query);
        $arrayord = mysqli_fetch_array($exeSQL);
        $recentOrderNo = $arrayord['orderNo'];
        echo "<b>Successful Order</b> - " . strtoupper("order reference no: ") . $recentOrderNo . "<br/>";
        echo "<table>
    <tr><th>Product Name</th><th >Price</th><th>Quantity</th><th>Subtotal</th></tr>";
        if (isset($_SESSION['basket'])) {
            $totalPrice = 0;
            foreach ($_SESSION['basket'] as $index => $value) {
                // echo $index . '<br>';
                // echo $value;
                $SQL = "SELECT prodName, prodPrice FROM Product WHERE prodId='" . $index . "';";
                $exeSQL = mysqli_query($conn, $SQL);
                //create an array of records (2 dimensional variable) called $arrayp.
                //populate it with the records retrieved by the SQL query previously executed.
                //Iterate through the array i.e while the end of the array has not been reached, run through it
                $arrayb = mysqli_fetch_array($exeSQL);
                echo "<tr><td >" . $arrayb['prodName'] . "</td>";
                echo "<td>" . $arrayb['prodPrice'] . "</td>";
                echo "<td>" . $value . "</td>"; //quantity
                $subTotal = $value * $arrayb['prodPrice'];
                echo "<td >" . $subTotal . "</td>";
                $query = "INSERT INTO Order_Line (orderNo,prodId,quantityOrdered,subTotal) VALUES($recentOrderNo,$index,$value,$subTotal);";
                $exeSQL = mysqli_query($conn, $query) or die(mysqli_error("Error"));
                $totalPrice = $totalPrice + $subTotal;
                echo "</tr>";
            }
            echo "<tr><td align='right' colspan=3><b>ORDER TOTAL</b></td>";
            echo "<td><b>" . $totalPrice . "</b></td></tr>";
            echo "</table><br>";
            $SQL = "UPDATE w1714855_0.Orders
        SET orderTotal =" . $totalPrice . " WHERE orderDateTime='" . $arrayord["orderDateTime"] . "' AND orderNo=" . $arrayord["orderNo"] . ";";
            mysqli_query($conn, $SQL);
        }
        echo "<br><br><br>To log out and leave the system: <a href=logout.php>Logout</a>";
    } else {
        echo "An error occurred when placing the order...";
    }
    unset($_SESSION["basket"]);
} else {
    echo "Only Customers can checkout.";
}
include("footfile.html"); //include head layout
echo "</body>";
