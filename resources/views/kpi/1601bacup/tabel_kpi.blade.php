<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PT. Pelabuhan Tanjung Priuk</title>

<link href="templateslide/assets/css/style.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/css/imagehover/imagehover.min.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/uikit/css/uikit.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/datepicker/daterangepicker.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/datepicker/daterangepicker.css" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic2/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />


<script src="templateslide/assets/js/jquery-1.11.1.min.js"></script>
<script src="templateslide/assets/uikit/js/uikit.js"></script>

<script src="templateslide/assets/datepicker/moment.min.js"></script>
<script src="templateslide/assets/datepicker/daterangepicker.js"></script>

<script src="templateslide/assets/js/marquee/jquery.marquee.js"></script>
<script src="templateslide/assets/js/marquee/jquery.pause.js"></script>
<script src="templateslide/assets/js/marquee/jquery.easing.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<link  href="{{ URL::asset('templateslide/assets/js/datatableptkak/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css">
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
		<!---Header----------->
		<div class="fl-header fl-header-margin" uk-sticky>
			<div>
				<img src="templateslide/assets/img/logo/ptpwhite.png" class="fl-logo" onclick="location.href = '{{ url('dashboard')}}'">
				
				<span class="fl-title-logo">
					E-Reporting PT. Pelabuhan Tanjung Priuk	
				</span>

				<span class="fl-menu-tool">
					<input type="button" class="uk-button uk-button-primary fl-button" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
				</span>
			</div>	
		</div>


		<div class="fl-container">
			<div class="fl-title-page" >
				<span style="font-size:20px">				
					<img class="uk-preserve-width uk-border-circle" src="templateslide/assets/img/icon/sopReadMore.png" width="65" alt="">
					Master KPI	
				</span>
				<span style="float:right;margin-top:15px">
					<a href="/master/indicator_target_triwulan_list"><button class="uk-button uk-button-default fl-button" type="button">Target Indikator Triwulan</button></a>
					@if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
					<button class="uk-button uk-button-primary fl-button" type="button" id="formButton">+ Show / - Hide</button>
					@endif
				</span>
				<div class="fl-table col-md-12" id="form1">
					<form id="form_mst_kpi" action="/kpi/master_indikator_kpi_save" method="POST">
						{{ csrf_field() }}
						<br>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<h4>
									ADD Master Indikator KPI
								</h4>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-4">
								<label>
									Directorate:
								</label>
								<br>
								<select style="width: 70% !important;" class="form-control select2-list" id="directorat_list" name="directorat_list" required="required">
									<option value="">--Directorate--</option>
									@foreach($directorat_list as $org)
									<option value="{{ $org->DIRECTORATE_ID }}-{{ $org->IS_CABANG }}">{{ $org->DIRECTORATE_NAME }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-lg-4">
								<label>
									Division/Branch Office:
								</label>
								<br>
								<select style="width: 70% !important;" class="form-control select2-list" id="organize_struct_list" name="organize_struct_list" required="required">
									<option value="">--Division/Branch Office--</option>
								</select>
							</div>
							<div class="col-lg-4">
								<label>
									Sub Division:
								</label>
								<br>
								<select style="width: 70% !important;" id="sub_division_list" class="form-control select2-list" name="sub_division_list" required="required">
									<option value="">--Sub Division--</option>
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Indicator Name:
								</label>
								<input name="indicator_name" class="uk-input uk-child-width-1-2" type="text" value="" placeholder="Indicator Name" required>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Satuan:
								</label>
								<input name="unit" class="uk-input uk-child-width-1-2" type="text" value="" placeholder="Satuan" required>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Polaritas:
								</label>
								<br>
								<select style="width: 85% !important;" id="polaritas" class="form-control select2-list" name="polaritas" required="required">
									<option value="">--Polaritas--</option>
									<option value="+">+</option>
									<option value="-">-</option>
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Perspective:
								</label><br>
								<select style="width: 85% !important;" id="perspective" class="form-control select2-list" name="perspective" required="required">
									<option value="">--Perspective--</option>
									<option value="I.KEUANGAN DAN PANGSA PASAR">I.KEUANGAN DAN PANGSA PASAR</option>
									<option value="II.FOKUS PELANGGAN">II.FOKUS PELANGGAN</option>
									<option value="III.PRODUK DAN PROSES">III.PRODUK DAN PROSES</option>
									<option value="IV.FOKUS TENAGA KERJA">IV.FOKUS TENAGA KERJA</option>
									<option value="V.KEPEMIMPINAN TATA KELOLA DAN TANGGUNG JAWAB KEMASYARAKATAN">V.KEPEMIMPINAN TATA KELOLA DAN TANGGUNG JAWAB KEMASYARAKATAN</option>
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Pusat/Cabang:
								</label>
								<br>
								<select style="width: 85% !important;" id="branchoffice_list" class="form-control select2-list" name="branchoffice_list" required="required">
									<option value="">--Pusat/Cabang--</option>
									<option value="Pusat">Pusat</option>
									@foreach($branch_list as $pstcbg)
									<option value="{{ $pstcbg->BRANCH_OFFICE_NAME }}">{{ $pstcbg->BRANCH_OFFICE_NAME }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Min Perhitungan Score(%):
								</label>
								<input name="minscore" class="uk-input uk-child-width-1-2" type="number" step="any" value="" placeholder="Min. Score">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Max Perhitungan Score(%):
								</label>
								<input name="maxscore" class="uk-input uk-child-width-1-2" type="number" step="any" value="" placeholder="Max. Score">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Laporan KPI:
								</label><br>
								<select style="width: 85% !important;" id="laporankpi" class="form-control select2-list" name="laporankpi" required="required">
									<option value="">--Laporan KPI--</option>
									<option value="YA">YA</option>
									<option value="TIDAK">TIDAK</option>
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Formula:
								</label>
								<input id="formula" name="formula" class="uk-input uk-child-width-1-2"  value="" type="text" placeholder="Formula" required>
							</div>
							<div class="col-lg-6">
								<label>
									Formula:
								</label>
								<textarea type="text"  class="form-control m-input" name="formula_alias" id="formula_alias" placeholder="" readonly="readonly" required></textarea>
							</div>
						</div>
						<div class="form-group  m-form__group row">
							<div class="col-lg-2">
								<div class="input-group">
									<span class="input-group-addon">
										<i class=""></i>
									</span>
									<select style="width: 70% !important;" class="form-control select2-list" id="exampleSelect11">
										<option value="">
											--Type--
										</option>
										<option value="+">
											+ (Tambah)
										</option>
										<option value="-">
											- (Kurang)
										</option>
										<option value="*">
											* (Kali)
										</option>
										<option value="/">
											/ (Bagi)
										</option>
									</select>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="input-group">
									<span class="input-group-addon">
										<i class=""></i>
									</span>
									<select style="width: 90% !important;" class="form-control select2-list" id="exampleSelect1">
										<option>
											--Indicator--
										</option>
										@foreach($indicator_list as $indicator)
										<option value="{{ $indicator->INDICATOR_ID }}.{{ $indicator->INDICATOR_NAME }}.{{ $indicator->SUB_DIVISION_NAME }}">{{ $indicator->SUB_DIVISION_NAME }} - {{ $indicator->INDICATOR_NAME }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-2" style="max-width: 13.5% !important;">
								<div class="btn btn btn-danger m-btn m-btn--icon">
									<span onclick="clearformula();">
										<span>
											Clear Formula
										</span>
									</span>
								</div>
							</div>
							<div class="col-lg-1">
								<div class="btn btn btn-primary m-btn m-btn--icon">
									<span onclick="plusplus();">
										<span>
											Add
										</span>
									</span>
								</div>
							</div>
							<div class="col-lg-1"  style="max-width: 10% !important;">
								<div class="btn btn btn-success m-btn m-btn--icon">
									<span onclick="average();">
										<span>
											Rata-rata
										</span>
									</span>
								</div>
							</div>
							<div class="col-lg-1">
								<div class="btn btn btn-warning m-btn m-btn--icon">
									<span onclick="percentage();">
										<span style="color: white !important;">
											Percentage
										</span>
									</span>
								</div>
							</div>
						</div>
						<div>
							<br>
						</div>
						<div>
							<button class="uk-button uk-button-primary fl-button" onclick="save_mst_sarmut(this.form.id);return false;">
								<i class="fa fa-plus"></i>&nbsp;Save
							</button>
						</div>

					</form>
				</div>
			</div>
			
			<div class="fl-table">
				<div class="uk-overflow-auto">
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id="kpi_list">
						<thead>
							<tr class="fl-table-head">
								<th width="5%"></th>
								<th width="15%">Sub Divisi</th>
								<th width="15%">Indikator</th>
								<th width="15%">Pusat/Cabang</th>
								<th width="15%">Satuan</th>
								<th width="10%">Min Score</th>
								<th width="10%">Max Score</th>
								<th width="15%">Active</th>
								<th width="15%">Status</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($kpi_list as $data)
								<tr>
									<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/i1.png') }}" width="45" alt=""></td>
									<td>{{ $data->SUB_DIVISION_NAME }}</td>
									<td>{{ $data->INDICATOR_NAME }}</td>
									<td>{{ $data->PUSAT_CABANG }}</td>
									<td>{{ $data->UNIT }}</td>
									<td>{{ $data->MIN_SCORE }}</td>
									<td>{{ $data->MAX_SCORE }}</td>
									<td>
									@if($data->ACTIVE == 'Y')
										<span style="color:green">Active</span>
									@else
										<span style="color:red">Inactive</span>
									@endif
									</td>
									<td>
										@if($data->STATUS == '1')
									 		<span style="color:red">Menunggu Approval DVP</span>
									 	@elseif($data->STATUS == '2')
									 		<span style="color:blue">Menunggu Approval VP</span>
									 	@elseif($data->STATUS == '3')
									 		<span style="color:green">Approved</span>
									 	@elseif($data->STATUS == '4')
									 		<span style="color:red">Dikembalikan ({{$data->ALASAN_KEMBALIKAN}})</span>
									 	@endif
									</td>
									<td>
										<button class="uk-button uk-button-default fl-button" type="button">Action</button>
										<div uk-dropdown="mode:click">
											<ul class="uk-nav uk-dropdown-nav">
												<li><a href="kpi/detail/form_mstkpidetail/{{ $data->INDICATOR_ID }}">Detail</a></li>
												@if((Auth::user()->ACCESS == 'DVP SUB DIVISI' && $data->STATUS == '1') || (Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '1'))
													<li><a href="javascript:;" onclick="Approval({{ $data->INDICATOR_ID }})">Approve</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->INDICATOR_ID }})">Kembalikan</a></li>
												@elseif((Auth::user()->ACCESS == 'VP SUB DIVISI' && $data->STATUS == '2' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '2'))
													<li><a href="javascript:;" onclick="Approval({{ $data->INDICATOR_ID }})">Approve</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->INDICATOR_ID }})">Kembalikan</a></li>
												@elseif((Auth::user()->ACCESS == 'DVP SUB DIVISI' && $data->STATUS == '3') || (Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '3'))
													<li><a href="kpi/status/form_mstkpieditstatus/{{ $data->INDICATOR_ID }}">Status</a></li>
												@elseif((Auth::user()->ACCESS == 'VP SUB DIVISI' && $data->STATUS == '3' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '3'))
													<li><a href="kpi/status/form_mstkpieditstatus/{{ $data->INDICATOR_ID }}">Status</a></li>
												@elseif((Auth::user()->ACCESS == 'ADMIN SUB DIVISI'  && $data->STATUS == '3' || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '3'))
													<li><a href="kpi/status/form_mstkpieditstatus/{{ $data->INDICATOR_ID }}">Status</a></li>
												@elseif((Auth::user()->ACCESS == 'ADMIN SUB DIVISI'  && $data->STATUS == '4' || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '4' || Auth::user()->ACCESS == 'ADMIN SUB DIVISI'  && $data->STATUS == '1' || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '1'))
													<li><a href="kpi/edit/form_mstkpiedit/{{ $data->INDICATOR_ID }}">Edit</a></li>
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
	</div>
	<!-- Approval -->
	<div id="Approvalmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/kpi/master_kpi_approval_indikator" id="approvalForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Approval</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<input type="hidden"  id="id" name="id">
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
	<div id="kembalikanmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/kpi/master_kpi_kembalikan_indikator" id="kembalikanForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Kembalikan</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<input type="hidden"  id="id1" name="id1">
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
		$('#kpi_list').DataTable();
		
		$("#formButton").click(function() {
			$("#form1").toggle();
		});

		$('#directorat_list').on('change', function(){
			var idgabungan = $(this).val();
			//alert(idgabungan);
			var pisah = idgabungan.split('-');
			var iddir = pisah[0];
			var iscbg = pisah[1];


			if(iscbg == 1)
			{
				$.get('{{ url('getdivbranch/getbranch') }}/'+iddir, function (data) {
					$('#organize_struct_list').empty();
					$('#organize_struct_list').append('<option value="">Pilih Branch Office</option>');
					$.each(data, function (index, element) {
						$('#organize_struct_list').append('<option value="'+ element.BRANCH_OFFICE_ID +'-'+'1'+'">'+ element.BRANCH_OFFICE_NAME +'</option>');
					});
					$("#organize_struct_list").select2({
						allowClear: true
					});
				});	
			}
			else
			{
				$.get('{{ url('getdivbranch/getdiv') }}/'+iddir, function (data) {
					$('#organize_struct_list').empty();
					$('#organize_struct_list').append('<option value="">Pilih Divisi</option>');
					$.each(data, function (index, element) {
						$('#organize_struct_list').append('<option value="'+ element.DIVISION_ID +'-'+'0'+'">'+ element.DIVISION_NAME +'</option>');
					});
					$("#organize_struct_list").select2({
						allowClear: true
					});
				});	
			}
			
		});

		$('#organize_struct_list').on('change', function(){
			var idgabungan = $(this).val();
			//alert(idgabungan);
			var pisah = idgabungan.split('-');
			var iddivbranch = pisah[0];
			var iscbg = pisah[1];


			if(iscbg == 1)
			{
				$.get('{{ url('getsubdiv/getsubdivbranch') }}/'+iddivbranch, function (data) {
					$('#sub_division_list').empty();
					$('#sub_division_list').append('<option value="">Pilih Sub Divisi</option>');
					$.each(data, function (index, element) {
						$('#sub_division_list').append('<option value="'+ element.SUB_DIVISION_ID +'-'+element.ORGANIZATION_STRUCTURE_ID+'">'+ element.SUB_DIVISION_NAME +'</option>');
					});
					$("#sub_division_list").select2({
						allowClear: true
					});
				});	
			}
			else
			{
				$.get('{{ url('getsubdiv/getsubdivdivisi') }}/'+iddivbranch, function (data) {
					$('#sub_division_list').empty();
					$('#sub_division_list').append('<option value="">Pilih Sub Divisi</option>');
					$.each(data, function (index, element) {
						$('#sub_division_list').append('<option value="'+ element.SUB_DIVISION_ID +'-'+element.ORGANIZATION_STRUCTURE_ID+'">'+ element.SUB_DIVISION_NAME +'</option>');
					});
					$("#sub_division_list").select2({
						allowClear: true
					});
				});	
			}
			
		});

	} );
	$(".select2-list").select2({
		allowClear: true
	});

	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function Approval(id){
		var id = id;
		$('#id').val(id);

        UIkit.modal("#Approvalmodal").show();

	}

	function Kembalikan(id){
		var id = id;
		$('#id1').val(id);

		UIkit.modal("#kembalikanmodal").show();

	}

	function plusplus(){
		var a = $("#exampleSelect11 option:selected").val();
		var gabung = $("#exampleSelect1 option:selected").val();
		var b = gabung.split('.');
		var b1 = b[0];
		var b2 = b[1];
		var b3 = b[2];
		var saatini = $("#formula").val();
		var saatinialias =  $("#formula_alias").val();
		if(saatini.includes(b1)){
			alert('Sub Indicator telah Ada.');
		}else{
			$("#formula").val(saatini+" "+a+" "+b1);
			$("#formula_alias").val(saatinialias+" "+a+" "+b3+" - "+b2);
		}
	}

	function clearformula() {
		document.getElementById("formula").value = "";
		document.getElementById("formula_alias").value = "";
	}

	function average(){
		var saatini = $("#formula").val();
		var saatinialias = $("#formula_alias").val();
		// alert(saatinialias);
		// var a =  saatini.split('');
		// var b = a[0];
		// var c = a.splice(1);
		// var d = replace(/,/g, '');
		// alert(d);
		var gabung1 = saatini.split(/[^0-9\.]+/);
		// var gabung2 = saatinialias.split(/[^0-9\.]+/);
		// alert(gabung1);
		var a1 = gabung1.length;
		// var a2 = gabung2.length;
		 // alert(a2);
		var fixcount = a1 - 1;
		// var fixcount2 = a2;
		$("#formula").val("("+saatini+" "+")"+":"+fixcount);
		$("#formula_alias").val("("+saatinialias+" "+")"+":"+fixcount);
	}

	function percentage(){
		var saatini = $("#formula").val();
		var saatinialias =  $("#formula_alias").val();
		$("#formula").val("("+saatini+" "+")"+"x"+100);
		$("#formula_alias").val("("+saatinialias+" "+")"+"x"+100);
	}
</script>
