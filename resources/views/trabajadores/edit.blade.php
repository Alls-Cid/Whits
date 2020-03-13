<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cabal</title>
	<link rel="stylesheet" type="text/css" href="/components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/components/font-awesome-5-0-6/css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="/components/bootstrap-select/dist/css/bootstrap-select.css">
	<link rel="stylesheet" type="text/css" href="/components/bootstrap-fileinput/css/fileinput.css">
	<link rel="stylesheet" type="text/css" href="/components/bootstrap-fileinput/themes/explorer-fa/theme.css">
	<link rel="stylesheet" type="text/css" href="/components/adminLTE/css/AdminLTE.min.css">
	<link rel="stylesheet" type="text/css" href="/components/adminLTE/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	<link rel="icon" href="/images/Icon.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="/css/jquery.lightbox.css">
	<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="/components/bootstrap-fileinput/js/fileinput.js"></script>
	<script type="text/javascript" src="/components/bootstrap-fileinput/js/locales/es.js"></script>
	<script type="text/javascript" src="/components/bootstrap-fileinput/themes/explorer-fa/theme.js"></script>
	<script type="text/javascript" src="/components/adminLTE/js/adminlte.min.js"></script>
	<script type="text/javascript" src="/components/adminLTE/js/pages/dashboard.js"></script>
	<script type="text/javascript" src="/components/adminLTE/js/demo.js"></script>
	<script type="text/javascript" src="/components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>

mapa = {
 map : false,
 marker : false,

 initMap : function() {

 // Creamos un objeto mapa y especificamos el elemento DOM donde se va a mostrar.

 mapa.map = new google.maps.Map(document.getElementById('mapa'), {
   center: {lat: {{$trabajador->lat}}, lng: {{$trabajador->lng}}},
   scrollwheel: false,
   zoom: 14,
   zoomControl: true,
   rotateControl : false,
   mapTypeControl: true,
   streetViewControl: false,
 });

 // Creamos el marcador
 mapa.marker = new google.maps.Marker({
 position: {lat: {{$trabajador->lat}}, lng: {{$trabajador->lng}}},
 draggable: true
 });
 
 //DragListener
  mapa.marker.addListener('dragend',function(event){
    var lat = mapa.marker.getPosition().lat();
    var lng = mapa.marker.getPosition().lng();

    document.getElementById("lat").value=lat;
    document.getElementById("lng").value=lng; 
  });

 // Le asignamos el mapa a los marcadores.
  mapa.marker.setMap(mapa.map);
  
  
 },

// función que se ejecuta al pulsar el botón buscar dirección
getCoords : function()
{
  // Creamos el objeto geodecoder
 var geocoder = new google.maps.Geocoder();
address = document.getElementById('search').value;

  // Llamamos a la función geodecode pasandole la dirección que hemos introducido en la caja de texto.
 if(address != ''){
 geocoder.geocode({ 'address': address}, function(results, status)
 {
   if (status == 'OK')
   {
// Mostramos las coordenadas obtenidas en el p con id coordenadas
    document.getElementById("lat").value=results[0].geometry.location.lat();
    document.getElementById("lng").value=results[0].geometry.location.lng();
   
// Posicionamos el marcador en las coordenadas obtenidas
   mapa.marker.setPosition(results[0].geometry.location);
// Centramos el mapa en las coordenadas obtenidas
   mapa.map.setCenter(mapa.marker.getPosition());
   agendaForm.showMapaEventForm();
       

   }
  });
 } else{
 	var lat = mapa.marker.getPosition().lat();
    var lng = mapa.marker.getPosition().lng();

    document.getElementById("lat").value=lat;
    document.getElementById("lng").value=lng;
 }


 }
}
</script>
	
</head>

