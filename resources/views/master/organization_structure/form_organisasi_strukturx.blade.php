<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PT. Pelabuhan Tanjung Priok</title>

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
					E-Report PT. Pelabuhan Tanjung Priok	
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
					Master Struktur Organisasi
				</span>
			</div>

			<div class="fl-table">
				<div class="m-portlet">
					<div class="m-portlet__body">
						<div id="m_tree_2" class="tree-demo">
							<ul>
								<li data-jstree='{ "icon" : "fa fa-briefcase m--font-success " }'>
									<a href="form_directorate">+ Add Matser Directorate</a>
								</li>
								<br>
								<?php $iddiv =  '';?>
								<?php $idbranch = ''; ?>
								@foreach($directorat as $item)
								<li>
									{{ $item->DIRECTORATE_NAME }}
									<ul>
										@foreach($subbranch_list as $items)
										@if($item->DIRECTORATE_ID == $items->DIRECTORATE_ID)
											@if($items->IS_CABANG == '0')
												@if($iddiv != $items->DIVISION_ID)
												<?php $iddiv =  $items->DIVISION_ID;?>
													<li>
													<a href="form_directorate/{{$item->DIRECTORATE_ID}}">+ {{ $items->DIVISION_NAME }} </a>
														<ul>
															@foreach($subbranch_list as $itemss)
																@if($item->DIRECTORATE_ID == $itemss->DIRECTORATE_ID &&  $items->DIVISION_ID == $itemss->DIVISION_ID)
																	<li>
																	{{ $itemss->SUB_DIVISION_NAME }}
																	</li>
																@endif
															@endforeach
														</ul>
													</li>
												@endif
											@elseif($items->IS_CABANG == '1')
												@if($idbranch != $items->BRANCH_OFFICE_ID)
												<?php $idbranch = $items->BRANCH_OFFICE_ID; ?>
													<li>
													{{ $items->BRANCH_OFFICE_NAME }}
														<ul>
															@foreach($subbranch_list as $itemss)
																@if($item->DIRECTORATE_ID == $itemss->DIRECTORATE_ID &&  $items->BRANCH_OFFICE_ID == $itemss->BRANCH_OFFICE_ID)
																	<li>
																	{{ $itemss->SUB_DIVISION_NAME }}
																	</li>
																@endif
															@endforeach
														</ul>
													</li>
												@endif
											@endif
										@endif
										@endforeach

									</ul>
								</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>

		</div>	
	</div>

</body>
<html>
<script src="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
<!--end::Base Scripts -->   
<!--begin::Page Resources -->
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/base/treeview.js')}}" type="text/javascript"></script>
<!--end::Page Resources -->
<script>

	function IsCabang(idgabungan){
		
		var pisah = idgabungan.split('-');
		var iscbg = pisah[1];

		if (iscbg == 1) {
			document.getElementById('branchoffice').disabled = false;
			document.getElementById('divisi').disabled = true;
			document.getElementById('divisi').disableValidation = true;
			$('#divisi').val(null).trigger('change');
		} else {
			document.getElementById('divisi').disabled = false;
			document.getElementById('branchoffice').disabled = true;
			document.getElementById('branchoffice').disableValidation = true;
			$('#branchoffice').val(null).trigger('change');
		}
	}

	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function save_organization_structure(formid)
	{   
		submit_form(formid);
	}
	
</script>


