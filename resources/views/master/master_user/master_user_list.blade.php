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
	<link href="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('metronic2/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />

	<script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
	<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>

	<link rel="stylesheet" href="{{ URL::asset('templateslide/assets/js/datatableptkak/css/jquery.dataTables.min.css') }}" type="text/css">
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
					Master User
				</span>

				<span style="float:right;margin-top:15px">
				<!-- <button class="uk-button uk-button-default fl-button" type="button">Sorting</button>
				<div uk-dropdown="mode: click">
					<ul class="uk-nav uk-dropdown-nav">
						<li><a href="#">Divisi</a></li>
						<li><a href="#">Nama</a></li>
						<li><a href="#">Nilai</a></li>
					</ul>
				</div>
				<button class="uk-button uk-button-default fl-button" type="button" onclick="showModal()">Filter</button> -->
				@if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
				<a href="form_master_user"><button class="uk-button uk-button-primary fl-button" type="button">+</button></a>
				@endif
			</span>
		</div>


		<div class="fl-table">
			<div class="uk-overflow-auto">
				<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id='table_user'>
					<thead>
						<tr class="fl-table-head">
							<th width="5%"></th>
							<th>Directorate</th>
							<th>Divisi</th>
							<th>Sub Divisi</th>
							<th>Branch Office</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Active</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						@foreach($master_user_list as $data)
						<!-- @if($data->STATUS == 'AKTIF')
						<tr style="background-color: #88ff4d;">
						@else
						<tr style="background-color: #eeffe6;">
							@endif -->
							<tr>
								<th width="5%"></th>
								<td>{{ $data->DIRECTORATE_NAME }}</td>
								<td>{{ $data->DIVISION_NAME }}</td>
								<td>{{ $data->SUB_DIVISION_NAME }}</td>
								<td>{{ $data->BRANCH_OFFICE_NAME }}</td>
								<td>{{ $data->NAMA }}</td>
								<td>{{ $data->NIPP }}</td>
								<td>
									@if($data->STATUS == 'AKTIF')
									<span style="color:green">AKTIF</span>
									@else
									<span style="color:red">INAKTIF</span>
									@endif
								</td>
								<td>
									@if($data->APPROVED_1_STATUS == '0' && $data->APPROVED_2_STATUS == '0')
									<span style="color:red">Menunggu Approval DVP</span>
									@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '0')
									<span style="color:blue">Menunggu Approval VP</span>
									@elseif($data->APPROVED_1_STATUS == '2' && $data->APPROVED_2_STATUS == '2')
									<span style="color:red">Dikembalikan DVP/VP ({{$data->ALASAN_KEMBALIKAN}})</span>
									@else
									<span style="color:green">Approved</span>
									@endif
								</td>
								<td>
									<button class="uk-button uk-button-default fl-button" type="button">Action</button>
									<div uk-dropdown="mode:click">
										<ul class="uk-nav uk-dropdown-nav">
											@if(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
											@if($data->APPROVED_1_STATUS == '0' && $data->APPROVED_2_STATUS == '0')
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '0')
											<li><a href="javascript:;" onclick="Approvalvp({{$data->ID}})">Approval</a></li>
											<li><a href="javascript:;" onclick="Kembalikan({{$data->ID}})">Kembalikan</a></li>
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '1')
											<li><a href="/master/status/{{$data->ID}}">Status</a></li>
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@else
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@endif
											@elseif(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
											@if($data->APPROVED_1_STATUS == '0' && $data->APPROVED_2_STATUS == '0')
											<li><a href="javascript:;" onclick="Approvaldvp({{$data->ID}})">Approval</a></li>
											<li><a href="javascript:;" onclick="Kembalikan({{$data->ID}})">Kembalikan</a></li>
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '0')
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '1')
											<li><a href="/master/status/{{$data->ID}}">Status</a></li>
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@else
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@endif
											@elseif(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
											@if($data->APPROVED_1_STATUS == '0' && $data->APPROVED_2_STATUS == '0')
											<li><a href="/master/edit/{{$data->ID}}">Edit</a></li>
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '0')
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@elseif($data->APPROVED_1_STATUS == '2' && $data->APPROVED_2_STATUS == '2')
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											<li><a href="/master/edit/{{$data->ID}}">Edit</a></li>
											@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '1')
											<li><a href="/master/status/{{$data->ID}}">Status</a></li>
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@else
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
											@endif
											@else
											<li><a href="/master/preview/{{$data->ID}}">Detail</a></li>
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

	<!-- This is the modal -->
	<!-- Aproval dvp -->
	<div id="Approvaldvpmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/master/approvaldvpmaster" id="approvaldvpForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Approval</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					
					<input type="hidden" id="id" name="id">
					<div class="col-lg-6">
						<label class="">
							Username:
						</label>
						<input type="text"  class="form-control m-input" name="nipp" id="nipp" disabled>
					</div>
					<div class="col-lg-6">
						<label class="">
							Nama:
						</label>
						<input type="text"  class="form-control m-input" name="nama" id="nama" disabled>
					</div>
					<div class="col-lg-6">
						<label class="">
							Access:
						</label>
						<input type="text"  class="form-control m-input" name="access" id="access" disabled>
					</div>
					<div class="col-lg-6">
						<label class="">
							Organization Structure:
						</label>
						<input type="text"  class="form-control m-input" name="organization" id="organization" disabled>
					</div>
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary" id="Formsubmitapprovaldvp">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>

	<!-- Aproval VP -->
	<div id="Approvalvpmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/master/approvalvpmaster" id="approvalvpForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Approval</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">

					<input type="hidden"  id="id1" name="id1">
					<div class="col-lg-6">
						<label class="">
							Username:
						</label>
						<input type="text"  class="form-control m-input" name="nipp1" id="nipp1" disabled>
					</div>
					<div class="col-lg-6">
						<label class="">
							Nama:
						</label>
						<input type="text"  class="form-control m-input" name="nama1" id="nama1" disabled>
					</div>
					<div class="col-lg-6">
						<label class="">
							Access:
						</label>
						<input type="text"  class="form-control m-input" name="access1" id="access1" disabled>
					</div>
					<div class="col-lg-6">
						<label class="">
							Organization Structure:
						</label>
						<input type="text"  class="form-control m-input" name="organization1" id="organization1" disabled>
					</div>
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary" id="Formsubmitapprovalvp">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>

	<!-- Kembalikan VP -->
	<div id="kembalikanmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/master/kembalikanmaster" id="kembalikanForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Kembalikan</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">

					<input type="hidden"  id="id2" name="id2">
					<div class="col-lg-6">
						<label class="">
							Username:
						</label>
						<input type="text"  class="form-control m-input" name="nipp2" id="nipp2" disabled>
					</div>
					<div class="col-lg-6">
						<label class="">
							Nama:
						</label>
						<input type="text"  class="form-control m-input" name="nama2" id="nama2" disabled>
					</div>
					<div class="col-lg-6">
						<label class="">
							Access:
						</label>
						<input type="text"  class="form-control m-input" name="access3" id="access3" disabled>
					</div>
					<div class="col-lg-6">
						<label class="">
							Organization Structure:
						</label>
						<input type="text"  class="form-control m-input" name="organization3" id="organization3" disabled>
					</div>
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
<script>
	$(document).ready( function () {
		$('#table_user').DataTable();
	} );
	
	function Approvaldvp(id){
		var id = id;
		var url = '{{url('master/getmasteruser')}}';
		
		$.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#id').val(data.ID);
            $('#nipp').val(data.NIPP);
            $('#nama').val(data.NAMA);
            $('#access').val(data.ACCESS);
            $('#organization').val(data.SUB_DIVISION_NAME);

            UIkit.modal("#Approvaldvpmodal").show();
        }) 

	}

	function Approvalvp(id){
		var id = id;
		var url = '{{url('/master/getmasteruser')}}';

		$.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#id1').val(data.ID);
            $('#nipp1').val(data.NIPP);
            $('#nama1').val(data.NAMA);
            $('#access1').val(data.ACCESS);
            $('#organization1').val(data.SUB_DIVISION_NAME);

            UIkit.modal("#Approvalvpmodal").show();
        }) 

	}

	function Kembalikan(id){
		var id = id;
		var url = '{{url('/master/getmasteruser')}}';

		$.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#id2').val(data.ID);
            $('#nipp2').val(data.NIPP);
            $('#nama2').val(data.NAMA);
            $('#access2').val(data.ACCESS);
            $('#organization2').val(data.SUB_DIVISION_NAME);

            UIkit.modal("#kembalikanmodal").show();
        }) 

	}
</script>
