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
    #generateexcel{
        display:none;

    }
    #garis{
        display:none;

    }/*
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
					E-Reporting PT. Pelabuhan Tanjung Priuk	
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
					Generate Data	
				</span>
				<!-- <span class="fl-menu-tool" style="padding-top: 15px;">
					<a href="/form_list_export_data_excel"><button class="uk-button uk-button-success fl-button" type="button">Export Data Excel</button></a>
				</span> -->
			<div class="fl-table col-md-12">
				<div id="generatechart">
					<form action="#" method="post" name="form_name" id="form_id" class="form_class" >
					{{ csrf_field() }}
					<div style="margin-bottom:30px; text-align:center;">
						<span style="font-size:18px">Pilih Bulan , Tahun dan Modul</span>
					</div>
					<div class="col-lg-12" style="text-align: center;">
						<b style="width: 30% !important;">Bulan</b>
						&nbsp;
						&nbsp;
						<select class="form-control select2-list" id="months" name="months" style="width: 20% !important;" required="required">
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
						<select id="years" class="form-control select2-list" name="years" style="width: 20% !important;" required="required">
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
                          <b style="width: 30% !important;">Modul</b>
                          &nbsp;
                          &nbsp;
                          <select id="modul" class="form-control select2-list" name="modul" style="width: 20% !important;" required="required">
                            <option value="">--Pilih Modul--</option>
                            <option value="Sasaran Mutu Tercapai">Sasaran Mutu Tercapai</option>
                            <option value="Alasan Tidak Tercapai">Alasan Tidak Tercapai</option>
                            <option value="SOP">SOP</option>
                            <option value="PTKAK">PTKAK</option>
                        </select>
					</div>
					<br>
					<div class="col-lg-12" style="text-align: center;">
						<button type="button" onclick="generate()" class="uk-button uk-button-primary">Generate</button>
					</div>
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
                <div id="garis"><hr style="color: black;border: double;" width="100%">
                    <br>
                    <br>
                </div>
                 <div id="generateexcel" class="col-lg-12">
                        {{ csrf_field() }}
                        <div style="margin-bottom:30px; text-align:center;">
                            <span style="font-size:18px">Pilih Bulan , Tahun dan Tipe Report</span>
                        </div>
                        <div class="col-lg-12" style="text-align: center;">
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
                        </div>
                        <br>
                         <!-- <div class="col-lg-12" style="text-align: center;">
                            <b style="width: 30% !important;">Divisi</b>
                              &nbsp;
                            &nbsp;
                            <select id="divisi1" class="form-control select2-list" name="divisi1" style="width: 20% !important;" required="required">
                                <option value="">--Pilih Divisi--</option>
                                @foreach($dirbranchlist as $dirbranch)
                                <option value="{{ $dirbranch->DIVISI_BRANCH_ID }}">{{ $dirbranch->DIVISI_BRANCH }}</option>
                                @endforeach
                            </select>
                             &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <b style="width: 30% !important;">Sub Divisi</b>
                              &nbsp;
                            &nbsp;
                            <select id="subdivisi1" class="form-control select2-list" name="subdivisi1" style="width: 20% !important;" required="required">
                                <option value="">--Pilih Sub Divisi--</option>
                                @foreach($subdiv_list as $subdiv)
                                <option value="{{ $subdiv->SUB_DIVISION_ID }}">{{ $subdiv->SUB_DIVISION_NAME }}</option>
                                @endforeach
                            </select>
                        </div> -->
                        <br>
                        <br>
                        <br>
                        <div class="col-lg-12" style="text-align: center;">
                            <button type="submit" id="exportexcel" class="uk-button uk-button-primary">Export Excel</button>
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
<script>

	function generate()
	{
		$months = $('#months').val();
		$years = $('#years').val();
        $modul = $('#modul').val();
        $text1 = 'INDICATOR SASARAN MUTU PER'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
        $text2 = 'INDICATOR SASARAN MUTU SAMPAI DENGAN'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
        $text3 = 'ALASAN SASARAN MUTU TIDAK TERCAPAI'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
        $text4 = 'ALASAN SASARAN MUTU TIDAK TERCAPAI SAMPAI DENGAN'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';
        $text5 = 'JUMLAH SOP, WI, DAN FORMS'+' '+$years+' '+'(KONSOLIDASI PTP)';
        $text6 = 'STATUS PTKAK SAMPAI DENGAN'+' '+$months+' '+$years+' '+'(KONSOLIDASI PTP)';

        $("#garis").show();
        $("#generateexcel").show();
        
        if($modul == 'Sasaran Mutu Tercapai')
        {
                 $('#group1').show();
                 $('#group2').hide();
                 $('#group3').hide();
                 $('#group4').hide();
                 $("#form1").show().html($text1);
                 $("#form2").show().html($text2);
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
        else if($modul == 'Alasan Tidak Tercapai'){

               $('#group1').hide();
               $('#group2').show();
               $('#group3').hide();
               $('#group4').hide();
               // $("#generateexcel").show();
               $("#form3").show().html($text3);
               $("#form4").show().html($text4);

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
        else if($modul == 'SOP'){
               
                $('#group1').hide();
                $('#group2').hide();
                $('#group3').show();
                $('#group4').hide();
                // $("#generateexcel").show();
                $("#form5").show().html($text4);

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
        else if($modul == 'PTKAK'){

            $('#group1').hide();
            $('#group2').hide();
            $('#group3').hide();
            $('#group4').show();
            // $("#generateexcel").show();
            $("#form6").show().html($text5);

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
        
    }

    $('#exportexcel').click(function pass_cek(e){
        e.preventDefault();
        var bln = $('#months1').val();
        var thn = $('#years1').val();
        var mdl = $('#modul1').val();         
        //alert(mdl);

        if(mdl == 'Report Indicator Pusat')
        {
            var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorpusat') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorpusat') }}" + "/" + gabung;  
            },900000000000)   
        }
        else if(mdl == 'Report Indicator Cabang')
        {
            var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorcabang') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorcabang') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Indicator Tercapai Pusat')
        {
            var gabung = thn + ',' + mdl;

            window.location="{{ url('/exportexcelindicatorpusattercapai') }}" + "/" + gabung; 
            setTimeout(function(){
                window.location="{{ url('/exportexcelindicatorpusattercapai') }}" + "/" + gabung;  
            },900000000000)
        }
        else if(mdl == 'Report Indicator Tidak Tercapai Pusat')
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


	$(".select2-list").select2({
		allowClear: true
	});
</script>
