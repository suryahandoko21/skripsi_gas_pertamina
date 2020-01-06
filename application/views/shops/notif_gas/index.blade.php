@extends('template.layouts.default')

@section('title', 'Courier Data')
@php
	$alert = false;
	if(ci()->session->flashdata('msg')){
		$alert = ci()->session->flashdata('msg');
	}
	function rpucStr(string $s){ return str_replace('_',' ',strtoupper($s)); }
@endphp
	
@section('content')
@include('template.includes.component.breadcrumb',['bc'=>[
	['class'=>'','link'=>'#','name'=>'Home'],
	['class'=>'','link'=>'#','name'=>'Master'],
	['class'=>'active','link'=>'#','name'=>'Notif'],
],
'title'=>'Notif Gas','subtitle'=>'List data quota gas Pertamina'])
	@if ($alert)
        <div class="note note-warning note-with-right-icon m-b-15" id="alert-update">
            <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
            <div class="note-content text-right">
                <h4>
                    <b>{{$alert}}</b>
                </h4>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Maecenas id gravida libero. Etiam semper id sem a ultricies.
                </p>
            </div>
        </div>
    @endif
	<!-- begin panel -->
	<div class="panel panel-inverse">
		
		<div class="panel-body">
			{{-- @dump($customer) --}}
                <table id="data-table-combine" class="table table-striped table-bordered">
                        <thead>
                          <tr>
							<th scope="col">No</th>
							<th scope="col">Tanggal</th>
							<th scope="col">Komposisi</th>
							<th scope="col">Satuan</th>
							<th scope="col">Keterangan</th>
							<th scope="col">Status</th>
							<th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
			</table>
			
		</div>
	</div>
	<!-- end panel -->
@endsection

@push('css')
<link href="{{base_url('/assets/plugins/datatables/css/dataTables.bootstrap4.css')}}" rel="stylesheet" />
<link href="{{base_url('/assets/plugins/datatables/css/buttons/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
@endpush

@push('scripts')
<script src="{{base_url('/assets/plugins/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{base_url('/assets/plugins/datatables/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{base_url('/assets/plugins/datatables/js/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{base_url('/assets/plugins/datatables/js/buttons/buttons.bootstrap4.min.js')}}"></script>
	<script>
		const g = "{{route('notif_gas.grid')}}";
		function destroy(url) {
			axios.delete(url)
						.then(function (response) {
							// handle success
							window.location.replace("{{route('notif_gas.index')}}");
						})
						.catch(function (error) {
							// handle error
							console.log(error);
						})
						.finally(function () {
							// always executed
						});
		}
		
		$(document).ready(function() {
			$('#data-table-combine').DataTable({
				processing: true,
				serverSide: true,
				ajax: g,
				responsive: true,
				dom: 'Bfrtip',
				"order": [[ 1, "desc" ]],
				buttons: [
					{
						text: 'Buat Stok Gas',
						className:'btn btn-sm btn-primary',
						action: function ( e, dt, node, config ) {
							window.location.replace("{{route('notif_gas.create')}}");
						}
					}
				]
			});

			$('.note-warning').fadeOut(6000)
		});
	</script>
@endpush