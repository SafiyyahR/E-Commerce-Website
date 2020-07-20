<?php
include("db.php");
$pagename = "New Product Confirmation"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>" . $pagename . "</title>"; //display name of the page as window title

echo "<body>";

include("headfile.html"); //include header layout file

echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

$pname = $_POST['pname'];
$spname = $_POST["spname"];
$lpname = $_POST["lpname"];
$sdescrip = $_POST["sdescrip"];
$ldescrip = $_POST["ldescrip"];
$price = $_POST["price"];
$isquantity = $_POST["isquantity"];

if ($pname != "" && $spname != "" && $lpname != "" && $sdescrip != "" && $ldescrip != "" && $price != "" && $isquantity != "") {

    if (mysqli_errno($conn) == 0) {
        echo "<p><b>The product has been added</b></p>";
        echo "<p>Name of the large picture: ".$lpname."</p>";
        echo "<p>Name of the small picture: ".$spname."</p>";
        echo "<p>Short Description: ".$sdescrip."</p>";
        echo "<p>Long Description: ".$ldescrip."</p>";
        echo "<p>Price: ".$price."</p>";
        echo "<p>Initial Quantity: ".$isquantity."</p>";
        $SQL = "insert into Product (prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity) values ('".$pname."','" . $spname . "','" . $lpname . "','" . $sdescrip . "','" . $ldescrip . "'," . $price . "," . $isquantity . ");";
          //run SQL query for connected DB or exit and display error message
    mysqli_query($conn, $SQL);
    } else {
        echo "<b>Add product failed!</b>";
        if (mysqli_errno($conn) == 1062) {
            echo "<p>Product already available.<br>";
            echo "You may have already entered the product details previously.</p>";
            echo "Go back to <a href=addproduct.php>add product</a>";
        }

        if (mysqli_errno($conn) == 1064) {
            echo "<p>Invalid characters entered in the form.<br>";
            echo "Make sure you avoid the following characters: apostrophes like ['] and backslashes like [\].</p>";
            echo "Go back to <a href=addproduct.php>add product</a>";
        }
        if (mysqli_errno($conn) == 1054) {
            echo "<p>Only numeric characters can be entered in the price field.<br>";
            echo "Make sure you a decimal value like the following characters: 2.3 .</p>";
            echo "Go back to <a href=addproduct.php>add product</a>";
        }
    }
} else {
    echo "<b>Add product failed!</b>";
    echo "<p>Your add product form is incomplete and all fields are mandatory.<br>";
    echo "Make sure provide all the required details.</p>";
    echo "Go back to <a href=addproduct.php>add product</a>";
}
