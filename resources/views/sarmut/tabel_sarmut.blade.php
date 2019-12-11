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
					Master Sasaran Mutu	
				</span>
				<span style="float:right;margin-top:15px">
					<a href="/master/indicator_target_list"><button class="uk-button uk-button-default fl-button" type="button">Target Indikator Bulanan</button></a>
					@if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
					<button class="uk-button uk-button-primary fl-button" type="button" id="formButton">+ Show / - Hide</button>
					@endif
				</span>
				
				<div class="fl-table col-md-12" id="form1">
					<form id="form_mst_sarmut" action="/sarmut/master_sarmut_save_indikator" method="POST">
						{{ csrf_field() }}
						<br>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<h4>
									ADD Master Indikator Sarmut
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
							<div class="col-lg-7">
								<label>
									Inputable:
								</label>
								<br>
								<select style="width: 85% !important;" id="inputable" class="form-control select2-list" name="inputable" required="required">
									<option value="">--Inputable--</option>
									<option value="Y">Inputable</option>
									<option value="N">Not Inputable</option>
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Sub Division Pengisi:
								</label>
								<br>
								<select style="width: 85% !important;" id="sub_division_pengisi_list" class="form-control select2-list" name="sub_division_pengisi_list" required="required">
									<option value="">--Sub Division--</option>
									@foreach($subdiv_list as $subdivision)
									<option value="{{ $subdivision->SUB_DIVISION_ID }}-{{$subdivision->ORGANIZATION_STRUCTURE_ID}}">{{ $subdivision->SUB_DIVISION_NAME }}</option>
									@endforeach
								</select>
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
									Periode Pengisian:
								</label>
								<br>
								<select style="width: 85% !important;" id="periodepengisian" class="form-control select2-list" name="periodepengisian" required="required">
									<option value="">--Periode Pengisian--</option>
									<option value="Bulanan">Bulanan</option>
									<option value="Triwulanan">Triwulanan</option>
									<option value="Tahunan">Tahunan</option>
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Tipe Penjumlahan:
								</label>
								<br>
								<select style="width: 85% !important;" id="tipepenjumlahan" class="form-control select2-list" name="tipepenjumlahan" required="required">
									<option value="">--Tipe Penjumlahan--</option>
									<option value="=">Sampai Dengan</option>
									<option value=":">Rata-Rata Sampai Dengan</option>
								</select>
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
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id="sarmut_list">
						<thead>
							<tr class="fl-table-head">
								<th width="5%"></th>
								<th width="22%">Sub Divisi</th>
								<th width="22%">Indikator</th>
								<th width="20%">Satuan</th>
								<th width="15%">Periode Pengisian</th>
								<th width="10%">Active</th>
								<th width="15%">Status</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($sarmut_list as $data)
								<tr>
									<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/i1.png') }}" width="45" alt=""></td>
									<td>{{ $data->SUB_DIVISION_NAME }}</td>
									<td>{{ $data->INDICATOR_NAME }}</td>
									<td>{{ $data->UNIT }}</td>
									<td>{{ $data->PERIODE_PENGISIAN }}</td>
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
													<li><a href="sarmut/detail/form_mstsarmutdetail/{{ $data->INDICATOR_ID }}">Detail</a></li>
												@if((Auth::user()->ACCESS == 'DVP SUB DIVISI' && $data->STATUS == '1') || (Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '1'))
													<li><a href="javascript:;" onclick="Approval({{ $data->INDICATOR_ID }})">Approve</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->INDICATOR_ID }})">Kembalikan</a></li>
												@elseif((Auth::user()->ACCESS == 'VP SUB DIVISI' && $data->STATUS == '2' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '2'))
													<li><a href="javascript:;" onclick="Approval({{ $data->INDICATOR_ID }})">Approve</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->INDICATOR_ID }})">Kembalikan</a></li>
												@elseif((Auth::user()->ACCESS == 'DVP SUB DIVISI' && $data->STATUS == '3') || (Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '3'))
													<li><a href="sarmut/status/form_mstsarmuteditstatus/{{ $data->INDICATOR_ID }}">Status</a></li>
												@elseif((Auth::user()->ACCESS == 'VP SUB DIVISI' && $data->STATUS == '3' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '3'))
													<li><a href="sarmut/status/form_mstsarmuteditstatus/{{ $data->INDICATOR_ID }}">Status</a></li>
												@elseif((Auth::user()->ACCESS == 'ADMIN SUB DIVISI'  && $data->STATUS == '3' || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '3'))
													<li><a href="sarmut/status/form_mstsarmuteditstatus/{{ $data->INDICATOR_ID }}">Status</a></li>
												@elseif((Auth::user()->ACCESS == 'ADMIN SUB DIVISI'  && $data->STATUS == '4' || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '4' || Auth::user()->ACCESS == 'ADMIN SUB DIVISI'  && $data->STATUS == '1' || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '1'))
													<li><a href="sarmut/edit/form_mstsarmutedit/{{ $data->INDICATOR_ID }}">Edit</a></li>
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
			<form action="/sarmut/master_sarmut_approval_indikator" id="approvalForm" method="post">
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
			<form action="/sarmut/master_sarmut_kembalikan_indikator" id="kembalikanForm" method="post">
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
		$('#sarmut_list').DataTable();
		
		$("#formButton").click(function() {
			$("#form1").toggle();
		});

		$('#sub_division_list').on('select2:select', function (e) {
			var value = $('#sub_division_list').val();
			$('#sub_division_pengisi_list').val(value);
			$('#sub_division_pengisi_list').select2().trigger('change');
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
</script>
