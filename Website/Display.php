<?php
require_once("header.php");
/**/
/*Gets the ISBN number passed as a parameter with GET*/
$ISBN = $_GET["ISBN"];
$fileRead = fopen('./Books.csv', 'r');
$fileget = fgetcsv($fileRead);
?>
    <section class="LeftSide">
    <div class="TheBook">
        <div class="Bookbox">
    <?php
    /*This loops through Books.CSV until a matching ISBN number is found or the end of file is reached*/
    while($fileget != false){
        /*$i is the indexing number for where in the array the first Module url will be found*/
        $i = 5;
        /*The ISBN number will always be first in the array this IF statement checks if the ISBN from the GET is the same as the current line of the file*/
        $ISBNCheck = $fileget[0];
        if($ISBN === $ISBNCheck){
            /*Gets how many values are in the array, this finds how many time to run the for loop. -5 gets rid of the Non-module related values such as Author*/
            $displayArrayCount = count($fileget);
            $displayArrayCount=  $displayArrayCount -5;
    ?>              
    <div class="BookDescription" id="DisplayBookTitle">Title: <?php echo $fileget[1];?></div>
    <div class="BookDescription">Description: <?php echo $fileget[2];?></div>
    <div class="BookDescription">Author: <?php echo $fileget[3];?></div>
    <div class="BookDescription">ISBN: <?php echo $fileget[0];?></div>
    <?php /*This For loop creates elements which display the module that are linked to their module pages for as many modules that have been entered for that book*/
          for($displayArrayCount; $displayArrayCount>= 0; $displayArrayCount= $displayArrayCount-2){?>
    <div class="BookDescription" id="DisplayModuleName"><a class="DisplayModuleURL" href =<?php echo $fileget[$i]; $i--;?>><?php echo $fileget[$i];$i++; $i++; $i++;?></a></div>
    <?php  }fclose($fileRead);  break; }else{
            $fileget = fgetcsv($fileRead);
         }}?>
         
 </div>
</div>
 <?php
require_once("footer.php")
?>
  

