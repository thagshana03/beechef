<?php 
session_start();
//connect the header and nav part by using admin_header.php 
include "../Database/database.php";
include "admin_header.php"; 
?>
<style>
<?php include "../css/adminHome.css"; //admin home css part add ?>
</style>

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
            <h1 class="page-header text-center page-header-cate">FEEDBACK</h1>
            <table class="table table-hover text-center table-bordered" >
                <thead>
                    <tr>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Feedback</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="SELECT * FROM feedback";
                        $query=$conn->query($sql);
					    while($row=$query->fetch_array()){
                    ?>
                    <tr>
                        <td><b><?php echo $row['uname']; ?></b>
                        </td>
                        <td><b><?php echo $row['f_description']; ?></b>
                        </td>
                        <td>
                            <a id="FBdelete" href="feedbackDelete.php?proId=<?php echo $row['fid']; ?>"><i class="fas fa-trash-alt pr-2"></i>Delete</a>
                        </td>
                    </tr>
                    <?PHP } ?>
                </tbody>
            </table>  
        </div>
    </div>
</div>

<?php
//include the footer part
include "admin_footer.php"; 
?>