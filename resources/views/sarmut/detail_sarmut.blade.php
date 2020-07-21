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
					<img src="{{ URL::asset('templateslide/assets/img/logo/Logo e-Report.png') }}" class="fl-logo">
					<input type="button" class="uk-button uk-button-primary fl-button" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
				</span>
				<!-- <span class="fl-menu-tool">
					<input type="button" class="uk-button uk-button-primary fl-button" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
				</span> -->
			</div>	
		</div>


		<div class="fl-container">
			<div class="fl-title-page" >
				<span style="font-size:20px">				
					<img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/sopReadMore.png')}}" width="65" alt="">
					Detail Sasaran Mutu Per {{ $month }} {{ $year }}
				</span>
				<span style="float:right;margin-top:15px; color: red;">
					Note* (Kalau keterangan dipilih, maka realisasi tidak dapat diubah)
				</span>
				<div class="form-group m-form__group row">
					<div class="col-lg-8">
					<a href="{{ url::to('/') }}/{{ $getfile }}" download data-toggle="tooltip" title="Download {{ $getfile }}" style="font-weight: 500;">{{ $getfilename }}</a>
					</div>
				</div>
			</div>
			
		<form id="form_editsarmut" action="#" method="POST">	
			<div class="col-md-12 fl-table">
				{{ csrf_field() }}
				<input type="hidden" name="header_sarmut_id" id="header_sarmut_id" value="{{ $header_sarmut_id }}">
				<input type="hidden" name="years" id="years" value="{{ $year }}"><br>
				<input type="hidden" name="months" id="months" value="{{ $month }}"><br>
					
					
				
				<div class="uk-overflow-auto">
				
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider" style="width: 100%;">
						<thead>
							<tr class="fl-table-head">
								<th width="5%"></th>
								<th width="15%">Sub Divisi</th>
								<th width="25%">Indicator Name</th>
								<th width="10%">Periode Laporan</th>
								<th width="5%">Satuan</th>
								<th width="5%">Polaritas</th>
								<th width="5%">Target</th>
								<th width="10%">Realisasi</th>
								<th style="text-align: center;" width="10%">Keterangan</th>
								<th style="text-align: center;" width="10%">Alasan</th>
								<!-- <th width="10%"></th> -->
							</tr>
						</thead>
						<?php $i = 0 ?>
					@foreach($sarmut_list as $data)
						<input type="hidden" name="indicator_id[]" id="indicator_id[]" value="{{ $data->INDICATOR_ID }}">
						<tbody>
							<tr>
								<td><img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('/templateslide/assets/img/icon/i1.png')}}" width="45" alt=""></td>
								<td>{{ $data->SUB_DIVISION_NAME }}</td>
								<td>{{ $data->INDICATOR_NAME }}</td>
								<td>{{ $data->PERIODE_PENGISIAN }}</td>
								<td style="text-align: center !important;">{{ $data->UNIT }}</td>
								<td style="text-align: center !important;">{{ $data->POLARITAS }}</td>
								<td id="target-{{ $data->INDICATOR_ID }}">{{ $sel_tgtind_list[$i]->SELECTED }}</td>
								<td>
									@if( $data->INPUTABLE == "Y")
									<input style="width: 100% !important;" class="col-md-10 uk-input" class="col-md-6 uk-input" type="text" name="actual[]" id="actual{{$i}}" value="{{ $sel_actual_list[$i]->SELECTED }}" placeholder="Realisasi" {{ $disabled_list[$i] == 'disabled' ? 'readonly="readonly"' : 'required="required"' }} disabled="disabled"></td>
									@elseif( $data->INPUTABLE == "N" )
									<input style="width: 100% !important; background-color: #f0f5f5	 !important;" class="col-md-10 uk-input" class="col-md-6 uk-input" type="number" step="any" name="actual[]" id="actual{{$i}}" value="{{ $sel_actual_list[$i]->SELECTED }}" placeholder="Realisasi" {{ 'required="required"' }} disabled="disabled"></td>
									@endif
								<td>
									<select style="width: 100% !important;" id="remark{{$i}}" class="form-control select2-list" name="remark[]" required="required" onchange="changetextbox('remark{{$i}}','actual{{$i}}')" disabled="disabled">
										<option value="-" {{ $sel_actual_list[$i]->KETERANGAN == "-" ? 'selected' : '' }}>--Keterangan--</option>
										<option value="Tidak Ada Kegiatan" {{ $sel_actual_list[$i]->KETERANGAN == "Tidak Ada Kegiatan" ? 'selected' : '' }}>Not Available</option>
										<option value="Data Kurang" {{ $sel_actual_list[$i]->KETERANGAN == "Data Kurang" ? 'selected' : '' }}>Data Kurang</option>
										<option value="Belum Diukur" {{ $sel_actual_list[$i]->KETERANGAN == "Belum Diukur" ? 'selected' : '' }}>Belum Diukur</option>
									</select>
								</td>
								<td>
									<select style="width: 110% !important;" id="alasan{{$i}}" class="form-control select2-list" name="alasan[]" disabled="disabled">
										<option value="-" {{ $sel_actual_list[$i]->ALASAN == "-" ? 'selected' : '' }}>--Alasan--</option>
										<option value="Faktor Cuaca Hujan" {{ $sel_actual_list[$i]->ALASAN == "Faktor Cuaca Hujan" ? 'selected' : '' }}>Faktor Cuaca Hujan</option>
										<option value="Dimensi Barang Beragam" {{ $sel_actual_list[$i]->ALASAN == "Dimensi Barang Beragam" ? 'selected' : '' }}>Dimensi Barang Beragam</option>
										<option value="TKBM Belum Optimal" {{ $sel_actual_list[$i]->ALASAN == "TKBM Belum Optimal" ? 'selected' : '' }}>TKBM Belum Optimal</option>
										<option value="Tempat Penumpukan Jauh" {{ $sel_actual_list[$i]->ALASAN == "Tempat Penumpukan Jauh" ? 'selected' : '' }}>Tempat Penumpukan Jauh</option>
										<option value="Kemasan Mudah Rusak" {{ $sel_actual_list[$i]->ALASAN == "Kemasan Mudah Rusak" ? 'selected' : '' }}>Kemasan Mudah Rusak</option>
										<option value="Menunggu Kesiapan Suhu Muatan" {{ $sel_actual_list[$i]->ALASAN == "Menunggu Kesiapan Suhu Muatan" ? 'selected' : '' }}>Menunggu Kesiapan Suhu Muatan</option>
										<option value="Pola Operasi Yang Tidak Tepat" {{ $sel_actual_list[$i]->ALASAN == "Pola Operasi Yang Tidak Tepat" ? 'selected' : '' }}>Pola Operasi Yang Tidak Tepat</option>
										<option value="Ada Masalah Vendor" {{ $sel_actual_list[$i]->ALASAN == "Ada Masalah Vendor" ? 'selected' : '' }}>Ada Masalah Vendor</option>
										<option value="Sumber Daya Tidak Tersedia" {{ $sel_actual_list[$i]->ALASAN == "Sumber Daya Tidak Tersedia" ? 'selected' : '' }}>Sumber Daya Tidak Tersedia</option>
										<option value="Lama Approved Atasan" {{ $sel_actual_list[$i]->ALASAN == "Lama Approved Atasan" ? 'selected' : '' }}>Lama Approved Atasan</option>
										<option value="Menunggu Data Dari Bagian Lain" {{ $sel_actual_list[$i]->ALASAN == "Menunggu Data Dari Bagian Lain" ? 'selected' : '' }}>Menunggu Data Dari Bagian Lain</option>
										<option value="Kegiatan Dibatalkan" {{ $sel_actual_list[$i]->ALASAN == "Kegiatan Dibatalkan" ? 'selected' : '' }}>Kegiatan Dibatalkan</option>
										<option value="Kegiatan Diundur" {{ $sel_actual_list[$i]->ALASAN == "Kegiatan Diundur" ? 'selected' : '' }}>Kegiatan Diundur</option>
				
										<option value="Proses Gagal / Di Ulang" {{ $sel_actual_list[$i]->ALASAN == "Proses Gagal / Di Ulang" ? 'selected' : '' }}>KProses Gagal / Di Ulang</option>
										<option value="Anggaran Terbatas" {{ $sel_actual_list[$i]->ALASAN == "Anggaran Terbatas" ? 'selected' : '' }}>Anggaran Terbatas</option>
										<option value="Belum Ada Kebijakan" {{ $sel_actual_list[$i]->ALASAN == "Belum Ada Kebijakan" ? 'selected' : '' }}>Belum Ada Kebijakan</option>
										<option value="Menunggu Hasil Kajian" {{ $sel_actual_list[$i]->ALASAN == "Menunggu Hasil Kajian" ? 'selected' : '' }}>Menunggu Hasil Kajian</option>
										<option value="Menunggu Proses SISKAKU Cabang IPC" {{ $sel_actual_list[$i]->ALASAN == "Menunggu Proses SISKAKU Cabang IPC" ? 'selected' : '' }}>Menunggu Proses SISKAKU Cabang IPC</option>
										<option value="Kegiatan Belum Terjadwal" {{ $sel_actual_list[$i]->ALASAN == "Kegiatan Belum Terjadwal" ? 'selected' : '' }}>Kegiatan Belum Terjadwal</option>
										<option value="Menunggu Verifikasi Bagian Lain" {{ $sel_actual_list[$i]->ALASAN == "Menunggu Verifikasi Bagian Lain" ? 'selected' : '' }}>Menunggu Verifikasi Bagian Lain</option>
									</select>
								</td>
								<td></td>
							</tr>
							@if($data->FORMULA <> '')
							<thead>
								<tr class="fl-table-head">
									<th width="5%"></th>
									<th width="15%">Sub Divisi</th>
									<th width="25%">Indicator Name</th>
									<th width="10%">Periode Laporan</th>
									<th width="5%">Satuan</th>
									<th width="5%">Polaritas</th>
									<th width="5%">Target</th>
									<th width="15%">Realisasi</th>
									<th width="15%">Keterangan</th>
									<th width="10%"></th>
								</tr>
							</thead>
							@endif
							<?php $j = 0 ?>
						<?php foreach($sub_in[$i] as $data1){ ?>
						<input type="hidden" name="sub_ind_id[]" id="sub_ind_id[]" value="{{ $data1->INDICATOR_ID }}">
							<tr>
								<td></td>
								<td>{{ $data1->SUB_DIVISION_NAME }}</td>
								<td>{{ $data1->INDICATOR_NAME }}</td>
								<td>{{ $data1->PERIODE_PENGISIAN }}</td>
								<td>{{ $data1->UNIT }}</td>
								<td>{{ $data1->POLARITAS }}</td>
								<td id="subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}">{{ $sel_subtgtind_list[$i][$j]->SELECTED }}</td>
								<td><input  class="col-md-6 uk-input" type="text" name="subreal_{{ $data->INDICATOR_ID }}_{{ $data1->INDICATOR_ID }}" id="subreal_{{ $data->INDICATOR_ID }}_{{ $data1->INDICATOR_ID }}" value="{{ $sel_subactual_list[$i][$j]->SELECTED }}" placeholder="Actual" {{ $disabled_list[$i] == 'disabled' ? 'readonly="readonly"' : 'required="required"' }}></td>
								<td><input  class="col-md-6 uk-input" type="text" name="remark[]" id="remark[]" value="" placeholder="Remark" {{ $disabled_list[$i] == 'disabled' ? 'readonly="readonly"' : 'required="required"' }}></td>
								<td></td>
							</tr>
							<?php $j = $j+1 ?>
						<?php } ?>
						<?php $i = $i+1 ?>
						</tbody>
					@endforeach

						<tbody>
							<tr>
								<td></td>
								<td>
									@if((Auth::user()->ACCESS == 'VP' && $status == '1') || Auth::user()->ACCESS == 'DVP' && $status <> '1' && $status <> '2')
									<a href="javascript: save_approval()">
										<button class="uk-button btn-success fl-button" type="button">Approve</button>
									</a>
									@endif
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
								</td>
								<td>
									<button class="uk-button uk-button-danger fl-button" type="button" onclick="location.href = '{{ url('txsarmut')}}'">Back</button>
								</td>
								<td></td>
							</tr>
						</tbody>
					</table>
					
				</div>	
			</div>
		</form>
		</div>	
	</div>

	<form id="form_apprsarmut" action="/txsarmut/sarmut_approve" method="POST">
		{{ csrf_field() }}
		<input type="hidden" name="header_sarmut_id" id="header_sarmut_id" value="{{ $header_sarmut_id }}">
	</form>


