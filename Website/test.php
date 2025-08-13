<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="body">
    <button onclick="create(++$num)">clickme</button>
    <form class= "form"action='submitcsv.php' method='post'>
                <input type="text" name="ISBN" min="13" max="13" placeholder="ISBN Number">
                <input type="text" name="BookTitle" placeholder="Title">
                <input type="text" name="Description" placeholder="Descripiton...">
                <input type="text" name="Author" placeholder="Author">
                <input type="text" name="ModuleName" placeholder="Module Name">
                <input type="URL" name="ModuleURL" placeholder="please paste link of module page">
                <br>
                <button type="submit" name="BookSubmission">Submit</button>
    <script> $num = 0; 
     function create($num){
        
        ul = document.querySelector(".form");
        const createModuleName = document.createElement("input");
        createModuleName.placeholder = 'Module Name'+$num;
        createModuleName.type = "text";
        createModuleName.name = "ModuleName";
        ul.appendChild(createModuleName);
        const createModuleURL = document.createElement("input");
        createModuleURL.placeholder = 'Module URL'+$num;
        createModuleURL.type = "URL";
        createModuleURL.name = "ModuleURL";
        ul.appendChild(createModuleURL);
        $.ajax({
            url:
        })
    }

</script>
</body>
</html>