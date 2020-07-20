<?php
include("db.php");

$pagename = "Your Login Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>" . $pagename . "</title>"; //display name of the page as window title

echo "<body>";

include("headfile.html"); //include header layout file

echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

$email = $_POST['email'];
$password = $_POST["pword"];

if (isset($email) || isset($password)) {
    $expression = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    $isemail = (preg_match($expression, $email)) ? true : false;

    if ($isemail) {
        //create a $SQL variable and populate it with a SQL statement that saves user details
        $SQL = 'SELECT  * FROM Users WHERE userEmail="' . $email . '";';
        //run SQL query for connected DB or exit and display error message
        $result = mysqli_query($conn, $SQL);

        if (!$arrayu = mysqli_fetch_array($result)) {
            echo "<p>Email not recognised, login again</p>";
        } else {
            if ($arrayu["userPassword"] != $password) {
                echo "<p>Password not recognised, login again</p>";
                echo "Go back to <a href=login.php>login</a>";
            } else {
                $_SESSION['userid'] = $arrayu['userId'];
                $_SESSION['fname'] = $arrayu['userFName'];
                $_SESSION['sname'] = $arrayu['userSName'];
                echo "<p><b>Login successful!</b></p>";
                echo "<p>Hello, " . $_SESSION['fname'] . " " . $_SESSION['sname'] . "</p>";
                if ($arrayu["userType"] == 'A') {
                    $_SESSION["user_type"] = "Administrator";
                    echo "<p>You have successfully logged in as a hometeq Administrator</p>";
                    echo "<p><a href=index.php>Home Tech Main Page</a></p>";
                } else if ($arrayu["userType"] == 'C') {
                    $_SESSION["user_type"] = "Customer";
                    echo "<p>You have successfully logged in as a hometeq Customer</p>";
                    echo "<p>Continue shopping for <a href=index.php>Home Tech</a></p>";
                    echo "View your <a href=basket.php>SMART BASKET</a>";
                }
            }
        }
    } else {
        echo "<b>Login failed!</b>";
        echo "<p>Email not valid.<br>";
        echo "Make sure you enter a correct email address.</p>";
        echo "Go back to <a href=login.php>login</a>";
    }
} else {
    echo "<b>Sign-up failed!</b>";
    echo "<p>Both email and password fields need to be filled in.<br>";
    echo "Go back to <a href=login.php>login</a>";
}
