<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cabal</title>
	<link rel="stylesheet" type="text/css" href="components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="components/font-awesome/css/font-awesome.css">
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function ani4(){
			var user=document.getElementById('tf1');
			var pass=document.getElementById('tf2');
			var error=document.getElementById('lb1');
			var l1=user.value.length;
			if(user.value.length<=0){
				if(pass.value.length<=0){
					error.innerHTML='Debe llenar sus datos para ingresar';
					error.className='error1';
					user.className=' form-control error';
					pass.className=' form-control error';
					error.addEventListener('webkitAnimationEnd',function(event){error.className='error';user.className='form-control';
					pass.className='form-control';pass.value="";},false);
				}else{
					error.innerHTML='Debe escribir su nombre de usuario';
					error.className='error1';
					user.className='form-control error';
					error.addEventListener('webkitAnimationEnd',function(event){error.className='error';user.className='form-control'},false);
				}
			}
			else if(pass.value.length<=0) 
			{
				error.innerHTML='Debe escribir su contraseña';
				error.className='error1';	
				pass.className='form-control error';
				error.addEventListener('webkitAnimationEnd',function(event){error.className='error';pass.className='form-control';pass.value="";},false);
			}
			else{
				
				document.getElementById('loader').style.visibility='visible';
				if(user.value.localeCompare("admin")==0&&pass.value.localeCompare("password")==0){
					window.location="admin.php";
				}else{
					document.getElementById('loader').style.visibility='hidden';
					error.innerHTML='Nombre de usuario y/o contraseña incorrectos';
					error.className='error1';	
					user.className='form-control error';
					pass.className='form-control error';
					error.addEventListener('webkitAnimationEnd',function(event){error.className='error';user.className='form-control';pass.className='form-control';pass.value="";},false);
				}
			}
		}
		
		function loginByEnter(e){
			if(e.keyCode==13){
				ani4();
			}
		}
	</script>
	<style>
		input[type=text].original{
			border-radius: 10px;
			font-size: 17px;
			margin-left: 10%;
			height: 30px;
			width: 80%;
			border-color: #264488;
		}

		input[type=text].error{
			background-color: #FF6D70;
			color: white;
		}

		input[type=password].original{
			border-radius: 10px;
			font-size: 25px;
			margin-left: 10%;
			height: 30px;
			width: 80%;
			border-color: #264488;
		}

		input[type=password].error{
			background-color: #FF6D70;
			color: white;
			hold
		}
		
		label.error{
			color: #9E0000; 
			font-weight: bold;
			display: none;
		}

		label.error1{
			font-weight: bold;
			display: block;
			-webkit-animation: animerror1 1.5s;
			-webkit-animation-fill-mode: forwards;
		}

		@-webkit-keyframes animerror1{
			0%{-webkit-transform: translateX(15px);}
			5%{-webkit-transform: translateX(-15px);}
			10%{-webkit-transform: translateX(15px);}
			15%{-webkit-transform: translateX(-15px);}
			20%{-webkit-transform: translateX(15px);}
			25%{-webkit-transform: translateX(0px);}
		}
		
		.loader {
			border: 20px solid #f3f3f3;
			border-radius: 50%;
			border-top: 20px solid #3498db;
			width: 12px;
			height: 12px;
			-webkit-animation: spin 1s linear infinite; /* Safari */
			animation: spin 1s linear infinite;
		}

		/* Safari */
		@-webkit-keyframes spin {
			0% { -webkit-transform: rotate(0deg); }
			100% { -webkit-transform: rotate(360deg); }
		}

		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
	</style>
</head>

<body style="background-color: rgba(255,245,199,1.00)">
	<img src="images/cabalV0.png" style=" position: fixed; height: 650px; top: 60px; right: 0">">
	<img src="images/cabalV0.png" style=" position: fixed; height: 650px; top: 60px; right: 0">
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-2" style="height: 100px"></div>
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-8" style="height: 100px">
		<center>
			<!--<img src="images/logoBNI.png" style="width: 40%">-->
		</center>
	</div>
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-2" style="height: 100px"></div>
	
	<div style="width: 100%; padding-top: 200px; position: absolute">
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-2" style="height: 100px"></div>
		<div id="div1" class="col-lg-4 col-sm-4 col-md-4 col-xs-8" style="border-radius: 10px; background-color: rgba(239,194,46,1.00)">
			<div style="width: calc(100% + 30px); margin-left: -15px; background-color: gainsboro; color: dimgray; border-top-left-radius: 10px; border-top-right-radius: 10px; margin-top: -20px">
				<center>
					<h1>Iniciar sesión</h1>
					<div id="loader" class="loader" style="position: absolute; padding-top: 90px; margin-left: calc(50% - 20px); visibility: hidden"></div>
				</center>
			</div>
			<div style="color: red"><label id="lb1" class="error">Nombre de usuario y/o contraseña incorrectos</label></div>
			<div class="input-group" style="margin-top: 10px">
				<span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
				<input id="tf1" class="form-control" type="text" placeholder="Usuario" autofocus onKeyPress="loginByEnter(event)">
			</div>
			<div class="input-group" style="margin-top: 10px">
				<span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
				<input id="tf2" class="form-control" type="password" placeholder="Contraseña" onKeyPress="loginByEnter(event)">
			</div>
			<div style="margin-top: 40px;">
				
				<button class="btn btn-warning pull-right" onClick="ani4()">Aceptar</button></center>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="height: 20px"></div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-2" style="height: 100px"></div>
	</div>
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-2" style="height: 100px"></div>
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-8" style="height: 1000px">
		<center>
			<!--<img src="images/logoAccesa.png" style="width: 60%">-->
		</center>
	</div>
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-2" style="height: 100px"></div>
	<script type="text/javascript" src="components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>