<?php 
session_start();
//connect the header and nav part by using admin_header.php 
include "../Database/database.php";
include "admin_header.php"; 
?>
<style>
<?php include "../css/adminHome.css"; //admin home css part add ?>
</style>
<?php
    if(isset($_POST["acceptBtn"])){
        $purID = $_POST["purID"];

        // $sqlA = "insert into purchase (status) values (1) where pur_id = '" .$purID."' ";
        $sqlA = "UPDATE purchase SET status='1' where pur_id = $purID ";
        $conn->query($sqlA);
        

    }
    if (isset($_POST["denialBtn"])) {
        $purID = $_POST["purID"];

        $sqld = "UPDATE purchase SET status='2' where pur_id = $purID ";
        $conn->query($sqld);
        

    }

?>

<div class="container-fluid ">
    <div class="row">
        <div class="col-md-2 px-0 ">
            <nav id="nav" class="active">/
                <ul>
                    <li><a href="admin.php"><span class="admin_iconBar"><i class="fas fa-home"></i></span>Dashboard</a></li>
                    <li><a href="order.php"><span class="admin_iconBar"><i class="fas fa-concierge-bell"></i></span>Orders</a></li>
                    <li><a href="category.php"><span class="admin_iconBar"><i class="fas fa-sitemap"></i></span>Category</a></li>
                    <li><a href="product.php"><span class="admin_iconBar"><i class="fas fa-folder-plus"></i></span>Product</a></li>
                    <li><a href="feedback.php"><span class="admin_iconBar"><i class="fas fa-marker"></i></span>Feedback</a></li>
                    
                </ul>
            </nav>
        </div>
        <div class="col-md-10">
            <h1 class="page-header text-center page-header-cate">ORDERS CRUD</h1>
            <form action="" method="post">
            <table class="table table-hover text-center table-bordered">
                <thead>
                    <tr>
                        <th>Orders Time</th>
                        <th>Purchase ID</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>More Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            // $sql = "select * from purchase order by pur_id desc";
                            $sqls = "select order_status from order_acc";
                            $Squery=$conn->query($sqls);
                            
                            $sql = "SELECT * FROM purchase LEFT JOIN user ON purchase.uid = user.uid ORDER BY pur_id desc;";

                            $query=$conn->query($sql);
					        while($row=$query->fetch_array()){
                               
                        ?>
                        <td><?php echo date('M d, Y h:i A', strtotime($row['pur_date'])) ?></td>
                        <td><?php echo $row['pur_id']; ?></td>
                        <td><?php echo number_format($row['total_amount'],2); ?></td>
                        <td>
                            <?php

                                if($row["status"] == 1){
                                  echo ' <span class="badge badge-success">Confirmed</span>';

                                }elseif ($row["status"]  == 2) {
                                    echo ' <span class="badge badge-danger">Canceled</span>';

                                 }else{ 
                                    echo ' <span class="badge badge-secondary">For Verification</span>';
                                }
                            ?>
                        </td>
                        <td>
                        <a name="view" data-toggle="modal" href="#purModal<?php echo $row['pur_id']; ?>" class="btn btn-primary mr-3" ><i class="fas fa-eye pr-2"></i>View</a>
                        <?php include "orderModel.php" ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </form>
        </div>
    </div>
    <div class="row">

    </div>
</div>

<?php
//include the footer part
include "admin_footer.php"; 
?>