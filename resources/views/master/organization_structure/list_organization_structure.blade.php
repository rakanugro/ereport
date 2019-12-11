<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
					List Organization Structure
				</span>
				<span style="float:right;margin-top:15px">
					<!-- <button class="uk-button uk-button-default fl-button" type="button">List</button>
					<div uk-dropdown="mode: click">
						<ul class="uk-nav uk-dropdown-nav">
							<li><a href="{{url('master/list_directorate')}}">List Directorate</a></li>
							<li><a href="{{url('master/list_branch_office')}}">List Branch Office</a></li>
							<li><a href="{{url('master/list_divisi')}}">List Divisi</a></li>
							<li><a href="{{url('master/list_sub_divisi')}}">List Sub Divisi</a></li>
						</ul>
					</div> -->
					@if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
					<a href="form_organization_structurex"><button class="uk-button uk-button-primary fl-button" type="button">+ tes ke tree</button></a>
					<a href="form_organization_structure"><button class="uk-button uk-button-primary fl-button" type="button">+</button></a>
					@endif
				</span>
			</div>
			<div class="fl-table">
				<div class="uk-overflow-auto">
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id="organisasilist">
						<thead>
							<tr class="fl-table-head">
							<th width="5%"></th>
							<th width="20%">Directorate</th>
							<th width="20%">Branch Office</th>
							<th width="15%">Divisi</th>
							<th width="15%">Sub DIvisi</th>
							<th width="5%">Active</th>
							<th width="10%">Status</th>
							<th width="15%">Action</th>
						</tr>
						</thead>
						<tbody>	
							@foreach($organization_structure_list as $items)
							<tr>
								<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/i1.png') }}" width="45" alt=""></td>
								<td>{{ $items->DIRECTORATE_NAME }}</td>
								<td>{{ $items->BRANCH_OFFICE_NAME }}</td>
								<td>{{ $items->DIVISION_NAME }}</td>
								<td>{{ $items->SUB_DIVISION_NAME }}</td>
								<td>
									@if($items->ACTIVE == 'Y')
									<span style="color:green">AKTIF</span>
									@else
									<span style="color:red">INAKTIF</span>
									@endif
								</td>
								<td>
									@if($items->APPROVED_1_STATUS == '0' && $items->APPROVED_2_STATUS == '0')
									<span style="color:red">Menenunggu Approval DVP</span>
									@elseif($items->APPROVED_1_STATUS == '1' && $items->APPROVED_2_STATUS == '0')
									<span style="color:red">Menenunggu Approval VP</span>
									@elseif($items->APPROVED_1_STATUS == '2' && $items->APPROVED_2_STATUS == '2')
									<span style="color:red">Dikembalikan DVP/VP ({{$items->ALASAN_KEMBALIKAN}})</span>
									@else
									<span style="color:green">Approved</span>
									@endif
								</td>
								<td>
								<button class="uk-button uk-button-default fl-button" type="button">Action</button>
								<div uk-dropdown="mode:click">
									<ul class="uk-nav uk-dropdown-nav">
										@if(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
											@if($items->APPROVED_1_STATUS == '0' && $items->APPROVED_2_STATUS == '0')
												<li><a href="/master/preview_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Detail</a></li>
											@elseif($items->APPROVED_1_STATUS == '1' && $items->APPROVED_2_STATUS == '0')
												<li><a href="javascript:;" onclick="Approvalvp({{$items->ORGANIZATION_STRUCTURE_ID}})">Approval</a></li>
												<li><a href="javascript:;" onclick="Kembalikan({{$items->ORGANIZATION_STRUCTURE_ID}})">Kembalikan</a></li>
												<li><a href="/master/preview_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Detail</a></li>
											@else
												<li><a href="/master/status_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Status</a></li>
												<li><a href="/master/preview_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Detail</a></li>
											@endif
										@elseif(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
											@if($items->APPROVED_1_STATUS == '0' && $items->APPROVED_2_STATUS == '0')
												<li><a href="javascript:;" onclick="Approvaldvp({{$items->ORGANIZATION_STRUCTURE_ID}})">Approval</a></li>
												<li><a href="javascript:;" onclick="Kembalikan({{$items->ORGANIZATION_STRUCTURE_ID}})">Kembalikan</a></li>
												<li><a href="/master/preview_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Detail</a></li>
											@elseif($items->APPROVED_1_STATUS == '1' && $items->APPROVED_2_STATUS == '0')
												<li><a href="/master/preview_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Detail</a></li>
											@else
												<li><a href="/master/status_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Status</a></li>
												<li><a href="/master/preview_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Detail</a></li>
											@endif
										@elseif(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
											@if($items->APPROVED_1_STATUS == '0' && $items->APPROVED_2_STATUS == '0')
											<li><a href="/master/edit_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Edit</a></li>
											<li><a href="/master/preview_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Detail</a></li>
											@elseif($items->APPROVED_1_STATUS == '1' && $items->APPROVED_2_STATUS == '0')
											<li><a href="/master/preview_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Detail</a></li>
											@elseif($items->APPROVED_1_STATUS == '2' && $items->APPROVED_2_STATUS == '2')
											<li><a href="/master/preview_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Detail</a></li>
											<li><a href="/master/edit_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Edit</a>
											@else
											<li><a href="/master/status_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Status</a></li>
											</li>
											<li><a href="/master/preview_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Detail</a></li>
											@endif
										@else
											<li><a href="/master/preview_organisasi_strukture/{{$items->ORGANIZATION_STRUCTURE_ID}}">Detail</a></li>
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

			<div id="Approvaldvpmodal" uk-modal >
				<div class="uk-modal-dialog uk-modal-body modal-sm">
					<form action="/master/approvaldvporganisasistrukture" id="approvaldvpForm" method="post">
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
									Directorate:
								</label>
								<input type="text"  class="form-control m-input" name="directorat" id="directorat" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">
									Branch Office:
								</label>
								<input type="text"  class="form-control m-input" name="branchoffice" id="branchoffice" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">
									 Division:
								</label>
								<input type="text"  class="form-control m-input" name="divisi" id="divisi" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">
									Sub Division:
								</label>
								<input type="text"  class="form-control m-input" name="sub_divisi" id="sub_divisi" disabled>
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
					<form action="/master/approvalvporganisasistrukture" id="approvalvpForm" method="post">
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
									Directorate:
								</label>
								<input type="text"  class="form-control m-input" name="directorat1" id="directorat1" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">
									Branch Office:
								</label>
								<input type="text"  class="form-control m-input" name="branchoffice1" id="branchoffice1" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">
									 Division:
								</label>
								<input type="text"  class="form-control m-input" name="divisi1" id="divisi1" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">
									Sub Division:
								</label>
								<input type="text"  class="form-control m-input" name="sub_divisi1" id="sub_divisi1" disabled>
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
					<form action="/master/kembalikanorganisasistrukture" id="kembalikanForm" method="post">
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
									Directorate:
								</label>
								<input type="text"  class="form-control m-input" name="directorat2" id="directorat2" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">
									Branch Office:
								</label>
								<input type="text"  class="form-control m-input" name="branchoffice2" id="branchoffice2" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">
									 Division:
								</label>
								<input type="text"  class="form-control m-input" name="divisi2" id="divisi2" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">
									Sub Division:
								</label>
								<input type="text"  class="form-control m-input" name="sub_divisi2" id="sub_divisi2" disabled>
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

			<script type="text/javascript">
				$(document).ready( function () {
					$('#organisasilist').DataTable();
				} );
				
				function Approvaldvp(id){
					var id = id;
					var url = '{{url('master/getorganisasistrukture')}}';

					$.get(url + '/' + id, function (data) {
						console.log(data);
						$('#id').val(data.ORGANIZATION_STRUCTURE_ID);
						$('#directorat').val(data.DIRECTORATE_NAME);
						$('#branchoffice').val(data.BRANCH_OFFICE_NAME);
						$('#divisi').val(data.DIVISION_NAME);
						$('#sub_divisi').val(data.SUB_DIVISION_NAME);

						UIkit.modal("#Approvaldvpmodal").show();
					}) 

				}

				function Approvalvp(id){
					var id = id;
					var url = '{{url('/master/getorganisasistrukture')}}';

					$.get(url + '/' + id, function (data) {
						console.log(data);
						$('#id1').val(data.ORGANIZATION_STRUCTURE_ID);
						$('#directorat1').val(data.DIRECTORATE_NAME);
						$('#branchoffice1').val(data.BRANCH_OFFICE_NAME);
						$('#divisi1').val(data.DIVISION_NAME);
						$('#sub_divisi1').val(data.SUB_DIVISION_NAME);

						UIkit.modal("#Approvalvpmodal").show();
					}) 

				}

				function Kembalikan(id){
					var id = id;
					var url = '{{url('/master/getorganisasistrukture')}}';

					$.get(url + '/' + id, function (data) {
						console.log(data);
						$('#id2').val(data.ORGANIZATION_STRUCTURE_ID);
						$('#directorat2').val(data.DIRECTORATE_NAME);
						$('#branchoffice2').val(data.BRANCH_OFFICE_NAME);
						$('#divisi2').val(data.DIVISION_NAME);
						$('#sub_divisi2').val(data.SUB_DIVISION_NAME);
						UIkit.modal("#kembalikanmodal").show();
					}) 

				}
			</script>