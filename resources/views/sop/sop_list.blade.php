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
	<link rel="stylesheet" href="{{ URL::asset('templateslide/assets/js/datatableptkak/css/jquery.dataTables.min.css') }}">
	<link href="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('metronic2/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />


	<script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
	<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>
	<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

	<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
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
			</div>	
		</div>

		<div class="fl-container">
			<div class="fl-title-page" >
				<span style="font-size:20px">				
					<img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/sopReadMore.png') }}" width="65" alt="">
					SOP
				</span>

			<span style="float:right;margin-top:15px">
				@if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' )
				<a href="form_sop"><button class="uk-button uk-button-primary fl-button" type="button">+</button></a>
				@endif
			</span>
		</div>
		<div class="fl-table">
			<div class="m-portlet">
				<div class="m-portlet__body">
					<div id="m_tree_2" class="tree-demo">
						<ul>	
							<?php $iddiv1 =  '';?>
							<?php $iddiv2 =  '';?>
							<?php $idsop1 =  '';?>
							<?php $idsop2 =  '';?>
							@foreach($division as $item)
							<li>
								<a>{{ $item->DIVISION_NAME }}</a>
								<ul>
									@foreach($subdiv1 as $items)
										@if($item->DIVISION_ID == $items->DIVISION_ID)
											@if($iddiv1 != $items->SUB_DIVISION_ID)
												<?php $iddiv1 =  $items->DIVISION_ID;?>
												<li>
													<a>{{ $items->SUB_DIVISION_NAME }}</a>
													<ul>
														@foreach($sop as $sopitem)
															@if($sopitem->SUB_DIVISION_ID == $items->SUB_DIVISION_ID)
																@if($idsop1 != $sopitem->SOP_ID)
																	<?php $idsop1 =  $sopitem->SOP_ID;?>
																	<li>
																		<a href="/sop/edit/{{$sopitem->SOP_ID}}">{{ $sopitem->SOP_NAME }}</a>
																	</li>
																@endif
															@endif
														@endforeach
													</ul>
												</li>
											@endif
										@endif
									@endforeach
								</ul>
							</li>
							@endforeach

							@foreach($branch as $item2)
							<li>
							<a>{{ $item2->BRANCH_OFFICE_NAME }}</a>
								<ul>
									@foreach($subdiv2 as $items2)
										@if($item2->BRANCH_OFFICE_ID == $items2->BRANCH_OFFICE_ID)
											@if($iddiv2 != $items2->SUB_DIVISION_ID)
												<?php $iddiv2 =  $items2->BRANCH_OFFICE_ID;?>
												<li>
													<a>{{ $items2->SUB_DIVISION_NAME }}</a>
													<ul>
														@foreach($sop as $sopitem)
															@if($sopitem->SUB_DIVISION_ID == $items2->SUB_DIVISION_ID)
																@if($idsop2 != $sopitem->SOP_ID)
																	<?php $idsop2 =  $sopitem->SOP_ID;?>
																	<li>
																		<a href="/sop/edit/{{$sopitem->SOP_ID}}">>{{ $sopitem->SOP_NAME }}</a>
																	</li>
																@endif
															@endif
														@endforeach
													</ul>
												</li>
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
</body>
</html>
<script>
	function showModal(){
		UIkit.modal("#mymodal").show();
	}
</script>
<script src="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
<!--end::Base Scripts -->   
<!--begin::Page Resources -->
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/base/treeview.js')}}" type="text/javascript"></script>

