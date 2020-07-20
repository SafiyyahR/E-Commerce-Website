<?php
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

if (isset($_SESSION['userid'])) {
    echo "<p style='font-style:italic; float:right;'>".$_SESSION['fname']. " " .$_SESSION['sname']." / ".$_SESSION["user_type"]." No: " .$_SESSION['userid']. "</p>";
}
?>