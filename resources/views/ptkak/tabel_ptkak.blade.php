<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PT. Pelabuhan Tanjung Priok</title>

	<link href="{{ URL::asset('templateslide/assets/css/style.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('templateslide/assets/css/imagehover/imagehover.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('templateslide/assets/uikit/css/uikit.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

	<script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
	<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>

	<link rel="stylesheet" href="{{ URL::asset('templateslide/assets/js/datatableptkak/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css">
	<script src="{{ URL::asset('templateslide/assets/js/datatableptkak/jquery.dataTables.min.js') }}"></script>

</head>

<style>
.uk-modal-dialog{
	margin-top:70px !important;
	width:900px !important;
	border-radius: 10px;
}
</style>



<body>

	<div class="fl-main-container">
		<!---Header----------->
		<div class="fl-header fl-header-margin" uk-sticky>
			<div>
				<img src="{{ URL::asset('templateslide/assets/img/logo/ptpwhite.png') }}" class="fl-logo" onclick="location.href = '{{ url('dashboard')}}'">
				
				<span class="fl-title-logo">
					E-Report PT. Pelabuhan Tanjung Priok	
				</span>

				<span class="fl-menu-tool">
					<input type="button" class="uk-button uk-button-primary fl-button" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
				</span>
			</div>	
		</div>


		<div class="fl-container">
			<div class="fl-title-page" >
				<span style="font-size:20px">				
					<img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/sopReadMore.png') }}" width="65" alt="">
					PTKAK	
				</span>
				<span style="float:right;margin-top:15px">
					<!-- <div uk-dropdown="mode: click">
						<ul class="uk-nav uk-dropdown-nav">
							<li><a href="#">Divisi</a></li>
							<li><a href="#">Nama</a></li>
							<li><a href="#">Nilai</a></li>
						</ul>
					</div> -->
					@if(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP SUB DIVISI')
					<button onclick="location.href = '{{ url('ptkaklist')}}'" class="uk-button uk-button-success fl-button" type="button">ALL</button>
					<button class="uk-button uk-button-default fl-button" type="button" onclick="showModalfilter()">Filter</button>
					@else
					<button onclick="location.href = '{{ url('ptkakadd/form_ptkak')}}'" class="uk-button uk-button-primary fl-button" type="button">+</button>
					@endif
				</span>
			</div>
			
			<div class="fl-table">
				<div class="uk-overflow-auto">
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider tabelptkak" id="table_list_ptkak" cellspacing="0" width="100%" >
						<thead>
							<tr class="fl-table-head">
								<th width="5%"></th>
								<th width="10%">Tanggal Buat</th>
								<th width="20%">NO PTKAK</th>
								<th width="20%">From Sub Division Name</th>
								<th width="25%">TO Sub Division Name</th>
								<th width="5%">Status</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($ptkak_list as $data)
							@if($data->VERIFIED_STATUS_1 == '0')
							<tr style="background-color: #b3fff0;">
								@else
								<tr style="background-color: #eeffe6;">
									@endif
									<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/i1.png') }}" width="45" alt=""></td>
									<td>{{ $data->PTKAK_DATE}}</td>
									<td>{{ $data->NO_PTKAK }}</td>
									<td>{{ $data->F_SUB_DIVISION_NAME }}</td>
									<td>{{ $data->T_SUB_DIVISION_NAME }}</td>
									<td>
										@if($data->VERIFIED_STATUS_1 == '0')
										<span style="color:green">CREATE</span>
										@elseif($data->VERIFIED_STATUS_1 == '1')
										<span style="color:red">CLOSE</span>
										@else
										<span style="color:red">ANSWER</span>
										@endif
									</td>
									<td>
										<button class="uk-button uk-button-default fl-button" type="button">Action</button>
										@if($data->CREATED_ORG_ID == $org_id && $data->VERIFIED_STATUS_1 == '0' && $data->VERIFIED_STATUS_2 == '0')
											@if($data->CREATED_BY == Auth::user()->ID)
											<div uk-dropdown="mode:click">
												<ul class="uk-nav uk-dropdown-nav">
													<li><a href="/ptkak/master_form_edit/{{ $data->PTKAK_ID }}">Edit</a></li>
													<li><a href="javascript:;" onclick="Deletedata({{$data->PTKAK_ID}})">Delete</a></li>
												</ul>
											</div>
											@elseif(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP SUB DIVISI')
											<div uk-dropdown="mode:click">
												<ul class="uk-nav uk-dropdown-nav">
													<li><a href="/ptkak/master_form_preview/{{ $data->PTKAK_ID }}">Detail</a></li>
													<li><a href="/ptkakclose/close/{{ $data->PTKAK_ID }}">Close PTKAK</a></li>
												</ul>
											</div>
											@elseif(Auth::user()->ACCESS == $data->TO_AUDITAN)
											<div uk-dropdown="mode:click">
												<ul class="uk-nav uk-dropdown-nav">
													<li><a href="/ptkak/master_form_edit/{{ $data->PTKAK_ID }}">Edit</a></li>
													<li><a href="/ptkak/master_form_preview/{{ $data->PTKAK_ID }}">Detail</a></li>
												</ul>
											</div>
											@else
											<div uk-dropdown="mode:click">
												<ul class="uk-nav uk-dropdown-nav">
													<li><a href="/ptkak/master_form_preview/{{ $data->PTKAK_ID }}">Detail</a></li>
													<li><a href="/ptkak/master_form_reportptkak/{{ $data->PTKAK_ID }}">Report PTKAK</a></li>
												</ul>
											</div>
											@endif
										@elseif($data->VERIFIED_STATUS_1 == '1' && $data->VERIFIED_STATUS_2 == '1')
										<div uk-dropdown="mode:click">
											<ul class="uk-nav uk-dropdown-nav">
												<li><a href="/ptkak/master_form_preview/{{ $data->PTKAK_ID }}">Detail</a></li>
												<li><a href="/ptkak/master_form_reportptkak/{{ $data->PTKAK_ID }}">Report PTKAK</a></li>
											</ul>
										</div>
										@else
										<div uk-dropdown="mode:click">
											<ul class="uk-nav uk-dropdown-nav">
												<li><a href="/ptkak/master_form_preview/{{ $data->PTKAK_ID }}">Detail</a></li>
												<li><a href="/ptkak/master_form_reportptkak/{{ $data->PTKAK_ID }}">Report PTKAK</a></li>
											</ul>
										</div>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>	
				</div>

			</div>	
		</div>


		<!-- This is the modal -->
		<div id="DeleteModal" role="dialog">
			<div class="uk-modal-dialog uk-modal-body modal-sm">
				<form action="" id="deleteForm" method="post">
					{{ csrf_field() }}
					<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
						<div>
							<h2 style="text-align: center;">Konfirmasi</h2>
						</div>
					</div>
					<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
						<div>
							<h3 style="text-align: center;">Apakah yakin akan menghapus data ini??</h3>
						</div>
					</div>
					<div class="col-md-4" style="text-align: center;">
						<button type="submit" class="uk-button uk-button-primary" id="submit" onclick="formSubmit()">Yes</button>
						<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
					</div>
				</form>
			</div>
		</div>

		<div id="FilterModal" uk-modal >
			<div class="uk-modal-dialog uk-modal-body modal-sm">
				<!-- <form action="" id="filterForm" method="get"> -->
					<div style="margin-bottom:30px; text-align:center;">
						<span style="font-size:18px">Pilih Divisi / Departement</span>
					</div>
					<div style="height:80px; width: 100%;" data-simplebar data-simplebar-auto-hide="true">
						<div class="col-lg-12" style="text-align: center;">
							<b>Organization Structure</b>
							<select class="form-control select2-list" id="organize_struct_listptkak" name="organize_struct_listptkak" required="required">
								<option value="">--Direktorat-Cabang-Divisi-Sub Divisi--</option>
								@foreach($organize_struct_list as $org)
								<option value="{{ $org->ORGANIZATION_STRUCTURE_ID }}">{{ $org->SUB_DIVISION_NAME }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4" style="text-align: center;">
						<button type="submit" class="uk-button uk-button-primary" id="filterFormsubmit">Yes</button>
						<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
					</div>
					<!-- </form> -->
				</div>
			</div>

		</body>
		</html>

		<!-- <script src="../../../metronic2/assets/demo/default/custom/components/datatables/base/data-local.js" type="text/javascript"></script> -->

		<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

		<script>
			$(document).ready( function () {
				$('#table_list_ptkak').DataTable({
					"scrollY": 300,
					"scrollX": 300
				});				
			} );

			function Deletedata(id){
				UIkit.modal("#DeleteModal").show();
				var id = id;
				var url = '{{url('/ptkkak/deletedatamaster')}}/'+id;
				$("#deleteForm").attr('action', url);

			}

			function formSubmit()
			{
				$("#deleteForm").submit();
			}

			function showModalfilter(){
				UIkit.modal("#FilterModal").show();

			}

			$('#filterFormsubmit').click(function pass_cek(){
				var id = $('#organize_struct_listptkak').val();          

				window.location="{{ url('/ptkakfilter') }}" + "/" + id; 
				setTimeout(function(){
					window.location="{{ url('/ptkakfilter') }}" + "/" + id;  
				},900000000000)

			});


			$(".select2-list").select2({
				allowClear: true
			});
		</script>
