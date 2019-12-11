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
				<form id="form_perencanaan" action="/master/indicator_target_edit" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="id" id="id" value="{{ $id }}">
					<div>
						<b>Indicator Name</b>
						<input type="hidden" name="indicatorlisthidden" id="indicatorlisthidden" value="{{ $indicator }}" disabled="disabled"><br>
                        <select id="indicator_id" class="form-control select2-list" style="width: 100% !important;" name="indicator_id[]" data-validation="required" data-validation-error-msg="Silahkan Pilih Indicator">
                            <option value="">--Indicator--</option>
                            @foreach($indicator_list as $indicators)
                                <option value="{{ $indicators->INDICATOR_ID }}" {{ $selectedindicator == $indicators->INDICATOR_ID ? 'selected="selected"' : '' }}>{{ $indicators->SUB_DIVISION_NAME }} - {{ $indicators->INDICATOR_NAME }} - {{ $indicators->UNIT }}</option>
                            @endforeach
                        </select>
					<div>
					<br>
					<div>
						<b>Indicator Year</b><br>
						<select id="indicator_year" class="form-control select2-list" style="width: 100% !important;" name="indicator_year" required="required">
							@foreach($years as $year)
								@if($year == $indicator_year)
									<option value="{{ $year }}" selected>{{ $year }}</option>
								@else
									<option value="{{ $year }}">{{ $year }}</option>
								@endif
							@endforeach
						</select>
						<br>
					</div>
					<table border="0" width="100%">
						<!-- <thead>
							<th width="50%">LAPORAN BULANAN</th>
							<th width="50%">LAPORAN TRIWULANAN</th>
						</thead> -->
						<tr>
							<td width="50%">
								<table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
									<thead>
										<tr class="fl-table-head">
											<th width="">Month</th>
											<th width="">Target</th>
											<!-- <th width="">Bobot</th> -->
										</tr>
									</thead>
									<tbody>
											<tr>
												<td>Januari</td>
												<td><input name="target_januari" id="target_januari" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_JAN }}" onkeyup="myFunction()" placeholder="Target" required></td>
												<!-- <td><input name="bobot_januari" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_JAN }}" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td>Februari</td>
												<td><input name="target_februari" id="target_februari" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_FEB }}" placeholder="Target" required></td>
												<!-- <td><input name="bobot_februari" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_FEB }}" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td>Maret</td>
												<td><input name="target_maret" id="target_maret" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_MAR }}" placeholder="Target" required></td>
												<!-- <td><input name="bobot_maret" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_MAR }}" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td>April</td>
												<td><input name="target_april" id="target_april" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_APR }}" placeholder="Target" required></td>
												<!-- <td><input name="bobot_april" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_APR }}" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td>Mei</td>
												<td><input name="target_mei" id="target_mei" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_MAY }}" placeholder="Target" required></td>
												<!-- <td><input name="bobot_mei" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_MAY }}" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td>Juni</td>
												<td><input name="target_juni" id="target_juni" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_JUN }}" placeholder="Target" required></td>
												<!-- <td><input name="bobot_juni" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_JUN }}" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td>Juli</td>
												<td><input name="target_juli" id="target_juli" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_JUL }}" placeholder="Target" required></td>
												<!-- <td><input name="bobot_juli" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_JUL }}" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td>Agustus</td>
												<td><input name="target_agustus" id="target_agustus" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_AUG }}" placeholder="Target" required></td>
												<!-- <td><input name="bobot_agustus" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_AUG }}" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td>September</td>
												<td><input name="target_september" id="target_september" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_SEP }}" placeholder="Target" required></td>
												<!-- <td><input name="bobot_september" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_SEP }}" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td>Oktober</td>
												<td><input name="target_oktober" id="target_oktober" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_OCT }}" placeholder="Target" required></td>
												<!-- <td><input name="bobot_oktober" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_OCT }}" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td>November</td>
												<td><input name="target_november" id="target_november" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_NOV }}" placeholder="Target" required></td>
												<!-- <td><input name="bobot_november" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_NOV }}" placeholder="Bobot" required></td> -->
											</tr>
											<tr>
												<td>Desember</td>
												<td><input name="target_desember" id="target_desember" class="uk-input uk-child-width-1-2" type="number" step="any" value="{{ $TARGET_DES }}" placeholder="Target" required></td>
												<!-- <td><input name="bobot_desember" class="uk-input uk-child-width-1-2" type="number" value="{{ $BOBOT_DES }}" placeholder="Bobot" required></td> -->
											</tr>
									</tbody>
								</table>
							</td>
							<!-- <td width="50%" valign="top">
								<table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
									<thead>
										<tr class="fl-table-head">
											<th width="">Triwulan</th>
											<th width="">Target</th>
											<th width="">Weight</th>
										</tr>
									</thead>
									<tbody>
											<tr>
												<td>Triwulan 1</td>
												<td><input name="target_triwulan1" class="uk-input uk-child-width-1-2" type="number" value="{{ $TARGET_JAN }}" placeholder="Target"></td>
												<td><input name="bobot_triwulan1" class="uk-input uk-child-width-1-2" type="number" value="{{ $TARGET_JAN }}" placeholder="Bobot"></td>
											</tr>
											<tr>
												<td>Triwulan 2</td>
												<td><input name="target_triwulan2" class="uk-input uk-child-width-1-2" type="number" value="{{ $TARGET_JAN }}" placeholder="Target"></td>
												<td><input name="bobot_triwulan2" class="uk-input uk-child-width-1-2" type="number" value="{{ $TARGET_JAN }}" placeholder="Bobot"></td>
											</tr>
											<tr>
												<td>Triwulan 3</td>
												<td><input name="target_triwulan3" class="uk-input uk-child-width-1-2" type="number" value="{{ $TARGET_JAN }}" placeholder="Target"></td>
												<td><input name="bobot_triwulan3" class="uk-input uk-child-width-1-2" type="number" value="{{ $TARGET_JAN }}" placeholder="Bobot"></td>
											</tr>
											<tr>
												<td>Triwulan 4</td>
												<td><input name="target_triwulan4" class="uk-input uk-child-width-1-2" type="number" value="{{ $TARGET_JAN }}" placeholder="Target"></td>
												<td><input name="bobot_triwulan4" class="uk-input uk-child-width-1-2" type="number" value="{{ $TARGET_JAN }}" placeholder="Bobot"></td>
											</tr>
											
									</tbody>
								</table>
							</td> -->
						</tr>
						<tr>
							<td colspan="2">
								<button class="uk-button uk-button-primary fl-button" onclick="save_indicator_target(this.form.id);return false;">
									<i class="fa fa-plus"></i>&nbsp;Update
								</button>

								<button onclick="location.href = '{{ url('master/indicator_target_list')}}'" class="uk-button uk-button-danger fl-button float-right" type="button">Back</button>
							</td>
						</tr>
					</table>
					<!-- <div>
						<b>Weight Unit</b>
						<input name="weight_unit" class="uk-input uk-child-width-1-2" type="text" value="{{ $weight_unit }}" placeholder="Weight Unit">
					</div>
					<div>
						<b>Weight</b>
						<input name="weight" class="uk-input uk-child-width-1-2" type="text" value="{{ $weight }}" placeholder="Weight">
					</div>
					<div>
						<b>Target Unit</b>
						<input name="target_unit" class="uk-input uk-child-width-1-2" type="text" value="{{ $target_unit }}" placeholder="Target Unit">
					</div>
					<div>
						<b>Target</b>
						<input name="target" class="uk-input uk-child-width-1-2" type="text" value="{{ $target }}" placeholder="Target">
					</div>
					<div>
						<br>
					</div> -->
					<!-- <div>
						<button class="uk-button uk-button-primary fl-button" onclick="save_indicator_target(this.form.id);return false;">
							<i class="fa fa-plus"></i>&nbsp;Save
						</button>
					</div> -->
					
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

<script>
	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function myFunction() {
		var target = document.getElementById('target_januari');
		console.log(target.value);
		document.getElementById('target_februari').value = target.value;
		document.getElementById('target_maret').value = target.value;
		document.getElementById('target_april').value = target.value;
		document.getElementById('target_mei').value = target.value;
		document.getElementById('target_juni').value = target.value;
		document.getElementById('target_juli').value = target.value;
		document.getElementById('target_agustus').value = target.value;
		document.getElementById('target_september').value = target.value;
		document.getElementById('target_oktober').value = target.value;
		document.getElementById('target_november').value = target.value;
		document.getElementById('target_desember').value = target.value;
	}

	function save_indicator_target(formid)
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
 //                            more: (params.page * 30) < data.total_count
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
            allowClear: true
        });
</script>
