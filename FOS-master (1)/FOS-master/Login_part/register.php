<?php 
session_start();
//including the DB connection page and header page 
 include "../Database/database.php";
 include "login_header.php";
 
 //get the inputs 
 if(isset($_POST["Register"])){

    //store all the input in particular variable 
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phoneNo = $_POST["phoneNo"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    $error_info ="";


    if($password == $confirm){
        $result = $conn->query("SELECT * FROM user WHERE username ='".$username."'");

        if(mysqli_num_rows($result)==0){

            $sql = "INSERT INTO user (name, address, email, tel, username, password) VALUES ('$name','$address','$email',
            '$phoneNo','$username','$password')";

            if($conn->query($sql)){
                header ("Location: login.php");
            }else{
                $error_info = "Couldn't create your account";
            }

        }else{
            $error_info = "username already taken";
        }

    }else{
        $error_info = "the confirm password you entered doesn't match";
    }

 }
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- image container -->
            <div class="col-md-6 d-none d-md-block img-fluid image-container">
            </div>
            <!-- image container end -->

            <!-- form part -->
            <div class="col-md-6 form-container">
                <div class="col-md-12 form-group form-box text-center">
                    <h1 id="loghead">BeeChef</h1>
                    <h3>Registration</h3>
                    <h6>Create Your Account... Enjoy Fastest Food Service..!</h6>
                    <form action="register.php" method="POST" enctype="multipart/form-data">
                    <div class="inputForm">
                        <label for="name">Name: </label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <div class="inputForm">
                    <label for="address">Address: </label>
                     <input type="text" name="address" id="address" required>
                    </div>
                    <div class="inputForm">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" required>
                    </div>
                    <div class="inputForm">
                    <label for="phoneNo">Tell: </label>
                    <input type="tel" name="phoneNo" id="phoneNo" required>
                    </div>
                    <div class="inputForm">
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username" required>
                    </div>
                    <div class="inputForm">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" required>
                    </div>
                    <div class="inputForm">
                    <label for="confirm">Confirm Password: </label>
                    <input type="password" name="confirm" id="confirm" required>
                    </div>

                    <!-- alert part start-->
                    <div class="inputForm">
                    <?php 
                        // showing the error message
                        if(!empty($error_info)){ ?>
                        <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $error_info ?></div>
                        <?php } ?>
                    </div>
                    <!-- alert part end-->

                    <button name="Register" class="btn btn-success">Register</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                    </form>
                    <a href="login.php">Already have an account? Login now!!</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>