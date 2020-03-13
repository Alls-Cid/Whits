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
				<li>
					<a href="/trabajadores/">
						<i class="fa fa-address-card"></i> <span>Trabajadores</span>
					</a>
				</li>
				<li class="active">
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
		@include('commons.succes')
				<h2 style="margin-top: -10px">
					Promociones
				</h2>
			</div>
		</section>
		<section class="content" style="margin-top: 35px">
			<div class="row">
				<section class="col-lg-7">
					<div id="boxTable" class="box box-solid box-default" style="height: 610px">
						<div class="box-header">
							<i class="fa fa-list-ol"></i>
							<h3 class="box-title">Creando promociones</h3>
							<a href="/promociones/create" class="btn btn-primary" role="button" style="float: right">Nueva entrada</a>
						</div>
						<div class="box-body" style="display: block;">

						<table id="theTable" class="table table-bordered" style="font-size: 12px">
								<thead class="bg-black-gradient">
									<tr>
										<th>Id</th>
										<th>Nombre Empresa</th>
										<th>Nombre Promoción</th>
										<th>Descripcion</th>
										<th>Vigencia</th>
										<th>Estatus</th>
									</tr>
								</thead>
								<tbody>
								@foreach($promo as $promociones)
									<tr>
										<td>{{$promociones->id}}</td>
										<td>{{$promociones->nombre_empresa}}</td>
										<td>{{$promociones->nombre_promocion}}</td>
										<td>{{$promociones->descripcion}}</td>
										<td>{{$promociones->vigencia}}</td>

										
										@if($promociones->estatus)
										<td>Activo</td>
										@else
										<td>Inactivo</td>
										@endif
									</tr>
									
								@endforeach
								</tbody>
							</table>
							
						</div>
					</div>
				</section>
			</div>
		</section>
		<script>
		    $(document).ready(function() {
                $('#theTable').DataTable({
        			"processing": true,
        			"serverSide": false,
        			"order": [[0, 'asc']],
        			scrollY:        410,
        			scrollCollapse: true,
        			paging:         false
        		});
            } );
		</script>

@endsection