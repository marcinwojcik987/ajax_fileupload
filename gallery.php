<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Gallery</title>
</head>
<body>
<div id="gridview">
        <div class="heading">Image Gallery</div>
<?php

session_start();
require_once "dbConfig.php";

$mysql = new mysqli('localhost', 'root', '', 'codexworld') or die(mysqli_error($mysql));
$query = $mysql->query("SELECT * FROM form_data ORDER BY id ASC") or 
          die($mysql->error);


if (! empty($query)) {
    while ($row = $query->fetch_assoc()) {
        ?>  
            <div class="image">           
                <img src="<?php echo "uploads/" . $row["file_name"] ; ?>" />            
            </div>
<?php
    }
}
?>
</div>
    
</body>
</html>