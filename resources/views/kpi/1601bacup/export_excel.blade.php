<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PT. Pelabuhan Tanjung Priuk</title>

<link href="templateslide/assets/css/style.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/css/imagehover/imagehover.min.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/uikit/css/uikit.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/datepicker/daterangepicker.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/datepicker/daterangepicker.css" rel="stylesheet" type="text/css">

<script src="templateslide/assets/js/jquery-1.11.1.min.js"></script>
<script src="templateslide/assets/uikit/js/uikit.js"></script>

<script src="templateslide/assets/datepicker/moment.min.js"></script>
<script src="templateslide/assets/datepicker/daterangepicker.js"></script>

<script src="templateslide/assets/js/marquee/jquery.marquee.js"></script>
<script src="templateslide/assets/js/marquee/jquery.pause.js"></script>
<script src="templateslide/assets/js/marquee/jquery.easing.min.js"></script>
<link href="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic2/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('templateslide/assets/js/datatableptkak/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('templateslide/assets/js/datatableptkak/jquery.dataTables.min.js') }}"></script>

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
					Export Excel
				</span>
			</div>
			

		<div id="mbulan" uk-modal >
	<div class="uk-modal-dialog uk-modal-body modal-lg">
	<form id="excel_export" action="/input_excel" method="POST">
		{{ csrf_field() }}
		<div style="margin-bottom:30px; text-align:center;">
			<span style="font-size:18px">Pilih Bulan dan Tahun</span>
		</div>
		<div style="height:200px; width: 100%; text-align: center;" data-simplebar data-simplebar-auto-hide="true">
			<div>
				<b>Triwulan</b>
				<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="{{ $month }}" disabled="disabled"><br>
				<select class="form-control select2-list" style="width: 30% !important;" id="months" name="months[]" required="required">
					<option value="">--Pilih Triwulan--</option>
					@foreach($months as $month)
                        <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
				</select>
			</div>
			<div>
				<b>Tahun</b>
				<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="{{ $year }}" disabled="disabled"><br>
                <select id="years" class="form-control select2-list" style="width: 30% !important;" name="years[]" required="required">
                    <option value="">--Pilih Tahun--</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
			</div>
			<div>
				<b>Pusat/Cabang</b>
				<input type="hidden" name="branchlisthidden" id="branchlisthidden" value="" disabled="disabled"><br>
                <select id="branch" class="form-control select2-list" style="width: 30% !important;" name="branch[]" required="required">
					<option value="">--Pusat/Cabang--</option>
					<option value="Pusat">Pusat</option>
					@foreach($branch_list as $pstcbg)
						<option value="{{ $pstcbg->BRANCH_OFFICE_NAME }}">{{ $pstcbg->BRANCH_OFFICE_NAME }}</option>
					@endforeach
                </select>
			</div>
		</div>
		<div class="col-md-12" style="text-align: center;">
			<button type="submit" class="uk-button uk-button-primary">Yes</button>
			<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
		</div>
	</form>
	</div>
</div>


		
		</div>
	</div>
</body>
</html>

<script>
	$(document).ready( function () {
		$('#excel_export').DataTable();
	} );

	$(".select2-list").select2({
		allowClear: true
	});

	function showModal(){
		UIkit.modal("#mymodal").show();
	}
	
	function Mbulan(){
		UIkit.modal("#mbulan").show();

	}
</script>