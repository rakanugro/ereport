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
<link href="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('metronic2/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/css/sweetalert.css') }}" rel="stylesheet">

<script src="templateslide/assets/js/jquery-1.11.1.min.js"></script>
<script src="templateslide/assets/uikit/js/uikit.js"></script>

<script src="templateslide/assets/datepicker/moment.min.js"></script>
<script src="templateslide/assets/datepicker/daterangepicker.js"></script>

<script src="templateslide/assets/js/marquee/jquery.marquee.js"></script>
<script src="templateslide/assets/js/marquee/jquery.pause.js"></script>
<script src="templateslide/assets/js/marquee/jquery.easing.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>

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
<body>

<header class="fl-main-container">
	<div class="fl-header">
		<div>
			<img src="templateslide/assets/img/logo/ptpwhite.png" class="fl-logo">
			
			<span class="fl-title-logo">
				E-Reporting PT. Pelabuhan Tanjung Priok
			</span>

			<span class="fl-menu-tool">
				<a href="listexportdata"><button style="background-color : #FFDAB9 !important;" class="uk-button uk-button fl-button" type="button">Report</button></a>
				<button class="uk-button uk-button-primary fl-button" onclick="Changepass({{$iduser}})" type="button">Change Password</button>

				<a href="logout"><button class="uk-button uk-button-danger fl-button" type="button">Logout</button></a>
				<!-- <input type="button" class="uk-button uk-button-primary fl-button" value="menu"> -->
				<!-- <a href="/" class="uk-button uk-button-primary	 fl-button">MENU</a> -->
			</span>
		</div>
		<div style="text-align:center">
			<span class="fl-menu-logo" style="float:right !important;">
				<label>Login as {{ Auth::user()->NAMA }}</label>
			</span>
		</div>	
	</div>
