<?php
// session_start();
include "../Database/database.php";

    if(isset($_POST["editSubmit"])){
        $cateEditId= $_POST["cateEditId"];
        $cateEditName=$_POST["cateEditName"];

	    $sql="update category set c_name='$cateEditName' where cid='$cateEditId'";
	    $conn->query($sql);
        header('location:category.php');
    }

    if(isset($_POST["deleteSubmit"])){
        $cateEditId= $_POST["cateEditId"];

        $sql="delete from category where cid='$cateEditId'";
        $conn->query($sql);
    
        header('location:category.php');
    }
    
?>


<!-- Modal edit category-->
<div class="modal fade" id="editCateModal<?php echo $row['cid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Poppins', sans-serif;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&#x274C;</span>
                            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="categoryModal.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold" type="hidden"></label>
                            </div>
                            <div class="col-md-8">
                            <input type="hidden" name="cateEditId" class="form-control" value="<?php echo $row['cid']; ?>" >
                            </div>

                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold">Category Name:</label>
                            </div>
                            <div class="col-md-8">
                            <input type="text" class="form-control" name="cateEditName" value="<?php echo $row['c_name']; ?>" required>
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
<!-- Modal end - edit category -->

<!-- Modal Delete category-->
<div class="modal fade" id="deleteCateModal<?php echo $row['cid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Poppins', sans-serif;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&#x274C;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="categoryModal.php" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top:10px;">
                        <div class="row">
                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold" type="hidden"></label>
                            </div>
                            <div class="col-md-8">
                            <input type="hidden" name="cateEditId" class="form-control" value="<?php echo $row['cid']; ?>" >
                            </div>

                            <div class="col-md-4" style="margin-top:7px;">
                                <label class="control-label font-weight-bold">Category Name:</label>
                            </div>
                            <div class="col-md-8">
                            <h3><?php echo $row['c_name']; ?></h3>
                            <input type="hidden" class="form-control" name="cateEditName" value="<?php echo $row['c_name']; ?>" required>
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