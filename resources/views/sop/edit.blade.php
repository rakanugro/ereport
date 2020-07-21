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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
					<img class="uk-preserve-width uk-border-circle" src="{{ URL::asset('templateslide/assets/img/icon/sopReadMore.png') }}" width="65" alt="">
					EDIT SOP
				</span>
			</div> 
			
			<div class="fl-table">
				<form id="edit" action="/update" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div>
						<input type="hidden" name="SOP_ID" value="{{$SOPData[0]->SOP_ID}}">
						<input id="CountProc" value=1 hidden>
						<input id="CountWI" name="CountWI" value=0 hidden>
						<input id="CountInd" name="CountInd" value=1 hidden>
						<input id="SOPfilePath" name="SOPfilePath" hidden>
						<b>Sub Divisi</b>
						<br>
                        <select id="subdivisi_id" class="form-control select2-list" name="subdivisi_id" required>
                            <option value="" disabled selected hidden>--------Sub Divisi-------</option>
                            @foreach($org_list as $organization)
								@if($SOPData[0]->ORGANIZATION_STRUCTURE_ID == $organization->ORGANIZATION_STRUCTURE_ID)
									<option value="{{ $organization->ORGANIZATION_STRUCTURE_ID }}"selected>{{ $organization->SUB_DIVISION_NAME}}</option>
								@else
									<option value="{{ $organization->ORGANIZATION_STRUCTURE_ID }}">{{ $organization->SUB_DIVISION_NAME}}</option>
								@endif
                            @endforeach
                        </select>
					</div>
					<div>
						<b>Akses User</b>
						<br>
						<select id="g_user_id" class="form-control select2-list" name="g_user_id" required style="width:170px" text-align=center>
							<option value="" disabled selected hidden>---Akses User---</option>
								@if($SOPData[0]->G_Code == 'ALL')
									<option value="ALL" selected>PUBLIC</option>
									<option value="Divisi">PRIVATE</option>
								@else if($SOPData[0]->G_Code == 'Divisi')
									<option value="ALL">PUBLIC</option>
									<option value="Divisi" selected>PRIVATE</option>
								@endif
						</select>
					</div>
						<div>
							<table id="TabelProc" width=100% >
								<tr style="text-align:center">
									<td>
									</td>
									<td>
										<b>No</b>
									</td>
									<td>
										<b>Name</b>
									</td>
									<td>
										<b>Keterangan</b>
									</td>
								</tr>
								<tr id="trProcValue">
									<td style="width:50px">
										<img src="{{ URL::asset("templateslide/assets/img/image/Gambar_SOP.jpg") }}">
									</td>
									<td style="width:150px">
										<input name="SOPNO" class="uk-input uk-child-width-1-2 no" type="text" onchange="check_SOP_Code()" required value="{{$SOPData[0]->No_SOP}}">
									</td>
									<td style="width:200px">
										<input name="SOPNAME" class="uk-input uk-child-width-1-2 nama" type="text" required value="{{$SOPData[0]->Nama_SOP}}">
									</td>
									<td style="width:350px">
										@if($SOPData[0]->SOP_No_Revisi != '')
											<label name="SOPKeterangan">Revisi dari {{$SOPData[0]->SOP_No_Revisi}} <br/> Alasan : {{$SOPData[0]->SOP_Alasan_Revisi}}</label>
										@endif
									</td>
								</tr>
								<tr>
									<td style="width:50px;text-align:right" colspan="15">
										<button type="button" style="font-size: large;width:60px" id="BttnAddWI" onclick="CreateWI()" title="Add Work Instruction"><i class="fa fa-plus"></i>  <i class="fa fa-list"></i></button>									
										<button type="button" style="font-size: large;width:60px" id="BttnDelWI" onclick="DeleteWI()" title="Remove Work Instruction"><i class="fa fa-minus"></i>  <i class="fa fa-list"></i></button>
										&nbsp;&nbsp;
										<button type="button" style="font-size: large;width:60px" id="BttnAddID" onclick="CreateInd()" title="Add Indicator"><i class="fa fa-plus"></i>  <i class="fa fa-line-chart"></i></button>
										<button type="button" style="font-size: large;width:60px" id="BttnDelID" onclick="DeleteInd()" title="Remove Indicator"><i class="fa fa-minus"></i>  <i class="fa fa-line-chart"></i></button>
										&nbsp;&nbsp;
										<button type="button" style="font-size: large;width:60px" id="BttnAddWI" onclick="CreateWI()" title="Revisi"><i class="fa fa-wrench"></i></button>
										&nbsp;&nbsp;
										<button type="button" style="font-size: large;width:60px" id="BttnAddWI2" onclick="CreateWI()" title="Preview"><i class="fa fa-file-pdf-o"></i></button>
										&nbsp;&nbsp;
										<button type="button" style="font-size: large;width:60px" id="BttnAddWI3" onclick="CreateWI()" title="Inactive"><i class="fa fa-times-circle"></i></button>
										&nbsp;&nbsp;
										<input type="file" id="SOPfile" name="SOPfile" onchange="return fileValidation(this,1,1);" style="font-size: large;" required>
									</td>
								</tr>
								<tr>
									<td colspan="12" id="WILoc">
									<?php $count =  0;?>
										@foreach($WIData as $WIRow)
										<?php $count = $count+1 ;?>
											<table id="TabelWI{{$count}}" width=100% >
												<tr style="text-align:center">
													<td style="width:40px">
													</td>
													<td>
													</td>
													<td>
														<b>No</b>
													</td>
													<td>
														<b>Name</b>
													</td>
													<td>
														<b>Keterangan</b>
													</td>
												</tr>
												<tr>
													<td style="width:40px">
													</td>
													<td style="width:50px">
														<img src='{{ URL::asset("templateslide/assets/img/image/Gambar_WI.png") }}'>
													</td>
													<td style="width:150px">
														<input name="WINO{{$count}}" class="uk-input uk-child-width-1-2 no{{$count}}" type="text" value="{{$WIRow->No_WI}}" onchange="check_WI_Code()">
													</td>
													<td style="width:200px">
														<input name="WINAME{{$count}}" class="uk-input uk-child-width-1-2 nama{{$count}}" type="text" value="{{$WIRow->Nama_WI}}">
													</td>
													<td style="width:350px">
														<label name="WIKeterangan">Revisi dari {{$WIRow->WI_No_Revisi}} <br/> Alasan : {{$WIRow->WI_Alasan_Revisi}}</label>
													</td>
													<td style="width:50px;text-align:center">
														<button type="button" style="font-size: large;width:100%" id="BttnNewForm" onclick="CreateForm()" title="Add Form"><i class="fa fa-plus"></i><b> FM</b></button>
													</td>
													<td style="width:50px;text-align:center">
														<button type="button" style="font-size: large;width:100%" id="BttnDelForm" onclick="DeleteForm()" title="Remove Form"><i class="fa fa-minus"></i><b> FM</b></button>
													</td>
													<td style="width:50px;text-align:center">
														<button type="button" style="font-size: large;width:100%" id="BttnAddWI" onclick="CreateWI()" title="Revisi"><i class="fa fa-undo"></i></button>
													</td>
													<td style="width:50px;text-align:center">
														<button type="button" style="font-size: large;width:100%" id="BttnAddWI2" onclick="CreateWI()" title="Preview"><i class="fa fa-file-pdf-o"></i></button>
													</td>
													<td style="width:50px;text-align:center">
														<button type="button" style="font-size: large;width:100%" id="BttnAddWI3" onclick="CreateWI()" title="Inactive"><i class="fa fa-times-circle"></i></button>
													</td>
													<td>
														<input type="file" id="WIfile" name="WIfile" onchange="return fileValidation(this,2,'');" style="font-size: large;">
													</td>
												</tr>
												<tr>
													<td colspan="12" id="FormLoc">
														<?php $FMcount = 0 ;?>
														@foreach($FMData as $FMRow)
															@if($WIRow->WI_ID==$FMRow->WI_ID)
																<?php $FMcount = $FMcount+1 ;?>
																<table id="TabelForm{{$count}}{{$FMcount}}" width=100% >
																	<tr style="text-align:center">
																		<td></td>
																		<td></td>
																		<td></td>
																		<td>
																			<b>No</b>
																		</td>
																		<td>
																			<b>Name</b>
																		</td>
																		<td>
																			<b>Keterangan</b>
																		</td>
																	</tr>
																	<tr>
																		<td style="width:40px">
																		</td>
																		<td style="width:40px">
																		</td>
																		<td style="width:50px">
																			<img src="{{ URL::asset("templateslide/assets/img/image/Gambar_Form.png") }}">
																		</td>
																		<td style="width:150px">
																			<input name="FMNO{{$count}}{{$FMcount}}" class="uk-input uk-child-width-1-2 no{{$count}}{{$FMcount}}" type="text" value="{{$FMRow->No_FM}}" onchange="check_WI_Code()">
																		</td>
																		<td style="width:200px">
																			<input name="FMNAME{{$count}}{{$FMcount}}" class="uk-input uk-child-width-1-2 nama{{$count}}{{$FMcount}}" type="text" value="{{$FMRow->Nama_FM}}">
																		</td>
																		<td style="width:350px">
																			<label name="FMKeterangan">Revisi dari {{$FMRow->FM_No_Revisi}} <br/> Alasan : {{$FMRow->FM_Alasan_Revisi}}</label>
																		</td>
																		<td style="width:50px;text-align:center">
																			<button type="button" style="font-size: large;width:100%" id="BttnAddWI" onclick="CreateWI()" title="Revisi"><i class="fa fa-undo"></i></button>
																		</td>
																		<td style="width:50px;text-align:center">
																			<button type="button" style="font-size: large;width:100%" id="BttnAddWI2" onclick="CreateWI()" title="Preview"><i class="fa fa-file-pdf-o"></i></button>
																		</td>
																		<td style="width:50px;text-align:center">
																			<button type="button" style="font-size: large;width:100%" id="BttnAddWI3" onclick="CreateWI()" title="Inactive"><i class="fa fa-times-circle"></i></button>
																		</td>
																		<td>
																		<input type="file" id="Formfile'+id+''+count+'" name="Formfile'+id+''+count+'" onchange="return fileValidation(this,3,'+id+''+count+');" style="font-size: large;">
																		</td>
																	</tr>
																</table>
																@endif
														@endforeach
													</td>	
												</tr>
											</table>
										@endforeach
									</td>
								</tr>
								<tr>
									<td style="width:50px">
									</td>
								</tr>
								<tr>
									<table id="TabelInd">
										<tr>
											<td style="width:50px">
											</td>
											<td style="text-align:center;width:100px;">
												<b>Indicator Name</b>
											</td>
										</tr>
										<tr id="trInd1">
											<td style="text-align:center">
												<b>1</b>
											</td>
											<td style="width:100px">
												<select id="IndName1" class="form-control select2-list" name="IndName1" required">
													<option value="" disabled selected hidden>-----------Pilih Indikator Sasaran Mutu-----------</option>
													@foreach($Indicator as $Ind)
														<option value="{{ $Ind->INDICATOR_ID }}">{{ $Ind->INDICATOR_NAME}}</option>
													@endforeach
												</select>
											</td>
										</tr>
									</table>
								</tr>
							</table>
						</div>
					<div>
						<br/>
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
	function CreateWI()
	{
		var count=parseInt($("#CountWI").val())+1;
		var Code = $("#trProcValue .no").val();
		if(count<10)
		{
			var CodeNum='0'+count
		}
		else
		{
			var CodeNum=count
		}
		var TempTabelWI='<table id="TabelWI'+count+'" width=100% >'+
							'<tr style="text-align:center">'+
								'<td style="width:40px">'+
								'</td>'+
								'<td style="width:50px">'+
									'<input name="CountForm'+count+'" id="CountForm'+count+'" value=0 hidden>'+
								'</td>'+
								'<td style="width:200px">'+
									'<b>No</b>'+
								'</td>'+
								'<td style="width:400px">'+
									'<b>Nama</b>'+
								'</td>'+
							'</tr>'+
							'<tr>'+
								'<td style="width:40px">'+
								'</td>'+
								'<td style="width:50px">'+
									'<img src="{{ URL::asset("templateslide/assets/img/image/Gambar_WI.png") }}">'+
								'</td>'+
								'<td style="width:200px">'+
									'<input name="WINO'+count+'" class="uk-input uk-child-width-1-2 no'+count+'" type="text" value="'+Code.replace('QP','WI')+'-'+CodeNum+'" onchange="check_WI_Code('+count+')">'+
								'</td>'+
								'<td style="width:400px">'+
									'<input name="WINAME'+count+'" class="uk-input uk-child-width-1-2 nama'+count+'" type="text">'+
								'</td>'+
								'<td style="width:50px;text-align:center">'+
									'<button type="button" style="font-size: large;width:100%" id="BttnNewForm'+count+'" onclick="CreateForm('+count+')" title="Add Form"><i class="fa fa-plus"></i><b> FM</b></button>'+
								'</td>'+
								'<td style="width:50px;text-align:center">'+
									'<button type="button" style="font-size: large;width:100%" id="BttnDelForm'+count+'" onclick="DeleteForm('+count+')" title="Remove Form"><i class="fa fa-minus"></i><b> FM</b></button>'+
								'</td>'+
								'<td>'+
									'<input type="file" id="WIfile'+count+'" name="WIfile'+count+'" onchange="return fileValidation(this,2,'+count+');" style="font-size: large;">'+
								'</td>'+
							'</tr>'+
							'<tr>'+
								'<td colspan="10" id="FormLoc'+count+'">'+
								'</td>'+
							'</tr>';
						'</table>';

		$("#WILoc").append(TempTabelWI);
		$("#CountWI").val(parseInt($("#CountWI").val())+1);
	}

	function DeleteWI()
	{
		var count=parseInt($("#CountWI").val());
		//alert(count);
		$("#TabelWI"+count).remove();
		$("#CountWI").val(parseInt($("#CountWI").val())-1);
	}

	function CreateInd()
	{
		var count=parseInt($("#CountInd").val())+1;
		//alert(count);
		var TempTabelInd='<tr id="trInd'+count+'">'+
							'<td style="text-align:center">'+
								'<b>'+count+'</b>'+
							'</td>'+
							'<td style="width:100px">'+
								'<select id="IndName'+count+'" class="form-control select2-list" name="IndName'+count+'" required">'+
									'<option value="" disabled selected hidden>-----------Pilih Indikator Sasaran Mutu-----------</option>'+
									'@foreach($Indicator as $Ind)'+
										'<option value="{{ $Ind->INDICATOR_ID }}">{{ $Ind->INDICATOR_NAME}}</option>'+
									'@endforeach'+
								'</select>'+
							'</td>'+
						'</tr>';

		$("#TabelInd").append(TempTabelInd);
		$("#CountInd").val(parseInt($("#CountInd").val())+1);

		$(".select2-list").select2({
			allowClear: true
		});
	}

	function DeleteInd()
	{
		var count=parseInt($("#CountInd").val());
		if(count>1)
		{
			$("#trInd"+count).remove();
			$("#CountInd").val(parseInt($("#CountInd").val())-1);
		}
	}
	
	function CreateForm(id)
	{
		var count=parseInt($("#CountForm"+id).val())+1;
		var Code = $("#TabelWI"+id+" .no"+id).val();
		if(count<10)
		{
			var CodeNum='0'+count
		}
		else
		{
			var CodeNum=count
		}
		var TempTabelForm='<table id="TabelForm'+id+''+count+'" width=100% >'+
							'<tr style="text-align:center">'+
								'<td style="width:40px">'+
								'</td>'+
								'<td style="width:40px">'+
								'</td>'+
								'<td style="width:50px">'+
								'</td>'+
								'<td style="width:200px">'+
									'<b>No</b>'+
								'</td>'+
								'<td style="width:400px">'+
									'<b>Name</b>'+
								'</td>'+
							'</tr>'+
							'<tr>'+
								'<td style="width:40px">'+
								'</td>'+
								'<td style="width:40px">'+
								'</td>'+
								'<td style="width:50px">'+
									'<img src="{{ URL::asset("templateslide/assets/img/image/Gambar_Form.png") }}">'+
								'</td>'+
								'<td style="width:200px">'+
									'<input name="FMNO'+id+''+count+'" class="uk-input uk-child-width-1-2 no'+id+''+count+'" type="text" value="'+Code.replace('WI','FM')+'-'+CodeNum+'" onchange="check_Form_Code('+id+','+count+')">'+
								'</td>'+
								'<td style="width:400px">'+
									'<input name="FMNAME'+id+''+count+'" class="uk-input uk-child-width-1-2 nama" type="text">'+
								'</td>'+
								'<td style="width:3px">'+
								'</td>'+
								'<td>'+
								'<input type="file" id="Formfile'+id+''+count+'" name="Formfile'+id+''+count+'" onchange="return fileValidation(this,3,'+id+''+count+');" style="font-size: large;">'+
								'</td>'+
							'</tr>'+
						'</table>';

		$("#FormLoc"+id).append(TempTabelForm);
		$("#CountForm"+id).val(parseInt($("#CountForm"+id).val())+1);
	}

	function DeleteForm(id)
	{
		var count=parseInt($("#CountForm"+id).val());
		//alert(count);
		$("#TabelForm"+id+''+count).remove();
		$("#CountForm"+id).val(parseInt($("#CountForm"+id).val())-1);
	}
	
	function GetVal()
	{
		 //var Value=$("#TabelWI1 .no").val();
		// var Value2=$("#TabelWI1 .nama").val();
		// var Value3=$("#TabelWI1 .alasan").val();
		// //var Value=$("#CountProc").val();

		// alert(Value+Value2+Value3);
		//$('#TabelWI2').remove();
	}

	function fileValidation(file,type,id){
		if(type==1)
		{
			var filename='SOPfile';
		}
		else if(type==2)
		{
			var filename='WIfile'+id;
		}
		else if(type==3)
		{
			var filename='Formfile'+id;
		}
		var fileInput = document.getElementById(filename);
		var filePath = fileInput.value;
		var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf|\.xls|\.xlsx)$/i;
		var FileSize = file.files[0].size / 15120 / 15120;
		if(!allowedExtensions.exec(filePath) || FileSize > 15){
			alert('file harus pdf dan size max 15MB');
			fileInput.value = '';
			return false;
		}
		$("#SOPfilePath").val(document.getElementById(filename).value);
	}

	function check_SOP_Code()
	{
		var Code = $("#trProcValue .no").val();
		$.ajax({
			type: "GET",
			url: "{{ url('/sop_check') }}",
			data: {Code : Code}, 
			cache: false,
			success: function(data){
					if(data == 0)
					{
					}
					else
					{
						alert('No SOP '+Code+' Sudah Ada !!!');
						$("#trProcValue .no").val('');
					}
			}
		});
	}
	function check_WI_Code(id)
	{
		var Code = $("#trProcValue .no").val();
		if(id<10)
		{
			var CodeNum='0'+id
		}
		else
		{
			var CodeNum=id
		}
		$("#TabelWI"+id+" .no"+id).val(Code+'-'+CodeNum);
	}
	function check_Form_Code(idWI,id)
	{
		var Code = $("#TabelWI"+id+" .no"+id).val();
		if(id<10)
		{
			var CodeNum='0'+id
		}
		else
		{
			var CodeNum=id
		}
		$("#TabelForm"+idWI+""+id+" .no"+idWI+""+id).val(Code+'-'+CodeNum);
	}

	$(".select2-list").select2({
			allowClear: true
		});
</script>