</header>

	<!-- <table class="super-main" valign="middle"> -->
	<table valign="middle" style="margin-top: 4%">
		<tr>
			<td>
				<div class="fl-main-container">
					<!---Header-------->

					<div class="fl-container">
						<div uk-slider="clsActivated: uk-transition-active">
							<ul class="uk-slider-items uk-child-width-1-1@s uk-child-width-1-1@ uk-grid">
									
								<li>
									<div uk-grid class="uk-grid-small uk-child-width-1-1 uk-child-width-1-4@m uk-child-width-1-2@s">
										
										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-color1">
												<table>
													<tr>
														<td>
															<!-- @if(Auth::user()->ACCESS == "SUPERADMIN" || Auth::user()->ACCESS == "ADMIN MUTU")
															<img src="templateslide/assets/img/image/fl1.jpg" class="fl-image-figure" onclick="showModalsarmut()">																											
															@else -->
															<a href="txsarmut"> <img src="templateslide/assets/img/image/fl1.jpg" class="fl-image-figure"></a>
															<!-- @endif -->
														</td>
													</tr>
												</table>								    
											</div>
										</div>

										@if(Auth::user()->ACCESS == "VP PENGENDALIAN KINERJA DAN JAMINAN MUTU" || Auth::user()->ACCESS == "DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU" || Auth::user()->ACCESS == "ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU")
										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-color2">
											    <table>
													<tr>
														<td>
															<a href="txkpi"> <img src="templateslide/assets/img/image/fl2.jpg" class="fl-image-figure"></a>
														</td>
													</tr>
												</table>
											</div>
										</div>
										@else
										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-colordisbled">
											    <table>
													<tr>
														<td>
															<a href="#" onclick="nohakakses()" disabled="disabled"> <img src="templateslide/assets/img/image/kpi_disable.jpeg" class="fl-image-figure"></a>
					
														</td>
													</tr>
												</table>
											</div>
										</div>
										@endif

										@if(Auth::user()->ACCESS == "VP PENGENDALIAN KINERJA DAN JAMINAN MUTU" || Auth::user()->ACCESS == "DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU" || Auth::user()->ACCESS == "ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU")
										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-color5">
											    <table>
													<tr>
														<td>
															<a href="txtkp"> <img src="templateslide/assets/img/image/fl5.jpeg" class="fl-image-figure"></a>								
														</td>
													</tr>
												</table>
											</div>
										</div>
										@else
										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-colordisbled">
											    <table>
													<tr>
														<td>
															<a href="#" onclick="nohakakses()" disabled="disabled"> <img src="templateslide/assets/img/image/tkp_disable.jpeg" class="fl-image-figure"></a>		
														</td>
													</tr>
												</table>
											</div>
										</div>
										@endif

										
										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-color7">
										    <table>
													<tr>
														<td>
															<!-- @if(Auth::user()->ACCESS == "SUPERADMIN" || Auth::user()->ACCESS == "ADMIN MUTU")
															<img src="templateslide/assets/img/image/fl7.jpg" class="fl-image-figure" onclick="showModalptkak()">																											
															@else -->
															<a href="ptkaklist"> <img src="templateslide/assets/img/image/fl7.jpg" class="fl-image-figure"></a>
															<!-- @endif -->
														</td>
													</tr>
												</table>
											</div>
										</div>

										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-color8">
											    <table>
													<tr>
														<td>
															<!-- @if(Auth::user()->ACCESS == "SUPERADMIN" || Auth::user()->ACCESS == "ADMIN MUTU")
															<img src="templateslide/assets/img/image/fl6.jpg" class="fl-image-figure" onclick="showModalsop()">																											
															@else -->
															<a href="sop_list"> <img src="templateslide/assets/img/image/fl6.jpg" class="fl-image-figure"></a>
															<!-- @endif		 -->
														</td>
													</tr>
												</table>
											</div>
										</div>


										@if(Auth::user()->ACCESS == "VP PENGENDALIAN KINERJA DAN JAMINAN MUTU" || Auth::user()->ACCESS == "DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU" || Auth::user()->ACCESS == "ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU" || Auth::user()->ACCESS == "VP SUB DIVISI" || Auth::user()->ACCESS == "DVP SUB DIVISI")
										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-color3">
												<table>
													<tr>
														<td>
															<!-- @if(Auth::user()->ACCESS == "SUPERADMIN" || Auth::user()->ACCESS == "ADMIN MUTU")
															<img src="templateslide/assets/img/image/fl3.jpg" class="fl-image-figure" onclick="showModalmanagementreport()">																											
															@else -->
															<a href="management_report_index"> <img src="templateslide/assets/img/image/fl3.jpg" class="fl-image-figure"></a>
															<!-- @endif																											 -->
														</td>
													</tr>
												</table>
											</div>
										</div>
										@else
										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-colordisbled">
											    <table>
													<tr>
														<td>
															<a href="#" onclick="nohakakses()" disabled="disabled"> <img src="templateslide/assets/img/image/managemen_report_disable.jpeg" class="fl-image-figure"></a>
					
														</td>
													</tr>
												</table>
											</div>
										</div>
										@endif

										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-color4">
												<table>
													<tr>
														<td>
															<!-- @if(Auth::user()->ACCESS == "SUPERADMIN" || Auth::user()->ACCESS == "ADMIN MUTU")
															<img src="templateslide/assets/img/image/fl4.jpg" class="fl-image-figure" onclick="showModaldokumenpendukung()">																											
															@else -->
															<a href="dokumen_pendukung"> <img src="templateslide/assets/img/image/fl4.jpg" class="fl-image-figure"></a>
															<!-- @endif																												 -->
														</td>
													</tr>
												</table>
											</div>
										</div>

										@if(Auth::user()->ACCESS == "VP PENGENDALIAN KINERJA DAN JAMINAN MUTU" || Auth::user()->ACCESS == "DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU" || Auth::user()->ACCESS == "ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU")
										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-color10">
												<table>
													<tr>
														<td>
															<a href="master_menu"><img src="templateslide/assets/img/image/fl8.jpg" class="fl-image-figure"></a>	
														</td>
													</tr>
												</table>
											</div>
										</div>
										@else
										<div>
											<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-colordisbled">
												<table>
													<tr>
														<td>
															<a href="#" onclick="nohakakses()"><img src="templateslide/assets/img/image/master_data_disable.jpeg" class="fl-image-figure"></a>
														</td>
													</tr>
												</table>
											</div>
										</div>
										@endif	
									</div>	
								</li>

								<!-- <li>
									<div uk-grid class="uk-grid-small uk-child-width-1-1 uk-child-width-1-3@m uk-child-width-1-2@s">
																		
									</div>	
								</li> -->
							</ul>

							<a class="uk-position-center-left uk-position-small uk-hidden-hover uk-light" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
			       			<a class="uk-position-center-right uk-position-small uk-hidden-hover  uk-light" href="#" uk-slidenav-next uk-slider-item="next"></a>
						</div>
					</div>
				</div>
			</td>
		</tr>
	</table>

	<div id="mymodalsarmut" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			{{ csrf_field() }}
			<div style="margin-bottom:30px; text-align:center;">
				<span style="font-size:18px">Pilih Divisi / Departement</span>
			</div>
			<div style="height:80px; width: 100%;" data-simplebar data-simplebar-auto-hide="true">
				<div class="col-lg-12" style="text-align: center;">
					<b>Organization Structure</b>
					<select class="form-control select2-list" id="organize_struct_listsarmut" name="organize_struct_listsarmut" required="required">
						<option value="">--Direktorat-Cabang-Divisi-Sub Divisi--</option>
						@foreach($organize_struct_list as $org)
						<option value="{{ $org->ORGANIZATION_STRUCTURE_ID }}">{{ $org->DIRECTORATE_NAME }}-{{ $org->BRANCH_OFFICE_NAME }}{{ $org->DIVISION_NAME }}-{{ $org->SUB_DIVISION_NAME }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4" style="text-align: center;">
				<button type="button" class="uk-button uk-button-primary" id="sarmutForm" onclick="formSubmitsarmut()">Yes</button>
				<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
			</div>
		</div>
	</div>

	<div id="mymodalmanagementreport" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			{{ csrf_field() }}
			<div style="margin-bottom:30px; text-align:center;">
				<span style="font-size:18px">Pilih Divisi / Departement</span>
			</div>
			<div style="height:80px; width: 100%;" data-simplebar data-simplebar-auto-hide="true">
				<div class="col-lg-12" style="text-align: center;">
					<b>Organization Structure</b>
					<select class="form-control select2-list" id="organize_struct_listmanagementreport" name="organize_struct_listmanagementreport" required="required">
						<option value="">--Direktorat-Cabang-Divisi-Sub Divisi--</option>
						@foreach($organize_struct_list as $org)
						<option value="{{ $org->ORGANIZATION_STRUCTURE_ID }}">{{ $org->DIRECTORATE_NAME }}-{{ $org->BRANCH_OFFICE_NAME }}-{{ $org->DIVISION_NAME }}-{{ $org->SUB_DIVISION_NAME }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4" style="text-align: center;">
				<button type="button" class="uk-button uk-button-primary" id="managementreportForm" onclick="formSubmitmanagementreport()">Yes</button>
				<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
			</div>
		</div>
	</div>

	<div id="mymodaldokumenpendukung" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			{{ csrf_field() }}
			<div style="margin-bottom:30px; text-align:center;">
				<span style="font-size:18px">Pilih Divisi / Departement</span>
			</div>
			<div style="height:80px; width: 100%;" data-simplebar data-simplebar-auto-hide="true">
				<div class="col-lg-12" style="text-align: center;">
					<b>Organization Structure</b>
					<select class="form-control select2-list" id="organize_struct_listdokumenpendukung" name="organize_struct_listdokumenpendukung" required="required">
						<option value="">--Direktorat-Cabang-Divisi-Sub Divisi--</option>
						@foreach($organize_struct_list as $org)
						<option value="{{ $org->ORGANIZATION_STRUCTURE_ID }}">{{ $org->DIRECTORATE_NAME }}-{{ $org->BRANCH_OFFICE_NAME }}-{{ $org->DIVISION_NAME }}-{{ $org->SUB_DIVISION_NAME }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4" style="text-align: center;">
				<button type="button" class="uk-button uk-button-primary" id="dokumenpendukungForm" onclick="formSubmitdokumenpendukung()">Yes</button>
				<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
			</div>
		</div>
	</div>

	<div id="mymodalkpi" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			{{ csrf_field() }}
			<div style="margin-bottom:30px; text-align:center;">
				<span style="font-size:18px">Pilih Divisi / Departement</span>
			</div>
			<div style="height:80px; width: 100%;" data-simplebar data-simplebar-auto-hide="true">
				<div class="col-lg-12" style="text-align: center;">
					<b>Organization Structure</b>
					<select class="form-control select2-list" id="organize_struct_listkpi" name="organize_struct_listkpi" required="required">
						<option value="">--Direktorat-Cabang-Divisi-Sub Divisi--</option>
						@foreach($organize_struct_list as $org)
						<option value="{{ $org->ORGANIZATION_STRUCTURE_ID }}">{{ $org->DIRECTORATE_NAME }}-{{ $org->BRANCH_OFFICE_NAME }}-{{ $org->DIVISION_NAME }}-{{ $org->SUB_DIVISION_NAME }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4" style="text-align: center;">
				<button type="button" class="uk-button uk-button-primary" id="kpiForm" onclick="formSubmitkpi()">Yes</button>
				<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
			</div>
		</div>
	</div>

	<div id="mymodaltkp" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			{{ csrf_field() }}
			<div style="margin-bottom:30px; text-align:center;">
				<span style="font-size:18px">Pilih Divisi / Departement</span>
			</div>
			<div style="height:80px; width: 100%;" data-simplebar data-simplebar-auto-hide="true">
				<div class="col-lg-12" style="text-align: center;">
					<b>Organization Structure</b>
					<select class="form-control select2-list" id="organize_struct_listtkp" name="organize_struct_listtkp" required="required">
						<option value="">--Direktorat-Cabang-Divisi-Sub Divisi--</option>
						@foreach($organize_struct_list as $org)
						<option value="{{ $org->ORGANIZATION_STRUCTURE_ID }}">{{ $org->DIRECTORATE_NAME }}-{{ $org->BRANCH_OFFICE_NAME }}-{{ $org->DIVISION_NAME }}-{{ $org->SUB_DIVISION_NAME }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4" style="text-align: center;">
				<button type="button" class="uk-button uk-button-primary" id="tkpForm" onclick="formSubmittkp()">Yes</button>
				<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
			</div>
		</div>
	</div>

	<div id="mymodalsop" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			{{ csrf_field() }}
			<div style="margin-bottom:30px; text-align:center;">
				<span style="font-size:18px">Pilih Divisi / Departement</span>
			</div>
			<div style="height:80px; width: 100%;" data-simplebar data-simplebar-auto-hide="true">
				<div class="col-lg-12" style="text-align: center;">
					<b>Organization Structure</b>
					<select class="form-control select2-list" id="organize_struct_listsop" name="organize_struct_listsop" required="required">
						<option value="">--Direktorat-Cabang-Divisi-Sub Divisi--</option>
						@foreach($organize_struct_list as $org)
						<option value="{{ $org->ORGANIZATION_STRUCTURE_ID }}">{{ $org->DIRECTORATE_NAME }}-{{ $org->BRANCH_OFFICE_NAME }}-{{ $org->DIVISION_NAME }}-{{ $org->SUB_DIVISION_NAME }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4" style="text-align: center;">
				<button type="button" class="uk-button uk-button-primary" id="sopForm" onclick="formSubmitsop()">Yes</button>
				<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
			</div>
		</div>
	</div>

	<div id="mymodalptkak" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			{{ csrf_field() }}
			<div style="margin-bottom:30px; text-align:center;">
				<span style="font-size:18px">Pilih Divisi / Departement</span>
			</div>
			<div style="height:80px; width: 100%;" data-simplebar data-simplebar-auto-hide="true">
				<div class="col-lg-12" style="text-align: center;">
					<b>Organization Structure</b>
					<select class="form-control select2-list" id="organize_struct_listptkak" name="organize_struct_listptkak" required="required">
						<option value="">--Direktorat-Cabang-Divisi-Sub Divisi--</option>
						@foreach($organize_struct_list as $org)
						<option value="{{ $org->ORGANIZATION_STRUCTURE_ID }}">{{ $org->DIRECTORATE_NAME }}-{{ $org->BRANCH_OFFICE_NAME }}-{{ $org->DIVISION_NAME }}-{{ $org->SUB_DIVISION_NAME }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4" style="text-align: center;">
				<button type="button" class="uk-button uk-button-primary" id="ptkakForm" onclick="formSubmitptkak()">Yes</button>
				<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
			</div>
		</div>
	</div>

	<div id="Changepassword" uk-modal >
		<div class="uk-modal-dialog uk-modal-body modal-sm">
			<form action="account/user_changepass" id="changepassForm" method="post">
				{{ csrf_field() }}
				<div style="height:80px" data-simplebar data-simplebar-auto-hide="true">
					<div>
						<h2 style="text-align: center;">Change Password</h2>
					</div>
				</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="left	">
					<input type="hidden" id="idchangepass" name="idchangepass">
						<div class="col-lg-6">
							<label class="">
								New Password:
							</label>
							<input type="password" class="form-control m-input" name="newpass" id="newpass" minlength="5" placeholder="Input Password Baru Minimal 5 Karakter" onkeyup='cekpass();' required >
						</div>
						<div class="col-lg-6">
							<label class="">
								Confirm Password:
							</label>
							<input type="password" class="form-control m-input" name="confirmnewpass" id="confirmnewpass" minlength="5" placeholder="Input Password Baru Minimal 5 Karakter" onkeyup='cekpass();' required>
							<span id='message'></span>
						</div>
				</div>
				<br>
				<br>
				<br>
				<div class="col-md-12" style="text-align: center;">
					<button type="submit" class="uk-button uk-button-primary" id="Formsubmitchangepass"> Yes</button>
					<button class="uk-button uk-button-danger uk-modal-close" type="button">Cancel</button>
				</div>
			</form>		
		</div>
	</div>
	<!-- This is the modal -->
	<!-- <div id="mymodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body">
			<div style="margin-bottom:30px">
				<span style="font-size:18px">Pilih Divisi / Departement</span>
				<span class="fl-search">
					<input class="uk-input uk-form-width-medium" type="text" placeholder="Cari Divisi">
				</span>
			</div>

			<div style="height:310px" data-simplebar data-simplebar-auto-hide="true">
				<div uk-grid class=" uk-child-width-1-2 uk-child-width-1-4@m uk-child-width-1-2@s" align="center">
					<div>
						<a href="txsarmut">
							<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						</a>
						<span class="fl-icon-title">Divisi Human CapitalSarmut</span>
					</div>
					
					<div>
					<a href="txkpi">
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
					</a>
						<span class="fl-icon-title">Divisi Operasi TerminalKPI</span>
					</div>

					<div>
					<a href="manajemen_report_index">
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
					</a>
						<span class="fl-icon-title">Divisi Peralatan</span>
					</div>

					<div>
					<a href="txtkp">
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						</a>
						<span class="fl-icon-title">Divisi Teknologi InformasiTKP</span>
					</div>

					<div>
					<a href="dokumen_pendukung">
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
					</a>
						<span class="fl-icon-title">Sekerataris Perusahaan</span>
					</div>

					<div>
					<a href="sop_index">
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi Perencanaan dan Pengendalian</span>
					</a>
					</div>

					<div>
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi Pengadaan</span>
					</div>

					<div>
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi Akuntansi Pajak dan Keuangan</span>
					</div>

					<div>
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi Akuntansi Pajak dan Keuangan</span>
					</div>

					<div>
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi Akuntansi Pajak dan Keuangan</span>
					</div>

					<div>
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi Akuntansi Manajemen</span>
					</div>

					<div>
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi Pengembangan Bisnis</span>
					</div>

					<div>
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi QA & SMO</span>
					</div>

					<div>
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi Marketing</span>
					</div>

					<div>
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi Perencanaan dan Pengembangan Operasi</span>
					</div>

					<div>
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi Fasilitas & Utilitas</span>
					</div>

					<div>
						<img src="templateslide/assets/img/icon/div1.png" class="fl-icon">
						<span class="fl-icon-title">Divisi Hukum</span>
					</div>
				</div>
			</div>
			<p class="uk-text-right">
				<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
			</p>
		</div>
	</div> -->
</body>
</html>
<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/sweetalert.min.js') }}"></script>

<script>
	
	//sarmut
	function showModalsarmut(){
		UIkit.modal("#mymodalsarmut").show();

	}

	function formSubmitsarmut()
	{
		var ORGID = $('#organize_struct_listsarmut').val();
		
		setCookie('ORG_ID', ORGID ,1);
		var url = '{{url('/txsarmut')}}/';
		window.location.assign(url);
	}

	//managementreport
	function showModalmanagementreport(){
		UIkit.modal("#mymodalmanagementreport").show();

	}

	function formSubmitmanagementreport()
	{
		var ORGID = $('#organize_struct_listmanagementreport').val();
		
		setCookie('ORG_ID', ORGID ,1);
		var url = '{{url('/management_report_index')}}/';
		window.location.assign(url);
	}

	//dokumen pendukung
	function showModaldokumenpendukung(){
		UIkit.modal("#mymodaldokumenpendukung").show();

	}

	function formSubmitdokumenpendukung()
	{
		var ORGID = $('#organize_struct_listdokumenpendukung').val();
		
		setCookie('ORG_ID', ORGID ,1);
		var url = '{{url('/dokumen_pendukung')}}/';
		window.location.assign(url);
	}

	//kpi
	function showModalkpi(){
		UIkit.modal("#mymodalkpi").show();

	}

	function formSubmitkpi()
	{
		var ORGID = $('#organize_struct_listkpi').val();
		
		setCookie('ORG_ID', ORGID ,1);
		var url = '{{url('/txkpi')}}/';
		window.location.assign(url);
	}

	//tkp
	function showModaltkp(){
		UIkit.modal("#mymodaltkp").show();

	}

	function formSubmittkp()
	{
		var ORGID = $('#organize_struct_listtkp').val();
		
		setCookie('ORG_ID', ORGID ,1);
		var url = '{{url('/txtkp')}}/';
		window.location.assign(url);
	}

	//sop
	function showModalsop(){
		UIkit.modal("#mymodalsop").show();

	}

	function formSubmitsop()
	{
		var ORGID = $('#organize_struct_listsop').val();
		
		setCookie('ORG_ID', ORGID ,1);
		var url = '{{url('/sop_list')}}/';
		window.location.assign(url);
	}

	//ptkak
	function showModalptkak(){
		UIkit.modal("#mymodalptkak").show();
	}

	function formSubmitptkak()
	{

		var ORGID = $('#organize_struct_listptkak').val();
		var url = '{{url('/ptkaklist')}}/';
		window.location.assign(url);
	}

	function Changepass(id){
		var id = id;
		$('#idchangepass').val(id);
		UIkit.modal("#Changepassword").show();
		document.getElementById("Formsubmitchangepass").disabled = true;

	}

	function cekpass() {
		if (document.getElementById('newpass').value ==
			document.getElementById('confirmnewpass').value) {
			document.getElementById('message').style.color = 'green';
			document.getElementById('message').innerHTML = 'matching';
			document.getElementById("Formsubmitchangepass").disabled = false;
		} else {
			document.getElementById('message').style.color = 'red';
			document.getElementById('message').innerHTML = 'not matching';
			document.getElementById("Formsubmitchangepass").disabled = true;
		}
	}

	function setCookie(name,value,days) {
		var expires = "";
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days*24*60*60*1000));
			expires = "; expires=" + date.toUTCString();
		}
		document.cookie = name + "=" + (value || "")  + expires + "; path={{url('/ptkaklist')}}";

	}

	function nohakakses(){
		swal({
			title: "Oops...", 
			text : "Anda Tidak Mempunyai Hak Akses Untuk Menu Ini", 
			type: "warning",
			timer:3000
		});
	}


	$(".select2-list").select2({
            allowClear: true
     });

</script>
