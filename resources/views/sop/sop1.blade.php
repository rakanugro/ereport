<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PT. Pelabuhan Tanjung Priok</title>

<link href="templateslide/assets/css/style.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/uikit/css/uikit.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/datepicker/daterangepicker.css" rel="stylesheet" type="text/css">
<link href="templateslide/assets/datepicker/daterangepicker.css" rel="stylesheet" type="text/css">

<script src="templateslide/assets/js/jquery-1.11.1.min.js"></script>
<script src="templateslide/assets/uikit/js/uikit.js"></script>

<script src="templateslide/assets/datepicker/moment.min.js"></script>
<script src="templateslide/assets/datepicker/daterangepicker.js"></script>

<script src="templateslide/assets/js/marquee/jquery.marquee.js"></script>
<script src="templateslide/assets/js/marquee/jquery.pause.js"></script>
<script src="templateslide/assets/js/marquee/jquery.easing.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
</head>

<body>
    <div>
        
        <div align="center" class="uk-child-width-expand@s uk-text-center uk-grid-collapse" style="background-color:#ef8203" uk-grid>           
            <div style="background-color:#ffff;padding-top:0px;" align="center">
                <div>


                    <!----------Header Menu------------------------------------------------------->
                    <div class="divHeader">
                        <div class="uk-child-width-1-2 uk-child-width-1-2@m uk-child-width-1-2@s uk-text-center uk-grid-collapse" uk-grid>
                            <div>
                                <table>
                                    <tr>
                                        <td class="menu">
                                            <img src="templateslide/assets/img/logo/ptp.png" class="fl-logo">
                                        </td>
                                        
                                        <td class="menu" onclick="url('/')">
                                            Home        
                                        </td>

                                        <!-- <td class="menu">
                                            Cara Penggunaan
                                        </td>

                                        <td class="menu">
                                            Customer Service
                                        </td>  -->                          
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <div class="divLogout">
                                    <button class="uk-button uk-button-default uk-button-primary fl-button-small">
                                        Logout
                                    </button>
                                </div>
                            </div>
                        </div>                        
                    </div>

                    


                    <!--------Detail Menu---------------------------------------->
                    <div id="sopMenu" class="ukMenu">

                        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="sets: true">
                            <ul class="uk-slider-items uk-slider-items3 uk-child-width-1-2 uk-child-width-1-3@m uk-child-width-1-2@s">
                                <li onclick="sopMenu()">
                                    <table class="tblSlide" cellspacing="0">
                                        <tr>
                                            <td align="center" class="tdSlide">
                                                <div>
                                                    <div>
                                                        <div>
                                                            <img src="templateslide/assets/img/icon/sopUpload.png" style="height:150px">
                                                        </div>
                                                        <br>
                                                        <b class="divTitleBoxBold">Upload Dokumen SOP</b>
                                                        <div class="divTitleBox">
                                                            (Title) Ex Standar Operasional Procedure Operasi Pelabuhan
                                                        </div>

                                                        <div>
                                                            <button class="uk-button uk-button-default uk-button-primary fl-button-box-green">
                                                                Upload
                                                            </button>
                                                        </div>
                                                    </div>                                      
                                                </div>
                                            </td>
                                        </tr>           
                                    </table>                                    
                                </li>

                                
                                <li class="li">
                                    <table class="tblSlide" cellspacing="0">
                                        <tr>
                                            <td align="center" class="tdSlide2">
                                                <div>
                                                    <div>
                                                        <div>
                                                            <img src="templateslide/assets/img/icon/sopExcel.png" style="height:150px">
                                                        </div>
                                                        <br>
                                                        <b class="divTitleBoxBold">SOP 2</b>
                                                        <div class="divTitleBox">
                                                            (Title) Ex Standar Operasional Procedure Operasi Terminal
                                                        </div>

                                                        <div>
                                                            <button class="uk-button uk-button-default uk-button-primary fl-button-box">
                                                                Download
                                                            </button>
                                                        </div>
                                                    </div>                                      
                                                </div>
                                            </td>
                                        </tr>           
                                    </table>    
                                </li>

                                <li class="li">
                                    <table class="tblSlide" cellspacing="0">
                                        <tr>
                                            <td align="center" class="tdSlide3">
                                                <div>
                                                    <div>
                                                        <div>
                                                            <img src="templateslide/assets/img/icon/sopExcel.png" style="height:150px">
                                                        </div>
                                                        <br>
                                                        <b class="divTitleBoxBold">SOP 3</b>
                                                        <div class="divTitleBox">
                                                            (Title) Ex Standar Operasional Procedure Operasi Terminal
                                                        </div>

                                                        <div>
                                                            <button class="uk-button uk-button-default uk-button-primary fl-button-box">
                                                                Download
                                                            </button>
                                                        </div>
                                                    </div>                                      
                                                </div>
                                            </td>
                                        </tr>           
                                    </table>
                                </li>

                                <li class="li">
                                    <table class="tblSlide" cellspacing="0">
                                        <tr>
                                            <td align="center" class="tdSlide4">
                                                <div>
                                                    <div>
                                                        <div>
                                                            <img src="templateslide/assets/img/icon/sopPdf.png" style="height:150px">
                                                        </div>
                                                        <br>
                                                        <b class="divTitleBoxBold">SOP 4</b>
                                                        <div class="divTitleBox">
                                                            (Title) Ex Standar Operasional Procedure Operasi Terminal
                                                        </div>

                                                        <div>
                                                            <button class="uk-button uk-button-default uk-button-primary fl-button-box">
                                                                Download
                                                            </button>
                                                        </div>
                                                    </div>                                      
                                                </div>
                                            </td>
                                        </tr>           
                                    </table>
                                </li>

                                <li class="li">
                                    <table class="tblSlide" cellspacing="0">
                                        <tr>
                                            <td align="center" class="tdSlide5">
                                                <div>
                                                    <div>
                                                        <div>
                                                            <img src="templateslide/assets/img/icon/sopPdf.png" style="height:150px">
                                                        </div>
                                                        <br>

                                                        <b class="divTitleBoxBold">SOP 5</b>
                                                        <div class="divTitleBox">
                                                            (Title) Ex Standar Operasional Procedure Operasi Terminal
                                                        </div>

                                                        <div>
                                                            <button class="uk-button uk-button-default uk-button-primary fl-button-box">
                                                                Download
                                                            </button>
                                                        </div>
                                                    </div>                                      
                                                </div>
                                            </td>
                                        </tr>           
                                    </table>
                                </li>

                                <li class="li">
                                    <table class="tblSlide" cellspacing="0">
                                        <tr>
                                            <td align="center" class="tdSlide6">
                                                <div>
                                                    <div>
                                                        <div>
                                                            <img src="templateslide/assets/img/icon/sopPdf.png" style="height:150px">
                                                        </div>
                                                        <br>
                                                        <b class="divTitleBoxBold">SOP 6</b>
                                                        <div class="divTitleBox">
                                                            (Title) Ex Standar Operasional Procedure Operasi Terminal
                                                        </div>

                                                        <div>
                                                            <button class="uk-button uk-button-default uk-button-primary fl-button-box">
                                                                Download
                                                            </button>
                                                        </div>
                                                    </div>                                      
                                                </div>
                                            </td>
                                        </tr>           
                                    </table>
                                </li>
                            </ul>

                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
                        </div>
                </div>
            </div>          
        </div>

    </div>
</body>
</html>


<script>
    function sopMenu(){
        $(".ukMenu").hide();
        $("#sopMenu").show();
    }

    function sliderMenu(){
        $(".ukMenu").hide();
        $("#sliderMenu").show();
    }

</script>