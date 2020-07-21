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

    #formkpi{
        display: none;
    }
    #tablekpi{
        display: none;
    }
    #exportdatatoexcelkpi{
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
                    <input type="button" class="uk-button uk-button-primary fl-button" value="menu" onclick="location.href = '{{ url('dashboard')}}'">
                </span>
            </div>  
        </div>


        <div class="fl-container">
            <div class="fl-title-page" >
                <!-- <span style="font-size:20px">               
                    <img class="uk-preserve-width uk-border-circle" src="templateslide/assets/img/icon/sopReadMore.png" width="65" alt="">
                    Generate Data   
                </span> -->
                <!-- <span class="fl-menu-tool" style="padding-top: 15px;">
                    <a href="/form_list_export_data_excel"><button class="uk-button uk-button-success fl-button" type="button">Export Data Excel</button></a>
                </span> -->
            <div class="fl-table col-md-12" style="overflow: auto;">
                <div id="generatechart">
                    <form action="#" method="post" name="form_name" id="form_id" class="form_class" >
                    {{ csrf_field() }}
                    <!-- <div style="margin-bottom:30px; text-align:center;">
                        <span style="font-size:18px">Pilih Bulan , Tahun dan Modul</span>
                    </div> -->
                    <div class="col-lg-12" style="text-align: center;">
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
                        @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
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
                    <br>
                    <div class="col-lg-12" style="text-align: center;">
                        <button type="button" onclick="generatesasaranmututercapai()" class="uk-button uk-button-primary">Kategori Indikator</button>
                        <button type="button" onclick="generatealasantidaktercapai()" class="uk-button uk-button-primary">Alasan Tidak Tercapai</button>
                        <button type="button" onclick="generatesop()" class="uk-button uk-button-primary">SOP</button>
                        <button type="button" onclick="generateptkak()" class="uk-button uk-button-primary">PTKAK</button>
                        <button type="button" onclick="generatekpi()" class="uk-button uk-button-primary">KPI</button>
                        <button type="button" onclick="generateptpk()" class="uk-button uk-button-primary">TPK</button>
                    </div>
                    <br> 
                    <div class="col-lg-12" style="text-align: center;"> 
                        <button type="button" onclick="generateketepatanlaporan()" class="uk-button uk-button-success">Ketepatan Laporan</button>
                        <button type="button" onclick="generateindikatorkonsolidasi()" class="uk-button uk-button-success">Indikator Konsolidasi</button>
                        @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
                        <button type="button" onclick="generateindikatorpusat()" class="uk-button uk-button-success">Indikator Sarmut Pusat</button>
                        @else
                        <button type="button" onclick="generateindikatorpusat()" class="uk-button uk-button-success">Indikator Sasaran Mutu</button>
                        @endif
                        @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
                        <button type="button" onclick="generateindikatortidaktercapaipusat()" class="uk-button uk-button-success">Tidak Tercapai Pusat</button>
                        @else
                        <button type="button" onclick="generateindikatortidaktercapaipusat()" class="uk-button uk-button-success"> Indikator Tidak Tercapai</button>
                        @endif
                        @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
                        <button type="button" onclick="generateindikatortercapaipusat()" class="uk-button uk-button-success">Tercapai Pusat</button>
                        @else
                        <button type="button" onclick="generateindikatortercapaipusat()" class="uk-button uk-button-success">Indikator Tercapai</button>
                        @endif
                    </div>
                    <br>
                    <div class="col-lg-12" style="text-align: center;">
                        @if( Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
                        <button type="button" onclick="generateindikatorcabang()" class="uk-button uk-button-success">Indikator Sarmut Cabang</button>
                        <button type="button" onclick="generateindikatorcabangpercabang()" class="uk-button uk-button-success">Indikator Sarmut Per Cabang</button>
                        <button type="button" onclick="generateindikatortidaktercapaicabang()" class="uk-button uk-button-success">Tidak Tercapai Cabang</button>
                        <button type="button" onclick="generateindikatortercapaicabang()" class="uk-button uk-button-success">Tercapai Cabang</button>
                        @endif
                    </div> 
                    <br>
                    <div class="col-lg-12" style="text-align: center;"> 
                        <button type="button" onclick="generaterealisasisasaranmutu()" class="uk-button uk-button-success">Detail Kategori Indikator</button>
                        <button type="button" onclick="generaterealisasisasaranmutusd()" class="uk-button uk-button-success">Detail Kategori Indikator SD</button>
                        <button type="button" onclick="generatesoptabel()" class="uk-button uk-button-success">Detail SOP</button>
                        <button type="button" onclick="generateptkaktabel()" class="uk-button uk-button-success">Detail PTKAK</button>
                        <button type="button" onclick="generatedetailptkak()" class="uk-button uk-button-success">Detail Status PTKAK</button>
                    </div>
                    <br>
                    </form>
                </div>
                <br>
                <br>
                <div class="form-group m-form__group row" id="group1">
                    <div class="col-lg-5" id="form1" style="text-align: center !important; font-size: 20px !important;">
                    </div>
                    <div class="col-lg-7" id="form2" style="text-align: center !important; font-size: 20px !important;">
                    </div>
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
                    <div class="col-lg-6" id="m_amcharts_14" style="height: 350px !important;  font-size: 20px !important;"></div>
                    <br>
                </div>
                <div class="form-group m-form__group row" id="group4">
                     <div class="col-lg-12" id="form6" style="text-align: center !important;  font-size: 20px !important;">
                    </div>
                    <div class="col-lg-6" id="m_amcharts_15" style="height: 350px !important;  font-size: 20px !important;"></div>
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

                        <!-- <div class="col-lg-12">
                            <div class="col-lg-12" id="formindicatorcabangpercabang" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formindicatorcabangpercabang">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelindikatorcabangpercabang">
                            <button type="button" onclick="generateexcelindikatorcabangpercabang()" class="uk-button uk-button-primary">Export Excel</button>
                         </div>
                        <table id="tableindicatorcabangpercabang" class="uk-table uk-table-hover" style="margin-top: 5px;"> -->
                               <!-- <thead> -->
                               <!--  <tr style="width: 100% !important;" class="fl-table-head" >
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
                                </tr>                   -->
                            <!-- </thead> -->
                                <!-- <div id="cleardatacabangpercabang">
                                </div>  
                        </table>
                        </div> -->

                        <div class="col-lg-12">
                            <div class="col-lg-12" id="formkpi" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="formkpi">
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelkpi">
                            <button type="button" onclick="generateexcelkpi()" class="uk-button uk-button-primary">Export Excel</button>
                         </div>
                        <table id="formkpi" class="uk-table uk-table-hover" style="margin-top: 5px;">
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
                                <div id="cleardatakpi">
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
                       <table id="tableindicatorcabang"class="uk-table uk-table-hover" style="margin-top: 5px;">
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
                        <table id="tabletercapaicabang"class="uk-table uk-table-hover" style="margin-top: 5px;">
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
                            <div class="col-lg-12" id="formketepatanlaporan" style="text-align: center !important;  font-size: 20px !important;">
                            </div>
                            <br id="exportdatatoexcelketepatanlaporan" > 
                             <div class="col-lg-12" style="text-align: center;" id="exportdatatoexcelketepatanlaporan1">
                            <button type="button" onclick="generateexcelketepatanlaporan()" class="uk-button uk-button-primary">Export Excel</button>
                        </div>
                        <table id="tableketepatanlaporan"class="uk-table uk-table-hover" style="margin-top: 5px;">
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

</script> -->
<script>

    function generatesasaranmututercapai()
    {
        $months = $('#months').val();
        $years = $('#years').val();
        $modul = 'Kategori Indikator';

        $text1 = 'INDICATOR SASARAN MUTU PER'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
        $text2 = 'INDICATOR SASARAN MUTU SAMPAI DENGAN'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';

        $('#group1').show();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').hide();
        $("#form1").show().html($text1);
        $("#form2").show().html($text2);
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $('#formindicatorcabangpercabang').hide();
        $('#tableindicatorcabangpercabang').hide();
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
        $('#exportdatatoexcelketepatanlaporan1').hide();
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

        $.ajax({

            url: "{{ url('/getgenerate') }}",
            data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
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
            data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
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
        $months = $('#months').val();
        $years = $('#years').val();
        $modul = 'Alasan Tidak Tercapai';

        $text3 = 'ALASAN SASARAN MUTU TIDAK TERCAPAI'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
        $text4 = 'ALASAN SASARAN MUTU TIDAK TERCAPAI SAMPAI DENGAN'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';

        $('#group1').hide();
        $('#group2').show();
        $('#group3').hide();
        $('#group4').hide();
        $("#form3").show().html($text3);
        $("#form4").show().html($text4);
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $('#formindicatorcabangpercabang').hide();
        $('#tableindicatorcabangpercabang').hide();
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
        $('#exportdatatoexcelketepatanlaporan1').hide();
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

        $.ajax({
            url: "{{ url('/getgeneratebarchart') }}",
            data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
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
            data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
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

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').show();
        $('#group4').hide();
        $("#form5").show().html($text5);
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
        $('#formindicatorcabangpercabang').hide();
        $('#tableindicatorcabangpercabang').hide();
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
        $months = $('#months').val();
        $years = $('#years').val();
        $modul = 'PTKAK';
        $text6 = 'STATUS PTKAK SAMPAI DENGAN'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';

        $('#group1').hide();
        $('#group2').hide();
        $('#group3').hide();
        $('#group4').show();
        $("#form6").show().html($text6);
        $('#exportdatatoexcelindikatorcabangpercabang').hide();
         $('#formindicatorcabangpercabang').hide();
        $('#tableindicatorcabangpercabang').hide();
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

        $.ajax({

            url: "{{ url('/getgenerateptkak') }}",
            data: {"_token": "{{ csrf_token() }}", "months" : $months, "years" : $years},
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

    }

    function generateindikatorcabangpercabang()
    {
        //$months = $('#months').val();
        $years = $('#years').val();
        $cabang = $('#cabang').val();

        $text = 'Report Indikator Cabang '+$cabang+' '+'Per Cabang'+' '+$years;

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
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatacabangpercabang tr").detach();
                $.each(data, function (index,value) {
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var dataindikatorcabangpercabang = 
                        '<tr style="width: 100% !important; border : 1px; color:red;">'+
                            '<td style="width: 10% !important; color:red;"><b>'+value.Sub_Division_Name+'</b></td>'+
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
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var dataindikatorcabangpercabang = '<tr style="width: 100% !important;  border : 1px;">'+
                        '<td style="width: 10% !important; color:blue"><b>'+value.Sub_Division_Name+'</b></td>'+
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
                    }else{
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
                        '<td style="width: 10% !important;">'+value.Target+'</td>'+
                        '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+
                '</tr>';
                    }                   
                    $('#tableindicatorcabangpercabang').append(dataindikatorcabangpercabang);
                })


            },
            error: function(){

            }
        });

    }

     function generatekpi()
    {
        $months = $('#months').val();
        $years = $('#years').val();
        $cabang = $('#cabang').val();

        $text = 'Report KPI'+' '+$months+' '+$years+;

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

        $("#formkpi").show().html($text);
        $('#tablekpi').show();
        $('#exportdatatoexcelkpi').show();
        
        // $.ajax({

        //     url: "{{ url('/previewikpi') }}",
        //     data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
        //     type: "POST",
        //     dataType: "json",
        //     success: function(data){
        //         console.log(data);
        //         //$('#tablekpi').empty();
        //         $("#cleardatakpi tr").detach();
        //         $.each(data, function (index,value) {
        //             if (value.Sub_Division_Name=='BTN - Operasi') {
        //                 var datakpi = 
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
        //                 var datakpi = '<tr style="width: 100% !important;  border : 1px;">'+
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
        //                 var datakpi = '<tr style="width: 100% !important;">'+
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
        //$months = $('#months').val();
        $years = $('#years').val();
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

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();
        
        $.ajax({

            url: "{{ url('/previewindikatorcabang') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years , "cabang" : $cabang},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatacabang tr").detach();
                $.each(data, function (index,value) {
                    if (value.Sub_Division_Name=='BTN - Operasi') {
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
                        '<td style="width: 10% !important;">'+value.Target+'</td>'+
                        '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var dataindikatorcabang = '<tr style="width: 100% !important;">'+
                        '<td style="width: 10% !important; color:blue">'+value.Sub_Division_Name+'</td>'+
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
                    }else{
                        var dataindikatorcabang = '<tr style="width: 100% !important;">'+
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
                    }
                    
                    $('#tableindicatorcabang').append(dataindikatorcabang);
                })


            },
            error: function(){

            }
        });

    }

    function generateindikatorpusat()
    {
        //$months = $('#months').val();
        $years = $('#years').val();
        $cabang = $('#cabang').val();

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

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();
        
        $.ajax({

            url: "{{ url('/previewindikatorpusat') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatapusat tr").detach();
                $.each(data, function (index,value) {
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var dataindikatorpusat = '<tr style="width: 100% !important; border : 1px;">'+
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
                        '<td style="width: 10% !important;">'+value.Target+'</td>'+
                        '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var dataindikatorpusat = '<tr style="width: 100% !important;">'+
                         '<td style="width: 10% !important; color:blue">'+value.Sub_Division_Name+'</td>'+
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
                    }else{
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
                    }
                    
                    $('#tableindicatorpusat').append(dataindikatorpusat);
                })


            },
            error: function(){

            }
        });

    }


    function generateindikatortercapaipusat()
    {
        //$months = $('#months').val();
        $years = $('#years').val();
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

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();
        
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
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var datatercapaipusat = '<tr style="width: 100% !important; border : 1px;">'+
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
                        '<td style="width: 10% !important;">'+value.Target+'</td>'+
                        '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var datatercapaipusat = '<tr style="width: 100% !important;">'+
                        '<td style="width: 10% !important; color:blue">'+value.Sub_Division_Name+'</td>'+
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
                    }else{
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
                    }
                    
                    $('#tabletercapaipusat').append(datatercapaipusat);
                })


            },
            error: function(){

            }
        });

    }


    function generateindikatortidaktercapaipusat()
    {
        //$months = $('#months').val();
        $years = $('#years').val();
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

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();
        
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
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var datatidaktercapaipusat = '<tr style="width: 100% !important; border : 1px;">'+
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
                        '<td style="width: 10% !important;">'+value.Target+'</td>'+
                        '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var datatidaktercapaipusat = '<tr style="width: 100% !important;">'+
                         '<td style="width: 10% !important; color:blue">'+value.Sub_Division_Name+'</td>'+
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
                    }else{
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
                    }
                    
                    $('#tabletidaktercapaipusat').append(datatidaktercapaipusat);
                })


            },
            error: function(){

            }
        });

    }

    function generateindikatortercapaicabang()
    {
        //$months = $('#months').val();
        $years = $('#years').val();
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

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();
        
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
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var datatercapaicabang = '<tr style="width: 100% !important; border : 1px;">'+
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
                        '<td style="width: 10% !important;">'+value.Target+'</td>'+
                        '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var datatercapaicabang = '<tr style="width: 100% !important;">'+
                         '<td style="width: 10% !important; color:blue">'+value.Sub_Division_Name+'</td>'+
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
                    }else{
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
                    }
                    
                    $('#tabletercapaicabang').append(datatercapaicabang);
                })


            },
            error: function(){

            }
        });

    }


     function generateindikatortidaktercapaicabang()
    {
        //$months = $('#months').val();
        $years = $('#years').val();
        $cabang = $('#cabang').val();

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

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();

        
        $.ajax({

            url: "{{ url('/previewtidaktercapaicabang') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardatatidaktercapaicabang tr").detach();
                $.each(data, function (index,value) {
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var datatidaktercapaicabang = '<tr style="width: 100% !important; border : 1px;">'+
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
                        '<td style="width: 10% !important;">'+value.Target+'</td>'+
                        '<td style="width: 10% !important;">'+value.Sampai_Dengan+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var datatidaktercapaicabang = '<tr style="width: 100% !important;">'+
                        '<td style="width: 10% !important; color:blue">'+value.Sub_Division_Name+'</td>'+
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
                    }else{
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
                    }
                    
                    $('#tabletidaktercapaicabang').append(datatidaktercapaicabang);
                })


            },
            error: function(){

            }
        });

    }

    function generateketepatanlaporan()
    {
        //$months = $('#months').val();
        $years = $('#years').val();
        $cabang = $('#cabang').val();

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

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();
        
        $.ajax({

            url: "{{ url('/previewketepatanlaporan') }}",
            data: {"_token": "{{ csrf_token() }}", "years" : $years, "cabang" : $cabang},
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                //$('#tableindicatorcabangpercabang').empty();
                $("#cleardataketepatanlaporan tr").detach();
                $.each(data, function (index,value) {
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var dataketepatanlaporan = '<tr style="width: 100% !important; border : 1px;">'+
                        '<td style="width: 20% !important; color:red"><b>'+value.Division_Name+'</b></td>'+
                        '<td style="width: 20% !important;">'+value.Sub_Division_Name+'</td>'+
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
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var dataketepatanlaporan = '<tr style="width: 100% !important;">'+
                         '<td style="width: 20% !important; color:blue"><b>'+value.Division_Name+'</b></td>'+
                        '<td style="width: 20% !important;">'+value.Sub_Division_Name+'</td>'+
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
                    }else{
                        var dataketepatanlaporan = '<tr style="width: 100% !important;">'+
                         '<td style="width: 20% !important;"><b>'+value.Division_Name+'</b></td>'+
                        '<td style="width: 20% !important;">'+value.Sub_Division_Name+'</td>'+
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
                    }
                    
                    $('#tableketepatanlaporan').append(dataketepatanlaporan);
                })


            },
            error: function(){

            }
        });

    }

    function generaterealisasisasaranmutusd()
    {
        $months = $('#months').val();
        $years = $('#years').val();
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
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var datadetailkategorisd = '<tr style="width: 100% !important; border : 1px;">'+
                       '<td style="width: 35% !important; color:red"><b>'+value.Division_Name+'</b></td>'+
                        '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tidak_Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Data_Kurang_Percent+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var datadetailkategorisd = '<tr style="width: 100% !important;">'+
                         '<td style="width: 35% !important; color:blue"><b>'+value.Division_Name+'</b></td>'+
                        '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tidak_Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Data_Kurang_Percent+'</td>'+

                        '</tr>';    
                    }else{
                        var datadetailkategorisd = '<tr style="width: 100% !important;">'+
                         '<td style="width: 35% !important;"><b>'+value.Division_Name+'</b></td>'+
                        '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tidak_Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Data_Kurang_Percent+'</td>'+

                '</tr>';
                    }
                    
                    $('#tabledetailkategorisd').append(datadetailkategorisd);
                })


            },
            error: function(){

            }
        });

    }


    function generaterealisasisasaranmutu()
    {
        $months = $('#months').val();
        $years = $('#years').val();
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

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();
        
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
                    if (value.Sub_Division_Name=='BTN - Operasi') {
                        var datadetailkategori = '<tr style="width: 100% !important; border : 1px;">'+
                        '<td style="width: 35% !important; color:red"><b>'+value.Division_Name+'</b></td>'+
                        '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tidak_Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Data_Kurang_Percent+'</td>'+

                        '</tr>';    
                    }else if (value.Sub_Division_Name=='BTN - Pendukung Operasi') {
                        var datadetailkategori = '<tr style="width: 100% !important;">'+
                          '<td style="width: 35% !important; color:blue"><b>'+value.Division_Name+'</b></td>'+
                        '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tidak_Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Data_Kurang_Percent+'</td>'+

                        '</tr>';    
                    }else{
                        var datadetailkategori = '<tr style="width: 100% !important;">'+
                         '<td style="width: 35% !important;"><b>'+value.Division_Name+'</b></td>'+
                        '<td style="width: 35% !important;">'+value.Sub_Division_Name+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Tidak_Tercapai_Percent+'</td>'+
                        '<td style="width: 10% !important;">'+value.Data_Kurang_Percent+'</td>'+

                '</tr>';
                    }
                    
                    $('#tabledetailkategori').append(datadetailkategori);
                })


            },
            error: function(){

            }
        });

    }

     function generatesoptabel()
    {
        $months = $('#months').val();
        $years = $('#years').val();
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

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();
        
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

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();
        
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
        $months = $('#months').val();
        $years = $('#years').val();
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

        $("#formkpi").hide();
        $('#tablekpi').hide();
        $('#exportdatatoexcelkpi').hide();
        
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

    function generateexcelindikatorcabangpercabang()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();

        var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexcelcabangpercabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelcabangpercabang') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatorcabang()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();
        var mdl = 'Report Indikator Cabang';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorcabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorcabang') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatorpusat()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();
        var mdl = 'Report Indikator Pusat';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorpusat') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorpusat') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatortercapaipusat()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();
        var mdl = 'Report Indikator Tercapai Pusat';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorpusattercapai') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorpusattercapai') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatortidaktercapaipusat()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();
        var mdl = 'Report Indiktor Tidak Tercapai Pusat';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorpusattidaktercapai') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorpusattidaktercapai') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatortercapaicabang()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();
        var mdl = 'Report Indikator Tercapai Cabang';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatortercapaicabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatortercapaicabang') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelindikatortidaktercapaicabang()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();
        var mdl = 'Report Indikator Tidak Tercapai Cabang';

        var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatortidaktercapaicabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatortidaktercapaicabang') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexcelketepatanlaporan()
    {
        var thn = $('#years').val();
        var cbg = $('#cabang').val();

        //var gabung = thn + ',' + cbg;

            window.location="{{ url('/exportexcelketepatanlaporan') }}" + "/" + thn; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelketepatanlaporan') }}" + "/" + thn;  
            },900000000000)
    }

     function generateexceldetailkategorisd()
    {
        var bln = $('#months').val();
        var thn = $('#years').val();
        var cbg = $('#cabang').val();

        var gabung = bln + ',' + thn;

            window.location="{{ url('/exportexcelrealisasisasaranmutusampaidengan') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelrealisasisasaranmutusampaidengan') }}" + "/" + gabung;  
            },900000000000)
    }

    function generateexceldetailkategori()
    {
        var bln = $('#months').val();
        var thn = $('#years').val();
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
