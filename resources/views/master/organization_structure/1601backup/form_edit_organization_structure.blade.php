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
					Edit Struktur Organisasi
				</span>
			</div>

			<div class="fl-table">
				<form id="form_blade" action="/master/organization_structure_save_edit" method="POST">
					{{ csrf_field() }}
					<div class="form-group m-form__group row">
						<input type="hidden" name="id" value="{{$id}}">
						<div class="col-lg-6">
							<label>
								Directorate:
							</label>
							<select class="form-control select2-list" id="directorat" name="directorat" onchange="IsCabang(this.value);" required>
								<option value="">--Directorate--</option>
								@foreach($directorat as $data)
									@if($data->DIRECTORATE_ID == $id_directorat)
									<option value="{{ $data->DIRECTORATE_ID }}-{{ $data->IS_CABANG }}" selected>{{ $data->DIRECTORATE_NAME }}</option>
									@else
									<option value="{{ $data->DIRECTORATE_ID }}-{{ $data->IS_CABANG }}">{{ $data->DIRECTORATE_NAME }}</option>
									@endif
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-6">
							<label>
								Branch Office:
							</label>
							<select class="form-control select2-list" id="branchoffice" name="branchoffice" required disabled>
								<option value="">--Branch Office--</option>
								@foreach($branch as $data)
									@if($data->BRANCH_OFFICE_ID == $id_branch)
									<option value="{{ $data->BRANCH_OFFICE_ID }}" selected>{{ $data->BRANCH_OFFICE_NAME }}</option>
									@else
									<option value="{{ $data->BRANCH_OFFICE_ID }}">{{ $data->BRANCH_OFFICE_NAME }}</option>
									@endif
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-6">
							<label>
								Division:
							</label>
							<select class="form-control select2-list" id="divisi" name="divisi" required disabled>
								<option value="">--Division--</option>
								@foreach($division as $data)
									@if($data->DIVISION_ID == $id_division)
									<option value="{{ $data->DIVISION_ID }}" selected>{{ $data->DIVISION_NAME }}</option>
									@else
									<option value="{{ $data->DIVISION_ID }}">{{ $data->DIVISION_NAME }}</option>
									@endif
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-6">
							<label>
								Sub Division:
							</label>
							<select class="form-control select2-list" id="sub_divisi" name="sub_divisi" required>
								<option value="">--Sub Division--</option>
								@foreach($sub_division as $data)
									@if($data->SUB_DIVISION_ID == $id_sub_division)
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
							<label class="">
								Status:
							</label>
							<select class="form-control select2-list" name="status"   id="status">
								<option value="">--Pilih Status--</option>
								<option value="Y" {{ $status == "Y" ? 'selected' : '' }}>AKTIF</option>
								<option value="N" {{ $status == "N" ? 'selected' : '' }}>INAKTIF</option>
							</select>
						</div>
					</div>
					<div>
						<br>
					</div>
					<div>
						<button class="uk-button uk-button-primary fl-button" type="submit">
							<i class="fa fa-plus"></i>&nbsp;Update
						</button>
							<button onclick="location.href = '{{ url('master/organization_structurex')}}'" class="uk-button uk-button-danger fl-button float-right" type="button">Back</button>
					</div>					
				</form>
			</div>

		</div>	
	</div>

</body>
<html>
<script src="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->   
<!--begin::Page Resources -->
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/forms/widgets/form-repeater.js') }}" type="text/javascript"></script>
<!-- metronic -->
<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
<script>

	function IsCabang(idgabungan){
		var pisah = idgabungan.split('-');
		var iscbg = pisah[1];

		if (iscbg == 1) {
			document.getElementById('branchoffice').disabled = false;
			document.getElementById('divisi').disabled = true;
			document.getElementById('divisi').disableValidation = true;
			$('#divisi').val(null).trigger('change');
		} else {
			document.getElementById('divisi').disabled = false;
			document.getElementById('branchoffice').disabled = true;
			document.getElementById('branchoffice').disableValidation = true;
			$('#branchoffice').val(null).trigger('change');
		}
	}

	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function save_organization_structure(formid)
	{   
		submit_form(formid);
	}

	$(".select2-list").select2({
		allowClear: true
	});
	
</script>


