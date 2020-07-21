<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PT. Pelabuhan Tanjung Priok</title>

<link href="templateslide/assets/css/style.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/css/imagehover/imagehover.min.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/uikit/css/uikit.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/datepicker/daterangepicker.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/datepicker/daterangepicker.css" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('EliteAdmin/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic2/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic2/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />


<script src="templateslide/assets/js/jquery-1.11.1.min.js"></script>
<script src="templateslide/assets/uikit/js/uikit.js"></script>

<script src="templateslide/assets/datepicker/moment.min.js"></script>
<script src="templateslide/assets/datepicker/daterangepicker.js"></script>

<script src="templateslide/assets/js/marquee/jquery.marquee.js"></script>
<script src="templateslide/assets/js/marquee/jquery.pause.js"></script>
<script src="templateslide/assets/js/marquee/jquery.easing.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<link  href="{{ URL::asset('templateslide/assets/js/datatableptkak/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('templateslide/assets/js/datatableptkak/jquery.dataTables.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

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
    #formindicatorcabangpercabang{
        display: none;
    }
    #tableindicatorcabangpercabang{
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

    #formkpi{

        display: none;
    }       
    #tablekpi{

        display: none;
    }   
    #exportdatatoexcelkpi{

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
    .ReportLabel
    {
        height:20px;
        width:100%;
        font-size: medium;
        margin-top:.5rem;
        margin-bottom: .5rem;
        font-weight:500;
    }
    .ReportButton
    {
        width:99%;
        height:80px;
        margin-left:0.5%;
        margin-right:0.5%;
        margin-top:1%;
        margin-bottom:1%;
        padding:0;
        color:white;
        font-size:medium;
        font-weight:500;
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


<body>

    <div class="fl-main-container">
        <!---Header----------->
        <div class="fl-header fl-header-margin" uk-sticky>
            <div>
                <img src="templateslide/assets/img/logo/ptpwhite.png" class="fl-logo" onclick="location.href = '{{ url('dashboard')}}'">
                
                <span class="fl-title-logo">
                    E-Report PT. Pelabuhan Tanjung Priok 
                </span>

                <span class="fl-menu-tool">
                    <img src="{{ URL::asset('templateslide/assets/img/logo/Logo e-Report.png') }}" class="fl-logo">
                    <input type="button" class="uk-button uk-button-primary fl-button" target="_blank" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
                </span>
            </div>  
        </div>


        <div class="fl-container">
            <div class="fl-title-page">
                <!-- <span style="font-size:20px">               
                    <img class="uk-preserve-width uk-border-circle" src="templateslide/assets/img/icon/sopReadMore.png" width="65" alt="">
                    Generate Data   
                </span> -->
                <!-- <span class="fl-menu-tool" style="padding-top: 15px;">
                    <a href="/form_list_export_data_excel"><button class="uk-button uk-button-success fl-button" type="button">Export Data Excel</button></a>
                </span> -->
            <div class="fl-table col-md-12" style="overflow: auto;margin:0%"" >
                <div id="generatechart">
                    <form action="#" method="post" name="form_name" id="form_id" class="form_class" >
                    {{ csrf_field() }}
                    <!-- <div style="margin-bottom:30px; text-align:center;">
                        <span style="font-size:18px">Pilih Bulan , Tahun dan Modul</span>
                    </div> -->
                    <div class="col-lg-12" style="text-align: center;" hidden>
                        <b style="width: 30% !important;">Bulan</b>
                        &nbsp;
                        &nbsp;
                        <select class="form-control select2-list" id="months" name="months" style="width: 20% !important;">
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
                        <select id="years" class="form-control select2-list" name="years" style="width: 20% !important;">
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
                        @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||Auth::user()->ACCESS == 'REPORT_ONLY')
                        <b style="width: 30% !important;">Cabang</b>
                          &nbsp;
                          &nbsp;
                        <select id="cabang" class="form-control select2-list" name="cabang" style="width: 20% !important;">
                            <option value="">--Pilih Cabang--</option>
                            @foreach($branch_list as $branch)
                            <option value="{{ $branch->BRANCH_OFFICE_NAME }}">{{ $branch->BRANCH_OFFICE_NAME }}</option>
                            @endforeach
                        </select>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                        @endif
                       
                        @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||Auth::user()->ACCESS == 'REPORT_ONLY')
                        <!-- <b style="width: 20% !important;">Triwulan</b> -->
                            &nbsp;
                            &nbsp;
                            <br>
                            <br>
                            <b>Triwulan</b>
                                <input type="hidden" name="triwulan" id="triwulan" disabled="disabled"><br>
                                <select class="form-control select2-list" style="width: 30% !important;" id="triwulanselect" name="triwulan" required="required">
                                    <option value="">--Pilih Triwulan--</option>
                                    <!-- @foreach($months as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach -->
                                    <option value="TRIWULAN_1">TRIWULAN_1</option>
                                    <option value="TRIWULAN_2">TRIWULAN_2</option>
                                    <option value="TRIWULAN_3">TRIWULAN_3</option>
                                    <option value="TRIWULAN_4">TRIWULAN_4</option>
                                </select>
                        &nbsp;
                        &nbsp;
                        
                        @endif


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
                    <table style="width:100%;height:auto">
                        <tbody style="overflow:hidden;height:auto">
                            <tr>
                                <td style="text-align:center;width:20%;">
                                    <label style="font-size:x-large">Sasaran Mutu</label>
                                </td>
                                <td style="text-align:center;width:20%;">
                                    <label style="font-size:x-large">Key Performance Indicator</label>
                                </td>
                                <td style="text-align:center;width:20%">
                                    <label style="font-size:x-large">Tingkat Kesehatan Perusahaaan</label>
                                </td>
                                <td style="text-align:center;width:20%">
                                    <label style="font-size:x-large">Standart Operasional Procedure</label>
                                </td>
                                <td style="text-align:center;width:20%">
                                    <label style="font-size:x-large">PTKAK</label>
                                </td>
                                <td style="text-align:center;width:20%">
                                    <label style="font-size:x-large">Utilisasi Cabang</label>
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                    <button type="button" onclick="generatesasaranmututercapai()" class="uk-button uk-button-success ReportButton" style="width:48%;background-color: #2778ec !important">Grafik Indikator</button>
                                    <button type="button" onclick="generatealasantidaktercapai()" class="uk-button uk-button-success ReportButton" style="width:48%;background-color: #2778ec !important">Grafik Alasan</button>
                                </td> 
                                <td style="text-align:center" rowspan="2">
                                    <button type="button" onclick="generatekpipusat()" class="uk-button uk-button-success ReportButton" style="background-color: #0277c9 !important;height:166px;">Report KPI Pusat</button>
                                </td>
                                <td style="text-align:center" rowspan="6">
                                    @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||Auth::user()->ACCESS == 'REPORT_ONLY')
                                        <button type="button" onclick="generatetkp()" class="uk-button uk-button-success ReportButton" style="background-color: #291f78 !important;height:510px">Report Summary</button>
                                    @else
                                        <button type="button" onclick="generatetkp()" class="uk-button uk-button-success ReportButton" style="background-color: #291f78 !important;height:422px">Report Summary</button>
                                    @endif
                                </td>
                                <td style="text-align:center" rowspan="3">
                                    <button type="button" onclick="generatesop()" class="uk-button uk-button-success ReportButton" style="background-color: #f56f26 !important;height:251px;">Grafik SOP</button>
                                </td>
                                <td style="text-align:center" rowspan="2">
                                    <button type="button" onclick="generateptkak()" class="uk-button uk-button-success ReportButton" style="background-color: #fcb01c !important;height:166px;">Grafik PTKAK</button>            
                                </td>
                                <td style="text-align:center" rowspan="2">
                                    <button type="button" onclick="generateuticabang()" class="uk-button uk-button-success ReportButton" style="background-color: #FF0000 !important;height:166px;">Utilisasi Cabang</button>            
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                    @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||Auth::user()->ACCESS == 'REPORT_ONLY')
                                        <label class="ReportLabel">Indicator Sasaran Mutu</label>
                                        <br/>
                                        <button type="button" onclick="generateindikatorpusat()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: #2778ec !important"">Pusat</button>
                                        <button type="button" onclick="generateindikatorcabang()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: #2778ec !important"">Cabang</button>
                                    @else
                                        <button type="button" onclick="generateindikatorsubdiv()" class="uk-button uk-button-success ReportButton" style="background-color: #2778ec !important"">Indicator Sasaran Mutu</button>
                                    @endif            
                                </td>
                                <!-- <td style="text-align:center">
                                    <label style="height:20px;width:100%;font-size: medium;margin-top:.5rem;margin-bottom: .5rem;">Report KPI</label>
                                    <br/>
                                    <button type="button" onclick="generatekpi()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: khaki">Pusat</button>
                                    <button type="button" onclick="generatekpi()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: khaki">Cabang</button>
                                </td> -->
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                    @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||Auth::user()->ACCESS == 'REPORT_ONLY')
                                        <label class="ReportLabel">Indicator Tercapai</label>
                                        <br/>
                                        <button type="button" onclick="generateindikatortercapaipusat()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: #2778ec !important"">Pusat</button>
                                        <button type="button" onclick="generateindikatortercapaicabang()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: #2778ec !important"">Cabang</button>
                                    @else
                                        <button type="button" onclick="generateindikatortercapaisubdiv()" class="uk-button uk-button-success ReportButton" style="background-color: #2778ec !important"">Report Indikator Tercapai</button>
                                    @endif            
                                </td>
                                <td style="text-align:center" rowspan="2">
                                    <button type="button" onclick="generatekpicabang()" class="uk-button uk-button-success ReportButton" style="background-color: #0277c9 !important;height:166px">Report KPI Cabang</button>
                                </td>
                                <td style="text-align:center" rowspan="2">
                                    <button type="button" onclick="generateptkaktabel()" class="uk-button uk-button-success ReportButton" style="background-color: #fcb01c !important;height:166px">Report Summary PTKAK</button>
                                </td>
                                 <td style="text-align:center" rowspan="2">
                                    <button type="button" onclick="generateKinerjacabang()" class="uk-button uk-button-success ReportButton" style="background-color: #FF0000 !important;height:166px;">Kinerja Cabang</button>            
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                    @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||Auth::user()->ACCESS == 'REPORT_ONLY')
                                        <label class="ReportLabel">Indicator Tidak Tercapai</label>
                                        <br/>
                                        <button type="button" onclick="generateindikatortidaktercapaipusat()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: #2778ec !important"">Pusat</button>
                                        <button type="button" onclick="generateindikatortidaktercapaicabang()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: #2778ec !important"">Cabang</button>
                                    @else
                                        <button type="button" onclick="generateindikatortidaktercapaisubdiv()" class="uk-button uk-button-success ReportButton" style="background-color: #2778ec !important"">Report Indikator Tidak Tercapai</button>
                                    @endif
                                </td>
                                <td style="text-align:center" rowspan="4">
                                    @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||Auth::user()->ACCESS == 'REPORT_ONLY')
                                        <button type="button" onclick="generatesoptabel()" class="uk-button uk-button-success ReportButton" style="background-color: #f56f26 !important;height:334px;">Report SOP</button>
                                    @else
                                        <button type="button" onclick="generatesoptabel()" class="uk-button uk-button-success ReportButton" style="background-color: #f56f26 !important;height:251px;">Report SOP</button>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                    @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||Auth::user()->ACCESS == 'REPORT_ONLY')
                                        <label class="ReportLabel">Indicator Sasaran Mutu Per</label>
                                        <br/>
                                        <button type="button" onclick="generateindikatorcabangpercabang()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: #2778ec !important"">Cabang</button>
                                        <button type="button" onclick="generateindikatorcabangperdivisi()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: #2778ec !important"">Divisi</button>
                                    @endif
                                </td>
                                <td style="text-align:center" rowspan="3">
                                    @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||Auth::user()->ACCESS == 'REPORT_ONLY')
                                        <button type="button" onclick="generateindikatorkonsolidasi()"  class="uk-button uk-button-success ReportButton" style="background-color: #0277c9 !important;height:250px">Report Indicator Konsolidasi</button>
                                    @else
                                        <button type="button" onclick="generateindikatorkonsolidasi()"  class="uk-button uk-button-success ReportButton" style="background-color: #0277c9 !important;height:164px">Report Indicator Konsolidasi</button>
                                    @endif
                                </td>
                                <td style="text-align:center" rowspan="3">
                                    @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'||Auth::user()->ACCESS == 'REPORT_ONLY')
                                        <button type="button" onclick="generatedetailptkak()" class="uk-button uk-button-success ReportButton" style="background-color: #fcb01c !important;height:250px"">Report Detail PTKAK</button>
                                    @else
                                        <button type="button" onclick="generatedetailptkak()" class="uk-button uk-button-success ReportButton" style="background-color: #fcb01c !important;height:164px"">Report Detail PTKAK</button>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                    <label class="ReportLabel">Report Kategori Indicator</label>
                                    <br/>
                                    <button type="button" onclick="generaterealisasisasaranmutu()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: #2778ec !important"">Bulan</button>
                                    <button type="button" onclick="generaterealisasisasaranmutusd()" class="uk-button uk-button-success ReportButton" style="width:48%;height:45px;background-color: #2778ec !important"">S/D</button>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                    <button type="button" onclick="generateketepatanlaporan()" class="uk-button uk-button-success ReportButton" style="width:48%;height:78px;background-color: #2778ec !important">Ketepatan Laporan</button>
                                    <button type="button" onclick="generatestatsarmut()" class="uk-button uk-button-success ReportButton" style="width:48%;height:78px;background-color: #2778ec !important">Status Sarmut</button>
                                </td>
                                <td style="text-align:center">
                                    <label class="ReportLabel">Detail Report TKP</label>
                                    <br/>
                                    <button type="button" onclick="generatedetailtkpA1()" class="uk-button uk-button-success ReportButton" style="width:31%;height:45px;background-color: #291f78 !important">A1</button>
                                    <button type="button" onclick="generatedetailtkpA2()" class="uk-button uk-button-success ReportButton" style="width:31%;height:45px;background-color: #291f78 !important">A2</button>
                                    <button type="button" onclick="generatedetailtkpA3()" class="uk-button uk-button-success ReportButton" style="width:31%;height:45px;background-color: #291f78 !important">A3</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>  
    </div>

