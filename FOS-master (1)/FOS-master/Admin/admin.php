<?php 
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
        <h1 class="page-header text-center">DASHBOARD</h1>


    <!-- current orders piechart -->
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['status', 'number'],
          <?php
            $query="SELECT status, count(*) as number FROM purchase WHERE status=0 GROUP BY status";
			$result= mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)) {
            	
                echo "['Available order',".$row["number"]."],";
                // echo "['".$row["status"]."',".$row["number"]."],";
            }
          ?>
        ]);

        var options = {
          title: 'Available Order status',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('currentpiechart'));
        chart.draw(data, options);
      }
    </script>
    <!-- Daily sales piechart -->
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          //['mname', 'total'],
          ['dname', 'total'],
          <?php
          $query="SELECT DAYNAME(pur_date) as dname, sum(total_amount) as total FROM purchase WHERE status=1 GROUP BY DAY(pur_date)";
            //$query="SELECT pur_date, count(*) as number FROM purchase WHERE status=0 GROUP BY pur_date";
			$result= mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)) {
                echo "['".$row["dname"]."',".$row["total"]."],";
            }
          ?>
        ]);

        var options = {
          title: 'Daily sales',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('dailypiechart'));
        chart.draw(data, options);
      }
    </script>
    <!-- Daily Sales barchart -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['day', 'total'],
          <?php
          $query="SELECT DAY(pur_date) as day, sum(total_amount) as total FROM purchase WHERE status=1 GROUP BY DAY(pur_date)";
          $result= mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)) {
            	echo "['".$row["day"]."',".$row["total"]."],";
            	  }
          ?>
        ]);

        var options = {
          legend: { position: 'none' },
          chart: {
            title: 'Daily Sales',
            },
          axes: {
            x: {
              0: { side: 'top', label: 'Dates'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('dailybarchart'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>
    <!-- Monthly sales Linechart -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
     var data = google.visualization.arrayToDataTable([
          ['Month', 'Sales'],
          <?php
          
          $query="SELECT MONTHNAME(pur_date) as mname, sum(total_amount) as total FROM purchase WHERE status=1 GROUP BY MONTH(pur_date)";
			$result= mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)) {
                
                echo "['".$row["mname"]."',".$row["total"]."],";
            }
          ?>
        ]);

        var options = {
        chart: {
          title: 'Monthly Sales',
        },
        
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('monthlylinechart'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
    </script>
     <!-- Monthly Sales piechart -->
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['mname', 'total'],
          <?php
          $query="SELECT MONTHNAME(pur_date) as mname, sum(total_amount) as total FROM purchase WHERE status=1 GROUP BY MONTH(pur_date)";
            //$query="SELECT pur_date, count(*) as number FROM purchase WHERE status=0 GROUP BY pur_date";
			$result= mysqli_query($conn,$query);
            while ($row=mysqli_fetch_array($result)) {
                echo "['".$row["mname"]."',".$row["total"]."],";
            }
          ?>
        ]);

        var options = {
          title: 'Monthly sales',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('monthlypiechart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
	  <div id="currentpiechart"style="width: 300px; height: 350px;float: left;"></div>
	  <div id="monthlylinechart"style="width: 600px; height: 350px;float: right;"></div>
	  <div id="dailypiechart"style="width: 320px; height: 350px;margin-left:300px;"></div>
	  <div id="monthlypiechart"style="width: 450px; height: 350px; float: right;"></div>
	  <div id="dailybarchart" style="width: 600px; height: 350px;"></div>
	  
	  			
  </body>
</html>
	</div>
</div>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $("#catList").on('change', function(){
            if($(this).val() == 0)
            {
                window.location = 'dashboard.php';
            }
            else
            {
                window.location = 'dashboard.php?category='+$(this).val();
            }
        });
    });
</script>
        </div>
    </div>
</div>

<?php
//include the footer part
include "admin_footer.php"; 
?>