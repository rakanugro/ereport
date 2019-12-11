<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PT. Pelabuhan Tanjung Priuk</title>

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
                                        
                                        <td class="menu" onclick="sliderMenu()">
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

                    <!--------Slider Menu---------------------------------------->
                    <div id="sliderMenu" class="ukMenu">
                        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="sets: true">
                            <ul class="uk-slider-items uk-slider-items3 uk-child-width-1-2 uk-child-width-1-3@m uk-child-width-1-2@s">
                                <li class="li" onclick="sopMenu()">
                                    <img src="templateslide/assets/img/banner/mn1.jpg" alt="SOP 1 PTP" class="img-fit">
                                </li>
                                <li class="li">
                                    <img src="templateslide/assets/img/banner/mn2.jpg" alt="SOP 1 PTP" class="img-fit">
                                </li>
                                <li class="li">
                                    <img src="templateslide/assets/img/banner/mn3.jpg" alt="SOP 1 PTP" class="img-fit">
                                </li>
                                <li class="li">
                                    <img src="templateslide/assets/img/banner/menu4.jpg" alt="SOP 1 PTP" class="img-fit">
                                </li>
                                <li class="li">
                                    <img src="templateslide/assets/img/banner/menu6.jpg" alt="SOP 1 PTP" class="img-fit">
                                </li>
                                <li class="li" onclick="standarMenu()">
                                    <img src="templateslide/assets/img/banner/menu5.jpg" alt="SOP 1 PTP" class="img-fit">
                                </li>
                            </ul>

                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
                        </div>
                    </div>


                    
                    <!--------Detail Menu---------------------------------------->
                    <div id="sopMenu" class="ukMenu" style="display:none">
                        <div style="height:100vh">
                            <br><br><br>
                            <div class="uk-child-width-1-2 uk-child-width-1-3@m uk-child-width-1-2@s uk-text-center uk-grid-collapse" uk-grid>
                                <div>
                                    <div class="uk-card uk-card-default uk-card-body fl-box fl-box1">
                                        <b>SOP 1</b>

                                        <div class="divTitleBox">
                                            (Title) Ex Standar Operasional Procedure Operasi Pelabuhan
                                        </div>

                                        <div>
                                            <button class="uk-button uk-button-default uk-button-primary fl-button-box">
                                                Download
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="uk-card uk-card-default uk-card-body fl-box fl-box2">
                                        <b>SOP 2</b>

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
                                
                                <div>
                                    <div class="uk-card uk-card-default uk-card-body fl-box fl-box3">
                                        <b>SOP 3</b>

                                        <div class="divTitleBox">
                                            (Title) Ex Standar Operasional Procedure Operasi Pelabuhan
                                        </div>

                                        <div>
                                            <button class="uk-button uk-button-default uk-button-primary fl-button-box">
                                                Download
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="uk-card uk-card-default uk-card-body fl-box fl-box4">
                                        <b>SOP 4</b>

                                        <div class="divTitleBox">
                                            (Title) Ex Standar Operasional Procedure Operasi Pelabuhan
                                        </div>

                                        <div>
                                            <button class="uk-button uk-button-default uk-button-primary fl-button-box">
                                                Download
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="uk-card uk-card-default uk-card-body fl-box fl-box5">
                                        
                                        <b>SOP 5</b>

                                        <div class="divTitleBox">
                                            (Title) Ex Standar Operasional Procedure Operasi Pelabuhan
                                        </div>

                                        <div>
                                            <button class="uk-button uk-button-default uk-button-primary fl-button-box">
                                                Download
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="uk-card uk-card-default uk-card-body fl-box fl-box6">
                                        <b>SOP 6</b>

                                        <div class="divTitleBox">
                                            (Title) Ex Standar Operasional Procedure Operasi Pelabuhan
                                        </div>

                                        <div>
                                            <button class="uk-button uk-button-default uk-button-primary fl-button-box">
                                                Download
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                  
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

    function standarMenu(){
        location.href='/sop';
    }

</script>
