<?php 
session_start();

if (isset($_SESSION['logged_in'])){
  header("Location:show.php");
}
?>
<!doctype html>
<html>
   <head lang="en">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width" />
      <title>AJAX file upload</title>
      <link rel="stylesheet" href="style.css" type="text/css" />
      <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
      <script type="text/javascript" src="script.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   </head>
   <body> 
   <div class="container">
          <div class="row justify-content-center">
            <form class="form-group login-form" action="show.php" method="POST">
                Login: <br/> <input class="form-control" type="text" name="login"> <br/>
                Hasło: <br/> <input class="form-control" type="password" name="haslo"><br/><br/>
                  <?php             
                      if (isset($_SESSION['bad_attempt'])) {
                        echo "<p  style='color:red; text-align:center;'>Zly login lub haslo</p>";
                      };
                      unset ($_SESSION['bad_attempt']);
              ?>
                <input class="form-control buttons" type="submit" value="zaloguj sie">
                <a href ="index.html" class="form-control btn btn-success add-button" >Add more photos</a>
                
            </form>
           
          </div>
        
        </div>
   </body>  
</html>
