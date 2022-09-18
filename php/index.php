<?php
    session_start();
    require_once "config.php";

  


    if (isset($_SESSION["username"])) {
        header("location:home.php");
    }

    if (isset($_POST["login"])) {

        // $username = $_POST["username"];
        // $password = $_POST["password"];
        $username = mysqli_real_escape_string ($connection, $_POST["username"]);
        $password = mysqli_real_escape_string ($connection, $_POST["password"]);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            // Is the same hsah?
            if(password_verify($password, $row["password"])) {
                //true:
                $_SESSION["username"] = $username;
                header("location:home.php");
            } else{
                //return False:
                echo '<script> alert("Error en el login !!") </script>';
            }
        } else {
            echo '<script> alert("Error en el login !!") </script>';
        }
            
        
    }

    if (isset($_POST["register"])) {
        if (empty($_POST["username"]) || empty ($_POST["password"] )|| empty($_POST["repeat_password"])) {
            echo '<script> alert("All fields are mandatory") </script>';
        } else {

            ///controlador Password coincidentes:
            if (($_POST["password"]) != ($_POST["repeat_password"] )) {
                echo '<script> alert("Password Mismatch. Try again! ") </script>';
            } 

            //creare un username de form may su password via Insert
            $username = mysqli_real_escape_string ($connection, $_POST["username"]);
            $password = mysqli_real_escape_string ($connection, $_POST["password"]);

            $password = password_hash($password, PASSWORD_DEFAULT);
            $query    = "INSERT INTO users(username, password) VALUES('$username', '$password')";
            //*Si los hashes coinciden: registration done e ir Login Page.
            if (mysqli_query($connection, $query)) {
                echo '<script>alert("Registration Done!! Por favor dale a Login para finalizar ")</script>';
                //header("location:index.php");
            }
        }
    }



?>

<!DOCTYPE html>  
<html>  
      <head>  
           <title>Introduction to PHP</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <link rel="stylesheet" href= "steyles.css?v=<?php echo time(); ?>">
      </head>
        
      <body>
        <div class="container align-middle">
            <?php
            if (isset($_GET["action"]) == "register")
            {
            ?>
            <form method = "post">
                <!-- Username input -->
                <h3 class = "text-center">Register!</h3>

                <div class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control" />
                    <label class="form-label" for="username">Username</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="password" name = "password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>

                <!-- Repeat Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="repeat_password" name = "repeat_password" class="form-control" />
                    <label class="form-label" for="repeat_password">Repeat Password</label>
                </div>
                

                
                <!-- Submit button -->
                <input type="submit" class="btn btn-primary btn-block mb-4" value="Register" name="register" />

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Already a member? <a href="index.php">Login</a></p>
                    
                </div>
            </form>
                <?php
                }
                else
                {
                ?>
                
                <form method = "post">
                    <!-- Username input -->
                    <h3 class = "text-center">Login</h3>

                    <div class="form-outline mb-4">
                        <input type="text" id="username" name="username" class="form-control" />
                        <label class="form-label" for="username">Username</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="password" name = "password" class="form-control" />
                        <label class="form-label" for="password">Password</label>
                    </div>



                    <!-- Submit button -->
                    <input type="submit" class="btn btn-primary btn-block mb-4" value="Login" name="login" />

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Not a member? <a href="index.php?action=register">Register</a></p>
                        
                    </div>
                </form>

                <?php
                }
                ?>

        </div>  
    </body>  
</html> 