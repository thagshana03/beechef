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
// Add Category
    if(isset($_POST["submit"])){
        $cateName=$_POST["cateName"];

        $sql="insert into category (c_name) values ('$cateName')";
        $conn->query($sql);
    
        header('location:category.php');
    }


?>

<div class="container-fluid ">
    <div class="row">
        <div class="col-md-2 px-0">
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
            <h1 class="page-header text-center page-header-cate">CATEGORY CRUD</h1>
            <!-- Button trigger modal -->
            <div class="text-right">
            <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-plus"></i> Add Category</button>
            </div>
            
            <!-- Modal Add category-->
            <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Poppins', sans-serif;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&#x274C;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="category.php" enctype="multipart/form-data">
                                <div class="form-group" style="margin-top:10px;">
                                    <div class="row">
                                        <div class="col-md-4" style="margin-top:7px;">
                                            <label class="control-label font-weight-bold">Category Name:</label>
                                        </div>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="cateName" required>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times pr-2"></i>Close</button>
                            <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save pr-2"></i>Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end - Add category -->

            <table class="table table-hover text-center table-bordered" >
                <thead>
                    <tr>
                        <th scope="col">Category Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="SELECT * FROM category ORDER BY cid ASC";
                        $query=$conn->query($sql);
					    while($row=$query->fetch_array()){
                    ?>
                    <tr>
                        <td><b><?php echo $row['c_name']; ?></b>
                        <?php $idCE=$row['cid']; ?>
                        </td>
                        <td>
                            <button name="edit" value="<?php echo $row['cid']; ?>" data-toggle="modal" data-target="#editCateModal<?php echo $row['cid']; ?>"class="btn btn-success mr-3"><i class="fas fa-edit pr-2"></i>Edit</button>
                            <button name="delete" value="<?php echo $row['cid']; ?>" data-toggle="modal" data-target="#deleteCateModal<?php echo $row['cid']; ?>" class="btn btn-danger" ><i class="fas fa-trash-alt pr-2"></i>Delete</button>
                            <?php include "categoryModal.php" ?>
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