<?php
$pagename = "Add Product"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>" . $pagename . "</title>"; //display name of the page as window title

echo "<body>";

include("headfile.html"); //include header layout file

echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page
if ($_SESSION["user_type"] == "Administrator") {
    echo "<form action='addproduct_conf.php' method='post'>";
    echo "<table style='border:0px'>";
    echo "<tr><td style='border:0px' class='signuptable'>";
    echo "<label>*Product Name:</label><br></td>";
    echo "<td style='border:0px' class='signuptable'>";
    echo "<input type='text' class='signupinput' name='pname'><br>";
    echo "</td></tr>";

    echo "<tr><td style='border:0px' class='signuptable'>";
    echo "<label>*Small Picture Name:</label><br></td>";
    echo "<td style='border:0px' class='signuptable'>";
    echo "<input type='text' class='signupinput' name='spname'><br>";
    echo "</td></tr>";

    echo "<tr><td style='border:0px' class='signuptable'>";
    echo "<label>*large Picture Name:</label><br></td>";
    echo "<td style='border:0px' class='signuptable'>";
    echo "<input type='text' class='signupinput' name='lpname'><br>";
    echo "</td></tr>";

    echo "<tr><td style='border:0px' class='signuptable'>";
    echo "<label>*Short Description:</label><br></td>";
    echo "<td style='border:0px' class='signuptable'>";
    echo "<input type='text' class='signupinput' name='sdescrip'><br>";
    echo "</td></tr>";

    echo "<tr><td style='border:0px' class='signuptable'>";
    echo "<label>*Long Description:</label><br></td>";
    echo "<td style='border:0px' class='signuptable'>";
    echo "<input type='text' class='signupinput' name='ldescrip'><br>";
    echo "</td></tr>";

    echo "<tr><td style='border:0px' class='signuptable'>";
    echo "<label>*Price:</label><br></td>";
    echo "<td style='border:0px' class='signuptable'>";
    echo "<input type='text' class='signupinput' name='price'><br>";
    echo "</td></tr>";

    echo "<tr><td style='border:0px' class='signuptable'>";
    echo "<label>*Initial Stock Quantity:</label><br></td>";
    echo "<td style='border:0px' class='signuptable'>";
    echo "<input type='number' class='signupinput' name='isquantity'><br>";
    echo "</td></tr>";

    echo "<tr><td style='border:0px' class='signuptable'>";
    echo "<input type='submit' value='Add Product'>";
    echo "<td style='border:0px' class='signuptable'>";
    echo "<input type='reset' value='Clear Form'>";
    echo "</td></tr>";
    echo "</table>";
    echo "</form>";
} else {
    echo "Only Admins can add products";
}

include("footfile.html"); //include head layout

echo "</body>";
