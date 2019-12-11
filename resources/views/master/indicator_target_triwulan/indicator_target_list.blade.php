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
	#form1{
		display:none;

	}
	body{
		background-color: #283a5a;
	}
</style>



<body>

	<div class="fl-main-container">
		<!---Header---------->
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
					Master Indicator Target	Triwulanan
				</span>
				<span style="float:right;margin-top:15px">
					<a href="/kpi"><button class="uk-button uk-button-default fl-button" type="button">Master KPI</button></a>
					<!-- <button class="uk-button uk-button-default fl-button" type="button">List</button>
					<div uk-dropdown="mode: click">
						<ul class="uk-nav uk-dropdown-nav">
							<li><a href="{{url('master/indicator_target_list')}}">Target Bulanan</a></li>
						</ul>
					</div> -->
				<!-- 	<button class="uk-button uk-button-default fl-button" type="button">Sorting</button>
					<div uk-dropdown="mode: click">
						<ul class="uk-nav uk-dropdown-nav">
							<li><a href="#">Divisi</a></li>
							<li><a href="#">Nama</a></li>
							<li><a href="#">Nilai</a></li>
						</ul>
					</div>
					<button class="uk-button uk-button-default fl-button" type="button" onclick="showModal()">Filter</button> -->
					@if(Auth::user()->ACCESS == 'ADMIN SUB DIVISI' || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
					<button class="uk-button uk-button-primary fl-button" type="button" id="formButton">+ Show / - Hide</button>
					@endif
				</span>
				<div class="fl-table col-md-12" id="form1">
					<form id="form_perencanaan" action="/master/indicator_target_triwulan_save" method="POST">
				{{ csrf_field() }}
					<div class="col-lg-7"> 
						<b>Indicator Name</b>
						<input type="hidden" name="indicatorlisthidden" id="indicatorlisthidden" value="{{ $indicator }}" disabled="disabled"><br>
                        <select style="width: 85% !important;" id="indicator_id" class="form-control select2-list" name="indicator_id[]" data-validation="required" data-validation-error-msg="Silahkan Pilih Indicator">
                            <option value="">--Indicator--</option>
                            @foreach($indicator_list as $indicators)
                                <option value="{{ $indicators->INDICATOR_ID }}">{{ $indicators->SUB_DIVISION_NAME }} - {{ $indicators->INDICATOR_NAME }} - {{ $indicators->UNIT }}</option>
                            @endforeach
                        </select>
					</div>
					<div><br></div>
					<div class="col-lg-7"> 
						<b>Indicator Year</b>
						<input type="hidden" name="indicatorlisthidden" id="indicatorlisthidden" value="{{ $year }}" disabled="disabled"><br>
						<select id="indicator_year" class="form-control select2-list" style="width: 85% !important;" name="indicator_year" required="required">
							<option value="">--Pilih Tahun--</option>
							@foreach($years as $year)
							<option value="{{ $year }}">{{ $year }}</option>
							@endforeach
						</select>
					</div>
					<div>
						<br>
					</div>
					<table border="0" width="100%">
						<tr>
							<td width="50%" valign="top">
								<table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
									<thead>
										<tr class="fl-table-head">
											<th width="">Triwulan</th>
											<th width="">Target</th>
											<th width="">Bobot</th>
										</tr>
									</thead>
									<tbody>
											<tr>
												<td style="width: 20% !important;">Triwulan 1</td>
												<td style="width: 20% !important;"><input name="target_triwulan1" id="target_triwulan1" class="uk-input uk-child-width-1-2" type="number" step="any" onkeyup="myFunction()" placeholder="Target" required></td>
												<td style="width: 20% !important;"><input name="bobot_triwulan1" id="bobot_triwulan1" class="uk-input uk-child-width-1-2" type="number" step="any" onkeyup="myFunctionBobot()" placeholder="Bobot" required></td>
											</tr>
											<tr>
												<td style="width: 20% !important;">Triwulan 2</td>
												<td style="width: 20% !important;"><input name="target_triwulan2" id="target_triwulan2" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<td style="width: 20% !important;"><input name="bobot_triwulan2" id="bobot_triwulan2" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Bobot" required></td>
											</tr>
											<tr>
												<td style="width: 20% !important;">Triwulan 3</td>
												<td style="width: 20% !important;"><input name="target_triwulan3" id="target_triwulan3" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<td style="width: 20% !important;"><input name="bobot_triwulan3" id="bobot_triwulan3" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Bobot" required></td>
											</tr>
											<tr>
												<td style="width: 20% !important;">Triwulan 4</td>
												<td style="width: 20% !important;"><input name="target_triwulan4" id="target_triwulan4" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<td style="width: 20% !important;"><input name="bobot_triwulan4" id="bobot_triwulan4" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Bobot" required></td>
											</tr>
											
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<button class="uk-button uk-button-primary fl-button" onclick="save_indicator_triwulan_target(this.form.id);return false;">
									<i class="fa fa-plus"></i>&nbsp;Save
								</button>
							</td>
						</tr>
					</table>
					<div>
						<br>
					</div>
					<div>
					</div>
					
				</form>
				</div>
			</div>
			
			<div class="fl-table">
				<div class="uk-overflow-auto">
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id="indicator_target_list2">
						<thead>
							<tr class="fl-table-head">
								<th width="5%"></th>
								<th width="20%">Sub Divisi Name</th>
								<th width="20%">Indicator Name</th>
								<th width="20%">Indicator Year</th>
								<th width="20%">Unit</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($indicator_target_list as $data)
								<tr>
									<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/i1.png') }}" width="45" alt=""></td>
									<td>{{ $data->SUB_DIVISION_NAME }}</td>
									<td>{{ $data->INDICATOR_NAME }}</td>
									<td>{{ $data->YEAR }}</td>
									<td>{{ $data->UNIT }}</td>
									
									<td>
										<button class="uk-button uk-button-default fl-button" type="button">Action</button>
										<div uk-dropdown="mode:click">
											<ul class="uk-nav uk-dropdown-nav">
												<li><a href="edit/form_indicator_triwulan_target/{{ $data->TARGET_TRIWULAN_ID }}">Edit</a></li>
												<!-- <li><a href="indicator_target_triwulan_delete/{{ $data->TARGET_TRIWULAN_ID }}">Delete</a></li> -->
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
						<b>Indikator</b>
						<input class="uk-input" type="text" placeholder="Indikator">
					</div>

					<div>
						<b>Nilai</b>
						<input class="uk-input" type="text" placeholder="Masukan Nilai">
						<div style="padding-top:10px" align="right">
							<button class="uk-button uk-button-primary fl-button" type="button">Search</button>			
						</div>			
					</div>
				</div>
			</div>
	</div>
</body>
</html>
<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script>
	
	$(document).ready( function () {
		$('#indicator_target_list2').DataTable();

		$("#formButton").click(function() {
			$("#form1").toggle();
		});
	} );

	$(".select2-list").select2({
		allowClear: true
	});

	function myFunction() {
		var target = document.getElementById('target_triwulan1');
		console.log(target.value);
		document.getElementById('target_triwulan2').value = target.value;
		document.getElementById('target_triwulan3').value = target.value;
		document.getElementById('target_triwulan4').value = target.value;
	}

	function myFunctionBobot() {
		var target = document.getElementById('bobot_triwulan1');
		console.log(target.value);
		document.getElementById('bobot_triwulan2').value = target.value;
		document.getElementById('bobot_triwulan3').value = target.value;
		document.getElementById('bobot_triwulan4').value = target.value;
	}

	function save_indicator_triwulan_target(formid)
    {   
		submit_form(formid);
    }


	function showModal(){
		UIkit.modal("#mymodal").show();
	}
</script>
