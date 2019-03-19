<?php 
session_start();
require_once "dbConfig.php";

if (!isset($_SESSION['logged_in'])){
    if (isset($_POST['login'])) {
    
    $login = $_POST['login'];
    $password = $_POST['haslo'];
    
    $polaczenie = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName)or 
    die($mysql->error);

    $sql = "SELECT * FROM admins WHERE login='$login'";

    if ($rezultat = $polaczenie->query($sql)) {
        //ilu userow o tym loginie i hasle
        $ilu_userow = $rezultat->num_rows;
        
        if ($ilu_userow>0) {
            //jezeli jest to znaczy ze udalo sie zalogowac
                    
            $wiersz = $rezultat->fetch_assoc();        
           
            if ( password_verify($password, $wiersz['password'])){
                $_SESSION['logged_in'] = $wiersz['id'];
                unset ($_SESSION['bad_attempt']);                    
            }else {                    
                 $_SESSION['bad_attempt']=true;
                 header('Location:login.php');
                 exit();
            }
            $_SESSION['bad_attempt']=true;  
             
        } else {   
            $_SESSION['bad_attempt']=true;             
            header('Location:login.php');
        }
    } else {
        echo "literowka w zapytaniu";
    }
    
    $polaczenie->close();  

} else {
    header("Location:login.php");
    exit();
}
}
    
    
    $mysql = new mysqli('localhost', 'root', '', 'codexworld') or die(mysqli_error($mysql));
    $result = $mysql->query("SELECT * FROM form_data") or 
    die($mysql->error);
?>
<!doctype html>
<html>
   <head lang="en">
      <meta charset="utf-8">
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
         <table class="table">
            <thead>
               <tr>
                  <th>#</th>
                  <th>name</th>
                  <th>email</th>
                  <th>file_name</th>
               </tr>
            </thead>
            <?php       
               while($row = $result->fetch_assoc()){ ?>
            <tr>
               <td><?php echo $row['id'] ?></td>
               <td><?php echo $row['name'] ?></td>
               <td><?php echo $row['email'] ?></td>
               <td>
                  <a href="<?php echo "uploads/" . $row['file_name'] ?>">Image</a>
               </td>
            </tr>
            <?php } ?>
         </table>
         <div class="buttons">
         <a href ="index.html" class="btn btn-success" >Add more photos</a>
         <a href ="logout.php" class="btn btn-primary" >Logout</a>
         </div>
      </div>
   </div>
</body>
</html>
