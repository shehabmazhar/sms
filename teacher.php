<?php session_start(); 


include_once 'database.php';
if (!isset($_SESSION['user'])||$_SESSION['role']!='Teacher') {
  header('Location:./logout.php');
}
?>
<?php

 $tid =$fname =$lname = $address = $contact = $dob = $skill = $gender=$email=" ";
              

if(isset($_GET['update'])){
  $update = "SELECT * FROM teacher WHERE tid='".$_GET['update']."'";
  $result = $conn->query($update);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tid = $row['tid'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $contact = $row['contact'];
$skill = $row['skill'];
                $dob = date_format(new DateTime($row['bday']),'m/d/Y');
                $gender = $row['gender'];
                  $address = $row['address'];
                $email=$row['email'];
                
    }
}
}

?>


<!DOCTYPE html>


<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Teacher</title><link rel="icon" href="../img/favicon2.png">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

 <?php include_once 'header.php'; ?>
  <?php include_once 'sidebar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Teacher
        <small>Teacher Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Teacher</a></li>
        <li class="active">Details</li>
      </ol>
    </section>



    <section class="content">

 <div class="row">


    <?php if (!isset($_GET['update'])) { ?>
 <div class="col-xs-4">


         <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                New Teacher Successfully added
              </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">New Teacher</h3>
            </div>
            <form role="form" method="POST" >
              <div class="box-body">

                 <div class="form-group">
                  <label for="exampleInputPassword1">Teacher ID</label>
                  <input name="sid" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Teacher ID No" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">First Name</label>
                  <input name="fname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Teacher First Name" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name</label>
                  <input name="lname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Teacher Last Name" required>
                </div>

                 <div class="form-group">
                 
                <label>Date of Birth</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name='dob' class="form-control pull-right" id="datepicker" placeholder="Select Teacher's Data of Birth">
                </div>
              
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Gender</label>
                  <div class="radio ">
  <label style="width: 100px"><input type="radio" name="gender" value="Male" checked>Male</label>
  <label style="width: 100px"><input type="radio" name="gender" value="Female" checked>Female</label>

</div>
                 
                </div>


                  <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter Teacher email" required>
                </div>


                <div class="form-group">
    <label for="exampleFormControlTextarea1">Address</label>
    <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
  </div>
   <div class="form-group">
                  <label for="exampleInputPassword1">Contact</label>
                  <input name="contact" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Teacher Contact No" required>
                </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Skills</label>
    <textarea name="skill" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
  </div>


               


       
              </div>

              <div class="box-footer">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Teacher</button>
              </div>
            </form>

              <?php

              if (isset($_POST['submit'])) {
                $tid = $_POST['sid'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];

                $dob = date_format(new DateTime($_POST['dob']),'Y-m-d');
                $gender = $_POST['gender'];
                  $address = $_POST['address'];
               
                $skill = $_POST['skill'];
$email = $_POST['email'];
 $contact = $_POST['contact'];



                  try {


                   

                    $sql = "INSERT INTO Teacher (tid,fname,lname,bday,address,gender,skill,contact,email) VALUES ('".$tid."', '".$fname."', '".$lname."','".$dob."','".$address."','".$gender."','".$skill."','".$contact."','".$email."')";

                  if ($conn->query($sql) === TRUE) {
                         echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
x.style.display='block';</script>";
                      } else {
                            }
                    
                  } catch (Exception $e) {
                    
                  }





                  
                                            }

              ?>



          </div></div>

          <?php }elseif (isset($_GET['update'])) { ?>


             <div class="col-xs-4">


         <div class="alert alert-success alert-dismissible" style="display: none;" id="truemsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                 Teacher Update Successfully 
              </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Teacher</h3>
            </div>
            <form role="form" method="POST" >
              <div class="box-body">

                 <div class="form-group">
                  <label for="exampleInputPassword1">Teacher ID</label>
                  <input name="sid" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$tid."'"; ?>>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">First Name</label>
                  <input name="fname" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$fname."'"; ?>>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name</label>
                  <input name="lname" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$lname."'"; ?>>
                </div>

                 <div class="form-group">
                 
                <label>Date of Birth</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name='dob' class="form-control pull-right" id="datepicker" value=<?php echo "'".$dob."'"; ?>>
                </div>
              
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Gender</label>
                  <div class="radio ">
  <label style="width: 100px"><input type="radio" name="gender" value="Male" <?php if($gender=='Male'){echo 'checked';} ?>>Male</label>
  <label style="width: 100px"><input type="radio" name="gender" value="Female" <?php if($gender=='Female'){echo 'checked';} ?>>Female</label>

</div>
                 
                </div>


                 <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input name="email" type="email" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$email."'"; ?>>
                </div>


                <div class="form-group">
    <label for="exampleFormControlTextarea1">Address</label>
    <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="2"><?php echo $address; ?></textarea>
  </div>

   <div class="form-group">
                  <label for="exampleInputPassword1">Contact</label>
                  <input name="contact" type="text" class="form-control" id="exampleInputPassword1"  required value=<?php echo "'".$contact."'"; ?>>
                </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Skills</label>
    <textarea name="skill" class="form-control" id="exampleFormControlTextarea1" rows="2"><?php echo $skill; ?></textarea>
  </div>


               


       
              </div>

              <div class="box-footer">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Update Teacher</button>
              </div>
            </form>

              <?php

              if (isset($_POST['submit'])) {
                $tid = $_POST['sid'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $dob = date_format(new DateTime($_POST['dob']),'Y-m-d');
                $gender = $_POST['gender'];
                  $address = $_POST['address'];
               
                $skill = $_POST['skill'];

 $contact = $_POST['contact'];



                  try {


                   $sql = "UPDATE teacher SET fname='".$fname."',lname='".$lname."',bday='".$dob."',address='".$address."',gender='".$gender."',skill='".$skill."',contact='".$contact."',email='".$email."' WHERE tid = '".$tid."'";


                  if ($conn->query($sql) === TRUE) {
                         echo "<script type='text/javascript'> var x = document.getElementById('truemsg');
x.style.display='block';</script>";
                      } else {
                            }
                    
                  } catch (Exception $e) {
                    
                  }





                  
                                            }

              ?>



          </div></div>

        <?php } ?>


          <div class="col-xs-8">


          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">All Teachers</h3>
            </div>
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Teacher ID</th>
                  <th>Full Name</th>
                  <th>Date of Birth</th>
                  <th>Gender</th>
                  <th>Address</th>
                  <th>Contact</th>
                  <th>Skills</th>
                  <th>Actions</th>
                  
                </tr>
                </thead>
                <tbody>


                  <?php

                  $sql = "SELECT * FROM teacher";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                      echo "<tr><td> " . $row["tid"]. " </td><td> " . $row["fname"]." ". $row["lname"]. " </td><td> " . $row["bday"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["address"]. "</td><td>" . $row["contact"]. "</td><td>" . $row["skill"]. "</td><td><a href='teacher.php?update=". $row["tid"]."'><small class='label  bg-orange'>Update</small></a></td></tr>";
                       }
                                  }

                  ?>


                </tbody>
                <tfoot>
                 
                </tfoot>
              </table>
            </div>
          </div>
            
          </div>

          

        </div>

      
   
    </section>

  </div>
<h1> Saad Talaat </h1>
  <?php include_once 'footer.php'; ?>

  
  
  <div class="control-sidebar-bg"></div>
</div>


<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>


<script>   $('.select2').select2()
  $('#datepicker').datepicker({
      autoclose: true
    });


        
            var r = document.getElementById("teacher"); 
            r.className += "active"; 
           
    </script>

</body>
</html>