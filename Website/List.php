<?php
require_once("header.php");
$fileRead = fopen('./Books.csv', 'r');
$fileget = fgetcsv($fileRead);
?>
    <section>
            <?php /*This is the book submission form to add new books to book.csv. It reminds hidden until a user is logged in*/
            if (isset($_SESSION["userName"])){
               ?> <div class="BookSubmission"><?php
             echo"<form class='form' action='submitcsv.php' method='post'>"; ?>
                 <h3>Submit a new Book here!</h3>
                <input type="text" name="ISBN" min="13" max="13" placeholder="ISBN Number">
                <input type="text" name="BookTitle" placeholder="Title">
                <input type="text" name="Description" placeholder="Descripiton...">
                <input type="text" name="Author" placeholder="Author">
                <input type="text" name="ModuleName" placeholder="Module Name">
                <input type="URL" name="ModuleURL" placeholder="please paste link of module page">
                <br>
                <button type="submit">Submit</button>
           <?php echo "</form>"; /*This button calls the function create(), this allows for a book to have multiple modules assigned to it*/?>
           <button onclick='create(++$num)'>click me to add another Module Submission box!</button><?php ;}?>

        </div>
    </section>
    <section>
        <div>
            <div>

            </div>
            <div class="books2">
                <Table class="TableOfBooks">
                <?php  /*This loop reads into the end of file and display the author ISBN and Title of the book
                         Each element is referenced to its corresponding ISBN number allowing for libraryDisplay 
                         to generate the appropriate webpage for the book with the correct information.
                       */
                        while($fileget != false){
                ?>

                    <tr>
                        <td>Title</td>
                        <td><a href ="/Display.php?ISBN=<?php echo $fileget[0];?>"><?php echo $fileget[1];?></a></td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td><a href ="/Display.php?ISBN=<?php echo $fileget[0];?>"><?php echo $fileget[3];?></a></td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td><a href ="/Display.php?ISBN=<?php echo $fileget[0];?>"><?php echo $fileget[0];?></a></td>
                    </tr>
                        <?php $fileget = fgetcsv($fileRead);}
                        fclose($fileRead);?>
                        </div>
                    </tr>
                </Table>
            </div>


        </div>
    </section> 
    <script> 
    /*This function is called by the button and generates extra form boxes so one or more modules can be added to books.csv*/
     $num = 0; 
     function create($num){
        ul = document.querySelector(".form");
        const createModuleName = document.createElement("input");
        createModuleName.placeholder = 'Module Name'+$num;
        createModuleName.type = "text";
        createModuleName.name = "ModuleName"+$num;
        ul.appendChild(createModuleName);
        const createModuleURL = document.createElement("input");
        createModuleURL.placeholder = 'Module URL'+$num;
        createModuleURL.type = "URL";
        createModuleURL.name = "ModuleURL"+$num;
        ul.appendChild(createModuleURL);
        
    }
</script>
    <?php
require_once("footer.php")
?>