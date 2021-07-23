<?php 
//connect the header and nav part by using client_header.php 
include "../Database/database.php";
include "client_header.php"; 
include "../css/carousel.php";
?> 
<!--main contant-->
<div class="container-fluid" id="wrapper">
    <div class="row">
        <div class="col-md-12" style="background-color:#fef1e1;">
            <div class="box-b1">
                <i class="fas fa-clock p-2" style="font-size:48px;color:#fd5f00;"></i>
                <h6>Working Hours</h6>
                <p>10Am - 11Pm</p>
            </div>
             <div class="box-b1">
                <i class="fas fa-map-marked-alt p-2" style="font-size:48px;color:#fd5f00;"></i>
                <h6>Delivery</h6>
                <p>Colombo side only</p>
            </div>
            <div class="box-b1">
                <i class="fas fa-phone-square-alt p-2" style="font-size:48px;color:#fd5f00;"></i>
                <h6>Call No</h6>
                <p>011 236 4587</p>
            </div>
            <h2 class="text-center" style="color:#F25D27;">How It Works</h2>
            <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam reprehenderit id enim quasi dolor recusandae itaque dicta esse inventore, rerum culpa cupiditate, exercitationem, quod ad?</p>
            
            <div class="box_b2">
                <i class="fas fa-sign-in-alt p-2" style="font-size:48px;color:#fd5f00;"></i>
                <h6>Login/Register</h6>
                <p>Need to create the account or already have account then login!</p>
            </div>
            <div class="box_b2">
                <i class="fas fa-utensils p-2" style="font-size:48px;color:#fd5f00;"></i>
                <h6>Order</h6>
                <p>Select your favouried Food and add the food in the Addcard Part.  </p>
            </div>
            <div class="box_b2">
                <i class="fab fa-amazon-pay p-2" style="font-size:48px;color:#fd5f00;"></i>
                <h6>Confirm Payament</h6>
                <p>If you okey with your order then confirm the order</p>
            </div>
            <div class="box_b2">
                <i class="fas fa-motorcycle p-2" style="font-size:48px;color:#fd5f00;"></i>
                <h6>Fast Delivery</h6>
                <p>After confirm, if we accept the order, we will send confime mail.</p>
            </div>
        </div>
    </div>
    <div class="row">
       <div class="col-md-1" style="background-color:#fef1e1;"></div> 
        <div class="col-md-10" style="background-color:#fef1e1;">
            <h2 class="text-center" style="color:#F25D27;">New Items</h2>
            <?php
                $sql = "select * from product ORDER BY pid DESC LIMIT 5";
                $res = $conn->query($sql);
                if($res->num_rows>0){
                    while($row=$res->fetch_assoc()){
                        echo '<div style="display: inline-block;object-position: center;" >
                        <div class="card mx-2 my-2"" style="width: 16rem; height:28rem">
                        <img class="card-img-top" src="'.$row['photo'].'" alt="" height="200px">
                            <div class="card-body">
                                <h5 class="card-title">'. $row['p_name'] .'</h5>
                                <p class="card-text">'. $row['description'] .'</p>
                                <h6 class="text-danger"> Rs.'. $row['price'] .'</h6>
                                <a href="#" class="btn btn-primary">Add to Cart</a>
                            </div>
                        </div></div>';
                    }
                }
            ?>
        </div>
        <div class="col-md-1" style="background-color:#fef1e1;"></div>
    </div>
</div>

<?php
//include the footer part
include "client_footer.php"; 
?>