<body class="hold-transition sidebar-mini skin-blue" onload="mapa.initMap()">
	<img src="/images/cabalV0.png" style=" position: fixed; height: 600px; top: 60px; right: 0">
	
	<label id="idUsuario" class="hidden">{{ Auth::user()->name }}</label>
	<header class="main-header">
    	<a href="#" class="logo">
			<span class="logo-mini"><img src="/images/cabeza.png" height="25px"></span>
			<span class="logo-lg"><img src="/images/cabeza.png" height="30px"><img src="/images/nombre.png" height="30px"></span>
		</a>
		<nav class="navbar navbar-static-top">
			<a href="#" data-toggle="push-menu" role="button" style="float:left;background-color:transparent;background-image:none;padding:15px 15px; color: white">
				<i class="fa fa-bars"></i>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user-circle"></i>
							<span class="hidden-xs">{{ Auth::user()->name }}
								</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<aside class="main-sidebar">
		<section class="sidebar">

			<ul class="sidebar-menu" data-widget="tree">
				<li>
					<a href="/inicio/">
					<i class="fa fa-home"></i> <span>Inicio</span>
				</a>
				</li>
				<li>
					<a href="/categorias/">
						<i class="fa fa-sitemap"></i> <span>Categorias</span>
					</a>
				</li>
				<li >
					<a href="/usuarios/">
						<i class="fa fa-users"></i> <span>Usuarios</span>
					</a>
				</li>
				<li class="active">
					<a href="/trabajadores/">
						<i class="fa fa-address-card"></i> <span>Trabajadores</span>
					</a>
				</li>
				<li>
					<a href="/promociones/">
						<i class="fas fa-clipboard-check"></i></i> <span>Promociones</span>
					</a>
				</li>
				<li>
					<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt"></i> <span>Cerrar Sesión</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
				</li>
			</ul>
			
		</section>
	</aside>
	<div class="content-wrapper">
			<section class="content-header">
			<div class="col-lg-7">
				<h2 style="margin-top: -10px">
					Editar Trabajador
				</h2>
			</div>
		</section>
		<section class="content" style="margin-top: 35px">
			<div class="row">
				
				<section class="col-lg-7">
						@include('commons.errors')	
					<div class="box box-solid box-default" style="height: 610px">
						<div class="box-header">
						</div>
						<div class="box-body">
			<form method="POST" action="/trabajadores/{{$trabajador->id}}" enctype="multipart/form-data">
								@method('PUT')
								@csrf
							
								<div class="form-group form-horizontal">
									<label class="col-sm-3">Nombre: </label><div class="col-sm-9">
										<div class="form-group form-horizontal">
										<input type="text" name="nombre" value="{{$trabajador->nombre}}" class="form-control" id="t3-2"></div></div>
								</div>
							
								<div class="form-group form-horizontal">
									<label class="col-sm-3">Telefono: </label>
									<div class="col-sm-9">
										<div class="form-group form-horizontal">
										<input type="number" name="telefono" value="{{$trabajador->telefono}}" size="10" class="form-control" id="t3-2" required="">
									</div>
									</div>
								</div>

								<div class="form-group form-horizontal">
									<label class="col-sm-3">Password: </label>
									<div class="col-sm-9">
										<div class="form-group form-horizontal">
										<input type="password" name="password" value="{{$trabajador->password}}" class="form-control" id="t3-2" required="">
									</div>
									</div>
								</div>


								<div class="form-group form-horizontal">
									<label class="col-sm-3">Descripcion: </label>
									<div class="col-sm-9">
										<div class="form-group form-horizontal">
										<input type="text" name="descripcion" value="{{$trabajador->descripcion}}" class="form-control" id="t3-2" required="">
									</div>
									</div>
								</div>

								<div class="form-group form-horizontal">
									<label class="col-sm-3">Experiencia: </label>
									<div class="col-sm-9">
										<div class="form-group form-horizontal">
										<input type="number" name="experiencia" class="form-control" value="{{$trabajador->experiencia}}" id="t3-2" required="">
									</div>
									</div>
								</div>

								<div class="form-group form-horizontal">
									<label class="col-sm-3">Mapa: </label>
									<div class="col-sm-9">
										<div class="form-group form-horizontal">
										<div id="mapa" style="width: 100%; height: 350px;"> </div>
									</div>
									<div class="form-group form-horizontal">
									<input type="text" id="search" class="form-control">
								</div><div class="form-group form-horizontal">
									<input type="button" class="col-lg-12 col-md-12 btn btn-primary" value="Obtener dirección" onClick="mapa.getCoords()">
								</div>
									</div>
								</div>



								<div class="form-group form-horizontal">
									<label class="col-sm-3">Latitud: </label>
									<div class="col-sm-9">
										<div class="form-group form-horizontal">
										<input type="text" name="lat" value="{{$trabajador->lat}}" class="form-control" id="lat" required="" readonly="readonly">
									</div>
									</div>
								</div>

								<div class="form-group form-horizontal">
									<label class="col-sm-3">Longitud: </label>
									<div class="col-sm-9">
										<div class="form-group form-horizontal">
										<input type="text" name="lng" value="{{$trabajador->lng}}" class="form-control" id="lng" required="" readonly="readonly">
									</div>
									</div>
								</div>
														
								<div class="form-group" style="width: 100%">
									<div class="box-body" style="height: 310px; overflow-y: scroll;">
										<div class="file-loading">
											<input id="file-es" name="profile" type="file">
										</div>
									</div>
								</div>
							
								<div class="form-group col-sm-12 col-lg-12">
									<button type="submit" class="col-lg-12 col-md-12 btn btn-primary" style="margin-top: 15px"> Actualizar </button>
								</div>															
							
															
				</form>
							
								
						</div>
					</div>
				</section>
			</div>
		</section>
		<script>
			
	$('#file-es').fileinput({
        theme: 'explorer-fa',
        language: 'es',
        uploadUrl: '#',
		showUpload: false,
		showRemove: false
    });
	
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCulZGPV9ZjSzO_DJqO4gNtOdMvgTCxnso&callback=initMap"
    async defer></script>

	</div>
		
</body>
</html>