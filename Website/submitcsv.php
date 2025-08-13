<?php
/*filecreation and check functions start*/
/*creates file if does not exist*/
 function fileCreator(){
    $fileOpen = fopen('./Books.csv', 'w');
    fopen('./Books.csv', 'w');
    fclose($fileOpen);
}
/*Checks if file exists*/ 
function fileChecker(){
    if(file_exists('./Books.csv') == false){
        fileCreator();
    }
}
/*filecreation and check functions end*/

/*Checks if Any of the first input boxes are empty, if they are cancels the submission */
function emptyInput($ISBN, $BookTitle, $Descripition, $ModuleName, $ModuleURL, $Author){
      
        $result = "";
      if((empty($ISBN)) || (empty($BookTitle))|| (empty($Descripition)) || (empty($ModuleName)) || (empty($ModuleURL)) || (empty($Author)) || (empty($_POST)))
       $result = true;
      else{
        $result = false;
      }
      return $result;
    }
    function ISBNChecker($ISBN){
        $ISBNResult = "";
        if(!preg_match(("/^[0-9]/"), $ISBN)){
            $ISBNResult = true;
        } else{
            $ISBNResult = false;
        }
        return $ISBNResult;
    }
    
    function DoesISBNalreadexist($ISBN){
        $fileISBN = fopen('./Books.csv', 'r');
        $fileget = fgetcsv($fileISBN);
        $ISBNCheck = $fileget[0];
        while($fileget != false){
         if($ISBN === $ISBNCheck){
            exit();
         }else{
            $fileget = fgetcsv($fileISBN);
         }
        }
        fclose($fileISBN);
    }
   
    function SumbitBook(){
        $fileSubmit = fopen('./Books.csv', 'a');
        $Allbookinfo = [];
        foreach ( $_POST as $key => $value ){
        $this_Allbookinfo = $value;
        array_push($Allbookinfo,$this_Allbookinfo);
      } 
      fputcsv($fileSubmit, $Allbookinfo);
        fclose($fileSubmit);
        header("location:../List.php?submit=Success");
    }
    



    if(isset($_POST["ISBN"])){
        $ISBN = $_POST["ISBN"];
        $BookTitle =$_POST["BookTitle"];
        $Descripition = $_POST["Description"];
        $ModuleName =$_POST["ModuleName"];
        $ModuleURL = $_POST["ModuleURL"];
        $Author = $_POST["Author"];
        $i = count($_POST);
        $i = ($i-6)/2-1;
        echo $i;
        $AlltheModules = [];
        $x = 0;
        if($i > 0){
            for($i; $i >= 0; $i--){
                $x++;
                $Module = 'ModuleName';
                $Module .= strval($x);
                $Module1 = 'ModuleURL';
                $Module1 .= strval($x);
                array_push($AlltheModules, $_POST[$Module]);
                array_push($AlltheModules, $_POST[$Module1]);
                print_r($AlltheModules); 
            }
        }
        print_r($AlltheModules); 

     if(emptyInput($ISBN, $BookTitle, $Descripition, $ModuleName, $ModuleURL, $Author) !== false){
          echo "emptyinput";  
          exit();
         }
    }
    
    ISBNChecker($ISBN);
    DoesISBNalreadexist($ISBN);
    SumbitBook();

    
    ?>