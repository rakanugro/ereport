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
					Master User
				</span>
			</div>


			<div class="fl-table">
				<form id="form_blade" action="/master/master_user_save" method="POST">
					{{ csrf_field() }}
					<div class="form-group m-form__group row">
						<div class="col-lg-4">
							<label class="">
								Usename:
							</label>
							<input type="text"  class="form-control m-input" name="nipp" id="nipp" onchange="check_username()" placeholder="Input Username" required>
							<div class="help-block with-errors" style="color:red;" id="error-nipp"></div>
							@if ($errors->has('nipp'))
							<span class="help-block">
								<strong>{{ $errors->first('nipp') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-4">
							<label class="">
								Nama:
							</label>
							<input type="text"  class="form-control m-input" name="nama" id="nama" placeholder="Input Nama" required>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-4">
							<label class="">
								Email:
							</label>
							<input type="email"  class="form-control m-input" name="email" id="email" placeholder="Input Email" required>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-lg-4">
							<label class="">
								Access:
							</label>
							<select class="form-control select2-list" name="access"   id="access" required>
								<option value="">--Pilih Access--</option>
								<option value="ADMIN KHUSUS">Admin Khusus</option>
								<option value="ADMIN SUB DIVISI">Admin Sub Divisi</option>
								<option value="DVP SUB DIVISI">DVP/DGM Sub Divisi</option>
								<option value="VP SUB DIVISI">VP/GM Sub Divisi</option>
								<option value="ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU">Admin Pengendalian Kinerja dan Jaminan Mutu</option>
								<option value="DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU">DVP Pengendalian Kinerja dan Jaminan Mutu</option>
								<option value="VP PENGENDALIAN KINERJA DAN JAMINAN MUTU">VP Pengendalian Kinerja dan Jaminan Mutu</option>
							</select>
						</div>
					</div>
				<!-- 	<div class="form-group m-form__group row">
						<div class="col-lg-4">
							<label class="">
								Status:
							</label>
							<select class="form-control select2-list"  id="status" name="status" data-validation="required" data-validation-error-msg="Silahkan Pilih Status">
								<option value="">--Pilih Status--</option>
								<option value="AKTIF">AKTIF</option>
								<option value="INAKTIF">INAKTIF</option>
							</select>
						</div>
					</div> -->
					<div class="form-group m-form__group row">
						<div class="col-lg-4">
							<label class="">
								Organization Structure:
							</label>
							<select class="form-control select2-list" id="organize_struct_list" name="organize_struct_list" required>
								<option value="">--Sub Divisi--</option>
								@foreach($organize_struct as $org)
								<option value="{{ $org->ORGANIZATION_STRUCTURE_ID }}">{{ $org->BRANCH_OFFICE_NAME }} {{ $org->SUB_DIVISION_NAME }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div>
						<br>
					</div>
					<div>
						<button class="uk-button uk-button-primary fl-button" onclick="save_master_user(this.form.id);return false;">
							<i class="fa fa-plus"></i>&nbsp;Save
						</button>
						<button onclick="location.href = '{{ url('/master/master_user')}}'" class="uk-button uk-button-danger fl-button float-right" type="button">Back</button>
					</div>					
				</form>
			</div>

		</div>	
	</div>

	<script src="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('metronic2/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
	<!--end::Base Scripts -->   
	<!--begin::Page Resources -->
	<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/forms/widgets/form-repeater.js') }}" type="text/javascript"></script>
	<!-- metronic -->
	<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>

	<script>
		function showModal(){
			UIkit.modal("#mymodal").show();
		}

		function save_master_user(formid)
	    {   
			submit_form(formid);
		}

		function check_username()
        {
          var usernm = $('#nipp').val();
          $.ajax({
                type: "GET",
                url: "{{ url('/master/check-username') }}",
                data: {usernm : usernm}, 
                cache: false,
                success: function(data){
                     if(data == 0)
                     {
                      $('#nipp').parent('div').removeClass('has-error');
                      $('#error-nipp').text('');
                      //$('#btn-submit').removeAttr('disabled', 'disabled');
                     }
                     else
                     {
                      $('#nipp').parent('div').addClass('has-error');
                      $('#error-nipp').text('Username '+usernm+' Sudah Ada !!!');
                      $('#nipp').val('');
                     }
                }
            });
        }

		$(".select2-list").select2({
			allowClear: true
		});
	
	</script>
</body>
</html>
