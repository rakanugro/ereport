<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PT. Pelabuhan Tanjung Priok</title>

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
					E-Report PT. Pelabuhan Tanjung Priok	
				</span>
				<span class="fl-menu-tool">
					<img src="{{ URL::asset('templateslide/assets/img/logo/Logo e-Report.png') }}" class="fl-logo">
					<a href="listexportdata"><button style="background-color : #FFDAB9 !important;" class="uk-button uk-button fl-button" type="button">Report</button></a>
					<input type="button" class="uk-button uk-button-primary fl-button" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
					<a href="logout"><button class="uk-button uk-button-danger fl-button" type="button">Logout</button></a>
				</span>
				<!-- <span class="fl-menu-tool">
					<input type="button" class="uk-button uk-button-primary fl-button" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
				</span> -->
			</div>	
		</div>


		<div class="fl-container">
			<div class="fl-title-page" >
				<span style="font-size:20px">				
					<img class="uk-preserve-width uk-border-circle" src="templateslide/assets/img/icon/sopReadMore.png" width="65" alt="">
					KPI	
				</span>
				<span style="float:right;margin-top:15px">
					<!-- <a href="kpi"><button class="uk-button uk-button-default fl-button" type="button">Master KPI</button></a> -->
					<!-- <button onclick="location.href = '{{ url('input_kpi')}}'" class="uk-button uk-button-primary fl-button" type="button">+</button> -->
					@if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
					<button onclick="showModalBulan()" class="uk-button uk-button-primary fl-button" type="button">+</button>
					@endif
					<!-- <button onclick="location.href = '{{ url('kpi/form_kpi')}}'" class="uk-button uk-button-primary fl-button" type="button">+</button> -->
				</span>
			</div>
			
			<div class="fl-table">
				<div class="uk-overflow-auto">
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id="kpitx_list">
						<thead>
							<tr class="fl-table-head">
								<th width="5%"></th>
								<th width="22%">Periode</th>
								<th width="22%">Cabang</th>
								<th width="20%">Divisi</th>
								<th width="15%">Sub Divisi</th>
								<th width="15%">Status</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($txkpi_list as $data)
								<tr>
									<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/i1.png') }}" width="45" alt=""></td>
									<td>{{ $data->PERIOD }} {{ $data->YEAR }}</td>
									<td>{{ $data->BRANCH_OFFICE_NAME }}</td>
									<td>{{ $data->DIVISION_NAME }}</td>
									<td>{{ $data->SUB_DIVISION_NAME }}</td>
									<td>
										@if($data->STATUS == '1')
									 		<span style="color:red">Menunggu Approval DVP</span>
									 	@elseif($data->STATUS == '2')
									 		<span style="color:red">Menunggu Approval VP</span>
									 	@elseif($data->STATUS == '3')
									 		<span style="color:green">Approved</span>
									 	@elseif($data->STATUS == '4')
											 <span style="color:red">Dikembalikan DVP/VP ({{$data->ALASAN_KEMBALIKAN}})</span>
									 	@endif
									</td>
									<td>
										<button class="uk-button uk-button-default fl-button" type="button">Action</button>
										<div uk-dropdown="mode:click">
											<ul class="uk-nav uk-dropdown-nav">
												<li><a href="txkpi/detail/form_txkpi/{{ $data->KPI_ID }}">Detail</a></li>
												@if((Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && Auth::user()->ORG_ID == $data->ORGANIZATION_STRUCTURE_ID && $data->STATUS == '1') || (Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && Auth::user()->ORG_ID == $data->ORGANIZATION_STRUCTURE_ID && $data->STATUS == '1'))
													<li><a href="javascript:;" onclick="Approval({{ $data->KPI_ID }})">Approve</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->KPI_ID }})">Kembalikan</a></li>
												@elseif((Auth::user()->ACCESS == 'VP SUB DIVISI' && Auth::user()->ORG_ID == $data->ORGANIZATION_STRUCTURE_ID && $data->STATUS == '2' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && Auth::user()->ORG_ID == $data->ORGANIZATION_STRUCTURE_ID && $data->STATUS == '2'))
													<li><a href="javascript:;" onclick="Approval({{ $data->KPI_ID }})">Approve</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->KPI_ID }})">Kembalikan</a></li>
												@elseif((Auth::user()->ACCESS == 'ADMIN SUB DIVISI' && Auth::user()->ORG_ID == $data->ORGANIZATION_STRUCTURE_ID && $data->STATUS == '3' || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && Auth::user()->ORG_ID == $data->ORGANIZATION_STRUCTURE_ID && $data->STATUS == '3'))
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->KPI_ID }})">Kembalikan</a></li>
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


	<!-- This is the modal -->
	<div id="mymodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body">
			<div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<div>
						<b>Nama</b>
						<input class="uk-input" type="text" placeholder="Masukan Nama">
					</div>
					
					<div>
						<b>Divisi</b>
						<input class="uk-input" type="text" placeholder="Masukan Divisi">
					</div>

					<div>
						<b>Indikator</b>
						<input class="uk-input" type="text" placeholder="Indikator">
					</div>

					<div>
						<b>Nilai</b>
						<input class="uk-input" type="text" placeholder="Masukan Nilai">
						<div style="padding-top:10px" align="right">
							<button class="uk-button uk-button-primary fl-button" type="button">Search</button>			
						</div>			
					</div>
				</div>
			</div>
	</div>

	<div id="mymodalbulan" uk-modal >
	<div class="uk-modal-dialog uk-modal-body modal-lg">
	<form id="form_kpi" action="/input_kpi" method="POST">
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
<div id="Approvalmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/txkpi/txkpi_approve" id="approvalForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Approval</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<input type="hidden"  id="id" name="id">
				</div>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary" id="Formsubmitapproval">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>

	<!-- Kembalikan VP -->
	<div id="kembalikanmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/txkpi/txkpi_kembalikan" id="kembalikanForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Konfirmasi Kembalikan</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<input type="hidden"  id="id1" name="id1">
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
</div>
</body>
</html>
<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>


<script>
	$(document).ready( function () {
		$('#kpitx_list').DataTable();
	} );

	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function showModalBulan(){
		UIkit.modal("#mymodalbulan").show();

	}
	function ExportExcel(){
		UIkit.modal("#exportexcel").show();

	}
	function Approval(id){
		var id = id;
		$('#id').val(id);

        UIkit.modal("#Approvalmodal").show();

	}

	function Kembalikan(id){
		var id = id;
		$('#id1').val(id);

		UIkit.modal("#kembalikanmodal").show();

	}

	$(".select2-list").select2({
		allowClear: true
	});
</script>
