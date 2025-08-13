<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSC 20001 web tech</title>

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div  class="titleborder">
            
        <nav>
            <ul class="navbarList">
                <figure>
                    <li class="redirectbutton"><a href="CV.php"><img src ="Images/TrainerCard.PNG"></li>
                        <figcaption >CV trainer</figcaption> </a>
                </figure>
                <figure>
                    <li class="redirectbutton"><a href="List.php"><img src ="Images/Libary button.PNG"></li>
                        <figcaption >Library</figcaption> </a>
                </figure>
                <figure>
                <li class="logo"><a href="Index.php">Pokemon HeartGold</a></li>
                </figure>
                <figure>
                 <li class="redirectbutton"><a href="weather.php"><img src ="Images/Wethear button.PNG"></li>
                    <figcaption >Weather</figcaption> </a>
                </figure>
                
                <?php
                if (isset($_SESSION["userName"])){
                   echo "<figure>";
                    echo "<li class='redirectbutton'><a href='logout.php'><img src ='Images/LoginButton.PNG'></li>";
                     echo  "<figcaption>Log out</figcaption> </a>";
                    echo "</figure>";
                } else{
                
                    echo "<figure>";
                    echo "<li class='redirectbutton'><a href='LoginPage.php?error=0'><img src ='Images/LoginButton.PNG'></li>";
                     echo  "<figcaption class='logbutton'>Login</figcaption></a>";
                    echo "</figure>";
                }
                ?>
            </ul>
        </nav>
        </div>
    </header>