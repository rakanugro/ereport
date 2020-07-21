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
					FORM PERINTAH TINDAKAN KOREKTIF ATAS KETIDAKSESUAIAN (FORM PTKAK)
				</span>
			</div>
			
			<div class="fl-table col-md-12">
				<form id="form_mst_sarmut" action="/ptkakadded/master_ptkak_save" enctype="multipart/form-data" method="POST" file="true">
					{{ csrf_field() }}
					<div class="form-group m-form__group row">
						<!-- <div class="col-lg-4">
							<label class="">
								NO:
							</label>
							<input type="text"  class="form-control m-input" name="no" id="no" placeholder="Input No" required>
						</div> -->
						<div class="col-lg-8">
							<label class="">
								&nbsp;
							</label>
						</div>
						<div class="col-lg-4">
							<b><label class="">
								Revisi:
							</label></b>
							<input type="text"  class="form-control m-input" name="revisi" id="revisi" placeholder="Input Revisi" required>
						</div>
						<div class="col-lg-2">
							<img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/ptplogo.png') }}" width="170" alt="">
						</div>
						<div class="col-lg-6">
							<h4>
								<label class="">
									FORM PERINTAH TINDAKAN KOREKTIF ATAS KETIDAKSESUAIAN (FORM PTKAK)
								</label></h4>
							</div>
						<div class="col-lg-4">
							<b><label>
								Tanggal PTKAK:
							</label></b>
							<input type="text"  class="form-control m-input" data-date-format="dd-mm-yyyy" name="tanggal" id="tanggal" placeholder="Input Tanggal" required>
						</div>
						<div class="col-lg-8">
							<label class="">
								&nbsp;
							</label>
						</div>
						<div class="col-lg-4">
							<b><label class="">
								Halaman:
							</label></b>
							<input type="text"  class="form-control m-input" name="halaman" id="halaman" placeholder="Input Halaman" required>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-8">
							<b><label>
								No PTKAK:
							</label></b>
							<input type="text"  class="form-control m-input" name="noptkak" id="noptkak" placeholder="Input No PTKAK" required>
						</div>
					</div>
					<hr style="border: 1px solid;">
					<div class="form-group m-form__group row">
						<div class="col-lg-6">
							<b><label class="">
								Jenis:
							</label></b>
							<div class="m-radio-inline">
								<label class="m-radio m-radio--solid">
									<input type="radio" name="jenis" id="jenis" value="1" required>
									Tindakan Perbaikan
									<span></span>
								</label>
								<label class="m-radio m-radio--solid">
									<input type="radio" name="jenis" id="jenis" value="2" required>
									Tindakan Pencegahan
									<span></span>
								</label>
							</div>
						</div>
						<div class="col-lg-3">
							<b><label class="">
								Sumber:
							</label></b>
							<div class="m-radio-inline">
								@foreach($source_list as $data)
								<label class="m-radio m-radio--solid">
									<input type="radio" name="sumber" id="sumber" value="{{ $data->SOURCE_ID}}" required>
									{{ $data->SOURCE}}
									<span></span>
								</label>
								@endforeach
							</div>
						</div>
						<div class="col-lg-3">
							&nbsp;
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-6">
							<b><label class="">
								Pengusul/Auditor:
							</label></b>
							<select class="form-control select2-list" id="pengusulauditor" name="pengusulauditor" required>
								<option value="">--Pengusul/Auditor--</option>
								@foreach($subdiv as $data)
								<option value="{{ $data->SUB_DIVISION_ID }}">{{ $data->SUB_DIVISION_NAME }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-6">
							<label>
								Ditujukan/Auditan:
							</label>
							<select class="form-control select2-list" id="ditujuakan" name="ditujuakan" required>
								<option value="">--Ditujukan/Auditan--</option>
								@foreach($subdiv as $data)
								<option value="{{ $data->SUB_DIVISION_ID }}">{{ $data->SUB_DIVISION_NAME }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<hr style="border: 1px solid;">
					<div class="m-portlet__head col-lg-12">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
									<i class="la la-gear"></i>
								</span>
								<h6 class="m-portlet__head-text">
									Temuan/ Ketidaksesuaian/ Masalah Potensial
								</h6>
							</div>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-8">
							<b><label class="">
								Uraian:
							</label></b>
							<textarea type="text"  class="form-control m-input" name="uraian" id="uraian" placeholder="Input Uraian" required></textarea>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-8">
							<b><label>
								lokasi:
							</label></b>
							<input type="text"  class="form-control m-input" name="lokasi" id="lokasi" placeholder="Input Lokasi" required>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-8">
							<b><label for="exampleInputEmail1">
								Bukti:
							</label></b>
							<div></div>
							<label class="custom-file">
								<input type="file" id="bukti" name="bukti" class="btn btn-submit" onchange="return fileValidation(this);">
								<div class="col-sm-12"></div>
								<div class="col-sm-12">max size file 5MB & file format .jpeg/.jpg/.png/.pdf</div>
								<!-- <span class="custom-file-control">Choose File...</span> -->
							</label>
						</div>
					</div>
					<br>
					<div class="form-group m-form__group row">
						<div class="col-lg-8">
							<b><label>
								Referensi:
							</label>
							</b>
							<input type="text"  class="form-control m-input" name="referensi" id="referensi" placeholder="Input Referensi" required>
						</div>	
					</div>
					<br>
					<hr style="border: 1px solid;">
					<div class="form-group m-form__group row">
						<div class="col-lg-12">
							<b><label class="">
								Tindakan Awal:
							</label></b>
							<textarea type="text"  class="form-control m-input" name="tindakan" id="tindakan" placeholder="Input Tindakan" required></textarea>
						</div>
					</div>
					<hr style="border: 1px solid;">
					<div class="form-group m-form__group row">
						<div class="col-lg-12">
							<b><label class="">
								Akar Penyebab:
							</label></b>
							<textarea type="text"  class="form-control m-input" name="penyebab" id="penyebab" placeholder="Input Penyebab" required></textarea>
						</div>
					</div>
					<hr style="border: 1px solid;">
					<div class="form-group m-form__group row">
						<div class="col-lg-12">
							<b><label class="">
								Tindakan Koreksi/ Tindakan Perbaikan:
							</label></b>
							<textarea type="text"  class="form-control m-input" name="tindakankorek" id="tindakankorek" placeholder="Input Tindakan" required></textarea>
						</div>
					</div>
					<hr style="border: 1px solid;">
					<div class="form-group m-form__group row">
						<div class="col-lg-12">
							<b><label class="">
								Akar Penyebab:
							</label></b>
							<textarea type="text"  class="form-control m-input" name="penyebab1" id="penyebab1" placeholder="Input Penyebab" required></textarea>
						</div>
					</div>
					<div>
						<br>
					</div>		
					<div>
						<button class="uk-button uk-button-primary fl-button" type="sumbit">
							<i class="fa fa-plus"></i>&nbsp;Save
						</button>
						<button onclick="location.href = '{{ url('ptkaklist')}}'" class="uk-button uk-button-danger fl-button float-right" type="button">Back</button>
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
	<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>

<!-- <script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>
<script src="{{ URL::asset('js/form-repeater.js') }}"></script>
<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script> -->
<script type="text/javascript">
	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function fileValidation(file){
		var fileInput = document.getElementById('bukti');
		var filePath = fileInput.value;
		var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;
		var FileSize = file.files[0].size / 5120 / 5120;
		if(!allowedExtensions.exec(filePath) || FileSize > 5){
			alert('file extension .jpeg/.jpg/.png/.pdf. size file max 5MB');
			fileInput.value = '';
			return false;

		}
	}

	$(".select2-list").select2({
		allowClear: true
	});
</script>
<script>
	$( function() {
		$( "#tanggal" ).datepicker({
			dateFormat: 'dd-mm-yyyy',
			changeMonth: true,
			changeYear: true,
			autoclose: true
		});
	});
</script>

</body>
</html>
