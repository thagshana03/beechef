<?php 
session_start();
include "../Database/database.php"; // DB connection 
include "client_header.php"; //header design part
?>
<div class="container-fluid" style="background-color:#fef1e1;">
    <div class="row">
        <div class="col-md-2" ></div>
        <div class="col-md-8" >
            <h1 class="p-3">Order History</h1>

        <table class="table table-striped table-bordered">
		<thead>
			<th>Date</th>
			<th>Total Sales</th>
		</thead>
		<tbody>
			<?php 
                $id =$_SESSION["uid"];
				$sql="select * from purchase where uid = $id ";
				$query=$conn->query($sql);
				while($row=$query->fetch_array()){
					?>
					<tr>
						<td><?php echo date('M d, Y h:i A', strtotime($row['pur_date'])) ?></td>
						<td class="text-right"> <?php echo number_format($row['total_amount'], 2); ?></td>
					</tr>
					<?php
				}
			?>
		</tbody>
	</table>
        </div>
        <div class="col-md-2" ></div>
    </div>
</div>

<?php
//include the footer part
include "client_footer.php"; 
?>
