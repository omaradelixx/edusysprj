<!DOCTYPE html>
<html lang="en">
<?php
include("header.php");
require_once("db.php");
require_once("navbar.php");

?>

<body>

    <?php
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "SELECT * FROM user WHERE email ='$email' and password='$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row  = mysqli_fetch_array($result);

            $_SESSION["userID"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["user_type"]=$row["user_type"];

            
            if(isset($_SESSION["user_type"])){
            echo '<script>
               window.location.href="index.php"    
             </script>';
            }

            // if ($row["user_type"] = "guest") {
            //     $_SESSION["user_type"] = "guest";
            //     print_r($_SESSION["user_type"]);
            //     // header('location:index.php');
            //     // echo '<script>
            //     //         window.location.href="index.php"    
            //     //     </script>';
            // } elseif (($row["user_type"] = "admin")) {
            //     $_SESSION["user_type"] = "admin";
            //     // echo '<script>
            //     //         window.location.href="index.php"    
            //     //     </script>';
            // };
        } else {
            $error[] = "this email doesnt exist";
        };
    };

    ?>

    <div class="container my-5">
        <div class="row justify-content-center align-items-center">

            <div class="col-md-6">
                <form class="row flex-column justify-content-center" method="POST" action="login.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="InputName">password</label>
                        <input type="password" class="form-control" id="InputName" aria-describedby="emailHelp" placeholder="Enter your password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">login</button>
                    <a href="register.php" class="text-primary mb-2">you dont have acount ? go to register page</a>
                </form>
            </div>

            <div class="col-md-6 text-center">
                <img src="./imgs/Sand-courses-Final-1-removebg-preview.png" class="img-fluid" alt="">
            </div>
        </div>




        <!-- ________________________________FOOTER SECTION___________________________________________________ -->

        <?php
        include("footer.php")
        ?>

</body>

</html>