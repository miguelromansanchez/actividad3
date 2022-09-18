<?php
require_once "config.php";
session_start();

if (!isset($_SESSION["username"])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>  
<html>  
      <head>  
           <title>Introduction to PHP</title>  
           <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <link rel="stylesheet" href="styles.css" />
           <link href='https://fonts.googleapis.com/css?family=Jura' rel='stylesheet'/>
      </head>  
      <body>
        <div class="container align-middle">
            
            <div class = "welcome"> <h1>WELCOME TO OUR APP!! ROQUE, ALEJANDRO AND MIGUEL</h1></div>

            <div class="row">
                <?php
                $query  =  "SELECT * FROM users";

                $result =  mysqli_query($connection, $query);
                if (mysqli_num_rows($result) > 0) {
                    //bucle while
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo 
                        '
                        <div class="col-md-4 my-3">
                            <div class="card border-primary mb-3" style="max-width: 18rem;">
                            
                                <div class="card-body">
                                    <h5 class="card-title">'.$row["username"].'</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">ID: '.$row["id"].'</h6>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card s content.</p>
                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        ';

                        
                    }
                }
                ?>
            </div>
            
            
            <a class="row" href="logout.php">Logout</a>
        </div>  
    </body>  
</html> 
