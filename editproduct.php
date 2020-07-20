<?php
include("db.php"); //include db.php file to connect to DB
$pagename = "Make your home smart"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>" . $pagename . "</title>";
echo "<body>";
include("headfile.html");
include("detectlogin.php");
echo "<h4>" . $pagename . "</h4>";
if ($_SESSION["user_type"] == "Administrator") {
    if (isset($_POST['update_prodid'])) {
        $pridtobeupdated = $_POST['update_prodid'];
        $newprice = $_POST['newprice'];
        $newqutoadd = $_POST['newquantity'];
        $SQL = "SELECT prodQuantity FROM Product WHERE prodId='" . $pridtobeupdated . "';";
        $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error("Error"));
        $arrayqu=mysqli_fetch_array($exeSQL);
        $newstock=$arrayqu["prodQuantity"]+$newqutoadd;
        if($newprice!=""){
            $SQL = "UPDATE w1714855_0.Product
            SET prodPrice =" . $newprice . ",prodQuantity=".$newstock." WHERE prodId=$pridtobeupdated;";
            mysqli_query($conn, $SQL);
        }else{
            $SQL = "UPDATE w1714855_0.Product
            SET prodQuantity=".$newstock." WHERE prodId=$pridtobeupdated;";
            mysqli_query($conn, $SQL);
        }

    }
    //create a $SQL variable and populate it with a SQL statement that retrieves product details
    $SQL = "SELECT prodId, prodName, prodPicNameSmall,prodQuantity, prodPrice from Product";
    //run SQL query for connected DB or exit and display error message
    $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error("Error"));
    echo "<table style='border: 0px'>";
    //create an array of records (2 dimensional variable) called $arrayp.
    //populate it with the records retrieved by the SQL query previously executed.
    //Iterate through the array i.e while the end of the array has not been reached, run through it
    while ($arrayp = mysqli_fetch_array($exeSQL)) {
        echo "<tr>";
        echo "<td style='border: 0px' rowspan=4>";
        echo "<img src=images/" . $arrayp['prodPicNameSmall'] . " height=200 width=200></a>";
        echo "</td>";
        echo "<td style='border: 0px'>";
        echo "<p><h5>" . $arrayp['prodName'] . "</h5></p></td></tr>"; //display product name as contained in the array
        echo "<tr><td><p>Current Price: <b>" . $arrayp['prodPrice'] . "</b></p></td>";
        echo "<form action=editproduct.php method=post>";
        echo "<td>";
        echo "<p>New Price: ";
        echo "<input type=text name='newprice' class='signupinput'></p></td></tr>";
        echo "<tr><td><p>Current Stock: <b>" . $arrayp['prodQuantity'] . "</b></p></td>";
        echo "<td><select name='newquantity'>";
        for ($i = 0; $i <= 100; $i++) {
            echo "<option value=" . $i . ">" . $i . "</option>";
        }
        echo "</select></td></tr>";
        //pass the product id to the next page basket.php as a hidden value
        echo "<input type=hidden name='update_prodid' value=" . $arrayp['prodId'] . ">";
        echo "<tr><td><input type=submit value='Update'></td><tr>";
        echo "</form>";
    }
    echo "</table>";
} else {
    echo "Only Admins can edit products";
}
include("footfile.html");
echo  "</body>";
