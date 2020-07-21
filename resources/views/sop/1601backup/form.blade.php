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


<script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>
<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
</head>

<style>
	.uk-modal-dialog{
		margin-top:70px !important;
		width:900px !important;
		border-radius: 10px;
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
					SOP
				</span>
			</div>
			
			<div class="fl-table">
				<form id="form_blade" action="/sop_save" method="POST">
					{{ csrf_field() }}
					<div>
						<b>Sub Divisi</b>
						<br>
                        <select id="subdivisi_id" class="form-control select2-list" name="subdivisi_id" required>
                            <option value="">--Sub Divisi--</option>
                            @foreach($org_list as $organization)
                                <option value="{{ $organization->ORGANIZATION_STRUCTURE_ID }}">{{ $organization->SUB_DIVISION_NAME}}</option>
                            @endforeach
                        </select>
					</div>
					<div>
						<b>Sub Divisi</b>
						<br>
                        <select id="subdivisi_id_2" class="form-control select2-list" name="subdivisi_id_2" required>
                            <option value="">--Sub Divisi--</option>
                            @foreach($org_list as $organization)
                                <option value="{{ $organization->ORGANIZATION_STRUCTURE_ID }}">{{ $organization->SUB_DIVISION_NAME}}</option>
                            @endforeach
                        </select>
					</div>
						<div>
							<b>Name</b>
							<input name="sopcodename" class="uk-input uk-child-width-1-2" type="text" placeholder="Name" required>
						</div>
						<div>
							<b>Alasan</b>
							<input name="ALASAN" class="uk-input uk-child-width-1-2" type="text" placeholder="Alasan" required>
						</div>
						<div>
							<b>Active</b>
						<br>
                        <select id="active" class="form-control select2-list" name="active" required>
                            <option value="">--Active--</option>
                                <option value="Y">Active</option>
                                <option value="N">Non Active</option>
                        </select>
						</div>
						<div>
							<b>Grouping User</b>
						<br>
                        <select id="g_user_id" class="form-control select2-list" name="g_user_id" required>
                            <option value="">--Grouping User--</option>
                                <option value="10">Cabang & Pusat</option>
                                <option value="20">Pusat</option>
                        </select>
						</div>
					<div>
					<div>
						<br>
					</div>
					<div>
						<button class="uk-button uk-button-primary fl-button" onclick="save_organization_structure(this.form.id);return false;">
							<i class="fa fa-plus"></i>&nbsp;Save
						</button>
					</div>
			</div>
		</div>	
	</div>

</div>	
</body>
<html>

<script type="text/javascript">
	$(".select2-list").select2({
			allowClear: true
		});
</script>