</body>
</html>
<script>

    function generatedetailtkpA1()
    {
        window.open("{{ url('/listexportdata/DetailTKPA1') }}");
    }

    function generatedetailtkpA2()
    {
        window.open("{{ url('/listexportdata/DetailTKPA2') }}");
    }

    function generatedetailtkpA3()
    {
        window.open("{{ url('/listexportdata/DetailTKPA3') }}");
    }

    function generatesasaranmututercapai()
    {
        window.open("{{ url('/listexportdata/GrafikIndikator') }}");
    }

    function generateindikatorkonsolidasi()
    {
        window.open("{{ url('/listexportdata/Konsolidasi') }}");
    }

    function generatealasantidaktercapai()
    {
        window.open("{{ url('/listexportdata/GrafikAlasan') }}");
    }

    function generatesop() 
    {
        window.open("{{ url('/listexportdata/GrafikSOP') }}");
    }

    function generateptkak()
    {
        window.open("{{ url('/listexportdata/GrafikPTKAK') }}");
    }

    function generateindikatorcabangpercabang()
    {
        window.open("{{ url('/listexportdata/IndicatorSasaranMutuPerCabang') }}");
    }

    function generateindikatorcabangperdivisi()
    {
        window.open("{{ url('/listexportdata/IndicatorSasaranMutuPerDivisi') }}");
    }

    function generatekpipusat()
    {
        window.open("{{ url('/listexportdata/ReportKPIPusat') }}");
    }

    function generatekpicabang()
    {
        window.open("{{ url('/listexportdata/ReportKPICabang') }}");
    }

    function generatetkp()
    {
        window.open("{{ url('/listexportdata/ReportSummaryTKP') }}");
    }

    function generateindikatorcabang()
    {
        window.open("{{ url('/listexportdata/IndicatorSasaranMutuCabang') }}");
    }

    function generateindikatorsubdiv()
    {
        window.open("{{ url('/listexportdata/IndicatorSasaranMutuSubDiv') }}");
    }

    function generateindikatorpusat()
    {
        window.open("{{ url('/listexportdata/IndicatorSasaranMutuPusat') }}");
    }

    function generateindikatortercapaipusat()
    {
        window.open("{{ url('/listexportdata/IndicatorTercapaiPusat') }}");
    }

    function generateindikatortidaktercapaipusat()
    {
        window.open("{{ url('/listexportdata/IndicatorTidakTercapaiPusat') }}");
    }

    function generateindikatortidaktercapaisubdiv()
    {
        window.open("{{ url('/listexportdata/IndicatorTidakTercapaiSubDiv') }}");
    }

    function generateindikatortercapaisubdiv()
    {
        window.open("{{ url('/listexportdata/IndicatorTercapaiSubDiv') }}");
    }

    function generateindikatortercapaicabang()
    {
        window.open("{{ url('/listexportdata/IndicatorTercapaiCabang') }}");
    }

     function generateindikatortidaktercapaicabang()
    {
        window.open("{{ url('/listexportdata/IndicatorTidakTercapaiCabang') }}");
    }

    function generateketepatanlaporan()
    {
        window.open("{{ url('/listexportdata/KetepatanLaporan') }}");
    }

    function generatestatsarmut()
    {
        window.open("{{ url('/listexportdata/StatusSarmut') }}");
    }

    function generaterealisasisasaranmutusd()
    {
        window.open("{{ url('/listexportdata/ReportKategoriIndicatorSampaiDengan') }}");
    }

    function generaterealisasisasaranmutu()
    {
        window.open("{{ url('/listexportdata/ReportKategoriIndicatorBulan') }}");
    }

     function generatesoptabel()
    {
        window.open("{{ url('/listexportdata/ReportSOP') }}");
    }

    function generateptkaktabel()
    {
        window.open("{{ url('/listexportdata/ReportSummaryPTKAK') }}");
    }

     function generatedetailptkak()
    {
        window.open("{{ url('/listexportdata/ReportDetailPTKAK') }}");
    }
     function generateuticabang()
    {
        window.open("{{ url('/listexportdata/ReportUtiCabang') }}");
    }
    function generateKinerjacabang()
    {
        window.open("{{ url('/listexportdata/ReportKinerjaCabang') }}");
    }
</script>  