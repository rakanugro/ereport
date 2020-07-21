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

<!-- metronic -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
  WebFont.load({
    google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
    active: function() {
        sessionStorage.fonts = true;
    }
  });
</script>
<!--end::Web font -->
<!--begin::Base Styles -->
<link href="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic2/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />

<link rel="shortcut icon" href="{{ URL::asset('metronic2/assets/demo/default/media/img/logo/favicon.ico') }}" />
<!-- metronic -->

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
					<img src="{{ URL::asset('templateslide/assets/img/logo/Logo e-Report.png') }}" class="fl-logo">
					<input type="button" class="uk-button uk-button-primary fl-button" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
				</span>
				<!-- <span class="fl-menu-tool">
					<input type="button" class="uk-button uk-button-primary fl-button" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
				</span> -->
			</div>	
		</div>


		<div class="fl-container">
			<div class="fl-title-page" >
				<span style="font-size:20px">				
					<img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/sopReadMore.png') }}" width="65" alt="">
					Edit Master KPI
				</span>
			</div>
			
			<div class="fl-table">
				<form id="form_mst_kpi" action="/kpi/master_kpi_save_edit_indikator" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="id" id="id" value="{{ $id }}">
					<div class="form-group m-form__group row">
							<div class="col-lg-4">
								<label>
									Directorate:
								</label>
								<br>
								<select style="width: 70% !important;" class="form-control select2-list" id="directorat_list" name="directorat_list" required="required">
									<option value="">--Directorate--</option>
									@foreach($directorat_list as $org)
									 	@if( $org->DIRECTORATE_ID == $iddir)
											<option value="{{ $org->DIRECTORATE_ID }}-{{ $org->IS_CABANG }}" selected>{{ $org->DIRECTORATE_NAME }}</option>
										@else
											<option value="{{ $org->DIRECTORATE_ID }}-{{ $org->IS_CABANG }}">{{ $org->DIRECTORATE_NAME }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="col-lg-4">
								<label>
									Division/Branch Office:
								</label>
								<br>
								@if($iscabang == '1')
								<select style="width: 70% !important;" class="form-control select2-list" id="organize_struct_list" name="organize_struct_list" required="required">
									<option value="">--Division/Branch Office--</option>
									@foreach($datalist as $org)
									 	@if( $org->BRANCH_OFFICE_ID == $idbranch)
											<option value="{{ $org->BRANCH_OFFICE_ID  }}-1">{{ $org->BRANCH_OFFICE_NAME }}</option>
										@else
											<option value="{{ $org->BRANCH_OFFICE_ID  }}-1">{{ $org->BRANCH_OFFICE_NAME }}</option>
										@endif
									@endforeach
								</select>
								@else
								<select style="width: 70% !important;" class="form-control select2-list" id="organize_struct_list" name="organize_struct_list" required="required">
									<option value="">--Division/Branch Office--</option>
									@foreach($datalist as $org)
									 	@if( $org->DIVISION_ID == $iddiv)
											<option value="{{ $org->DIVISION_ID }}-0" selected>{{ $org->DIVISION_NAME }}</option>
										@else
											<option value="{{ $org->DIVISION_ID  }}-0">{{ $org->DIVISION_NAME }}</option>
										@endif
									@endforeach
								</select>
								@endif
							</div>
							<div class="col-lg-4">
								<label>
									Sub Division:
								</label>
								<br>
								<select style="width: 70% !important;" id="sub_division_list" class="form-control select2-list" name="sub_division_list" required="required">
									<option value="">--Sub Division--</option>
									@foreach($datalist2 as $subdivision)
										@if( $subdivision->SUB_DIVISION_ID == $idsubdiv)
											<option value="{{ $subdivision->SUB_DIVISION_ID }}-{{$subdivision->ORGANIZATION_STRUCTURE_ID}}" selected>{{ $subdivision->SUB_DIVISION_NAME }}</option>
										@else
											<option value="{{ $subdivision->SUB_DIVISION_ID }}-{{$subdivision->ORGANIZATION_STRUCTURE_ID}}">{{ $subdivision->SUB_DIVISION_NAME }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Indicator Name:
								</label>
								<input name="indicator_name" class="uk-input uk-child-width-1-2" type="text" value="{{ $nameindicator }}" placeholder="Indicator Name" required>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Satuan:
								</label>
								<input name="unit" class="uk-input uk-child-width-1-2" type="text" value="{{ $unit }}" placeholder="Satuan" required>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Polaritas:
								</label>
								<br>
								<select style="width: 85% !important;" id="polaritas" class="form-control select2-list" name="polaritas" required="required">
									<option value="+" {{ $polaritas == "+" ? 'selected' : '' }}>+</option>
									<option value="-" {{ $polaritas == "-" ? 'selected' : '' }}>-</option>
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
									<option value="I.KEUANGAN DAN PANGSA PASAR" {{ $perspective == "I.KEUANGAN DAN PANGSA PASAR" ? 'selected' : '' }}>I.KEUANGAN DAN PANGSA PASAR</option>
									<option value="II.FOKUS PELANGGAN" {{ $perspective == "II.FOKUS PELANGGAN" ? 'selected' : '' }}>II.FOKUS PELANGGAN</option>
									<option value="III.PRODUK DAN PROSES" {{ $perspective == "III.PRODUK DAN PROSES" ? 'selected' : '' }}>III.PRODUK DAN PROSES</option>
									<option value="IV.FOKUS TENAGA KERJA" {{ $perspective == "IV.FOKUS TENAGA KERJA" ? 'selected' : '' }}>IV.FOKUS TENAGA KERJA</option>
									<option value="V.KEPEMIMPINAN TATA KELOLA DAN TANGGUNG JAWAB KEMASYARAKATAN" {{ $perspective == "V.KEPEMIMPINAN TATA KELOLA DAN TANGGUNG JAWAB KEMASYARAKATAN" ? 'selected' : '' }}>V.KEPEMIMPINAN TATA KELOLA DAN TANGGUNG JAWAB KEMASYARAKATAN</option>
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
									@foreach($branch_listx as $pstcbg)
									@if( $pstcbg->BRANCH_OFFICE_ID == $pusatcabang)
									<option value="{{ $pstcbg->BRANCH_OFFICE_NAME }}" selected>{{ $pstcbg->BRANCH_OFFICE_NAME }}</option>
									@else
									<option value="Pusat" selected>Pusat</option>
									<option value="{{ $pstcbg->BRANCH_OFFICE_NAME }}">{{ $pstcbg->BRANCH_OFFICE_NAME }}</option>
									@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Min Perhitungan Score(%):
								</label>
								<input name="minscore" class="uk-input uk-child-width-1-2" type="number" value="{{$minscore}}" placeholder="Min. Score">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Max Perhitungan Score(%):
								</label>
								<input name="maxscore" class="uk-input uk-child-width-1-2" type="number" value="{{$maxscore}}" placeholder="Max. Score">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Laporan KPI:
								</label><br>
								<select style="width: 85% !important;" id="laporankpi" class="form-control select2-list" name="laporankpi" required="required">
									<option value="YA" {{ $laporankpi == "YA" ? 'selected' : '' }}>YA</option>
									<option value="TIDAK" {{ $laporankpi == "TIDAK" ? 'selected' : '' }}>TIDAK</option>
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Formula:
								</label>
								<input id="formula" name="formula" class="uk-input uk-child-width-1-2"  value="{{$formula}}" type="text" placeholder="Formula" required>
							</div>
							<div class="col-lg-6">
								<label>
									Formula:
								</label>
								<textarea id="formula_alias" name="formula_alias" class="uk-input uk-child-width-1-2" type="text" placeholder="formula_alias" required>{{$formulaalias}}</textarea>
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
						<br>
					</div>
					<div>
						<br>
					</div>
					<div>
						<br>
					</div>
					<div>
						<br>
					</div>
					<div>
						<button class="uk-button uk-button-primary fl-button" onclick="save_mst_sarmut(this.form.id);return false;">
							<i class="fa fa-plus"></i>&nbsp;Update
						</button>
						<button onclick="location.href = '{{ url('kpi')}}'" class="uk-button uk-button-danger fl-button float-right" type="button">Back</button>
					</div>
					
				</form>
			</div>

		</div>	
	</div>


<!-- metronic -->
<script src="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->   
<!--begin::Page Resources -->
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/forms/widgets/form-repeater.js') }}" type="text/javascript"></script>
<!-- metronic -->

<!-- <script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>
<script src="{{ URL::asset('js/form-repeater.js') }}"></script>
<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script> -->
<script type="text/javascript">
	$(document).ready( function () {
		
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

	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function save_mst_sarmut(formid)
    {   
		submit_form(formid);
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
		// var a =  saatini.split('');
		// var b = a[0];
		// var c = a.splice(1);
		// var d = replace(/,/g, '');
		// alert(d);
		var gabung1 = saatini.split(/[^0-9\.]+/);
		//var gabung2 = saatinialias.split(/[^0-9\.]+/);
		var a1 = gabung1.length;
		//var a2 = gabung2.length;
		var fixcount = a1 - 1;
		//var fixcount2 = a2 - 1;
		$("#formula").val("("+saatini+" "+")"+":"+fixcount);
		$("#formula_alias").val("("+saatinialias+" "+")"+":"+fixcount);
	}

	function percentage(){
		var saatini = $("#formula").val();
		var saatinialias =  $("#formula_alias").val();
		$("#formula").val("("+saatini+" "+")"+"x"+100);
		$("#formula_alias").val("("+saatinialias+" "+")"+"x"+100);
	}

	$(".select2-list").select2({
            allowClear: true
        });
</script>
	
</body>
</html>
