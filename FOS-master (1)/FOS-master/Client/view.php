<?php 
session_start();
include "../Database/database.php";
include "client_header.php"; 
?>
<div class="container-fluid" style="background-color:#fef1e1;">
    <div class="row">
        <div class="col-md-1" ></div>
            <div class="col-md-10" >
            <h1 class="text-center p-3" style="color:#F25D27;">Item - Full Details</h1>
            </div>
            <div class="col-md-1" ></div>
    </div>
    <div class="row">
        <div class="col-md-1" >
        </div>
        <div class="col-md-10" >
        <?php
            if(isset($_POST["addcart"])){
                if(isset($_SESSION["cart"])){
                $pid_array=array_column($_SESSION["cart"],"pid");
                    if(!in_array($_GET["id"],$pid_array)){
                        $index=count($_SESSION["cart"]);
                        $item = array(
                            'pid' => $_GET['id'],
                            'pname' => $_POST['pname'],
                            'prices' => $_POST['prices'],
                            'qty' => $_POST['qty'],
                        );

                        $_SESSION["cart"][$index] = $item;
                        echo "<script>alert('Product Added..')</script>";
                        header("location:viewCart.php");

                    }else{
                        echo "<script>alert('Product Already Added..')</script>";
                    }

                }else{
                    $item = array(
                        'pid' => $_GET['id'],
                        'pname' => $_POST['pname'],
                        'prices' => $_POST['prices'],
                        'qty' => $_POST['qty'],
                    );
                    $_SESSION["cart"][0] = $item;
                    echo "<script>alert('Product Added..')</script>";
                    header("location:viewCart.php");
                }
            }



            if(isset($_GET["id"])){
            $sql = "select * from product where pid={$_GET["id"]}";
            $res =$conn->query($sql);           
        if($res->num_rows>0){
            $row =$res->fetch_assoc();

            echo "
            
            <form action='{$_SERVER["REQUEST_URI"]}' method='Post'> 
            <table class='table table-bordered text-center'>
            <tr>
            <td><strong>Product Name<strong></td>
            <td><strong>{$row['p_name']}<strong></td>
            </tr>
            <tr>
            <td>Image</td>
            <td colspan='2'><img src='{$row['photo']}' weight='500px' height='250px' ></td> 
            </tr>
            <tr>
            <td>Price</td>
            <td>Rs.{$row['price']}</td>
            </tr>
            <tr>
            <td>Description</td>
            <td>{$row['description']}</td>
            </tr>
            <tr>
            <td>Enter Qty</td>
                <td>
                <input type='number' min='1' max='20' name='qty' required>
                <input type='hidden' value='{$row['p_name']}' name='pname'>
                <input type='hidden' value='{$row['price']}' name='prices'>
                </td>
            </tr>
            <td></td>
            <td><input type='submit' name='addcart' value='Add Cart' class='btn btn-success' ></td>
            </tr>

            </table>
            </form>
            ";

            }else{
            header("location:menu.php");
            }

            }else{          
                header("location:menu.php");
            }
            ?>
        </div>
        <div class="col-md-1" ></div>
    </div>
</div>
<?php include "client_footer.php" ?>
