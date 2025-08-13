<?php
 /*filecreation and check functions start*/
function fileCreator(){
        $fileOpen = fopen('./Users.csv', 'w');
        fopen('./Users.csv', 'w');
        fclose($fileOpen);
    }
    
function fileChecker(){
        if(file_exists('./Users.csv') == false){
            fileCreator();
        }
    }
/*filecreation and check functions end*/

/*Checks if either input is empty returns error that a password or username is empty*/
function emptyInput($userName, $userPassword){
      
        $result = "";
      if((empty($userName)) || (empty($userPassword))){
       $result = true;
       header("location:../loginPage.php?error=emptyinput");
    
      }else{
        $result = false;
      }
      return $result;
    }
 /*Function that logs the user in*/   
function LogintheUser($userName,$userPassword){
        $fileRead = fopen('./Users.csv', 'r');
        $fileget = fgetcsv($fileRead);
        $userNameCheck = $fileget[0];
        $userPasswordCheck = $fileget[1];
        /*runs a verify check to see if the encrypted password matches the password entered, adding extra security*/
        $verify = password_verify($userPassword, $userPasswordCheck);
        /*Loop runs through all usernames in User.CSV until either a matching username is found or the end of file is reached, if EOF is reach returns error Login not found*/
        while($fileget != false){
            /*check if the user has passed both the password verify and has a username in Users.csv*/
         if($userName === $userNameCheck && $verify === true){
            session_start();
            $_SESSION["userName"] = $userName;
            header("location:../index.php");
            

            exit();
         }else{
            $fileget = fgetcsv($fileRead);
         }
         
        }
        fclose($fileRead);
        header("location:../loginPage.php?error=LoginNotFound");
        
        
    }


    fileChecker();
    //Checks if a Login attempt has been made and gets the usersubmitted username and password
    if(isset($_POST["loginAttempt"])){
    
        $userName = $_POST["userName"];
        $userPassword =$_POST["userPassword"];
        //calls for emptyinput and check if user has submitted data or not
     if(emptyInput($userName, $userPassword) !== false){ 
          exit();
         }
     LogintheUser($userName, $userPassword);
      
    }
    else{
        exit();
    }

    ?>