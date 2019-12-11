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
				<form id="form_mst_kpi" action="/kpi/master_kpi_save" method="POST">
				{{ csrf_field() }}
					<div>
						<b>Cabang/Pusat</b>
						<input type="hidden" name="cabpuslisthidden" id="cabpuslisthidden" value="{{ $indicator }}" disabled="disabled"><br>
                        <select id="cabpus_list" class="form-control select2-list" name="cabpus_list[]" required="required">
                            <option value="Cabang" selected="selected">Cabang</option>
							<option value="Pusat">Pusat</option>
                        </select>
					</div>
					<div>
						<b>Prespective</b><br>
						<input class="col-md-6 uk-input" type="text" name="prespective" id="prespective" value=""><br>
					</div>
					<div>
						<b>Indicator</b>
						<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="{{ $indicator }}" disabled="disabled"><br>
                        <select id="indicator_list" class="form-control select2-list" name="indicator_list[]" required="required" multiple>
                            <option value="">--Indikator--</option>
                            @foreach($indicator_list as $indicator)
                                <option value="{{ $indicator['INDICATOR_ID'] }}">{{ $indicator['INDICATOR_NAME'] }}</option>
                            @endforeach
                        </select>
					</div>
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

	$('#branch_office').on('change', function(){
        var id_branch = $(this).val();
        $.get('{{ url('getAjax/division') }}/'+id_branch, function (data) {
            $('#division').empty();
            $('#division').append('<option value="">--Division--</option>');
            $.each(data, function (index, element) {
                $('#division').append('<option value="'+ element.DIVISION_ID +'">'+ element.DIVISION_NAME +'</option>');
            });
        });
    });

	$('#division').on('change', function(){
        var id_branch = $(this).val();
        $.get('{{ url('getAjax/subdivision') }}/'+id_branch, function (data) {
            $('#subdivision').empty();
            $('#subdivision').append('<option value="">--Sub Division--</option>');
            $.each(data, function (index, element) {
                $('#subdivision').append('<option value="'+ element.SUB_DIVISION_ID +'">'+ element.SUB_DIVISION_NAME +'</option>');
            });
        });
    });
</script>
	
</body>
</html>
