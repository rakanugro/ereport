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
				<span style="font-size:20px">				
					<img class="uk-preserve-width uk-border-circle" src="templateslide/assets/img/icon/sopReadMore.png" width="65" alt="">
					Export Data Excel	
				</span>
				<span class="fl-menu-tool" style="padding-top: 15px;">
					<a href="/listexportdata"><button class="uk-button uk-button-success fl-button" type="button">To Chart</button></a>
				</span>
			<div class="fl-table col-md-12">
				<div id="generatechart">
					<form action="#" method="post" name="form_name" id="form_id" class="form_class" >
					{{ csrf_field() }}
					<div style="margin-bottom:30px; text-align:center;">
						<span style="font-size:18px">Pilih Bulan dan Tahun</span>
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
					</div>
					<br>
					<div class="col-lg-12" style="text-align: center;">
						<button type="button" onclick="generate()" class="uk-button uk-button-primary">Export</button>
					</div>
					</form>
				</div>
				<div class="form-group m-form__group row">
					<div class="col-lg-6" id="m_amcharts_12" style="height: 400px !important;"></div>
					<div class="col-lg-6" id="m_amcharts_13" style="height: 400px !important;"></div>
				</div>
				<div class="form-group m-form__group row">
					<div class="col-lg-10" id="m_amcharts_4" style="height: 350px; align-content: center !important;"></div>
				</div>
				<div class="form-group m-form__group row">
					<div class="col-lg-6" id="m_amcharts_14" style="height: 350px !important;"></div>
					<div class="col-lg-6" id="m_amcharts_15" style="height: 350px !important;"></div>
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

        	url: "{{ url('/getgenerateptkak') }}",
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

        	url: "{{ url('/getgeneratesop') }}",
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

	$(".select2-list").select2({
		allowClear: true
	});
</script>
