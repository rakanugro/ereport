<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\Indicator_Target;
use App\Models\Sub_Indicator;
use App\Models\Period;
use App\Models\Sub_Division;
use App\Models\Master_TKP;
use App\Models\Det_TKP;
use App\Models\Sub_Det_TKP;
use App\Models\Head_TKP;
use App\Models\Main_Log;
use Auth;
use Session;
Use Alert;
use DateTime;
use DateTimeZone;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExportDataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
        // $this->middleware('auth');
    // }s

    public function master_menu(Request $request)
    {
        $now            = Carbon::now();
        // dd($indicator_list);
        
        return view('master.master', [
            'now'                   => $now,
        ]);
    }
    
    public function list_export_data(Request $request)
    {
        // $indicator_list = array();
        $directorat = \DB::table('tm_directorate')
        ->select('DIRECTORATE_ID', 'DIRECTORATE_NAME', 'IS_CABANG')
        ->where('ACTIVE', 'Y');
        $directorat_list = $directorat->get();

        $subdiv = \DB::table('tm_sub_division as a')
        ->leftJoin('tm_organization_structure as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->select('a.SUB_DIVISION_ID', 'a.SUB_DIVISION_NAME','b.ORGANIZATION_STRUCTURE_ID')
        ->distinct()
        ->where('a.ACTIVE', 'Y');
        $subdiv_list = $subdiv->get();

        $dirbranchlist = \DB::select("SELECT DISTINCT
            CASE

            WHEN
            a.division_id IS NOT NULL THEN
            a.Division_ID ELSE a.Branch_Office_ID 
            END AS DIVISI_BRANCH_ID,
            CASE

            WHEN a.division_id IS NOT NULL THEN
            Division_Name ELSE Branch_Office_Name 
            END AS DIVISI_BRANCH,
            CASE

            WHEN a.division_id IS NOT NULL THEN
            'Pusat' ELSE 'Cabang' 
            END AS keterangan 
            FROM
            tm_organization_structure a
            LEFT JOIN tm_division b ON a.DIVISION_ID = b.division_ID
            LEFT JOIN tm_branch_office c ON a.BRANCH_OFFICE_ID = c.BRANCH_OFFICE_ID");
        // dd($dirbranch);

        $indicator = \DB::table('tm_indicator as a')
        ->leftJoin('tm_sub_division as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->select('b.SUB_DIVISION_ID','b.SUB_DIVISION_NAME','a.INDICATOR_ID','a.INDICATOR_NAME')
        ->where('a.ACTIVE', 'Y')
        ->where('a.STATUS', '3');
        $indicator_list = $indicator->get();

        $now            = Carbon::now();


        $years = array(date('Y'),date('Y')-1);
        $year = '';
        $months = array("JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DES");
        $month = '';
        // dd($sasaranmutu_list);
        
        return view('exportdata.list_export_data', [
            'now'                   => $now,
            'directorat_list'   => $directorat_list,
            'subdiv_list' => $subdiv_list,
            'dirbranchlist'  => $dirbranchlist,
            'indicator_list' => $indicator_list,
            'years'     => $years,
            'year'     => $year,
            'months'     => $months,
            'month'     => $month
        ]);
    }

    public function getgenerate_piechart(Request $request)
    {
        $months = $request->months;
        $years = $request->years;
        //dd($request);
        $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM vw_Chart_Tercapai
            WHERE YEAR='$years' AND MONTH='$months'
            GROUP BY KETERANGAN");




        // dd($sasaranmutuall);
        return $data;
    }

    public function getgenerate_piechartall(Request $request)
    {
        $months = $request->months;
        $years = $request->years;

        // if($months == "JAN"){
        //     $months = ["JAN"];
        // }else if($months == "FEB"){
        //     $months = ["JAN", "FEB"];
        // }else if($months == "MAR"){
        //     $months = ["JAN", "FEB", "MAR"];
        // }else if($months == "APR"){
        //     $months = ["JAN", "FEB", "MAR","APR"];
        // }else if($months == "MAY"){
        //     $months = ["JAN", "FEB", "MAR","APR", "MAY"];
        // }
        // else if($months == "JUN"){
        //     $months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN"];
        // }
        // else if($months == "JUL"){
        //     $months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN","JUL"];
        // }
        // else if($months == "AUG"){
        //     $months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN","JUL", "AUG"];
        // }
        // else if($months == "SEP"){
        //     $months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN","JUL", "AUG", "SEP"];
        // }
        // else if($months == "OCT"){
        //     $months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN","JUL", "AUG", "SEP","OCT"];
        // }
        // else if($months == "NOV"){
        //     $months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN","JUL", "AUG", "SEP","OCT", "NOV"];
        // }
        // else if($months == "DEC"){
        //     $months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN","JUL", "AUG", "SEP","OCT", "NOV", "DEC"];
        // }

        $data = \DB::select("SELECT JUMLAH , KETERANGAN FROM vw_Chart_Tercapai_Sampai_Dengan
            WHERE YEAR = '$years' AND MONTH = '$months'");

        return $data;
    }

    public function getgenerate_barchart(Request $request)
    {
        $months = $request->months;
        $years = $request->years;
        //dd($request);
        $data = \DB::select("SELECT COUNT(*) AS JUMLAH , ALASAN FROM vw_Chart_Tercapai
            WHERE YEAR='$years' AND MONTH='$months' AND KETERANGAN='Tidak Tercapai'
            GROUP BY ALASAN");

        return $data;
    }

    public function getgenerate_barchartall(Request $request)
    {
        $months = $request->months;
        $years = $request->years;
        //dd($request);
        $data = \DB::select("SELECT YEAR,MONTH,JUMLAH,ALASAN FROM vw_Chart_Alasan_Tidak_Tercapai
            WHERE YEAR='$years' AND MONTH='$months'");

        return $data;
    }

    public function getgenerate_ptkak(Request $request)
    {
        //dd($request);
        $data = \DB::select("SELECT JUMLAH ,STATUS FROM vw_Report_PTKAK");

        return $data;
    }

    public function getgenerate_sop(Request $request)
    {
        $months = $request->months;
        $years = $request->years;
        //dd($request);
        $data = \DB::select("SELECT JUMLAH ,TYPE FROM vw_Report_SOP");




        // dd($sasaranmutuall);
        return $data;
    }

    public function list_export_data_excel(Request $request)
    {
        // $indicator_list = array();
        $directorat = \DB::table('tm_directorate')
        ->select('DIRECTORATE_ID', 'DIRECTORATE_NAME', 'IS_CABANG')
        ->where('ACTIVE', 'Y');
        $directorat_list = $directorat->get();

        $subdiv = \DB::table('tm_sub_division as a')
        ->leftJoin('tm_organization_structure as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->select('a.SUB_DIVISION_ID', 'a.SUB_DIVISION_NAME','b.ORGANIZATION_STRUCTURE_ID')
        ->distinct()
        ->where('a.ACTIVE', 'Y');
        $subdiv_list = $subdiv->get();


        $indicator = \DB::table('tm_indicator as a')
        ->leftJoin('tm_sub_division as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->select('b.SUB_DIVISION_ID','b.SUB_DIVISION_NAME','a.INDICATOR_ID','a.INDICATOR_NAME')
        ->where('a.ACTIVE', 'Y')
        ->where('a.STATUS', '3');
        $indicator_list = $indicator->get();

        $now            = Carbon::now();


        $years = array(date('Y'),date('Y')-1);
        $year = '';
        $months = array("JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DES");
        $month = '';
        // dd($sasaranmutu_list);
        
        return view('exportdata.list_export_data_excel', [
            'now'                   => $now,
            'directorat_list'   => $directorat_list,
            'subdiv_list' => $subdiv_list,
            'indicator_list' => $indicator_list,
            'years'     => $years,
            'year'     => $year,
            'months'     => $months,
            'month'     => $month,
        ]);
    }


        public function generateExcelIndicatorPusat($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $mdl = $pisah[1];

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $mdl) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $mdl) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Pusat Per ".$thn."");

                    $border = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => 'thin',
                                'color' => array('rgb' => '000000')
                            )
                        )
                    );
                    $sheet->mergeCells('B1:U1');
                    $sheet->getStyle('B1:U1')->getAlignment()->setHorizontal('center');
                    $sheet->cells('B1:U1', function($cells) {
                        $cells->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '20',
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $Line=3;


                    ++$Line;
                    $sheet->mergeCells('B3:B4');
                    $sheet->setCellValue('B3', 'No');
                    $sheet->setSize('B3', 5, 18);
                    $sheet->mergeCells('C3:C4');
                    $sheet->setCellValue('C3', 'Sub Divisi');
                    $sheet->setSize('C3', 25, 18);
                    $sheet->mergeCells('D3:D4');
                    $sheet->setCellValue('D3', 'Nama Indicator');
                    $sheet->setSize('D3', 20, 18);
                    $sheet->mergeCells('E3:E4');
                    $sheet->setCellValue('E3', 'Satuan');
                    $sheet->setSize('E3', 25, 18);
                    $sheet->mergeCells('F3:F4');
                    $sheet->setCellValue('F3', 'Polaritas');
                    $sheet->setSize('F3', 25, 18);
                    $sheet->mergeCells('G3:G4');
                    $sheet->setCellValue('G3', 'Target');
                    $sheet->setSize('G3', 20, 18);
                    $sheet->mergeCells('H3:S3');
                    $sheet->setCellValue('H3', 'Realisasi');
                    $sheet->setSize('H3', 25, 18);
                    $sheet->mergeCells('T3:T4');
                    $sheet->setCellValue('T3', 'Jumlah / Rata Rata');
                    $sheet->setSize('T3', 25, 18);
                    $sheet->mergeCells('U3:U4');
                    $sheet->setCellValue('U3', 'Hasil');
                    $sheet->setSize('U3', 25, 18);
                    $sheet->setCellValue('H4', 'JAN');
                    $sheet->setSize('H4', 25, 18);
                    $sheet->setCellValue('I4', 'FEB');
                    $sheet->setSize('I4', 10, 18);
                    $sheet->setCellValue('J4', 'MAR');
                    $sheet->setSize('J4', 25, 18);
                    $sheet->setCellValue('K4', 'APR');
                    $sheet->setSize('K4', 10, 18);
                    $sheet->setCellValue('L4', 'MAY');
                    $sheet->setSize('L4', 10, 18);
                    $sheet->setCellValue('M4', 'JUN');
                    $sheet->setSize('M4', 10, 18);
                    $sheet->setCellValue('N4', 'JUL');
                    $sheet->setSize('N4', 10, 18);
                    $sheet->setCellValue('O4', 'AUG');
                    $sheet->setSize('O4', 10, 18);
                    $sheet->setCellValue('P4', 'SEP');
                    $sheet->setSize('P4', 10, 18);
                    $sheet->setCellValue('Q4', 'OCT');
                    $sheet->setSize('Q4', 10, 18);
                    $sheet->setCellValue('R4', 'NOV');
                    $sheet->setSize('R4', 10, 18);
                    $sheet->setCellValue('S4', 'DES');
                    $sheet->setSize('S4', 10, 18);
                    $sheet->getStyle('B'. $Line . ':U' . $Line)->applyFromArray($border);
                    $sheet->getStyle('H4:S4')->applyFromArray($border);
                    $sheet->getStyle('B3:U3')->applyFromArray($border);
                    $sheet->getStyle('B'. $Line . ':U' . $Line)->getAlignment()->setHorizontal('Center');
                    $sheet->cells('B'. $Line . ':Z' . $Line, function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });
                    $sheet->cells('B3:U3', function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$thn', '$mdl')");
                    // dd($data);
                    $no=0;
                    foreach($data as $dataItem)
                    {
                        ++$no;
                        ++$Line;
                        $sheet->setCellValue('B'.$Line, $no);
                        $sheet->setSize('B'.$Line, 5, 18);
                        $sheet->setCellValue('C'.$Line, $dataItem->Sub_Division_Name);
                        $sheet->setSize('C'.$Line, 25, 18);
                        $sheet->setCellValue('D'.$Line, $dataItem->Indicator_Name);
                        $sheet->setSize('D'.$Line, 20, 18);
                        $sheet->setCellValue('E'.$Line, $dataItem->Satuan);
                        $sheet->setSize('E'.$Line, 25, 18);
                        $sheet->setCellValue('F'.$Line, $dataItem->Polaritas);
                        $sheet->setSize('F'.$Line, 25, 18);
                        $sheet->setCellValue('G'.$Line, $dataItem->Target);
                        $sheet->setSize('G'.$Line, 20, 18);
                        $sheet->setCellValue('H'.$Line, $dataItem->JAN);
                        $sheet->setSize('H'.$Line, 10, 18);
                        $sheet->setCellValue('I'.$Line, $dataItem->FEB);
                        $sheet->setSize('I'.$Line, 10, 18);
                        $sheet->setCellValue('J'.$Line, $dataItem->MAR);
                        $sheet->setSize('J'.$Line, 10, 18);
                        $sheet->setCellValue('K'.$Line, $dataItem->APR);
                        $sheet->setSize('K'.$Line, 10, 18);
                        $sheet->setCellValue('L'.$Line, $dataItem->MAY);
                        $sheet->setSize('L'.$Line, 10, 18);
                        $sheet->setCellValue('M'.$Line, $dataItem->JUN);
                        $sheet->setSize('M'.$Line, 10, 18);
                        $sheet->setCellValue('N'.$Line, $dataItem->JUL);
                        $sheet->setSize('N'.$Line, 10, 18);
                        $sheet->setCellValue('O'.$Line, $dataItem->AUG);
                        $sheet->setSize('O'.$Line, 10, 18);
                        $sheet->setCellValue('P'.$Line, $dataItem->SEP);
                        $sheet->setSize('P'.$Line, 10, 18);
                        $sheet->setCellValue('Q'.$Line, $dataItem->OCT);
                        $sheet->setSize('Q'.$Line, 10, 18);
                        $sheet->setCellValue('R'.$Line, $dataItem->NOV);
                        $sheet->setSize('R'.$Line, 10, 18);
                        $sheet->setCellValue('S'.$Line, $dataItem->DES);
                        $sheet->setSize('S'.$Line, 10, 18);
                        $sheet->setCellValue('T'.$Line, $dataItem->Sampai_Dengan);
                        $sheet->setSize('T'.$Line, 20, 18);
                        $sheet->setCellValue('U'.$Line, $dataItem->Hasil);
                        $sheet->setSize('U'.$Line, 20, 18);
                        $sheet->getStyle('B'. $Line . ':U' . $Line)->applyFromArray($border);
                        $sheet->getStyle('B'. $Line . ':U' . $Line)->getAlignment()->setHorizontal('Center');
                    }

                    ++$Line;

                });

    })->export('xls');

    }


    public function generateExcelIndicatorCabang($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $mdl = $pisah[1];

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $mdl) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $mdl) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang Per ".$thn."");

                    $border = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => 'thin',
                                'color' => array('rgb' => '000000')
                            )
                        )
                    );
                    $sheet->mergeCells('B1:U1');
                    $sheet->getStyle('B1:U1')->getAlignment()->setHorizontal('center');
                    $sheet->cells('B1:U1', function($cells) {
                        $cells->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '20',
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                     $Line=3;


                    ++$Line;
                    $sheet->mergeCells('B3:B4');
                    $sheet->setCellValue('B3', 'No');
                    $sheet->setSize('B3', 5, 18);
                    $sheet->mergeCells('C3:C4');
                    $sheet->setCellValue('C3', 'Sub Divisi');
                    $sheet->setSize('C3', 25, 18);
                    $sheet->mergeCells('D3:D4');
                    $sheet->setCellValue('D3', 'Nama Indicator');
                    $sheet->setSize('D3', 20, 18);
                    $sheet->mergeCells('E3:E4');
                    $sheet->setCellValue('E3', 'Satuan');
                    $sheet->setSize('E3', 25, 18);
                    $sheet->mergeCells('F3:F4');
                    $sheet->setCellValue('F3', 'Polaritas');
                    $sheet->setSize('F3', 25, 18);
                    $sheet->mergeCells('G3:G4');
                    $sheet->setCellValue('G3', 'Target');
                    $sheet->setSize('G3', 20, 18);
                    $sheet->mergeCells('H3:S3');
                    $sheet->setCellValue('H3', 'Realisasi');
                    $sheet->setSize('H3', 25, 18);
                    $sheet->mergeCells('T3:T4');
                    $sheet->setCellValue('T3', 'Jumlah / Rata Rata');
                    $sheet->setSize('T3', 25, 18);
                    $sheet->mergeCells('U3:U4');
                    $sheet->setCellValue('U3', 'Hasil');
                    $sheet->setSize('U3', 25, 18);
                    $sheet->setCellValue('H4', 'JAN');
                    $sheet->setSize('H4', 25, 18);
                    $sheet->setCellValue('I4', 'FEB');
                    $sheet->setSize('I4', 10, 18);
                    $sheet->setCellValue('J4', 'MAR');
                    $sheet->setSize('J4', 25, 18);
                    $sheet->setCellValue('K4', 'APR');
                    $sheet->setSize('K4', 10, 18);
                    $sheet->setCellValue('L4', 'MAY');
                    $sheet->setSize('L4', 10, 18);
                    $sheet->setCellValue('M4', 'JUN');
                    $sheet->setSize('M4', 10, 18);
                    $sheet->setCellValue('N4', 'JUL');
                    $sheet->setSize('N4', 10, 18);
                    $sheet->setCellValue('O4', 'AUG');
                    $sheet->setSize('O4', 10, 18);
                    $sheet->setCellValue('P4', 'SEP');
                    $sheet->setSize('P4', 10, 18);
                    $sheet->setCellValue('Q4', 'OCT');
                    $sheet->setSize('Q4', 10, 18);
                    $sheet->setCellValue('R4', 'NOV');
                    $sheet->setSize('R4', 10, 18);
                    $sheet->setCellValue('S4', 'DES');
                    $sheet->setSize('S4', 10, 18);
                    $sheet->getStyle('B'. $Line . ':U' . $Line)->applyFromArray($border);
                    $sheet->getStyle('H4:S4')->applyFromArray($border);
                    $sheet->getStyle('B3:U3')->applyFromArray($border);
                    $sheet->getStyle('B'. $Line . ':U' . $Line)->getAlignment()->setHorizontal('Center');
                    $sheet->cells('B'. $Line . ':Z' . $Line, function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });
                    $sheet->cells('B3:U3', function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$thn', '$mdl')");
                    // dd($data);
                    $no=0;
                    foreach($data as $dataItem)
                    {
                        ++$no;
                        ++$Line;
                        $sheet->setCellValue('B'.$Line, $no);
                        $sheet->setSize('B'.$Line, 5, 18);
                        $sheet->setCellValue('C'.$Line, $dataItem->Sub_Division_Name);
                        $sheet->setSize('C'.$Line, 25, 18);
                        $sheet->setCellValue('D'.$Line, $dataItem->Indicator_Name);
                        $sheet->setSize('D'.$Line, 20, 18);
                        $sheet->setCellValue('E'.$Line, $dataItem->Satuan);
                        $sheet->setSize('E'.$Line, 25, 18);
                        $sheet->setCellValue('F'.$Line, $dataItem->Polaritas);
                        $sheet->setSize('F'.$Line, 25, 18);
                        $sheet->setCellValue('G'.$Line, $dataItem->Target);
                        $sheet->setSize('G'.$Line, 20, 18);
                        $sheet->setCellValue('H'.$Line, $dataItem->JAN);
                        $sheet->setSize('H'.$Line, 10, 18);
                        $sheet->setCellValue('I'.$Line, $dataItem->FEB);
                        $sheet->setSize('I'.$Line, 10, 18);
                        $sheet->setCellValue('J'.$Line, $dataItem->MAR);
                        $sheet->setSize('J'.$Line, 10, 18);
                        $sheet->setCellValue('K'.$Line, $dataItem->APR);
                        $sheet->setSize('K'.$Line, 10, 18);
                        $sheet->setCellValue('L'.$Line, $dataItem->MAY);
                        $sheet->setSize('L'.$Line, 10, 18);
                        $sheet->setCellValue('M'.$Line, $dataItem->JUN);
                        $sheet->setSize('M'.$Line, 10, 18);
                        $sheet->setCellValue('N'.$Line, $dataItem->JUL);
                        $sheet->setSize('N'.$Line, 10, 18);
                        $sheet->setCellValue('O'.$Line, $dataItem->AUG);
                        $sheet->setSize('O'.$Line, 10, 18);
                        $sheet->setCellValue('P'.$Line, $dataItem->SEP);
                        $sheet->setSize('P'.$Line, 10, 18);
                        $sheet->setCellValue('Q'.$Line, $dataItem->OCT);
                        $sheet->setSize('Q'.$Line, 10, 18);
                        $sheet->setCellValue('R'.$Line, $dataItem->NOV);
                        $sheet->setSize('R'.$Line, 10, 18);
                        $sheet->setCellValue('S'.$Line, $dataItem->DES);
                        $sheet->setSize('S'.$Line, 10, 18);
                        $sheet->setCellValue('T'.$Line, $dataItem->Sampai_Dengan);
                        $sheet->setSize('T'.$Line, 20, 18);
                        $sheet->setCellValue('U'.$Line, $dataItem->Hasil);
                        $sheet->setSize('U'.$Line, 20, 18);
                        $sheet->getStyle('B'. $Line . ':U' . $Line)->applyFromArray($border);
                        $sheet->getStyle('B'. $Line . ':U' . $Line)->getAlignment()->setHorizontal('Center');
                    }

                    ++$Line;

                });

    })->export('xls');

    }


    public function generateExcelIndicatorPusatTercapai($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $mdl = $pisah[1];

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $mdl) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $mdl) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "Report Indicator Pusat Tercapai Per ".$thn."");

                    $border = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => 'thin',
                                'color' => array('rgb' => '000000')
                            )
                        )
                    );
                    $sheet->mergeCells('B1:U1');
                    $sheet->getStyle('B1:U1')->getAlignment()->setHorizontal('center');
                    $sheet->cells('B1:U1', function($cells) {
                        $cells->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '20',
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                     $Line=3;


                    ++$Line;
                    $sheet->mergeCells('B3:B4');
                    $sheet->setCellValue('B3', 'No');
                    $sheet->setSize('B3', 5, 18);
                    $sheet->mergeCells('C3:C4');
                    $sheet->setCellValue('C3', 'Sub Divisi');
                    $sheet->setSize('C3', 25, 18);
                    $sheet->mergeCells('D3:D4');
                    $sheet->setCellValue('D3', 'Nama Indicator');
                    $sheet->setSize('D3', 20, 18);
                    $sheet->mergeCells('E3:E4');
                    $sheet->setCellValue('E3', 'Satuan');
                    $sheet->setSize('E3', 25, 18);
                    $sheet->mergeCells('F3:F4');
                    $sheet->setCellValue('F3', 'Polaritas');
                    $sheet->setSize('F3', 25, 18);
                    $sheet->mergeCells('G3:G4');
                    $sheet->setCellValue('G3', 'Target');
                    $sheet->setSize('G3', 20, 18);
                    $sheet->mergeCells('H3:S3');
                    $sheet->setCellValue('H3', 'Realisasi');
                    $sheet->setSize('H3', 25, 18);
                    $sheet->mergeCells('T3:T4');
                    $sheet->setCellValue('T3', 'Jumlah / Rata Rata');
                    $sheet->setSize('T3', 25, 18);
                    $sheet->setCellValue('H4', 'JAN');
                    $sheet->setSize('H4', 25, 18);
                    $sheet->setCellValue('I4', 'FEB');
                    $sheet->setSize('I4', 10, 18);
                    $sheet->setCellValue('J4', 'MAR');
                    $sheet->setSize('J4', 25, 18);
                    $sheet->setCellValue('K4', 'APR');
                    $sheet->setSize('K4', 10, 18);
                    $sheet->setCellValue('L4', 'MAY');
                    $sheet->setSize('L4', 10, 18);
                    $sheet->setCellValue('M4', 'JUN');
                    $sheet->setSize('M4', 10, 18);
                    $sheet->setCellValue('N4', 'JUL');
                    $sheet->setSize('N4', 10, 18);
                    $sheet->setCellValue('O4', 'AUG');
                    $sheet->setSize('O4', 10, 18);
                    $sheet->setCellValue('P4', 'SEP');
                    $sheet->setSize('P4', 10, 18);
                    $sheet->setCellValue('Q4', 'OCT');
                    $sheet->setSize('Q4', 10, 18);
                    $sheet->setCellValue('R4', 'NOV');
                    $sheet->setSize('R4', 10, 18);
                    $sheet->setCellValue('S4', 'DES');
                    $sheet->setSize('S4', 10, 18);
                    $sheet->getStyle('B'. $Line . ':T' . $Line)->applyFromArray($border);
                    $sheet->getStyle('H4:S4')->applyFromArray($border);
                    $sheet->getStyle('B3:T3')->applyFromArray($border);
                    $sheet->getStyle('B'. $Line . ':T' . $Line)->getAlignment()->setHorizontal('Center');
                    $sheet->cells('B'. $Line . ':Z' . $Line, function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });
                    $sheet->cells('B3:T3', function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$thn', '$mdl')");
                    // dd($data);
                    $no=0;
                    foreach($data as $dataItem)
                    {
                        ++$no;
                        ++$Line;
                        $sheet->setCellValue('B'.$Line, $no);
                        $sheet->setSize('B'.$Line, 5, 18);
                        $sheet->setCellValue('C'.$Line, $dataItem->Sub_Division_Name);
                        $sheet->setSize('C'.$Line, 25, 18);
                        $sheet->setCellValue('D'.$Line, $dataItem->Indicator_Name);
                        $sheet->setSize('D'.$Line, 20, 18);
                        $sheet->setCellValue('E'.$Line, $dataItem->Satuan);
                        $sheet->setSize('E'.$Line, 25, 18);
                        $sheet->setCellValue('F'.$Line, $dataItem->Polaritas);
                        $sheet->setSize('F'.$Line, 25, 18);
                        $sheet->setCellValue('G'.$Line, $dataItem->Target);
                        $sheet->setSize('G'.$Line, 20, 18);
                        $sheet->setCellValue('H'.$Line, $dataItem->JAN);
                        $sheet->setSize('H'.$Line, 10, 18);
                        $sheet->setCellValue('I'.$Line, $dataItem->FEB);
                        $sheet->setSize('I'.$Line, 10, 18);
                        $sheet->setCellValue('J'.$Line, $dataItem->MAR);
                        $sheet->setSize('J'.$Line, 10, 18);
                        $sheet->setCellValue('K'.$Line, $dataItem->APR);
                        $sheet->setSize('K'.$Line, 10, 18);
                        $sheet->setCellValue('L'.$Line, $dataItem->MAY);
                        $sheet->setSize('L'.$Line, 10, 18);
                        $sheet->setCellValue('M'.$Line, $dataItem->JUN);
                        $sheet->setSize('M'.$Line, 10, 18);
                        $sheet->setCellValue('N'.$Line, $dataItem->JUL);
                        $sheet->setSize('N'.$Line, 10, 18);
                        $sheet->setCellValue('O'.$Line, $dataItem->AUG);
                        $sheet->setSize('O'.$Line, 10, 18);
                        $sheet->setCellValue('P'.$Line, $dataItem->SEP);
                        $sheet->setSize('P'.$Line, 10, 18);
                        $sheet->setCellValue('Q'.$Line, $dataItem->OCT);
                        $sheet->setSize('Q'.$Line, 10, 18);
                        $sheet->setCellValue('R'.$Line, $dataItem->NOV);
                        $sheet->setSize('R'.$Line, 10, 18);
                        $sheet->setCellValue('S'.$Line, $dataItem->DES);
                        $sheet->setSize('S'.$Line, 10, 18);
                        $sheet->setCellValue('T'.$Line, $dataItem->Sampai_Dengan);
                        $sheet->setSize('T'.$Line, 20, 18);
                        $sheet->getStyle('B'. $Line . ':T' . $Line)->applyFromArray($border);
                        $sheet->getStyle('B'. $Line . ':T' . $Line)->getAlignment()->setHorizontal('Center');
                    }

                    ++$Line;

                });

    })->export('xls');

    }

    public function generateExcelIndicatorPusatTidakTercapai($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $mdl = $pisah[1];

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $mdl) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $mdl) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "Report Indicator Pusat Tidak Tercapai Per ".$thn."");

                    $border = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => 'thin',
                                'color' => array('rgb' => '000000')
                            )
                        )
                    );
                    $sheet->mergeCells('B1:U1');
                    $sheet->getStyle('B1:U1')->getAlignment()->setHorizontal('center');
                    $sheet->cells('B1:U1', function($cells) {
                        $cells->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '20',
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $Line=3;


                    ++$Line;
                    $sheet->mergeCells('B3:B4');
                    $sheet->setCellValue('B3', 'No');
                    $sheet->setSize('B3', 5, 18);
                    $sheet->mergeCells('C3:C4');
                    $sheet->setCellValue('C3', 'Sub Divisi');
                    $sheet->setSize('C3', 25, 18);
                    $sheet->mergeCells('D3:D4');
                    $sheet->setCellValue('D3', 'Nama Indicator');
                    $sheet->setSize('D3', 20, 18);
                    $sheet->mergeCells('E3:E4');
                    $sheet->setCellValue('E3', 'Satuan');
                    $sheet->setSize('E3', 25, 18);
                    $sheet->mergeCells('F3:F4');
                    $sheet->setCellValue('F3', 'Polaritas');
                    $sheet->setSize('F3', 25, 18);
                    $sheet->mergeCells('G3:G4');
                    $sheet->setCellValue('G3', 'Target');
                    $sheet->setSize('G3', 20, 18);
                    $sheet->mergeCells('H3:S3');
                    $sheet->setCellValue('H3', 'Realisasi');
                    $sheet->setSize('H3', 25, 18);
                    $sheet->mergeCells('T3:T4');
                    $sheet->setCellValue('T3', 'Jumlah / Rata Rata');
                    $sheet->setSize('T3', 25, 18);
                    $sheet->setCellValue('H4', 'JAN');
                    $sheet->setSize('H4', 25, 18);
                    $sheet->setCellValue('I4', 'FEB');
                    $sheet->setSize('I4', 10, 18);
                    $sheet->setCellValue('J4', 'MAR');
                    $sheet->setSize('J4', 25, 18);
                    $sheet->setCellValue('K4', 'APR');
                    $sheet->setSize('K4', 10, 18);
                    $sheet->setCellValue('L4', 'MAY');
                    $sheet->setSize('L4', 10, 18);
                    $sheet->setCellValue('M4', 'JUN');
                    $sheet->setSize('M4', 10, 18);
                    $sheet->setCellValue('N4', 'JUL');
                    $sheet->setSize('N4', 10, 18);
                    $sheet->setCellValue('O4', 'AUG');
                    $sheet->setSize('O4', 10, 18);
                    $sheet->setCellValue('P4', 'SEP');
                    $sheet->setSize('P4', 10, 18);
                    $sheet->setCellValue('Q4', 'OCT');
                    $sheet->setSize('Q4', 10, 18);
                    $sheet->setCellValue('R4', 'NOV');
                    $sheet->setSize('R4', 10, 18);
                    $sheet->setCellValue('S4', 'DES');
                    $sheet->setSize('S4', 10, 18);
                    $sheet->getStyle('B'. $Line . ':T' . $Line)->applyFromArray($border);
                    $sheet->getStyle('H4:S4')->applyFromArray($border);
                    $sheet->getStyle('B3:T3')->applyFromArray($border);
                    $sheet->getStyle('B'. $Line . ':T' . $Line)->getAlignment()->setHorizontal('Center');
                    $sheet->cells('B'. $Line . ':Z' . $Line, function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });
                    $sheet->cells('B3:T3', function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$thn', '$mdl')");
                    // dd($data);
                    $no=0;
                    foreach($data as $dataItem)
                    {
                        ++$no;
                        ++$Line;
                        $sheet->setCellValue('B'.$Line, $no);
                        $sheet->setSize('B'.$Line, 5, 18);
                        $sheet->setCellValue('C'.$Line, $dataItem->Sub_Division_Name);
                        $sheet->setSize('C'.$Line, 25, 18);
                        $sheet->setCellValue('D'.$Line, $dataItem->Indicator_Name);
                        $sheet->setSize('D'.$Line, 20, 18);
                        $sheet->setCellValue('E'.$Line, $dataItem->Satuan);
                        $sheet->setSize('E'.$Line, 25, 18);
                        $sheet->setCellValue('F'.$Line, $dataItem->Polaritas);
                        $sheet->setSize('F'.$Line, 25, 18);
                        $sheet->setCellValue('G'.$Line, $dataItem->Target);
                        $sheet->setSize('G'.$Line, 20, 18);
                        $sheet->setCellValue('H'.$Line, $dataItem->JAN);
                        $sheet->setSize('H'.$Line, 10, 18);
                        $sheet->setCellValue('I'.$Line, $dataItem->FEB);
                        $sheet->setSize('I'.$Line, 10, 18);
                        $sheet->setCellValue('J'.$Line, $dataItem->MAR);
                        $sheet->setSize('J'.$Line, 10, 18);
                        $sheet->setCellValue('K'.$Line, $dataItem->APR);
                        $sheet->setSize('K'.$Line, 10, 18);
                        $sheet->setCellValue('L'.$Line, $dataItem->MAY);
                        $sheet->setSize('L'.$Line, 10, 18);
                        $sheet->setCellValue('M'.$Line, $dataItem->JUN);
                        $sheet->setSize('M'.$Line, 10, 18);
                        $sheet->setCellValue('N'.$Line, $dataItem->JUL);
                        $sheet->setSize('N'.$Line, 10, 18);
                        $sheet->setCellValue('O'.$Line, $dataItem->AUG);
                        $sheet->setSize('O'.$Line, 10, 18);
                        $sheet->setCellValue('P'.$Line, $dataItem->SEP);
                        $sheet->setSize('P'.$Line, 10, 18);
                        $sheet->setCellValue('Q'.$Line, $dataItem->OCT);
                        $sheet->setSize('Q'.$Line, 10, 18);
                        $sheet->setCellValue('R'.$Line, $dataItem->NOV);
                        $sheet->setSize('R'.$Line, 10, 18);
                        $sheet->setCellValue('S'.$Line, $dataItem->DES);
                        $sheet->setSize('S'.$Line, 10, 18);
                        $sheet->setCellValue('T'.$Line, $dataItem->Sampai_Dengan);
                        $sheet->setSize('T'.$Line, 20, 18);
                        $sheet->getStyle('B'. $Line . ':T' . $Line)->applyFromArray($border);
                        $sheet->getStyle('B'. $Line . ':T' . $Line)->getAlignment()->setHorizontal('Center');
                    }

                    ++$Line;

                });

    })->export('xls');

    }

     public function generateExcelRealisasiSasaranMutu($gabung)
        {

            $pisah = explode(',', $gabung);
            
            $bln = $pisah[0];
            $thn = $pisah[1];
            //dd($thn);

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $bln , $thn) {
                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $bln , $thn) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "Report Realisasi Sasaran Mutu Per ".$bln." " .$thn."");

                    $border = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => 'thin',
                                'color' => array('rgb' => '000000')
                            )
                        )
                    );
                    $sheet->mergeCells('B1:I1');
                    $sheet->getStyle('B1:I1')->getAlignment()->setHorizontal('center');
                    $sheet->cells('B1:I1', function($cells) {
                        $cells->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '20',
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $Line=2;

                    ++$Line;
                    
                    $sheet->setCellValue('B'.$Line, 'No');
                    $sheet->setSize('B'.$Line, 5, 18);
                    $sheet->setCellValue('C'.$Line, 'Divisi');
                    $sheet->setSize('C'.$Line, 25, 18);
                    $sheet->setCellValue('D'.$Line, 'Sub Divisi');
                    $sheet->setSize('D'.$Line, 20, 18);
                    $sheet->setCellValue('E'.$Line, 'Indikator Tercapai(%)');
                    $sheet->setSize('E'.$Line, 25, 18);
                    $sheet->setCellValue('F'.$Line, 'Indikator Tidak tercapai(%)');
                    $sheet->setSize('F'.$Line, 25, 18);
                    $sheet->setCellValue('G'.$Line, 'Data Kurang(%)');
                    $sheet->setSize('G'.$Line, 20, 18);
                    $sheet->setCellValue('H'.$Line, 'Belum Diukur(%)');
                    $sheet->setSize('H'.$Line, 20, 18);
                    $sheet->setCellValue('I'.$Line, 'Ketepatan Laporan');
                    $sheet->setSize('I'.$Line, 30, 18);
                    $sheet->getStyle('B'. $Line . ':I' . $Line)->applyFromArray($border);
                    $sheet->getStyle('B'. $Line . ':I' . $Line)->getAlignment()->setHorizontal('Center');
                    $sheet->cells('B'. $Line . ':Z' . $Line, function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $data = \DB::select("CALL SP_Report_Realisasi_Sasaran_Mutu('$idusr', '$bln', '$thn')");

                    $no=0;
                    foreach($data as $dataItem)
                    {
                        ++$no;
                        ++$Line;
                        $sheet->setCellValue('B'.$Line, $no);
                        $sheet->setSize('B'.$Line, 5, 18);
                        $sheet->setCellValue('C'.$Line, $dataItem->Division_Name);
                        $sheet->setSize('C'.$Line, 25, 18);
                        $sheet->setCellValue('D'.$Line, $dataItem->Sub_Division_Name);
                        $sheet->setSize('D'.$Line, 20, 18);
                        $sheet->setCellValue('E'.$Line, $dataItem->Tercapai_Percent);
                        $sheet->setSize('E'.$Line, 25, 18);
                        $sheet->setCellValue('F'.$Line, $dataItem->Tidak_Tercapai_Percent);
                        $sheet->setSize('F'.$Line, 25, 18);
                        $sheet->setCellValue('G'.$Line, $dataItem->Data_Kurang_Percent);
                        $sheet->setSize('G'.$Line, 20, 18);
                        $sheet->setCellValue('H'.$Line, $dataItem->Belum_Diukur_Percent);
                        $sheet->setSize('H'.$Line, 20, 18);
                        $sheet->setCellValue('I'.$Line, $dataItem->Ketepatan_Laporan);
                        $sheet->setSize('I'.$Line, 30, 18);
                        $sheet->getStyle('B'. $Line . ':I' . $Line)->applyFromArray($border);
                        $sheet->getStyle('B'. $Line . ':I' . $Line)->getAlignment()->setHorizontal('Center');
                         if($dataItem->Ketepatan_Laporan == 'Terlambat')
                        {
                            $sheet->setCellValue('I'.$Line);
                            $sheet->setSize('I'.$Line, 20, 18);
                            $sheet->cells('I'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->Ketepatan_Laporan == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('I'.$Line);
                            $sheet->setSize('I'.$Line, 20, 18);
                            $sheet->cells('I'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                    }

                    ++$Line;

                });

    })->export('xls');

    }

    public function generateExcelRealisasiSasaranMutuSampaiDengan($gabung)
        {

            $pisah = explode(',', $gabung);
            
            $bln = $pisah[0];
            $thn = $pisah[1];
            //dd($thn);

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $bln , $thn) {
                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $bln , $thn) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "Report Realisasi Sasaran Mutu Sampai Dengan Per ".$bln." " .$thn."");

                    $border = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => 'thin',
                                'color' => array('rgb' => '000000')
                            )
                        )
                    );
                    $sheet->mergeCells('B1:H1');
                    $sheet->getStyle('B1:H1')->getAlignment()->setHorizontal('center');
                    $sheet->cells('B1:H1', function($cells) {
                        $cells->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '20',
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $Line=2;

                    ++$Line;
                    
                    $sheet->setCellValue('B'.$Line, 'No');
                    $sheet->setSize('B'.$Line, 5, 18);
                    $sheet->setCellValue('C'.$Line, 'Divisi');
                    $sheet->setSize('C'.$Line, 25, 18);
                    $sheet->setCellValue('D'.$Line, 'Sub Divisi');
                    $sheet->setSize('D'.$Line, 20, 18);
                    $sheet->setCellValue('E'.$Line, 'Indikator Tercapai(%)');
                    $sheet->setSize('E'.$Line, 25, 18);
                    $sheet->setCellValue('F'.$Line, 'Indikator Tidak tercapai(%)');
                    $sheet->setSize('F'.$Line, 25, 18);
                    $sheet->setCellValue('G'.$Line, 'Data Kurang(%)');
                    $sheet->setSize('G'.$Line, 20, 18);
                    $sheet->setCellValue('H'.$Line, 'Belum Diukur(%)');
                    $sheet->setSize('H'.$Line, 20, 18);
                    $sheet->getStyle('B'. $Line . ':H' . $Line)->applyFromArray($border);
                    $sheet->getStyle('B'. $Line . ':H' . $Line)->getAlignment()->setHorizontal('Center');
                    $sheet->cells('B'. $Line . ':Z' . $Line, function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $data = \DB::select("CALL SP_Report_Realisasi_Sasaran_Mutu_SD('$idusr', '$bln', '$thn')");

                    $no=0;
                    foreach($data as $dataItem)
                    {
                        ++$no;
                        ++$Line;
                        $sheet->setCellValue('B'.$Line, $no);
                        $sheet->setSize('B'.$Line, 5, 18);
                        $sheet->setCellValue('C'.$Line, $dataItem->Division_Name);
                        $sheet->setSize('C'.$Line, 25, 18);
                        $sheet->setCellValue('D'.$Line, $dataItem->Sub_Division_Name);
                        $sheet->setSize('D'.$Line, 20, 18);
                        $sheet->setCellValue('E'.$Line, $dataItem->Tercapai_Percent);
                        $sheet->setSize('E'.$Line, 25, 18);
                        $sheet->setCellValue('F'.$Line, $dataItem->Tidak_Tercapai_Percent);
                        $sheet->setSize('F'.$Line, 25, 18);
                        $sheet->setCellValue('G'.$Line, $dataItem->Data_Kurang_Percent);
                        $sheet->setSize('G'.$Line, 20, 18);
                        $sheet->setCellValue('H'.$Line, $dataItem->Belum_Diukur_Percent);
                        $sheet->setSize('H'.$Line, 20, 18);
                        $sheet->getStyle('B'. $Line . ':H' . $Line)->applyFromArray($border);
                        $sheet->getStyle('B'. $Line . ':H' . $Line)->getAlignment()->setHorizontal('Center');
                    }

                    ++$Line;

                });

    })->export('xls');

    }

    public function generateExcelKetepatanLaporan($thn)
        {

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Ketepatan Laporan Per ".$thn."");

                    $border = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => 'thin',
                                'color' => array('rgb' => '000000')
                            )
                        )
                    );
                    $sheet->mergeCells('B1:U1');
                    $sheet->getStyle('B1:U1')->getAlignment()->setHorizontal('center');
                    $sheet->cells('B1:U1', function($cells) {
                        $cells->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '20',
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $Line=3;


                    ++$Line;
                    $sheet->mergeCells('B3:B4');
                    $sheet->setCellValue('B3', 'No');
                    $sheet->setSize('B3', 5, 18);
                    $sheet->mergeCells('C3:C4');
                    $sheet->setCellValue('C3', 'Divisi');
                    $sheet->setSize('C3', 40, 18);
                    $sheet->mergeCells('D3:D4');
                    $sheet->setCellValue('D3', 'Sub Divisi');
                    $sheet->setSize('D3', 40, 18);
                    $sheet->mergeCells('E3:P3');
                    $sheet->setCellValue('E3', 'Realisasi');
                    $sheet->setSize('E3', 25, 18);
                    $sheet->setCellValue('E4', 'JAN');
                    $sheet->setSize('E4', 20, 18);
                    $sheet->setCellValue('F4', 'FEB');
                    $sheet->setSize('F4', 20, 18);
                    $sheet->setCellValue('G4', 'MAR');
                    $sheet->setSize('G4', 20, 18);
                    $sheet->setCellValue('H4', 'APR');
                    $sheet->setSize('H4', 20, 18);
                    $sheet->setCellValue('I4', 'MAY');
                    $sheet->setSize('I4', 20, 18);
                    $sheet->setCellValue('J4', 'JUN');
                    $sheet->setSize('J4', 20, 18);
                    $sheet->setCellValue('K4', 'JUL');
                    $sheet->setSize('K4', 20, 18);
                    $sheet->setCellValue('L4', 'AUG');
                    $sheet->setSize('L4', 20, 18);
                    $sheet->setCellValue('M4', 'SEP');
                    $sheet->setSize('M4', 20, 18);
                    $sheet->setCellValue('N4', 'OCT');
                    $sheet->setSize('N4', 20, 18);
                    $sheet->setCellValue('O4', 'NOV');
                    $sheet->setSize('O4', 20, 18);
                    $sheet->setCellValue('P4', 'DES');
                    $sheet->setSize('P4', 20, 18);
                    $sheet->getStyle('B'. $Line . ':P' . $Line)->applyFromArray($border);
                    $sheet->getStyle('E4:P4')->applyFromArray($border);
                    $sheet->getStyle('B3:P3')->applyFromArray($border);
                    $sheet->getStyle('B'. $Line . ':P' . $Line)->getAlignment()->setHorizontal('Center');
                    $sheet->cells('B'. $Line . ':Z' . $Line, function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });
                    $sheet->cells('B3:U3', function($cells) {
                        $cells->setFont(array(
                            'bold'       =>  true
                        ));
                        $cells->setAlignment('center');
                    });

                    $data = \DB::select("CALL SP_Report_Ketepatan_Laporan('$idusr', '$thn')");
                    // dd($data);
                    $no=0;
                    foreach($data as $dataItem)
                    {
                        ++$no;
                        ++$Line;
                        $sheet->setCellValue('B'.$Line, $no);
                        $sheet->setSize('B'.$Line, 5, 18);
                        $sheet->setCellValue('C'.$Line, $dataItem->Division_Name);
                        $sheet->setSize('C'.$Line, 40, 18);
                        $sheet->setCellValue('D'.$Line, $dataItem->Sub_Division_Name);
                        $sheet->setSize('D'.$Line, 40, 18);
                        if($dataItem->JAN == 'Terlambat')
                        {
                            $sheet->setCellValue('E'.$Line);
                            $sheet->setSize('E'.$Line, 20, 18);
                            $sheet->cells('E'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->JAN == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('E'.$Line);
                            $sheet->setSize('E'.$Line, 20, 18);
                            $sheet->cells('E'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        else if($dataItem->FEB == 'Terlambat')
                        {
                            $sheet->setCellValue('F'.$Line);
                            $sheet->setSize('F'.$Line, 20, 18);
                            $sheet->cells('F'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->FEB == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('F'.$Line);
                            $sheet->setSize('F'.$Line, 20, 18);
                            $sheet->cells('F'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        else if($dataItem->MAR == 'Terlambat')
                        {
                            $sheet->setCellValue('G'.$Line);
                            $sheet->setSize('G'.$Line, 20, 18);
                            $sheet->cells('G'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->MAR == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('G'.$Line);
                            $sheet->setSize('G'.$Line, 20, 18);
                            $sheet->cells('G'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        else if($dataItem->APR == 'Terlambat')
                        {
                            $sheet->setCellValue('H'.$Line);
                            $sheet->setSize('H'.$Line, 20, 18);
                            $sheet->cells('H'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->APR == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('H'.$Line);
                            $sheet->setSize('H'.$Line, 20, 18);
                            $sheet->cells('H'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        else if($dataItem->MAY == 'Terlambat')
                        {
                            $sheet->setCellValue('I'.$Line);
                            $sheet->setSize('I'.$Line, 20, 18);
                            $sheet->cells('I'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->MAY == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('I'.$Line);
                            $sheet->setSize('I'.$Line, 20, 18);
                            $sheet->cells('I'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        else if($dataItem->JUN == 'Terlambat')
                        {
                            $sheet->setCellValue('J'.$Line);
                            $sheet->setSize('J'.$Line, 20, 18);
                            $sheet->cells('J'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->JUN == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('J'.$Line);
                            $sheet->setSize('J'.$Line, 20, 18);
                            $sheet->cells('J'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        else if($dataItem->JUL == 'Terlambat')
                        {
                            $sheet->setCellValue('K'.$Line);
                            $sheet->setSize('K'.$Line, 20, 18);
                            $sheet->cells('K'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->JUL == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('K'.$Line);
                            $sheet->setSize('K'.$Line, 20, 18);
                            $sheet->cells('K'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        else if($dataItem->AUG == 'Terlambat')
                        {
                            $sheet->setCellValue('L'.$Line);
                            $sheet->setSize('L'.$Line, 20, 18);
                            $sheet->cells('L'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->AUG == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('L'.$Line);
                            $sheet->setSize('L'.$Line, 20, 18);
                            $sheet->cells('L'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        else if($dataItem->SEP == 'Terlambat')
                        {
                            $sheet->setCellValue('M'.$Line);
                            $sheet->setSize('M'.$Line, 20, 18);
                            $sheet->cells('M'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->SEP == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('M'.$Line);
                            $sheet->setSize('M'.$Line, 20, 18);
                            $sheet->cells('M'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        else if($dataItem->OCT == 'Terlambat')
                        {
                            $sheet->setCellValue('N'.$Line);
                            $sheet->setSize('N'.$Line, 20, 18);
                            $sheet->cells('N'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->OCT == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('N'.$Line);
                            $sheet->setSize('N'.$Line, 20, 18);
                            $sheet->cells('N'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        else if($dataItem->NOV == 'Terlambat')
                        {
                            $sheet->setCellValue('O'.$Line);
                            $sheet->setSize('O'.$Line, 20, 18);
                            $sheet->cells('O'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->NOV == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('O'.$Line);
                            $sheet->setSize('O'.$Line, 20, 18);
                            $sheet->cells('O'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        else if($dataItem->DES == 'Terlambat')
                        {
                            $sheet->setCellValue('P'.$Line);
                            $sheet->setSize('P'.$Line, 20, 18);
                            $sheet->cells('P'. $Line, function($cells) {
                                $cells->setBackground('#ff0000');
                            });
                        }
                        else if($dataItem->DES == 'Tepat Waktu')
                        {
                            $sheet->setCellValue('P'.$Line);
                            $sheet->setSize('P'.$Line, 20, 18);
                            $sheet->cells('P'. $Line, function($cells) {
                                $cells->setBackground('#00ff3b');
                            });
                        }
                        
                        $sheet->getStyle('B'. $Line . ':P' . $Line)->applyFromArray($border);
                        $sheet->getStyle('B'. $Line . ':P' . $Line)->getAlignment()->setHorizontal('Center');
                    }

                    ++$Line;

                });

    })->export('xls');

    }

}
