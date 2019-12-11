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
					<img class="uk-preserve-width uk-border-circle" src="templateslide/assets/img/icon/sopReadMore.png" width="65" alt="">
					Input KPI
				</span>
			</div>
			
		<form id="form_kpi" action="/txkpi/kpi_save" method="POST">	
			<div class="col-md-12 fl-table">
				{{ csrf_field() }}

					<input type="hidden" name="years" id="years" value="{{ $year }}"><br>
					<input type="hidden" name="months" id="months" value="{{ $month }}"><br>	
					
					
				
				<div class="uk-overflow-auto">
				
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
						<thead>
							<tr class="fl-table-head">
								<th width="5%"></th>
								<th width="25%">Indicator Name</th>
								<th width="10%">Satuan</th>
								<th width="10%">Bobot</th>
								<th width="10%">Target</th>
								<th width="10%">Realisasi</th>
								<th width="10%">Pencapaian(%)</th>
								<th width="10%">Score</th>
								<th width="25%"></th>
							</tr>
						</thead>
						<?php $i = 0 ?>
					@foreach($kpi_list as $data)
						<input type="hidden" name="indicator_id[]" id="indicator_id[]" value="{{ $data->INDICATOR_ID }}">
						<input type="hidden" name="kpi_id[]" id="kpi_id[]" value="{{ $data->KPI_ID }}">
						<tbody>
							<tr>
								<td><img class="uk-preserve-width uk-border-circle" src="templateslide/assets/img/icon/i1.png" width="45" alt=""></td>
								<td style="background-color: #b3fff0; font-weight:bold; font-size: 18px; text-transform: uppercase;">{{ $data->PERSPECTIVE }}</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><img class="uk-preserve-width uk-border-circle" src="templateslide/assets/img/icon/i1.png" width="45" alt=""></td>
								<td style="font-weight:bold; font-size: 15px; text-transform: uppercase;">{{ $data->INDICATOR_NAME }}</td>
								<td style="font-weight:bold; font-size: 15px;">{{ $data->UNIT }}</td>
								<td style="font-weight:bold; font-size: 15px;">{{ $target_ind_list[$i] <> null ? $target_ind_list[$i]->BOBOT : 0 }}</td>
								<td style="font-weight:bold; font-size: 15px;">{{ $target_ind_list[$i] <> null ? $target_ind_list[$i]->TARGET : 0 }}</td>
								<td style="font-weight:bold; font-size: 15px;"><input type="hidden" name="realisasi[]" id="realisasi[]" value="{{ $hasil[$i] }}">{{ $hasil[$i] }}</td>
								<td style="font-weight:bold; font-size: 15px;">{{ $pencapaian_ind_list[$i] }}</td>
								<td style="font-weight:bold; font-size: 15px;">{{ $score_ind_list[$i] }}</td>
								<td></td>
							</tr>
							<thead>
								<tr class="fl-table-head">
									<th width="5%"></th>
									<th width="25%">Sub Divisi Name</th>
									<th width="25%">Sub Indicator Name</th>
									<th width="10%">Satuan</th>
									<!-- <th width="10%">Bobot</th> -->
									<!-- <th width="10%">Target</th> -->
									<th width="10%">Realisasi</th>
									<!-- <th width="10%">Pencapaian</th>
									<th width="10%">Score</th> -->
									<th width="25%"></th>
								</tr>
							</thead>
							<?php $j = 0 ?>
						<?php foreach($sub_in[$i] as $data){ ?>
						<input type="hidden" name="sub_ind_id[]" id="sub_ind_id[]" value="{{ $data->INDICATOR_ID }}">
							<tr>
								<td></td>
								<td>{{ $data->SUB_DIVISION_NAME }}</td>
								<td>{{ $data->INDICATOR_NAME }}</td>
								<td>{{ $data->UNIT }}</td>
								<td><input type="hidden" name="subrealisasi[]" id="subrealisasi[]" value="{{ $real_subind_list[$j] }}">{{ $real_subind_list[$j] }}</td>
								<td></td>
							</tr>
							<?php $j = $j+1 ?>
						<?php } ?>
						<?php $i = $i+1 ?>
						</tbody>
					@endforeach

						<tbody>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									<button class="uk-button uk-button-primary fl-button" type="submit">Simpan</button>
								</td>
								<td>
									<button class="uk-button uk-button-danger fl-button" type="button" onclick="location.href = '{{ url('txkpi')}}'">Cancel</button>
								</td>
								<td></td>
							</tr>
						</tbody>
					</table>
					
				</div>	
			</div>
		</form>
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

	function save_kpi(formid)
    {   
		submit_form(formid);
    }

	$(".select2-list").select2({
            allowClear: true
        });
</script>

</body>
</html>