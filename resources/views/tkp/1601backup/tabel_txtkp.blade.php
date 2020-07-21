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

	<script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
	<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
	<link href="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('metronic2/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="{{ URL::asset('templateslide/assets/js/datatableptkak/css/jquery.dataTables.min.css') }}" type="text/css">
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
					E-Reporting PT. Pelabuhan Tanjung Priuk	
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
					Tingkat Kesehatan Perusahaan	
				</span>
				<span style="float:right;margin-top:15px">
					<!-- <a href="tkp"><button class="uk-button uk-button-default fl-button" type="button">Master TKP</button></a> -->
					@if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
					<button onclick="showModaltahun()" class="uk-button uk-button-primary fl-button" type="button">+</button>
					@endif
					<!-- <button onclick="location.href = '{{ url('tkp/form_tkp')}}'" class="uk-button uk-button-primary fl-button" type="button">+</button> -->
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
				<div class="uk-overflow-auto">
					
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id="txtkp_list">
						<thead>
							<tr class="fl-table-head">
								<th width="5%"></th>
								<th width="30%">Keterangan</th>
								<th width="20%">Kriteria</th>
								<th width="20%">Status</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($txtkp_list as $data)
								<tr>
									<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/i1.png') }}" width="45" alt=""></td>
									<td>Tingkat Kesehatan Perusahaan Tahun {{ $data->YEAR }}</td>
									<td>@if($data->TOTAL_KRITERIA > 95)
											<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AAA</span>
										@elseif($data->TOTAL_KRITERIA <= 95 && $data->TOTAL_KRITERIA > 80)
											<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AA</span>
										@elseif($data->TOTAL_KRITERIA <= 80 && $data->TOTAL_KRITERIA > 65)
											<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A</span>
										@elseif($data->TOTAL_KRITERIA <= 65 && $data->TOTAL_KRITERIA > 50)
											<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BBB</span>
										@elseif($data->TOTAL_KRITERIA <= 50 && $data->TOTAL_KRITERIA > 40)
											<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BB</span>
										@elseif($data->TOTAL_KRITERIA <= 40 && $data->TOTAL_KRITERIA > 30)
											<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B</span>
										@elseif($data->TOTAL_KRITERIA <= 30 && $data->TOTAL_KRITERIA > 20)
											<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCC</span>
										@elseif($data->TOTAL_KRITERIA <= 20 && $data->TOTAL_KRITERIA > 10)
											<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CC</span>
										@elseif($data->TOTAL_KRITERIA <= 10)
											<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C</span>
										@endif()
									</td>
									<td>@if($data->APPROVED_1_STATUS == '0' && $data->APPROVED_2_STATUS == '0')
									<span style="color:red">Menenunggu Approval DVP</span>
									@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '0')
									<span style="color:red">Menenunggu Approval VP</span>
									@elseif($data->APPROVED_1_STATUS == '2' && $data->APPROVED_2_STATUS == '2')
									<span style="color:red">Dikembalikan DVP/VP ({{$data->ALASAN_KEMBALIKAN}})</span>
									@else
									<span style="color:green">Approved</span>
									@endif</td>
									<td>
										<button class="uk-button uk-button-default fl-button" type="button">Action</button>
										<div uk-dropdown="mode:click">
											<ul class="uk-nav uk-dropdown-nav">
												@if(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
													@if($data->APPROVED_1_STATUS == '0' && $data->APPROVED_2_STATUS == '0')
													<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
													@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '0')
													<li><a href="javascript:;" onclick="Approvalvp({{$data->TING_KES_PER_ID}})">Approval</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{$data->TING_KES_PER_ID}})">Kembalikan</a></li>
													<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
													@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '1')
													<li><a href="javascript:;" onclick="Kembalikan({{$data->TING_KES_PER_ID}})">Kembalikan</a></li>
													<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
													@else
													<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
													@endif
												@elseif(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
													@if($data->APPROVED_1_STATUS == '0' && $data->APPROVED_2_STATUS == '0')
													<li><a href="javascript:;" onclick="Approvaldvp({{$data->TING_KES_PER_ID}})">Approval</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{$data->TING_KES_PER_ID}})">Kembalikan</a></li>
													<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
													@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '0')
													<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{$data->TING_KES_PER_ID}})">Kembalikan</a></li>
													@else
													<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
													@endif
												@elseif(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
													@if($data->APPROVED_1_STATUS == '0' && $data->APPROVED_2_STATUS == '0')
													<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
													@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '0')
													<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
													@elseif($data->APPROVED_1_STATUS == '1' && $data->APPROVED_2_STATUS == '1')
													<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{$data->TING_KES_PER_ID}})">Kembalikan</a></li>
													@else
													<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
													@endif
												@else
												<li><a href="/txtkp/preview/{{$data->TING_KES_PER_ID}}">Detail</a></li>
												@endif
											</ul>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>	
			</div>

		</div>	
	</div>

	<div id="mymodaltahun" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form id="form_txtkp" action="/input_tkp" method="POST">
				{{ csrf_field() }}
				<div style="margin-bottom:30px; text-align:center;">
					<span style="font-size:18px">Pilih Tahun</span>
				</div>
				<div style="height:80px; width: 100%;" data-simplebar data-simplebar-auto-hide="true">
					<div class="col-md-12" style="text-align: center;">
						<label class="">
							Tahun:
						</label>
						<select id="years" class="form-control select2-list" style="width: 30% !important;" name="years" required="required">
							<option value="">--Pilih Tahun--</option>
							@foreach($years as $year)
							<option value="{{ $year }}">{{ $year }}</option>
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
	<div id="Approvaldvpmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/txtkp/approvaldvptxtkp" id="approvaldvpForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Approval</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<input type="hidden" id="id" name="id">
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary" id="Formsubmitapprovaldvp">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>

	<!-- Aproval VP -->
	<div id="Approvalvpmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/txtkp/approvalvptxtkp" id="approvalvpForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Approval</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<input type="hidden"  id="id1" name="id1">
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary" id="Formsubmitapprovalvp">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>

	<!-- Kembalikan VP -->
	<div id="kembalikanmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/txtkp/kembalikantxtkp" id="kembalikanForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Kembalikan</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<input type="hidden"  id="id2" name="id2">
					<div class="col-lg-12">
						<label class="">
							Alasan:
						</label>
						<textarea class="form-control m-input" name="alasan" id="alasan" maxlength="40" required></textarea>
					</div>
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary" id="Formsubmitkembalikan">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>
</body>
</html>
<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script>
	$(document).ready( function () {
		$('#txtkp_list').DataTable();
	} );

	function showModaltahun(){
		UIkit.modal("#mymodaltahun").show();
	}

	function Approvaldvp(id){
		var id = id;
		var url = '{{url('/txtkp/getmastertxtkp')}}';
		
		$.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#id').val(data.HEADER_TING_KES_PER_ID);

            UIkit.modal("#Approvaldvpmodal").show();
        }) 

	}

	function Approvalvp(id){
		var id = id;
		var url = '{{url('/txtkp/getmastertxtkp')}}';

		$.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#id1').val(data.HEADER_TING_KES_PER_ID);

            UIkit.modal("#Approvalvpmodal").show();
        }) 

	}

	function Kembalikan(id){
		var id = id;
		var url = '{{url('/txtkp/getmastertxtkp')}}';

		$.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#id2').val(data.HEADER_TING_KES_PER_ID);

            UIkit.modal("#kembalikanmodal").show();
        }) 

	}

	$(".select2-list").select2({
		allowClear: true
	});
</script>
