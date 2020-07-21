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
<body>

	
	<div class="fl-main-container">
		<!---Header----------->
		<div class="fl-header fl-header-margin">
			<div>
				<img src="{{ URL::asset('templateslide/assets/img/logo/ptpwhite.png')}}" class="fl-logo" onclick="location.href = '{{ url('dashboard')}}'">
				
				<span class="fl-title-logo">
					E-Report PT. Pelabuhan Tanjung Priok	
				</span>

				<span class="fl-menu-tool">
					<img src="{{ URL::asset('templateslide/assets/img/logo/Logo e-Report.png') }}" class="fl-logo">
					<input type="button" class="uk-button uk-button-primary fl-button" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
				</span>
			</div>	
		</div>

		<div class="fl-container">
			<div class="fl-title-page" >
				<span style="font-size:20px">				
					<img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/sopReadMore.png')}}" width="65">
					Standard Operational Procedure (SOP)	
				</span>
				<span style="float:right;margin-top:15px">
					@if($tes == '1' || $tes == '2')
						@if( Auth::user()->ACCESS == "ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU")
						<a href="/sop_upload/{{$id}}">
							<button class="uk-button uk-button-success fl-button" style="color:#666666" type="button">
								Upload
							</button>
						</a>
						@endif
					@endif
					@if($tes == '2')
					<button class="uk-button uk-button-primary fl-button" type="button"><a href="/sop_index/{{$id}}"><font style="color:white">Lihat Lebih Sedikit
					</font></a></button>
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
							<th width="20%">File Name</th>
							<th width="20%">File Type</th>
							<th width="15%">Action</th>
						</tr>
						</thead>
						<tbody>	
							@foreach($data as $item)
							<tr>
								<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/i1.png') }}" width="45" alt=""></td>
								<td>{{$item->Sub_Divisi_1}}</td>
								<td>{{$item->Sub_Divisi_2}}</td>
								<td>{{$item->FILE_NAME}}</td>
								<td>{{$item->FILE_TYPE}}</td>
								<td>
								@if( Auth::user()->ACCESS == "ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU")
									<button class="uk-button uk-button-default fl-button" type="button">Action</button>
									<div uk-dropdown="mode:click">
										<ul class="uk-nav uk-dropdown-nav">
											<li><a href="{{url('sop_download/'.$item->FILE_NAME)}}">Download</a></li>
										</ul>
									</div>
								@else
									@if($item->G_Code!='ALL')
									<button class="uk-button uk-button-default fl-button" type="button">Action</button>
									<div uk-dropdown="mode:click">
										<ul class="uk-nav uk-dropdown-nav">
											<li><a href="{{url('sop_download/'.$item->FILE_NAME)}}">Download</a></li>
										</ul>
									</div>
									@endif
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

	<div id="mymodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body">
			<div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-3@m uk-child-width-1-2@s" align="left	">
					<div>
						<b>Jenis SOP</b>
						<input class="uk-input" type="text" placeholder="Masukan Jenis">
					</div>
					
					<div>
						<b>Judul</b>
						<input class="uk-input" type="text" placeholder="Masukan Judul">
					</div>

					<div>
						<b>Tanggal Upload</b>
						<input class="uk-input" type="text" placeholder="Masukan Tanggal Upload">
						<div style="padding-top:10px" align="right">
							<button class="uk-button uk-button-primary fl-button" type="button">Search</button>			
						</div>			
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