<!-- metronic -->
<script src="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->   
<!--begin::Page Resources -->
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/forms/widgets/form-repeater.js') }}" type="text/javascript"></script>
<!-- metronic -->

<!-- <script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>
<script src="{{ URL::asset('js/form-repeater.js') }}"></script>
<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script> -->
<script type="text/javascript">
    function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function save_approval()
    {   
		document.forms['form_apprsarmut'].submit();
    }

    function changetextbox(a,b)
    {
    	var e = document.getElementById(a);
    	var c = e.options[e.selectedIndex].value;
    	//alert(c);
    	if (c == "-") {
    		document.getElementById(b).disabled = false;
    		document.getElementById(b).style.color = "black";
    	} 
    	else if(c == "Tidak Ada Kegiatan") {
    		document.getElementById(b).disabled = true;
    		document.getElementById(b).style.color = "blue";
    		document.getElementById(b).value = "0";
    	}
    	else
    	{
    		document.getElementById(b).disabled = true;
    		document.getElementById(b).style.color = "red";
    		document.getElementById(b).value = "0";
    	}
    }

    $('#months').on('select2:select', function (e) {
    	var data = $(this).val();
    	var data2 = {!! json_encode(Session::get('targetind')) !!};
    	var data3 = {!! json_encode(Session::get('targetsubind')) !!};
		var data4 = {!! json_encode(Session::get('realind')) !!};
    	var data5 = {!! json_encode(Session::get('realsubind')) !!};
    	<?php $i = 0 ?>
    	<?php foreach($sarmut_list as $data){ ?>
	    	var target{{ $data->INDICATOR_ID }} = data2['target-{{ $data->INDICATOR_ID }}'][0][data];
	    	$('#target-{{ $data->INDICATOR_ID }}').html(target{{ $data->INDICATOR_ID }});
	    	<?php foreach($sub_in[$i] as $data1){ ?>
	    		var subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '';
				if (!data3['subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}']) {
					subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '-';
				} else {
					subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = data3['subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'][0][data];
				}
	    		$('#subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}').html(subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});

				var subindreal = data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'].findIndex(p => p['MONTH'] == data);
				var subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '';

				if (!data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}']) {
					subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '-';
				} else {
					subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'][subindreal]['ACTUAL_REALISASI'];
				}
				console.log(subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});
				$('#subreal_{{ $data->INDICATOR_ID }}_{{ $data1->INDICATOR_ID }}').val(subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});
	    	<?php } ?>
			<?php $i = $i+1 ?>
    	<?php } ?>
	});

	$('#years').on('select2:select', function (e) {
    	var datatahun = $(this).val();
		var databulan = $('#months').val();
    	var data2 = {!! json_encode(Session::get('targetind')) !!};
    	var data3 = {!! json_encode(Session::get('targetsubind')) !!};
		var data4 = {!! json_encode(Session::get('realind')) !!};
    	var data5 = {!! json_encode(Session::get('realsubind')) !!};
		
    	<?php $i = 0 ?>
    	<?php foreach($sarmut_list as $data){ ?>
			var indtgt = data2['target-{{ $data->INDICATOR_ID }}'].findIndex(p => p['YEAR'] == datatahun);
			// console.log(indtgt);
	    	var target{{ $data->INDICATOR_ID }} = data2['target-{{ $data->INDICATOR_ID }}'][indtgt][databulan];
	    	$('#target-{{ $data->INDICATOR_ID }}').html(target{{ $data->INDICATOR_ID }});
	    	<?php foreach($sub_in[$i] as $data1){ ?>
	    		var subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '';
				if (!data3['subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}']) {
					subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '-';
				} else {
					subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = data3['subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'][0][databulan];
				}
	    		$('#subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}').html(subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});

				var subindreal = data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'].findIndex(p => (p['MONTH'] == databulan && p['YEAR'] == datatahun));
				var subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '';

				if (!data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}']) {
					subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '-';
				} else {
					subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'][subindreal]['ACTUAL_REALISASI'];
				}
				console.log(subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});
				$('#subreal_{{ $data->INDICATOR_ID }}_{{ $data1->INDICATOR_ID }}').val(subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});
	    	<?php } ?>
			<?php $i = $i+1 ?>
    	<?php } ?>
	});

	$(".select2-list").select2({
            allowClear: true
        });
</script>

</body>
</html>