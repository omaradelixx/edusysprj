<!DOCTYPE html>
<html lang="en">
<?php
include("header.php");
require_once("navbar.php");
require_once("db.php");
?>

<?php
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $country = $_POST['country'];
    $user_type = $_POST['user_type'];

    $query = "SELECT * FROM user WHERE email ='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $error[] = "user is already exist";
    } else {
     $insertQuery = $conn->prepare("INSERT INTO user(name,email,password,country,user_type) VALUES (?,?,?,?,?)");
     $insertQuery->bind_param("sssss",$name,$email,$password,$country,$user_type);
     $resultInsert  = $insertQuery->execute();
        if ($resultInsert) { 
            header('location:login.php');
        } else {
            header('location:index.php');
        };
    };
};
?>

<body>

    <div class="container my-5">
        <div class="row justify-content-center align-items-center">

            <div class="col-md-12">
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<h4 class="bg-danger">' . $error . '<h4>';
                    };
                };
                ?>
            </div>
            <div class="col-md-6">
                <form class="row flex-column justify-content-center" method="POST" action="register.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="InputName">Name</label>
                        <input type="text" class="form-control" id="InputName" aria-describedby="emailHelp" placeholder="Enter name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="InputCountry">Country</label>
                        <input type="text" class="form-control" id="InputCountry" aria-describedby="emailHelp" placeholder="Enter Country" name="country" required>
                    </div>



                    <div class="form-group">
                        <label for="inputGroupSelect01">select role</label>
                        <select class="custom-select w-100 mx-2 col-md-4 col-sm-12 col-xs-12" id="inputGroupSelect01" name="user_type" required>
                            <option value="guest">guest</option>
                            <option value="teacher">teacher</option> 
                        </select>                    
                    </div>






                    <div class="form-group">
                        <label for="InputName">password</label>
                        <input type="text" class="form-control" id="InputName" aria-describedby="emailHelp" placeholder="Enter your password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="register">register</button>
                    <a href="login.php" class="text-primary mb-2">alrady have acount ? go to login page</a>
                </form>
            </div>

            <div class="col-md-6 text-center">
                <img src="./imgs/Sand-courses-Final-1-removebg-preview.png" class="img-fluid" alt="">
            </div>
        </div>

        <?php
        include("footer.php");
        ?>
</body>

</html>