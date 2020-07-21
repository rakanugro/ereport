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
    
    public function list_export_data($ReportType,Request $request)
    {
        $months = array("JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DES");
        $month = '';
        $years = array(date('Y'),date('Y')-1);
        $year = '';

        if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
            $dir = \DB::table('tm_directorate')
            ->select('DIRECTORATE_ID', 'DIRECTORATE_NAME', 'IS_CABANG')
            ->where('ACTIVE', 'Y');

            $branch = \DB::table('tm_branch_office as t')
            ->select('t.BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
            ->where('t.ACTIVE', 'Y');

            $divisi = \DB::table('tm_division as t')
            ->select('t.DIVISION_ID', 'DIVISION_NAME')
            ->where('t.ACTIVE', 'Y');

            $subdivisi_list = "";
        }
        else
        {
            $dir = \DB::table('tm_directorate as t')
            ->leftJoin('tm_organization_structure as o', 't.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
            ->select('t.DIRECTORATE_ID', 'DIRECTORATE_NAME', 'IS_CABANG')
            ->where('o.organization_structure_id','=',Auth::user()->ORG_ID)
            ->where('t.ACTIVE', 'Y');

            $branch = \DB::table('tm_branch_office as t')
            ->leftJoin('tm_organization_structure as o', 't.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
            ->select('t.BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
            ->where('o.organization_structure_id','=',Auth::user()->ORG_ID)
            ->where('t.ACTIVE', 'Y');

            $divisi = \DB::table('tm_division as t')
            ->leftJoin('tm_organization_structure as o', 't.DIVISION_ID', '=' , 'o.DIVISION_ID')
            ->select('t.DIVISION_ID', 'DIVISION_NAME')
            ->where('o.organization_structure_id','=',Auth::user()->ORG_ID)
            ->where('t.ACTIVE', 'Y');

            if(Auth::user()->ACCESS == 'ADMIN SUB DIVISI' || Auth::user()->ACCESS == 'DVP SUB DIVISI')
            {
                $subdivisi = \DB::table('tm_sub_division as t')
                ->leftJoin('tm_organization_structure as o', 't.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                ->select('t.SUB_DIVISION_ID', 'SUB_DIVISION_NAME')
                ->where('o.organization_structure_id','=',Auth::user()->ORG_ID)
                ->where('t.ACTIVE', 'Y');
            }
            else
            {
                $UserDiv_List = \DB::table('tm_organization_structure')
                ->select('DIVISION_ID')
                ->where('organization_structure_id','=',Auth::user()->ORG_ID)
                ->where('ACTIVE', 'Y');
                $UserDiv=$UserDiv_List->get()->toArray();
                //dd($UserDiv[0]->DIVISION_ID);
                $subdivisi = \DB::table('tm_sub_division as t')
                ->leftJoin('tm_organization_structure as o', 't.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                ->select('t.SUB_DIVISION_ID', 'SUB_DIVISION_NAME')
                ->where('o.DIVISION_ID','=',$UserDiv[0]->DIVISION_ID)
                ->where('t.ACTIVE', 'Y');
            }
            $subdivisi_list = $subdivisi->get()->toArray();
        }
        $dir_list = $dir->get()->toArray();
        $branch_list = $branch->get()->toArray();
        $divisi_list = $divisi->get()->toArray();

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
        
        return view('exportdata.list_export_data', [
            'ReportType'    =>$ReportType,
            'dir_list' =>$dir_list,
            'divisi_list' =>$divisi_list,
            'branch_list' => $branch_list,
            'subdivisi_list' => $subdivisi_list,
            'now'   => $now,
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
        $dir = $request->dir;
        $divcab = $request->divcab;
        $subdiv = $request->subdiv;

        //dd($request);
        $QueryRealisasi="SELECT b.YEAR AS YEAR,b.MONTH AS MONTH,DIRECTORATE_NAME,CASE WHEN ISNULL(e.DIVISION_NAME) THEN z.BRANCH_OFFICE_NAME ELSE e.DIVISION_NAME END AS DivisiOrBranch,f.SUB_DIVISION_NAME AS Sub_Division_Name,a.INDICATOR_ID AS Indicator_ID,g.INDICATOR_NAME AS Indicator_Name,g.POLARITAS AS Polaritas,a.ACTUAL_REALISASI AS Actual_Realisasi,a.ALASAN AS Alasan,a.KETERANGAN AS Temp_Keterangan,b.updated_at AS Tanggal_Laporan
        FROM tx_det_sasaran_mutu a
        JOIN tm_indicator g ON a.INDICATOR_ID = g.INDICATOR_ID 
        JOIN tx_header_sasaran_mutu b ON a.HEADER_SASARAN_MUTU_ID = b.HEADER_SASARAN_MUTU_ID
        JOIN tm_organization_structure c ON b.ORGANIZATION_STRUCTURE_ID = c.ORGANIZATION_STRUCTURE_ID
        JOIN tm_directorate di on c.DIRECTORATE_ID=di.DIRECTORATE_ID
        LEFT JOIN tm_division e ON c.DIVISION_ID = e.DIVISION_ID
        LEFT JOIN tm_branch_office z ON c.BRANCH_OFFICE_ID = z.BRANCH_OFFICE_ID
        JOIN tm_sub_division f ON c.SUB_DIVISION_ID = f.SUB_DIVISION_ID
        WHERE b.STATUS = 3 AND b.YEAR='".$years."' AND b.Month='".$months."'";

        $UnionQuery="SELECT a.Year AS YEAR,a.Month AS MONTH,DIRECTORATE_NAME,a.DivisiOrBranch AS DivisiOrBranch,a.Sub_Division_Name AS Sub_Division_Name,a.Indicator_ID AS Indicator_ID,a.Indicator_Name AS Indicator_Name,a.Polaritas AS Polaritas,a.Actual_Realisasi AS Actual_Realisasi,a.Alasan AS Alasan, CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END AS Temp_Keterangan,a.Tanggal_Laporan AS Tanggal_Laporan,b.TARGET AS target, CASE WHEN a.Polaritas = '+' THEN CASE WHEN a.Temp_Keterangan = '-' THEN CASE WHEN a.Actual_Realisasi - b.TARGET >= 0 THEN 'Tercapai' ELSE 'Tidak Tercapai' END ELSE CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END END ELSE CASE WHEN a.Temp_Keterangan = '-' THEN CASE WHEN a.Actual_Realisasi - b.TARGET <= 0 THEN 'Tercapai' ELSE 'Tidak Tercapai' END ELSE CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END END END AS KETERANGAN
        FROM vw_Target_Bulanan  b
        JOIN (".$QueryRealisasi.") a ON a.Indicator_ID = b.Indicator_ID AND a.Month = b.MONTH AND a.Year = b.YEAR
        WHERE a.Year='".$years."' AND a.Month='".$months."'";

        //$Query="SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
        //GROUP BY KETERANGAN";
        //dd($Query);
        if($dir == "All")
        {
             $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
             GROUP BY KETERANGAN");
             return $data;
        }
        else
        {
            if($divcab == "All")
            {
                $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
                WHERE DIRECTORATE_NAME='".$dir."'
                GROUP BY KETERANGAN");
                return $data;
            }
            else
            {
                if($subdiv == "All")
                {
                    $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
                    WHERE DIRECTORATE_NAME='".$dir."'
                    and DivisiOrBranch='".$divcab."'
                    GROUP BY KETERANGAN");
                    return $data;
                }
                else
                {
                    $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
                    WHERE DIRECTORATE_NAME='".$dir."'
                    and DivisiOrBranch='".$divcab."'
                    and Sub_Division_Name='".$subdiv."'
                    GROUP BY KETERANGAN");
                    return $data;
                }
            }
        }
        // dd($sasaranmutuall);
    }

    public function getgenerate_piechartall(Request $request)
    {
        $months = $request->months;
        $years = $request->years;
        $dir = $request->dir;
        $divcab = $request->divcab;
        $subdiv = $request->subdiv;

        if($months == "JAN"){
            $months = "'JAN'";
        }else if($months == "FEB"){
            $months = "'JAN', 'FEB'";
        }else if($months == "MAR"){
            $months = "'JAN', 'FEB', 'MAR'";
        }else if($months == "APR"){
            $months = "'JAN', 'FEB', 'MAR','APR'";
        }else if($months == "MAY"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY'";
        }
        else if($months == "JUN"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN'";
        }
        else if($months == "JUL"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL'";
        }
        else if($months == "AUG"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL', 'AUG'";
        }
        else if($months == "SEP"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL', 'AUG', 'SEP'";
        }
        else if($months == "OCT"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL', 'AUG', 'SEP','OCT'";
        }
        else if($months == "NOV"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL', 'AUG', 'SEP','OCT', 'NOV'";
        }
        else if($months == "DES"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL', 'AUG', 'SEP','OCT', 'NOV', 'DES'";
        }

        $QueryRealisasi="SELECT b.YEAR AS YEAR,b.MONTH AS MONTH,DIRECTORATE_NAME,CASE WHEN ISNULL(e.DIVISION_NAME) THEN z.BRANCH_OFFICE_NAME ELSE e.DIVISION_NAME END AS DivisiOrBranch,f.SUB_DIVISION_NAME AS Sub_Division_Name,a.INDICATOR_ID AS Indicator_ID,g.INDICATOR_NAME AS Indicator_Name,g.POLARITAS AS Polaritas,a.ACTUAL_REALISASI AS Actual_Realisasi,a.ALASAN AS Alasan,a.KETERANGAN AS Temp_Keterangan,b.updated_at AS Tanggal_Laporan
        FROM tx_det_sasaran_mutu a
        JOIN tm_indicator g ON a.INDICATOR_ID = g.INDICATOR_ID 
        JOIN tx_header_sasaran_mutu b ON a.HEADER_SASARAN_MUTU_ID = b.HEADER_SASARAN_MUTU_ID
        JOIN tm_organization_structure c ON b.ORGANIZATION_STRUCTURE_ID = c.ORGANIZATION_STRUCTURE_ID
        JOIN tm_directorate di on c.DIRECTORATE_ID=di.DIRECTORATE_ID
        LEFT JOIN tm_division e ON c.DIVISION_ID = e.DIVISION_ID
        LEFT JOIN tm_branch_office z ON c.BRANCH_OFFICE_ID = z.BRANCH_OFFICE_ID
        JOIN tm_sub_division f ON c.SUB_DIVISION_ID = f.SUB_DIVISION_ID
        WHERE b.STATUS = 3 AND b.YEAR='".$years."' AND b.Month in (".$months.")";

        $UnionQuery="SELECT a.Year AS YEAR,a.Month AS MONTH,DIRECTORATE_NAME,a.DivisiOrBranch AS DivisiOrBranch,a.Sub_Division_Name AS Sub_Division_Name,a.Indicator_ID AS Indicator_ID,a.Indicator_Name AS Indicator_Name,a.Polaritas AS Polaritas,a.Actual_Realisasi AS Actual_Realisasi,a.Alasan AS Alasan, CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END AS Temp_Keterangan,a.Tanggal_Laporan AS Tanggal_Laporan,b.TARGET AS target, CASE WHEN a.Polaritas = '+' THEN CASE WHEN a.Temp_Keterangan = '-' THEN CASE WHEN a.Actual_Realisasi - b.TARGET >= 0 THEN 'Tercapai' ELSE 'Tidak Tercapai' END ELSE CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END END ELSE CASE WHEN a.Temp_Keterangan = '-' THEN CASE WHEN a.Actual_Realisasi - b.TARGET <= 0 THEN 'Tercapai' ELSE 'Tidak Tercapai' END ELSE CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END END END AS KETERANGAN
        FROM vw_Target_Bulanan  b
        JOIN (".$QueryRealisasi.") a ON a.Indicator_ID = b.Indicator_ID AND a.Month = b.MONTH AND a.Year = b.YEAR
        WHERE a.Year='".$years."' AND a.Month in (".$months.")";

        //$Query="SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
        //GROUP BY KETERANGAN";
        //dd($Query);
        if($dir == "All")
        {
             $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
             GROUP BY KETERANGAN");
             return $data;
        }
        else
        {
            if($divcab == "All")
            {
                $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
                WHERE DIRECTORATE_NAME='".$dir."'
                GROUP BY KETERANGAN");
                return $data;
            }
            else
            {
                if($subdiv == "All")
                {
                    $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
                    WHERE DIRECTORATE_NAME='".$dir."'
                    and DivisiOrBranch='".$divcab."'
                    GROUP BY KETERANGAN");
                    return $data;
                }
                else
                {
                    $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
                    WHERE DIRECTORATE_NAME='".$dir."'
                    and DivisiOrBranch='".$divcab."'
                    and Sub_Division_Name='".$subdiv."'
                    GROUP BY KETERANGAN");
                    return $data;
                }
            }
        }
    }

    public function getgenerate_barchart(Request $request)
    {
        $months = $request->months;
        $years = $request->years;
        $dir = $request->dir;
        $divcab = $request->divcab;
        $subdiv = $request->subdiv;
        //dd($request);
        
        $QueryRealisasi="SELECT b.YEAR AS YEAR,b.MONTH AS MONTH,DIRECTORATE_NAME,CASE WHEN ISNULL(e.DIVISION_NAME) THEN z.BRANCH_OFFICE_NAME ELSE e.DIVISION_NAME END AS DivisiOrBranch,f.SUB_DIVISION_NAME AS Sub_Division_Name,a.INDICATOR_ID AS Indicator_ID,g.INDICATOR_NAME AS Indicator_Name,g.POLARITAS AS Polaritas,a.ACTUAL_REALISASI AS Actual_Realisasi,a.ALASAN AS Alasan,a.KETERANGAN AS Temp_Keterangan,b.updated_at AS Tanggal_Laporan
        FROM tx_det_sasaran_mutu a
        JOIN tm_indicator g ON a.INDICATOR_ID = g.INDICATOR_ID 
        JOIN tx_header_sasaran_mutu b ON a.HEADER_SASARAN_MUTU_ID = b.HEADER_SASARAN_MUTU_ID
        JOIN tm_organization_structure c ON b.ORGANIZATION_STRUCTURE_ID = c.ORGANIZATION_STRUCTURE_ID
        JOIN tm_directorate di on c.DIRECTORATE_ID=di.DIRECTORATE_ID
        LEFT JOIN tm_division e ON c.DIVISION_ID = e.DIVISION_ID
        LEFT JOIN tm_branch_office z ON c.BRANCH_OFFICE_ID = z.BRANCH_OFFICE_ID
        JOIN tm_sub_division f ON c.SUB_DIVISION_ID = f.SUB_DIVISION_ID
        WHERE b.STATUS = 3 AND b.YEAR='".$years."' AND b.Month='".$months."'";

        $UnionQuery="SELECT a.Year AS YEAR,a.Month AS MONTH,DIRECTORATE_NAME,a.DivisiOrBranch AS DivisiOrBranch,a.Sub_Division_Name AS Sub_Division_Name,a.Indicator_ID AS Indicator_ID,a.Indicator_Name AS Indicator_Name,a.Polaritas AS Polaritas,a.Actual_Realisasi AS Actual_Realisasi,a.Alasan AS Alasan, CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END AS Temp_Keterangan,a.Tanggal_Laporan AS Tanggal_Laporan,b.TARGET AS target, CASE WHEN a.Polaritas = '+' THEN CASE WHEN a.Temp_Keterangan = '-' THEN CASE WHEN a.Actual_Realisasi - b.TARGET >= 0 THEN 'Tercapai' ELSE 'Tidak Tercapai' END ELSE CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END END ELSE CASE WHEN a.Temp_Keterangan = '-' THEN CASE WHEN a.Actual_Realisasi - b.TARGET <= 0 THEN 'Tercapai' ELSE 'Tidak Tercapai' END ELSE CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END END END AS KETERANGAN
        FROM vw_Target_Bulanan  b
        JOIN (".$QueryRealisasi.") a ON a.Indicator_ID = b.Indicator_ID AND a.Month = b.MONTH AND a.Year = b.YEAR
        WHERE a.Year='".$years."' AND a.Month='".$months."'";

        //$Query="SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
        //GROUP BY KETERANGAN";
        //dd($Query);
        if($dir == "All")
        {
             $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,ALASAN FROM (".$UnionQuery.") as a 
             WHERE KETERANGAN='Tidak Tercapai'
             GROUP BY ALASAN");
             return $data;
        }
        else
        {
            if($divcab == "All")
            {
                $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,ALASAN FROM (".$UnionQuery.") as a 
                WHERE DIRECTORATE_NAME='".$dir."'
                and KETERANGAN='Tidak Tercapai'
                GROUP BY ALASAN");
                return $data;
            }
            else
            {
                if($subdiv == "All")
                {
                    $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,ALASAN FROM (".$UnionQuery.") as a 
                    WHERE DIRECTORATE_NAME='".$dir."'
                    and DivisiOrBranch='".$divcab."'
                    and KETERANGAN='Tidak Tercapai'
                    GROUP BY ALASAN");
                    return $data;
                }
                else
                {
                    $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,ALASAN FROM (".$UnionQuery.") as a 
                    WHERE DIRECTORATE_NAME='".$dir."'
                    and DivisiOrBranch='".$divcab."'
                    and Sub_Division_Name='".$subdiv."'
                    and KETERANGAN='Tidak Tercapai'
                    GROUP BY ALASAN");
                    return $data;
                }
            }
        }
    }

    public function getgenerate_barchartall(Request $request)
    {
        $months = $request->months;
        $years = $request->years;
        $dir = $request->dir;
        $divcab = $request->divcab;
        $subdiv = $request->subdiv;

        if($months == "JAN"){
            $months = "'JAN'";
        }else if($months == "FEB"){
            $months = "'JAN', 'FEB'";
        }else if($months == "MAR"){
            $months = "'JAN', 'FEB', 'MAR'";
        }else if($months == "APR"){
            $months = "'JAN', 'FEB', 'MAR','APR'";
        }else if($months == "MAY"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY'";
        }
        else if($months == "JUN"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN'";
        }
        else if($months == "JUL"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL'";
        }
        else if($months == "AUG"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL', 'AUG'";
        }
        else if($months == "SEP"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL', 'AUG', 'SEP'";
        }
        else if($months == "OCT"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL', 'AUG', 'SEP','OCT'";
        }
        else if($months == "NOV"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL', 'AUG', 'SEP','OCT', 'NOV'";
        }
        else if($months == "DES"){
            $months = "'JAN', 'FEB', 'MAR','APR', 'MAY', 'JUN','JUL', 'AUG', 'SEP','OCT', 'NOV', 'DES'";
        }

        $QueryRealisasi="SELECT b.YEAR AS YEAR,b.MONTH AS MONTH,DIRECTORATE_NAME,CASE WHEN ISNULL(e.DIVISION_NAME) THEN z.BRANCH_OFFICE_NAME ELSE e.DIVISION_NAME END AS DivisiOrBranch,f.SUB_DIVISION_NAME AS Sub_Division_Name,a.INDICATOR_ID AS Indicator_ID,g.INDICATOR_NAME AS Indicator_Name,g.POLARITAS AS Polaritas,a.ACTUAL_REALISASI AS Actual_Realisasi,a.ALASAN AS Alasan,a.KETERANGAN AS Temp_Keterangan,b.updated_at AS Tanggal_Laporan
        FROM tx_det_sasaran_mutu a
        JOIN tm_indicator g ON a.INDICATOR_ID = g.INDICATOR_ID 
        JOIN tx_header_sasaran_mutu b ON a.HEADER_SASARAN_MUTU_ID = b.HEADER_SASARAN_MUTU_ID
        JOIN tm_organization_structure c ON b.ORGANIZATION_STRUCTURE_ID = c.ORGANIZATION_STRUCTURE_ID
        JOIN tm_directorate di on c.DIRECTORATE_ID=di.DIRECTORATE_ID
        LEFT JOIN tm_division e ON c.DIVISION_ID = e.DIVISION_ID
        LEFT JOIN tm_branch_office z ON c.BRANCH_OFFICE_ID = z.BRANCH_OFFICE_ID
        JOIN tm_sub_division f ON c.SUB_DIVISION_ID = f.SUB_DIVISION_ID
        WHERE b.STATUS = 3 AND b.YEAR='".$years."' AND b.Month in (".$months.")";

        $UnionQuery="SELECT a.Year AS YEAR,a.Month AS MONTH,DIRECTORATE_NAME,a.DivisiOrBranch AS DivisiOrBranch,a.Sub_Division_Name AS Sub_Division_Name,a.Indicator_ID AS Indicator_ID,a.Indicator_Name AS Indicator_Name,a.Polaritas AS Polaritas,a.Actual_Realisasi AS Actual_Realisasi,a.Alasan AS Alasan, CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END AS Temp_Keterangan,a.Tanggal_Laporan AS Tanggal_Laporan,b.TARGET AS target, CASE WHEN a.Polaritas = '+' THEN CASE WHEN a.Temp_Keterangan = '-' THEN CASE WHEN a.Actual_Realisasi - b.TARGET >= 0 THEN 'Tercapai' ELSE 'Tidak Tercapai' END ELSE CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END END ELSE CASE WHEN a.Temp_Keterangan = '-' THEN CASE WHEN a.Actual_Realisasi - b.TARGET <= 0 THEN 'Tercapai' ELSE 'Tidak Tercapai' END ELSE CASE WHEN a.Temp_Keterangan = 'Tidak Ada Kegiatan' THEN 'Not Available' ELSE a.Temp_Keterangan END END END AS KETERANGAN
        FROM vw_Target_Bulanan  b
        JOIN (".$QueryRealisasi.") a ON a.Indicator_ID = b.Indicator_ID AND a.Month = b.MONTH AND a.Year = b.YEAR
        WHERE a.Year='".$years."' AND a.Month in (".$months.")";

        //$Query="SELECT COUNT(*) AS JUMLAH ,KETERANGAN FROM (".$UnionQuery.") as a 
        //GROUP BY KETERANGAN";
        //dd($Query);
        if($dir == "All")
        {
             $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,ALASAN FROM (".$UnionQuery.") as a 
             WHERE KETERANGAN='Tidak Tercapai'
             GROUP BY ALASAN");
             return $data;
        }
        else
        {
            if($divcab == "All")
            {
                $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,ALASAN FROM (".$UnionQuery.") as a 
                WHERE DIRECTORATE_NAME='".$dir."'
                and KETERANGAN='Tidak Tercapai'
                GROUP BY ALASAN");
                return $data;
            }
            else
            {
                if($subdiv == "All")
                {
                    $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,ALASAN FROM (".$UnionQuery.") as a 
                    WHERE DIRECTORATE_NAME='".$dir."'
                    and DivisiOrBranch='".$divcab."'
                    and KETERANGAN='Tidak Tercapai'
                    GROUP BY ALASAN");
                    return $data;
                }
                else
                {
                    $data = \DB::select("SELECT COUNT(*) AS JUMLAH ,ALASAN FROM (".$UnionQuery.") as a 
                    WHERE DIRECTORATE_NAME='".$dir."'
                    and DivisiOrBranch='".$divcab."'
                    and Sub_Division_Name='".$subdiv."'
                    and KETERANGAN='Tidak Tercapai'
                    GROUP BY ALASAN");
                    return $data;
                }
            }
        }
    }

    public function getgenerate_ptkak(Request $request)
    {
        //dd($request);
        $data = \DB::select("SELECT JUMLAH ,STATUS FROM vw_Report_PTKAK");

        return $data;
    }
    public function getsubdiv_ptkak(Request $request)
    {
        //dd($request);
        $data = \DB::select("SELECT COUNT(*) AS JUMLAH,SUB_DIVISION_NAME AS SUBDIV FROM tx_ptkak a
        JOIN tm_organization_structure b ON a.CREATED_ORG_ID=b.ORGANIZATION_STRUCTURE_ID
        JOIN tm_sub_division c ON b.SUB_DIVISION_ID=c.SUB_DIVISION_ID
        GROUP BY SUB_DIVISION_NAME");

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

        $branch = \DB::table('tm_branch_office a')
        ->leftJoin('tm_organization_structure as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->leftJoin('tm_sub_division as c', 'c.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->select('a.BRANCH_OFFICE_ID, a.BRANCH_OFFICE_NAME, c.SUB_DIVISION_ID, c.SUB_DIVISION_NAME, b.ORGANIZATION_STRUCTURE_ID')
        ->from('tm_branch_office a')
        ->distinct()
        ->where('a.ACTIVE', 'Y');
        $branch_list = $branch->get();

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
                    //dd($idusr);
                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$thn', '$mdl')");
                    //dd($mdl);
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
            //dd($mdl);
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
    public function generateExcelIndicatorCabangTidakTercapai($gabung)
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


                $sheet->setCellValueByColumnAndRow(1, 1, "Report Indicator Cabang Tidak Tercapai Per ".$thn."");

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
    public function generateExcelStatSarmut($thn)
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


                $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Status Sarmut Per ".$thn."");
                //dd($thn);
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

                $data = \DB::select("CALL SP_Report_Status_Sarmut('$idusr', '$thn')");
                // dd($data);
                $no=0;
                foreach($data as $dataItem)
                {
                    //dd($data);
                    ++$no;
                    ++$Line;
                    $sheet->setCellValue('B'.$Line, $no);
                    $sheet->setSize('B'.$Line, 5, 18);
                    $sheet->setCellValue('C'.$Line, $dataItem->Division_Name);
                    $sheet->setSize('C'.$Line, 40, 18);
                    $sheet->setCellValue('D'.$Line, $dataItem->Sub_Division_Name);
                    $sheet->setSize('D'.$Line, 40, 18);
                    $sheet->setCellValue('E'.$Line,$dataItem->JAN );
                    $sheet->setSize('E'.$Line, 20, 18);
                    $sheet->setCellValue('F'.$Line,$dataItem->FEB );
                    $sheet->setSize('F'.$Line, 20, 18);
                    $sheet->setCellValue('G'.$Line,$dataItem->MAR );
                    $sheet->setSize('G'.$Line, 20, 18);
                    $sheet->setCellValue('H'.$Line,$dataItem->APR );
                    $sheet->setSize('H'.$Line, 20, 18);
                    $sheet->setCellValue('I'.$Line,$dataItem->MAY );
                    $sheet->setSize('I'.$Line, 20, 18);
                    $sheet->setCellValue('J'.$Line,$dataItem->JUN );
                    $sheet->setSize('J'.$Line, 20, 18);
                    $sheet->setCellValue('K'.$Line,$dataItem->JUL );
                    $sheet->setSize('K'.$Line, 20, 18);
                    $sheet->setCellValue('L'.$Line,$dataItem->AUG );
                    $sheet->setSize('L'.$Line, 20, 18);
                    $sheet->setCellValue('M'.$Line,$dataItem->SEP );
                    $sheet->setSize('M'.$Line, 20, 18);
                    $sheet->setCellValue('N'.$Line,$dataItem->OCT );
                    $sheet->setSize('N'.$Line, 20, 18);
                    $sheet->setCellValue('O'.$Line,$dataItem->NOV );
                    $sheet->setSize('O'.$Line, 20, 18);
                    $sheet->setCellValue('P'.$Line,$dataItem->DES );
                    $sheet->setSize('P'.$Line, 20, 18);
                    
                    $sheet->getStyle('B'. $Line . ':P' . $Line)->applyFromArray($border);
                    $sheet->getStyle('B'. $Line . ':P' . $Line)->getAlignment()->setHorizontal('Center');
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
                        //dd($data);
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
                        if($dataItem->FEB == 'Terlambat')
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
                        if($dataItem->MAR == 'Terlambat')
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
                        if($dataItem->APR == 'Terlambat')
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
                        if($dataItem->MAY == 'Terlambat')
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
                        if($dataItem->JUN == 'Terlambat')
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
                        if($dataItem->JUL == 'Terlambat')
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
                        if($dataItem->AUG == 'Terlambat')
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
                        if($dataItem->SEP == 'Terlambat')
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
                        if($dataItem->OCT == 'Terlambat')
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
                        if($dataItem->NOV == 'Terlambat')
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
                        if($dataItem->DES == 'Terlambat')
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
    public function generateExcelDivisiPerDivisi($gabung)
    {
        $pisah = explode(',', $gabung);
        
        $thn = $pisah[0];
        $subdiv = $pisah[1];

        $idusr = Auth::user()->ID;

        $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

        $datenow = date('d-m-Y H:i:s');

        $fileExcel = 'Laporandata_PerDivisi'.$datenow;
        
        // Generate and return the spreadsheet
        Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Payments');
            $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Divisi ".$subdiv." Per ".$thn."");

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

                $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '','$subdiv')");
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

    public function generateExcelCabangPerCabang($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $subdiv = $pisah[1];

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_CabangPercabang'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang ".$subdiv." Per ".$thn."");

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

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '$subdiv','')");
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

    public function generateExcelCabangBanten($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $subdiv = 'Banten';

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang Banten Per ".$thn."");

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

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '$subdiv')");
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


    public function generateExcelCabangJambi($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $subdiv = 'Jambi';

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang Jambi Per ".$thn."");

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

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '$subdiv')");
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

         public function generateExcelCabangTanjungPriok($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $subdiv = 'TanjungPriok';

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang Tanjung Priok Per ".$thn."");

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

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '$subdiv')");
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

         public function generateExcelCabangBengkulu($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $subdiv = 'Bengkulu';

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang Bengkulu Per ".$thn."");

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

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '$subdiv')");
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

         public function generateExcelCabangPanjang($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $subdiv = 'Panjang';

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang Panjang Per ".$thn."");

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

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '$subdiv')");
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

         public function generateExcelCabangCirebon($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $subdiv = 'Cirebon';

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang Cirebon Per ".$thn."");

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

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '$subdiv')");
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

         public function generateExcelCabangPalembang($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $subdiv = 'Palembang';

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang Palembang Per ".$thn."");

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

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '$subdiv')");
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

         public function generateExcelCabangTelukBayur($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $subdiv = 'TelukBayur';

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang Teluk Bayur Per ".$thn."");

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

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '$subdiv')");
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

        public function generateExcelCabangPangkalBalam($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $subdiv = 'PangkalBalam';

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang Pangkal Balam Per ".$thn."");

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

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '$subdiv')");
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

        public function generateExcelCabangTanjungPandan($gabung)
        {
            $pisah = explode(',', $gabung);
            
            $thn = $pisah[0];
            $subdiv = 'TanjungPandan';

            $idusr = Auth::user()->ID;

            $date = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $datenow = date('d-m-Y H:i:s');

            $fileExcel = 'Laporandata_'.$datenow;
            
            // Generate and return the spreadsheet
            Excel::create($fileExcel, function($excel) use($idusr , $thn , $subdiv) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Payments');
                $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
                $excel->setDescription('payments file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use($idusr , $thn , $subdiv) {


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Cabang Tanjung Pandan Per ".$thn."");

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

                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$thn', '$subdiv')");
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

        public function generateExcelIndicatorTercapaiCabang($gabung)
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


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Indicator Tercapai Cabang ".$thn."");

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
                    //dd($idusr);
                    $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$thn', '$mdl')");
                    //$data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$years', 'Report Tercapai Cabang')");
                    //dd($mdl);
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

    public function generateExcelKinerjaCabang($gabung)
        {
            $pisah = explode(',', $gabung);
        
            $thn = $pisah[0];
            $mdl = $pisah[1];
            //dd($mdl);
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


                    $sheet->setCellValueByColumnAndRow(1, 1, "LAPORAN Report Kinerja Cabang Per ".$thn."");

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
                    $sheet->setCellValue('F3', 'Standar Dirjenla');
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

    public function previewIndicatorPusat(Request $request)
        {
            $thn = $request->thn;
            $mdl = $request->mdl;

            $idusr = Auth::user()->ID;
            $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$thn', '$mdl')");

            return $data;
        
        }

    public function previewIndicatorTercapaiPusat(Request $request)
        {
            $thn = $request->thn;
            $mdl = $request->mdl;

            $idusr = Auth::user()->ID;
            $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$thn', '$mdl')");

            return $data;
        
        }

    public function previewSasaranMutu(Request $request)
        {
            $thn = $request->thn;
            $mdl = $request->mdl;
            $bln = $request->bln;

            $idusr = Auth::user()->ID;
            $data = \DB::select("CALL SP_Report_Realisasi_Sasaran_Mutu('$idusr', '$bln', '$thn')");

            return $data;
        
        }

    public function previewSasaranMutuSD(Request $request)
        {
            $thn = $request->thn;
            $mdl = $request->mdl;
            $bln = $request->bln;

            $idusr = Auth::user()->ID;
            $data = \DB::select("CALL SP_Report_Realisasi_Sasaran_Mutu_SD('$idusr', '$bln', '$thn')");

            return $data;
        
        }

    public function previewindikatorcabang(Request $request)
    {
        //dd($request);
       //$bln = $request->months;
       $thn = $request->years;
       $cbg = $request->cabang;

       $idusr = Auth::user()->ID;
       $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$thn', 'Report Indicator Cabang')");

       return $data;
    }

    public function previewindikatorcabangpercabang(Request $request)
    {
            // $cbg = $request->cabang;
        $years = $request->years;
        $cabang = $request->cabang;

        $idusr = Auth::user()->ID;
        $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$years', '$cabang','')");

        return $data;
        
    }
    public function previewindikatordivisiperdivisi(Request $request)
    {
            // $cbg = $request->cabang;
        $years = $request->years;
        $divisi = $request->divisi;

        $idusr = Auth::user()->ID;
        $data = \DB::select("CALL SP_Report_Sasaran_Mutu_Per_Cabang('$idusr', '$years', '', '$divisi')");

        return $data;
        
    }

    public function previewindikatorpusat(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;

        $idusr = Auth::user()->ID;
        $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$years', 'Report Indicator Pusat')");

        return $data;
        
        }

    public function previewtercapaipusat(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;
        $cabang = $request->cabang;

        $idusr = Auth::user()->ID;
        $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$years', 'Report Indicator Tercapai Pusat')");

        return $data;
        
        }

    public function previewtidaktercapaipusat(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;
        $cabang = $request->cabang;

        $idusr = Auth::user()->ID;
        $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$years', 'Report Indicator Tidak Tercapai Pusat')");

        return $data;
        
        }

    public function previewtercapaicabang(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;
        $cabang = $request->cabang;

        $idusr = Auth::user()->ID;
        $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$years', 'Report Tercapai Cabang')");

        return $data;
        
        }

    public function previewtidaktercapaicabang(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;

        $idusr = Auth::user()->ID;
        $data = \DB::select("CALL SP_Report_Sasaran_Mutu('$idusr', '$years', 'Report Tidak Tercapai Cabang')");

        return $data;
        
        }

        public function previewStatSarmut(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;

        $idusr = Auth::user()->ID;
        $data = \DB::select("CALL SP_Report_Status_Sarmut('$idusr', '$years')");
        return $data;
        
        }

        public function previewketepatanlaporan(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;

        $idusr = Auth::user()->ID;
        $data = \DB::select("CALL SP_Report_Ketepatan_Laporan('$idusr', '$years')");

        return $data;
        
        }

        public function previewdetailkategori(Request $request)
        {
        //$cbg = $request->cabang;
        $years = $request->years;
        $months = $request->months;

        $idusr = Auth::user()->ID;
        $data = \DB::select("CALL SP_Report_Realisasi_Sasaran_Mutu('$idusr', '$months', '$years')");

        return $data;
        
        }

        public function previewdetailkategorisd(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;
        $months = $request->months;

        $idusr = Auth::user()->ID;
        $data = \DB::select("CALL SP_Report_Realisasi_Sasaran_Mutu_SD('$idusr', '$months', '$years')");

        return $data;
        
        }

        public function previewdetailsop(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;
        $months = $request->months;

        $idusr = Auth::user()->ID;
        $data = \DB::select("SELECT JUMLAH , KETERANGAN FROM vw_Chart_Tercapai_Sampai_Dengan
            WHERE YEAR = '$years' AND MONTH = '$months'");

        return $data;
        
        }


        public function previewdetailptkak(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;
        $months = $request->months;

        $idusr = Auth::user()->ID;
        $data = \DB::select("SELECT JUMLAH , KETERANGAN FROM vw_Chart_Tercapai_Sampai_Dengan
            WHERE YEAR = '$years' AND MONTH = '$months'");

        return $data;
        
        }

        public function previewdetailstatusptkak(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;
        $months = $request->months;

        $idusr = Auth::user()->ID;
        $data = \DB::select("SELECT JUMLAH , KETERANGAN FROM vw_Chart_Tercapai_Sampai_Dengan
            WHERE YEAR = '$years' AND MONTH = '$months'");

        return $data;
        
        }

        public function previewdetailUtiCabang(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;
        $months = $request->months;

        $idusr = Auth::user()->ID;
        $data = \DB::select("SELECT JUMLAH , KETERANGAN FROM vw_Chart_Tercapai_Sampai_Dengan
            WHERE YEAR = '$years' AND MONTH = '$months'");

        return $data;
        
        }

         public function previewdetailKinerjaCabang(Request $request)
        {
            // $cbg = $request->cabang;
        $years = $request->years;
        $months = $request->months;

        $idusr = Auth::user()->ID;
        $data = \DB::select("SELECT JUMLAH , KETERANGAN FROM vw_Chart_Tercapai_Sampai_Dengan
            WHERE YEAR = '$years' AND MONTH = '$months'");

        return $data;
        
        }

        public function previewindikatorkpipusat(Request $request)
        {
            //dd($request);
            $years = $request->years;
            $triwulan = $request->period;

            $idusr = Auth::user()->ID;
            $data = \DB::select("SELECT * FROM vw_Report_KPI where YEAR = '$years' and period = '$triwulan' AND pusat_cabang = 'Pusat' ORDER BY perspective,indicator_name asc");

            return $data;
        
        }
        public function generateexcelindikatorkpipusat(Request $request)
        {
            //dd($request);
            $years = $request->years;
            $triwulan = $request->period;

            $idusr = Auth::user()->ID;
            $data = \DB::select("SELECT * FROM vw_Report_KPI where YEAR = '$years' and period = '$triwulan' AND pusat_cabang = 'Pusat' ORDER BY perspective,indicator_name asc");

            return $data;
        
        }
        public function previewindikatorkpicabang(Request $request)
        {
            //dd($request);
            $years = $request->years;
            $triwulan = $request->period;
            $cbg = $request->cabang;
            
            $idusr = Auth::user()->ID;
            $data = \DB::select("SELECT * FROM vw_Report_KPI where YEAR = '$years' and period = '$triwulan' AND pusat_cabang = '$cbg' ORDER BY perspective,indicator_name asc");

            return $data;
        
        }
        public function previewketepatankonsolidasi(Request $request)
        {
            //dd($request);
            $years = $request->years;
            /*$triwulan = $request->period;
            $cbg = $request->cabang;*/
            
            $idusr = Auth::user()->ID;
            $data = \DB::select("CALL SP_Report_Realisasi_Sasaran_Mutu('$idusr', '$years')");

            return $data;
        
        }
}
