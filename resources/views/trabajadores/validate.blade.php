@extends('layout.header')

@section('sidebar')
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
@endsection

@section('content')
		<section class="content-header">
			<div class="col-lg-7">
				<h2 style="margin-top: -10px">
					Trabajadores
				</h2>
			</div>
		</section>
		<section class="content" style="margin-top: 35px">
			<div class="row">
				
				<section class="col-lg-8">
					@include('commons.errors')
					<div class="box box-solid box-default" style="height: 610px">

						<div class="box-header">
							<h5>Vista de documentos <label id="t3-1" hidden="">0</label>
							{{-- <button class="btn btn-success" style="float: right">Nuevo</button></h4> --}}
						</div>
						<div class="box-body">
			<form method="POST" action="/trabajadores/validateDocuments" enctype="multipart/form-data">
								@csrf
							
								<div class="form-group form-horizontal">
									<label class="col-sm-3">Nombre: </label>
									<div class="col-sm-9">
										<div class="form-group form-horizontal">
										<input type="text" value="{{$trabajador->nombre}}" name="nombre" class="form-control" id="t3-2" disabled="">
									</div>
									</div>
								</div>
							<input type="hidden" value="{{$trabajador->id}}" name="id" class="form-control" hidden>
														
								<div class="form-group form-horizontal">
									<label class="col-sm-4">Estatus: </label>
									<div class="col-sm-6">
									<div class="btn-group btn-group-toggle" data-toggle="buttons">
									 <label class="btn btn-primary active">
								    	<input type="radio" name="estatus" value="1" id="1" checked="checked"> Activo
								  	</label>
								  	<label class="btn btn-primary">
								    	<input type="radio" name="estatus" value="0" id="0"> Inactivo
								  	</label>
								  </div>
								</div>
							</div>
							<br><br>
							
							<div class="form-group col-sm-12 col-lg-12">
							<label for="input-24">Documentos</label>
								<div class="file-loading">
									<input id="input-24" name="input24[]" type="file" multiple>
							</div>
							</div>
							
								<div class="form-group col-sm-12 col-lg-12">
									<button type="submit" class="col-lg-12 col-md-12 btn btn-primary" style="margin-top: 15px"> Guardar </button>
								</div>
							
				</form>
							
							
							
						</div>
					</div>
				</section>
			</div>
		</section>
		<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="/js/jquery.js"></script>
		<script src="/js/jquery.lightbox.min.js"></script>-->
		
		<script>
    $("#input-24").fileinput({
        initialPreview: [
            @foreach($documentos as $docs)
								@if($docs->id_trabajador == $trabajador->id)

								'/images/documentos/{{$trabajador->id}}/{{$docs->img_profile}}',
								@endif
								@endforeach
            ],
        initialPreviewAsData: true,
        initialPreviewConfig: [
            @foreach($documentos as $docs)
			@if($docs->id_trabajador == $trabajador->id)
            {downloadUrl: '/images/documentos/{{$trabajador->id}}/{{$docs->img_profile}}', 
			caption: '{{$docs->img_profile}}',
			
			@if(explode('.', $docs->img_profile)[1]=='doc' || explode('.', $docs->img_profile)[1]=='docx')
			type: "office", url: '', 
			@endif
			
			@if(explode('.', $docs->img_profile)[1]=='pdf')
			type: 'pdf', 
			@endif
			
			width: "120px"},
			@endif
			@endforeach
        ],
        deleteUrl: "",
        overwriteInitial: false,
        maxFileSize: 0,
        language: 'es',
        dropZoneEnabled: false,
        showUpload: false,
        showRemove: false,
        showClose: false,
		showCaption: false,
		showBrowse: false,
        preferIconicPreview: true,
        previewFileIconSettings: {
            'doc': '<i class="fas fa-file-word text-primary"></i>',   
        },
        previewFileExtSettings: { 
            'doc': function(ext) {
                return ext.match(/(doc|docx)$/i);
            },
        }
    });
    </script>
    <!--<script>
			
	 $(function()
 {
    $('.gallery a').lightbox(); 
	
	// If you want seperate galleries on the same page
	// just specify different class names. 
	$('.gallery-2 a').lightbox();
	 
 });

</script>-->

@endsection