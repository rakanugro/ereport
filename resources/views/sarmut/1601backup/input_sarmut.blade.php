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
					<img class="uk-preserve-width uk-border-circle" src="templateslide/assets/img/icon/sopReadMore.png" width="65" alt="">
					Input Sasaran Mutu Per {{ $month }} {{ $year }}
				</span>
				<span style="float:right;margin-top:15px; color: red;">
					Note* (Kalau keterangan dipilih, maka realisasi tidak dapat diubah)
				</span>
			</div>
			
		<form id="form_sarmut" action="/txsarmut/sarmut_save" method="POST">	
			<div class="col-md-12 fl-table">
				{{ csrf_field() }}
				<input type="hidden" name="years" id="years" value="{{ $year }}"><br>
				<input type="hidden" name="months" id="months" value="{{ $month }}"><br>
					
				<div class="uk-overflow-auto">
				
					<table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
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
								<th width="15%">Alasan</th>
								<th width="10%"></th>
							</tr>
						</thead>
						<?php $i = 0 ?>
					@foreach($sarmut_list as $data)
						<input type="hidden" name="indicator_id[]" id="indicator_id[]" value="{{ $data->INDICATOR_ID }}">
						<input type="hidden" name="sarmut_id[]" id="sarmut_id[]" value="{{ $data->SASARAN_MUTU_ID }}">
						<tbody>
							<tr>
								<td><img class="uk-preserve-width uk-border-circle" src="templateslide/assets/img/icon/i1.png" width="45" alt=""></td>
								<td>{{ $data->SUB_DIVISION_NAME }}</td>
								<td>{{ $data->INDICATOR_NAME }}</td>
								<td>{{ $data->PERIODE_PENGISIAN }}</td>
								<td style="text-align: center !important;">{{ $data->UNIT }}</td>
								<td style="text-align: center !important;">{{ $data->POLARITAS }}</td>
								<td id="target-{{ $data->INDICATOR_ID }}">{{ $target_ind_list[$i] <> null ? $target_ind_list[$i]->TARGET : 0 }}</td>
								<td>
									@if( $data->INPUTABLE == "Y")
									<input style="width: 100% !important;" class="col-md-10 uk-input" type="number" step="any" name="actual[]" id="actual{{$i}}" value="{{ $hasil[$i] <> null ? $hasil[$i] : 0 }}"></td>
									@elseif( $data->INPUTABLE == "N" )
									<input style="width: 100% !important; background-color: #f0f5f5	 !important;" class="col-md-10 uk-input" type="number" readonly="readonly" step="any" name="actual[]" id="actual{{$i}}" value="{{ $hasil[$i] <> null ? $hasil[$i] : 0 }}"></td>
									@endif
								<td>
									@if($data->INPUTABLE == "Y" )
									<select style="width: 100% !important;" id="remark{{$i}}" class="form-control select2-list" name="remark[]" required="required" onchange="changetextbox('remark{{$i}}','actual{{$i}}')">
										<option value="-">--Keterangan--</option>
										<option value="Tidak Ada Kegiatan">Tidak Ada Kegiatan</option>
										<option value="Data Kurang">Data Kurang</option>
									</select>
									@elseif( $data->INPUTABLE == "N" )
									<input type="text" style="width: 100% !important; background-color: #f0f5f5	 !important;" id="remark{{$i}}" class="form-control" name="remark[]" value="Belum Diukur" readonly="readonly">
									@endif
								</td>
								<td>
									<select style="width: 110% !important;" id="alasan{{$i}}" class="form-control select2-list" name="alasan[]" required="required">
										<option value="-">--Alasan--</option>
										<option value="Faktor Cuaca Hujan">Faktor Cuaca Hujan</option>
										<option value="Dimensi Barang Beragam">Dimensi Barang Beragam</option>
										<option value="TKBM Belum Optimal">TKBM Belum Optimal</option>
										<option value="Tempat Penumpukan Jauh">Tempat Penumpukan Jauh</option>
										<option value="Kemasan Mudah Rusak">Kemasan Mudah Rusak</option>
										<option value="Menunggu Kesiapan Suhu Muatan">Menunggu Kesiapan Suhu Muatan</option>
										<option value="Pola Operasi Yang Tidak Tepat">Pola Operasi Yang Tidak Tepat</option>
										<option value="Ada Masalah Vendor">Ada Masalah Vendor</option>
										<option value="Sumber Daya Tidak Tersedia">Sumber Daya Tidak Tersedia</option>
										<option value="Lama Approved Atasan">Lama Approved Atasan</option>
										<option value="Menunggu Data Dari Bagian Lain">Menunggu Data Dari Bagian Lain</option>
										<option value="Kegiatan Dibatalkan">Kegiatan Dibatalkan</option>
										<option value="Kegiatan Diundur">Kegiatan Diundur</option>
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
								<td id="subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}">{{ $target_subind_list[$j] <> null ? $target_subind_list[$j]->TARGET : 0 }}</td>
								<td><input  type="number" name="subreal_{{ $data->INDICATOR_ID }}_{{ $data1->INDICATOR_ID }}" id="subreal_{{ $data->INDICATOR_ID }}_{{ $data1->INDICATOR_ID }}"  class="col-md-6 uk-input" value="{{ $real_subind_list[$j] <> null ? $real_subind_list[$j]->ACTUAL_REALISASI : 0 }}" placeholder="Realisasi" {{ 'required="required"' }}></td>
								<td><input  class="col-md-6 uk-input" type="text" name="remark[]" id="remark[]" value="{{ $real_subind_list[$j] <> null ? $real_subind_list[$j]->KETERANGAN : '' }}" placeholder="Keterangan" {{ $sub_disabled_list[$i] == 'disabled' ? 'readonly="readonly"' : 'required="required"' }}></td>
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
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									<button class="uk-button uk-button-primary fl-button" type="submit">Simpan</button>
								</td>
								<td>
									<button class="uk-button uk-button-danger fl-button" type="button" onclick="location.href = '{{ url('txsarmut')}}'">Cancel</button>
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

	function save_sarmut(formid)
    {   
		submit_form(formid);
    }

    function changetextbox(a,b)
    {
    	var e = document.getElementById(a);
    	var c = e.options[e.selectedIndex].value;
    	//alert(c);
    	if (c == "-") {
    		document.getElementById(b).readOnly = false;
    		document.getElementById(b).style.color = "black";
    		document.getElementById(b).style.backgroundColor = "white";
    	} 
    	else if(c == "Tidak Ada Kegiatan") {
    		document.getElementById(b).readOnly = true;
    		document.getElementById(b).style.color = "blue";
    		document.getElementById(b).value = "0";
    		// document.getElementById(b).style.backgroundColor = "gray";
    	}
    	else
    	{
    		document.getElementById(b).readOnly = true;
    		document.getElementById(b).style.color = "red";
    		document.getElementById(b).value = "0";
    		// document.getElementById(b).style.backgroundColor = "gray";
    	}
    }


 //    $('#months').on('select2:select', function (e) {
 //    	var data = $(this).val();
 //    	var data2 = {!! json_encode(Session::get('targetind')) !!};
 //    	var data3 = {!! json_encode(Session::get('targetsubind')) !!};
	// 	var data4 = {!! json_encode(Session::get('realind')) !!};
 //    	var data5 = {!! json_encode(Session::get('realsubind')) !!};
 //    	<?php $i = 0 ?>
 //    	<?php foreach($sarmut_list as $data){ ?>
	//     	var target{{ $data->INDICATOR_ID }} = data2['target-{{ $data->INDICATOR_ID }}'][0][data];
	//     	$('#target-{{ $data->INDICATOR_ID }}').html(target{{ $data->INDICATOR_ID }});
	//     	<?php foreach($sub_in[$i] as $data1){ ?>
	//     		var subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '';
	// 			if (!data3['subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}']) {
	// 				subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '-';
	// 			} else {
	// 				subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = data3['subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'][0][data];
	// 			}
	//     		$('#subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}').html(subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});

	// 			var subindreal = data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'].findIndex(p => p['MONTH'] == data);
	// 			var subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '';

	// 			if (!data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}']) {
	// 				subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '-';
	// 			} else {
	// 				subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'][subindreal]['ACTUAL_REALISASI'];
	// 			}
	// 			console.log(subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});
	// 			$('#subreal_{{ $data->INDICATOR_ID }}_{{ $data1->INDICATOR_ID }}').val(subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});
	//     	<?php } ?>
	// 		<?php $i = $i+1 ?>
 //    	<?php } ?>
	// });

	// $('#years').on('select2:select', function (e) {
 //    	var datatahun = $(this).val();
	// 	var databulan = $('#months').val();
 //    	var data2 = {!! json_encode(Session::get('targetind')) !!};
 //    	var data3 = {!! json_encode(Session::get('targetsubind')) !!};
	// 	var data4 = {!! json_encode(Session::get('realind')) !!};
 //    	var data5 = {!! json_encode(Session::get('realsubind')) !!};
		
 //    	<?php $i = 0 ?>
 //    	<?php foreach($sarmut_list as $data){ ?>
	// 		var indtgt = data2['target-{{ $data->INDICATOR_ID }}'].findIndex(p => p['YEAR'] == datatahun);
	// 		// console.log(indtgt);
	//     	var target{{ $data->INDICATOR_ID }} = data2['target-{{ $data->INDICATOR_ID }}'][indtgt][databulan];
	//     	$('#target-{{ $data->INDICATOR_ID }}').html(target{{ $data->INDICATOR_ID }});
	//     	<?php foreach($sub_in[$i] as $data1){ ?>
	//     		var subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '';
	// 			if (!data3['subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}']) {
	// 				subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '-';
	// 			} else {
	// 				subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = data3['subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'][0][databulan];
	// 			}
	//     		$('#subtarget-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}').html(subtarget{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});

	// 			var subindreal = data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'].findIndex(p => (p['MONTH'] == databulan && p['YEAR'] == datatahun));
	// 			var subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '';

	// 			if (!data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}']) {
	// 				subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = '-';
	// 			} else {
	// 				subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }} = data5['subreal-{{ $data->INDICATOR_ID }}-{{ $data1->INDICATOR_ID }}'][subindreal]['ACTUAL_REALISASI'];
	// 			}
	// 			console.log(subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});
	// 			$('#subreal_{{ $data->INDICATOR_ID }}_{{ $data1->INDICATOR_ID }}').val(subreal{{ $data->INDICATOR_ID }}{{ $data1->INDICATOR_ID }});
	//     	<?php } ?>
	// 		<?php $i = $i+1 ?>
 //    	<?php } ?>
	// });

	$(".select2-list").select2({
            allowClear: true
        });
</script>

</body>
</html>