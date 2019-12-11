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
					Master Sub Indicator	
				</span>
			</div>
			
			<div class="fl-table">
				<form id="form_perencanaan" action="/master/sub_indicator_edit" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="id" id="id" value="{{ $id }}" required>
					<div>
						<b>Sub Indicator Name</b>
						<input name="sub_indicator_name" class="uk-input uk-child-width-1-2" type="text" value="{{ $sub_indicator_name }}" placeholder="Sub Indicator Name" required>
					</div>
					<div>
						<b>Unit</b>
						<input name="sub_unit" class="uk-input uk-child-width-1-2" type="text" value="{{ $unit }}" placeholder="Unit" required>
					</div>
					<div>
						<br>
					</div>
					<div>
						<button class="uk-button uk-button-primary fl-button" onclick="save_sub_indicator(this.form.id);return false;">
							<i class="fa fa-plus"></i>&nbsp;Save
						</button>
					</div>
					
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




<script>
	function showModal(){
		UIkit.modal("#mymodal").show();
	}

	function save_sub_indicator(formid)
    {   
		submit_form(formid);
    }

	$(".select2").select2();
	$(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
	$(".select2-list").select2({
            allowClear: true
        });
</script>
