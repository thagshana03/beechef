<?php
include "../Database/database.php";
?>

<!-- Modal order view-->
<div class="modal fade" id="purModal<?php echo $row['pur_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Poppins', sans-serif;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&#x274C;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="order.php" enctype="multipart/form-data">
                    <input type="text" name="purID" value="<?php echo $row['pur_id']; ?>" hidden>
                    <div class="container-fluid">
                    <h6>Customer & User ID: <b><?php echo $row['name']; ?></b> || <?php echo $row['uid']; ?></h6>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Purchase Quantity</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql="select * from purchase_details left join product on product.pid=purchase_details.pid where pur_id='".$row['pur_id']."'";
                                $dquery=$conn->query($sql);
                                while($drow=$dquery->fetch_array()){
                                    ?>
                                    <tr>
                                        <td><?php echo $drow['p_name']; ?></td>
                                        <td class="text-right"><?php echo number_format($drow['price'], 2); ?></td>
                                        <td><?php echo $drow['quantity']; ?></td>
                                        <td class="text-right">&#8369;
                                            <?php
                                                $subt = $drow['price']*$drow['quantity'];
                                                echo number_format($subt, 2);
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    
                                }
                            ?>
                            <tr>
                                <td colspan="3" class="text-right"><b>TOTAL</b></td>
                                <td class="text-right"><?php echo number_format($row['total_amount'], 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="denialBtn" name="denialBtn" class="btn btn-danger"><i class="fas fa-times pr-2"></i>Denial</button>
                <button  name="acceptBtn" class="btn btn-success"><i class="fas fa-save pr-2"></i>Accept</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal end - order view -->