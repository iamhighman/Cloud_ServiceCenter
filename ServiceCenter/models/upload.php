<html>
<head>
<title>A simple upload form</title>
</head>
<body>
<h2>Uploaded File Details</h2>

<?php
// display file details
echo "Filename: " . $_FILES['userfile']['name'] . "<br>";
echo "Temporary Name: " . $_FILES['userfile']['tmp_name'] . "<br>";
echo "Size: ". $_FILES['userfile']['size'] . "<br>";
echo "Type: ". $_FILES['userfile']['type'] . "<br>";

// copy file here
if(@copy($_FILES['userfile']['tmp_name'], "/tmp/" . $_FILES['userfile']['name'])){
    echo "<b>File successfully upload</b>";
}else{
    echo "<b>Error: failed to upload file</b>";
}
?>

</body>
</html>
