<?php include_once('head.php'); ?>


<style>

.form-control-feedback {
   pointer-events: auto;
}


.msk-set-color-tooltip + .tooltip > .tooltip-inner {
     min-width:180px;
	 background-color:red;
}

*{
    font-family: 'Rubik', sans-serif;
}

.bg{
	width:100%;
	height:100%;
}

#loginFrom{
    font-family: 'Rubik', sans-serif;
    opacity:1;
}

body{
    font-family: 'Rubik', sans-serif;
    background-color:white;
}

/*------------------------------------------------------------------
[ Button ]*/
.container-login100-form-btn {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding-top: 13px;
}

.wrap-login100-form-btn {
    width: 100%;
    display: block;
    position: relative;
    z-index: 1;
    border-radius: 25px;
    overflow: hidden;
    margin: 0 auto;
}

.login100-form-bgbtn {
    position: absolute;
    z-index: -1;
    width: 300%;
    height: 100%;
    background: #a64bf4;
    background: -webkit-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
    background: -o-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
    background: -moz-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
    background: linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff);
    top: 0;
    left: -100%;

    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}

.login100-form-btn {
    font-family: Poppins-Medium;
    font-size: 15px;
    color: #fff;
    line-height: 1.2;
    text-transform: uppercase;

    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    width: 100%;
    height: 50px;
}

.wrap-login100-form-btn:hover .login100-form-bgbtn {
    left: 0;
}

</style>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body onLoad="login()">

	<!--Success! - Insert-->
  	<div class="modal fade" id="loginFrom" tabindex="-1" role="dialog" aria-labelledby="loginFrom" aria-hidden="true">
    	<div class="modal-dialog" style="margin-top: 150px; border-radius: 20px;">
        	<div class="modal-content " style="margin: auto ;max-width: 400px;border-radius: 30px; padding: 50px 25px; box-shadow:
  0px 0px 7.9px rgba(0, 0, 0, 0.013),
  0px 0px 18.3px rgba(0, 0, 0, 0.019),
  0px 0px 32.9px rgba(0, 0, 0, 0.023),
  0px 0px 54.6px rgba(0, 0, 0, 0.027),
  0px 0px 89.9px rgba(0, 0, 0, 0.031),
  0px 0px 157.2px rgba(0, 0, 0, 0.037),
  0px 0px 340px rgba(0, 0, 0, 0.05)
;
">
<!--        		<div class="modal-header bg-aqua-gradient">-->
<!--          			<h4 style="padding-left: 20px">Login</h4>-->
<!--        		</div>-->
                <div >
                    <img src="sms.png" width="150" height="150" style="display:block;margin-left: auto;margin-right: auto;width: 50%;">
                </div>
        		<div class="modal-body bgColorWhite" style="border-radius: 30px;">
        			<form role="form" action="../index.php" method="post">                    
                  		<div class="box-body" style="border-radius: 30px; border-bottom: none">
                    		<div class="form-group" id="divEmail" style="margin-top: 20px; margin-left:auto; text-align: center;">
                      			<label style="font-size: 12px ;letter-spacing: 2px;color: grey; font-weight: 200;" for="">EMAIL</label>
                      			<input type="text" style="border: none; background: #f1f1f1; border-radius: 20px; font-size: 12px; text-align: center" class="form-control" id="email" placeholder="Enter email address" name="email" autocomplete="off">
                    		</div>
                            <div class="form-group" id="divPassword" style="margin-top: 40px; margin-left:auto; text-align: center">
                      			<label style="font-size: 12px ;letter-spacing: 2px;color: grey; font-weight: 200;" for="">PASSWORD</label>
                      			<input type="password" style="border: none; background: #f1f1f1; border-radius: 20px; font-size: 12px; text-align: center" class="form-control" id="password" placeholder="Enter password" name="password" autocomplete="off">
                    		</div>
                  		</div><!-- /.box-body -->
                  		<div class="box-footer">
                            <input type="hidden" name="do" value="user_login" />
                            <button type="submit" class="btn btn-info" id="btnSubmit" style="display:block;margin-left: auto;margin-right: auto;width: 50%;letter-spacing: 1px; padding: 10px 30px; border-radius: 10px">LOGIN</button>
                  		</div>
                	</form>
        		</div>
      		</div>      
		</div>
	</div><!--/.Modal--> 

<script>

function login(){
//document.ready(function{	
	
	$('#loginFrom').modal({
		backdrop: 'static',
		keyboard: false
	});
	$('#loginFrom').modal('show');
};

$("form").submit(function (e) {
//MSK-000098-form submit	

	var uname = $('#email').val();
	var password = $('#password').val();
	
	if(uname == ''){
		//MSK-00099-name
		$("#btnSubmit").attr("disabled", true);
		$('#divEmail').addClass('has-error has-feedback');	
		$('#divEmail').append('<span id="spanEmail" class="glyphicon glyphicon-remove form-control-feedback msk-set-color-tooltip" data-toggle="tooltip"    title="Username is required." ></span>');
			
		$("#email").keydown(function() {
			//MSK-00100-name
			$("#btnSubmit").attr("disabled", false);	
			$('#divEmail').removeClass('has-error has-feedback');
			$('#spanEmail').remove();
			
		});	
		
	}
	
	if(password == ''){
		//MSK-00099-name
		$("#btnSubmit").attr("disabled", true);
		$('#divPassword').addClass('has-error has-feedback');	
		$('#divPassword').append('<span id="spanPassword" class="glyphicon glyphicon-remove form-control-feedback msk-set-color-tooltip" data-toggle="tooltip"    title="Password is required." ></span>');
			
		$("#password").keydown(function() {
			//MSK-00100-name
			$("#btnSubmit").attr("disabled", false);	
			$('#divPassword').removeClass('has-error has-feedback');
			$('#spanPassword').remove();
			
		});	
		
	}
	
	
	if(uname == '' || password == ''){
		//MSK-000098- form validation failed
		$("#btnSubmit").attr("disabled", true);
		e.preventDefault();
		return false;
			
	}else{
		$("#btnSubmit").attr("disabled", false);
		
	}


});
</script>

	<div class="modal fade" id="login_error" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true">
    	<div class="modal-dialog">    
      		<div class="modal-content">
        		<div class="modal-header bg-red-active">
          			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          			<h4>Login Attempt Failed</h4>
        		</div>
        		<div class="modal-body bgColorWhite">
        			<strong style="color:red; font-size:14px">Warning: </strong> Email or Password is Incorrect.
        		</div>
			</div>
		</div>
	</div><!--/.Modal-->


<?php
if(isset($_GET["do"])&&($_GET["do"]=="login_error")){
//MSK-000143-6-PHP-JS-INSERT
 
	$msg=$_GET['msg'];
	
	if($msg==1){
		echo"
			<script>
			
			var myModal = $('#login_error');
			myModal.modal('show');
			
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
						
			</script>
		";
	
	}
	
}
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
</body>