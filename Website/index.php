
<?php
require_once("header.php")

?>
    </header>
    <section class="welcome box" ><div class="welcomemessage">Welcome to the home page!
        Please use the Navigation menu at the top of the screen to choose where you would to go!</div></section>
    <section><?php
if (isset($_SESSION["userName"])){
  Echo "You have logged in successfully!";
}

?></section>    
<?php
require_once("footer.php")
?>