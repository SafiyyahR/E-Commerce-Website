<?php
include("db.php");
$pagename = "Wish List"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
include("detectlogin.php");
echo "<h4>" . $pagename . "</h4>";
if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Customer") {
    if (isset($_POST['del_prodid'])) {
        $delprodid = $_POST['del_prodid'];
        $SQL1 = "DELETE FROM WishList WHERE prodId=" . $delprodid . " AND userId=" . $_SESSION['userid'] . ";";
        $exeSQL = mysqli_query($conn, $SQL1) or die(mysqli_error("Error"));
        echo "1 item removed from the wish list";
    } else if (isset($_POST['up_prodid'])) {
        $upprodid = $_POST['up_prodid'];
        // $SQL1="UPDATE  FROM WishList WHERE prodId=".$delprodid." AND userId=".$_SESSION['userid'].";";
        // $exeSQL = mysqli_query($conn, $SQL1) or die(mysqli_error("Error"));
        echo "1 item updated in the wish list";
    }
    $SQL = "SELECT prodName, prodPrice,Product.prodId FROM WishList, Product WHERE userId=" . $_SESSION['userid'] . " AND Product.prodId=WishList.prodId;";
    $exeSQL = mysqli_query($conn, $SQL);
    //create an array of records (2 dimensional variable) called $arrayw.
    //populate it with the records retrieved by the SQL query previously executed.
    //Iterate through the array i.e while the end of the array has not been reached, run through it
    if (!mysqli_num_rows($exeSQL)) {
        echo "<br><br><br><a href=index.php>Add Items</a> to your wishlist.";
    } else {
        echo "<table>
        <tr><th>Product Name</th><th >Price</th><th></th><th></th><th></th></tr>";
        while ($arrayw = mysqli_fetch_array($exeSQL)) {
            $index = $arrayw['prodId'];
            echo "<tr><td >" . $arrayw['prodName'] . "</td>";
            echo "<td>" . $arrayw['prodPrice'] . "</td>";
            echo "<td >";
            echo "<form action=wishlist.php method=post>";
            echo "<input type=submit value='Remove'>";
            //pass the product id to the next page basket.php as a hidden value
            echo "<input type=hidden name='del_prodid' value=" . $index . ">";
            echo "</form></td>";
            echo "<td >";
            echo "<form action=wishlist.php method=post>";
            echo "<input type=submit value='Update'>";
            //pass the product id to the next page basket.php as a hidden value
            echo "<input type=hidden name='up_prodid' value=" . $index . ">";
            echo "</form></td>";
            echo "<td><form action=prodbuy.php method=get>";
            echo "<input type=submit value='View Product'>";
            //pass the product id to the next page basket.php as a hidden value
            echo "<input type=hidden name='view' value=no>";
            echo "<input type=hidden name='u_prod_id' value=" . $index . ">";
            echo "</form>";
            echo "</td></tr>";
        }
    }

    echo "</table><br>";
} else {
    echo "Only Customers can have a wish list.";
}
include("footfile.html"); //include head layout
echo "</body>";
