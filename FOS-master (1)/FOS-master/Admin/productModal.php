<?php
    include "../Database/database.php";
    
    if(isset($_POST["editSubmit"])){
        $id = $_POST['proEditId'];
        $pname=$_POST['proEditName'];
        $category=$_POST['proEditCate'];
        $price=$_POST['proEditPrice'];
        $desc=$_POST['proEditDesc'];

    
        $sql="select * from product where pid='$id'";
        $query=$conn->query($sql);
        $row=$query->fetch_array();
    
        $fileinfo=PATHINFO($_FILES["photo"]["name"]);
    
        if (empty($fileinfo['filename'])){
            $location = $row['photo'];
        }
        else{
            $newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
            move_uploaded_file($_FILES["photo"]["tmp_name"],"../images/foodPic/" . $newFilename);
            $location="../images/foodPic/" . $newFilename;
        }
    
        $sql="update product set p_name='$pname', cid='$category', price='$price', photo='$location', description='$desc' where pid='$id'";
        $conn->query($sql);
    
        header('location:product.php');
    }
    
    if(isset($_POST["deleteSubmit"])){
        $proEditId= $_POST["proEditId"];

        $sql="delete from product where pid='$proEditId'";
        $conn->query($sql);
    
        header('location:product.php');
    }

?>
    

<!-- Modal edit category-->
<div class="modal fade" id="editProModal<?php echo $row['pid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Poppins', sans-serif;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&#x274C;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="productModal.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold" type="hidden"></label>
                            </div>
                            <div class="col-md-8">
                            <input type="hidden" name="proEditId" class="form-control" value="<?php echo $row['pid']; ?>" >
                            </div>

                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold">Product Name:</label>
                            </div>
                            <div class="col-md-8">
                            <input type="text" class="form-control" name="proEditName" value="<?php echo $row['p_name']; ?>" required>
                            </div>
                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold">Price:</label>
                            </div>
                            <div class="col-md-8">
                            <input type="text" class="form-control" name="proEditPrice" value="<?php echo $row['price']; ?>" required>
                            </div>
                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold">Description:</label>
                            </div>
                            <div class="col-md-8">
                            <input type="text" class="form-control" name="proEditDesc" value="<?php echo $row['description']; ?>" required>
                            </div>
                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold">Category Name:</label>
                            </div>
                            <div class="col-md-8">
                            <select class="form-control-sm-8" name="proEditCate">
                                <option value="<?php echo $row['cid']; ?>"><?php echo $row['c_name']; ?></option>
                                    <?php
                                        $sql="select * from category where cid != '".$row['cid']."'";
                                        $cquery=$conn->query($sql);

                                        while($crow=$cquery->fetch_array()){
                                            ?>
                                            <option value="<?php echo $crow['cid']; ?>"><?php echo $crow['c_name']; ?></option>
                                            <?php
                                        }
                                    ?>
                            </select>
                            </div>
                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold">Photo:</label>
                            </div>
                            <div class="col-md-8">
                            <input type="file" class="form-control-file" name="photo" required>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times pr-2"></i>Close</button>
                <button type="editSubmit" name="editSubmit" class="btn btn-success"><i class="fas fa-save pr-2"></i>Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal end - Add category -->

<!-- Modal Delete category-->
<div class="modal fade" id="deleteProModal<?php echo $row['pid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Poppins', sans-serif;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&#x274C;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="ProductModal.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold" type="hidden"></label>
                            </div>
                            <div class="col-md-8">
                            <input type="hidden" name="proEditId" class="form-control" value="<?php echo $row['pid']; ?>" >
                            </div>

                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold">Product Name:</label>
                            </div>
                            <div class="col-md-8">
                            <h3><?php echo $row['p_name']; ?></h3>
                            <input type="hidden" class="form-control" name="proEditName" value="<?php echo $row['p_name']; ?>" required>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="deleteSubmit" name="deleteSubmit" class="btn btn-danger"><i class="fas fa-trash-alt pr-2"></i>Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal end - delete category -->