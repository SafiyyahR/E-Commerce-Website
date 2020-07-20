<?php
include("db.php");
$pagename = "“A smart buy for a smart home"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
include("detectlogin.php");
echo "<h4>" . $pagename . "</h4>";
if (!isset($_SESSION["user_type"]) || $_SESSION["user_type"] != "Administrator") { //display name of the page on the web page
    //retrieve the product id passed from previous page using the GET method and the $_GET superglobal variable
    //applied to the query string u_prod_id
    //store the value in a local variable called $prodid
    if (isset($_POST['add_prodId'])) {
        $addprodId = $_POST['add_prodId'];
        $SQL1 = "INSERT INTO WishList (prodId,userId) VALUES (" . $addprodId . ", " . $_SESSION["userid"] . ");";
        $exeSQL = mysqli_query($conn, $SQL1);
        if (mysqli_errno($conn) == 0) {
            echo "<b>Successfully added product to wish list!</b>";
            echo "<p>View <a href=wishlist.php>WishList</a></p>";
        } else {
            if (mysqli_errno($conn) == 1062) {
                echo "<p>Item is already in wishlist<br>";
                echo "<p>View <a href=wishlist.php>WishList</a></p>";
            }
        }
    }
    $prodid = $_GET['u_prod_id'];
    $SQL = "SELECT prodId, prodName, prodPicNameLarge,prodDescripLong, prodPrice, prodQuantity FROM Product WHERE prodId='" . $prodid . "';";
    //run SQL query for connected DB or exit and display error message
    $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error("Error"));
    echo "<table style='border: 0px'>";
    //create an array of records (2 dimensional variable) called $arrayp.
    //populate it with the records retrieved by the SQL query previously executed.
    //Iterate through the array i.e while the end of the array has not been reached, run through it
    while ($arrayp = mysqli_fetch_array($exeSQL)) {
        if (isset($_GET['view'])) {
            $toView = $_GET['view'];
            if ($toView == "yes") {
                echo "<br><form action=prodbuy.php?u_prod_id=" . $prodid . " method=post>";
                echo "<input style='float: right' type=submit value='Add to wishlist'>";
                //pass the product id to the next page basket.php as a hidden value
                echo "<input type=hidden name='add_prodId' value=" . $prodid . ">";
                echo "</form>";
            }
        }
        echo "<tr>";
        echo "<td style='border: 0px'>";
        //display the small image whose name is contained in the array
        echo "<img src=images/" . $arrayp['prodPicNameLarge'] . " height=400 width=400>";
        echo "</td>";
        echo "<td style='border: 0px'>";
        echo "<p><h5>" . $arrayp['prodName'] . "</h5>"; //display product name as contained in the array
        echo "<p>" . $arrayp['prodDescripLong'] . "</p>";
        echo "<b><p>&pound;" . $arrayp['prodPrice'] . "</p></b>";
        echo "<p>Number left in stock: " . $arrayp['prodQuantity'] . "</p>";
        echo "<p>Number to be purchased: ";
        //create form made of one text field and one button for user to enter quantity
        //the value entered in the form will be posted to the basket.php to be processed
        echo "<form action=basket.php method=post>";
        echo "<select name='reQuantity'>";
        for ($i = 1; $i <= $arrayp['prodQuantity']; $i++) {
            echo "<option value=" . $i . ">" . $i . "</option>";
        }
        echo "</select>";
        echo "<input type=submit value='ADD TO BASKET'>";
        //pass the product id to the next page basket.php as a hidden value
        echo "<input type=hidden name='h_prodid' value=" . $prodid . ">";
        echo "</form>";
        echo "</td>";
        // echo "<td >";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Only Customers can buy products";
}
include("footfile.html"); //include head layout
echo "</body>";
