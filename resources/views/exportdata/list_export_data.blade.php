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
<link href="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic2/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />


<script src="{{ URL::asset('templateslide/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/uikit/js/uikit.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/datepicker/moment.min.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/datepicker/daterangepicker.js') }}"></script>

<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.marquee.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.pause.js') }}"></script>
<script src="{{ URL::asset('templateslide/assets/js/marquee/jquery.easing.min.js') }}"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<link  href="{{ URL::asset('templateslide/assets/js/datatableptkak/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('templateslide/assets/js/datatableptkak/jquery.dataTables.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<script>
	$(document).ready( function () {
		$('#DDLDir').on('change', function(){
			var idgabungan = $(this).val();
			//alert(idgabungan);
			var pisah = idgabungan.split('-');
			var iddir = pisah[0];
			var iscbg = pisah[1];
            //alert($('#UserAuth').text());
            if($('#UserAuth').text()=='ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU'||$('#UserAuth').text()=='DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||$('#UserAuth').text()=='VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
            {
                if(iscbg == 1)
                {
                    $.get('{{ url('getdivbranch/getbranch') }}/'+iddir, function (data) {
                        $('#DDLDivCab').empty();
                        $('#DDLDivCab').append('<option value="ALL">All</option>');
                        $.each(data, function (index, element) {
                            $('#DDLDivCab').append('<option value="'+ element.BRANCH_OFFICE_ID +'-'+'1'+'">'+ element.BRANCH_OFFICE_NAME +'</option>');
                        });
                        $("#DDLDivCab").select2({
                            allowClear: true
                        });
                    });	
                }
                else
                {
                    $.get('{{ url('getdivbranch/getdiv') }}/'+iddir, function (data) {
                        //alert(data);
                        $('#DDLDivCab').empty();
                        $.each(data, function (index, element) {
                            $('#DDLDivCab').append('<option value="'+ element.DIVISION_ID +'-'+'0'+'">'+ element.DIVISION_NAME +'</option>');
                        });
                        $("#DDLDivCab").select2({
                            allowClear: true
                        });
                    });	
                }
            }
		});

		$('#DDLDivCab').on('change', function (){
            var idgabungan = $(this).val();
            var pisah = idgabungan.split('-');
			var iddivbranch = pisah[0];
			var iscbg = pisah[1];
            
            if($('#UserAuth').text()=='ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU'||$('#UserAuth').text()=='DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||$('#UserAuth').text()=='VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
            {
                if(iscbg == 1)
                {
                    $.get('{{ url('getsubdiv/getsubdivbranch') }}/'+iddivbranch, function (data) {
                        $('#DDLSubDiv').empty();
                        $('#DDLSubDiv').append('<option value="ALL">All</option>');
                        $.each(data, function (index, element) {
                            $('#DDLSubDiv').append('<option value="'+ element.SUB_DIVISION_ID +'-'+element.ORGANIZATION_STRUCTURE_ID+'">'+ element.SUB_DIVISION_NAME +'</option>');
                        });
                        $("#DDLSubDiv").select2({
                            allowClear: true
                        }); 
                    });	
                }
                else
                {
                    $.get('{{ url('getsubdiv/getsubdivdivisi') }}/'+iddivbranch, function (data) {
                        $('#DDLSubDiv').empty();
                        $('#DDLSubDiv').append('<option value="ALL">All</option>');
                        $.each(data, function (index, element) {
                            $('#DDLSubDiv').append('<option value="'+ element.SUB_DIVISION_ID +'-'+element.ORGANIZATION_STRUCTURE_ID+'">'+ element.SUB_DIVISION_NAME +'</option>');
                        });
                        $("#DDLSubDiv").select2({
                            allowClear: true
                        });
                    });	
                }
            }
		});
	} );
</script>
<style>
    .uk-modal-dialog{
        margin-top:70px !important;
        width:900px !important;
        border-radius: 10px;
    }
    #form1{
        display:none;

    }
    #form2{
        display:none;

    }
    #form3{
        display:none;

    }
    #form4{
        display:none;

    }
    #form5{
        display:none;

    }
    #form6{
        display:none;

    }
    #form7{
        display:none;

    }
    #formindicatorcabangpercabang{
        display: none;
    }
    #formindicatordivisiperdivisi{
        display: none;
    }
    #tableindicatorcabangpercabang{
        display: none;
    }
    #tableindicatordivisiperdivisi{
        display: none;
    }
    #formindicatorcabang{
        display: none;
    }
    #tableindicatorcabang{
        display: none;
    }
    #formindicatorpusat{
        display: none;
    }
    #tableindicatorpusat{
        display: none;
    }
    #formtercapaipusat{
        display: none;
    }
    #tabletercapaipusat{
        display: none;
    }
     #formtidaktercapaipusat{
        display: none;
    }
    #tabletidaktercapaipusat{
        display: none;
    }
    #formtercapaicabang{
        display: none;
    }
    #tabletercapaicabang{
        display: none;
    }
    #formtidaktercapaicabang{
        display: none;
    }
    #tabletidaktercapaicabang{
        display: none;
    }
     #formketepatanlaporan{
        display: none;
    }
    #tableketepatanlaporan{
        display: none;
    }
    #formStatSarmut{
        display: none;
    }
    #tableStatSarmut{
        display: none;
    }
    #formdetailkategorisd{
        display: none;
    }
    #tabledetailkategorisd{
        display: none;
    }
    #formdetailkategori{
        display: none;
    }
    #tabledetailkategori{
        display: none;
    }
    #formdetailsop{
        display: none;
    }
    #tabledetailsop{
        display: none;
    }
    #formdetailptkak{
        display: none;
    }
    #tabledetailptkak{
        display: none;
    }
    #formdetailstatusptkak{
        display: none;
    }
    #tabledetailstatusptkak{
        display: none;
    }
    #generateexcel{
        display:none;

    }
    #garis{
        display:none;

    }
    #exportdatatoexcelindikatorcabangpercabang{
        display:none;
    }
    #exportdatatoexcelindikatordivisiperdivisi{
        display:none;
    }
    #exportdatatoexcelindikatorcabang{
        display:none;

    }
     #exportdatatoexcelindikatorpusat{
        display:none;

    }
     #exportdatatoexceltercapaipusat{
        display:none;

    }
    #exportdatatoexceltidaktercapaipusat{
        display:none;

    }
    #exportdatatoexceltercapaicabang{
        display:none;

    }
    #exportdatatoexceltidaktercapaicabang{
        display:none;

    }
     #exportdatatoexcelketepatanlaporan{
        display:none;

    }
    #exportdatatoexcelstatsarmut{
        display:none;

    }
     #exportdatatoexceldetailkategorisd{
        display:none;

    }
    #exportdatatoexceldetailkategori{
        display:none;

    }
     #exportdatatoexceldetailsop{
        display:none;

    }
     #exportdatatoexceldetailptkak{
        display:none;

    }
     #exportdatatoexceldetailstatusptkak{
        display:none;

    }

    #exportdatatoexcelketepatanlaporan1{

        display: none;
    }
    #formkpipusat{
        display: none;
    }       

    #tablekpipusat{
        display: none;
    }   
    #exportdatatoexcelkpipusat{
        display: none;
    }

    #formkpicabang{
        display: none;
    }       
    #tablekpicabang{
        display: none;
    }   
    #exportdatatoexcelkpicabang{
        display: none;
    }

    #formtkp{

        display: none;
    }
    #tabletkp{

        display: none;
    }
    #exportdatatoexceltkp{

        display: none;
    }

    th, td{
            font:11px Verdana;
            
    }
    thead, tbody { 
        display: block; 
    }
    tbody
    {
        height: 500px;
        width: 100%;  
        overflow-y: scroll; 
        overflow-x: scroll;
    }
    /*
    #generateexcel2{
        display:none;

    }
    #generateexcel3{
        display:none;

    }
    #generateexcel4{
        display:none;

    }*/
    body{
        background-color: #283a5a;
    }
</style>


