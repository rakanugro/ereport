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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css') }}">
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js') }}"></script>
</head>

<style>
	.uk-modal-dialog{
		margin-top:70px !important;
		width:900px !important;
		border-radius: 10px;
	}
</style>


<body>
<body>

	
	<div class="fl-main-container">
		<!---Header----------->
		<div class="fl-header fl-header-margin">
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
					<img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/sopReadMore.png') }}" width="65">
					Work Instruction (WI)	
				</span>
				@if($tes == '2')
				<span style="float:right;margin-top:15px">
					<button class="uk-button uk-button-primary fl-button" type="button"><a href="/wi_table/{{$id}}"><font style="color:white">Lihat Lebih Banyak
					</font></a></button>
				</span>
				@endif
			</div>

			<div uk-slider="clsActivated: uk-transition-active" style="margin-top:15px">
				<ul class="uk-grid-small uk-slider-items uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-3@l uk-grid">
					@if( Auth::user()->ACCESS == "ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU")
					<li>
						<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-color7" align="center">
							<table style="height:55vh">
								<tr>
									<td>
										<div align="center" style="padding:10px">
											<img src="{{ URL::asset('templateslide/assets/img/icon/sopUpload.png') }}" width="120"><br>
											<span style="font-size:22px;font-weight:600">Upload WI</span>
											<div>
												Title Work Instruction (WI)
											</div>
											@if($tes == '1' || $tes == '2')
											<div style="margin-top:15px">
												<a href="/wi_upload/{{$id}}">
													<button class="uk-button uk-button-success fl-button" style="color:#666666" type="button">
														Upload
													</button>
												</a>
											</div>
											@endif
										</div>
									</td>
								</tr>
							</table>								    
						</div>	
					</li>
					@endif

				@if($tes == '2')
					<?php $i = 1?>
					@foreach($data as $item)
							<li>
								<div class="uk-card uk-card-default uk-card-body fl-menu-box fl-box-color6" align="center">
									<table style="height:55vh">
										<tr>
											<td>
												<div align="center">
													<img src="{{ URL::asset('templateslide/assets/img/icon/sopPdf.png') }}" width="120"><br>
													<span style="font-size:22px;font-weight:600">WI {{$i++}}</span>
													<div>
														{{$item->FILE_NAME}}
													</div>
													<div style="margin-top:15px">
														<button class="uk-button uk-button-success fl-button" type="button">
															<a href="{{url('wi_download/'.$item->FILE_NAME)}}">Download</a>
														</button>
													</div>
												</div>
											</td>
										</tr>
									</table>								    
								</div>	
							</li>
						@endforeach
				@endif
				</ul>

				<a class="uk-position-center-left uk-position-small uk-hidden-hover uk-light" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
				<a class="uk-position-center-right uk-position-small uk-hidden-hover  uk-light" href="#" uk-slidenav-next uk-slider-item="next"></a>
			</div>
		</div>
	</div>


	<div id="mymodal" uk-modal >
		<div class="uk-modal-dialog uk-modal-body">
			<div>
				<div uk-grid class="uk-grid-small uk-child-width-1-2 uk-child-width-1-3@m uk-child-width-1-2@s" align="left	">
					<div>
						<b>Jenis WI</b>
						<input class="uk-input" type="text" placeholder="Masukan Jenis">
					</div>
					
					<div>
						<b>Judul</b>
						<input class="uk-input" type="text" placeholder="Masukan Judul">
					</div>

					<div>
						<b>Tanggal Upload</b>
						<input class="uk-input" type="text" placeholder="Masukan Tanggal Upload">
						<div style="padding-top:10px" align="right">
							<button class="uk-button uk-button-primary fl-button" type="button">Search</button>			
						</div>			
					</div>
				</div>
			</div>
	</div>
</body>
</html>

<script>
	function showModal(){
		UIkit.modal("#mymodal").show();
	}
</script>
