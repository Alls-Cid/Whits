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
			<div class="col-lg-9">
		@include('commons.succes')
				<h2 style="margin-top: -10px">
					Trabajadores
				</h2>
			</div>
		</section>
		<section class="content" style="margin-top: 35px">
			<div class="row">
				<section class="col-lg-9">
					<div id="boxTable" class="box box-solid box-default" style="height: 610px">
						<div class="box-header">
							<i class="fa fa-list-ol"></i>
							<h3 class="box-title">Lista de trabajadores:</h3>
							<a href="/trabajadores/create" class="btn btn-primary" role="button" style="float: right">Nueva entrada</a>
						</div>
						<div class="box-body" style="display: block;">
							<table id="theTable" class="table table-bordered" style="font-size: 12px">
								<thead class="bg-black-gradient">
									<tr>
										<th>Id</th>
										<th>Nombre</th>
										<th>Telefono</th>
										<th>Latitud</th>
										<th>Longitud</th>
										<th>Actividad</th>
										<th>Categoria</th>
										<th>Descripcion</th>
										<th>Experiencia</th>
										<th>Calificación</th>
										<th>Estatus</th>
										<th>Fecha de Creación</th>
									</tr>
								</thead>
								<tbody>
								@foreach($worker as $trab)
									<tr>
										<td>{{$trab->id}}</td>
										<td><a href="/trabajadores/{{Crypt::encrypt($trab->id)}}/edit">{{$trab->nombre}}</a></td>
										<td>{{$trab->correo}}</td>
										<td>{{$trab->telefono}}</td>
										<td>{{$trab->borndate}}</td>
										<td>{{$trab->metodo_registro}}</td>
										<td>{{$trab->calificacion}}</td>
										@if($trab->estatus)
										<td>Activo</td>
										@else
										<td>Inactivo</td>
										@endif
										<td>{{$trab->created_at}}</td>
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
		    jQuery.extend( jQuery.fn.dataTableExt.oSort, {
                'locale-compare-asc': function ( a, b ) {
                    return a.localeCompare(b, 'cs', { sensitivity: 'case' })
                },
                'locale-compare-desc': function ( a, b ) {
                    return b.localeCompare(a, 'cs', { sensitivity: 'case' })
                }
            })
            
            jQuery.fn.dataTable.ext.type.search['locale-compare'] = function (data) {
                return NeutralizeAccent(data);
            }

            function NeutralizeAccent(data)
            {
              return !data
                  ? ''
                    : typeof data === 'string'
                    ? data
                    .replace(/\n/g, ' ')
                    .replace(/[éÉěĚèêëÈÊË]/g, 'e')
                    .replace(/[šŠ]/g, 's')
                    .replace(/[čČçÇ]/g, 'c')
                    .replace(/[řŘ]/g, 'r')
                    .replace(/[žŽ]/g, 'z')
                    .replace(/[ýÝ]/g, 'y')
                    .replace(/[áÁâàÂÀ]/g, 'a')
                    .replace(/[íÍîïÎÏ]/g, 'i')
                    .replace(/[ťŤ]/g, 't')
                    .replace(/[ďĎ]/g, 'd')
                    .replace(/[ňŇ]/g, 'n')
                    .replace(/[óÓ]/g, 'o')
                    .replace(/[úÚůŮ]/g, 'u')
                    : data
            }

            var table = $('#theTable').DataTable({
            	columnDefs : [
                 { targets: 1, type: 'locale-compare' },
                 
              ],
                "processing": true,
                "serverSide": false,
                "order": [[0, 'asc']],
                scrollY: 410,
                scrollCollapse: true,
                paging: false
            })
            
             $('#example_filter input').keyup(function () {
                table
                .search(
                  jQuery.fn.dataTable.ext.type.search.string(NeutralizeAccent(this.value))
                )
                .draw()
             })
		</script>

@endsection