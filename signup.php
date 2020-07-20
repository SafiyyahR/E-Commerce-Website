<?php
$pagename="Sign Up"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<body>";

include ("headfile.html"); //include header layout file

echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
echo "<form action='signup_process.php' method='post'>";
echo "<table style='border:0px'>";
echo "<tr><td style='border:0px' class='signuptable'>";
echo "<label>*First name:</label><br></td>";
echo "<td style='border:0px' class='signuptable'>";
echo "<input type='text' class='signupinput' name='fname'><br>";
echo "</td></tr>";

echo "<tr><td style='border:0px' class='signuptable'>";
echo "<label>*Last name:</label><br></td>";
echo "<td style='border:0px' class='signuptable'>";
echo "<input type='text' class='signupinput' name='lname'><br>";
echo "</td></tr>";

echo "<tr><td style='border:0px' class='signuptable'>";
echo "<label>*Address:</label><br></td>";
echo "<td style='border:0px' class='signuptable'>";
echo "<input type='text' class='signupinput' name='address'><br>";
echo "</td></tr>";

echo "<tr><td style='border:0px' class='signuptable'>";
echo "<label>*Postcode:</label><br></td>";
echo "<td style='border:0px' class='signuptable'>";
echo "<input type='text' class='signupinput' name='pcode'><br>";
echo "</td></tr>";

echo "<tr><td style='border:0px' class='signuptable'>";
echo "<label>*Telephone Number:</label><br></td>";
echo "<td style='border:0px' class='signuptable'>";
echo "<input type='text' class='signupinput' name='telno'><br>";
echo "</td></tr>";

echo "<tr><td style='border:0px' class='signuptable'>";
echo "<label>*Email Address:</label><br></td>";
echo "<td style='border:0px' class='signuptable'>";
echo "<input type='text' class='signupinput' name='email'><br>";
echo "</td></tr>";

echo "<tr><td style='border:0px' class='signuptable'>";
echo "<label>*Password:</label><br></td>";
echo "<td style='border:0px' class='signuptable'>";
echo "<input type='password' class='signupinput' name='password'><br>";
echo "</td></tr>";

echo "<tr><td style='border:0px' class='signuptable'>";
echo "<label>*Confirm Password:</label><br></td>";
echo "<td style='border:0px' class='signuptable'>";
echo "<input type='password' class='signupinput' name='cpassword'><br>";
echo "</td></tr>";

echo "<tr><td style='border:0px' class='signuptable'>";
echo "<input type='submit' value='Sign Up'>";
echo "<td style='border:0px' class='signuptable'>";
echo "<input type='reset' value='Clear Form'>";
echo "</td></tr>";
echo "</table>";
echo "</form>";

include("footfile.html"); //include head layout

echo "</body>";
?>