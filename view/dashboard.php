<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_admin.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('alert.php'); ?>


<style>

    *{
        font-family: 'Rubik', sans-serif;
    }


.set-width-tooltip + .tooltip > .tooltip-inner { 
     min-width:180px;
}


/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

.cal-table{
	
width:100%;
padding:0;
margin:0;	
}

#calendar_dates{
	padding:10px;
	margin-left:10px;
	width:95%;	
	
}

.tHead{
	
	height:40px;
	background-color:#8e1c82;
	color:#FFF;
	text-align:center;
	border:1px solid #FFF;
	width:70px;
}

.cal-tr{
	height:50px;
	
}

.td_no_number{
	border:1px solid white;
	width:70px;
	background-color:#979045;
	padding:0;
}



.cal-number-td{
	border:1px solid white;
	width:70px;
	background-color:#677be2;
	color:white;
	
		
}

.h5{
	color:#FFF;
	display: inline-block;
	background:#636;
	width:15px;
	height:15px;	
	font-size:11px;
	font-weight:bold;
	font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	text-align:center;
	float:right;
	padding-top:1px;
	margin-bottom:50%;
	
}
.div-event-c{
	margin-top:65%;
	height:17px;
	
}

#cal_month{
	width:20%;
	border-radius:5%;
	
	padding:0;
}
#cal_year{
	width:15%;
	border-radius:5%;
	margin-left:5px;
	padding:0;
}

#btnShow{
	
	margin-left:5px;
	
}


</style>

<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Dashboard
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
    	</ol>
	</section>
    
<?php
include_once('../controller/config.php');

$my_index= $_SESSION["index_number"];

$sql="SELECT * FROM admin WHERE index_number='$my_index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['i_name'];

?>  
    
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa-solid fa-children"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Students</span>
<?php
include_once('../controller/config.php');

$sql1="SELECT count(id) FROM student WHERE _status=''";
$total_count1=0;

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$total_count1=$row1['count(id)'];

?>               
              <span class="info-box-number"><?php echo $total_count1; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa-solid fa-chalkboard-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Teachers</span>
<?php
include_once('../controller/config.php');

$sql2="SELECT count(id) FROM teacher";
$total_count2=0;

$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);
$total_count2=$row2['count(id)'];

?> 
              <span class="info-box-number"><?php echo $total_count2; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <!-- /.col -->
      </div>
      <!-- /.row -->


	<div id="showEvent">
    
    </div>
    

<?php 

$my_index=$_SESSION['index_number'];
$my_type=$_SESSION['type'];


?>

	<div class="row" >
    	<div class="col-md-10" ><!-- left column -->
        	<center><h4>Monthly Student Registration</h4></center>
            
            <canvas id="lineChart" width="500"></canvas>
         </div>  
     </div>
		
<script>
                    
function showLineChart(monthly_std_reg){	
 
	var monthly_std_reg1 = JSON.parse("[" + monthly_std_reg + "]");
 
	new Chart(document.getElementById("lineChart"), {
		type: 'line',
		data: {
		  labels: ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"],
		  datasets: [
			{
			  label: "New Student Registration",
			  borderColor: "#00c0ef",
			  fill: false,
			  data: monthly_std_reg1
			 
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true,
			text: ''
		  },
		  scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});

};
</script>

<?php
include_once('../controller/config.php');
$current_year=date("Y");
$prefix="";
$monthly_std_reg="";

$month=array("January","February","March","April","May","June","July","August","September","October","November","December");

for($i=0; $i<count($month); $i++){
	$sql="SELECT COUNT(id) FROM student WHERE reg_year='$current_year' AND reg_month='$month[$i]' AND _status=''";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	$monthly_std_reg.=$prefix.'"'.$row['COUNT(id)'].'"';
	$prefix=',';
	
}

echo "<script>showLineChart('$monthly_std_reg');</script>";

?>
<!--redirect your own url when clicking browser back button -->
<script>
(function(window, location) {
history.replaceState(null, document.title, location.pathname+"#!/history");
history.pushState(null, document.title, location.pathname);

window.addEventListener("popstate", function() {
  if(location.hash === "#!/history") {
    history.replaceState(null, document.title, location.pathname);
    setTimeout(function(){
      location.replace("../index.php");//path to when click back button
    },0);
  }
}, false);
}(window, location));
</script>
                 
</div><!-- /.content-wrapper --> 
    
