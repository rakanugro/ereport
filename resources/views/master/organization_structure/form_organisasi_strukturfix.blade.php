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
	<script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

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
					Master Struktur Organisasi
				</span>
				<span style="float:right;margin-top:15px">
					<a href="javascript:;" onclick="Direcotaratmodalshow();"><button class="uk-button uk-button-primary fl-button" type="button">+ Master Directorat</button></a>
					<a href="javascript:;" onclick="Branchofficemodalshow();"><button class="uk-button uk-button-primary fl-button" type="button">+ Master Branch Office</button></a>
					<a href="javascript:;" onclick="Divisimodalshow();"><button class="uk-button uk-button-primary fl-button" type="button">+ Master Divisi</button></a>
					<a href="javascript:;" onclick="Subdivisimodalshow();"><button class="uk-button uk-button-primary fl-button" type="button">+ Master Sub Divisi</button></a>
				</span>
				<span>
					@if(session('error'))
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						{{ session('error') }}
					</div>
					@endif
				</span>
			</div>

			<div class="fl-table">
				<form id="form_blade" action="/master/organization_structure_save" method="POST">
					{{ csrf_field() }}
					<div class="form-group m-form__group row">
						<div class="col-lg-6">
							<label>
								Directorate:
							</label>
							<select class="form-control select2-list" id="directorat" name="directorat" onchange="IsCabang(this.value);" required>
								<option value="">--Directorate--</option>
								@foreach($directorat as $data)
								<option value="{{ $data->DIRECTORATE_ID }}-{{ $data->IS_CABANG }}">{{ $data->DIRECTORATE_NAME }}</option>
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
								<option value="{{ $data->BRANCH_OFFICE_ID }}">{{ $data->BRANCH_OFFICE_NAME }}</option>
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
								<option value="{{ $data->DIVISION_ID }}">{{ $data->DIVISION_NAME }}</option>
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
								<option value="{{ $data->SUB_DIVISION_ID }}">{{ $data->SUB_DIVISION_NAME }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div>
						<br>
					</div>
					<div>
						<button class="uk-button uk-button-primary fl-button" type="submit">
							<i class="fa fa-plus"></i>&nbsp;Save
						</button>
							<button onclick="location.href = '{{ url('master/organization_structurex')}}'" class="uk-button uk-button-danger fl-button float-right" type="button">Back</button>
					</div>					
				</form>
			</div>

		</div>	
	</div>

	<div id="direcotaratmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/master/list_directorate_save" id="direcotaratForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">ADD Master Directorate</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<div class="col-lg-6">
						<label class="">
							Directorate Code:
						</label>
						<input class="form-control m-input" name="directorate_code" id="directorate_code" class="uk-input uk-child-width-1-2" type="text" onchange="check_code_direktorat()" placeholder="Directorate Code" required>
						<div class="help-block with-errors" style="color:red;" id="error-directorate_code"></div>
						@if ($errors->has('directorate_code'))
						<span class="help-block">
							<strong>{{ $errors->first('directorate_code') }}</strong>
						</span>
						@endif
					</div>
					<div class="col-lg-6">
						<label class="">
							Directorate Name:
						</label>
						<input class="form-control m-input" name="directorate_name" id="directorate_name" type="text" placeholder="Directorate Name" required>
					</div>
					<div class="col-lg-6">
						<label class="">
							Tipe Directorat:
						</label>
						<select class="form-control select2-list" style="width: 80% !important;" name="is_cabang" id="is_cabang">
							<option value="">--Pilih Tipe Directorat--</option>
							<option value="0">PUSAT</option>
							<option value="1">CABANG</option>
						</select>
					</div>
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>

	<div id="branchofficemodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/master/list_branchoffice_save" id="branchofficeForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">ADD Master Branch Office</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<div class="col-lg-6">
						<label class="">
							Branch Office Code:
						</label>
						<input class="form-control m-input" name="branchoffice_code" id="branchoffice_code" class="uk-input uk-child-width-1-2" type="text" onchange="check_code_branchoffice()" placeholder="Directorate Code" required>
						<div class="help-block with-errors" style="color:red;" id="error-branchoffice_code"></div>
						@if ($errors->has('branchoffice_code'))
						<span class="help-block">
							<strong>{{ $errors->first('branchoffice_code') }}</strong>
						</span>
						@endif
					</div>
					<div class="col-lg-6">
						<label class="">
							Branch Office Name:
						</label>
						<input class="form-control m-input" name="branchoffice_name" id="branchoffice_name" type="text" placeholder="Branch Office Name" required>
					</div>
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>

	<div id="divisimodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/master/list_divisi_save" id="divisiForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">ADD Master Division</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<div class="col-lg-6">
						<label class="">
							Division Code:
						</label>
						<input class="form-control m-input" name="division_code" id="division_code" class="uk-input uk-child-width-1-2" type="text" onchange="check_code_divisi()" placeholder="Division Code" required>
						<div class="help-block with-errors" style="color:red;" id="error-division_code"></div>
						@if ($errors->has('division_code'))
						<span class="help-block">
							<strong>{{ $errors->first('division_code') }}</strong>
						</span>
						@endif
					</div>
					<div class="col-lg-6">
						<label class="">
							Division Name:
						</label>
						<input class="form-control m-input" name="division_name" id="division_name" type="text" placeholder="Division Name" required>
					</div>
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>

	<div id="subdivisimodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/master/list_subdivisi_save" id="subdivisiForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">ADD Master Sub Divisi</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<div class="col-lg-6">
						<label class="">
							Sub Division Code:
						</label>
						<input class="form-control m-input" name="sub_division_code" id="sub_division_code" class="uk-input uk-child-width-1-2" type="text" onchange="check_code_subdivisi()" placeholder="Sub Divisi Code" required>
						<div class="help-block with-errors" style="color:red;" id="error-sub_division_code"></div>
						@if ($errors->has('sub_division_code'))
						<span class="help-block">
							<strong>{{ $errors->first('sub_division_code') }}</strong>
						</span>
						@endif
					</div>
					<div class="col-lg-6">
						<label class="">
							Sub Division Name:
						</label>
						<input class="form-control m-input" name="sub_division_name" id="sub_division_name" type="text" placeholder="Sub Divisi Name" required>
					</div>
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
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

	function Direcotaratmodalshow(){
		UIkit.modal("#direcotaratmodal").show();
	}

	function Branchofficemodalshow(){
		UIkit.modal("#branchofficemodal").show();
	}

	function Divisimodalshow(){
		UIkit.modal("#divisimodal").show();
	}

	function Subdivisimodalshow(){
		UIkit.modal("#subdivisimodal").show();
	}

	function save_organization_structure(formid)
	{   
		submit_form(formid);
	}

	$(".select2-list").select2({
		allowClear: true
	});

	function check_code_direktorat()
	{
		var codedir = $('#directorate_code').val();
		$.ajax({
			type: "GET",
			url: "{{ url('/master/check-codedirectorat') }}",
			data: {codedir : codedir}, 
			cache: false,
			success: function(data){
				if(data == 0)
				{
					$('#directorate_code').parent('div').removeClass('has-error');
					$('#error-directorate_code').text('');
                      //$('#btn-submit').removeAttr('disabled', 'disabled');
                  }
                  else
                  {
                  	$('#directorate_code').parent('div').addClass('has-error');
                  	$('#error-directorate_code').text('Code Directorate '+codedir+' Sudah Ada !!!');
                  	$('#directorate_code').val('');
                  }
              }
          });
	}


	function check_code_branchoffice()
	{
		var codebranch = $('#branchoffice_code').val();
		$.ajax({
			type: "GET",
			url: "{{ url('/master/check-branchoffice_code') }}",
			data: {codebranch : codebranch}, 
			cache: false,
			success: function(data){
				if(data == 0)
				{
					$('#branchoffice_code').parent('div').removeClass('has-error');
					$('#error-branchoffice_code').text('');
                      //$('#btn-submit').removeAttr('disabled', 'disabled');
                  }
                  else
                  {
                  	$('#branchoffice_code').parent('div').addClass('has-error');
                  	$('#error-branchoffice_code').text('Code Branch Office '+codebranch+' Sudah Ada !!!');
                  	$('#branchoffice_code').val('');
                  }
              }
          });
	}

	function check_code_divisi()
	{
		var codedivision = $('#division_code').val();
		$.ajax({
			type: "GET",
			url: "{{ url('/master/check-division_code') }}",
			data: {codedivision : codedivision}, 
			cache: false,
			success: function(data){
				if(data == 0)
				{
					$('#division_code').parent('div').removeClass('has-error');
					$('#error-division_code').text('');
                      //$('#btn-submit').removeAttr('disabled', 'disabled');
                  }
                  else
                  {
                  	$('#division_code').parent('div').addClass('has-error');
                  	$('#error-division_code').text('Code Division '+codebranch+' Sudah Ada !!!');
                  	$('#division_code').val('');
                  }
              }
          });
	}
	
	function check_code_subdivisi()
	{
		var codesubdivision = $('#sub_division_code').val();
		$.ajax({
			type: "GET",
			url: "{{ url('/master/check-subdivision_code') }}",
			data: {codesubdivision : codesubdivision}, 
			cache: false,
			success: function(data){
				if(data == 0)
				{
					$('#sub_division_code').parent('div').removeClass('has-error');
					$('#error-sub_division_code').text('');
                      //$('#btn-submit').removeAttr('disabled', 'disabled');
                  }
                  else
                  {
                  	$('#sub_division_code').parent('div').addClass('has-error');
                  	$('#error-sub_division_code').text('Code Sub Division '+codesubdivision+' Sudah Ada !!!');
                  	$('#sub_division_code').val('');
                  }
              }
          });
	}

	 // $('#directorat').on('change', function(){
  //       var id_gabungan = $(this).val();
  //       var pisah = id_gabungan.split('-');
		// var iddir = pisah[0];
		// var iscbg = pisah[1];

		// if (iscbg == 1) {

		// 	$.get('{{ url('getAjax/branchoffice') }}/'+iddir, function (data) {
		// 		$('#branchoffice').empty();
		// 		$('#branchoffice').append('<option va lue="">Pilih Branch Office </option>');
		// 		$.each(data, function (index, element) {
		// 			$('#branchoffice').append('<option class="form-control select2-list" value="'+ element.id_regency +'">'+ element.name_regency +'</option>');
		// 		});
		// 		$("#branchoffice").select2({
		// 			allowClear: true
		// 		});
		// 	});
		// 	document.getElementById('branchoffice').disabled = false;
		// 	document.getElementById('divisi').disabled = true;
		// 	document.getElementById('divisi').disableValidation = true;
		// 	$('#divisi').val(null).trigger('change');
		// } else {
		// 	$.get('{{ url('getAjax/divisi') }}/'+iddir, function (data) {
		// 		$('#divisi').empty();
		// 		$('#divisi').append('<option value="">Pilih Divisi</option>');
		// 		$.each(data, function (index, element) {
		// 			$('#divisi').append('<option value="'+ element.id_regency +'">'+ element.name_regency +'</option>');
		// 		});
		// 		$("#divisi").select2({
		// 			allowClear: true
		// 		});
		// 	});

		// 	document.getElementById('divisi').disabled = false;
		// 	document.getElementById('branchoffice').disabled = true;
		// 	document.getElementById('branchoffice').disableValidation = true;
		// 	$('#branchoffice').val(null).trigger('change');
		// }

  //   });


</script>


