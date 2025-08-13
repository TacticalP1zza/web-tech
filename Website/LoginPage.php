<?php
require_once("header.php");
?>
    <section class="Loginbox">
        <div class="Login">
            <h3>Log In <?php /*echos the error for the user */ {switch($_GET["error"]){ 
                case "LoginNotFound": echo "Login was not found, please try again"; break;
                case "emptyinput": echo "Please enter a Username and Password.";}} ?></h3>
            <form action="LoginCSV.php" method="post">
                <input type="text" name="userName" placeholder="Username" class="usernameBox">
                <input type="password" name="userPassword" placeholder="Password" class="passwordBox">
                <br>
                <button type="submit" name="loginAttempt" class="Loginbutton">login</button>
            </form>
        </div>
    </section>
    <section></section>    
    <?php
require_once("footer.php");
?>
