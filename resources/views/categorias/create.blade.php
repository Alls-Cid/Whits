@extends('layout.header')

@section('sidebar')
			<ul class="sidebar-menu" data-widget="tree">
				<li>
					<a href="/inicio/">
					<i class="fa fa-home"></i> <span>Inicio</span>
				</a>
				</li>
				<li class="active">
					<a href="/categorias/">
						<i class="fa fa-sitemap"></i> <span>Categorias</span>
					</a>
				</li>
				<li>
					<a href="/usuarios/">
						<i class="fa fa-users"></i> <span>Usuarios</span>
					</a>
				</li>
				<li>
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
					Categoria
				</h2>
			</div>
		</section>
		<section class="content" style="margin-top: 35px">
			<div class="row">
				
				<section class="col-lg-7">
					@include('commons.errors')
					<div class="box box-solid box-default" style="height: 610px">

						<div class="box-header">
							<h5>Detalle de la categoria  <label id="t3-1" hidden="">0</label>
							</h5>
						</div>
						<div class="box-body">
			<form method="POST" action="/categorias" enctype="multipart/form-data">
								@csrf
							
								<div class="form-group form-horizontal">
									<label class="col-sm-3">Nombre: </label><div class="col-sm-9"><input type="text" name="nombre" class="form-control" id="t3-2"></div>
								</div>
							
								<div class="form-group form-horizontal">
									<label class="col-sm-4">Estatus: </label>
									<div class="col-sm-6">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
								 <label class="btn btn-primary active">
								    <input type="radio" name="estatus" value="1" id="1" autocomplete="off" checked> Activo
								  </label>
								  <label class="btn btn-primary">
								    <input type="radio" name="estatus" value="0" id="0" autocomplete="off"> Inactivo
								  </label>
								</div> 
									</div>
								</div>
							
							
								<div class="form-group form-horizontal">
									<label class="col-sm-4">Tipo de Categoria: </label>
									<div class="col-sm-6">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
								 <label class="btn btn-primary active">
								    <input type="radio" name="categoria" value="1" id="1" autocomplete="off" checked> Oficio
								  </label>
								  <label class="btn btn-primary">
								    <input type="radio" name="categoria" value="2" id="2" autocomplete="off"> Profesión
								  </label>
								</div> 
									</div>
								</div>

								<div class="form-group col-sm-12" style="width: 100%">
									<div class="box-body" style="height: 310px; overflow-y: scroll;">
										<div class="file-loading">
											<input id="file-es" name="profile" type="file">
										</div>
									</div>
								</div>
														
							
								<div class="form-group col-sm-12">
									<button type="submit" class="col-lg-12 btn btn-primary" style="margin-top: 15px"> Guardar </button>
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
	var table;
			
	$(function () {
		
		table=$('#myTable').DataTable({
			"processing": true,
			"serverSide": false,
			"order": [[0, 'asc']],
			scrollY:        410,
			scrollCollapse: true,
			paging:         false
		});

	  var detailRows = [];

	  $('#myTable tbody').on( 'click', 'tr td.details-body', function () {
		  var tr = $(this).closest('tr');
		  var row = table.row( tr );
		  var idx = $.inArray( tr.attr('id'), detailRows );
		  var x=row.data();
		  selectedRow=x.folioBoleto;
		  table.$('tr.bg-primary').removeClass('bg-primary');
		  tr.addClass('bg-primary');
		  if(x.Cobrado.localeCompare('SIN COBRAR')==0 && x.Cancelado.localeCompare('SIN CANCELAR')==0){
			  $('#btnBloquear').removeClass('disabled');
		  }else{
			  $('#btnBloquear').addClass('disabled');
		  }
		  //$('#btnBloquear').removeClass('disabled');
		  document.getElementById('iD0').innerHTML=x.folioBoleto;
		  document.getElementById('iD1').innerHTML=x.sEstacionamiento;
		  document.getElementById('iD2').innerHTML=x.fechaEntrada;
		  document.getElementById('iD3').innerHTML=x.Cobrado;
		  document.getElementById('iD4').innerHTML=x.Cancelado;
		  editando=true;
	 } );
	});
			
	function updateDataJSON(){
		table.ajax.reload(function (){
			setSelectedRow();
		});
	}
			
	function updateDataJSON2(){
		table.ajax.reload(function (){
			setSelectedRow();
			$('#btnBloquear').addClass('disabled');
			document.getElementById('iD0').innerHTML='';
			document.getElementById('iD1').innerHTML='';
			document.getElementById('iD2').innerHTML='';
			document.getElementById('iD3').innerHTML='';
			document.getElementById('iD4').innerHTML='';
			document.getElementById('iMotivo').value='';
			table.$('tr.bg-primary').removeClass('bg-primary');
		});
	}
			
	function setSelectedRow(){
		table.rows().eq(0).each( function ( index ) {
			var row = table.row( index );
			var data = row.data();
			if(data.folioBoleto==selectedRow){
				$(row.node()).addClass('bg-primary');
			}
		} );
	}
</script>

@endsection