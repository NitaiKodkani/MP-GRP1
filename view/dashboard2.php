<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_teacher.php'); ?>
<?php include_once('sidebar2.php'); ?>
<?php include_once('alert.php'); ?>

<style>

.form-control-feedback {
  
   pointer-events: auto;
  
}

.set-width-tooltip + .tooltip > .tooltip-inner { 
     min-width:180px;
}

.msk-fade {  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.5s;
    animation-name: animatetop;
    animation-duration: 0.5s;
	

}

.modal-content1 {
  height: auto;
  min-height: 100%;
  border-radius: 0;
  position: absolute;
  left: 25%; 
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
	background-color:#979045 ;
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

$sql="SELECT * FROM teacher WHERE index_number='$my_index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['i_name'];
$id=$row['id'];

?>    
    
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa-solid fa-chalkboard-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">My STUDENTS</span>
<?php
include_once('../controller/config.php');

$sql1="SELECT * FROM subject_routing WHERE teacher_id='$id'";
$total_count2=0;
$my_student=0;
$current_year=date("Y");

$result1=mysqli_query($conn,$sql1);
while($row1=mysqli_fetch_assoc($result1)){
	$sr_id=$row1['id'];
	
	$sql2="SELECT count(id) FROM student_subject WHERE sr_id='$sr_id' AND year='$current_year' AND _status=''";
	
	$result2=mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_assoc($result2);
	$total_count2=$row2['count(id)'];
	$my_student+=$total_count2;

}

?>   
              <span class="info-box-number"><?php echo $my_student; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa-solid fa-children"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Students</span>
<?php
include_once('../controller/config.php');

$sql1="SELECT count(id) FROM student WHERE _status=''";
$all_student=0;

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$all_student=$row1['count(id)'];

?>             
             
              <span class="info-box-number"><?php echo $all_student; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>


      </div>
      <!-- /.row -->
      <h5><?php echo $name; ?>,<strong><span style="color:#cf4ed4;"> Welcome back! </span></strong></h5>
      

    <div id="cEvent">
    
    </div>  
    
<script>
var m2 = 0;

</script>

	<div id="showEvent">
    
    </div>
    
<script>

function get_calendar(day_no,days){
	
	var table = document.createElement('table');
	var tr = document.createElement('tr');
	
	table.className = 'cal-table';
	
	// row for the day letters
	for(var c=0; c<=6; c++){
		var th = document.createElement('th');
		th.innerHTML =  ['S','M','T','W','T','F','S'][c];
		tr.appendChild(th);
		th.className = "tHead";
		
		
	}
	
	table.appendChild(tr);
	
	//create 2nd row
	
	tr = document.createElement('tr');
	
	var c;
	for(c=0; c<=6; c++){
		
		if(c== day_no){
			break;
		}
		var td = document.createElement('td');
		td.innerHTML = "";
		tr.appendChild(td);
		td.className = "td_no_number";
		tr.className = 'cal-tr';
	}
	
	var count = 1;
	for(; c<=6; c++){
		var td = document.createElement('td');
		td.id = "td_"+count;
		td.className = 'cal-number-td';
		tr.appendChild(td);
		tr.className = 'cal-tr';
		
		var h5 = document.createElement('h5');
		h5.className = 'h5';
		td.appendChild(h5);
		h5.innerHTML = count;
		count++;
		
		
	}
	table.appendChild(tr);
	
	//rest of the date rows
	
	for(var r=3; r<=7; r++){
		tr = document.createElement('tr');
		for(var c=0; c<=6; c++){
			
			if(count > days){
				for(; c<=6; c++){
		
					var td = document.createElement('td');
					td.innerHTML = "";
					tr.appendChild(td);
					td.className = "td_no_number";
					tr.className = 'cal-tr';
				}
				table.appendChild(tr);
				return table;
			}
			
			var td = document.createElement('td');
			//td.innerHTML = count;
			td.id = "td_"+count;
			//td.style.padding = 0;
			td.className = 'cal-number-td';
			
			tr.appendChild(td);
			
			var h5 = document.createElement('h5');
			h5.className = 'h5';
			td.appendChild(h5);
			h5.innerHTML = count;
			count++;
			tr.className = 'cal-tr';
			
		}
		table.appendChild(tr);
		
	}
	
};	
</script>
    
<?php 

$my_index=$_SESSION['index_number'];
$my_type=$_SESSION['type'];

?>         

	<div class="row" >
    	<div class="col-md-10" ><!-- left column -->
        	<center><h4>Monthly Student Registration</h4></center>
            
            <canvas id="lineChart" width="800" height="450"></canvas>
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
$prefix1="";
$monthly_std_reg="";
$sr_id1="";
$count5;

for($j=0; $j<12; $j++){
	$count5[$j]=0;
}

$month=array("January","February","March","April","May","June","July","August","September","October","November","December");

$sql1="SELECT * FROM subject_routing WHERE teacher_id='$id'";
$result1=mysqli_query($conn,$sql1);
while($row1=mysqli_fetch_assoc($result1)){
	
	$sr_id=$row1['id'];
	
	for($i=0; $i<count($month); $i++){
		
		$sql="SELECT COUNT(id) FROM student_subject WHERE year='$current_year' AND reg_month='$month[$i]' AND _status='' AND sr_id='$sr_id'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		$a=$row['COUNT(id)'];
		$a=$a*1;
		$count5[$i]+=$a;
	
	}
	
}
 
	for($k=0; $k<count($month); $k++){
		
		$monthly_std_reg.=$prefix.'"'. $count5[$k].'"'; 
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
 
<?php include_once('footer.php'); ?>