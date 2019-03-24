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
                <img id="myImg" onclick="onClick(this)" src="<?php echo "uploads/" . $row["file_name"] ; ?>" />
                <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01">
                <div id="caption"></div>
                </div>            
            </div>
        </section> 
            
<?php
    }
}
?>
</div>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>    
</body>
</html>