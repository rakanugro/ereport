<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
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
					<input type="button" class="uk-button uk-button-primary fl-button" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
				</span>
			</div>	
		</div>


		<div class="fl-container">
			<div class="fl-title-page" >
				<span style="font-size:20px">				
					<img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/sopReadMore.png') }}" width="65" alt="">
					FORM EDIT PERINTAH TINDAKAN KOREKTIF ATAS KETIDAKSESUAIAN (FORM PTKAK)
				</span>
			</div>
			
			<div class="fl-table col-md-12">
				<form id="form_mst_sarmut" action="/ptkak/ptkakedited" enctype="multipart/form-data" method="POST" file="true">
					{{ csrf_field() }}
					<div class="form-group m-form__group row">
						<input type="hidden" name="id" value='{{ $id }}'>
						<div class="col-lg-8">
							<label class="">
								&nbsp;
							</label>
						</div>
						<div class="col-lg-4">
							<b><label class="">
								Revisi:
							</label></b>
							<input type="text"  class="form-control m-input" name="revisi" id="revisi" value="{{ $revision }}" required>
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
							<input type="text"  class="form-control m-input" data-date-format="dd-mm-yyyy" name="tanggal" id="tanggal" value="@php if($ptkakdate == NULL){echo ''; }else{echo date('d-m-Y',strtotime($ptkakdate));} @endphp" required>
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
							<input type="text"  class="form-control m-input" name="halaman" id="halaman" value="{{ $page }}" required>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-8">
							<b><label>
								No PTKAK:
							</label></b>
							<input type="text"  class="form-control m-input" name="noptkak" id="noptkak" value="{{ $noptkak }}" required>
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
									<input type="radio" name="jenis" id="jenis" value="1" {{ $type == "1" ? 'checked' : '' }}>
									Tindakan Perbaikan
									<span></span>
								</label>
								<label class="m-radio m-radio--solid">
									<input type="radio" name="jenis" id="jenis" value="2" {{ $type == "2" ? 'checked' : '' }}>
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
									<input type="radio" name="sumber" id="sumber" value="{{ $data->SOURCE_ID}}" {{ $sbr == $data->SOURCE_ID ? 'checked' : '' }}>
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
							<label class="">
								Pengusul/Auditor:
							</label>
							<select class="form-control select2-list" id="pengusulauditor" name="pengusulauditor" required>
								<option value="">--Pengusul/Auditor--</option>
								@foreach($subdiv as $data)
								@if($data->SUB_DIVISION_ID == $auditor)
								<option value="{{ $data->SUB_DIVISION_ID }}" selected>{{ $data->SUB_DIVISION_NAME }}</option>
								@else
								<option value="{{ $data->SUB_DIVISION_ID }}">{{ $data->SUB_DIVISION_NAME }}</option>
								@endif
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
								@if($data->SUB_DIVISION_ID == $auditan)
								<option value="{{ $data->SUB_DIVISION_ID }}" selected>{{ $data->SUB_DIVISION_NAME }}</option>
								@else
								<option value="{{ $data->SUB_DIVISION_ID }}">{{ $data->SUB_DIVISION_NAME }}</option>
								@endif
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
							<textarea type="text"  class="form-control m-input" name="uraian" id="uraian" required>{{ $uraian }}</textarea>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-8">
							<b><label>
								lokasi:
							</label></b>
							<input type="text"  class="form-control m-input" name="lokasi" id="lokasi" value="{{ $loc }}" required>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-8">
							<b><label for="exampleInputEmail1">
								Bukti:
							</label></b>
							@if($isdeleted == '0')
							<div class="col-lg-6">
								<h6><a href="{{ url::to('/') }}/{{ $getfile }}" download data-toggle="tooltip" title="Download {{ $getfile }}">{{ $getfilename }}</a></h6>
								<button class="uk-button-danger fl-button" id="hapusfile" type="button">
									<i class="fa fa-minus"></i>&nbsp;Hapus file
								</button>
								<input type="hidden" id="idfile" name="idfile" value='{{ $id }}'>
								<input type="hidden" id="bukti" name="bukti" value='{{ $getfile }}'>
							</div>
							@else
							<div></div>
							<label class="custom-file">
								<input type="file" id="bukti" name="bukti" class="btn btn-submit" onchange="return fileValidation(this);">
								<div class="col-sm-12"></div>
								<div class="col-sm-12">max size file 5MB & file format .jpeg/.jpg/.png/.pdf</div>
							</label>
							@endif
						</div>
					</div>
					<br>
					<div class="form-group m-form__group row">
						<div class="col-lg-8">
							<b><label>
								Referensi:
							</label></b>
							<input type="text"  class="form-control m-input" name="referensi" id="referensi" value="{{ $ptkakref }}" required>
						</div>	
					</div>
					<br>
					<hr style="border: 1px solid;">
					<div class="form-group m-form__group row">
						<div class="col-lg-12">
							<label class="">
								Tindakan Awal:
							</label>
							<textarea type="text"  class="form-control m-input" name="tindakan" id="tindakan" readonly="readonly">{{ $firstact }}</textarea>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-12">
							<label class="">
								Tindakan Pencegahan:
							</label>
							<textarea type="text"  class="form-control m-input" name="penyebab" id="penyebab" readonly="readonly">{{ $cause }}</textarea>
						</div>
					</div>
					<hr style="border: 1px solid;">
					<div class="form-group m-form__group row">
						<div class="col-lg-12">
							<label class="">
								Tindakan Koreksi/ Tindakan Perbaikan:
							</label>
							<textarea type="text"  class="form-control m-input" name="tindakankorek" id="tindakankorek" readonly="readonly">{{ $act }}</textarea>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-12">
							<label class="">
								Tindakan Pencegahan:
							</label>
							<textarea type="text"  class="form-control m-input" name="penyebab1" id="penyebab1" readonly="readonly">{{ $preven }}</textarea>
						</div>
					</div>
					<div>
						<br>
					</div>		
					<div>
						<button class="uk-button uk-button-primary fl-button" type="sumbit">
							<i class="fa fa-plus"></i>&nbsp;Update
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

	$("#hapusfile").click(function(e){
		e.preventDefault();

		var id = $('#idfile').val();
		$.ajax({
			type:'POST',
			url:('{{url('/ptkkak/deletefile')}}/')+id,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success:function(data){
				location.reload(); 
			}
		});
	});

	
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
