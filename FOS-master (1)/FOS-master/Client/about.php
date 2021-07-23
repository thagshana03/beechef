<?php 
session_start();
include "../Database/database.php";
include "client_header.php"; 
?>
<style>
<?php include "../css/about.css"; ?>
</style>

<?php
if(isset($_POST['submit'])){
  $com = $_POST["com"];
  $name = $_POST["uname"];
 
  $feedback_info ="";

  $sql = "INSERT INTO feedback (f_description, uname) VALUES ( '$com', '$name')";

  if ($conn->query($sql)) {
       $feedback_info = "Your Feedback Added successfully !";
	}else{
        $feedback_info = "Your Feedback Not Added. Try Again Later!";
    } 

}
?>

<div class="container-fluid" style="background-color:#fef1e1;">
    <div class="row">
        <div class="col-md-3" >   
        </div>

        <div class="col-md-6" >
            <h1 class="mt-5 text-center">Feedback Form</h1>
            <form action="about.php"  method="POST" enctype="multipart/form-data">
                <div class="form-group">
                <label for="uname">Username:</label>
                <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
                </div>
                <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" rows="5" id="comment" placeholder="Enter the comment" name="com" required></textarea>
                </div>
                    <div class="inputForm">
                        <?php if(!empty($feedback_info)){?>
                            <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= $feedback_info?>
                            </div>
                        <?php } ?>
                    </div>
                <button type="submit" name="submit" class="btn btn-primary m-2">Submit</button>
             </form>

             <h1 class="text-center pt-5 pb-3">Our Place Address in Google Map & Our Shop Video</h1>
             <div class="container">
                <iframe class="responsive-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7921.2863968810425!2d79.86838962596434!3d6.933178948292885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2591d2a7640e7%3A0x377856183e838e81!2sAluthkade%20streetfood!5e0!3m2!1sen!2slk!4v1612330075396!5m2!1sen!2slk" 
                    width="600" height="450" frameborder="0" style="border:0;"
                    allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
             </div>   
            <div class="container">
                <iframe class="responsive-iframe" width="560" height="315" src="https://www.youtube.com/embed/iX1hZB9G5sY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>   
        </div>

        <div class="col-md-3" >
        </div>
    </div>
</div>

<?php
//include the footer part
include "client_footer.php"; 
?>