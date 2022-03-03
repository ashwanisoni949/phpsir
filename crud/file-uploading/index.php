<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>File Uploading</h1>
    <hr/>

    <form action="upload.php" method="post" 
    enctype="multipart/form-data">
        Select File :<input type="file" name="attachment" required>
        <input type="submit"/>
    </form>

</body>
</html>