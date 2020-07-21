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
					Master Indicator
				</span>
			</div>
			
			<div class="fl-table">
				<form id="form_indicator" action="/master/indicator_save" method="POST">
				{{ csrf_field() }}
					<div>
						<b>Sub Division</b>
						<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="{{ $sub_division }}" disabled="disabled"><br>
                        <select id="sub_division_list" class="form-control select2-list" name="sub_division_list[]" data-validation="required" data-validation-error-msg="Silahkan Pilih Sub Division">
                            <option value="">--Sub Division--</option>
                            @foreach($sub_division_list as $subdivision)
                                <option value="{{ $subdivision->SUB_DIVISION_ID }}">{{ $subdivision->BRANCH_OFFICE_NAME }} {{ $subdivision->SUB_DIVISION_NAME }}</option>
                            @endforeach
                        </select>
					<div>
					<div>
						<b>Indicator Name</b>
						<input name="indicator_name" class="uk-input uk-child-width-1-2" type="text" value="" placeholder="Indicator Name" required>
					</div>
					<div>
						<b>Inputable</b>
						<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="" disabled="disabled"><br>
                        <select id="inputable" class="form-control select2-list" name="inputable[]" data-validation="required" data-validation-error-msg="Pilih">
                            <option value="Y" selected="selected">Inputable</option>
                            <option value="N">Not Inputable</option>
                        </select>
					</div>
					<div>
						<b>Sub Division Pengisi</b>
						<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="{{ $sub_division }}" disabled="disabled"><br>
                        <select id="sub_division_pengisi_list" class="form-control select2-list" name="sub_division_pengisi_list[]" data-validation="required" data-validation-error-msg="Silahkan Pilih Sub Division">
                            <option value="">--Sub Division--</option>
                            @foreach($sub_division_list as $subdivision)
                                <option value="{{ $subdivision->SUB_DIVISION_ID }}">{{ $subdivision->SUB_DIVISION_NAME }}</option>
                            @endforeach
                        </select>
					<div>
					<div>
						<b>Satuan</b>
						<input name="unit" class="uk-input uk-child-width-1-2" type="text" value="" placeholder="Satuan" required>
					</div>
					<div>
						<b>Polaritas</b>
						<input type="hidden" name="polaritashidden" id="polaritashidden" value="" disabled="disabled"><br>
                        <select id="polaritas" class="form-control select2-list" name="polaritas[]" data-validation="required" data-validation-error-msg="Pilih">
                            <option value="+" selected="selected">+</option>
                            <option value="-">-</option>
                        </select>
					</div>
					<div>
						<b>Periode Pengisian</b>
						<input type="hidden" name="periodepengisianhidden" id="periodepengisianhidden" value="" disabled="disabled"><br>
                        <select id="periodepengisian" class="form-control select2-list" name="periodepengisian[]" data-validation="required" data-validation-error-msg="Pilih">
                            <option value="Bulanan" selected="selected">Bulanan</option>
                            <option value="Triwulanan">Triwulanan</option>
                            <option value="Tahunan">Tahunan</option>
                        </select>
					</div>
					<div>
						<b>Min. Score</b>
						<input name="minscore" class="uk-input uk-child-width-1-2" type="number" value="" placeholder="Min. Score">
					</div>
					<div>
						<b>Max. Score</b>
						<input name="maxscore" class="uk-input uk-child-width-1-2" type="number" value="" placeholder="Max. Score">
					</div>
					<div>
						<b>Tipe TKP</b>
						<input type="hidden" name="tipetkphidden" id="tipetkphidden" value="" disabled="disabled"><br>
                        <select id="tipetkp" class="form-control select2-list" name="tipetkp[]">
                        	<option value="" selected="selected">--Pilih--</option>
                            <option value="ROE">ROE</option>
                            <option value="ROI">ROI</option>
							<option value="Cash Ratio">Cash Ratio</option>
							<option value="Current Ratio">Current Ratio</option>
							<option value="Collection Period">Collection Period</option>
							<option value="Inventory Turnover">Inventory Turnover</option>
							<option value="TMS Terhadap TA">TMS Terhadap TA</option>
							<option value="TATO">TATO</option>
                        </select>
					</div>
					<div>
						<b>Formula</b>
						<input id="formula" name="formula" class="uk-input uk-child-width-1-2"  value="" type="text" placeholder="Formula">
						<div style="padding-top: 10px;">
							<div class="form-group  m-form__group row">
								<div data-repeater-list="" class="col-lg-12">
									<div data-repeater-item class="row m--margin-bottom-10">
										<div class="col-lg-5">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="la la-phone"></i>
												</span>
												<select class="form-control m-input" id="exampleSelect11">
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
													<i class="la la-envelope"></i>
												</span>
												<select class="form-control select2-list" id="exampleSelect1">
													<option>
														--Indicator--
													</option>
													@foreach($indicator_list as $indicator)
														<option value="{{ $indicator['INDICATOR_ID'] }}">{{ $indicator['INDICATOR_NAME'] }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="btn btn btn-danger m-btn m-btn--icon">
												<span onclick="clearformula();">
													<i class="la la-remove"></i>
													<span>
														 Clear Formula
													</span>
												</span>
											</div>
											<div class="btn btn btn-primary m-btn m-btn--icon">
												<span onclick="plusplus();">
													<i class="la la-plus"></i>
													<span>
														Add
													</span>
												</span>
											</div>
											<div class="btn btn btn-success m-btn m-btn--icon">
												<span onclick="average();">
													<i class="la la-plus"></i>
													<span>
														Rata-rata
													</span>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div>
						<br>
					</div>
						

					<div>
						<button class="uk-button uk-button-primary fl-button" onclick="save_indicator(this.form.id);return false;">
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
	$(document).ready(function(){
		$('#sub_division_list').on('select2:select', function (e) {
	    	var value = $('#sub_division_list').val();
	    	$('#sub_division_pengisi_list').val(value);
	    	$('#sub_division_pengisi_list').select2().trigger('change');
		});
	});

	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function save_indicator(formid)
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
		if(saatini.includes(b)){
			alert('Sub Indicator telah Ada.');
		}else{
			$("#formula").val(saatini+" "+a+" "+b);
		}
	}

	function clearformula() {
		document.getElementById("formula").value = "";
	}

	function average(){
		var saatini = $("#formula").val();
		// var a =  saatini.split('');
		// var b = a[0];
		// var c = a.splice(1);
		// var d = replace(/,/g, '');
		// alert(d);
		var gabung = saatini.split(/[^0-9\.]+/);
		var a = gabung.length;
		var fixcount = a - 1;
		$("#formula").val("("+saatini+" "+")"+":"+fixcount);
	}
	
</script>
<script>
    $(".readonly").keydown(function(e){
        e.preventDefault();
    });
</script>
	
</body>
</html>
