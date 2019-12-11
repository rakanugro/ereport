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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
<link href="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic2/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />

<script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>

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
					Master Indicator	
				</span>
				<span style="float:right;margin-top:15px">
					<!-- <a href="sub_indicator_list"><button class="uk-button uk-button-default fl-button" type="button">Sub Indicator</button></a> -->
				<!-- 	<button class="uk-button uk-button-primary fl-button" type="button">Sorting</button>
					<div uk-dropdown="mode: click">
						<ul class="uk-nav uk-dropdown-nav">
							<li><a href="#">Divisi</a></li>
							<li><a href="#">Nama</a></li>
							<li><a href="#">Nilai</a></li>
						</ul>
					</div> -->
					<!-- <button class="uk-button uk-button-default fl-button" type="button" onclick="showModal()">Filter</button> -->
					@if(Auth::user()->ACCESS == 'ADMIN SUB DIVISI' || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
					<a href="form_indicator"><button class="uk-button uk-button-primary fl-button" type="button">+</button></a>
					@endif
				</span>
			</div>
			
			<div class="fl-table">
				<div class="uk-overflow-auto">
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id="master_indicator_list">
						<thead>
							<tr class="fl-table-head">
								<th width="10%">Directorate</th>
								<th width="10%">Branch Office</th>
								<th width="10%">Divisi</th>
								<th width="10%">Sub Divisi</th>
								<th width="20%">Indicator Name</th>
								<th width="5%">Inputable</th>
								<th width="10%">Sub Divisi Pengisi</th>
								<th width="5%">Active</th>
								<th width="10%">Status</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($indicator_list as $data)
								<tr>
									<td>{{ $data->DIRECTORATE_NAME }}</td>
									<td>{{ $data->BRANCH_OFFICE_NAME }}</td>
									<td>{{ $data->DIVISION_NAME }}</td>
									<td>{{ $data->SUB_DIVISION_NAME }}</td>
									<td>{{ $data->INDICATOR_NAME }}</td>
									<td>
										@if($data->INPUTABLE == 'Y')
									 		<span style="color:green">Ya</span>
									 	@else
									 		<span style="color:red">Tidak</span>
									 	@endif
									 </td>
									<td>{{ $data->SUB_DIVISION_NAME_PENGISI }}</td>
									<td>@if($data->ACTIVE == 'Y')
									 		<span style="color:green">Active</span>
									 	@else
									 		<span style="color:red">Inactive</span>
									 	@endif
									 </td>
									<td>@if($data->STATUS == '1')
									 		<span style="color:red">Menunggu Approval DVP</span>
									 	@elseif($data->STATUS == '2')
									 		<span style="color:blue">Menunggu Approval VP</span>
									 	@elseif($data->STATUS == '3')
									 		<span style="color:green">Approved</span>
									 	@elseif($data->STATUS == '4')
									 		<span style="color:red">Dikembalikan {{$data->ALASAN_KEMBALIKAN}}</span>
									 	@endif
									 </td>
									<td>
										<button class="uk-button uk-button-default fl-button" type="button">Action</button>
										<div uk-dropdown="mode:click">
											<!-- <ul class="uk-nav uk-dropdown-nav">
												<li><a href="edit/form_indicator/{{ $data->INDICATOR_ID }}">Edit</a></li>
												@if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
													<li><a href="indicator_active/{{ $data->INDICATOR_ID }}">Active</a></li>
													<li><a href="indicator_inactive/{{ $data->INDICATOR_ID }}">Inactive</a></li>
												@endif
												@if((Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '2') || (Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '1'))
													<li><a href="indicator_approve/{{ $data->INDICATOR_ID }}">Approve</a></li>
													<li><a href="indicator_kembalikan/{{ $data->INDICATOR_ID }}">Kembalikan</a></li>
												@endif
											</ul> -->
											<ul class="uk-nav uk-dropdown-nav">
												@if((Auth::user()->ACCESS == 'DVP SUB DIVISI' && $data->STATUS == '1') || (Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '1'))
													<li><a href="javascript:;" onclick="Approval({{ $data->INDICATOR_ID }})">Approve</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->INDICATOR_ID }})">Kembalikan</a></li>
												@elseif((Auth::user()->ACCESS == 'VP SUB DIVISI' && $data->STATUS == '2' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '2'))
													<li><a href="javascript:;" onclick="Approval({{ $data->INDICATOR_ID }})">Approve</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->INDICATOR_ID }})">Kembalikan</a></li>
												@elseif((Auth::user()->ACCESS == 'ADMIN SUB DIVISI'  && $data->STATUS == '3' || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '3'))
													<li><a href="edit_status/form_indicator/{{ $data->INDICATOR_ID }}">Status</a></li>
												@elseif((Auth::user()->ACCESS == 'ADMIN SUB DIVISI'  && $data->STATUS == '4' || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '3'))
												<li><a href="edit/form_indicator/{{ $data->INDICATOR_ID }}">Edit</a></li>
												@endif
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


	<div id="Approvalmodal">
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/master/indicator_approve" id="approvalForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Approval</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<input type="hidden"  id="id1" name="id1">
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary" id="Formsubmitapproval">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>

	<!-- Kembalikan VP -->
	<div id="kembalikanmodal">
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/master/indicator_kembalikan" id="kembalikanForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Kembalikan</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<input type="hidden"  id="id2" name="id2">
					<div class="col-lg-12">
						<label class="">
							Alasan:
						</label>
						<textarea class="form-control m-input" name="alasan" id="alasan" maxlength="40" required></textarea>
					</div>
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary" id="Formsubmitkembalikan">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>
</body>
</html>
<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

<script>
	$(document).ready( function () {
		$('#master_indicator_list').DataTable();
	} );

	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function Approval(id){
		var id = id;
		$('#id1').val(id);

        UIkit.modal("#Approvalmodal").show();

	}

	function Kembalikan(id){
		var id = id;
		$('#id2').val(id);

		UIkit.modal("#kembalikanmodal").show();

	}
</script>
