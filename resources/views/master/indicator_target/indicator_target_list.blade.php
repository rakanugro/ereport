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
					Master Indicator Target	Bulanan
				</span>
				<span style="float:right;margin-top:15px">
					<a href="/sarmut"><button class="uk-button uk-button-default fl-button" type="button">Master Sasaran Mutu</button></a>
					<!-- <button class="uk-button uk-button-default fl-button" type="button">List</button>
					<div uk-dropdown="mode: click">
						<ul class="uk-nav uk-dropdown-nav">
							<li><a href="{{url('master/indicator_target_triwulan_list')}}">Target Triwulan</a></li>
						</ul>
					</div> -->
					<!-- <button class="uk-button uk-button-default fl-button" type="button">Sorting</button>
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
					<form id="form_perencanaan" action="/master/indicator_target_save" method="POST">
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
							<td width="50%">
								<table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
									<thead>
										<tr class="fl-table-head">
											<th width="">Month</th>
											<th width="">Target</th>
										</tr>
									</thead>
									<tbody>
											<tr>
												<td style="width: 20% !important;">Januari</td>
												<td><input style="width: 36% !important;" name="target_januari" id="target_januari" class="uk-input uk-child-width-1-2" type="number" step="any" onkeyup="myFunction()" placeholder="Target" required></td>
												<!-- <td><input name="bobot_januari" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td style="width: 20% !important;">Februari</td>
												<td><input style="width: 36% !important;" name="target_februari" id="target_februari" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<!-- <td><input name="bobot_februari" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td style="width: 20% !important;">Maret</td>
												<td><input style="width: 36% !important;" name="target_maret" id="target_maret" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<!-- <td><input name="bobot_maret" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td style="width: 20% !important;">April</td>
												<td><input style="width: 36% !important;" name="target_april" id="target_april" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<!-- <td><input name="bobot_april" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td style="width: 20% !important;">Mei</td>
												<td><input style="width: 36% !important;" name="target_mei" id="target_mei" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<!-- <td><input name="bobot_mei" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td style="width: 20% !important;">Juni</td>
												<td><input style="width: 36% !important;" name="target_juni" id="target_juni" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<!-- <td><input name="bobot_juni" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td style="width: 20% !important;">Juli</td>
												<td><input style="width: 36% !important;" name="target_juli" id="target_juli" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<!-- <td><input name="bobot_juli" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td style="width: 20% !important;">Agustus</td>
												<td><input style="width: 36% !important;" name="target_agustus" id="target_agustus" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<!-- <td><input name="bobot_agustus" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td style="width: 20% !important;">September</td>
												<td><input style="width: 36% !important;" name="target_september" id="target_september" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<!-- <td><input name="bobot_september" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td style="width: 20% !important;">Oktober</td>
												<td><input style="width: 36% !important;" name="target_oktober" id="target_oktober" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<!-- <td><input name="bobot_oktober" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td style="width: 20% !important;">November</td>
												<td><input style="width: 36% !important;" name="target_november" id="target_november" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<!-- <td><input name="bobot_november" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td style="width: 20% !important;">Desember</td>
												<td><input style="width: 36% !important;" name="target_desember" id="target_desember" class="uk-input uk-child-width-1-2" type="number" step="any" placeholder="Target" required></td>
												<!-- <td><input name="bobot_desember" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td> -->
											</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<button class="uk-button uk-button-primary fl-button" onclick="save_indicator_target(this.form.id);return false;">
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
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id="indicator_target_list1">
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
												<li><a href="edit/form_indicator_target/{{ $data->TARGET_MONTH_ID }}">Edit</a></li>
												<!-- <li><a href="indicator_target_delete/{{ $data->TARGET_MONTH_ID }}">Delete</a></li> -->
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
		$('#indicator_target_list1').DataTable();

		$("#formButton").click(function() {
			$("#form1").toggle();
		});
	} );

	$(".select2-list").select2({
		allowClear: true
	});

	function myFunction() {
		var target = document.getElementById('target_januari');
		// alert(target);
		console.log(target.value);
		document.getElementById('target_februari').value = target.value;
		document.getElementById('target_maret').value = target.value;
		document.getElementById('target_april').value = target.value;
		document.getElementById('target_mei').value = target.value;
		document.getElementById('target_juni').value = target.value;
		document.getElementById('target_juli').value = target.value;
		document.getElementById('target_agustus').value = target.value;
		document.getElementById('target_september').value = target.value;
		document.getElementById('target_oktober').value = target.value;
		document.getElementById('target_november').value = target.value;
		document.getElementById('target_desember').value = target.value;
	}

	$("#target_januari").keyup(function() {
		var target = document.getElementById('target_januari');
		document.getElementById('target_februari').value = target.value;
		document.getElementById('target_maret').value = target.value;
		document.getElementById('target_april').value = target.value;
		document.getElementById('target_mei').value = target.value;
		document.getElementById('target_juni').value = target.value;
		document.getElementById('target_juli').value = target.value;
		document.getElementById('target_agustus').value = target.value;
		document.getElementById('target_september').value = target.value;
		document.getElementById('target_oktober').value = target.value;
		document.getElementById('target_november').value = target.value;
		document.getElementById('target_desember').value = target.value;
		//alert('sfs');

	});

	function save_indicator_target(formid)
    {   
		submit_form(formid);
    }

	function showModal(){
		UIkit.modal("#mymodal").show();
	}
</script>
