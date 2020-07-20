<?php
include("db.php");
$pagename = "Your Sign Up Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>" . $pagename . "</title>"; //display name of the page as window title

echo "<body>";

include("headfile.html"); //include header layout file

echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

$fname = $_POST['fname'];
$lname = $_POST["lname"];
$address = $_POST["address"];
$pcode = $_POST["pcode"];
$telno = $_POST["telno"];
$email = $_POST["email"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];

if ($fname!="" && $lname!="" && $address!="" && $pcode!="" && $telno!="" && $email!="" && $password!=""&& $cpassword!="") {

    if (!($password == $cpassword)) {
        echo "<b>Sign-up failed!</b>";
        echo "<p>The 2 passwords are not matching.<br>";
        echo "Make sure you enter them correctly.</p>";
        echo "Go back to <a href=signup.php>sign up</a>";
    } else {
        $expression = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        $isemail = (preg_match($expression, $email)) ? true : false;

        if ($isemail) {
            //create a $SQL variable and populate it with a SQL statement that saves user details
            $SQL = "insert into users (userType, userFName, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword) values ('C','" . $fname . "','" . $lname . "','" . $address . "','" . $pcode . "','" . $telno . "','" . $email . "','" . $password . "');";

            //run SQL query for connected DB or exit and display error message
            mysqli_query($conn, $SQL);

            if (mysqli_errno($conn) == 0) {
                echo "<b>Sign-up successful!</b>";
                echo "<p>To continue, please <a href=login.php>login</a></p>";
            } else {
                echo "<b>Sign-up failed!</b>";
                if (mysqli_errno($conn) == 1062) {
                    echo "<p>Email already in use.<br>";
                    echo "You may be already registered or try another email address.</p>";
                    echo "Go back to <a href=signup.php>sign up</a>";
                }

                if (mysqli_errno($conn) == 1064) {
                    echo "<p>Invalid characters entered in the form.<br>";
                    echo "Make sure you avoid the following characters: apostrophes like ['] and backslashes like [\].</p>";
                    echo "Go back to <a href=signup.php>sign up</a>";
                }
            }
        } else {
            echo "<b>Sign-up failed!</b>";
            echo "<p>Email not valid.<br>";
            echo "Make sure you enter a correct email address.</p>";
            echo "Go back to <a href=signup.php>sign up</a>";
        }
    }
} else {
    echo "<b>Sign-up failed!</b>";
    echo "<p>Your signup form is incomplete and all fields are mandatory.<br>";
    echo "Make sure provide all the required details.</p>";
    echo "Go back to <a href=signup.php>sign up</a>";
}
