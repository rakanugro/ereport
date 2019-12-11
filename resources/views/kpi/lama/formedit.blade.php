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
					Master KPI
				</span>
			</div>
			
			<div class="fl-table">
				<form id="form_mst_kpi" action="/kpi/master_kpi_edit" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="id" id="id" value="{{ $id }}">
					<div>
						<b>Year</b>
						<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="{{ $year }}" disabled="disabled"><br>
                        <select id="years" class="form-control select2-list" name="years[]">
                            <option value="">--Pilih Tahun--</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ $selectedyear == $year ? 'selected="selected"' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
					<div>
					<div>
						<b>Organization Structure</b>
						<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="{{ $organize_struct }}" disabled="disabled"><br>
						<select class="form-control select2-list" id="organize_struct_list" name="organize_struct_list[]">
							<option value="">--Cabang-Divisi-Sub Divisi--</option>
							@foreach($organize_struct_list as $os)
								<option value="{{ $os->ORGANIZATION_STRUCTURE_ID }}" {{ $selectedos == $os->ORGANIZATION_STRUCTURE_ID ? 'selected="selected"' : '' }}>{{ $os->BRANCH_OFFICE_NAME }}-{{ $os->DIVISION_NAME }}-{{ $os->SUB_DIVISION_NAME }}</option>
							@endforeach
						</select>
					<div>
						<b>Indicator</b>
						<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="{{ $indicator }}" disabled="disabled"><br>
                        <select id="indicator_list" class="form-control select2-list" name="indicator_list[]">
                            <option value="">--Pilih Indikator--</option>
                            @foreach($indicator_list as $indicator)
                                <option value="{{ $indicator['INDICATOR_ID'] }}" {{ $selectedindicator == $indicator['INDICATOR_ID'] ? 'selected="selected"' : '' }}>{{ $indicator['INDICATOR_NAME'] }}</option>
                            @endforeach
                        </select>
					<div>
					<div>
						<b>STATUS</b>
						<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="{{ $status }}" disabled="disabled"><br>
						<select class="form-control select2-list" id="status" name="status[]">
							<option value="">--Pilih Status--</option>
							<option value="Y" {{ $selectedstatus == 'Y' ? 'selected="selected"' : '' }}>ACTIVE</option>
							<option value="N" {{ $selectedstatus == 'N' ? 'selected="selected"' : '' }}>INACTIVE</option>
						</select>
					<div>
					<div>
						<br>
					</div>
						

					<div>
						<button class="uk-button uk-button-primary fl-button" onclick="save_mst_kpi(this.form.id);return false;">
							<i class="fa fa-plus"></i>&nbsp;Save
						</button>
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
	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function save_mst_kpi(formid)
    {   
		submit_form(formid);
    }

	$(".select2-list").select2({
            allowClear: true
        });
	function plusplus(){
		var a = $("#exampleSelect11 option:selected").val();
		var b = $("#exampleSelect1 option:selected").val();
		var saatini = $("#formula").val();
		$("#formula").val(saatini+" "+b+" "+a);
	}
</script>
	
</body>
</html>
