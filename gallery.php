<?php
session_start();
require_once "dbConfig.php";

if (!isset($_SESSION['logged_in'])){
  header("Location:index.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="dist\css\lightbox.css" rel="stylesheet">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Gallery</title>
</head>
<body>
<div id="gridview">
        <div class="heading">Image Gallery</div>
<?php

$mysql = new mysqli('localhost', 'root', '', 'codexworld') or die(mysqli_error($mysql));
$query = $mysql->query("SELECT * FROM form_data ORDER BY id ASC") or 
          die($mysql->error);

if (! empty($query)) {
    while ($row = $query->fetch_assoc()) {
        ?> 
        <section>
            <div class="image">
            <a data-lightbox="roadtrip" href="<?php echo "uploads/" . $row["file_name"] ;  ?>"><img src="<?php echo "uploads/" . $row["file_name"] ;  ?>"></a>         
            </div>        
        </section>
        
 
<?php
    }
}
?>
</div>

<script src="dist\js\lightbox.js"></script>
</body>
</html>