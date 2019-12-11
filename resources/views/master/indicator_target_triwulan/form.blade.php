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
  // function get_unit(){
  // 	document.getElementById("unit").value = "";
  // }
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
		<!---Header---------->
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
					Master Indicator Target
				</span>
			</div>
			
			<div class="fl-table">
				<form id="form_perencanaan" action="/master/indicator_target_triwulan_save" method="POST">
				{{ csrf_field() }}
					<div>
						<b>Indicator Name</b>
						<input type="hidden" name="indicatorlisthidden" id="indicatorlisthidden" value="{{ $indicator }}" disabled="disabled"><br>
                        <select onchange="get_unit()" id="indicator_id" class="form-control select2-list" name="indicator_id[]" data-validation="required" data-validation-error-msg="Silahkan Pilih Indicator">
                            <option value="">--Indicator--</option>
                            @foreach($indicator_list as $indicators)
                                <option value="{{ $indicators->INDICATOR_ID }}">{{ $indicators->SUB_DIVISION_NAME }} - {{ $indicators->INDICATOR_NAME }} - {{ $indicators->UNIT }}</option>
                            @endforeach
                        </select>
                        <!-- <br> -->
					</div>
					<div><br></div>
					<div> 
						<b>Indicator Year</b>
						<input name="indicator_year" class="uk-input uk-child-width-1-2" type="text" placeholder="Indicator Year" required>
					</div>
					<div>
						<br>
					</div>
					<table border="0" width="100%">
						<tr>
							<td width="50%" valign="top">
								<table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
									<thead>
										<tr class="fl-table-head">
											<th width="">Triwulan</th>
											<th width="">Target</th>
											<th width="">Bobot</th>
										</tr>
									</thead>
									<tbody>
											<tr>
												<td>Triwulan 1</td>
												<td><input name="target_triwulan1" id="target_triwulan1" class="uk-input uk-child-width-1-2" type="number" onkeyup="myFunction()" placeholder="Target" required></td>
												<td><input name="bobot_triwulan1" id="bobot_triwulan1" class="uk-input uk-child-width-1-2" type="number" onkeyup="myFunctionBobot()" placeholder="Bobot" required></td>
											</tr>
											<tr>
												<td>Triwulan 2</td>
												<td><input name="target_triwulan2" id="target_triwulan2" class="uk-input uk-child-width-1-2" type="number" placeholder="Target" required></td>
												<td><input name="bobot_triwulan2" id="bobot_triwulan2" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td>
											</tr>
											<tr>
												<td>Triwulan 3</td>
												<td><input name="target_triwulan3" id="target_triwulan3" class="uk-input uk-child-width-1-2" type="number" placeholder="Target" required></td>
												<td><input name="bobot_triwulan3" id="bobot_triwulan3" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td>
											</tr>
											<tr>
												<td>Triwulan 4</td>
												<td><input name="target_triwulan4" id="target_triwulan4" class="uk-input uk-child-width-1-2" type="number" placeholder="Target" required></td>
												<td><input name="bobot_triwulan4" id="bobot_triwulan4" class="uk-input uk-child-width-1-2" type="number" placeholder="Bobot" required></td>
											</tr>
											
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<button class="uk-button uk-button-primary fl-button" onclick="save_indicator_triwulan_target(this.form.id);return false;">
									<i class="fa fa-plus"></i>&nbsp;Save
								</button>
							</td>
						</tr>
					</table>
					
					
					
					<div>
						<br>
					</div>
					<div>

					</div>
					
				</form>
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
</body>
</html>

<script src="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>


<script type="text/javascript">
	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function myFunction() {
		var target = document.getElementById('target_triwulan1');
		console.log(target.value);
		document.getElementById('target_triwulan2').value = target.value;
		document.getElementById('target_triwulan3').value = target.value;
		document.getElementById('target_triwulan4').value = target.value;
	}

	function myFunctionBobot() {
		var target = document.getElementById('bobot_triwulan1');
		console.log(target.value);
		document.getElementById('bobot_triwulan2').value = target.value;
		document.getElementById('bobot_triwulan3').value = target.value;
		document.getElementById('bobot_triwulan4').value = target.value;
	}

	function save_indicator_triwulan_target(formid)
    {   
		submit_form(formid);
    }

	// $(".select2").select2();
	// $(".ajax").select2({
 //            ajax: {
 //                url: "https://api.github.com/search/repositories",
 //                dataType: 'json',
 //                delay: 250,
 //                data: function (params) {
 //                    return {
 //                        q: params.term, // search term
 //                        page: params.page
 //                    };
 //                },
 //                processResults: function (data, params) {
 //                    // parse the results into the format expected by Select2
 //                    // since we are using custom formatting functions we do not need to
 //                    // alter the remote JSON data, except to indicate that infinite
 //                    // scrolling can be used
 //                    params.page = params.page || 1;
 //                    return {
 //                        results: data.items,
 //                        pagination: {
 //                            more: (params.page * 30) < data.target_count
 //                        }
 //                    };
 //                },
 //                cache: true
 //            },
 //            escapeMarkup: function (markup) {
 //                return markup;
 //            }, // let our custom formatter work
 //            minimumInputLength: 1,
 //            //templateResult: formatRepo, // omitted for brevity, see the source of this page
 //            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
 //    });
	$(".select2-list").select2({
        });
</script>
