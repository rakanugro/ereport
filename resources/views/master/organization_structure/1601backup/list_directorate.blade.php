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


	<script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>
	<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

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
					List Directorate
				</span>
				<span style="float:right;margin-top:15px">
					<button class="uk-button uk-button-default fl-button" type="button">List</button>
					<div uk-dropdown="mode: click">
						<ul class="uk-nav uk-dropdown-nav">
							<li><b><a href="{{url('master/organization_structure')}}">List Organization Structure</a></b></li>
							<li><a href="{{url('master/list_branch_office')}}">List Branch Office</a></li>
							<li><a href="{{url('master/list_divisi')}}">List Divisi</a></li>
							<li><a href="{{url('master/list_sub_divisi')}}">List Sub Divisi</a></li>
						</ul>
					</div>
				<!-- <span style="float:right;margin-top:15px">
					<button class="uk-button uk-button-default fl-button" type="button">Sorting</button>
					<div uk-dropdown="mode: click">
						<ul class="uk-nav uk-dropdown-nav">
							<li><a href="#">Divisi</a></li>
							<li><a href="#">Nama</a></li>
							<li><a href="#">Nilai</a></li>
						</ul>
					</div>
					<button class="uk-button uk-button-default fl-button" type="button" onclick="showModal()">Filter</button> -->
					@if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
					<a href="form_directorate"><button class="uk-button uk-button-primary fl-button" type="button">+</button></a>
					@endif
				</span>
			</div>
			<div class="fl-table">
				<div class="uk-overflow-auto">
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id="directoratlist">
						<thead>
							<tr class="fl-table-head">
								<th width="5%"></th>
								<th width="20%">DIRECTORATE CODE</th>
								<th width="20%">DIRECTORATE NAME</th>
								<th width="20%">DIRECTORATE TYPE</th>
								<th width="20%">Active</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>	
							@foreach($list_directorate as $items)
							<tr>
								<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/i1.png') }}" width="45" alt=""></td>
								<td>{{ $items->DIRECTORATE_CODE }}</td>
								<td>{{ $items->DIRECTORATE_NAME }}</td>
								<td>
									@if($items->IS_CABANG == '0')
									<span style="color:black">PUSAT</span>
									@else
									<span style="color:blue">CABANG</span>
									@endif
								</td>
								<td>
									@if($items->ACTIVE == 'Y')
									<span style="color:green">AKTIF</span>
									@else
									<span style="color:red">INAKTIF</span>
									@endif
								</td>
								<td>
									<button class="uk-button uk-button-default fl-button" type="button">Action</button>
									<div uk-dropdown="mode:click">
										<ul class="uk-nav uk-dropdown-nav">
											<li><a href="/master/form_edit_directorate/{{$items->DIRECTORATE_ID}}">Edit</a></li>
											<li><a href="/master/form_status_directorate/{{$items->DIRECTORATE_ID}}">Status</a></li>
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
			</div>

			</body>
			</html>

			<script>
				$(document).ready( function () {
					$('#directoratlist').DataTable();
				} );
				function showModal(){
					UIkit.modal("#mymodal").show();
				}
			</script>