<body onload=OnLoadFunction()>

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
                </span>
            </div>  
        </div>
        <div class="fl-container">
            <div class="fl-title-page">
                <div class="fl-table col-md-12" style="overflow: auto;margin:0%"" >
                    <div id="generatechart">
                        <form action="#" method="post" name="form_name" id="form_id" class="form_class" >
                        {{ csrf_field() }}
                        <label id="ReportType" hidden>{{$ReportType}}</label>
                        <label id="UserAuth" hidden>{{Auth::user()->ACCESS}}</label>
                        <div class="col-lg-12" style="text-align: center;">
                            <div id="DivGrafik">    
                                <b style="width: 10% !important;">Bulan</b>
                                <select class="form-control select2-list" id="months" name="months" style="width: 14% !important;">
                                    @foreach($months as $month)
                                    @php
                                    if($month == strtoupper(date('M'))){
                                        $SelMon = 'selected';
                                    }else{
                                        $SelMon = '';
                                    }
                                    @endphp
                                    <option value="{{ $month }}" {{$SelMon}}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="years" class="form-control select2-list" name="years" style="width: 14% !important;">
                                @php
                                    if($year == strtoupper(date('Y'))){
                                        $SelYear = 'selected';
                                    }else{
                                        $SelYear = '';
                                    }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                <br/>
                                <br/>
                                <b style="width: 10% !important;">Directorate</b>
                                <select id="DDLDir" class="form-control select2-list" name="Directorate" style="width: 14% !important;">
                                    @if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
                                        <option value="ALL">All</option>
                                    @endif
                                    @foreach($dir_list as $dir)
                                        <option value="{{ $dir->DIRECTORATE_ID }}-{{ $dir->IS_CABANG }}">{{ $dir->DIRECTORATE_NAME }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Divisi/Cabang</b>
                                <select id="DDLDivCab" class="form-control select2-list" name="DivCab" style="width: 14% !important;">
                                    @if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
                                        <option value="ALL">All</option>
                                    @else
                                        @foreach($divisi_list as $divisi)
                                            <option value="{{ $divisi->DIVISION_NAME }}">{{ $divisi->DIVISION_NAME }}</option>
                                        @endforeach
                                        @foreach($branch_list as $branch)
                                            <option value="{{ $branch->BRANCH_OFFICE_NAME }}">{{ $branch->BRANCH_OFFICE_NAME }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Sub Divisi</b>
                                <select id="DDLSubDiv" class="form-control select2-list" name="SubDiv" style="width: 14% !important;">
                                    @if(Auth::user()->ACCESS == 'ADMIN SUB DIVISI' || Auth::user()->ACCESS == 'DVP SUB DIVISI')
                                        @foreach($subdivisi_list as $subdivisi)
                                        <option value="{{ $subdivisi->SUB_DIVISION_NAME }}">{{ $subdivisi->SUB_DIVISION_NAME }}</option>
                                        @endforeach
                                    @elseif( Auth::user()->ACCESS == 'VP SUB DIVISI')
                                        <option value="ALL">All</option>
                                        @foreach($subdivisi_list as $subdivisi)
                                        <option value="{{ $subdivisi->SUB_DIVISION_NAME }}">{{ $subdivisi->SUB_DIVISION_NAME }}</option>
                                        @endforeach
                                    @else
                                        <option value="ALL">All</option>
                                    @endif
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButton" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivIndPusat">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsindpusat" class="form-control select2-list" name="yearsindpusat" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonIndPusat" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivIndCabang">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsindcabang" class="form-control select2-list" name="yearsindcabang" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonIndCabang" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                             <div id="DivIndTercapaiPusat">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsTercapaiPusat" class="form-control select2-list" name="yearsTercapaiPusat" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonIndTercapaiPusat" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivIndTercapaiCabang">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsTercapaiCabang" class="form-control select2-list" name="yearsTercapaiCabang" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonIndTercapaiCabang" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                             <div id="DivIndTidakTercapaiPusat">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsTidakTercapaiPusat" class="form-control select2-list" name="yearsTidakTercapaiPusat" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonIndtidakTercapaiPusat" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                             <div id="DivIndTidakTercapaiCabang">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsTidakTercapaiCabang" class="form-control select2-list" name="yearsTidakTercapaiCabang" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonIndtidakTercapaiCabang" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                             <div id="DivIndBulan">
                                <b style="width: 10% !important;">Bulan</b>
                                <select class="form-control select2-list" id="monthsBulan" name="monthsBulan" style="width: 14% !important;">
                                    @foreach($months as $month)
                                    @php
                                    if($month == strtoupper(date('M'))){
                                        $SelMon = 'selected';
                                    }else{
                                        $SelMon = '';
                                    }
                                    @endphp
                                    <option value="{{ $month }}" {{$SelMon}}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsBulan" class="form-control select2-list" name="yearsBulan" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonIndBulan" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivIndSampaiDengan">
                                <b style="width: 10% !important;">Bulan</b>
                                <select class="form-control select2-list" id="monthsSampaiDengan" name="monthsSampaiDengan" style="width: 14% !important;">
                                    @foreach($months as $month)
                                    @php
                                    if($month == strtoupper(date('M'))){
                                        $SelMon = 'selected';
                                    }else{
                                        $SelMon = '';
                                    }
                                    @endphp
                                    <option value="{{ $month }}" {{$SelMon}}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsSampaiDengan" class="form-control select2-list" name="yearsSampaiDengan" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonIndSampaiDengan" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivKetLaporan">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsKetLaporan" class="form-control select2-list" name="yearsKetLaporan" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonKetLaporan" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivStatSarmut">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsStatSarmut" class="form-control select2-list" name="yearsStatSarmut" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonStatSarmut" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivKetKonsolidasi">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsketKonsolidasi" class="form-control select2-list" name="yearsketKonsolidasi" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonKetKonsolidasi" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivTkp">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsTkp" class="form-control select2-list" name="yearsTkp" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonTkp class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivTkpA1">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsTkpA1" class="form-control select2-list" name="yearsTkpA1" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonTkpA1 class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivTkpA2">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsTkpA2" class="form-control select2-list" name="yearsTkpA2" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonTkpA2 class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                             <div id="DivTkpA3">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsTkpA3" class="form-control select2-list" name="yearsTkpA3" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonTkpA3 class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivTabelSOP">
                                <b style="width: 10% !important;">Bulan</b>
                                <select class="form-control select2-list" id="monthsTabelSOP" name="monthsTabelSOP" style="width: 14% !important;">
                                    @foreach($months as $month)
                                    @php
                                    if($month == strtoupper(date('M'))){
                                        $SelMon = 'selected';
                                    }else{
                                        $SelMon = '';
                                    }
                                    @endphp
                                    <option value="{{ $month }}" {{$SelMon}}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsTabelSOP" class="form-control select2-list" name="yearsTabelSOP" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonTabelSOP" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivSummaryTPKAK">
                                <b style="width: 10% !important;">Bulan</b>
                                <select class="form-control select2-list" id="monthsTPKAK" name="monthsTPKAK" style="width: 14% !important;">
                                    @foreach($months as $month)
                                    @php
                                    if($month == strtoupper(date('M'))){
                                        $SelMon = 'selected';
                                    }else{
                                        $SelMon = '';
                                    }
                                    @endphp
                                    <option value="{{ $month }}" {{$SelMon}}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsTPKAK" class="form-control select2-list" name="yearsTPKAK" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonTPKAK" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivDetailTPKAK">
                                <b style="width: 10% !important;">Bulan</b>
                                <select class="form-control select2-list" id="monthsDetailTPKAK" name="monthsDetailTPKAK" style="width: 14% !important;">
                                    @foreach($months as $month)
                                    @php
                                    if($month == strtoupper(date('M'))){
                                        $SelMon = 'selected';
                                    }else{
                                        $SelMon = '';
                                    }
                                    @endphp
                                    <option value="{{ $month }}" {{$SelMon}}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsDetailTPKAK" class="form-control select2-list" name="yearsDetailTPKAK" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonDetailTPKAK" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivUtiCabang">
                                
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsUtiCabang" class="form-control select2-list" name="yearsUtiCabang" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                
                                <b style="width: 10% !important;">Cabang</b>
                                <select id="DDLUticabang" class="form-control select2-list" name="DDLUticabang" style="width: 14% !important;">
                                    @foreach($branch_list as $branch)
                                        <option value="{{ $branch->BRANCH_OFFICE_NAME }}">{{ $branch->BRANCH_OFFICE_NAME }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonUtiCabang" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                             <div id="DivKinerjaCabang">
                                
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsKinerjaCabang" class="form-control select2-list" name="yearsKinerjaCabang" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                
                                <b style="width: 10% !important;">Cabang</b>
                                <select id="DDLKinerjacabang" class="form-control select2-list" name="DDLKinerjacabang" style="width: 14% !important;">
                                    @foreach($branch_list as $branch)
                                        <option value="{{ $branch->BRANCH_OFFICE_NAME }}">{{ $branch->BRANCH_OFFICE_NAME }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonKinerjaCabang" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivPerCab">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearscabpercab" class="form-control select2-list" name="years" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Cabang</b>
                                <select id="DDLcabpercab" class="form-control select2-list" name="DivCab" style="width: 14% !important;">
                                    @foreach($branch_list as $branch)
                                        <option value="{{ $branch->BRANCH_OFFICE_NAME }}">{{ $branch->BRANCH_OFFICE_NAME }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <input type="button" id="SubmitButtonpercab" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivPerDiv">
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearsdivperdiv" class="form-control select2-list" name="years" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Divisi</b>
                                <select id="DDLdivperdiv" class="form-control select2-list" name="DivCab" style="width: 14% !important;">
                                    @foreach($divisi_list as $divisi)
                                        <option value="{{ $divisi->DIVISION_NAME }}">{{ $divisi->DIVISION_NAME }}</option>
                                    @endforeach
                                </select>
                                <input type="button" id="SubmitButtonperdiv" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivKPIPusat">
                                <b style="width: 10% !important;">Triwulan</b>
                                <select class="form-control select2-list" style="width: 14% !important;" id="triwulanselectpusat" name="triwulan" required="required">
                                    @php
                                        if(strtoupper(date('M'))=='JAN'||strtoupper(date('M'))=='FEB'||strtoupper(date('M'))=='MAR'){
                                            $SelTriwulan1 = 'selected';
                                            $SelTriwulan2 = '';
                                            $SelTriwulan3 = '';
                                            $SelTriwulan4 = '';
                                        }elseif(strtoupper(date('M'))=='APR'||strtoupper(date('M'))=='MAY'||strtoupper(date('M'))=='JUN' ){
                                            $SelTriwulan1 = '';
                                            $SelTriwulan2 = 'selected';
                                            $SelTriwulan3 = '';
                                            $SelTriwulan4 = '';
                                        }elseif(strtoupper(date('M'))=='JUL'||strtoupper(date('M'))=='AUG'||strtoupper(date('M'))=='SEP'){
                                            $SelTriwulan1 = '';
                                            $SelTriwulan2 = '';
                                            $SelTriwulan3 = 'selected';
                                            $SelTriwulan4 = '';
                                        }elseif(strtoupper(date('M'))=='OCT'||strtoupper(date('M'))=='NOV'||strtoupper(date('M'))=='DES'){
                                            $SelTriwulan1 = '';
                                            $SelTriwulan2 = '';
                                            $SelTriwulan3 = '';
                                            $SelTriwulan4 = 'selected';
                                        }
                                    @endphp
                                    <option value="TRIWULAN_1" {{$SelTriwulan1}}>TRIWULAN 1</option>
                                    <option value="TRIWULAN_2" {{$SelTriwulan2}}>TRIWULAN 2</option>
                                    <option value="TRIWULAN_3" {{$SelTriwulan3}}>TRIWULAN 3</option>
                                    <option value="TRIWULAN_4" {{$SelTriwulan4}}>TRIWULAN 4</option>
                                </select>   
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearskpipusat" class="form-control select2-list" name="years" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                <input type="button" id="SubmitButtonkpi" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <div id="DivKPICabang">
                                <b style="width: 10% !important;">Triwulan</b>
                                <select class="form-control select2-list" style="width: 14% !important;" id="triwulanselectcabang" name="triwulan" required="required">
                                    @php
                                        if(strtoupper(date('M'))=='JAN'||strtoupper(date('M'))=='FEB'||strtoupper(date('M'))=='MAR'){
                                            $SelTriwulan1 = 'selected';
                                            $SelTriwulan2 = '';
                                            $SelTriwulan3 = '';
                                            $SelTriwulan4 = '';
                                        }elseif(strtoupper(date('M'))=='APR'||strtoupper(date('M'))=='MAY'||strtoupper(date('M'))=='JUN' ){
                                            $SelTriwulan1 = '';
                                            $SelTriwulan2 = 'selected';
                                            $SelTriwulan3 = '';
                                            $SelTriwulan4 = '';
                                        }elseif(strtoupper(date('M'))=='JUL'||strtoupper(date('M'))=='AUG'||strtoupper(date('M'))=='SEP'){
                                            $SelTriwulan1 = '';
                                            $SelTriwulan2 = '';
                                            $SelTriwulan3 = 'selected';
                                            $SelTriwulan4 = '';
                                        }elseif(strtoupper(date('M'))=='OCT'||strtoupper(date('M'))=='NOV'||strtoupper(date('M'))=='DES'){
                                            $SelTriwulan1 = '';
                                            $SelTriwulan2 = '';
                                            $SelTriwulan3 = '';
                                            $SelTriwulan4 = 'selected';
                                        }
                                    @endphp
                                    <option value="TRIWULAN_1" {{$SelTriwulan1}}>TRIWULAN 1</option>
                                    <option value="TRIWULAN_2" {{$SelTriwulan2}}>TRIWULAN 2</option>
                                    <option value="TRIWULAN_3" {{$SelTriwulan3}}>TRIWULAN 3</option>
                                    <option value="TRIWULAN_4" {{$SelTriwulan4}}>TRIWULAN 4</option>
                                </select>   
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Tahun</b>
                                <select id="yearskpicabang" class="form-control select2-list" name="years" style="width: 14% !important;">
                                    @php
                                        if($year == strtoupper(date('Y'))){
                                            $SelYear = 'selected';
                                        }else{
                                            $SelYear = '';
                                        }
                                    @endphp
                                    @foreach($years as $year)
                                    <option value="{{ $year }}" {{$SelYear}}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <b style="width: 10% !important;">Cabang</b>
                                <select id="DDLkpicab" class="form-control select2-list" name="DivCab" style="width: 14% !important;">
                                    @foreach($branch_list as $branch)
                                        <option value="{{ $branch->BRANCH_OFFICE_NAME }}">{{ $branch->BRANCH_OFFICE_NAME }}</option>
                                    @endforeach
                                </select>
                                <input type="button" id="SubmitButtonkpicabang" class="uk-button uk-button-primary fl-button" value="submit" onclick=ButtonSubmit()>
                            </div>
                            <!-- <b style="width: 30% !important;">Modul</b>
                            &nbsp;
                            &nbsp;
                            <select id="modul" class="form-control select2-list" name="modul" style="width: 20% !important;" required="required">
                                <option value="">--Pilih Modul--</option>
                                <option value="Sasaran Mutu Tercapai">Sasaran Mutu Tercapai</option>
                                <option value="Alasan Tidak Tercapai">Alasan Tidak Tercapai</option>
                                <option value="SOP">SOP</option>
                                <option value="PTKAK">PTKAK</option>
                            </select> -->
                        </div>
                        <br/>
                    </form>
                </div>
                <div class="form-group m-form__group row" id="group1">
                    <div class="col-lg-5" id="form1" style="text-align: center !important; font-size: 20px !important;"></div>
                    <div class="col-lg-7" id="form2" style="text-align: center !important; font-size: 20px !important;"></div>
                    <div class="col-lg-6" id="m_amcharts_12" style="height: 400px !important;"></div>
                    <div class="col-lg-6" id="m_amcharts_13" style="height: 400px !important;"></div>
                    <br>
                </div>
                <div class="form-group m-form__group row" id="group2">
                    <div class="col-lg-6" id="form3" style="text-align: center !important;  font-size: 20px !important;">
                    </div>
                    <div class="col-lg-6" id="form4" style="text-align: center !important;  font-size: 20px !important;">
                    </div>
                    <div class="col-lg-6" id="m_amcharts_4" style="height: 350px !important;"></div>
                    <div class="col-lg-6" id="m_amcharts_5" style="height: 350px !important;"></div>
                    <br>
                </div>
                <div class="form-group m-form__group row" id="group3">
                    <div class="col-lg-12" id="form5" style="text-align: center !important;  font-size: 20px !important;">
                    </div>
                    <div class="col-lg-12" id="m_amcharts_14" style="height: 350px !important;  font-size: 20px !important;"></div>
                    <br>
                </div>
                <div class="form-group m-form__group row" id="group4">
                     <div class="col-lg-6" id="form6" style="text-align: center !important;  font-size: 20px !important;">
                    </div>
                    <div class="col-lg-6" id="form7" style="text-align: center !important;  font-size: 20px !important;">
                    </div>
                    <div class="col-lg-6" id="m_amcharts_15" style="height: 400px !important;"></div>
                    <div class="col-lg-6" id="m_amcharts_16" style="height: 400px !important;"></div>
                    <br>
                </div>
               <!--  <div id="garis"><hr style="color: black;border: double;" width="100%">
                    <br>
                    <br>
                </div> -->
               <!--  <div id="generateexcel" class="col-lg-15">
                        {{ csrf_field() }}
                        <div style="margin-bottom:30px; text-align:center;">
                            <span style="font-size:18px">Pilih Bulan , Tahun dan Tipe Report</span>
                        </div>
                        <div class="col-lg-15" style="text-align: center;">
                            <b style="width: 30% !important;">Bulan</b>
                            &nbsp;
                            &nbsp;
                            <select class="form-control select2-list" id="months1" name="months1" style="width: 20% !important;">
                                <option value="">--Pilih Bulan--</option>
                                @foreach($months as $month)
                                <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <b style="width: 30% !important;">Tahun</b>
                             &nbsp;
                            &nbsp;
                            <select id="years1" class="form-control select2-list" name="years1" style="width: 20% !important;">
                                <option value="">--Pilih Tahun--</option>
                                @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                           
                            <b style="width: 30% !important;">Tipe Report</b>
                             &nbsp;
                            &nbsp;
                            <select id="modul1" class="form-control select2-list" name="modul1" style="width: 20% !important;" required="required">
                                <option value="">--Pilih Tipe Report--</option>
                                <option value="Report Realisasi Sasaran Mutu">Report Realisasi Sasaran Mutu</option>
                                <option value="Report Realisasi Sasaran Mutu Sampai Dengan">Report Realisasi Sasaran Mutu Sampai Dengan</option>
                                <option value="Report Indicator Cabang">Report Indicator Cabang</option>
                                <option value="Report Indicator Per Cabang">Report Indicator Per Cabang</option>
                                <option value="Report Indicator Pusat">Report Indicator Pusat</option>
                                <option value="Report Indicator Tercapai Pusat">Report Indicator Tercapai Pusat</option>
                                <option value="Report Indicator Tidak Tercapai Pusat">Report Indicator Tidak Tercapai Pusat</option>
                                <option value="Report Ketepatan Laporan">Report Ketepatan Laporan</option>
                                <option value="Report SOP">Report SOP</option>
                                <option value="Report PTKAK">Report PTKAK</option>
                                <option value="Report Detail PTKAK">Report Detail PTKAK</option>
                            </select>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <br>
                            <div id="cabangnyaitu" style="display: none!important;">
                                <b style="width: 30% !important;">Tipe Cabang</b>
                                 &nbsp;
                                &nbsp;
                                <select id="cabangnya" class="form-control select2-list" name="cabangnya" style="width: 20% !important;" required="required">
                                    <option value="">--Pilih Cabang--</option>
                                    <option value="Report Cabang Banten"> Banten </option>
                                    <option value="Report Cabang Jambi"> Jambi </option>a
                                    <option value="Report Cabang Tanjung Priok"> Tanjung Priok </option>
                                    <option value="Report Cabang Bengkulu"> Bengkulu </option>
                                    <option value="Report Cabang Panjang"> Panjang </option>
                                    <option value="Report Cabang Cirebon"> Cirebon </option>
                                    <option value="Report Cabang Palembang"> Palembang </option>
                                    <option value="Report Cabang Teluk Bayur"> Teluk Bayur </option>
                                    <option value="Report Cabang Pangkal Balam"> Pangkal Balam </option>
                                    <option value="Report Cabang Tanjung Pandan"> Tanjung Pandan </option>
                                </select>
                            </div>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                        </div> -->
                        <script type="text/javascript">
                            $('#modul1').change(function() {
                                if ($(this).val() === 'Report Indikator Per Cabang') {
                                    $("#cabangnyaitu").show();
                                }else if ($(this).val() === 'Report Realisasi Sasaran Mutu') {
                                    $("#cabangnyaitu").hide();

                                }else if ($(this).val() === 'Report Realisasi Sasaran Mutu Sampai Dengan') {
                                    $("#cabangnyaitu").hide();

                                }else if ($(this).val() === 'Report Indikator Cabang') {
                                    $("#cabangnyaitu").hide();

                                }else if ($(this).val() === 'Report Indikator Pusat') {
                                    $("#cabangnyaitu").hide();

                                }else if ($(this).val() === 'Report Indikator Tercapai Pusat') {
                                    $("#cabangnyaitu").hide();

                                }else if ($(this).val() === 'Report SOP') {
                                    $("#cabangnyaitu").hide();

                                }else if ($(this).val() === 'Report PTKAK') {
                                    $("#cabangnyaitu").hide();

                                }else if ($(this).val() === 'Report Detail PTKAK') {
                                    $("#cabangnyaitu").hide();

                                }
                            });
                        </script>
                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formindicatordivisiperdivisi" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formindicatordivisiperdivisi">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelindikatordivisiperdivisi">
                            <button type="button" onclick="generateexcelindikatordivisiperdivisi()" class="uk-button uk-button-primary">Export Excel</button>
                         </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formindicatorcabangpercabang" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formindicatorcabangpercabang">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelindikatorcabangpercabang">
                            <button type="button" onclick="generateexcelindikatorcabangpercabang()" class="uk-button uk-button-primary">Export Excel</button>
                         </div>
                         <table id="tableindicatordivisiperdivisi" class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <thead>
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="10%">Sub Division Name</th>
                                    <th width="10%">Indikator Name</th> 
                                    <th width="5%">JAN</th>
                                    <th width="5%">FEB</th> 
                                    <th width="5%">MAR</th>
                                    <th width="5%">APR</th>
                                    <th width="5%">MAY</th>
                                    <th width="5%">JUN</th>
                                    <th width="5%">JUL</th>
                                    <th width="5%">AUG</th>
                                    <th width="5%">SEP</th>
                                    <th width="5%">OCT</th>
                                    <th width="5%">NOV</th>
                                    <th width="5%">DES</th>
                                    <th width="5%">Target</th>
                                    <th width="5%">Jumlah/Rata-Rata</th>
                                </tr>                  
                            </thead>
                                <div id="cleardatadivisiperdivisi">
                                </div>  
                        </table>
                        <table id="tableindicatorcabangpercabang" class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <thead>
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="10%">Sub Division Name</th>
                                    <th width="10%">Indikator Name</th> 
                                    <th width="5%">JAN</th>
                                    <th width="5%">FEB</th> 
                                    <th width="5%">MAR</th>
                                    <th width="5%">APR</th>
                                    <th width="5%">MAY</th>
                                    <th width="5%">JUN</th>
                                    <th width="5%">JUL</th>
                                    <th width="5%">AUG</th>
                                    <th width="5%">SEP</th>
                                    <th width="5%">OCT</th>
                                    <th width="5%">NOV</th>
                                    <th width="5%">DES</th>
                                    <th width="5%">Target</th>
                                    <th width="5%">Jumlah/Rata-Rata</th>
                                </tr>                  
                            </thead>
                                <div id="cleardatacabangpercabang">
                                </div>  
                        </table>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formkpipusat" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formkpipusat">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelkpipusat">
                            <button type="button" onclick="generateexcelkpipusat()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                        <table id="tablekpipusat" class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head kpidata" >
                                    <!-- <th width="20%">NO</th> -->
                                    <th width="20%">KPI TAHUN 2019</th> 
                                    <th width="10%">SATUAN</th>
                                    <th width="10%">BOBOT</th> 
                                    <th width="10%">TARGET</th>
                                    <th width="10%">REALISASI</th>
                                    <th width="10%">PENCAPAIAN</th>
                                    <th width="10%">SKOR</th>
                                </tr> 
                            <!-- </thead> -->
                                <div id="cleardatakpipusat">
                                </div>  
                        </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formkpicabang" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formkpicabang">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelkpicabang">
                            <button type="button" onclick="generateexcelkpicabang()" class="uk-button uk-button-primary">Export Excel</button>
                         </div>
                        <table id="tablekpicabang" class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head kpidata" >
                                    <!-- <th width="20%">NO</th> -->
                                    <th width="20%">KPI TAHUN 2019</th> 
                                    <th width="10%">SATUAN</th>
                                    <th width="10%">BOBOT</th> 
                                    <th width="10%">TARGET</th>
                                    <th width="10%">REALISASI</th>
                                    <th width="10%">PENCAPAIAN</th>
                                    <th width="10%">SKOR</th>
                                </tr> 
                            <!-- </thead> -->
                                <div id="cleardatakpicabang">
                                </div>  
                        </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formtkp" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formtkp">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexceltkp">
                            <button type="button" onclick="generateexceltkp()" class="uk-button uk-button-primary">Export Excel</button>
                         </div>
                        <table id="tabletkp" class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="20%">NO</th>
                                    <th width="20%">TKP TAHUN 2019</th> 
                                    <th width="10%">SATUAN</th>
                                    <th width="10%">BOBOT</th> 
                                    <th width="10%">TARGET</th>
                                    <th width="10%">REALISASI</th>
                                    <th width="10%">PENCAPAIAN</th>
                                    <th width="10%">SKOR</th>
                                </tr> 
                            <!-- </thead> -->
                                <div id="cleardatatkp">
                                </div>  
                        </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formtkp" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formtkpA1">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexceltkp">
                            <button type="button" onclick="generateexceltkpA1()" class="uk-button uk-button-primary">Export Excel</button>
                         </div>
                        <table id="tabletkp" class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="20%">NO</th>
                                    <th width="20%">TKP TAHUN 2019</th> 
                                    <th width="10%">SATUAN</th>
                                    <th width="10%">BOBOT</th> 
                                    <th width="10%">TARGET</th>
                                    <th width="10%">REALISASI</th>
                                    <th width="10%">PENCAPAIAN</th>
                                    <th width="10%">SKOR</th>
                                </tr> 
                            <!-- </thead> -->
                                <div id="cleardatatkpA1">
                                </div>  
                        </table>
                        </div>


                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formindicatorcabang" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formindicatorcabang">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelindikatorcabang">
                            <button type="button" onclick="generateexcelindikatorcabang()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                       <table id="tableindicatorcabang" class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <thead>
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="10%">Sub Division Name</th>
                                    <th width="10%">Indikator Name</th> 
                                    <th width="5%">JAN</th>
                                    <th width="5%">FEB</th>
                                    <th width="5%">MAR</th>
                                    <th width="5%">APR</th>
                                    <th width="5%">MAY</th>
                                    <th width="5%">JUN</th>
                                    <th width="5%">JUL</th>
                                    <th width="5%">AUG</th>
                                    <th width="5%">SEP</th>
                                    <th width="5%">OCT</th>
                                    <th width="5%">NOV</th>
                                    <th width="5%">DES</th>
                                    <th width="5%">Target</th>
                                    <th width="5%">Jumlah/Rata-Rata</th>
                                </tr>                  
                            </thead>
                                <div id="cleardatacabang">
                                </div>  
                        </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formindicatorpusat" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formindicatorpusat">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelindikatorpusat">
                            <button type="button" onclick="generateexcelindikatorpusat()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                       <table id="tableindicatorpusat"class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <thead>
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="10%">Sub Division Name</th>
                                    <th width="10%">Indikator Name</th> 
                                    <th width="5%">JAN</th>
                                    <th width="5%">FEB</th>
                                    <th width="5%">MAR</th>
                                    <th width="5%">APR</th>
                                    <th width="5%">MAY</th>
                                    <th width="5%">JUN</th>
                                    <th width="5%">JUL</th>
                                    <th width="5%">AUG</th>
                                    <th width="5%">SEP</th>
                                    <th width="5%">OCT</th>
                                    <th width="5%">NOV</th>
                                    <th width="5%">DES</th>
                                    <th width="5%">Target</th>
                                    <th width="5%">Jumlah/Rata-Rata</th>
                                </tr>                  
                            </thead>
                                <div id="cleardatapusat">
                                </div>  
                        </table>
                        </div>



                    <div class="col-lg-12">
                            <div class="col-lg-12" id="formtercapaipusat" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formtercapaipusat">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexceltercapaipusat">
                            <button type="button" onclick="generateexcelindikatortercapaipusat()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                        <table id="tabletercapaipusat"class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="10%">Sub Division Name</th>
                                    <th width="10%">Indikator Name</th> 
                                    <th width="5%">JAN</th>
                                    <th width="5%">FEB</th>
                                    <th width="5%">MAR</th>
                                    <th width="5%">APR</th>
                                    <th width="5%">MAY</th>
                                    <th width="5%">JUN</th>
                                    <th width="5%">JUL</th>
                                    <th width="5%">AUG</th>
                                    <th width="5%">SEP</th>
                                    <th width="5%">OCT</th>
                                    <th width="5%">NOV</th>
                                    <th width="5%">DES</th>
                                    <th width="10%">Target</th>
                                    <th width="10%">Jumlah/Rata-Rata</th>
                                </tr>                  
                            <!-- </thead> -->
                                <div id="cleardatatercapaipusat">
                                </div>  
                        </table>
                        </div>


                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formtidaktercapaipusat" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formtidaktercapaipusat">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexceltidaktercapaipusat">
                            <button type="button" onclick="generateexcelindikatortidaktercapaipusat()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                        <table id="tabletidaktercapaipusat"class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="10%">Sub Division Name</th>
                                    <th width="10%">Indikator Name</th> 
                                    <th width="5%">JAN</th>
                                    <th width="5%">FEB</th>
                                    <th width="5%">MAR</th>
                                    <th width="5%">APR</th>
                                    <th width="5%">MAY</th>
                                    <th width="5%">JUN</th>
                                    <th width="5%">JUL</th>
                                    <th width="5%">AUG</th>
                                    <th width="5%">SEP</th>
                                    <th width="5%">OCT</th>
                                    <th width="5%">NOV</th>
                                    <th width="5%">DES</th>
                                    <th width="10%">Target</th>
                                    <th width="10%">Jumlah/Rata-Rata</th>
                                </tr>                  
                            <!-- </thead> -->
                                <div id="cleardatatidaktercapaipusat">
                                </div>  
                        </table>
                        </div>


                         <div class="col-lg-12">
                            <div class="col-lg-12" id="formtercapaicabang" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formtercapaicabang">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexceltercapaicabang">
                            <button type="button" onclick="generateexcelindikatortercapaicabang()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                        <table id="tabletercapaicabang" class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="10%">Sub Division Name</th>
                                    <th width="10%">Indikator Name</th> 
                                    <th width="5%">JAN</th>
                                    <th width="5%">FEB</th>
                                    <th width="5%">MAR</th>
                                    <th width="5%">APR</th>
                                    <th width="5%">MAY</th>
                                    <th width="5%">JUN</th>
                                    <th width="5%">JUL</th>
                                    <th width="5%">AUG</th>
                                    <th width="5%">SEP</th>
                                    <th width="5%">OCT</th>
                                    <th width="5%">NOV</th>
                                    <th width="5%">DES</th>
                                    <th width="10%">Target</th>
                                    <th width="10%">Jumlah/Rata-Rata</th>
                                </tr>                  
                            <!-- </thead> -->
                                <div id="cleardatatercapaicabang">
                                </div>  
                        </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formtidaktercapaicabang" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formtidaktercapaicabang">
                            <div class="col-lg-12" style="text-align: center;" id="exportdatatoexceltidaktercapaicabang">
                                <button type="button" onclick="generateexcelindikatortidaktercapaicabang()" class="uk-button uk-button-primary">Export Excel</button>
                            </div>
                        <table id="tabletidaktercapaicabang"class="uk-table uk-table-hover" style="margin-top: 5px;">
                            <!-- <thead> -->
                            <tr style="width: 100% !important;" class="fl-table-head" >
                                <th width="10%">Sub Division Name</th>
                                <th width="10%">Indikator Name</th> 
                                <th width="5%">JAN</th>
                                <th width="5%">FEB</th>
                                <th width="5%">MAR</th>
                                <th width="5%">APR</th>
                                <th width="5%">MAY</th>
                                <th width="5%">JUN</th>
                                <th width="5%">JUL</th>
                                <th width="5%">AUG</th>
                                <th width="5%">SEP</th>
                                <th width="5%">OCT</th>
                                <th width="5%">NOV</th>
                                <th width="5%">DES</th>
                                <th width="10%">Target</th>
                                <th width="10%">Jumlah/Rata-Rata</th>
                            </tr>                  
                            <!-- </thead> -->
                            <div id="cleardatatidaktercapaicabang">
                            </div>  
                        </table>
                        </div>  

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formStatSarmut" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="exportdatatoexcelstatsarmut" > 
                            <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelStatSarmut1">
                                <button type="button" onclick="generateexcelStatSarmut()" class="uk-button uk-button-primary">Export Excel</button>
                            </div>
                            <table id="tableStatSarmut"class="uk-table uk-table-hover" style="margin-top: 5px;">
                                <thead>
                                    <tr style="width: 100% !important;" class="fl-table-head" >
                                        <th width="10%">Division Name</th> 
                                        <th width="10%">Sub Division Name</th> 
                                        <th width="5%">JAN</th>
                                        <th width="5%">FEB</th>
                                        <th width="5%">MAR</th>
                                        <th width="5%">APR</th>
                                        <th width="5%">MAY</th>
                                        <th width="5%">JUN</th>
                                        <th width="5%">JUL</th>
                                        <th width="5%">AUG</th>
                                        <th width="5%">SEP</th>
                                        <th width="5%">OCT</th>
                                        <th width="5%">NOV</th>
                                        <th width="5%">DES</th>
                                    </tr>             
                                </thead>
                                <div id="cleardataStatSarmut"></div>   
                            </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formketepatanlaporan" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="exportdatatoexcelketepatanlaporan" > 
                            <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelketepatanlaporan1">
                                <button type="button" onclick="generateexcelketepatanlaporan()" class="uk-button uk-button-primary">Export Excel</button>
                            </div>
                            <table id="tableketepatanlaporan"class="uk-table uk-table-hover" style="margin-top: 5px;">
                                <thead>
                                    <tr style="width: 100% !important;" class="fl-table-head">
                                        <th width="9%">Division Name</th>
                                        <th width="9%">Sub Division Name</th> 
                                        <th width="5%">JAN</th>
                                        <th width="5%">FEB</th>
                                        <th width="5%">MAR</th>
                                        <th width="5%">APR</th>
                                        <th width="5%">MAY</th>
                                        <th width="5%">JUN</th>
                                        <th width="5%">JUL</th>
                                        <th width="5%">AUG</th>
                                        <th width="5%">SEP</th>
                                        <th width="5%">OCT</th>
                                        <th width="5%">NOV</th>
                                        <th width="5%">DES</th>
                                    </tr>                  
                                </thead>
                                    <div id="cleardataketepatanlaporan">
                                    </div>  
                            </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formdetailkategorisd" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formdetailkategorisd">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexceldetailkategorisd">
                            <button type="button" onclick="generateexceldetailkategorisd()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                       <table id="tabledetailkategorisd"class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="35%">Division Name</th>
                                    <th width="35%">Sub Division Name</th> 
                                    <th width="10%">Indikator Tercapai(%)</th>
                                    <th width="10%">Indikator Tidak Tercapai(%)</th>
                                    <th width="10%">Data Kurang(%)</th>
                                </tr>                  
                            <!-- </thead> -->
                                <div id="cleardatadetailkategorisd">
                                </div>  
                        </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formdetailkategori" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formdetailkategori">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexceldetailkategori">
                            <button type="button" onclick="generateexceldetailkategori()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                        <table id="tabledetailkategori"class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="35%">Division Name</th>
                                    <th width="35%">Sub Division Name</th> 
                                    <th width="10%">Indikator Tercapai(%)</th>
                                    <th width="10%">Indikator Tidak Tercapai(%)</th>
                                    <th width="10%">Data Kurang(%)</th>
                                </tr>                  
                            <!-- </thead> -->
                                <div id="cleardatadetailkategori">
                                </div>  
                        </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formdetailsop" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formdetailsop">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexceldetailsop">
                            <button type="button" onclick="generateexceldetailsop()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                        <table id="tabledetailsop"class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="25%">Sub Division Name</th>
                                    <th width="25%">Sub Division Name</th>
                                    <th width="10%">No SOP</th>
                                    <th width="10%">Keterangan</th>
                                    <th width="10%">SOP</th> 
                                    <th width="10%">WI</th>
                                    <th width="10%">Forms</th>
                                </tr>                  
                            <!-- </thead> -->
                                <div id="cleardatadetailsop">
                                </div>  
                        </table>

                        </div>


                         <div class="col-lg-12">
                            <div class="col-lg-12" id="formdetailptkak" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formdetailptkak">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexceldetailptkak">
                            <button type="button" onclick="generateexceldetailptkak()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                        <table id="tabledetailptkak"class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="50%">Sub Division Name</th> 
                                    <th width="25%">Open</th>
                                    <th width="25%">Close</th>
                                </tr>                  
                            <!-- </thead> -->
                                <div id="cleardatadetailptkak">
                                </div>  
                        </table>

                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formdetailstatusptkak" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formdetailstatusptkak">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexceldetailstatusptkak">
                            <button type="button" onclick="generateexceldetailstatusptkak()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                        <table id="tabledetailstatusptkak"class="uk-table uk-table-hover" style="margin-top: 5px;">
                               <!-- <thead> -->
                                <tr style="width: 100% !important;" class="fl-table-head" >
                                    <th width="25%">FROM</th> 
                                    <th width="25%">TO</th>
                                    <th width="15%">No PTKAK</th>
                                    <th width="10%">Tanggal PTKAK</th>
                                    <th width="15%">Sumber</th>
                                    <th width="10%">Status</th>
                                </tr>                  
                            <!-- </thead> -->
                                <div id="cleardatadetailstatusptkak">
                                </div>  
                        </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formUtiCabang" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="exportdatatoexcelUticabang" > 
                            <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelUtiCabang">
                                <button type="button" onclick="generateexcelUtiCabang()" class="uk-button uk-button-primary">Export Excel</button>
                            </div>
                            <table id="tableUtiCabang" class="uk-table uk-table-hover" style="margin-top: 5px;">
                                <thead>
                                    <tr style="width: 100% !important;" class="fl-table-head">
                                        <th width="9%">Uraian</th>
                                        <th width="9%">Satuan</th> 
                                        <th width="9%">Realisasi Tahun</th>
                                        <th width="9%">RKAP</th>
                                        <th width="5%">JAN</th>
                                        <th width="5%">FEB</th>
                                        <th width="5%">MAR</th>
                                        <th width="5%">APR</th>
                                        <th width="5%">MAY</th>
                                        <th width="5%">JUN</th>
                                        <th width="5%">JUL</th>
                                        <th width="5%">AUG</th>
                                        <th width="5%">SEP</th>
                                        <th width="5%">OCT</th>
                                        <th width="5%">NOV</th>
                                        <th width="5%">DES</th>
                                        <th width="5%">Realisasi</th>
                                        <th width="5%">Deviasi</th>
                                        <th width="5%">Trend</th>
                                    </tr>                  
                                </thead>
                                    <div id="clearUtiCabang">
                                    </div>  
                            </table>
                        </div>

                <div class="col-lg-12">
                            <div class="col-lg-12" id="formKinerjaCabang" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="exportdatatoexcelKinerjacabang" > 
                            <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelKinerjaCabang">
                                <button type="button" onclick="generateexcelKinerjaCabang()" class="uk-button uk-button-primary">Export Excel</button>
                            </div>
                            <table id="tableKinerjaCabang" class="uk-table uk-table-hover" style="margin-top: 5px;">
                                <thead>
                                    <tr style="width: 100% !important;" class="fl-table-head">
                                        <th width="9%">Uraian</th>
                                        <th width="9%">Satuan</th> 
                                        <th width="9%">Standar Dirjenla</th>
                                        <th width="9%">RKAP</th>
                                        <th width="5%">Realisasi JAN</th>
                                        <th width="5%">Realisasi FEB</th>
                                        <th width="5%">Realisasi MAR</th>
                                        <th width="5%">Realisasi APR</th>
                                        <th width="5%">Realisasi MAY</th>
                                        <th width="5%">Realisasi JUN</th>
                                        <th width="5%">Realisasi JUL</th>
                                        <th width="5%">Realisasi AUG</th>
                                        <th width="5%">Realisasi SEP</th>
                                        <th width="5%">Realisasi OCT</th>
                                        <th width="5%">Realisasi NOV</th>
                                        <th width="5%">Realisasi DES</th>
                                        <th width="5%">Rata-rata Realisasi</th>
                                        <th width="5%">Realisasi</th>
                                        <th width="5%">Deviasi</th>
                                        <th width="5%">Trend</th>
                                    </tr>                  
                                </thead>
                                    <div id="clearKinerjaCabang">
                                    </div>  
                            </table>
                        </div>       

                <div class="fl-table" style="display: none" id="prev">
                    <div class="uk-overflow-auto" id="htmlTable">
                         <!-- <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                        <thead>
                            <tr class="fl-table-head">
                                <th width="5%"></th>
                                <th>Sub Divisi</th>
                                <th>Nama Indicator</th>
                                <th>Satuan</th>
                                <th>Polaritas</th>
                                <th>Target</th>
                                <th>JAN</th>
                                <th>FEB</th>
                                <th>MAR</th>
                                <th>APR</th>
                                <th>MAY</th>
                                <th>JUN</th>
                                <th>JUL</th>
                                <th>AUG</th>
                                <th>SEP</th>
                                <th>OCT</th>
                                <th>NOV</th>
                                <th>DES</th>
                                <th>Jumlah/Rata-Rata</th>
                                <th>Hasil</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                                <tr>
                                    <th width="5%"></th>
                                    <td>Sub_Divisi</td>
                                    <td>Nama_Indicator</td>
                                    <td>Satuan</td>
                                    <td>Popularitas</td>
                                    <td>Target</td>
                                    <td></td>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                           
                            </tbody>
                        </table> -->
                    </div>
                </div>
                     </div>  
                </div>
            </div>

        </div>  
    </div>

</body>
</html>
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/charts/amcharts/lib/amcharts.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/charts/amcharts/lib/pie.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/charts/amcharts/lib/serial.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/charts/amcharts/lib/themes/light.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/charts/amcharts/lib/radar.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/charts/amcharts/lib/polarScatter.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/charts/amcharts/lib/animate.min.js') }}" type="text/javascript"></script>

<!-- <script src="{{ URL::asset('metronic2/assets/demo/default/custom/components/charts/morris-charts.js') }}" type="text/javascript"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> -->
<script src="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- <script type="text/javascript">
    $('#previewButton').click(function () {
        var month = $('#months1').val()
        var years = $('#years1').val()
        var modul = $('#modul1').val()
        if ((month !='') && (years !='') && (modul !='')) {
            console.log(modul)
            if (modul == 'Report Indicator Pusat') {
                previewIndicatorPusat(month,years,modul);

            }else if (modul == 'Report Realisasi Sasaran Mutu') {
                var tableSasaranMutu = '<table class="uk-table uk-table-hover uk-table-middle uk-table-divider">'+
                                        '<thead>'+
                                            '<tr class="fl-table-head">'+
                                                '<th width="5%"></th>'+
                                                '<th>Divisi</th>'+
                                                '<th>Sub Divisi</th>'+
                                                '<th>Indikator Tercapai(%)</th>'+
                                                '<th>Indikator Tidak tercapai(%)</th>'+
                                                '<th>Data Kurang(%)</th>'+
                                                '<th>Belum Diukur(%)</th>'+
                                                '<th>Ketepatan Laporan</th>'+
                                            '</tr>'+
                                        '</thead>'+
                                        '<tbody id="tbodySasaranMutu">'+

                                        '</tbody>'+
                                    '</table>';
                        $('#htmlTable').html(tableSasaranMutu)
                previewSasaranMutu(month,years,modul);

            }else if (modul == 'Report Realisasi Sasaran Mutu Sampai Dengan') {
                var tableSasaranMutuSD = '<table class="uk-table uk-table-hover uk-table-middle uk-table-divider">'+
                                        '<thead>'+
                                            '<tr class="fl-table-head">'+
                                                '<th width="5%"></th>'+
                                                '<th>Divisi</th>'+
                                                '<th>Sub Divisi</th>'+
                                                '<th>Indikator Tercapai(%)</th>'+
                                                '<th>Indikator Tidak tercapai(%)</th>'+
                                                '<th>Data Kurang(%)</th>'+
                                                '<th>Belum Diukur(%)</th>'+
                                                '<th>Ketepatan Laporan</th>'+
                                            '</tr>'+
                                        '</thead>'+
                                        '<tbody id="tbodySasaranMutuSD">'+

                                        '</tbody>'+
                                    '</table>';
                        $('#htmlTable').html(tableSasaranMutuSD)
                previewSasaranMutuSD(month,years,modul);

            }else if (modul == 'Report Indicator Cabang') {
                var tableSasaranMutuSD = '<table class="uk-table uk-table-hover uk-table-middle uk-table-divider">'+
                                        '<thead>'+
                                            '<tr class="fl-table-head">'+
                                                '<th width="5%"></th>'+
                                                '<th>Sub Divisi</th>'+
                                                '<th>Nama Indicator</th>'+
                                                '<th>Satuan</th>'+
                                                '<th>Polaritas</th>'+
                                                '<th>Target</th>'+
                                                '<th>JAN</th>'+
                                                '<th>FEB</th>'+
                                                '<th>MAR</th>'+
                                                '<th>APR</th>'+
                                                '<th>MAY</th>'+
                                                '<th>JUN</th>'+
                                                '<th>JUL</th>'+
                                                '<th>AUG</th>'+
                                                '<th>SEP</th>'+
                                                '<th>OCT</th>'+
                                                '<th>NOV</th>'+
                                                '<th>DES</th>'+
                                                '<th>Jumlah/Rata-Rata</th>'+
                                                '<th>Hasil</th>'+
                                            '</tr>'+
                                        '</thead>'+
                                        '<tbody id="tbodySasaranMutuSD">'+

                                        '</tbody>'+
                                    '</table>';
                        $('#htmlTable').html(tableSasaranMutuSD)
                previewSasaranMutuSD(month,years,modul);
            }

          $('#prev').show()  
      }else{
        swal({
            title: "Perhatian", 
            text : "Harap Memilih inputan Diatas", 
            icon: "warning"
        });
      }
        
    })

    function previewIndicatorPusat(month,year,modul) {
        console.log(month,year,modul)
        $.ajax({

            url: "http://103.234.195.57/previewIndicatorPusat",
            data: {"_token": "{{ csrf_token() }}", month:month, thn:year,mdl:modul},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data)
            }
        })
    }


    function previewSasaranMutu(month,year,modul) {
        console.log(month,year,modul)
        $.ajax({

            url: "http://103.234.195.57/previewSasaranMutu",
            data: {"_token": "{{ csrf_token() }}", bln:month, thn:year,mdl:modul},
            type: "POST",
            dataType: "json",
            success: function(data){
                $.each(data, function (index,value) {
                    var dataSasaranMutu = '<tr>'+
                                                '<td width="5%"></td>'+
                                                '<td>'+value.Division_Name+'</td>'+
                                                '<td>'+value.Sub_Division_Name+'</td>'+
                                                '<td>'+value.Tercapai_Percent+'</td>'+
                                                '<td>'+value.Tidak_Tercapai_Percent+'</td>'+
                                                '<td>'+value.Data_Kurang_Percent+'</td>'+
                                                '<td>'+value.Belum_Diukur_Percent+'</td>'+
                                                '<td>'+value.Ketepatan_Laporan+'</td>'+
                                            '</tr>';
                    $('#tbodySasaranMutu').append(dataSasaranMutu);
                })
                console.log(data)
            }
        })
    }

   function previewSasaranMutuSD(month,year,modul) {
        console.log(month,year,modul)
        $.ajax({

            url: "http://103.234.195.57/previewSasaranMutuSD",
            data: {"_token": "{{ csrf_token() }}", bln:month, thn:year,mdl:modul},
            type: "POST",
            dataType: "json",
            success: function(data){
                $.each(data, function (index,value) {
                    var dataSasaranMutuSD = '<tr>'+
                                                '<td width="5%"></td>'+
                                                '<td>'+value.Division_Name+'</td>'+
                                                '<td>'+value.Sub_Division_Name+'</td>'+
                                                '<td>'+value.Tercapai_Percent+'</td>'+
                                                '<td>'+value.Tidak_Tercapai_Percent+'</td>'+
                                                '<td>'+value.Data_Kurang_Percent+'</td>'+
                                                '<td>'+value.Belum_Diukur_Percent+'</td>'+
                                                '<td>'+value.Ketepatan_Laporan+'</td>'+
                                            '</tr>';
                    $('#tbodySasaranMutuSD').append(dataSasaranMutuSD);
                })
                console.log(data)
            }
        })
    }

    function previewIndicatorCabang(month,year,modul) {
        console.log(month,year,modul)
        $.ajax({

            url: "http://103.234.195.57/previewIndicatorCabang",
            data: {"_token": "{{ csrf_token() }}", bln:month, thn:year,mdl:modul},
            type: "POST",
            dataType: "json",
            success: function(data){
                $.each(data, function (index,value) {
                    var dataSasaranMutuSD = '<tr>'+
                                                '<td width="5%"></td>'+
                                                '<td>'+value.Sub Divisi+'</td>'+
                                                '<td>'+value.Nama Indicator+'</td>'+
                                                '<td>'+value.Satuan+'</td>'+
                                                '<td>'+value.Polaritas+'</td>'+
                                                '<td>'+value.Target+'</td>'+
                                                '<td>'+value.JAN+'</td>'+
                                                '<td>'+value.FEB+'</td>'+
                                                '<td>'+value.MAR+'</td>'+
                                                '<td>'+value.APR+'</td>'+
                                                '<td>'+value.MAY+'</td>'+
                                                '<td>'+value.JUN+'</td>'+
                                                '<td>'+value.JUL+'</td>'+
                                                '<td>'+value.AUG+'</td>'+
                                                '<td>'+value.SEP+'</td>'+
                                                '<td>'+value.OCT+'</td>'+
                                                '<td>'+value.NOV+'</td>'+
                                                '<td>'+value.DES+'</td>'+
                                                '<td>'+value.Jumlah/Rata-Rata+'</td>'+
                                                '<td>'+value.Hasil+'</td>'+
                                            '</tr>';
                    $('#tbodyIndicatorCabang').append(dataIndicatorCabang);
                })
                console.log(data)
            }
        })
    }

</script> -->x
<script>
    // function HideDropDown(w,x,y)
    // {
    //     var a = document.getElementById(w);
    //     var a1 = a.options[a.selectedIndex].value;
    //     var b = document.getElementById(x);
    //     var b1 = b.options[b.selectedIndex].value;

    //     if( a1=="ALL")
    //     {
            
    //     }
    //     else
    //     {
    //         foreach($dir_list as $dir)
    //         {
    //             if(a1==$divisi_list->DIVISION_NAME)
    //             {
    //                 var option = document.createElement("option");
    //                 option.text=$dir->DIVISION_NAME;
    //                 option.value=$dir->DIVISION_NAME;
    //                 b.add(option);
    //             }
    //         }
    //     }
    // }
    function Hide()
    {
        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $('#formindicatorcabang').hide();
        $('#tableindicatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
         $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formStatSarmut").hide();
        $('#tableStatSarmut').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $('#exportdatatoexcelStatSarmut').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
        $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
        $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $('#exportdatatoexcelketepatanlaporan1').hide();
        $('#exportdatatoexcelStatSarmut1').hide();
        $('#exportdatatoexcelUtiCabang').hide();
        $('#tableUtiCabang').hide();
        $('#exportdatatoexcelKinerjaCabang').hide();
        $('#tableKinerjaCabang').hide();


        $("#formkpipusat").hide();
        $('#tablekpipusat').hide();
        $('#exportdatatoexcelkpipusat').hide();
        $("#formUtiCabang").hide();
        $("#formKinerjaCabang").hide();
        
        var DivKetKonsolidasi =document.getElementById('DivKetKonsolidasi');
        var GenerateChart =document.getElementById('generatechart');
        var DivGrafik =document.getElementById('DivGrafik');
        var DivIndPusat =document.getElementById('DivIndPusat');
        var DivIndCabang = document.getElementById('DivIndCabang');
        var DivIndTercapaiPusat = document.getElementById('DivIndTercapaiPusat');
        var DivIndTercapaiCabang = document.getElementById('DivIndTercapaiCabang');
        var DivIndTidakTercapaiPusat = document.getElementById('DivIndTidakTercapaiPusat');
        var DivIndTidakTercapaiCabang = document.getElementById('DivIndTidakTercapaiCabang');
        var DivKetLaporan = document.getElementById('DivKetLaporan');
        var DivStatSarmut = document.getElementById('DivStatSarmut');
        var DivPerCab =document.getElementById('DivPerCab');
        var DivPerDiv =document.getElementById('DivPerDiv');
        var DivIndBulan = document.getElementById('DivIndBulan');
        var DivIndSampaiDengan = document.getElementById('DivIndSampaiDengan');
        var DivKPIPusat =document.getElementById('DivKPIPusat');
        var DivKPICabang =document.getElementById('DivKPICabang');
        var DivTkp =document.getElementById('DivTkp');
        var DivTkpA1 =document.getElementById('DivTkpA1');
        var DivTkpA2 =document.getElementById('DivTkpA2');
        var DivTkpA3 =document.getElementById('DivTkpA3');
        var DivTabelSOP =document.getElementById('DivTabelSOP');
        var DivSummaryTPKAK =document.getElementById('DivSummaryTPKAK');
        var DivDetailTPKAK =document.getElementById('DivDetailTPKAK');
        var DivUtiCabang =document.getElementById('DivUtiCabang');
        var DivKinerjaCabang=document.getElementById('DivKinerjaCabang');
        GenerateChart.hidden=true;
        DivGrafik.hidden=true;
        DivIndPusat.hidden=true;
        DivIndCabang.hidden=true;
        DivIndTercapaiPusat.hidden=true;
        DivIndTercapaiCabang.hidden=true;
        DivIndTidakTercapaiPusat.hidden=true;
        DivIndTidakTercapaiCabang.hidden=true;
        DivKetLaporan.hidden=true;
        DivStatSarmut.hidden=true;
        DivPerCab.hidden=true;
        DivPerDiv.hidden=true;
        DivIndBulan.hidden=true;
        DivIndSampaiDengan.hidden=true;
        DivKPIPusat.hidden=true;
        DivKPICabang.hidden=true;
        DivKetKonsolidasi.hidden=true;
        DivTkp.hidden=true;
        DivTkpA1.hidden=true;
        DivTkpA2.hidden=true;
        DivTkpA3.hidden=true;
        DivTabelSOP.hidden=true;
        DivSummaryTPKAK.hidden=true;
        DivDetailTPKAK.hidden=true;
        DivUtiCabang.hidden=true;
        DivKinerjaCabang.hidden=true;
    }
    function OnLoadFunction()
    {
        Hide();
        if($('#ReportType').text()=="GrafikIndikator")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivGrafik =document.getElementById('DivGrafik');
            GenerateChart.hidden=false;
            DivGrafik.hidden=false;
            generatesasaranmututercapai();
        }
        else if($('#ReportType').text()=="GrafikAlasan")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivGrafik =document.getElementById('DivGrafik');
            GenerateChart.hidden=false;
            DivGrafik.hidden=false;
            generatealasantidaktercapai();
        }
        else if($('#ReportType').text()=="GrafikPTKAK")
        {
            generateptkak();
        }
        else if($('#ReportType').text()=="GrafikSOP")
        {
            generatesop();
        }
        else if($('#ReportType').text()=="StatusSarmut")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivStatSarmut =document.getElementById('DivStatSarmut');
            GenerateChart.hidden=false;
            DivStatSarmut.hidden=false;
            generateStatSarmut();
        }
        else if($('#ReportType').text()=="KetepatanLaporan")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivKetLaporan =document.getElementById('DivKetLaporan');
            GenerateChart.hidden=false;
            DivKetLaporan.hidden=false;
            generateketepatanlaporan();
        }
        else if($('#ReportType').text()=="IndicatorSasaranMutuPusat")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivIndPusat =document.getElementById('DivIndPusat');
            GenerateChart.hidden=false;
            DivIndPusat.hidden=false;
            generateindikatorpusat();
        }
         else if($('#ReportType').text()=="IndicatorSasaranMutuCabang")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivIndCabang =document.getElementById('DivIndCabang');
            GenerateChart.hidden=false;
            DivIndCabang.hidden=false;
            generateindikatorcabang();
        }
         else if($('#ReportType').text()=="IndicatorTercapaiPusat")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivIndTercapaiPusat =document.getElementById('DivIndTercapaiPusat');
            GenerateChart.hidden=false;
            DivIndTercapaiPusat.hidden=false;
            generateindikatortercapaipusat();
        }
        else if($('#ReportType').text()=="IndicatorTercapaiCabang")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivIndTercapaiCabang =document.getElementById('DivIndTercapaiCabang');
            GenerateChart.hidden=false;
            DivIndTercapaiCabang.hidden=false;
            generateindikatortercapaicabang();
        }
         else if($('#ReportType').text()=="IndicatorTidakTercapaiPusat")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivIndTidakTercapaiPusat =document.getElementById('DivIndTidakTercapaiPusat');
            GenerateChart.hidden=false;
            DivIndTidakTercapaiPusat.hidden=false;
            generateindikatortidaktercapaipusat();
        }
         else if($('#ReportType').text()=="IndicatorTidakTercapaiCabang")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivIndTidakTercapaiCabang =document.getElementById('DivIndTidakTercapaiCabang');
            GenerateChart.hidden=false;
            DivIndTidakTercapaiCabang.hidden=false;
            generateindikatortidaktercapaicabang();
        }
        else if($('#ReportType').text()=="IndicatorSasaranMutuPerCabang")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivPerCab =document.getElementById('DivPerCab');
            GenerateChart.hidden=false;
            DivPerCab.hidden=false;
            generateindikatorcabangpercabang();
        }
        else if($('#ReportType').text()=="IndicatorSasaranMutuPerDivisi")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivPerDiv =document.getElementById('DivPerDiv');
            GenerateChart.hidden=false;
            DivPerDiv.hidden=false;
            generateindikatordivisiperdivisi();
        }
        else if($('#ReportType').text()=="ReportKategoriIndicatorBulan")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivIndBulan =document.getElementById('DivIndBulan');
            GenerateChart.hidden=false;
            DivIndBulan.hidden=false;
           // generateindikatordivisiperdivisi();
           generaterealisasisasaranmutu();
        }
         else if($('#ReportType').text()=="ReportKategoriIndicatorSampaiDengan")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivIndSampaiDengan =document.getElementById('DivIndSampaiDengan');
            GenerateChart.hidden=false;
            DivIndSampaiDengan.hidden=false;
           // generateindikatordivisiperdivisi();
           generaterealisasisasaranmutusd();
        }
        else if($('#ReportType').text()=="ReportKPIPusat")
        {
            var GenerateChart =document.getElementById('generatechart');
            GenerateChart.hidden=false;
            var DivKPIPusat =document.getElementById('DivKPIPusat');
            DivKPIPusat.hidden=false;
            generatekpipusat();
        }
        else if($('#ReportType').text()=="ReportKPICabang")
        {
            var GenerateChart =document.getElementById('generatechart');
            GenerateChart.hidden=false;
            var DivKPICabang =document.getElementById('DivKPICabang');
            DivKPICabang.hidden=false;
            generatekpicabang();
        }
        else if($('#ReportType').text()=="Konsolidasi")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivKetKonsolidasi =document.getElementById('DivKetKonsolidasi');
            GenerateChart.hidden=false;
            DivKetKonsolidasi.hidden=false;
            generateKetepatanKonsolidasi();
        }
        else if($('#ReportType').text()=="ReportSummaryTKP")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivTkp =document.getElementById('DivTkp');
            GenerateChart.hidden=false;
            DivTkp.hidden=false;
            generatetkp();
        }
        else if($('#ReportType').text()=="DetailTKPA1")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivTkpA1 =document.getElementById('DivTkpA1');
            GenerateChart.hidden=false;
            DivTkpA1.hidden=false;
            generatetkpA1();
        }
        else if($('#ReportType').text()=="DetailTKPA2")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivTkpA2 =document.getElementById('DivTkpA2');
            GenerateChart.hidden=false;
            DivTkpA2.hidden=false;
            generatetkpA2();
        }
        else if($('#ReportType').text()=="DetailTKPA3")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivTkpA3 =document.getElementById('DivTkpA3');
            GenerateChart.hidden=false;
            DivTkpA3.hidden=false;
            generatetkpA3();
        }
        else if($('#ReportType').text()=="ReportSOP")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivTabelSOP =document.getElementById('DivTabelSOP');
            GenerateChart.hidden=false;
            DivTabelSOP.hidden=false;
            generatesoptabel();
        }
        else if($('#ReportType').text()=="ReportSummaryPTKAK")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivSummaryTPKAK =document.getElementById('DivSummaryTPKAK');
            GenerateChart.hidden=false;
            DivSummaryTPKAK.hidden=false;
            generateSummaryPTKAK();
        }
         else if($('#ReportType').text()=="ReportDetailPTKAK")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivDetailTPKAK =document.getElementById('DivDetailTPKAK');
            GenerateChart.hidden=false;
            DivDetailTPKAK.hidden=false;
            generatedetailptkak();
        }

        else if($('#ReportType').text()=="ReportUtiCabang")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivUtiCabang =document.getElementById('DivUtiCabang');
            GenerateChart.hidden=false;
            DivUtiCabang.hidden=false;
            generateUtiCabang();
        }

         else if($('#ReportType').text()=="ReportKinerjaCabang")
        {
            var GenerateChart =document.getElementById('generatechart');
            var DivKinerjaCabang =document.getElementById('DivKinerjaCabang');
            GenerateChart.hidden=false;
            DivKinerjaCabang.hidden=false;
            generateKinerjaCabang();
        }
    }
    function ButtonSubmit()
    {
        if($('#ReportType').text()=="GrafikIndikator")
        {
            generatesasaranmututercapai();
        }
        else if($('#ReportType').text()=="GrafikAlasan")
        {
            generatealasantidaktercapai();
        }
        else if($('#ReportType').text()=="GrafikPTKAK")
        {
            generateptkak();
        }
        else if($('#ReportType').text()=="GrafikSOP")
        {
            generatesop();
        }
        else if($('#ReportType').text()=="GrafikSOP")
        {
            generatesop();
        }
        else if($('#ReportType').text()=="IndicatorSasaranMutuPusat")
        {
            generateindikatorpusat();
        }
        else if($('#ReportType').text()=="KetepatanLaporan")
        {
            generateketepatanlaporan();
        }
        else if($('#ReportType').text()=="StatusSarmut")
        {
            generateStatSarmut();
        }
         else if($('#ReportType').text()=="IndicatorSasaranMutuCabang")
        {
            generateindikatorcabang();
        }
         else if($('#ReportType').text()=="IndicatorTercapaiPusat")
        {
            generateindikatortercapaipusat();
        }
        else if($('#ReportType').text()=="IndicatorTercapaiCabang")
        {
            generateindikatortercapaicabang();
        }
        else if($('#ReportType').text()=="IndicatorTidakTercapaiPusat")
        {
            generateindikatortidaktercapaipusat();
        }
        else if($('#ReportType').text()=="IndicatorTidakTercapaiCabang")
        {
            generateindikatortidaktercapaicabang();
        }
        else if($('#ReportType').text()=="IndicatorSasaranMutuPerCabang")
        {
            generateindikatorcabangpercabang();
        }
        else if($('#ReportType').text()=="IndicatorSasaranMutuPerDivisi")
        {
            generateindikatordivisiperdivisi();
        }
        else if($('#ReportType').text()=="ReportKategoriIndicatorBulan")
        {
            generaterealisasisasaranmutu();
        }
         else if($('#ReportType').text()=="ReportKategoriIndicatorSampaiDengan")
        {
            generaterealisasisasaranmutusd();
        }
        else if($('#ReportType').text()=="ReportKPIPusat")
        {
            generatekpipusat();
        }
        else if($('#ReportType').text()=="ReportKPICabang")
        {
            generatekpicabang();
        }
         else if($('#ReportType').text()=="KetepatanKonsolidasi")
        {
            generateKetepatanKonsolidasi();
        }
         else if($('#ReportType').text()=="ReportSummaryTKP")
        {
            generatetkp();
        }
        else if($('#ReportType').text()=="DetailTKPA1")
        {
            generatetkpA1();
        }
        else if($('#ReportType').text()=="DetailTKPA2")
        {
            generatetkpA2();
        }
        else if($('#ReportType').text()=="DetailTKPA3")
        {
            generatetkpA3();
        }
        else if($('#ReportType').text()=="ReportSOP")
        {
            generatesoptabel();
        }
         else if($('#ReportType').text()=="ReportSummaryPTKAK")
        {
            generateSummaryPTKAK();
        }
        else if($('#ReportType').text()=="ReportDetailPTKAK")
        {
            generatedetailptkak();
        }
        else if($('#ReportType').text()=="ReportUtiCabang")
        {
            generateUtiCabang();
        }
         else if($('#ReportType').text()=="ReportKinerjaCabang")
        {
            generateKinerjaCabang();
        }

    }
    function generatesasaranmututercapai()
    {
        $months = $('#months').val();
        $years = $('#years').val();
        $dir = $('#DDLDir option:selected').text();
        $divcab = $('#DDLDivCab option:selected').text();
        $subdiv = $('#DDLSubDiv option:selected').text();

        $modul = 'Kategori Indikator';

        $text1 = 'INDICATOR SASARAN MUTU PER'+' '+$months+' '+$years;
        $text2 = 'INDICATOR SASARAN MUTU PER JAN S/D'+' '+$months+' '+$years;

        $('#group1').show();
        $("#form1").show().html($text1);
        $("#form2").show().html($text2);
     
        $.ajax({

            url: "{{ url('/getgenerate') }}",
            data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years, "dir" : $dir, "divcab" : $divcab, "subdiv" : $subdiv},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                var chart = AmCharts.makeChart("m_amcharts_12", {
                  "type": "pie",
                  "theme": "light",
                  "outlineColor": "",
                  "dataProvider": data,
                  "valueField": "JUMLAH",
                  "titleField": "KETERANGAN",
                  "balloon": {
                    "fixedPosition": true
                }
            });


            },
            error: function(){

            }
        });

        $.ajax({

            url: "{{ url('/getgenerateall') }}",
            data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years, "dir" : $dir, "divcab" : $divcab, "subdiv" : $subdiv},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                var chart = AmCharts.makeChart("m_amcharts_13", {
                  "type": "pie",
                  "theme": "light",
                  "outlineColor": "",
                  "dataProvider": data,
                  "valueField": "JUMLAH",
                  "titleField": "KETERANGAN",
                  "balloon": {
                    "fixedPosition": true
                }
            });


            },
            error: function(){

            }
        });

    }

    function generatealasantidaktercapai()
    {
    	$('#formUtiCabang').hide();
        $months = $('#months').val();
        $years = $('#years').val();
        $dir = $('#DDLDir option:selected').text();
        $divcab = $('#DDLDivCab option:selected').text();
        $subdiv = $('#DDLSubDiv option:selected').text();
        $modul = 'Alasan Tidak Tercapai';

        $text3 = 'ALASAN SASARAN MUTU TIDAK TERCAPAI'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
        $text4 = 'ALASAN SASARAN MUTU TIDAK TERCAPAI PER JAN S/D'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';

        $('#group2').show();
        $("#form3").show().html($text3);
        $("#form4").show().html($text4);

        $.ajax({
            url: "{{ url('/getgeneratebarchart') }}",
            data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years, "dir" : $dir, "divcab" : $divcab, "subdiv" : $subdiv},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                var chart = AmCharts.makeChart("m_amcharts_4", {
                    "theme": "light",
                    "type": "serial",
                    "dataProvider": data,
                    "valueAxes": [{
                        "stackType": "3d",
                        "unit": "",
                        "position": "left",
                        "title": "",
                    }],
                    "startDuration": 1,
                    "graphs": [{
                        "balloonText": "[[category]] : <b>[[value]]</b>",
                        "fillAlphas": 1.0,
                        "lineAlpha": 0.2,
                        "title": "",
                        "type": "column",
                        "valueField": "JUMLAH"
                    }],
                    "plotAreaFillAlphas": 0.1,
                    "depth3D": 100,
                    "angle": 50,
                    "categoryField": "ALASAN",
                    "categoryAxis": {
                        "gridPosition": "start"
                    },
                    "export": {
                        "enabled": true
                    }

                });

            },
            error: function(){

            }
        });

        $.ajax({
            url: "{{ url('/getgeneratebarchartall') }}",
            data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years, "dir" : $dir, "divcab" : $divcab, "subdiv" : $subdiv},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                var chart = AmCharts.makeChart("m_amcharts_5", {
                    "theme": "light",
                    "type": "serial",
                    "dataProvider": data,
                    "valueAxes": [{
                        "stackType": "3d",
                        "unit": "",
                        "position": "left",
                        "title": "",
                    }],
                    "startDuration": 1,
                    "graphs": [{
                        "balloonText": "[[category]] : <b>[[value]]</b>",
                        "fillAlphas": 1.0,
                        "lineAlpha": 0.2,
                        "title": "",
                        "type": "column",
                        "valueField": "JUMLAH"
                    }],
                    "plotAreaFillAlphas": 0.1,
                    "depth3D": 100,
                    "angle": 50,
                    "categoryField": "ALASAN",
                    "categoryAxis": {
                        "gridPosition": "start"
                    },
                    "export": {
                        "enabled": true
                    }

                });

            },
            error: function(){

            }
        });
    }

    function generatesop() {
        $months = $('#months').val();
        $years = $('#years').val();
        $modul = 'SOP';

        $text5 = 'JUMLAH SOP, WI, DAN FORMS'+' '+$years+' '+'(KONSOLIDASI PTP)';

        $('#group3').show();
        $("#form5").show().html($text5);

        $.ajax({
            url: "{{ url('/getgeneratesop') }}",
            data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                var chart = AmCharts.makeChart("m_amcharts_14", {
                    "type": "pie",
                    "theme": "light",
                    "outlineColor": "",
                    "dataProvider": data,
                    "valueField": "JUMLAH",
                    "titleField": "TYPE",
                    "balloon": {
                        "fixedPosition": true
                    }
                });
            },
            error: function(){

            }
        });
    }

    function generateptkak()
    {
        $modul = 'PTKAK';
        $text6 = 'GRAFIK STATUS PTKAK (KONSOLIDASI PTP)'; //SAMPAI DENGAN'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
        $text7 = 'GRAFIK SUB DIVISI PTKAK (KONSOLIDASI PTP)'; //SAMPAI DENGAN'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';

        $('#group4').show();
        $("#form6").show().html($text6);
        $("#form7").show().html($text7);

        $.ajax({

            url: "{{ url('/getgenerateptkak') }}",
            data: {"_token": "{{ csrf_token() }}"},//, "months" : $months, "years" : $years},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                var chart = AmCharts.makeChart("m_amcharts_15", {
                    "type": "pie",
                    "theme": "light",
                    "outlineColor": "",
                    "dataProvider": data,
                    "valueField": "JUMLAH",
                    "titleField": "STATUS",
                    "balloon": {
                        "fixedPosition": true
                    }
                });


            },
            error: function(){

            }
        });

        $.ajax({

            url: "{{ url('/getsubdivptkak') }}",
            data: {"_token": "{{ csrf_token() }}"},//, "months" : $months, "years" : $years},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                var chart = AmCharts.makeChart("m_amcharts_16", {
                    "type": "pie",
                    "theme": "light",
                    "outlineColor": "",
                    "dataProvider": data,
                    "valueField": "JUMLAH",
                    "titleField": "SUBDIV",
                    "balloon": {
                        "fixedPosition": true
                    }
                });


            },
            error: function(){

            }
        });

    }

    function generateindikatorcabangpercabang()
    {
        var DivPerCab =document.getElementById('DivPerCab');
        DivPerCab.hidden=true;
        $('#tableindicatorcabangpercabang td').remove();
        //$months = $('#months').val(); 
        $years = $('#yearscabpercab').val();
        $cabang = $('#DDLcabpercab').val();

        $text = 'Report Indikator Cabang '+$cabang+' '+'Per Cabang'+' '+$years;

        $("#formindicatorcabangpercabang").show().html($text);
        $('#tableindicatorcabangpercabang').show();
        $('#exportdatatoexcelindikatorcabangpercabang').show();
        
        $.ajax({
            url: "{{ url('/previewindikatorcabangpercabang') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                if(data.length=='0')
                {
                    alert('No Data');
                }
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatacabangpercabang tr").detach();
                $.each(data, function (index,value) {
                        var dataindikatorcabangpercabang = '<tr style="width: 100% !important;">'+
                        '<td style="width: 10% !important; color:red;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
                        '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                        '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                        '<td style="width: 5% !important;">'+value.APR+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                        '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                        '<td style="width: 5% !important;">'+value.SEP+'</td>'+
                        '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                        '<td style="width: 5% !important;">'+value.NOV+'</td>'+
                        '<td style="width: 5% !important;">'+value.DES+'</td>'+
                        '<td style="width: 5% !important;">'+value.Target+'</td>'+
                        '<td style="width: 5% !important;">'+value.Sampai_Dengan+'</td>'+'</tr>';                
                    $('#tableindicatorcabangpercabang').append(dataindikatorcabangpercabang);
                })
                DivPerCab.hidden=false;
            },
            error: function(){

            }
        });

    }
    function generateindikatordivisiperdivisi()
    {
        var DivPerDiv =document.getElementById('DivPerDiv');
        DivPerDiv.hidden=true;
        $('#tableindicatordivisiperdivisi td').remove();
        //$months = $('#months').val(); 
        $years = $('#yearsdivperdiv').val();
        $divisi = $('#DDLdivperdiv').val();

        $text = 'Report Indikator Divisi '+$divisi+' Per Tahun '+$years;

        $("#formindicatordivisiperdivisi").show().html($text);
        $('#tableindicatordivisiperdivisi').show();
        $('#exportdatatoexcelindikatordivisiperdivisi').show();

        $.ajax({

            url: "{{ url('/previewindikatordivisiperdivisi') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "divisi" : $divisi},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                if(data.length=='0')
                {
                    alert('No Data');
                }
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatadivisiperdivisi tr").detach();
                $.each(data, function (index,value) {
                        var dataindikatordivisiperdivisi = '<tr style="width: 100% !important;">'+
                        '<td style="width: 10% !important; color:red;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
                        '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                        '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                        '<td style="width: 5% !important;">'+value.APR+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                        '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                        '<td style="width: 5% !important;">'+value.SEP+'</td>'+
                        '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                        '<td style="width: 5% !important;">'+value.NOV+'</td>'+
                        '<td style="width: 5% !important;">'+value.DES+'</td>'+
                        '<td style="width: 5% !important;">'+value.Target+'</td>'+
                        '<td style="width: 5% !important;">'+value.Sampai_Dengan+'</td>'+
                '</tr>';                
                    $('#tableindicatordivisiperdivisi').append(dataindikatordivisiperdivisi);
                })
                DivPerDiv.hidden=false;
            },
            error: function(){

            }
        });
    }

    function generatekpipusat()
    {
        //$months = $('#months').val();

        var $years = $('#yearskpipusat').val(); 
        var $period = $('#triwulanselectpusat').val();

        $text = 'Report Indikator KPI Pusat';

        
        $("#formkpipusat").show().html($text);
        $('#tablekpipusat').show();
        $('#exportdatatoexcelkpipusat').show();

        $("#tablekpipusat tr").remove(); 
        $.ajax({

            url: "{{ url('/previewindikatorkpipusat') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years,"period" : $period},
            type: "GET",
            dataType: "json",
            success: function(data){
                console.log(data);
                $("#cleardatakpipusat tr").detach();
                var head1 = [];
                head1[1] = '';
                $.each(data, function (index,value) {
                    
                    head1[index+1] = value.Perspective;
                    if (head1[index] != head1[index+1]) {
                        var dataindikatorkpipusat = 
                        '<tr style="width: 20% !important;  border : 1px;">'+
                            // '<td>I</td>'
                            '<td style="width: 20% !important; color:black;"><b>'+value.Perspective+'</b></td>'+
                        '<tr style="width: 80% !important;  border : 1px;">'+
                            // '<td>'+no+'</td>'
                            '<td style="width: 20% !important;">'+value.Indicator_Name+'</td>'+
                            '<td style="width: 10% !important;">'+value.Unit+'</td>'+
                            '<td style="width: 10% !important;">'+value.Bobot+'</td>'+
                            '<td style="width: 10% !important;">'+value.Target+'</td>'+
                            '<td style="width: 10% !important;">'+value.Actual_Realisasi+'</td>'+
                            '<td style="width: 10% !important;">'+value.Pencapaian+'</td>'+
                            '<td style="width: 10% !important;">'+value.Score+'</td>'+
                        '</tr>'
                        '</tr>';   
                    }else{
                        var dataindikatorkpipusat =
                        '<tr style="width: 80% !important;  border : 1px;">'+
                            // '<td>'+no+'</td>'
                            '<td style="width: 20% !important;">'+value.Indicator_Name+'</td>'+
                            '<td style="width: 10% !important;">'+value.Unit+'</td>'+
                            '<td style="width: 10% !important;">'+value.Bobot+'</td>'+
                            '<td style="width: 10% !important;">'+value.Target+'</td>'+
                            '<td style="width: 10% !important;">'+value.Actual_Realisasi+'</td>'+
                            '<td style="width: 10% !important;">'+value.Pencapaian+'</td>'+
                            '<td style="width: 10% !important;">'+value.Score+'</td>'+
                        '</tr>'
                        '</tr>'; 
                    }

                    $('#tablekpipusat').append(dataindikatorkpipusat);
                })
            },
            error: function(){

            }
        });
    }

    function generatekpicabang()
    {
        //$months = $('#months').val();

        var $years = $('#yearskpicabang').val(); 
        var $period = $('#triwulanselectcabang').val();
        var $cab = $('#DDLkpicab').val();

        $text = 'Report Indikator KPI';

        
        $("#formkpicabang").show().html($text);
        $('#tablekpicabang').show();
        $('#exportdatatoexcelkpicabang').show();

        $("#tablekpicabang tr").remove(); 
        $.ajax({

            url: "{{ url('/previewindikatorkpicabang') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years,"period" : $period,"cabang" : $cab},
            type: "GET",
            dataType: "json",
            success: function(data){
                console.log(data);
                // $('#tablekpi').empty();
                $("#cleardatakpicabang tr").detach();
                // var no = 0;
                var head1 = [];
                head1[1] = '';
                $.each(data, function (index,value) {
                    // no++;
                    
                    head1[index+1] = value.Perspective;
                    if (head1[index] != head1[index+1]) {
                        var dataindikatorkpicabang = 
                        '<tr style="width: 20% !important;  border : 1px;">'+
                            // '<td>I</td>'
                            '<td style="width: 20% !important; color:black;"><b>'+value.Perspective+'</b></td>'+
                        '<tr style="width: 80% !important;  border : 1px;">'+
                            // '<td>'+no+'</td>'
                            '<td style="width: 20% !important;">'+value.Indicator_Name+'</td>'+
                            '<td style="width: 10% !important;">'+value.Unit+'</td>'+
                            '<td style="width: 10% !important;">'+value.Bobot+'</td>'+
                            '<td style="width: 10% !important;">'+value.Target+'</td>'+
                            '<td style="width: 10% !important;">'+value.Actual_Realisasi+'</td>'+
                            '<td style="width: 10% !important;">'+value.Pencapaian+'</td>'+
                            '<td style="width: 10% !important;">'+value.Score+'</td>'+
                        '</tr>'
                        '</tr>';   
                    }else{
                        var dataindikatorkpicabang =
                        '<tr style="width: 80% !important;  border : 1px;">'+
                            // '<td>'+no+'</td>'
                            '<td style="width: 20% !important;">'+value.Indicator_Name+'</td>'+
                            '<td style="width: 10% !important;">'+value.Unit+'</td>'+
                            '<td style="width: 10% !important;">'+value.Bobot+'</td>'+
                            '<td style="width: 10% !important;">'+value.Target+'</td>'+
                            '<td style="width: 10% !important;">'+value.Actual_Realisasi+'</td>'+
                            '<td style="width: 10% !important;">'+value.Pencapaian+'</td>'+
                            '<td style="width: 10% !important;">'+value.Score+'</td>'+
                        '</tr>'
                        '</tr>'; 
                    }

                    $('#tablekpicabang').append(dataindikatorkpicabang);
                })


            },
            error: function(){

            }
        });
    }

    function generatetkp()
    {
        //$months = $('#months').val();
        $years = $('#yearsTkp').val();
        $cabang = $('#cabang').val();

        $text = 'Report Indikator TKP';

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $('#formindicatorcabang').hide();
        $('#tableindicatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
         $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $('#exportdatatoexcelketepatanlaporan1').hide();

         $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").show().html($text);
        $('#tabletkp').show();
        $('#exportdatatoexceltkp').show();
        
        // $.ajax({

        //     url: "{{ url('/previewindikatorcabangpercabang') }}",
        //     data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
        //     type: "POST",
        //     dataType: "json",
        //     success: function(data){
        //         console.log(data);
        //         //$('#tableindicatorcabangpercabang').empty();
        //         $("#cleardatacabangpercabang tr").detach();
        //         $.each(data, function (index,value) {
        //             if (value.Sub_Division_Name=='BTN - Operasi') {
        //                 var dataindikatorcabangpercabang = 
        //                 '<tr style="width: 100% !important; border : 1px; color:red;">'+
        //                     '<td style="width: 10% !important; color:red;"><b>'+value.Sub_Division_Name+'</b></td>'+
        //                     '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                     '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                     '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //                 '</tr>';    
        //             }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
        //                 var dataindikatorcabangpercabang = '<tr style="width: 100% !important;  border : 1px;">'+
        //                 '<td style="width: 10% !important; color:blue"><b>'+value.Sub_Division_Name+'</b></td>'+
        //                 '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //                 '</tr>';    
        //             }else{
        //                 var dataindikatorcabangpercabang = '<tr style="width: 100% !important;">'+
        //                 '<td style="width: 10% !important; color:red;">'+value.Sub_Division_Name+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //         '</tr>';
        //             }                   
        //             $('#tableindicatorcabangpercabang').append(dataindikatorcabangpercabang);
        //         })


        //     },
        //     error: function(){

        //     }
        // });

    }

    function generatetkpA1()
    {
        //$months = $('#months').val();
        $years = $('#yearsTkpA1').val();
        $cabang = $('#cabang').val();

        $text = 'Report Indikator TKPA1';

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $('#formindicatorcabang').hide();
        $('#tableindicatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
         $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $('#exportdatatoexcelketepatanlaporan1').hide();

         $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").show().html($text);
        $('#tabletkp').show();
        $('#exportdatatoexceltkp').show();
        
        // $.ajax({

        //     url: "{{ url('/previewindikatorcabangpercabang') }}",
        //     data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
        //     type: "POST",
        //     dataType: "json",
        //     success: function(data){
        //         console.log(data);
        //         //$('#tableindicatorcabangpercabang').empty();
        //         $("#cleardatacabangpercabang tr").detach();
        //         $.each(data, function (index,value) {
        //             if (value.Sub_Division_Name=='BTN - Operasi') {
        //                 var dataindikatorcabangpercabang = 
        //                 '<tr style="width: 100% !important; border : 1px; color:red;">'+
        //                     '<td style="width: 10% !important; color:red;"><b>'+value.Sub_Division_Name+'</b></td>'+
        //                     '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                     '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                     '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //                 '</tr>';    
        //             }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
        //                 var dataindikatorcabangpercabang = '<tr style="width: 100% !important;  border : 1px;">'+
        //                 '<td style="width: 10% !important; color:blue"><b>'+value.Sub_Division_Name+'</b></td>'+
        //                 '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //                 '</tr>';    
        //             }else{
        //                 var dataindikatorcabangpercabang = '<tr style="width: 100% !important;">'+
        //                 '<td style="width: 10% !important; color:red;">'+value.Sub_Division_Name+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //         '</tr>';
        //             }                   
        //             $('#tableindicatorcabangpercabang').append(dataindikatorcabangpercabang);
        //         })


        //     },
        //     error: function(){

        //     }
        // });

    }

    function generatetkpA2()
    {
        //$months = $('#months').val();
        $years = $('#yearsTkpA2').val();
        $cabang = $('#cabang').val();

        $text = 'Report Indikator TKPA2';

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $('#formindicatorcabang').hide();
        $('#tableindicatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
         $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $('#exportdatatoexcelketepatanlaporan1').hide();

         $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").show().html($text);
        $('#tabletkp').show();
        $('#exportdatatoexceltkp').show();
        
        // $.ajax({

        //     url: "{{ url('/previewindikatorcabangpercabang') }}",
        //     data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
        //     type: "POST",
        //     dataType: "json",
        //     success: function(data){
        //         console.log(data);
        //         //$('#tableindicatorcabangpercabang').empty();
        //         $("#cleardatacabangpercabang tr").detach();
        //         $.each(data, function (index,value) {
        //             if (value.Sub_Division_Name=='BTN - Operasi') {
        //                 var dataindikatorcabangpercabang = 
        //                 '<tr style="width: 100% !important; border : 1px; color:red;">'+
        //                     '<td style="width: 10% !important; color:red;"><b>'+value.Sub_Division_Name+'</b></td>'+
        //                     '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                     '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                     '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //                 '</tr>';    
        //             }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
        //                 var dataindikatorcabangpercabang = '<tr style="width: 100% !important;  border : 1px;">'+
        //                 '<td style="width: 10% !important; color:blue"><b>'+value.Sub_Division_Name+'</b></td>'+
        //                 '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //                 '</tr>';    
        //             }else{
        //                 var dataindikatorcabangpercabang = '<tr style="width: 100% !important;">'+
        //                 '<td style="width: 10% !important; color:red;">'+value.Sub_Division_Name+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //         '</tr>';
        //             }                   
        //             $('#tableindicatorcabangpercabang').append(dataindikatorcabangpercabang);
        //         })


        //     },
        //     error: function(){

        //     }
        // });

    }

    function generatetkpA3()
    {
        //$months = $('#months').val();
        $years = $('#yearsTkpA3').val();
        $cabang = $('#cabang').val();

        $text = 'Report Indikator TKPA3';

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $('#formindicatorcabang').hide();
        $('#tableindicatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
         $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $('#exportdatatoexcelketepatanlaporan1').hide();

         $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").show().html($text);
        $('#tabletkp').show();
        $('#exportdatatoexceltkp').show();
        
        // $.ajax({

        //     url: "{{ url('/previewindikatorcabangpercabang') }}",
        //     data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
        //     type: "POST",
        //     dataType: "json",
        //     success: function(data){
        //         console.log(data);
        //         //$('#tableindicatorcabangpercabang').empty();
        //         $("#cleardatacabangpercabang tr").detach();
        //         $.each(data, function (index,value) {
        //             if (value.Sub_Division_Name=='BTN - Operasi') {
        //                 var dataindikatorcabangpercabang = 
        //                 '<tr style="width: 100% !important; border : 1px; color:red;">'+
        //                     '<td style="width: 10% !important; color:red;"><b>'+value.Sub_Division_Name+'</b></td>'+
        //                     '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                     '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                     '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                     '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //                 '</tr>';    
        //             }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
        //                 var dataindikatorcabangpercabang = '<tr style="width: 100% !important;  border : 1px;">'+
        //                 '<td style="width: 10% !important; color:blue"><b>'+value.Sub_Division_Name+'</b></td>'+
        //                 '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //                 '</tr>';    
        //             }else{
        //                 var dataindikatorcabangpercabang = '<tr style="width: 100% !important;">'+
        //                 '<td style="width: 10% !important; color:red;">'+value.Sub_Division_Name+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JAN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.FEB+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.APR+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.MAY+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUN+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.JUL+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.AUG+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.SEP+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.OCT+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.NOV+'</td>'+
        //                 '<td style="width: 5% !important;">'+value.DES+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Target+'</td>'+
        //                 '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
        //         '</tr>';
        //             }                   
        //             $('#tableindicatorcabangpercabang').append(dataindikatorcabangpercabang);
        //         })


        //     },
        //     error: function(){

        //     }
        // });

    }

    function generateindikatorcabang()
    {
        var DivIndCabang =document.getElementById('DivIndCabang');
        DivIndCabang.hidden=true;
        $('#tableindicatorcabang td').remove();
        //$months = $('#months').val();
        $years = $('#yearsindcabang').val();
        $cabang = $('#cabang').val();

        $text = 'Report Indikator Cabang '+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
         $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formindicatorcabang").show().html($text);
        $('#tableindicatorcabang').show();
        $('#exportdatatoexcelindikatorcabang').show();
        $('#exportdatatoexcelketepatanlaporan1').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();
        
        $.ajax({

            url: "{{ url('/previewindikatorcabang') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years , "cabang" : $cabang},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                if (data.length==0)
                {
                    alert('No Data');
                }
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatacabang tr").detach();
                $.each(data, function (index,value) {
                    var dataindikatorcabang = '<tr style="width: 100% !important; border : 1px;">'+
                        '<td style="width: 10% !important; color:red">'+value.Sub_Division_Name+'</td>'+
                    '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
                    '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                    '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                    '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                    '<td style="width: 5% !important;">'+value.APR+'</td>'+
                    '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                    '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                    '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                    '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                    '<td style="width: 5% !important;">'+value.SEP+'</td>'+
                    '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                    '<td style="width: 5% !important;">'+value.NOV+'</td>'+
                    '<td style="width: 5% !important;">'+value.DES+'</td>'+
                    '<td style="width: 5% !important;">'+value.Target+'</td>'+
                    '<td style="width: 5% !important;">'+value.Sampai_Dengan+'</td>'+

                    '</tr>';    

                    $('#tableindicatorcabang').append(dataindikatorcabang);
                })

                DivIndCabang.hidden=false;
            },
            error: function(){

            }
        });

    }

    function generateindikatorpusat()
    {
        var DivIndPusat =document.getElementById('DivIndPusat');
        DivIndPusat.hidden=true;
        $('#tableindicatorpusat td').remove();
        //$months = $('#months').val();
        $years = $('#yearsindpusat').val();

        $text = 'Report Indikator Pusat '+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formindicatorpusat").show().html($text);
        $('#tableindicatorpusat').show();
        $('#exportdatatoexcelindikatorpusat').show();
        $('#exportdatatoexcelketepatanlaporan1').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();
        
        $.ajax({

            url: "{{ url('/previewindikatorpusat') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                if (data.length=='0')
                {
                    alert('No Data');
                }
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatapusat tr").detach();
                $.each(data, function (index,value) {
                    var dataindikatorpusat = '<tr style="width: 100% !important;">'+
                        '<td style="width: 10% !important;">'+value.Sub_Division_Name+'</td>'+
                    '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
                    '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                    '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                    '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                    '<td style="width: 5% !important;">'+value.APR+'</td>'+
                    '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                    '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                    '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                    '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                    '<td style="width: 5% !important;">'+value.SEP+'</td>'+
                    '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                    '<td style="width: 5% !important;">'+value.NOV+'</td>'+
                    '<td style="width: 5% !important;">'+value.DES+'</td>'+
                    '<td style="width: 5% !important;">'+value.Target+'</td>'+
                    '<td style="width: 5% !important;">'+value.Sampai_Dengan+'</td>'+
                    '</tr>';
                    
                    $('#tableindicatorpusat').append(dataindikatorpusat);
                })
                DivIndPusat.hidden=false;

            },
            error: function(){

            }
        });

    }


    function generateindikatortercapaipusat()
    {
        var DivIndTercapaiPusat =document.getElementById('DivIndTercapaiPusat');
        DivIndTercapaiPusat.hidden=true;
        $('#tabletercapaipusat td').remove();
        //$months = $('#months').val();
        $years = $('#yearsTercapaiPusat').val();
        $cabang = $('#cabang').val();

        $text = 'Report Indikator Tercapai Pusat '+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formtercapaipusat").show().html($text);
        $('#tabletercapaipusat').show();
        $('#exportdatatoexceltercapaipusat').show();
        $('#exportdatatoexcelketepatanlaporan1').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();

        $.ajax({

            url: "{{ url('/previewtercapaipusat') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatatercapaipusat tr").detach();
                $.each(data, function (index,value) {
                    
                        var datatercapaipusat = '<tr style="width: 100% !important;">'+
                        '<td style="width: 10% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
                        '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                        '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                        '<td style="width: 5% !important;">'+value.APR+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                        '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                        '<td style="width: 5% !important;">'+value.SEP+'</td>'+
                        '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                        '<td style="width: 5% !important;">'+value.NOV+'</td>'+
                        '<td style="width: 5% !important;">'+value.DES+'</td>'+
                        '<td style="width: 10% !important;">'+value.Target+'</td>'+
                        '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
                        '</tr>';
                    
                    $('#tabletercapaipusat').append(datatercapaipusat);
                })
                DivIndTercapaiPusat.hidden=false;
            },
            error: function(){

            }
        });
    }


    function generateindikatortidaktercapaipusat()
    {
        var DivIndTidakTercapaiPusat =document.getElementById('DivIndTidakTercapaiPusat');
        DivIndTidakTercapaiPusat.hidden=true;
        $('#tabletidaktercapaipusat td').remove();
        //$months = $('#months').val();
        $years = $('#yearsTidakTercapaiPusat').val();
        $cabang = $('#cabang').val();

        $text = 'Report Indikator Tidak Tercapai Pusat '+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formtidaktercapaipusat").show().html($text);
        $('#tabletidaktercapaipusat').show();
        $('#exportdatatoexceltidaktercapaipusat').show();
        $('#exportdatatoexcelketepatanlaporan1').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();

        
        $.ajax({

            url: "{{ url('/previewtidaktercapaipusat') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatatidaktercapaipusat tr").detach();
                $.each(data, function (index,value) {
                        var datatidaktercapaipusat = '<tr style="width: 100% !important;">'+
                         '<td style="width: 10% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
                        '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                        '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                        '<td style="width: 5% !important;">'+value.APR+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                        '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                        '<td style="width: 5% !important;">'+value.SEP+'</td>'+
                        '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                        '<td style="width: 5% !important;">'+value.NOV+'</td>'+
                        '<td style="width: 5% !important;">'+value.DES+'</td>'+
                        '<td style="width: 10% !important;">'+value.Target+'</td>'+
                        '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
                        '</tr>';
                    
                    $('#tabletidaktercapaipusat').append(datatidaktercapaipusat);
                })

                DivIndTidakTercapaiPusat.hidden=false;
            },
            error: function(){

            }
        });

    }

    function generateindikatortercapaicabang()
    {
        var DivIndTercapaiCabang =document.getElementById('DivIndTercapaiCabang');
        DivIndTercapaiCabang.hidden=true;
        $('#tabletercapaicabang td').remove();
        //$months = $('#months').val();
        $years = $('#yearsTercapaiCabang').val();
        $cabang = $('#cabang').val();

        $text = 'Report Indikator Tercapai Cabang '+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
         $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formtercapaicabang").show().html($text);
        $('#tabletercapaicabang').show();
        $('#exportdatatoexceltercapaicabang').show();
        $('#exportdatatoexcelketepatanlaporan1').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();

        
        $.ajax({

            url: "{{ url('/previewtercapaicabang') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatatercapaicabang tr").detach();
                $.each(data, function (index,value) {
                        var datatercapaicabang = '<tr style="width: 100% !important;">'+
                         '<td style="width: 10% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
                        '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                        '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                        '<td style="width: 5% !important;">'+value.APR+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                        '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                        '<td style="width: 5% !important;">'+value.SEP+'</td>'+
                        '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                        '<td style="width: 5% !important;">'+value.NOV+'</td>'+
                        '<td style="width: 5% !important;">'+value.DES+'</td>'+
                        '<td style="width: 10% !important;">'+value.Target+'</td>'+
                        '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
                        '</tr>';
                    
                    $('#tabletercapaicabang').append(datatercapaicabang);
                })
                DivIndTercapaiCabang.hidden=false;
            },
            error: function(){

            }
        });

    }


     function generateindikatortidaktercapaicabang()
    {
        var DivIndTidakTercapaiCabang =document.getElementById('DivIndTidakTercapaiCabang');
        DivIndTidakTercapaiCabang.hidden=true;
        $('#tabletidaktercapaicabang td').remove();
        //$months = $('#months').val();
        $years = $('#yearsTidakTercapaiCabang').val();

        $text = 'Report Indikator Tidak Tercapai Cabang '+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formtidaktercapaicabang").show().html($text);
        $('#tabletidaktercapaicabang').show();
        $('#exportdatatoexceltidaktercapaicabang').show();
        $('#exportdatatoexcelketepatanlaporan1').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();
        $("#formUtiCabang").hide();

        $.ajax({

            url: "{{ url('/previewtidaktercapaicabang') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatatidaktercapaicabang tr").detach();
                $.each(data, function (index,value) {
                        var datatidaktercapaicabang = '<tr style="width: 100% !important;">'+
                         '<td style="width: 10% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
                        '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                        '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                        '<td style="width: 5% !important;">'+value.APR+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                        '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                        '<td style="width: 5% !important;">'+value.SEP+'</td>'+
                        '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                        '<td style="width: 5% !important;">'+value.NOV+'</td>'+
                        '<td style="width: 5% !important;">'+value.DES+'</td>'+
                        '<td style="width: 10% !important;">'+value.Target+'</td>'+
                        '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
                        '</tr>';
                    
                    $('#tabletidaktercapaicabang').append(datatidaktercapaicabang);
                })
                DivIndTidakTercapaiCabang.hidden=false;
            },
            error: function(){

            }
        });

    }
    
    function generateStatSarmut()
    {
        var DivStatSarmut =document.getElementById('DivStatSarmut');
        DivStatSarmut.hidden=true;
        $('#tableStatSarmut td').remove();
        //$months = $('#months').val();
        $years = $('#yearsStatSarmut').val();

        $text = 'Report Status Sarmut Periode '+' '+$years;
        $('#exportdatatoexcelketepatanlaporan1').hide();
        $('#exportdatatoexcelStatSarmut1').show();
        $('#group1').hide();  
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide(); 
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formStatSarmut").show().html($text);
        $('#tableStatSarmut').show();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();
        $("#formUtiCabang").hide();
        
        $.ajax({

            url: "{{ url('/previewStatSarmut') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardataStatSarmut tr").detach();
                if (data.length=='0')
                {
                    alert('No Data');
                }
                $.each(data, function (index,value) {
                    var dataStatSarmut = '<tr style="width: 100% !important; border : 1px;">'+
                    '<td style="width: 10% !important;">'+value.Division_Name+'</td>'+
                    '<td style="width: 10% !important;">'+value.Sub_Division_Name+'</td>'+
                    '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                    '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                    '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                    '<td style="width: 5% !important;">'+value.APR+'</td>'+
                    '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                    '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                    '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                    '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                    '<td style="width: 5% !important;">'+value.SEP+'</td>'+ 
                    '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                    '<td style="width: 5% !important;">'+value.NOV+'</td>'+ 
                    '<td style="width: 5% !important;">'+value.DES+'</td>'+
                    '</tr>';    
                    $('#tableStatSarmut').append(dataStatSarmut);
                })

                DivStatSarmut.hidden=false;
            },
            error: function(){

            }
        });

    }

    function generateketepatanlaporan()
    {
        var DivKetLaporan =document.getElementById('DivKetLaporan');
        DivKetLaporan.hidden=true;
        $('#tableketepatanlaporan td').remove();
        //$months = $('#months').val();
        $years = $('#yearsKetLaporan').val();

        $text = 'Report Ketepatan Laporan '+' '+$years;
        $('#exportdatatoexcelketepatanlaporan1').show();
        $('#group1').hide();  
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide(); 
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formketepatanlaporan").show().html($text);
        $('#tableketepatanlaporan').show();
        // $("#formStatSarmut").hide();
        // $('#tableStatSarmut').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();
        $("#formUtiCabang").hide();
        
        $.ajax({

            url: "{{ url('/previewketepatanlaporan') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                if(data.length=='0')
                {
                    alert('No Data');
                }
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardataketepatanlaporan tr").detach();
                $.each(data, function (index,value) {
                    var dataketepatanlaporan = '<tr style="width: 100% !important; border : 1px;">'+
                    '<td style="width: 10% !important; color:red"><b>'+value.Division_Name+'</b></td>'+
                    '<td style="width: 10% !important;">'+value.Sub_Division_Name+'</td>'+
                    '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                    '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                    '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                    '<td style="width: 5% !important;">'+value.APR+'</td>'+
                    '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                    '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                    '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                    '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                    '<td style="width: 5% !important;">'+value.SEP+'</td>'+ 
                    '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                    '<td style="width: 5% !important;">'+value.NOV+'</td>'+ 
                    '<td style="width: 5% !important;">'+value.DES+'</td>'+
                    '</tr>';    
                    $('#tableketepatanlaporan').append(dataketepatanlaporan);
                })
                DivKetLaporan.hidden=false;
            },
            error: function(){

            }
        });

    }

    function generaterealisasisasaranmutusd()
    {
        /*var DivIndSampaiDengan =document.getElementById('DivIndSampaiDengan');
        DivIndSampaiDengan.hidden=true;*/
        var DivIndSampaiDengan =document.getElementById('DivIndSampaiDengan');
        DivIndSampaiDengan.hidden=true;
        $('#tabledetailkategorisd td').remove();

        $months = $('#monthsSampaiDengan').val();
        $years = $('#yearsSampaiDengan').val();
        $cabang = $('#cabang').val();

        $text = 'Report Detail Kategori Sampai Dengan '+' '+$months+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formdetailkategorisd").show().html($text);
        $('#tabledetailkategorisd').show();
        $('#exportdatatoexceldetailkategorisd').show();
        $('#exportdatatoexcelketepatanlaporan1').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();
        $("#formUtiCabang").hide();
        
        $.ajax({

            url: "{{ url('/previewdetailkategorisd') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang, "months" : $months},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatadetailkategorisd tr").detach();
                $.each(data, function (index,value) {
                        var datadetailkategorisd = '<tr style="width: 100% !important;">'+
                         '<td style="width: 35% !important;"><b>'+value.Division_Name+'</b></td>'+
                        '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tidak_Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Data_Kurang_Percent+'</td>'+
                        '</tr>';
                    $('#tabledetailkategorisd').append(datadetailkategorisd);
                })
                DivIndSampaiDengan.hidden=false;

            },
            error: function(){

            }
        });

    }


    function generaterealisasisasaranmutu()
    {
        //var DivIndBulan = document.getElementById('DivIndBulan');
        //DivIndBulan.hidden = true;
        var DivIndBulan =document.getElementById('DivIndBulan');
        DivIndBulan.hidden=true;
        $('#tabledetailkategori td').remove();

        $months = $('#monthsBulan').val();
        $years = $('#yearsBulan').val();
        $cabang = $('#cabang').val();

         $text = 'Report Detail Kategori'+' '+$months+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formdetailkategori").show().html($text);
        $('#tabledetailkategori').show();
        $('#exportdatatoexceldetailkategori').show();
        $("#formUtiCabang").hide();
        
        $.ajax({

            url: "{{ url('/previewdetailkategori') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang ,"months" : $months},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatadetailkategori tr").detach();
                $.each(data, function (index,value) {
                        var datadetailkategori = '<tr style="width: 100% !important;">'+
                         '<td style="width: 35% !important;"><b>'+value.Division_Name+'</b></td>'+
                        '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tidak_Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Data_Kurang_Percent+'</td>'+
                        '</tr>';
                    
                    $('#tabledetailkategori').append(datadetailkategori);
                })
                DivIndBulan.hidden=false;

            },
            error: function(){

            }
        });

    }

     function generatesoptabel()
    {
        //window.open("https://ereport.ptp.co.id/listexportdata");
        $('#tabledetailsop td').remove();

        $months = $('#monthsTabelSOP').val();
        $years = $('#yearsTabelSOP').val();
        $cabang = $('#cabang').val();

         $text = 'Report SOP '+' '+$months+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formdetailsop").show().html($text);
        $('#tabledetailsop').show();
        $('#exportdatatoexceldetailsop').show();
        
        $.ajax({

            url: "{{ url('/previewdetailsop') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang ,"months" : $months},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatadetailsop tr").detach();
                $.each(data, function (index,value) {
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var datadetailsop = '<tr style="width: 100% !important; border : 1px;">'+
                        '<td style="width: 25% !important; color:red"><b>'+value.Sub_Division_Name+'</b></td>'+
                        '<td style="width: 25% !important;">'+value.Sub_Division_Name+'</td>'+
                        // '<td style="width: 10% !important;">'+value.No_SOP+'</td>'+
                        // '<td style="width: 10% !important;">'+value.Keterangan+'</td>'+
                        '<td style="width: 10% !important;">'+value.SOP_FILENAME+'</td>'+

                        '<td style="width: 10% !important;">'+value.WI_FILENAME+'</td>'+
                        '<td style="width: 10% !important;">'+value.FORMS_FILENAME+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var datadetailsop = '<tr style="width: 100% !important;">'+
                          '<td style="width: 35% !important; color:blue"><b>'+value.Sub_Division_Name+'</b></td>'+
                        '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.SOP_FILENAME+'</td>'+
                        '<td style="width: 10% !important;">'+value.WI_FILENAME+'</td>'+
                        '<td style="width: 10% !important;">'+value.FORMS_FILENAME+'</td>'+

                        '</tr>';    
                    }else{
                        var datadetailsop = '<tr style="width: 100% !important;">'+
                         '<td style="width: 35% !important;"><b>'+value.Sub_Division_Name+'</b></td>'+
                       '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.SOP_FILENAME+'</td>'+
                        '<td style="width: 10% !important;">'+value.WI_FILENAME+'</td>'+
                        '<td style="width: 10% !important;">'+value.FORMS_FILENAME+'</td>'+

                '</tr>';
                    }
                    
                    $('#tabledetailsop').append(datadetailsop);
                })


            },
            error: function(){

            }
        });

    }

    function generateSummaryPTKAK()
    {
        //window.open("https://ereport.ptp.co.id/listexportdata");
        $('#tabledetailsop td').remove();

        $months = $('#monthsTPKAK').val();
        $years = $('#yearsTPKAK').val();
        $cabang = $('#cabang').val();

         $text = 'Report Summary TPKAK '+' '+$months+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formdetailsop").show().html($text);
        $('#tabledetailsop').show();
        $('#exportdatatoexceldetailsop').show();
        
        /*$.ajax({

            url: "{{ url('/previewdetailsop') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang ,"months" : $months},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatadetailsop tr").detach();
                $.each(data, function (index,value) {
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var datadetailsop = '<tr style="width: 100% !important; border : 1px;">'+
                        '<td style="width: 25% !important; color:red"><b>'+value.Sub_Division_Name+'</b></td>'+
                        '<td style="width: 25% !important;">'+value.Sub_Division_Name+'</td>'+
                        // '<td style="width: 10% !important;">'+value.No_SOP+'</td>'+
                        // '<td style="width: 10% !important;">'+value.Keterangan+'</td>'+
                        '<td style="width: 10% !important;">'+value.SOP_FILENAME+'</td>'+

                        '<td style="width: 10% !important;">'+value.WI_FILENAME+'</td>'+
                        '<td style="width: 10% !important;">'+value.FORMS_FILENAME+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var datadetailsop = '<tr style="width: 100% !important;">'+
                          '<td style="width: 35% !important; color:blue"><b>'+value.Sub_Division_Name+'</b></td>'+
                        '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.SOP_FILENAME+'</td>'+
                        '<td style="width: 10% !important;">'+value.WI_FILENAME+'</td>'+
                        '<td style="width: 10% !important;">'+value.FORMS_FILENAME+'</td>'+

                        '</tr>';    
                    }else{
                        var datadetailsop = '<tr style="width: 100% !important;">'+
                         '<td style="width: 35% !important;"><b>'+value.Sub_Division_Name+'</b></td>'+
                       '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.SOP_FILENAME+'</td>'+
                        '<td style="width: 10% !important;">'+value.WI_FILENAME+'</td>'+
                        '<td style="width: 10% !important;">'+value.FORMS_FILENAME+'</td>'+

                '</tr>';
                    }
                    
                    $('#tabledetailsop').append(datadetailsop);
                })


            },
            error: function(){

            }
        });*/

    }

    function generateptkaktabel()
    {
        $months = $('#months').val();
        $years = $('#years').val();
        $cabang = $('#cabang').val();

         $text = 'Report Detail PTKAK '+' '+$months+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formdetailptkak").show().html($text);
        $('#tabledetailptkak').show();
        $('#exportdatatoexceldetailptkak').show();
        
        $.ajax({

            url: "{{ url('/previewdetailptkak') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang ,"months" : $months},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatadetailptkak tr").detach();
                $.each(data, function (index,value) {
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var datadetailptkak = '<tr style="width: 100% !important; border : 1px;">'+
                        '<td style="width: 50% !important; color:red"><b>'+value.Sub_Division_Name+'</b></td>'+
                        '<td style="width: 25% !important;">'+value.OPEN+'</td>'+
                        '<td style="width: 25% !important;">'+value.CLOSE+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var datadetailptkak = '<tr style="width: 100% !important;">'+
                          '<td style="width: 50% !important; color:blue"><b>'+value.Sub_Division_Name+'</b></td>'+
                        '<td style="width: 25% !important;">'+value.OPEN+'</td>'+
                        '<td style="width: 25% !important;">'+value.CLOSE+'</td>'+

                        '</tr>';    
                    }else{
                        var datadetailptkak = '<tr style="width: 100% !important;">'+
                         '<td style="width: 50% !important;"><b>'+value.Sub_Division_Name+'</b></td>'+
                       '<td style="width: 25% !important;">'+value.OPEN+'</td>'+
                        '<td style="width: 25% !important;">'+value.CLOSE+'</td>'+

                '</tr>';
                    }
                    
                    $('#tabledetailptkak').append(datadetailptkak);
                })


            },
            error: function(){

            }
        });

    }

     function generatedetailptkak()
    {
    	$('#tabledetailstatusptkak td').remove();

        $months = $('#monthsDetailTPKAK').val();
        $years = $('#yearsDetailTPKAK').val();
        $cabang = $('#cabang').val();

         $text = 'Report Detail STATUS PTKAK '+' '+$months+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formindicatorpusat").hide();
        $('#tableindicatorpusat').hide();
        $('#exportdatatoexcelindikatorpusat').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
        $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
        $("#formdetailstatusptkak").show().html($text);
        $('#tabledetailstatusptkak').show();
        $('#exportdatatoexceldetailstatusptkak').show();
        
        $.ajax({

            url: "{{ url('/previewdetailstatusptkak') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang ,"months" : $months},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatadetailstatusptkak tr").detach();
                $.each(data, function (index,value) {
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var datadetailstatusptkak = '<tr style="width: 100% !important; border : 1px;">'+
                        '<td style="width: 25% !important; color:red"><b>'+value.FROM+'</b></td>'+
                        '<td style="width: 25% !important;">'+value.TO+'</td>'+
                        '<td style="width: 15% !important;">'+value.NO_PTKAK+'</td>'+
                        '<td style="width: 10% !important;">'+value.DATE_PTKAK+'</td>'+
                        '<td style="width: 15% !important;">'+value.SUMBER+'</td>'+
                        '<td style="width: 10% !important;">'+value.STATUS+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var datadetailstatusptkak = '<tr style="width: 100% !important;">'+
                          '<td style="width: 25% !important; color:blue"><b>'+value.FROM+'</b></td>'+
                        '<td style="width: 25% !important;">'+value.TO+'</td>'+
                        '<td style="width: 15% !important;">'+value.NO_PTKAK+'</td>'+
                        '<td style="width: 10% !important;">'+value.DATE_PTKAK+'</td>'+
                        '<td style="width: 15% !important;">'+value.SUMBER+'</td>'+
                        '<td style="width: 10% !important;">'+value.STATUS+'</td>'+

                        '</tr>';    
                    }else{
                        var datadetailstatusptkak = '<tr style="width: 100% !important;">'+
                          '<td style="width: 25% !important;"><b>'+value.FROM+'</b></td>'+
                        '<td style="width: 25% !important;">'+value.TO+'</td>'+
                        '<td style="width: 15% !important;">'+value.NO_PTKAK+'</td>'+
                        '<td style="width: 10% !important;">'+value.DATE_PTKAK+'</td>'+
                        '<td style="width: 15% !important;">'+value.SUMBER+'</td>'+
                        '<td style="width: 10% !important;">'+value.STATUS+'</td>'+

                '</tr>';
                    }
                    
                    $('#tabledetailstatusptkak').append(datadetailstatusptkak);
                })


            },
            error: function(){

            }
        });

    }

    function generateUtiCabang()
    {
        
        $years = $('#yearsUtiCabang').val();
        $cabang = $('#DDLUticabang').val();

        $text = 'Report Utilisasi Cabang '+$cabang+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $('#formUtiCabang').show().html($text);
        $('#tableUtiCabang').show();
        $('#exportdatatoexcelUtiCabang').show();

        $('#exportdatatoexcelketepatanlaporan1').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();
        
        $.ajax({

            url: "{{ url('/previewdetailUtiCabang') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                if (data.length=='0')
                {
                    alert('No Data');
                }
                //$('#tableindicatorcabangpercabang').empty();
                $("#clearUtiCabang tr").detach();
                $.each(data, function (index,value) {
                    var dataUtiCabang = '<tr style="width: 100% !important;">'+
                        '<td style="width: 10% !important;">'+value.Uraian+'</td>'+
                        '<td style="width: 10% !important;">'+value.Satuan+'</td>'+
                        '<td style="width: 10% !important;">'+value.Realisasi_tahun+'</td>'+
                        '<td style="width: 10% !important;">'+value.RKAP+'</td>'+
                        '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                        '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                        '<td style="width: 5% !important;">'+value.APR+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                        '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                        '<td style="width: 5% !important;">'+value.SEP+'</td>'+
                        '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                        '<td style="width: 5% !important;">'+value.NOV+'</td>'+
                        '<td style="width: 5% !important;">'+value.DES+'</td>'+
                        '<td style="width: 5% !important;">'+value.Realisasi+'</td>'+
                        '<td style="width: 5% !important;">'+value.Deviasi+'</td>'+
                        '<td style="width: 5% !important;">'+value.Trend+'</td>'+
                    '</tr>';
                    
                    $('#tableUtiCabang').append(dataUtiCabang);
                })
                DivUtiCabang.hidden=false;

            },
            error: function(){

            }
        });

    }

    function generateKinerjaCabang()
    {
        
        $years = $('#yearsKinerjaCabang').val();
        $cabang = $('#DDLKinerjacabang').val();

        $text = 'Report Kinerja Cabang '+$cabang+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $('#formKinerjaCabang').show().html($text);
        $('#tableKinerjaCabang').show();
        $('#exportdatatoexcelKinerjaCabang').show();

        $('#exportdatatoexcelketepatanlaporan1').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();
        
        $.ajax({

            url: "{{ url('/previewdetailKinerjaCabang') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                if (data.length=='0')
                {
                    alert('No Data');
                }
                //$('#tableindicatorcabangpercabang').empty();
                $("#clearUtiCabang tr").detach();
                $.each(data, function (index,value) {
                    var dataUtiCabang = '<tr style="width: 100% !important;">'+
                        '<td style="width: 10% !important;">'+value.Uraian+'</td>'+
                        '<td style="width: 10% !important;">'+value.Satuan+'</td>'+
                        '<td style="width: 10% !important;">'+value.Realisasi_tahun+'</td>'+
                        '<td style="width: 10% !important;">'+value.RKAP+'</td>'+
                        '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                        '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                        '<td style="width: 5% !important;">'+value.APR+'</td>'+
                        '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                        '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                        '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                        '<td style="width: 5% !important;">'+value.SEP+'</td>'+
                        '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                        '<td style="width: 5% !important;">'+value.NOV+'</td>'+
                        '<td style="width: 5% !important;">'+value.DES+'</td>'+
                        '<td style="width: 5% !important;">'+value.Realisasi+'</td>'+
                        '<td style="width: 5% !important;">'+value.Deviasi+'</td>'+
                        '<td style="width: 5% !important;">'+value.Trend+'</td>'+
                    '</tr>';
                    
                    $('#tableKinerjaCabang').append(dataKinerjaCabang);
                })
                DivKinerjaCabang.hidden=false;

            },
            error: function(){

            }
        });

    }

     function generateKetepatanKonsolidasi()
    {
        //$months = $('#months').val();
        $years = $('#yearsindpusat').val();

        $text = 'Report Ketepatan Konsolidasi '+' '+$years;

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#formindicatorcabangpercabang").hide();
        $('#tableindicatorcabangpercabang').hide();
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $("#formindicatorcabang").hide();
        $('#tableindicatorcabang').hide();
        $('#exportdatatoexcelindikatorcabang').hide();
        $("#formtercapaipusat").hide();
        $('#tabletercapaipusat').hide();
        $('#exportdatatoexceltercapaipusat').hide();
        $("#formtidaktercapaipusat").hide();
        $('#tabletidaktercapaipusat').hide();
        $('#exportdatatoexceltidaktercapaipusat').hide();
        $("#formtercapaicabang").hide();
        $('#tabletercapaicabang').hide();
        $('#exportdatatoexceltercapaicabang').hide();
        $("#formtidaktercapaicabang").hide();
        $('#tabletidaktercapaicabang').hide();
        $('#exportdatatoexceltidaktercapaicabang').hide();
        $("#formketepatanlaporan").hide();
        $('#tableketepatanlaporan').hide();
        $('#exportdatatoexcelketepatanlaporan').hide();
        $("#formdetailkategorisd").hide();
        $('#tabledetailkategorisd').hide();
        $('#exportdatatoexceldetailkategorisd').hide();
        $("#formdetailkategori").hide();
        $('#tabledetailkategori').hide();
        $('#exportdatatoexceldetailkategori').hide();
        $("#formdetailsop").hide();
        $('#tabledetailsop').hide();
        $('#exportdatatoexceldetailsop').hide();
         $("#formdetailptkak").hide();
        $('#tabledetailptkak').hide();
        $('#exportdatatoexceldetailptkak').hide();
         $("#formdetailstatusptkak").hide();
        $('#tabledetailstatusptkak').hide();
        $('#exportdatatoexceldetailstatusptkak').hide();
        $("#formindicatorpusat").show().html($text);
        $('#tableindicatorpusat').show();
        $('#exportdatatoexcelindikatorpusat').show();
        $('#exportdatatoexcelketepatanlaporan1').hide();

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        $("#formtkp").hide();
        $('#tabletkp').hide();
        $('#exportdatatoexceltkp').hide();
        
        $.ajax({

            url: "{{ url('/previewketepatankonsolidasi') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatapusat tr").detach();
                $.each(data, function (index,value) {
                    var dataindikatorpusat = '<tr style="width: 100% !important;">'+
                        '<td style="width: 10% !important;">'+value.Sub_Division_Name+'</td>'+
                    '<td style="width: 10% !important;">'+value.Indicator_Name+'</td>'+
                    '<td style="width: 5% !important;">'+value.JAN+'</td>'+
                    '<td style="width: 5% !important;">'+value.FEB+'</td>'+
                    '<td style="width: 5% !important;">'+value.MAR+'</td>'+
                    '<td style="width: 5% !important;">'+value.APR+'</td>'+
                    '<td style="width: 5% !important;">'+value.MAY+'</td>'+
                    '<td style="width: 5% !important;">'+value.JUN+'</td>'+
                    '<td style="width: 5% !important;">'+value.JUL+'</td>'+
                    '<td style="width: 5% !important;">'+value.AUG+'</td>'+
                    '<td style="width: 5% !important;">'+value.SEP+'</td>'+
                    '<td style="width: 5% !important;">'+value.OCT+'</td>'+
                    '<td style="width: 5% !important;">'+value.NOV+'</td>'+
                    '<td style="width: 5% !important;">'+value.DES+'</td>'+
                    '<td style="width: 10% !important;">'+value.Target+'</td>'+
                    '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
                    '</tr>';
                    
                    $('#tableindicatorpusat').append(dataindikatorpusat);
                })


            },
            error: function(){

            }
        });

    }

    function generateexcelindikatorcabangpercabang()
    {
        var thn = $('#yearscabpercab').val();
        var cbg = $('#DDLcabpercab').val();

        var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexcelcabangpercabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangpercabang') }}" + "/" + gabung;  
            },900000000000)
    }
    function generateexcelindikatordivisiperdivisi()
    {
        var thn = $('#yearsdivperdiv').val();
        var div = $('#DDLdivperdiv').val();

        var gabung = thn + ',' + div;

            window.location="{{ url('/exportexceldivisiperdivisi') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexceldivisiperdivisi') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelkpicabang()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();

        var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexcelkpicabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelkpicabang') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelkpipusat()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();

        var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexcelkpipusat') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelkpipusat') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatorcabang()
    {
        var thn = $('#yearsindcabang').val();
        var mdl = 'Report Indicator Cabang';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorcabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorcabang') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatorpusat()
    {
        var thn = $('#yearsindpusat').val();
        var mdl = 'Report Indicator Pusat';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorpusat') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorpusat') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatortercapaipusat()
    {
        var thn = $('#yearsTercapaiPusat').val();
        //var cbg = $('#cabang').val();
        var mdl = 'Report Indicator Tercapai Pusat';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorpusattercapai') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorpusattercapai') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatortidaktercapaipusat()
    {
        var thn = $('#yearsTidakTercapaiPusat').val();
        var mdl = 'Report Indicator Tidak Tercapai Pusat';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorpusattidaktercapai') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorpusattidaktercapai') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatortercapaicabang()
    {
        var thn = $('#yearsTercapaiCabang').val();
        //var cbg = $('#cabang').val();
        var mdl = 'Report Tercapai Cabang';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatortercapaicabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatortercapaicabang') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatortidaktercapaicabang()
    {
        var thn = $('#yearsTidakTercapaiCabang').val();
        var cbg = $('#cabang').val();
        var mdl = 'Report Tidak Tercapai Cabang';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatortidaktercapaicabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatortidaktercapaicabang') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelStatSarmut()
    {
        var thn = $('#yearsStatSarmut').val();

        //var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexcelStatSarmut') }}" + "/" + thn; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelStatSarmut') }}" + "/" + thn;  
            },900000000000)
    }

    function generateexcelketepatanlaporan()
    {
        var thn = $('#yearsKetLaporan').val();

        //var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexcelketepatanlaporan') }}" + "/" + thn; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelketepatanlaporan') }}" + "/" + thn;  
            },900000000000)
    }

     function generateexceldetailkategorisd()
    {
        var bln = $('#monthsSampaiDengan').val();
        var thn = $('#yearsSampaiDengan').val();
        var cbg = $('#cabang').val();

        var gabung = bln + ',' + thn;

            window.location="{{ url('/exportexcelrealisasisasaranmutusampaidengan') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelrealisasisasaranmutusampaidengan') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexceldetailkategori()
    {
        var bln = $('#monthsBulan').val();
        var thn = $('#yearsBulan').val();
        var cbg = $('#cabang').val();

        var gabung = bln + ',' + thn;

            window.location="{{ url('/exportexcelrealisasisasaranmutu') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelrealisasisasaranmutu') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexceldetailsop()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();

        var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexceldetailsop') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexceldetailsop') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexceldetailptkak()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();

        var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexceldetailptkak') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexceldetailptkak') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexceldetailstatusptkak()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();

        var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexceldetailstatusptkak') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexceldetailstatusptkak') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelUtiCabang()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();

        var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexceldetailstatusptkak') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexceldetailstatusptkak') }}" + "/" + gabung;  
            },900000000000)
    }

     function generateexcelKinerjaCabang()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();

        var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexcelKinerjaCabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelKinerjaCabang') }}" + "/" + gabung;  
            },900000000000)
    }

    function showFilterKetepatanLaporan(a)
    {
        var e = document.getElementById(a).hidden=false;
    }

    $('#exportexcel').click(function pass_cek(e){
        e.preventDefault();
        var bln = $('#months1').val();
        var thn = $('#years1').val();
        var mdl = $('#modul1').val();
        // var bran = $('#branch').val();         
        //alert(mdl);

        if(mdl == 'Report Indikator Pusat')
        {
            var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorpusat') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorpusat') }}" + "/" + gabung;  
            },900000000000)   
        }
        else if(mdl == 'Report Indikator Cabang')
        {
            var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorcabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorcabang') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Indikator Tercapai Pusat')
        {
            var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorpusattercapai') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorpusattercapai') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Indikator Tidak Tercapai Pusat')
        {
            var gabung = thn + ',' + mdl;
            
            window.location="{{ url('/exportexcelindicatorpusattidaktercapai') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorpusattidaktercapai') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Realisasi Sasaran Mutu')
        {
            var gabung = bln + ',' + thn;
            
            window.location="{{ url('/exportexcelrealisasisasaranmutu') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelrealisasisasaranmutu') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Realisasi Sasaran Mutu Sampai Dengan')
        {
            var gabung = bln + ',' + thn;
            
            window.location="{{ url('/exportexcelrealisasisasaranmutusampaidengan') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelrealisasisasaranmutusampaidengan') }}" + "/" + gabung;  
            },900000000000)
        }
         else if(mdl == 'Report Ketepatan Laporan')
        {
            
            window.location="{{ url('/exportexcelketepatanlaporan') }}" + "/" + thn; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelketepatanlaporan') }}" + "/" + thn;  
            },900000000000)
        }

        if(mdl == 'Report Indikator KPI')
        {
            var thn = $('#years').val();
            var cbg = $('#cabang').val();

            var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexcelkpi') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelkpi') }}" + "/" + gabung;  
            },900000000000)
        }
        
    });

     $('#exportexcel').click(function pass_cek(e){
        e.preventDefault();
        var bln = $('#months1').val();
        var thn = $('#years1').val();
        var mdl = $('#cabangnya').val();
        // var bran = $('#branch').val();         
        //alert(mdl);

        if(mdl == 'Report Cabang Banten')
        {
            var gabung = thn ;

            window.location="{{ url('/exportexcelcabangbanten') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangbanten') }}" + "/" + gabung;  
            },900000000000)
        }
         else if(mdl == 'Report Cabang Jambi')
        {
            var gabung = thn ;

            window.location="{{ url('/exportexcelcabangjambi') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangjambi') }}" + "/" + gabung;  
            },900000000000)
        }
         else if(mdl == 'Report Cabang Tanjung Priok')
        {
            var gabung = thn ;

            window.location="{{ url('/exportexcelcabangtanjungpriok') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangtanjungpriok') }}" + "/" + gabung;  
            },900000000000)
        }
         else if(mdl == 'Report Cabang Bengkulu')
        {
            var gabung = thn ;

            window.location="{{ url('/exportexcelcabangbengkulu') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangbengkulu') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Cabang Panjang')
        {
            var gabung = thn ;

            window.location="{{ url('/exportexcelcabangpanjang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangpanjang') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Cabang Cirebon')
        {
            var gabung = thn ;

            window.location="{{ url('/exportexcelcabangcirebon') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangcirebon') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Cabang Palembang')
        {
            var gabung = thn ;

            window.location="{{ url('/exportexcelcabangpalembang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangpalembang') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Cabang Teluk Bayur')
        {
            var gabung = thn ;

            window.location="{{ url('/exportexcelcabangtelukbayur') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangtelukbayur') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Cabang Pangkal Balam')
        {
            var gabung = thn ;

            window.location="{{ url('/exportexcelcabangpangkalbalam') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangpangkalbalam') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Cabang Tanjung Pandan')
        {
            var gabung = thn ;

            window.location="{{ url('/exportexcelcabangtanjungpandan') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangtanjungpandan') }}" + "/" + gabung;  
            },900000000000)
        }
        
    });


     $('#preview').click(function pass_cek(e){
        e.preventDefault();
        var bln = $('#months1').val();
        var thn = $('#years1').val();
        var mdl = $('#cabangnya').val();
        // var bran = $('#branch').val();         
        //alert(mdl);
        var gabung = thn ;

        window.location="{{ url('/preview') }}" + "/" + gabung; 
        setTimeout(function(){
            window.location="{{ url('/preview') }}" + "/" + gabung;  
        },900000000000)
        
    });

    $(".select2-list").select2({
        allowClear: true
    }); 

    // function generate()
    // {
    //     $months = $('#months').val();
    //     $years = $('#years').val();
    //     $modul = $('#modul').val();
    //     $text1 = 'INDICATOR SASARAN MUTU PER'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
    //     $text2 = 'INDICATOR SASARAN MUTU SAMPAI DENGAN'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
    //     $text3 = 'ALASAN SASARAN MUTU TIDAK TERCAPAI'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
    //     $text4 = 'ALASAN SASARAN MUTU TIDAK TERCAPAI SAMPAI DENGAN'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
    //     $text5 = 'JUMLAH SOP, WI, DAN FORMS'+' '+$years+' '+'(KONSOLIDASI PTP)';
    //     $text6 = 'STATUS PTKAK SAMPAI DENGAN'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';

    //     $("#garis").show();
    //     $("#generateexcel").show();
    //     $("#cabangnyaitu").hide();
        
    //     if($modul == 'Sasaran Mutu Tercapai')
    //     {
    //              $('#group1').show();
    //              $('#group2').hide();
    //              $('#group3').hide();
    //              $('#group4').hide();
    //              $("#form1").show().html($text1);
    //              $("#form2").show().html($text2);
    //             $.ajax({

    //                 url: "{{ url('/getgenerate') }}",
    //                 data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
    //                 type: "POST",
    //                 dataType: "json",
    //                 success: function(data){
    //                     console.log(data);

    //                     var chart = AmCharts.makeChart("m_amcharts_12", {
    //                       "type": "pie",
    //                       "theme": "light",
    //                       "outlineColor": "",
    //                       "dataProvider": data,
    //                       "valueField": "JUMLAH",
    //                       "titleField": "KETERANGAN",
    //                       "balloon": {
    //                         "fixedPosition": true
    //                     }
    //                 });


    //                 },
    //                 error: function(){

    //                 }
    //             });

    //             $.ajax({

    //                 url: "{{ url('/getgenerateall') }}",
    //                 data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
    //                 type: "POST",
    //                 dataType: "json",
    //                 success: function(data){
    //                     console.log(data);
    //                     var chart = AmCharts.makeChart("m_amcharts_13", {
    //                       "type": "pie",
    //                       "theme": "light",
    //                       "outlineColor": "",
    //                       "dataProvider": data,
    //                       "valueField": "JUMLAH",
    //                       "titleField": "KETERANGAN",
    //                       "balloon": {
    //                         "fixedPosition": true
    //                     }
    //                 });


    //                 },
    //                 error: function(){

    //                 }
    //             });
    //         }
    //     else if($modul == 'Alasan Tidak Tercapai'){

    //            $('#group1').hide();
    //            $('#group2').show();
    //            $('#group3').hide();
    //            $('#group4').hide();
    //            // $("#generateexcel").show();
    //            $("#form3").show().html($text3);
    //            $("#form4").show().html($text4);

    //             $.ajax({
    //             url: "{{ url('/getgeneratebarchart') }}",
    //             data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
    //             type: "POST",
    //             dataType: "json",
    //             success: function(data){
    //                 console.log(data);
    //                 var chart = AmCharts.makeChart("m_amcharts_4", {
    //                     "theme": "light",
    //                     "type": "serial",
    //                     "dataProvider": data,
    //                     "valueAxes": [{
    //                         "stackType": "3d",
    //                         "unit": "",
    //                         "position": "left",
    //                         "title": "",
    //                     }],
    //                     "startDuration": 1,
    //                     "graphs": [{
    //                         "balloonText": "[[category]] : <b>[[value]]</b>",
    //                         "fillAlphas": 1.0,
    //                         "lineAlpha": 0.2,
    //                         "title": "",
    //                         "type": "column",
    //                         "valueField": "JUMLAH"
    //                     }],
    //                     "plotAreaFillAlphas": 0.1,
    //                     "depth3D": 100,
    //                     "angle": 50,
    //                     "categoryField": "ALASAN",
    //                     "categoryAxis": {
    //                         "gridPosition": "start"
    //                     },
    //                     "export": {
    //                         "enabled": true
    //                     }

    //                 });

    //             },
    //             error: function(){

    //             }
    //         });

    //         $.ajax({
    //             url: "{{ url('/getgeneratebarchartall') }}",
    //             data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
    //             type: "POST",
    //             dataType: "json",
    //             success: function(data){
    //                 console.log(data);
    //                 var chart = AmCharts.makeChart("m_amcharts_5", {
    //                     "theme": "light",
    //                     "type": "serial",
    //                     "dataProvider": data,
    //                     "valueAxes": [{
    //                         "stackType": "3d",
    //                         "unit": "",
    //                         "position": "left",
    //                         "title": "",
    //                     }],
    //                     "startDuration": 1,
    //                     "graphs": [{
    //                         "balloonText": "[[category]] : <b>[[value]]</b>",
    //                         "fillAlphas": 1.0,
    //                         "lineAlpha": 0.2,
    //                         "title": "",
    //                         "type": "column",
    //                         "valueField": "JUMLAH"
    //                     }],
    //                     "plotAreaFillAlphas": 0.1,
    //                     "depth3D": 100,
    //                     "angle": 50,
    //                     "categoryField": "ALASAN",
    //                     "categoryAxis": {
    //                         "gridPosition": "start"
    //                     },
    //                     "export": {
    //                         "enabled": true
    //                     }

    //                 });

    //             },
    //             error: function(){

    //             }
    //         });
    //     }
    //     else if($modul == 'SOP'){
               
    //             $('#group1').hide();
    //             $('#group2').hide();
    //             $('#group3').show();
    //             $('#group4').hide();
    //             // $("#generateexcel").show();
    //             $("#form5").show().html($text5);

    //            $.ajax({
    //             url: "{{ url('/getgeneratesop') }}",
    //             data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
    //             type: "POST",
    //             dataType: "json",
    //             success: function(data){
    //                 console.log(data);
    //                 var chart = AmCharts.makeChart("m_amcharts_14", {
    //                     "type": "pie",
    //                     "theme": "light",
    //                     "outlineColor": "",
    //                     "dataProvider": data,
    //                     "valueField": "JUMLAH",
    //                     "titleField": "TYPE",
    //                     "balloon": {
    //                         "fixedPosition": true
    //                     }
    //                 });
    //             },
    //             error: function(){

    //             }
    //         });
    //     }
    //     else if($modul == 'PTKAK'){

    //         $('#group1').hide();
    //         $('#group2').hide();
    //         $('#group3').hide();
    //         $('#group4').show();
    //         // $("#generateexcel").show();
    //         $("#form6").show().html($text6);

    //           $.ajax({

    //             url: "{{ url('/getgenerateptkak') }}",
    //             data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
    //             type: "POST",
    //             dataType: "json",
    //             success: function(data){
    //                 console.log(data);
    //                 var chart = AmCharts.makeChart("m_amcharts_15", {
    //                     "type": "pie",
    //                     "theme": "light",
    //                     "outlineColor": "",
    //                     "dataProvider": data, 
    //                     "valueField": "JUMLAH",
    //                     "titleField": "STATUS",
    //                     "balloon": {
    //                         "fixedPosition": true
    //                     }
    //                 });


    //             },
    //             error: function(){

    //             }
    //         });
            
    //     }
        
    // }

    
</script>  