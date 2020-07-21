<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as'=>'login', 'uses'=>'Auth\LoginController@login']);
Route::get('/login','Auth\LoginController@login');
Route::get('/signup','Auth\LoginController@signup');
Route::get('/signin','Auth\LoginController@login');
Route::post('/postlogin','Auth\LoginController@postLogin');
Route::middleware(['auth'])->group(function(){
    // Route::get('/home', function () {
    //     return view('index');
    // });

    Route::get('/master_menu', 'MasterController@master_menu');    
    // Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('dashboard', ['as'=>'dashboard', 'uses'=>'HomeController@index']);
    
    // view sementara
    Route::get('/management_report_index', 'ReportController@index');
    Route::get('/management_report_upload', function () {
        return view('report.management_report_upload');
    });
    Route::post('/management_report_upload', 'ReportController@add_post');
    Route::get('/report_table', 'ReportController@table_report');
    Route::get('/management_report_download/{id}', 'ReportController@download');


    Route::get('/dokumen_pendukung', 'DokumenController@index');
    Route::get('/dokumen_pendukung_upload', function () {
        return view('dokumen.dokumen_pendukung_upload');
    });
    Route::post('/dokumen_pendukung_upload', 'DokumenController@add_post');
    Route::get('/dokumen_table', 'DokumenController@table_dokumen');
    Route::get('/dokumen_pendukung_download/{id}', 'DokumenController@download');


    // Route::get('/kpi', function () {
    //     return view('kpi.tabel_kpi');
    // });
    // Route::get('/tkp', function () {
    //     return view('tkp.tabel_tingkat_kesehatan');
    // });

    Route::get('/sop_list', 'SopController@sop_list');
    Route::post('/sop_save', 'SopController@save_sop');
    Route::get('/form_sop', 'SopController@form_sop');
    Route::get('/sop_index/{id}', 'SopController@index');
    Route::get('/sop_table/{id}', 'SopController@table_sop');
    Route::get('/wi/{id}', 'WiController@wi');
    Route::get('/wi_table/{id}', 'SopController@table_wi');
    Route::get('/form_file/{id}', 'FormFileController@form_file');
    Route::get('/form_file_table/{id}', 'SopController@table_form_file');
    Route::get('/sop_upload/{id}', 'SopController@upload_sop');
    Route::get('/wi_upload/{id}', 'WiController@upload_wi');
    Route::get('/form_file_upload/{id}', 'FormFileController@upload_form_file');
    Route::get('/sop/inactive/{id}', 'SopController@sopinactive');
    Route::get('/sop/edit/{id}', 'SopController@edit');
    Route::post('/update', 'SopController@update');
    Route::get('/sop_check', 'SopController@sop_check');

    

    Route::post('/sop_upload', 'SopController@add_post');
    Route::get('/sop_download/{id}', 'SopController@download');
    Route::post('/wi_upload', 'WiController@add_post');
    Route::get('/wi_download/{id}', 'WiController@download');
    Route::post('/form_file_upload', 'FormFileController@add_post');
    Route::get('/form_file_download/{id}', 'FormFileController@download');

    Route::get('getAjax/{action}/{id}', 'MasterController@get_ajax');

    //Sarmut
    //Sarmut Mst
    Route::get('/sarmut', 'SarmutController@sarmut_list');
    Route::get('/sarmut/form_sarmut', 'SarmutController@form_sarmut');
    Route::get('/sarmut/edit/form_mstsarmut/{id}', 'SarmutController@form_edit_mstsarmut');
    Route::post('/sarmut/master_sarmut_save', 'SarmutController@save_mst_sarmut');
    Route::post('/sarmut/master_sarmut_edit', 'SarmutController@edit_mst_sarmut');
    Route::get('/sarmut/master_sarmut_delete/{id}', 'SarmutController@delete_mst_sarmut');
    Route::get('/sarmut/mstsarmut_active/{id}', 'SarmutController@mstsarmut_active');
    Route::get('/sarmut/mstsarmut_inactive/{id}', 'SarmutController@mstsarmut_inactive');
    Route::get('/sarmut/mstsarmut_approve/{id}', 'SarmutController@mstsarmut_approve');
    Route::get('/sarmut/mstsarmut_kembalikan/{id}', 'SarmutController@mstsarmut_kembalikan');
    Route::get('/getdivbranch/{action}/{id}', 'SarmutController@mst_getdivbranch');
    Route::get('/getsubdiv/{action}/{id}', 'SarmutController@mst_getsubdiv');
    Route::post('/sarmut/master_sarmut_save_indikator', 'SarmutController@save_mst_sarmut_indikator');
    Route::get('/sarmut/edit/form_mstsarmutedit/{id}', 'SarmutController@form_edit_mstsarmutfix');
    Route::post('/sarmut/master_sarmut_save_edit_indikator', 'SarmutController@save_edit_mst_sarmut_indikator');
    Route::get('/sarmut/status/form_mstsarmuteditstatus/{id}', 'SarmutController@form_edit_status_mstsarmutfix');
    Route::post('/sarmut/master_sarmut_save_edit_status_indikator', 'SarmutController@save_edit_status_mst_sarmut_indikator');
    Route::get('/sarmut/detail/form_mstsarmutdetail/{id}', 'SarmutController@form_detail_mstsarmutfix');
    Route::post('/sarmut/master_sarmut_approval_indikator', 'SarmutController@approve_mst_sarmut_indikator');
    Route::post('/sarmut/master_sarmut_kembalikan_indikator', 'SarmutController@kembalikan_mst_sarmut_indikator');


    //Sarmut Tx
    Route::get('/txsarmut', 'SarmutController@txsarmut_list');
    Route::get('/txsarmut/form_txsarmut', 'SarmutController@form_txsarmut');
    Route::get('/txsarmut/edit/form_txsarmut/{id}', 'SarmutController@form_edit_txsarmut');
    Route::get('/txsarmut/detail/form_txsarmut/{id}', 'SarmutController@form_detail_txsarmut');
    Route::post('/txsarmut/sarmut_save', 'SarmutController@save_tx_sarmut');
    Route::post('/txsarmut/sarmut_edit', 'SarmutController@edit_tx_sarmut');
    Route::post('/txsarmut/sarmut_approve', 'SarmutController@approve_tx_sarmut');
    Route::get('/txsarmut/sarmut_delete/{id}', 'SarmutController@delete_tx_sarmut');
    Route::post('/txsarmut/txsarmut_approve', 'SarmutController@txsarmut_approve');
    Route::post('/txsarmut/txsarmut_kembalikan', 'SarmutController@txsarmut_kembalikan');
    Route::get('/txsarmutfilter/{id}', 'SarmutController@filter_txsarmut');
    Route::post('/txsarmut/export_excel', 'SarmutController@excel_export');
    Route::get('/txsarmut/deletefile/{id}', 'SarmutController@delete_file');

    Route::post('/input_sarmut', 'SarmutController@form_input_sarmut'); 
    Route::get('/input_sarmut_upload', 'SarmutController@form_input_sarmut_upload');



     // Dokument
     Route::get('/dokumen/dokumen_pendukung_list', 'DokumenController@dokumen_pendukung_list');
     Route::get('/dokumen/dokumen_pendukung', 'DokumenController@dokumen_pendukung');
    //  Route::post('/master/organization_structure_save', 'MasterController@save_organization_structure');
    //  Route::post('/master/organization_structure_delete', 'MasterController@delete_organization_structure');



    //KPI
    //KPI Mst
    Route::get('/kpi', 'KPIController@kpi_list');
    Route::get('/kpi/form_kpi', 'KPIController@form_kpi');
    Route::get('/kpi/edit/form_mstkpi/{id}', 'KPIController@form_edit_mstkpi');
    Route::post('/kpi/master_kpi_save', 'KPIController@save_mst_kpi');
    Route::post('/kpi/master_kpi_edit', 'KPIController@edit_mst_kpi');
    Route::get('/kpi/master_kpi_delete/{id}', 'KPIController@delete_mst_kpi');
    Route::get('/kpi/mstkpi_active/{id}', 'KPIController@mstkpi_active');
    Route::get('/kpi/mstkpi_inactive/{id}', 'KPIController@mstkpi_inactive');
    Route::get('/kpi/mstkpi_approve/{id}', 'KPIController@mstkpi_approve');
    Route::get('/kpi/mstkpi_kembalikan/{id}', 'KPIController@mstkpi_kembalikan');
    Route::post('/kpi/master_indikator_kpi_save', 'KPIController@save_mst_indikator_kpi');
    Route::get('/kpi/edit/form_mstkpiedit/{id}', 'KPIController@form_edit_mstkpifix');
    Route::post('/kpi/master_kpi_save_edit_indikator', 'KPIController@save_edit_mst_indikator_kpi');
    Route::get('/kpi/status/form_mstkpieditstatus/{id}', 'KPIController@form_edit_status_mstkpifix');
    Route::post('/kpi/save_edit_status_mst_indikator_kpi', 'KPIController@save_edit_status_mst_indikator_kpi');
    Route::get('/kpi/detail/form_mstkpidetail/{id}', 'KPIController@form_detail_mstkpifix');
    Route::post('/kpi/master_kpi_approval_indikator', 'KPIController@approve_mst_kpi_indikator');
    Route::post('/kpi/master_kpi_kembalikan_indikator', 'KPIController@kembalikan_mst_kpi_indikator');




    //KPI Tx
    Route::get('/txkpi', 'KPIController@txkpi_list');
    Route::get('/txkpi/form_txkpi', 'KPIController@form_txkpi');
    Route::post('/txkpi/kpi_save', 'KPIController@save_tx_kpi');
    Route::post('/txkpi/kpi_edit', 'KPIController@edit_tx_kpi');
    Route::post('/txkpi/kpi_approve', 'KPIController@approve_tx_kpi');
    Route::get('/txkpi/kpi_delete/{id}', 'KPIController@delete_tx_kpi');
    Route::post('/input_kpi', 'KPIController@form_input_kpi');
    Route::post('/txkpi/txkpi_approve', 'KPIController@txkpi_approve');
    Route::post('/txkpi/txkpi_kembalikan', 'KPIController@txkpi_kembalikan');
    Route::get('/txkpi/detail/form_txkpi/{id}', 'KPIController@form_detail_txkpi');
    Route::post('/kpi/export_excel', 'KPIController@excel_export');

    //TKP
    //TKP Mst
    Route::get('/tkp', 'TKPController@tkp_list');
    Route::get('/tkp/form_tkp', 'TKPController@form_tkp');
    Route::get('/tkp/edit/form_msttkp/{id}', 'TKPController@form_edit_msttkp');
    Route::post('/tkp/master_tkp_save', 'TKPController@save_mst_tkp');
    Route::post('/tkp/master_tkp_edit', 'TKPController@edit_mst_tkp');
    Route::get('/tkp/master_tkp_delete/{id}', 'TKPController@delete_mst_tkp');
    //
    Route::post('/tkp/master_indikator_tkp_save', 'TKPController@save_mst_indikator_tkp');
    Route::get('/tkp/edit/form_msttkpedit/{id}', 'TKPController@form_edit_msttkpfix');
    Route::post('/tkp/master_tkp_save_edit_indikator', 'TKPController@save_edit_mst_indikator_tkp');
    Route::get('/tkp/status/form_msttkpeditstatus/{id}', 'TKPController@form_edit_status_msttkpfix');
    Route::post('/tkp/save_edit_status_mst_indikator_tkp', 'TKPController@save_edit_status_mst_indikator_tkp');
    Route::get('/tkp/detail/form_msttkpdetail/{id}', 'TKPController@form_detail_msttkpfix');
    Route::post('/tkp/master_tkp_approval_indikator', 'TKPController@approve_mst_tkp_indikator');
    Route::post('/tkp/master_tkp_kembalikan_indikator', 'TKPController@kembalikan_mst_tkp_indikator');


    //TKP Tx
    Route::get('/txtkp', 'TKPController@txtkp_list');
    Route::get('/txtkp/form_txtkp', 'TKPController@form_txtkp');
    Route::post('/txtkp/tkp_save', 'TKPController@save_tx_tkp');
    Route::post('/input_tkp', 'TKPController@form_input_tkp');
    Route::get('/txtkp/getmastertxtkp/{id}', 'TKPController@getmastertxtkp');
    Route::post('/txtkp/approvaldvptxtkp', 'TKPController@save_approvaldvptxtkp');
    Route::post('/txtkp/approvalvptxtkp', 'TKPController@save_approvalvptxtkp');
    Route::post('/txtkp/kembalikantxtkp', 'TKPController@save_kembalikantxtkp');
    Route::get('/txtkp/preview/{id}', 'TKPController@form_preview_txtkp');

    
    // Master
    // Master Indicator
    Route::get('/master/indicator_list', 'MasterController@indicator_list');
    Route::get('/master/form_indicator', 'MasterController@form_indicator');
    Route::get('/master/edit/form_indicator/{id}', 'MasterController@form_edit_indicator');
    Route::post('/master/indicator_save', 'MasterController@save_indicator');
    Route::post('/master/indicator_edit', 'MasterController@edit_indicator');
    Route::get('/master/indicator_delete/{id}', 'MasterController@delete_indicator');
    Route::get('/master/indicator_active/{id}', 'MasterController@indicator_active');
    Route::get('/master/indicator_inactive/{id}', 'MasterController@indicator_inactive');
    Route::post('/master/indicator_approve', 'MasterController@indicator_approve');
    Route::post('/master/indicator_kembalikan', 'MasterController@indicator_kembalikan');
    Route::get('/master/edit_status/form_indicator/{id}', 'MasterController@form_edit_status_indicator');
    Route::post('/master/indicator_edit_status', 'MasterController@indicator_edit_status');

    // Master Indicator Target
    Route::get('/master/indicator_target_list', 'MasterController@indicator_target_list');
    Route::get('/master/form_indicator_target', 'MasterController@form_indicator_target');
    Route::get('/master/edit/form_indicator_target/{id}', 'MasterController@form_edit_indicator_target');
    Route::post('/master/indicator_target_save', 'MasterController@save_indicator_target');
    Route::post('/master/indicator_target_edit', 'MasterController@edit_indicator_target');
    Route::get('/master/indicator_target_delete/{id}', 'MasterController@delete_indicator_target');

    // Master Indicator Target_Triwulan
    Route::get('/master/indicator_target_triwulan_list', 'MasterController@indicator_target_triwulan_list');
    Route::get('/master/form_indicator_triwulan_target', 'MasterController@form_indicator_triwulan_target');
    Route::get('/master/edit/form_indicator_triwulan_target/{id}', 'MasterController@form_edit_indicator_triwulan_target');
    Route::post('/master/indicator_target_triwulan_save', 'MasterController@save_indicator_triwulan_target');
    Route::post('/master/indicator_target_triwulan_edit', 'MasterController@edit_indicator_triwulan_target');
    Route::get('/master/indicator_target_triwulan_delete/{id}', 'MasterController@delete_indicator_triwulan_target');

    // Master Sub Indicator
    Route::get('/master/sub_indicator_list', 'MasterController@sub_indicator_list');
    Route::get('/master/form_sub_indicator', 'MasterController@form_sub_indicator');
    Route::get('/master/edit/form_sub_indicator/{id}', 'MasterController@form_edit_sub_indicator');
    Route::post('/master/sub_indicator_save', 'MasterController@save_sub_indicator');
    Route::post('/master/sub_indicator_edit', 'MasterController@edit_sub_indicator');
    Route::get('/master/sub_indicator_delete/{id}', 'MasterController@delete_sub_indicator');

     // Master Orgnization Structure
     Route::get('/master/organization_structure', 'MasterController@organization_structure_list');
     Route::get('/master/organization_structurex', 'MasterController@organization_structure_listx');
     Route::get('/master/form_organization_structure', 'MasterController@form_organization_structure');
     Route::get('/master/form_organization_structurex', 'MasterController@form_organization_structurex');
     Route::get('/master/form_organization_structurefix', 'MasterController@form_organization_structurefix');
     Route::post('/master/organization_structure_save', 'MasterController@save_organization_structure');
     Route::get('/master/edit_organisasi_strukture/{id}', 'MasterController@edit_organization_structure');
     Route::post('/master/organization_structure_save_edit', 'MasterController@save_edit_organization_structure');
     Route::get('/master/status_organisasi_strukture/{id}', 'MasterController@form_status_organisasi_strukture');
     Route::post('/master/save_status_organisasi_strukture', 'MasterController@save_status_organisasi_strukture');
     Route::get('/master/getorganisasistrukture/{id}', 'MasterController@getorganisasistrukturebyid');
     Route::post('/master/approvaldvporganisasistrukture', 'MasterController@save_approvaldvporganisasistrukture');
     Route::post('/master/approvalvporganisasistrukture', 'MasterController@save_approvalvporganisasistrukture');
     Route::post('/master/kembalikanorganisasistrukture', 'MasterController@save_kembalikanorganisasistrukture');
     Route::get('/master/preview_organisasi_strukture/{id}', 'MasterController@preview_organisasistrukture');
     //Route::post('/master/organization_structure_delete/{ORGANIZATION_STRUCTURE_ID}', 'MasterController@delete_organization_structure');

     //Master Directorat
     Route::get('/master/list_directorate', 'MasterController@list_directorate');
     Route::get('/master/form_directorate', 'MasterController@form_list_directorate');
     Route::post('/master/list_directorate_save', 'MasterController@save_list_directorate');
     Route::get('/master/form_edit_directorate/{id}', 'MasterController@form_editdirectorate');
     Route::get('/master/form_status_directorate/{id}', 'MasterController@form_statusdirectorate');
     Route::get('/master/check-codedirectorat', 'MasterController@check_codedirectorat');
     Route::post('/master/save_directorate_edit', 'MasterController@save_edit_directorate');
     Route::post('/master/save_directorate_status', 'MasterController@save_status_directorate');

     //Master Branch Office
     Route::get('/master/list_branch_office', 'MasterController@list_branch_office');
     Route::get('/master/form_branchoffice', 'MasterController@form_branch_office');
     Route::get('/master/check-branchoffice_code', 'MasterController@check_branchoffice_code');
     Route::post('/master/list_branchoffice_save', 'MasterController@save_branchoffice');
     Route::get('/master/form_edit_branchoffice/{id}', 'MasterController@form_editbranchoffice');
     Route::get('/master/form_status_branchoffice/{id}', 'MasterController@form_statusbranchoffice');
     Route::post('/master/save_branchoffice_edit', 'MasterController@save_edit_branchoffice');
     Route::post('/master/save_branchoffice_status', 'MasterController@save_status_branchoffice');

     //Master Divisi
     Route::get('/master/list_divisi', 'MasterController@list_divisi');
     Route::get('/master/form_divisi', 'MasterController@form_divisi');
     Route::get('/master/check-division_code', 'MasterController@check_divisi_code');
     Route::post('/master/list_divisi_save', 'MasterController@save_divisi');
     Route::get('/master/form_edit_divisi/{id}', 'MasterController@form_editdivisi');
     Route::get('/master/form_status_divisi/{id}', 'MasterController@form_statusdivisi');
     Route::post('/master/save_divisi_edit', 'MasterController@save_edit_divisi');
     Route::post('/master/save_divisi_status', 'MasterController@save_status_divisi');

     //Master Subdivisi
     Route::get('/master/list_sub_divisi', 'MasterController@list_sub_divisi');
     Route::get('/master/form_subdivisi', 'MasterController@form_subdivisi');
     Route::get('/master/check-subdivision_code', 'MasterController@check_subdivisi_code');
     Route::post('/master/list_subdivisi_save', 'MasterController@save_subdivisi');
     Route::get('/master/form_edit_subdivisi/{id}', 'MasterController@form_editsubdivisi');
     Route::get('/master/form_status_subdivisi/{id}', 'MasterController@form_statussubdivisi');
     Route::post('/master/save_subdivisi_edit', 'MasterController@save_edit_subdivisi');
     Route::post('/master/save_subdivisi_status', 'MasterController@save_status_subdivisi');

     // Master User
     Route::get('/master/master_user', 'MasterController@master_user_list');
     Route::get('/master/edit/{id}', 'MasterController@edit_master_user');
     Route::get('/master/form_master_user', 'MasterController@form_master_user');
     Route::get('/master/status/{id}', 'MasterController@edit_status_master_user');
     Route::post('/master/master_user_save', 'MasterController@save_master_user');
     Route::post('/master/master_user_edit_save', 'MasterController@save_edit_master_user');
     Route::post('/master/master_user_edit_status_save', 'MasterController@save_edit_status_master_user');
     Route::get('/master/getmasteruser/{id}', 'MasterController@getmasteruserbyid');
     Route::post('/master/approvaldvpmaster', 'MasterController@save_approvaldvpmaster');
     Route::post('/master/approvalvpmaster', 'MasterController@save_approvalvpmaster');
     Route::post('/master/kembalikanmaster', 'MasterController@save_kembalikanmaster');
     Route::get('/master/preview/{id}', 'MasterController@preview_master_user');
     Route::get('/master/check-username', 'MasterController@check_master_user');

     Route::get('/logout', 'Auth\LoginController@logout');


    //PTKAK
    //PTKAK
    Route::get('/ptkaklist', 'PTKAKController@ptkak_list');
    Route::get('/ptkakadd/form_ptkak', 'PTKAKController@form_ptkak');
    Route::post('/ptkakadded/master_ptkak_save', 'PTKAKController@save_mst_ptkak');
    Route::get('/ptkak/master_form_edit/{id}', 'PTKAKController@form_edit_ptkak');
    Route::post('/ptkak/ptkakedited', 'PTKAKController@saveedit_ptkak');
    Route::post('/ptkkak/deletefile/{id}', 'PTKAKController@delete_file');
    Route::post('/ptkkak/deletedatamaster/{id}', 'PTKAKController@delete_ptkak');
    Route::get('/ptkakclose/close/{id}', 'PTKAKController@close_ptkak');
    Route::get('/ptkakclose/closemutu/{id}', 'PTKAKController@closemutu_ptkak');
    Route::get('/ptkak/master_form_preview/{id}', 'PTKAKController@form_preview_ptkak');
    Route::post('/ptkak/ptkakeditedclose', 'PTKAKController@saveedit_close');
    Route::post('/ptkak/ptkakeditedclosemutu', 'PTKAKController@saveedit_closemutu');
    Route::get('/ptkakfilter/{id}', 'PTKAKController@filter_ptkak');
    Route::get('/ptkak/master_form_reportptkak/{id}', 'PTKAKController@print_report_ptkak');


    //change password
    Route::post('/account/user_changepass', 'HomeController@save_edit_changepass');

    //Reportdata
    Route::get('/listexportdata/{ReportType}', 'ExportDataController@list_export_data');
    Route::get('/listexportmenu', 'ExportMenuController@list_export_menu');
    Route::post('/getgenerate', 'ExportDataController@getgenerate_piechart');
    Route::post('/getgenerateall', 'ExportDataController@getgenerate_piechartall');
    Route::post('/getgeneratebarchart', 'ExportDataController@getgenerate_barchart');
    Route::post('/getgeneratebarchartall', 'ExportDataController@getgenerate_barchartall');
    Route::post('/getgenerateptkak', 'ExportDataController@getgenerate_ptkak');
    Route::post('/getsubdivptkak', 'ExportDataController@getsubdiv_ptkak');
    Route::post('/getgeneratesop', 'ExportDataController@getgenerate_sop');
    Route::get('/form_list_export_data_excel', 'ExportDataController@list_export_data_excel');
    


    //tampildataviatable
    Route::post('/previewindikatorcabangpercabang', 'ExportDataController@previewindikatorcabangpercabangtabel');
    Route::post('/previewindikatordivisiperdivisi', 'ExportDataController@previewindikatordivisiperdivisi');

    //ReportExcel
    Route::get('/exportexcelindicatorpusat/{gabung}','ExportDataController@generateExcelIndicatorPusat');
    Route::get('/exportexcelindicatorcabang/{gabung}','ExportDataController@generateExcelIndicatorCabang');
    Route::get('/exportexcelindicatorpusattercapai/{gabung}','ExportDataController@generateExcelIndicatorPusatTercapai');
    Route::get('/exportexcelindicatorpusattidaktercapai/{gabung}','ExportDataController@generateExcelIndicatorCabangTidakTercapai');
    Route::get('/exportexcelindicatortercapaicabang/{gabung}','ExportDataController@generateExcelIndicatorTercapaiCabang');
    Route::get('/exportexcelindicatortidaktercapaicabang/{gabung}','ExportDataController@generateExcelIndicatorCabangTidakTercapai');
    Route::get('/exportexcelrealisasisasaranmutu/{gabung}','ExportDataController@generateExcelRealisasiSasaranMutu');
    Route::get('/exportexcelrealisasisasaranmutusampaidengan/{gabung}','ExportDataController@generateExcelRealisasiSasaranMutuSampaiDengan');
    Route::get('/exportexcelketepatanlaporan/{thn}','ExportDataController@generateExcelKetepatanLaporan');
    Route::get('/exportexcelStatSarmut/{thn}','ExportDataController@generateExcelStatSarmut');
    Route::get('/exportexcelcabangpercabang/{gabung}','ExportDataController@generateExcelCabangPerCabang');
    Route::get('/exportexceldivisiperdivisi/{gabung}','ExportDataController@generateExcelDivisiPerDivisi');
    Route::get('/exportexcelcabangbanten/{gabung}','ExportDataController@generateExcelCabangBanten');
    Route::get('/exportexcelcabangjambi/{gabung}','ExportDataController@generateExcelCabangJambi');
    Route::get('/exportexcelcabangtanjungpriok/{gabung}','ExportDataController@generateExcelCabangTanjungPriok');
    Route::get('/exportexcelcabangbengkulu/{gabung}','ExportDataController@generateExcelCabangBengkulu');
    Route::get('/exportexcelcabangpanjang/{gabung}','ExportDataController@generateExcelCabangPanjang');
    Route::get('/exportexcelcabangcirebon/{gabung}','ExportDataController@generateExcelCabangCirebon');
    Route::get('/exportexcelcabangpalembang/{gabung}','ExportDataController@generateExcelCabangPalembang');
    Route::get('/exportexcelcabangtelukbayur/{gabung}','ExportDataController@generateExcelCabangTelukBayur');
    Route::get('/exportexcelcabangpangkalbalam/{gabung}','ExportDataController@generateExcelCabangPangkalBalam');
    Route::get('/exportexcelcabangtanjungpandan/{gabung}','ExportDataController@generateExcelCabangTanjungPandan');
    Route::get('/exportexcelkpipusat/{gabung}','ExportDataController@generateexcelindikatorkpipusat');
    Route::get('/exportexcelkpicabang/{gabung}','ExportDataController@generateexcelindikatorkpicabang');
    Route::get('/exportexcelKinerjaCabang/{gabung}','ExportDataController@generateexcelKinerjaCabang');

    //Preview
    Route::post('/previewIndicatorPusat','ExportDataController@previewIndicatorPusat');
    Route::post('/previewIndicatorTercapaiPusat','ExportDataController@previewIndicatorTercapaiPusat');
    Route::post('/previewSasaranMutu','ExportDataController@previewSasaranMutu');
    Route::post('/previewSasaranMutuSD','ExportDataController@previewSasaranMutuSD');
    Route::post('/previewindikatorcabang','ExportDataController@previewindikatorcabang');
    Route::post('/previewindikatorcabangpercabang','ExportDataController@previewindikatorcabangpercabang');
    Route::post('/previewindikatorpusat','ExportDataController@previewindikatorpusat');
    Route::post('/previewtercapaipusat','ExportDataController@previewtercapaipusat');
    Route::post('/previewtidaktercapaipusat','ExportDataController@previewtidaktercapaipusat');
    Route::post('/previewtercapaicabang','ExportDataController@previewtercapaicabang');
    Route::post('/previewtidaktercapaicabang','ExportDataController@previewtidaktercapaicabang');
    Route::post('/previewketepatanlaporan','ExportDataController@previewketepatanlaporan');
    Route::post('/previewStatSarmut','ExportDataController@previewStatSarmut');
    Route::post('/previewdetailkategori','ExportDataController@previewdetailkategori');
    Route::post('/previewdetailkategorisd','ExportDataController@previewdetailkategorisd');
    Route::post('/previewdetailsop','ExportDataController@previewdetailsop');
    Route::post('/previewdetailptkak','ExportDataController@previewdetailptkak');
    Route::post('/previewdetailstatusptkak','ExportDataController@previewdetailstatusptkak');
    Route::get('/previewindikatorkpipusat','ExportDataController@previewindikatorkpipusat');
    Route::get('/previewindikatorkpicabang','ExportDataController@previewindikatorkpicabang');


 

    //test
    Route::get('testemail', function () {
        return view('email.contoh');
    });
    






});