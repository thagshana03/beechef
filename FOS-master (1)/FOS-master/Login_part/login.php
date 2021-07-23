<?php 
session_start();
//including the DB connection page and header page 
 include "../Database/database.php";
 include "login_header.php";

 $error_info = "";
 
 if(isset($_POST["username"]) && isset($_POST["password"])){
    $username =$_POST["username"];
    $password = $_POST["password"];

    if(!empty($username) && !empty($password)){

        $query = "SELECT * FROM user WHERE username = '" . $username . "' "; //create the query
        $result = $conn->query($query); //hit the database
        $row = mysqli_fetch_assoc($result); //Fetch a result row as an associative array

        if($password == $row["password"]){
            $Uid = $row["uid"];
            $uAddress = $row["address"];
            $uTel = $row["tel"];
            $uName = $row["name"];

            $_SESSION["username"] = $username; //hold information to all the pages
            $_SESSION["uid"]=$Uid;
            $_SESSION["address"]=$uAddress;
            $_SESSION["tel"]=$uTel;
            $_SESSION["name"] = $uName;

            if($row["admin"] == 1){
                header("Location: ../Admin/admin.php");
            }else{
                header("Location: ../Client/index.php");
            }
        }else{
            $error_info = "Wrong Password, please Try Again";
        }

    }else{
        $error_info = "Please, Enter The Username And Password!!";
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

            <!-- form start -->
            <div class="col-md-6 form-container">
                <div class="col-md-12 form-group form-box text-center">
                    <h1 id="loghead">BeeChef</h1>
                    <h3>Login</h3>
                    <form action="login.php" method="POST" enctype="multipart/form-data">
                        <div class="inputForm">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" required>
                        </div>
                        <div class="inputForm">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                        </div>

                        <!-- alert part start-->
                        <div class="inputForm">
                            <?php if(!empty($error_info)){?>
                            <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $error_info?>
                            </div>
                            <?php } ?>
                        </div>
                        <!-- alert part end -->

                        <button name="login" class="btn btn-success">Login</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                    </form>
                    <a href="register.php">Don't have an account? Register Now!!</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
