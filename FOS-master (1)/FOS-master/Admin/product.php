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
// Add product
if(isset($_POST["submit"])){
    $proName=$_POST["proName"];
    $catNameid =$_POST["catName"];
    $price=$_POST["price"];
    $desc=$_POST["desc"];

    $fileinfo=PATHINFO($_FILES["photo"]["name"]);

	if(empty($fileinfo['filename'])){
		$location="";
	}
	else{
	$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
	move_uploaded_file($_FILES["photo"]["tmp_name"],"../images/foodPic/" . $newFilename);
	$location="../images/foodPic/" . $newFilename;
	}
	
	$sql="insert into product (p_name, cid, price, photo, description) values ('$proName', '$catNameid', '$price', '$location','$desc')";
	$conn->query($sql);

	header('location:product.php');


}

?>
<div class="container-fluid" >
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
            <h1 class="page-header text-center page-header-cate">PRODUCTS CRUD</h1>

            <!-- Button trigger modal - add product -->
            <div class="text-right">
                <select id="catList" class="form-control-sm text-left mr-5">
                    <option value="0">Select Category</option>
                    <?php
                    $catesql="select * from category";
                    $catquery=$conn->query($catesql);
                    while($catrow=$catquery->fetch_array()){
                    $catid = isset($_GET['category']) ? $_GET['category'] : 0;
					$selected = ($catid == $catrow['cid']) ? " selected" : "";
                    echo " <option$selected value=".$catrow['cid'].">".$catrow['c_name']."</option> ";
                    }
                    ?>
                </select>
                <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#addProductModal"><i class="fas fa-plus"></i>Add Product</button>
            </div>
            <!-- end Button trigger modal - add product -->

            <!-- Modal Add product-->
            <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Poppins', sans-serif;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&#x274C;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="product.php" enctype="multipart/form-data">
                                <div class="form-group" style="margin-top:10px;">
                                    <div class="row">
                                        <div class="col-md-4" style="margin-top:7px;">
                                            <label class="control-label font-weight-bold">Product Name:</label>
                                        </div>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="proName" required>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-4" style="margin-top:7px;">
                                            <label class="control-label font-weight-bold">Category Name:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control-sm"name="catName" >
                                            <option selected>Choose...</option>
                                            <?php
                                                $sql="SELECT cid,c_name FROM category";
                                                $query=$conn->query($sql);
					                            while($row=$query->fetch_array()){
                                            ?>
                                            <option value="<?php echo $row['cid']; ?>"><?php echo $row['c_name']; ?></option>
                                            <?PHP } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-4" style="margin-top:7px;">
                                            <label class="control-label font-weight-bold">Price:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="price" required>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-4" style="margin-top:7px;">
                                            <label class="control-label font-weight-bold">Photo:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="file" class="form-control-file" name="photo" required>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-4" style="margin-top:7px;">
                                            <label class="control-label font-weight-bold">Description:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="form-control" rows="2" name="desc" required></textarea>
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
            <!-- Modal end - Add product -->

            <!-- start product table -->

            <table class="table table-hover text-center table-bordered" >
            <thead>
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Item name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $where = "";
                        if(isset($_GET['category']))
                        {
                            $catid=$_GET['category'];
                            $where = " WHERE product.cid = $catid";
                        }
                        $sql="select * from product left join category on category.cid=product.cid $where order by product.cid asc, p_name asc";
                        $query=$conn->query($sql);
                        while($row=$query->fetch_array()){
                    ?>
                    <tr>
                        <td>
                            <a href="<?php if(empty($row['photo'])){echo "../images/foodPic/noimage.jpg";} else{echo $row['photo'];} ?>">
                            <img src="<?php if(empty($row['photo'])){echo "../images/foodPic/noimage.jpg";} else{echo $row['photo'];} ?>" height="30px" width="40px">
                            </a>
                        </td>
                        <td><b><?php echo $row['p_name']; ?></b>
                        <?php $idCE=$row['pid']; ?>
                        </td>
                        <td>Rs. <?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
                            <button name="edit" value="<?php echo $row['pid']; ?>" data-toggle="modal" data-target="#editProModal<?php echo $row['pid']; ?>"class="btn btn-success"><i class="fas fa-edit"></i></button>
                            <button name="delete" value="<?php echo $row['pid']; ?>" data-toggle="modal" data-target="#deleteProModal<?php echo $row['pid']; ?>" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                            <?php include "productModal.php" ?>
                        </td>
                    </tr>
                    <?PHP } ?>
                </tbody>
            </table>

            <!-- end product table -->

        </div>
    </div>
</div>

<?php
//include the footer part
include "admin_footer.php"; 
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#catList").on('change', function(){
			if($(this).val() == 0)
			{
				window.location = 'product.php';
			}
			else
			{
				window.location = 'product.php?category='+$(this).val();
			}
		});
	});
</script>