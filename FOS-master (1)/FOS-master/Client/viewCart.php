<?php
session_start();
include "../Database/database.php"; 
include "client_header.php"; 
?>
<?php
    if(isset($_POST['submit'])){
        $customerID=$_POST['customerID'];
        $Totalamount=$_POST['T_Price'];
        $Delivery_des = $_POST['Delivery_des'];
        $sql="insert into purchase (uid,total_amount,  pur_date, pay_description ) values ('$customerID', $Totalamount, NOW(), '$Delivery_des' )";
		$conn->query($sql);
        $pur_id=$conn->insert_id;
        
		foreach(array_combine($_POST['pid'],$_POST['qty'] ) as $product => $qty):
            $proinfo=explode("||",$product);
            $productid=$proinfo[0];

            $qtyinfo=explode("||",$qty);
            $qtynum=$qtyinfo[0];

            
        $sql1="insert into purchase_details (pur_id, pid, quantity ) values ('$pur_id', '$productid', '$qtynum' )";
        $conn->query($sql1);
        endforeach;
        
        header('location:thankYou.php');
    }

?>


<div class="container-fluid" style="background-color:#fef1e1;">
    <div class="row">
        <div class="col-md-1" ></div>
            <div class="col-md-10" >
            <h1 class="text-center p-3" style="color:#F25D27;">Add Cart</h1>
            </div>
        <div class="col-md-1" ></div>
    </div>
    <div class="row">
        <form action="viewCart.php" method="POST">
        <div class="col-md-1" ></div>
            <div class="col-md-10" >
            <table class='table table-borded'>	
            <tr>
            <th>Item Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th>Remove</th>
            </tr>
            <?php
            if(isset($_GET["del"]))
            {
                foreach($_SESSION["cart"] as $keys=>$values)
                {
                        if($values["pid"]==$_GET["del"])
                        {
                            unset($_SESSION["cart"][$keys]);
                        }
                }
            }

            if(!empty($_SESSION["cart"])){
                $iterate=0;
                $total=0;
                foreach($_SESSION["cart"] as $key=>$values){
                    $amt=$values["qty"]*$values["prices"];
                    $total += $amt;
                    echo"
                    <input type='text' value={$values["pid"]}||{$iterate} name='pid[]' hidden>
                    <input type='text' value={$values["qty"]}||{$iterate} name='qty[]' hidden>
                    <tr>
                        <td>{$values["pname"]}</td>
                        <td>{$values["qty"]}</td>
                        <td>{$values["prices"]}</td>
                        <td>{$amt}</td>
                        <td><a href='viewCart.php?del={$values["pid"]}'><i class='fas fa-trash-alt' style='font-size:18px;color:red;'></i></a></td>
                    </tr>
                    ";
                    $iterate++;
                }
                echo"
                    <tr>
                        <td></td>
                        <td></td>
                        
                        <td><strong>Total</strong></td>
                        <td>{$total}</td>
                    </tr>
                    ";
                
            }else{
                echo "<script>alert('Please Select the Product ....')</script>";
            header("location:menu.php");
            }

            ?>

        </table>            
        </div>
        <div class="col-md-1" ></div>
    </div>
    <div class="row py-3">
        <div class="col-md-1" ></div>
        <div class="col-md-5">
            <h1 class="text-center p-3" style="color:#F25D27;">Personal Details</h1>
                    <div class="form-group">
                        <label for="user_name">Name</label>
                        <input type="text" class="form-control" id="user_name" value="<?php echo $_SESSION["name"]; ?>"  placeholder="name" required>
                        <input type="hidden" name="T_Price" value="<?php echo "$total"; ?>">
                        <input type="hidden" name="customerID" value="<?php echo $_SESSION["uid"]; ?>">
                        <input type="date" name="date" id="datePicker" hidden>
                    </div>
                    <div class="form-group">
                        <label for="address_name">Address</label>
                        <textarea class="form-control" id="address_name"  placeholder="Address" required><?php echo $_SESSION["address"]; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tel_num">Mobile Number</label>
                        <input type="tel" class="form-control" id="tel_num" value="<?php echo $_SESSION["tel"]; ?>"  placeholder="tel" required>
                    </div>
                    <div class="form-group">
                        <label for="delivery_desc">Description:</label>
                        <textarea name="Delivery_des" class="form-control" id="delivery_desc" cols="30" rows="3" placeholder="extra notes about your food and delivery details..." ></textarea>
                    </div>
                    <div class="form-check mx-3">
                        <input class="form-check-input" type="checkbox" id="payCheck1" checked required>
                        <label class="form-check-label" for="payCheck1">
                        <i class="fas fa-money-bill-wave pr-2"></i>Cash on Delivery Only
                        </label>
                    </div>  
        </div>
        <div class="col-md-5 text-center" style="margin-top:180px;" >
            <button name="submit" id="Click_dis" class="btn btn-primary mr-3">Confirm Order</button>
            <button  name="reset" class="btn btn-danger">Cancel</button>
            </form>
        </div>
        <div class="col-md-1" ></div>
    </div>
</div>

<?php include "client_footer.php" ?>
