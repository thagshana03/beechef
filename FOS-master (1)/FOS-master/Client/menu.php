<?php 
include "../Database/database.php";
include "client_header.php"; 
?>
<div class="container-fluid" style="background-color:#fef1e1;">
    <div class="row">
    <div class="col-md-1" ></div>
        <div class="col-md-10">
            <h1 class="text-center p-3" style="color:#F25D27;">MENU LIST</h1>
                <div class="text-left p-3">
                    <select id="catList" class="form-control-lg text-left mr-5">
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
                </div>
        </div>
        <div class="col-md-1" ></div>
    </div>
    <div class="row">
        <div class="col-md-1" >
        </div> 
        <div class="col-md-10" >
            <?php
                $where = "";
                if(isset($_GET['category']))
                    {
                        $catid=$_GET['category'];
                        $where = " WHERE product.cid = $catid";
                    }
                $sql="select * from product left join category on category.cid=product.cid $where order by product.cid asc, p_name asc";
                $res = $conn->query($sql);
                if($res->num_rows>0){
                    while($row=$res->fetch_assoc()){
                        echo '<div style="display: inline-block;object-position: center;" >
                        <div class="card mx-2 my-2"" style="width: 16rem; height:23rem">
                        <img class="card-img-top" src="'.$row['photo'].'" alt="" height="200px">
                            <div class="card-body">
                                <h5 class="card-title">'. $row['p_name'] .'</h5>
                                <h6 class="text-danger"> Rs.'. $row['price'] .'</h6>
                                <a href="view.php?id='. $row['pid'] .'" name="addCart" class="btn btn-primary">Add to Cart</a>
                            </div>
                        </div></div>';
                    }
                }
            ?>
        </div> 
        <div class="col-md-1" ></div> 
    </div> 
</div>
<?php include "client_footer.php" ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#catList").on('change', function(){
			if($(this).val() == 0)
			{
				window.location = 'menu.php';
			}
			else
			{
				window.location = 'menu.php?category='+$(this).val();
			}
		});
	});
</script>