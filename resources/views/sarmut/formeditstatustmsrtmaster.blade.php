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
					<img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/sopReadMore.png') }}" width="65" alt="">
					Edit Status Master Sasaran Mutu
				</span>
			</div>
			
			<div class="fl-table">
				<form id="form_mst_sarmut" action="/sarmut/master_sarmut_save_edit_status_indikator" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="id" id="id" value="{{ $id }}">
					<div class="form-group m-form__group row">
							<div class="col-lg-4">
								<label>
									Directorate:
								</label>
								<br>
								<select style="width: 70% !important;" class="form-control select2-list" id="directorat_list" name="directorat_list" disabled="disabled">
									<option value="">--Directorate--</option>
									@foreach($directorat_list as $org)
									 	@if( $org->DIRECTORATE_ID == $iddir)
											<option value="{{ $org->DIRECTORATE_ID }}-{{ $org->IS_CABANG }}" selected>{{ $org->DIRECTORATE_NAME }}</option>
										@else
											<option value="{{ $org->DIRECTORATE_ID }}-{{ $org->IS_CABANG }}">{{ $org->DIRECTORATE_NAME }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="col-lg-4">
								<label>
									Division/Branch Office:
								</label>
								<br>
								@if($iscabang == '1')
								<select style="width: 70% !important;" class="form-control select2-list" id="organize_struct_list" name="organize_struct_list" disabled="disabled">
									<option value="">--Division/Branch Office--</option>
									@foreach($datalist as $org)
									 	@if( $org->BRANCH_OFFICE_ID == $idbranch)
											<option value="{{ $org->BRANCH_OFFICE_ID  }}-1">{{ $org->BRANCH_OFFICE_NAME }}</option>
										@else
											<option value="{{ $org->BRANCH_OFFICE_ID  }}-1">{{ $org->BRANCH_OFFICE_NAME }}</option>
										@endif
									@endforeach
								</select>
								@else
								<select style="width: 70% !important;" class="form-control select2-list" id="organize_struct_list" name="organize_struct_list" disabled="disabled">
									<option value="">--Division/Branch Office--</option>
									@foreach($datalist as $org)
									 	@if( $org->DIVISION_ID == $iddiv)
											<option value="{{ $org->DIVISION_ID }}-0" selected>{{ $org->DIVISION_NAME }}</option>
										@else
											<option value="{{ $org->DIVISION_ID  }}-0">{{ $org->DIVISION_NAME }}</option>
										@endif
									@endforeach
								</select>
								@endif
							</div>
							<div class="col-lg-4">
								<label>
									Sub Division:
								</label>
								<br>
								<select style="width: 70% !important;" id="sub_division_list" class="form-control select2-list" name="sub_division_list" disabled="disabled">
									<option value="">--Sub Division--</option>
									@foreach($datalist2 as $subdivision)
										@if( $subdivision->SUB_DIVISION_ID == $idsubdiv)
											<option value="{{ $subdivision->SUB_DIVISION_ID }}-{{$subdivision->ORGANIZATION_STRUCTURE_ID}}" selected>{{ $subdivision->SUB_DIVISION_NAME }}</option>
										@else
											<option value="{{ $subdivision->SUB_DIVISION_ID }}-{{$subdivision->ORGANIZATION_STRUCTURE_ID}}">{{ $subdivision->SUB_DIVISION_NAME }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Indicator Name:
								</label>
								<input name="indicator_name" class="uk-input uk-child-width-1-2" type="text" value="{{ $nameindicator }}" placeholder="Indicator Name" disabled>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Inputable:
								</label>
								<br>
								<select style="width: 85% !important;" id="inputable" class="form-control select2-list" name="inputable" disabled="disabled">
									<option value="Y" {{ $inputable == "Y" ? 'selected' : '' }}>Inputable</option>
									<option value="N" {{ $inputable == "N" ? 'selected' : '' }}>Not Inputable</option>
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Sub Division Pengisi:
								</label>
								<br>
								<select style="width: 85% !important;" id="sub_division_pengisi_list" class="form-control select2-list" name="sub_division_pengisi_list" disabled="disabled">
									<option value="">--Sub Division--</option>
									@foreach($subdiv_list as $subdivision)
										@if( $subdivision->SUB_DIVISION_ID == $idsubdivpeng)
											<option value="{{ $subdivision->SUB_DIVISION_ID }}-{{$subdivision->ORGANIZATION_STRUCTURE_ID}}" selected>{{ $subdivision->SUB_DIVISION_NAME }}</option>
										@else
											<option value="{{ $subdivision->SUB_DIVISION_ID }}-{{$subdivision->ORGANIZATION_STRUCTURE_ID}}">{{ $subdivision->SUB_DIVISION_NAME }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								<label>
									Satuan:
								</label>
								<input name="unit" class="uk-input uk-child-width-1-2" type="text" value="{{ $unit }}" placeholder="Satuan" disabled>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Periode Pengisian:
								</label>
								<br>
								<select style="width: 85% !important;" id="periodepengisian" class="form-control select2-list" name="periodepengisian" disabled="disabled">
									<option value="Bulanan" {{ $perpengsisi == "Bulanan" ? 'selected' : '' }}>Bulanan</option>
									<option value="Triwulanan" {{ $perpengsisi == "Triwulanan" ? 'selected' : '' }}>Triwulanan</option>
									<option value="Tahunan" {{ $perpengsisi == "Tahunan" ? 'selected' : '' }}>Tahunan</option>
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Tipe Penjumlahan:
								</label>
								<br>
								<select style="width: 85% !important;" id="tipepenjumlahan" class="form-control select2-list" name="tipepenjumlahan" required="required">
									<option value="=" {{ $tipepenjum == "=" ? 'selected' : '' }}>Sampai Dengan</option>
									<option value=":" {{ $tipepenjum == ":" ? 'selected' : '' }}>Rata-Rata Sampai Dengan</option>
								</select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-7">
								<label>
									Status:
								</label>
								<br>
								<select style="width: 85% !important;" id="status" class="form-control select2-list" name="status">
									<option value="Y" {{ $status == "Y" ? 'selected' : '' }}>AKTIF</option>
									<option value="N" {{ $status == "N" ? 'selected' : '' }}>INAKTIF</option>
								</select>
							</div>
						</div>
					<div>
						<br>
					</div>
					<div>
						<br>
					</div>
					<div>
						<br>
					</div>
					<div>
						<br>
					</div>
					<div>
						<br>
					</div>
					<div>
						<button class="uk-button uk-button-primary fl-button" onclick="save_mst_sarmut(this.form.id);return false;">
							<i class="fa fa-plus"></i>&nbsp;Update
						</button>
						<button onclick="location.href = '{{ url('sarmut')}}'" class="uk-button uk-button-danger fl-button float-right" type="button">Back</button>
					</div>
					
				</form>
			</div>

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
	$(document).ready( function () {
		
		$("#formButton").click(function() {
			$("#form1").toggle();
		});

		$('#sub_division_list').on('select2:select', function (e) {
			var value = $('#sub_division_list').val();
			$('#sub_division_pengisi_list').val(value);
			$('#sub_division_pengisi_list').select2().trigger('change');
		});

		$('#directorat_list').on('change', function(){
			var idgabungan = $(this).val();
			//alert(idgabungan);
			var pisah = idgabungan.split('-');
			var iddir = pisah[0];
			var iscbg = pisah[1];


			if(iscbg == 1)
			{
				$.get('{{ url('getdivbranch/getbranch') }}/'+iddir, function (data) {
					$('#organize_struct_list').empty();
					$('#organize_struct_list').append('<option value="">Pilih Branch Office</option>');
					$.each(data, function (index, element) {
						$('#organize_struct_list').append('<option value="'+ element.BRANCH_OFFICE_ID +'-'+'1'+'">'+ element.BRANCH_OFFICE_NAME +'</option>');
					});
					$("#organize_struct_list").select2({
						allowClear: true
					});
				});	
			}
			else
			{
				$.get('{{ url('getdivbranch/getdiv') }}/'+iddir, function (data) {
					$('#organize_struct_list').empty();
					$('#organize_struct_list').append('<option value="">Pilih Divisi</option>');
					$.each(data, function (index, element) {
						$('#organize_struct_list').append('<option value="'+ element.DIVISION_ID +'-'+'0'+'">'+ element.DIVISION_NAME +'</option>');
					});
					$("#organize_struct_list").select2({
						allowClear: true
					});
				});	
			}
			
		});

		$('#organize_struct_list').on('change', function(){
			var idgabungan = $(this).val();
			//alert(idgabungan);
			var pisah = idgabungan.split('-');
			var iddivbranch = pisah[0];
			var iscbg = pisah[1];


			if(iscbg == 1)
			{
				$.get('{{ url('getsubdiv/getsubdivbranch') }}/'+iddivbranch, function (data) {
					$('#sub_division_list').empty();
					$('#sub_division_list').append('<option value="">Pilih Sub Divisi</option>');
					$.each(data, function (index, element) {
						$('#sub_division_list').append('<option value="'+ element.SUB_DIVISION_ID +'-'+element.ORGANIZATION_STRUCTURE_ID+'">'+ element.SUB_DIVISION_NAME +'</option>');
					});
					$("#sub_division_list").select2({
						allowClear: true
					});
				});	
			}
			else
			{
				$.get('{{ url('getsubdiv/getsubdivdivisi') }}/'+iddivbranch, function (data) {
					$('#sub_division_list').empty();
					$('#sub_division_list').append('<option value="">Pilih Sub Divisi</option>');
					$.each(data, function (index, element) {
						$('#sub_division_list').append('<option value="'+ element.SUB_DIVISION_ID +'-'+element.ORGANIZATION_STRUCTURE_ID+'">'+ element.SUB_DIVISION_NAME +'</option>');
					});
					$("#sub_division_list").select2({
						allowClear: true
					});
				});	
			}
			
		});

	} );

	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function save_mst_sarmut(formid)
    {   
		submit_form(formid);
    }

	$(".select2-list").select2({
            allowClear: true
        });
</script>
	
</body>
</html>
