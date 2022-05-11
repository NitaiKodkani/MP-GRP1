<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php
include_once("../controller/config.php");
for($i=0;$i<count(json_decode($_GET['id']));$i++){

	$index=$_GET['index'];
	$id = json_decode($_GET['id'], true);
	$year=date('Y');
	
	$sql = "INSERT INTO student_subject(index_number,sr_id,year)
			VALUES ('".$index."','".$id[$i]."','".$year."')";
	mysqli_query($conn,$sql);
		
}

?>

<?php
include_once("../controller/config.php");

	$index=$_GET['index'];
	$grade_id=$_GET['grade'];
	$year=date('Y');
	
	$sql = "INSERT INTO student_grade(index_number,grade_id,year)
			VALUES ('".$index."','".$grade_id."','".$year."')";
	mysqli_query($conn,$sql);
		
?>

	<!--MSK-000136-->
<!--Success! - Insert-->
<div class="modal fade" id="insert_Success" tabindex="-1" role="dialog" aria-labelledby="insert_alert2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4>Information...!</h4>
            </div>
            <div class="modal-body bgColorWhite">
                <strong style="color:red;">Success!</strong> Your information has been successfully inserted in our database.
            </div>
        </div>
    </div>
</div><!--/.Modal-->