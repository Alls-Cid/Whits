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
		@include('commons.succes')
				<h2 style="margin-top: -10px">
					Categorias
				</h2>
			</div>
		</section>
		<section class="content" style="margin-top: 35px">
			<div class="row">
				<section class="col-lg-7">
					<div id="boxTable" class="box box-solid box-default" style="height: 610px">
						<div class="box-header">
							<i class="fa fa-list-ol"></i>
							<h3 class="box-title">Lista de trabajadores:</h3>
							<a href="/categorias/create" class="btn btn-primary" role="button" style="float: right">Nueva entrada</a>
						</div>
						<div class="box-body" style="display: block;">
							<table id="myTable" class="table table-bordered" style="font-size: 12px">
								<thead class="bg-black-gradient">
									<tr>
										<th>Id</th>
										<th>Nombre</th>
										<th>Estatus</th>
										<th>Tipo Categoría</th>
										</tr>
								</thead>
								<tbody>
								@foreach($cat as $categoria)
									<tr>
										<td>{{$categoria->id}}</td>
										<td><a href="/categorias/{{$categoria->id}}/edit">{{$categoria->nombre}}</a></td>

										@if($categoria->estatus)
										<td>Activo</td>
										@else
										<td>Inactivo</td>
										@endif

										@if($categoria->categoria == '1')
										<td>Oficio</td>
										@else
										<td>Profesión</td>
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
                $('#myTable').DataTable({
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