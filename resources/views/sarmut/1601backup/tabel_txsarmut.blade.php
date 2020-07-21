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

<script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>
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
					Sasaran Mutu	
				</span>
				<span style="float:right;margin-top:15px">
					<!-- <a href="sarmut"><button class="uk-button uk-button-default fl-button" type="button">Master Sasaran Mutu</button></a> -->
					<!-- <button onclick="location.href = '{{ url('input_sarmut')}}'" class="uk-button uk-button-primary fl-button" type="button">+</button> -->
					@if(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP SUB DIVISI')
					<button onclick="location.href = '{{ url('txsarmut')}}'" class="uk-button uk-button-success fl-button" type="button">List</button>
					<button class="uk-button uk-button-default fl-button" type="button" onclick="showModalfilter()">Filter</button>
					@elseif(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'ADMIN SUB DIVISI')
					<button onclick="showModalBulan()" class="uk-button uk-button-primary fl-button" type="button">+</button>
					@endif
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
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" id="sarmuttx_list">
						<thead>
							<tr class="fl-table-head">
								<th width="5%"></th>
								<th width="22%">Periode</th>
								<th width="22%">Cabang</th>
								<th width="20%">Divisi</th>
								<th width="15%">Sub Divisi</th>
								<th width="15%">Percentage(%)</th>
								<th width="15%">Status</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($txsarmut_list as $data)
								<tr>
									<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/i1.png') }}" width="45" alt=""></td>
									<td>{{ $data->MONTH }} {{ $data->YEAR }}</td>
									<td>{{ $data->BRANCH_OFFICE_NAME }}</td>
									<td>{{ $data->DIVISION_NAME }}</td>
									<td>{{ $data->SUB_DIVISION_NAME }}</td>
									<td style="text-align: center !important;">{{ $data->PERCENTAGE }} %</td>
									<td>
										@if($data->STATUS == '1')
									 		<span style="color:red">Menunggu Approval DVP/DGM</span>
									 	@elseif($data->STATUS == '2')
									 		<span style="color:red">Menunggu Approval VP/GM</span>
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
												<li><a href="/txsarmut/detail/form_txsarmut/{{ $data->SASARAN_MUTU_ID }}">Detail</a></li>
												<!-- <li><a href="/{{ $data->SASARAN_MUTU_ID }}">Delete</a></li> -->
												@if((Auth::user()->ACCESS == 'DVP SUB DIVISI' && Auth::user()->ORG_ID == $data->ORGANIZATION_STRUCTURE_ID && $data->STATUS == '1' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && Auth::user()->ORG_ID == $data->ORGANIZATION_STRUCTURE_ID && $data->STATUS == '1'))
													<li><a href="javascript:;" onclick="Approval({{ $data->SASARAN_MUTU_ID }})">Approve</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->SASARAN_MUTU_ID }})">Kembalikan</a></li>
												@elseif((Auth::user()->ACCESS == 'VP SUB DIVISI' && $data->STATUS == '2' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '2'))
													<li><a href="javascript:;" onclick="Approval({{ $data->SASARAN_MUTU_ID }})">Approve</a></li>
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->SASARAN_MUTU_ID }})">Kembalikan</a></li>
												@elseif((Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '1'))
													<li><a href="/txsarmut/edit/form_txsarmut/{{ $data->SASARAN_MUTU_ID }}">Edit</a></li>
												@elseif((Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && $data->STATUS == '3'))
													<li><a href="javascript:;" onclick="Kembalikan({{ $data->SASARAN_MUTU_ID }})">Kembalikan</a></li>
												@elseif((Auth::user()->ACCESS == 'ADMIN SUB DIVISI' && Auth::user()->ORG_ID == $data->ORGANIZATION_STRUCTURE_ID && ($data->STATUS == '1' || $data->STATUS == '4') || Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' && Auth::user()->ORG_ID == $data->ORGANIZATION_STRUCTURE_ID && ($data->STATUS == '1' ||  $data->STATUS == '4')))
													<li><a href="/txsarmut/edit/form_txsarmut/{{ $data->SASARAN_MUTU_ID }}">Edit</a></li>
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
	<form id="form_sarmut" action="/input_sarmut" method="POST">
		{{ csrf_field() }}
		<div style="margin-bottom:30px; text-align:center;">
			<span style="font-size:18px">Pilih Bulan dan Tahun</span>
		</div>
		<div style="height:150px; width: 100%;" data-simplebar data-simplebar-auto-hide="true">
			<div class="col-lg-12" style="text-align: center;">
				<b>Bulan</b>
				<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="{{ $month }}" disabled="disabled"><br>
				<!-- <input type="text" name="bulan" id="bulan" disabled="disabled"><br> -->
				<select class="form-control select2-list" id="months" name="months[]" style="width: 30% !important;" required="required">
					<option value="">--Pilih Bulan--</option>
					@foreach($months as $month)
                        <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
				</select>
			</div>
			<div class="col-lg-12" style="text-align: center;">
				<b>Tahun</b>
				<input type="hidden" name="subdivisionlisthidden" id="subdivisionlisthidden" value="{{ $year }}" disabled="disabled"><br>
                <select id="years" class="form-control select2-list" name="years[]" style="width: 30% !important;" required="required">
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

<div id="Approvalmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/txsarmut/txsarmut_approve" id="approvalForm" method="post">
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
					<button type="submit" class="uk-button uk-button-primary" id="Formsubmitapproval">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>

	<!-- Kembalikan VP -->
	<div id="kembalikanmodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="/txsarmut/txsarmut_kembalikan" id="kembalikanForm" method="post">
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

	<div id="FilterModal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<!-- <form action="" id="filterForm" method="get"> -->
				<div style="margin-bottom:30px; text-align:center;">
					<span style="font-size:18px">Pilih Divisi / Departement</span>
				</div>
				<div style="height:80px; width: 100%;" data-simplebar data-simplebar-auto-hide="true">
					<div class="col-lg-12" style="text-align: center;">
						<b>Organization Structure</b>
						<select style="width: 60% !important;" class="form-control select2-list" id="organize_struct_listptkak" name="organize_struct_listptkak" required="required">
							<option value="">--Direktorat-Cabang-Divisi-Sub Divisi--</option>
							@foreach($organize_struct_list as $org)
							<option value="{{ $org->SUB_DIVISION_ID }}">{{ $org->SUB_DIVISION_NAME }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary" id="filterFormsubmit">Yes</button>
					<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
				</div>
				<!-- </form> -->
			</div>
		</div>

</body>

</html>

<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>


<script type="text/javascript">
	$(document).ready( function () {
		$('#sarmuttx_list').DataTable();
	} );

	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function showModalfilter(){
		UIkit.modal("#FilterModal").show();

	}
	function ExportExcel(){
		UIkit.modal("#exportexcel").show();

	}

	function formSubmit()
	{
		var sYear = $('#years').val();
		var sMonth = $('#months').val();
		// console.log(sYear);
		'<%Session["MONTH_SARMUT"] = "' + sMonth + '"; %>';
		
		setCookie('MONTH_SARMUT', sMonth ,1);
		setCookie('YEAR_SARMUT', sYear ,1);
		var url = '{{url('/input_sarmut')}}/';
		window.location.assign(url);
	}

	function setCookie(cname, cvalue, exdays) {
	  var d = new Date();
	  d.setTime(d.getTime() + (exdays*24*60*60*1000));
	  var expires = "expires="+ d.toUTCString();
	  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	function showModalBulan(){
		UIkit.modal("#mymodalbulan").show();

	}

	function Approval(id){
		var id = id;
		$('#id1').val(id);

        UIkit.modal("#Approvalmodal").show();

	}

	function Kembalikan(id){
		var id = id;
		$('#id2').val(id);
		// alert(id);
        UIkit.modal("#kembalikanmodal").show();

	}

	$(".select2-list").select2({
		allowClear: true
	});

	$('#filterFormsubmit').click(function pass_cek(){
		var id = $('#organize_struct_listptkak').val();          

		window.location="{{ url('/txsarmutfilter') }}" + "/" + id; 
		setTimeout(function(){
			window.location="{{ url('/txsarmutfilter') }}" + "/" + id;  
		},900000000000)

	});
</script>