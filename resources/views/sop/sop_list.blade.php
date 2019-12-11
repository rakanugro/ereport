<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PT. Pelabuhan Tanjung Priuk</title>

	<link href="{{ URL::asset('templateslide/assets/css/style.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('templateslide/assets/css/imagehover/imagehover.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('templateslide/assets/uikit/css/uikit.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
	<link rel="stylesheet" href="{{ URL::asset('templateslide/assets/js/datatableptkak/css/jquery.dataTables.min.css') }}">
	<link href="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('metronic2/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />


	<script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>
	<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

	<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
	<script src="{{ URL::asset('templateslide/assets/js/datatableptkak/jquery.dataTables.min.js') }}"></script>
</head>

<style>
.uk-modal-dialog{
	margin-top:70px !important;
	width:900px !important;
	border-radius: 10px;
}
body{
	background-color: #283a5a;
}
</style>


<body>

	<div class="fl-main-container">
		<!---Header----------->
		<div class="fl-header fl-header-margin" uk-sticky>
			<div>
				<img src="{{ URL::asset('templateslide/assets/img/logo/ptpwhite.png') }}" class="fl-logo" onclick="location.href = '{{ url('dashboard')}}'">
				
				<span class="fl-title-logo">
					E-Reporting PT. Pelabuhan Tanjung Priok	
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
					SOP
				</span>

			<span style="float:right;margin-top:15px">
				@if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' )
				<a href="form_sop"><button class="uk-button uk-button-primary fl-button" type="button">+</button></a>
				@endif
			</span>
		</div>

		<div class="fl-table">
				<div class="uk-overflow-auto">
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id="tablesop">
						<thead>
							<tr class="fl-table-head">
								<th width="5%"></th>							
								<th width="20%">Sub Divisi</th>
								<th width="20%">Sub Divisi</th>
								<th width="20%">Name</th>
								<th width="20%">Alasan</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
								<div uk-dropdown="mode: click">
									<ul class="uk-nav uk-dropdown-nav">
										<li><a href="#">Divisi</a></li>
										<li><a href="#">Nama</a></li>
										<li><a href="#">Nilai</a></li>
									</ul>
								</div>
						@foreach($sop_list as $data)
								<tr>
									<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/i1.png') }}" width="45" alt=""></td>
									<td>{{ $data->Sub_Divisi_1 }}</td>
									<td>{{ $data->Sub_Divisi_2 }}</td>
									<td>{{ $data->SOP_Code_Name }}</td>
									<td>{{ $data->Alasan}}</td>
									<td>
										<button class="uk-button uk-button-default fl-button" type="button">Action </button>
									<div uk-dropdown="mode: click">
										<ul class="uk-nav uk-dropdown-nav">
											<li><a href="/sop_index/{{$data->header_sop_id}}">SOP</a></li>
											<li><a href="/wi/{{$data->header_sop_id}}">WI</a></li>
											<li><a href="/form_file/{{$data->header_sop_id}}">Form File</a></li>
										</ul>
									</div>
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
	<div id="mymodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body">
			<div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<div>
						<b>Nama</b>
						<input class="uk-input" type="text" placeholder="Masukan Nama">
					</div>
					
					<div>
						<b>Divisi</b>
 						<input class="uk-input" type="text" placeholder="Masukan Divisi">
					</div>

					<div>
						<b>Sub Divisi</b>
						<input class="uk-input" type="text" placeholder="Masukan Sub Divisi">
					</div>
					<div style="padding-top:10px" align="right">
							<button class="uk-button uk-button-primary fl-button" type="button">Search</button>			
						</div>			
				</div>
			</div>
	</div>

</body>
</html>

<script>
	function showModal(){
		UIkit.modal("#mymodal").show();
	}
	$(document).ready( function () {
		$('#tablesop').DataTable();
	} );
</script>
