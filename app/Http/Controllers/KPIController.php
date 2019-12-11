<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\Indicator_Target;
use App\Models\Sub_Indicator;
use App\Models\Period;
use App\Models\Sub_Division;
use App\Models\Master_KPI;
use App\Models\Det_KPI;
use App\Models\Sub_Det_KPI;
use App\Models\Head_KPI;
use App\Models\Main_Log;

//use Excel;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use Session;

use Illuminate\Http\Request;
use Carbon\Carbon;

class KPIController extends Controller
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
    
    public function kpi_list(Request $request)
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

        $branch = \DB::table('tm_branch_office')
                        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
                        ->distinct()
                        ->where('ACTIVE', 'Y');
        $branch_list = $branch->get();

        $indicator = \DB::table('tm_indicator as a')
        ->leftJoin('tm_sub_division as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->select('b.SUB_DIVISION_ID','b.SUB_DIVISION_NAME','a.INDICATOR_ID','a.INDICATOR_NAME')
        ->where('a.ACTIVE', 'Y')
        ->where('a.STATUS', '3');
        $indicator_list = $indicator->get();

        $items = \DB::table('tm_indicator as a')
                    ->leftJoin('tm_kpi as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
                    ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
                    // ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
                    // ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
                    // ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
                    ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
                    ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','b.PUSAT_CABANG','a.INDICATOR_NAME','a.UNIT','a.MIN_SCORE','a.MAX_SCORE','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','g.SUB_DIVISION_NAME')
                    ->where('a.IS_KPI', 1)
                    ->orderBy('a.created_at', 'desc');
        $kpi_list = $items->get();
        $now            = Carbon::now();
        // dd($indicator_list);
        
        return view('kpi.tabel_kpi', [
                        'now'                   => $now,
                        'kpi_list'        => $kpi_list,
                        'directorat_list'   => $directorat_list,
                        'subdiv_list' => $subdiv_list,
                        'branch_list' => $branch_list,
                        'indicator_list' => $indicator_list
        ]);
    }

    public function form_edit_mstkpifix($id)
    {
           

        $items = \DB::table('tm_indicator as a')
                    ->leftJoin('tm_kpi as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
                    ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
                    ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
                    ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
                    ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','a.POLARITAS','a.INDICATOR_NAME','a.MIN_SCORE','a.UNIT','a.MAX_SCORE','a.FORMULA','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','g.SUB_DIVISION_NAME','d.DIRECTORATE_ID','d.DIRECTORATE_NAME','d.IS_CABANG','e.BRANCH_OFFICE_ID','e.BRANCH_OFFICE_NAME','f.DIVISION_ID','f.DIVISION_NAME','c.ORGANIZATION_STRUCTURE_ID','b.PERSPECTIVE','b.PUSAT_CABANG','a.FORMULA_ALIAS' , 'b.LAPORAN_KPI')
                    ->where('a.IS_KPI', 1)
                    ->where('a.INDICATOR_ID', $id)
                    ->orderBy('a.created_at', 'desc');
        $kpi_list    = $items->get();
        //dd($kpi_list);
        $indicator = \DB::table('tm_indicator as a')
        ->leftJoin('tm_sub_division as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->select('b.SUB_DIVISION_ID','b.SUB_DIVISION_NAME','a.INDICATOR_ID','a.INDICATOR_NAME')
        ->where('a.ACTIVE', 'Y')
        ->where('a.STATUS', '3');
        $indicator_list = $indicator->get();

        $branchx = \DB::table('tm_branch_office')
                        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
                        ->distinct()
                        ->where('ACTIVE', 'Y');
        $branch_listx = $branchx->get();

        $now            = Carbon::now();

        $indicatorid    = $kpi_list[0]->INDICATOR_ID;
        $iddir          = $kpi_list[0]->DIRECTORATE_ID;
        $namedir        = $kpi_list[0]->DIRECTORATE_NAME;
        $idbranch       = $kpi_list[0]->BRANCH_OFFICE_ID;
        $namebranch     = $kpi_list[0]->BRANCH_OFFICE_NAME;
        $iddiv          = $kpi_list[0]->DIVISION_ID;
        $namediv        = $kpi_list[0]->DIVISION_NAME;
        $idsubdiv       = $kpi_list[0]->SUB_DIVISION_ID;
        $namesubdiv     = $kpi_list[0]->SUB_DIVISION_NAME;
        $nameindicator  = $kpi_list[0]->INDICATOR_NAME;
        $polaritas      = $kpi_list[0]->POLARITAS;
        $minscore       = $kpi_list[0]->MIN_SCORE;
        $maxscore       = $kpi_list[0]->MAX_SCORE;
        $laporankpi       = $kpi_list[0]->LAPORAN_KPI;
        $unit           = $kpi_list[0]->UNIT;
        $formula        = $kpi_list[0]->FORMULA;
        $formulaalias   = $kpi_list[0]->FORMULA_ALIAS;
        $perspective    = $kpi_list[0]->PERSPECTIVE;
        $pusatcabang    = $kpi_list[0]->PUSAT_CABANG;
        $iscabang       = $kpi_list[0]->IS_CABANG;
        $orgid          = $kpi_list[0]->ORGANIZATION_STRUCTURE_ID;

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


        $branchdiv       = array();
        $branchdivsubdiv = array();

        if($iscabang == '1')
        {
             $branch = \DB::table('tm_branch_office as a')
             ->leftJoin('tm_organization_structure as b', 'b.BRANCH_OFFICE_ID', '=' , 'a.BRANCH_OFFICE_ID')
             ->select('a.BRANCH_OFFICE_ID', 'a.BRANCH_OFFICE_NAME')
             ->distinct()
             ->where('a.ACTIVE', 'Y')
             ->where('b.DIRECTORATE_ID', $iddir);
            $datalist = $branch->get();

            $subdivbranch = \DB::table('tm_sub_division as a')
            ->leftJoin('tm_organization_structure as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
            ->select('a.SUB_DIVISION_ID', 'a.SUB_DIVISION_NAME','b.ORGANIZATION_STRUCTURE_ID')
            ->distinct()
            ->where('a.ACTIVE', 'Y')
            ->where('b.BRANCH_OFFICE_ID', $idbranch);
            $datalist2 = $subdivbranch->get();
        }
        else
        {
             $division = \DB::table('tm_division as a')
             ->leftJoin('tm_organization_structure as b', 'b.DIVISION_ID', '=' , 'a.DIVISION_ID')
             ->select('a.DIVISION_ID', 'a.DIVISION_NAME')
             ->distinct()
             ->where('a.ACTIVE', 'Y')
             ->where('b.DIRECTORATE_ID', $iddir);
             $datalist = $division->get();

             $subdivdivisi = \DB::table('tm_sub_division as a')
             ->leftJoin('tm_organization_structure as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
             ->select('a.SUB_DIVISION_ID', 'a.SUB_DIVISION_NAME','b.ORGANIZATION_STRUCTURE_ID')
             ->distinct()
             ->where('a.ACTIVE', 'Y')
             ->where('b.DIVISION_ID', $iddiv);
             $datalist2 = $subdivdivisi->get();
        }

        array_push($branchdiv, $datalist);
        array_push($branchdivsubdiv, $datalist2);

        return view('kpi.formedittmsrtkpi', [
                        'now'                   => $now,
                        'id'                    => $indicatorid,
                        'directorat_list'       => $directorat_list,
                        'subdiv_list'           => $subdiv_list,
                        'iddir'                 => $iddir,
                        'namedir'               => $namedir,
                        'idbranch'              => $idbranch,
                        'namebranch'            => $namebranch,
                        'iddiv'                 => $iddiv,
                        'namediv'               => $namediv,
                        'idsubdiv'              => $idsubdiv,
                        'namesubdiv'            => $namesubdiv,
                        'nameindicator'         => $nameindicator,
                        'polaritas'             => $polaritas,
                        'minscore'              => $minscore,
                        'maxscore'              => $maxscore,
                        'laporankpi'              => $laporankpi,
                        'unit'                  => $unit,
                        'formula'               => $formula,
                        'formulaalias'          => $formulaalias,
                        'perspective'           => $perspective,
                        'pusatcabang'           => $pusatcabang,
                        'iscabang'              => $iscabang,
                        'orgid'                 => $orgid,
                        'datalist'              => $datalist,
                        'datalist2'             => $datalist2,
                        'indicator_list'        => $indicator_list,
                        'branch_listx'          => $branch_listx    

        ]);
    }


    public function form_edit_status_mstkpifix($id)
    {
           

        $items = \DB::table('tm_indicator as a')
                    ->leftJoin('tm_kpi as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
                    ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
                    ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
                    ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
                    ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','a.POLARITAS','a.INDICATOR_NAME','a.MIN_SCORE','a.UNIT','a.MAX_SCORE','a.FORMULA','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','g.SUB_DIVISION_NAME','d.DIRECTORATE_ID','d.DIRECTORATE_NAME','d.IS_CABANG','e.BRANCH_OFFICE_ID','e.BRANCH_OFFICE_NAME','f.DIVISION_ID','f.DIVISION_NAME','c.ORGANIZATION_STRUCTURE_ID','b.PERSPECTIVE','b.PUSAT_CABANG', 'a.FORMULA_ALIAS','b.LAPORAN_KPI')
                    ->where('a.IS_KPI', 1)
                    ->where('a.INDICATOR_ID', $id)
                    ->orderBy('a.created_at', 'desc');
        $kpi_list    = $items->get();
        //dd($kpi_list);
        $indicator = \DB::table('tm_indicator as a')
        ->leftJoin('tm_sub_division as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->select('b.SUB_DIVISION_ID','b.SUB_DIVISION_NAME','a.INDICATOR_ID','a.INDICATOR_NAME')
        ->where('a.ACTIVE', 'Y')
        ->where('a.STATUS', '3');
        $indicator_list = $indicator->get();

        $branchx = \DB::table('tm_branch_office')
                        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
                        ->distinct()
                        ->where('ACTIVE', 'Y');
        $branch_listx = $branchx->get();

        $now            = Carbon::now();

        $indicatorid    = $kpi_list[0]->INDICATOR_ID;
        $iddir          = $kpi_list[0]->DIRECTORATE_ID;
        $namedir        = $kpi_list[0]->DIRECTORATE_NAME;
        $idbranch       = $kpi_list[0]->BRANCH_OFFICE_ID;
        $namebranch     = $kpi_list[0]->BRANCH_OFFICE_NAME;
        $iddiv          = $kpi_list[0]->DIVISION_ID;
        $namediv        = $kpi_list[0]->DIVISION_NAME;
        $idsubdiv       = $kpi_list[0]->SUB_DIVISION_ID;
        $namesubdiv     = $kpi_list[0]->SUB_DIVISION_NAME;
        $nameindicator  = $kpi_list[0]->INDICATOR_NAME;
        $polaritas      = $kpi_list[0]->POLARITAS;
        $minscore       = $kpi_list[0]->MIN_SCORE;
        $maxscore       = $kpi_list[0]->MAX_SCORE;
        $laporankpi       = $kpi_list[0]->LAPORAN_KPI;
        $unit           = $kpi_list[0]->UNIT;
        $formula        = $kpi_list[0]->FORMULA;
        $formulaalias   = $kpi_list[0]->FORMULA_ALIAS;
        $perspective    = $kpi_list[0]->PERSPECTIVE;
        $pusatcabang    = $kpi_list[0]->PUSAT_CABANG;
        $iscabang       = $kpi_list[0]->IS_CABANG;
        $status       = $kpi_list[0]->ACTIVE;
        $orgid          = $kpi_list[0]->ORGANIZATION_STRUCTURE_ID;

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


        $branchdiv       = array();
        $branchdivsubdiv = array();

        if($iscabang == '1')
        {
             $branch = \DB::table('tm_branch_office as a')
             ->leftJoin('tm_organization_structure as b', 'b.BRANCH_OFFICE_ID', '=' , 'a.BRANCH_OFFICE_ID')
             ->select('a.BRANCH_OFFICE_ID', 'a.BRANCH_OFFICE_NAME')
             ->distinct()
             ->where('a.ACTIVE', 'Y')
             ->where('b.DIRECTORATE_ID', $iddir);
            $datalist = $branch->get();

            $subdivbranch = \DB::table('tm_sub_division as a')
            ->leftJoin('tm_organization_structure as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
            ->select('a.SUB_DIVISION_ID', 'a.SUB_DIVISION_NAME','b.ORGANIZATION_STRUCTURE_ID')
            ->distinct()
            ->where('a.ACTIVE', 'Y')
            ->where('b.BRANCH_OFFICE_ID', $idbranch);
            $datalist2 = $subdivbranch->get();
        }
        else
        {
             $division = \DB::table('tm_division as a')
             ->leftJoin('tm_organization_structure as b', 'b.DIVISION_ID', '=' , 'a.DIVISION_ID')
             ->select('a.DIVISION_ID', 'a.DIVISION_NAME')
             ->distinct()
             ->where('a.ACTIVE', 'Y')
             ->where('b.DIRECTORATE_ID', $iddir);
             $datalist = $division->get();

             $subdivdivisi = \DB::table('tm_sub_division as a')
             ->leftJoin('tm_organization_structure as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
             ->select('a.SUB_DIVISION_ID', 'a.SUB_DIVISION_NAME','b.ORGANIZATION_STRUCTURE_ID')
             ->distinct()
             ->where('a.ACTIVE', 'Y')
             ->where('b.DIVISION_ID', $iddiv);
             $datalist2 = $subdivdivisi->get();
        }

        array_push($branchdiv, $datalist);
        array_push($branchdivsubdiv, $datalist2);

        return view('kpi.formeditstatustmsrtkpi', [
                        'now'                   => $now,
                        'id'                    => $indicatorid,
                        'directorat_list'       => $directorat_list,
                        'subdiv_list'           => $subdiv_list,
                        'iddir'                 => $iddir,
                        'namedir'               => $namedir,
                        'idbranch'              => $idbranch,
                        'namebranch'            => $namebranch,
                        'iddiv'                 => $iddiv,
                        'namediv'               => $namediv,
                        'idsubdiv'              => $idsubdiv,
                        'namesubdiv'            => $namesubdiv,
                        'nameindicator'         => $nameindicator,
                        'polaritas'             => $polaritas,
                        'minscore'              => $minscore,
                        'maxscore'              => $maxscore,
                        'laporankpi'              => $laporankpi,
                        'unit'                  => $unit,
                        'formula'               => $formula,
                        'formulaalias'          => $formulaalias,
                        'perspective'           => $perspective,
                        'pusatcabang'           => $pusatcabang,
                        'iscabang'              => $iscabang,
                        'orgid'                 => $orgid,
                        'datalist'              => $datalist,
                        'datalist2'             => $datalist2,
                        'indicator_list'        => $indicator_list,
                        'branch_listx'          => $branch_listx,
                        'status'                => $status    

        ]);
    }

    public function form_detail_mstkpifix($id)
    {
           

        $items = \DB::table('tm_indicator as a')
                    ->leftJoin('tm_kpi as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
                    ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
                    ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
                    ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
                    ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','a.POLARITAS','a.INDICATOR_NAME','a.MIN_SCORE','a.UNIT','a.MAX_SCORE','a.FORMULA','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','g.SUB_DIVISION_NAME','d.DIRECTORATE_ID','d.DIRECTORATE_NAME','d.IS_CABANG','e.BRANCH_OFFICE_ID','e.BRANCH_OFFICE_NAME','f.DIVISION_ID','f.DIVISION_NAME','c.ORGANIZATION_STRUCTURE_ID','b.PERSPECTIVE','b.PUSAT_CABANG','a.FORMULA_ALIAS','b.LAPORAN_KPI')
                    ->where('a.IS_KPI', 1)
                    ->where('a.INDICATOR_ID', $id)
                    ->orderBy('a.created_at', 'desc');
        $kpi_list    = $items->get();
        //dd($kpi_list);
        $indicator = \DB::table('tm_indicator as a')
        ->leftJoin('tm_sub_division as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->select('b.SUB_DIVISION_ID','b.SUB_DIVISION_NAME','a.INDICATOR_ID','a.INDICATOR_NAME')
        ->where('a.ACTIVE', 'Y')
        ->where('a.STATUS', '3');
        $indicator_list = $indicator->get();

        $branchx = \DB::table('tm_branch_office')
                        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
                        ->distinct()
                        ->where('ACTIVE', 'Y');
        $branch_listx = $branchx->get();

        $now            = Carbon::now();

        $indicatorid    = $kpi_list[0]->INDICATOR_ID;
        $iddir          = $kpi_list[0]->DIRECTORATE_ID;
        $namedir        = $kpi_list[0]->DIRECTORATE_NAME;
        $idbranch       = $kpi_list[0]->BRANCH_OFFICE_ID;
        $namebranch     = $kpi_list[0]->BRANCH_OFFICE_NAME;
        $iddiv          = $kpi_list[0]->DIVISION_ID;
        $namediv        = $kpi_list[0]->DIVISION_NAME;
        $idsubdiv       = $kpi_list[0]->SUB_DIVISION_ID;
        $namesubdiv     = $kpi_list[0]->SUB_DIVISION_NAME;
        $nameindicator  = $kpi_list[0]->INDICATOR_NAME;
        $polaritas      = $kpi_list[0]->POLARITAS;
        $minscore       = $kpi_list[0]->MIN_SCORE;
        $maxscore       = $kpi_list[0]->MAX_SCORE;
        $laporankpi       = $kpi_list[0]->LAPORAN_KPI;
        $unit           = $kpi_list[0]->UNIT;
        $formula        = $kpi_list[0]->FORMULA;
        $formulaalias   = $kpi_list[0]->FORMULA_ALIAS;
        $perspective    = $kpi_list[0]->PERSPECTIVE;
        $pusatcabang    = $kpi_list[0]->PUSAT_CABANG;
        $iscabang       = $kpi_list[0]->IS_CABANG;
        $status         = $kpi_list[0]->ACTIVE;
        $orgid          = $kpi_list[0]->ORGANIZATION_STRUCTURE_ID;

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


        $branchdiv       = array();
        $branchdivsubdiv = array();

        if($iscabang == '1')
        {
             $branch = \DB::table('tm_branch_office as a')
             ->leftJoin('tm_organization_structure as b', 'b.BRANCH_OFFICE_ID', '=' , 'a.BRANCH_OFFICE_ID')
             ->select('a.BRANCH_OFFICE_ID', 'a.BRANCH_OFFICE_NAME')
             ->distinct()
             ->where('a.ACTIVE', 'Y')
             ->where('b.DIRECTORATE_ID', $iddir);
            $datalist = $branch->get();

            $subdivbranch = \DB::table('tm_sub_division as a')
            ->leftJoin('tm_organization_structure as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
            ->select('a.SUB_DIVISION_ID', 'a.SUB_DIVISION_NAME','b.ORGANIZATION_STRUCTURE_ID')
            ->distinct()
            ->where('a.ACTIVE', 'Y')
            ->where('b.BRANCH_OFFICE_ID', $idbranch);
            $datalist2 = $subdivbranch->get();
        }
        else
        {
             $division = \DB::table('tm_division as a')
             ->leftJoin('tm_organization_structure as b', 'b.DIVISION_ID', '=' , 'a.DIVISION_ID')
             ->select('a.DIVISION_ID', 'a.DIVISION_NAME')
             ->distinct()
             ->where('a.ACTIVE', 'Y')
             ->where('b.DIRECTORATE_ID', $iddir);
             $datalist = $division->get();

             $subdivdivisi = \DB::table('tm_sub_division as a')
             ->leftJoin('tm_organization_structure as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
             ->select('a.SUB_DIVISION_ID', 'a.SUB_DIVISION_NAME','b.ORGANIZATION_STRUCTURE_ID')
             ->distinct()
             ->where('a.ACTIVE', 'Y')
             ->where('b.DIVISION_ID', $iddiv);
             $datalist2 = $subdivdivisi->get();
        }

        array_push($branchdiv, $datalist);
        array_push($branchdivsubdiv, $datalist2);

        return view('kpi.formdetailtmsrtkpi', [
                        'now'                   => $now,
                        'id'                    => $indicatorid,
                        'directorat_list'       => $directorat_list,
                        'subdiv_list'           => $subdiv_list,
                        'iddir'                 => $iddir,
                        'namedir'               => $namedir,
                        'idbranch'              => $idbranch,
                        'namebranch'            => $namebranch,
                        'iddiv'                 => $iddiv,
                        'namediv'               => $namediv,
                        'idsubdiv'              => $idsubdiv,
                        'namesubdiv'            => $namesubdiv,
                        'nameindicator'         => $nameindicator,
                        'polaritas'             => $polaritas,
                        'minscore'              => $minscore,
                        'maxscore'              => $maxscore,
                        'laporankpi'              => $laporankpi,
                        'unit'                  => $unit,
                        'formula'               => $formula,
                        'formulaalias'          => $formulaalias,
                        'perspective'           => $perspective,
                        'pusatcabang'           => $pusatcabang,
                        'iscabang'              => $iscabang,
                        'orgid'                 => $orgid,
                        'datalist'              => $datalist,
                        'datalist2'             => $datalist2,
                        'indicator_list'        => $indicator_list,
                        'branch_listx'          => $branch_listx,
                        'status'                => $status    

        ]);
    }

     public function save_mst_indikator_kpi(Request $request)
    {
        
        $sub_division_idgabungan    = $request->sub_division_list;
        $explodesubdiv              = explode('-',$sub_division_idgabungan);
        $sub_division_id            = $explodesubdiv[0];
        $org_id                     = $explodesubdiv[1];
        $indicator_name             = $request->indicator_name;
        $unit                       = $request->unit;
        $polaritas                  = $request->polaritas;
        $perspective                = $request->perspective;
        $branchoffice_list          = $request->branchoffice_list;
        $minscore                   = $request->minscore;
        $maxscore                   = $request->maxscore;
        $laporankpi                 = $request->laporankpi;
        $formula                    = $request->formula;
        $formulaalias               = $request->formula_alias;

        $item = new Indicator;
        $item->SUB_DIVISION_ID = $sub_division_id;
        $item->INDICATOR_NAME = $indicator_name;
        $item->UNIT = $unit;
        $item->POLARITAS = $polaritas;
        $item->MIN_SCORE = $minscore;
        $item->MAX_SCORE = $maxscore;
        $item->IS_KPI = '1';
        $formula = ltrim(ltrim($formula, '+'), '-');
        $formula = ltrim(ltrim($formula, '*'), '/');
        $item->FORMULA = $formula;
        $item->FORMULA_ALIAS = $formulaalias;
        $item->save();

        $idutama = \DB::getPdo()->lastInsertId();

            if($idutama != '')
            {
                $data2 = new Master_KPI;
                $data2->INDICATOR_ID = $idutama;
                $data2->ORGANIZATION_STRUCTURE_ID = $org_id;
                $data2->PERSPECTIVE = $perspective;
                $data2->PUSAT_CABANG = $branchoffice_list;
                $data2->LAPORAN_KPI = $laporankpi;
                $data2->ACTIVE = 'N';
                $data2->save();
            }

        $modul = "MASTER INDICATOR KPI"; 

        (new Main_Log)->setLog("Save Data Master Indicator KPI",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/kpi');
    }

    public function save_edit_mst_indikator_kpi(Request $request)
    {

        $id                         = $request->id;
        $sub_division_idgabungan    = $request->sub_division_list;
        $explodesubdiv              = explode('-',$sub_division_idgabungan);
        $sub_division_id            = $explodesubdiv[0];
        $org_id                     = $explodesubdiv[1];
        $indicator_name             = $request->indicator_name;
        $unit                       = $request->unit;
        $polaritas                  = $request->polaritas;
        $perspective                = $request->perspective;
        $branchoffice_list          = $request->branchoffice_list;
        $minscore                   = $request->minscore;
        $maxscore                   = $request->maxscore;
        $laporankpi                 = $request->laporankpi;
        $formula                    = $request->formula;
        $formulaalias               = $request->formula_alias;

        $item = Indicator::where('INDICATOR_ID', $id)->first();
        $item->SUB_DIVISION_ID = $sub_division_id;
        $item->INDICATOR_NAME = $indicator_name;
        $item->UNIT = $unit;
        $item->POLARITAS = $polaritas;
        $item->MIN_SCORE = $minscore;
        $item->MAX_SCORE = $maxscore;
        $item->ACTIVE = 'N';
        $item->STATUS = '1';
        $formula = ltrim(ltrim($formula, '+'), '-');
        $formula = ltrim(ltrim($formula, '*'), '/');
        $item->FORMULA = $formula;
        $item->FORMULA_ALIAS = $formulaalias;
        $item->update();

        if($item)
        {
            $data2 = Master_KPI::where('INDICATOR_ID', $id)->first();
            $data2->ORGANIZATION_STRUCTURE_ID = $org_id;
            $data2->PERSPECTIVE = $perspective;
            $data2->PUSAT_CABANG = $branchoffice_list;
            $data2->ACTIVE = 'N';
            $data2->LAPORAN_KPI = $laporankpi;
            $data2->update();
        }

        $modul = "MASTER INDICATOR KPI"; 

        (new Main_Log)->setLog("Update Data Master Indicator KPI",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/kpi');
    }

     public function save_edit_status_mst_indikator_kpi(Request $request)
    {
        //dd($request);
        $id                         = $request->id;
        $status                     = $request->status;

        
        $item = Indicator::where('INDICATOR_ID', $id)->first();
        $item->ACTIVE = $status;
        $item->update();

        if($item)
        {
            $data2 = Master_KPI::where('INDICATOR_ID', $id)->first();
            $data2->ACTIVE = $status;
            $data2->update();
        }

        $modul = "MASTER INDICATOR KPI"; 

        (new Main_Log)->setLog("Update Status Master Indicator KPI",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/kpi');
    }

     public function approve_mst_kpi_indikator(Request $request)
    {
    //    dd($request->id1);
        
        if(Auth::user()->ACCESS == 'DVP SUB DIVISI' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
            $item = Indicator::where('INDICATOR_ID', '=', $request->id)->first();
            $item->STATUS = '2';
            $item->save();

            $modul = "MASTER INDICATOR KPI"; 

            (new Main_Log)->setLog("Approved DVP Master Indicator KPI",json_encode($item),$modul,Auth::user()->ID);

        }else if(Auth::user()->ACCESS == 'VP SUB DIVISI' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
            $item = Indicator::where('INDICATOR_ID', '=', $request->id)->first();
            $item->STATUS = '3';
            $item->ACTIVE = 'Y';
            $item->save();

            if($item)
            {
                $data2 = Master_KPI::where('INDICATOR_ID', $request->id)->first();
                $data2->ACTIVE = 'Y';
                $data2->save();
            }

            $modul = "MASTER INDICATOR KPI"; 

            (new Main_Log)->setLog("Approved VP Master Indicator KPI",json_encode($item),$modul,Auth::user()->ID);
        }
        return redirect('/kpi');
    }

    public function kembalikan_mst_kpi_indikator(Request $request)
    {

        if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
            
            $item = Indicator::where('INDICATOR_ID', '=', $request->id1)->first();
            
            $item->STATUS = '4';
            $item->ACTIVE = 'N';
            $item->ALASAN_KEMBALIKAN = $request->alasan;
            $item->save();

            $modul = "MASTER INDICATOR KPI";
            
            (new Main_Log)->setLog("Dikembalikan DVP Master Indicator KPI",json_encode($item),$modul,Auth::user()->ID);

        }elseif (Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU') {
            
            $item = Indicator::where('INDICATOR_ID', '=', $request->id1)->first();

            $item->STATUS = '4';
            $item->ACTIVE = 'N';
            $item->ALASAN_KEMBALIKAN = $request->alasan;
            $item->save();

            if($item)
            {
                $data2 = Master_KPI::where('INDICATOR_ID', $request->id1)->first();
                $item->ACTIVE = 'N';
                $data2->update();
            }

            $modul = "MASTER INDICATOR KPI";

            (new Main_Log)->setLog("Dikembalikan VP Master Indicator KPI",json_encode($item),$modul,Auth::user()->ID);
        }
         


        return redirect('/kpi');
    }

    
    public function txkpi_list(Request $request)
    {
        // $indicator_list = array();
        $items = \DB::table('tx_header_kpi as t')
                    ->leftJoin('tm_organization_structure as o', 'o.ORGANIZATION_STRUCTURE_ID', '=' , 't.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'sd.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'd.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 't.HEADER_KPI_ID as KPI_ID', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 't.YEAR as YEAR', 't.PERIOD as PERIOD', 't.STATUS as STATUS','t.ALASAN_KEMBALIKAN')
                    ->where('o.ORGANIZATION_STRUCTURE_ID', '=', Auth::user()->ORG_ID)
                    ->where('t.IS_DELETED', 0)
                    ->orderBy('t.created_at', 'desc');
        $kpi_list = $items->get();
        $now            = Carbon::now();
        // dd($indicator_list);

        $years = array(date('Y'),date('Y')-1);
        $year = '';
        $months = array("TRIWULAN_1","TRIWULAN_2","TRIWULAN_3","TRIWULAN_4");

        $branch = \DB::table('tm_branch_office')
                        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
                        ->distinct()
                        ->where('ACTIVE', 'Y');
        $branch_list = $branch->get();
        
        // $mnow = $months[date('m')-1];
        // $mmin1 = $months[date('m')-2];
        // $monthss = array($mnow, $mmin1);
        
        return view('kpi.tabel_txkpi', [
                        'now'                   => $now,
                        'txkpi_list'        => $kpi_list,
                        'years'     => $years,
                        'year'     => $year,
                        'months'     => $months,
                        'month'     => '',
                        'branch_list' => $branch_list
        ]);
    }
    
    public function form_kpi(Request $request)
    {
        $items = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'sd.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'd.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME')->get();
        $organize_struct_list = $items->toArray();
        $itemscabang = \DB::table('tm_branch_office')
                        ->SELECT('BRANCH_OFFICE_ID','BRANCH_OFFICE_NAME')
                        ->get();
        $cabanglist = $itemscabang->toArray();
        $period_list         = Period::all()->toArray();
        $indicator_list   = Indicator::all()->toArray();
        // dd($organize_struct_list);
        $years = array_combine(range(date("Y"), 1960), range(date("Y"), 1960));
        $period         = '';
        $indicator  = '';
        $year  = '';
        $organize_struct  = '';
        $now            = Carbon::now();
        
        return view('kpi.form', [
                        'now'                   => $now,
                        'period'                => $period,
                        'period_list'                => $period_list,
                        'indicator_list'     => $indicator_list,
                        'indicator'          => $indicator,
                        'organize_struct_list'     => $organize_struct_list,
                        'cabanglist'     => $cabanglist,
                        'organize_struct'          => $organize_struct,
                        'years'          => $years,
                        'year'          => $year,
        ]);
    }

    public function form_edit_mstkpi(Request $request)
    {
        // dd($request->id);
        $itemselects = Master_KPI::where('KPI_ID', $request->id)->first();
        // dd($itemselects->INDICATOR_ID);
        $id = $request->id;
        $selectedyear = $itemselects->YEAR;
        $selectedos = $itemselects->ORGANIZATION_STRUCTURE_ID;
        $selectedstatus = $itemselects->STATUS;
        $selectedindicator = $itemselects->INDICATOR_ID;
        $items = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'sd.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'd.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME');
        $organize_struct_list1 = $items->get();
        $organize_struct_list = $organize_struct_list1->toArray();
        $period_list         = Period::all()->toArray();
        $indicator_list   = Indicator::all()->toArray();
        $years = array_combine(range(date("Y"), 1960), range(date("Y"), 1960));
        $status         = '';
        $indicator  = '';
        $year  = '';
        $organize_struct  = '';
        $now            = Carbon::now();
        
        return view('kpi.formedit', [
                        'now'                   => $now,
                        'id'                => $id,
                        'status'                => $status,
                        'period_list'                => $period_list,
                        'indicator_list'     => $indicator_list,
                        'indicator'          => $indicator,
                        'organize_struct_list'     => $organize_struct_list,
                        'organize_struct'          => $organize_struct,
                        'years'          => $years,
                        'year'          => $year,
                        'selectedyear'  => $selectedyear,
                        'selectedos'  => $selectedos,
                        'selectedstatus'  => $selectedstatus,
                        'selectedindicator'  => $selectedindicator,
        ]);
    }

    public function save_mst_kpi(Request $request)
    {
        $cabpus          = $request->cabpus_list[0];
        $prespective    = $request->prespective;
        $indicator     = $request->indicator_list;
        // $period            = $request->period_list[0];

        foreach ($indicator as $indicator) {
            $item = new Master_KPI;
            $item->INDICATOR_ID = $indicator;
            $item->PERSPECTIVE = $prespective;
            $item->PUSAT_CABANG = $cabpus;
            $item->ORGANIZATION_STRUCTURE_ID = Auth::user()->ORG_ID;
            $item->ACTIVE = 'Y';
            $item->save();
        }

        return redirect('/kpi');
    }

    public function edit_mst_kpi(Request $request)
    {
        $cabpus          = $request->cabpus_list[0];
        $prespective    = $request->prespective;
        $indicator     = $request->indicator_list;

        foreach ($indicator as $indicator) {
            $item = Master_KPI::where('KPI_ID', $request->id)->first();
            $item->INDICATOR_ID = $indicator;
            $item->PERSPECTIVE = $prespective;
            $item->PUSAT_CABANG = $cabpus;
            $item->update();
        }
        
        return redirect('/kpi');
    }

    public function mstkpi_active(Request $request)
    {
        $item = Master_KPI::where('KPI_ID', '=', $request->id)->first();
        
        $item->ACTIVE = 'Y';
        $item->save();

        return redirect('/kpi');
    }

    public function mstkpi_inactive(Request $request)
    {
        $item = Master_KPI::where('KPI_ID', '=', $request->id)->first();
        
        $item->ACTIVE = 'N';
        $item->save();

        return redirect('/kpi');
    }

    public function mstkpi_approve(Request $request)
    {
       $item = Master_KPI::where('KPI_ID', '=', $request->id)->first();
        
        if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
            $item->STATUS = '2';
            $item->save();
        }else if(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
            $item->STATUS = '3';
            $item->save();
        }
        return redirect('/kpi');
    }

    public function mstkpi_kembalikan(Request $request)
    {
        $item = Master_KPI::where('KPI_ID', '=', $request->id1)->first();
        
        $item->STATUS = '4';
        $item->ALASAN_KEMBALIKAN = $request->alasan;
        $item->save();

        return redirect('/kpi');
    }

    public function save_tx_kpi(Request $request)
    {
        //dd($request);

       $iscek = \DB::table('tx_header_kpi as a')
       ->select('a.PERIOD')
       ->where('a.PERIOD',$request->months)
       ->where('a.YEAR',$request->years)
       ->where('a.IS_DELETED', '=' , 0)
       ->count();

       if($iscek == 0)
       {
            $head = new Head_KPI;
        $head->ORGANIZATION_STRUCTURE_ID = Auth::user()->ORG_ID;
        $head->YEAR = $request->years;
        $head->PERIOD = $request->months;
        $head->STATUS = '1';
        $head->save();

        $idhead = \DB::getPdo()->lastInsertId();

        $hasil = array();
        $i = 0;
        $j = 0;
        $k = 0;
        foreach ($request->indicator_id as $data) {
            $item = \DB::table('tm_indicator as t')
                            ->where('INDICATOR_ID', $data)->first();
            $formuladb = $item->FORMULA;
            $pttn='+-/*()';   # standard mathematical operators
            $pttn=sprintf('@([%s])@', preg_quote($pttn)); # an escaped/quoted pattern

            $sub_ind=preg_split($pttn, preg_replace('@\s@', '', $item->FORMULA), -1, PREG_SPLIT_DELIM_CAPTURE);

            //Detil
            $det = new Det_KPI;
            $det->HEADER_KPI_ID = $idhead;
            $det->INDICATOR_ID = $data;
            $det->ACTUAL_REALISASI = $request->realisasi[$j];
            $det->save();

            $iddet = \DB::getPdo()->lastInsertId();
            //Sub Detil
            $num_split = array();
            foreach ($sub_ind as $split){
                if(is_numeric($split)){
                    // $formuladb = str_replace($split, $request->actual[$i], $formuladb);
                    $sub_det = new Sub_Det_KPI;
                    $sub_det->DET_KPI_ID = $iddet;
                    $sub_det->SUB_INDICATOR_ID = $request->sub_ind_id[$i];
                    $sub_det->ACTUAL_REALISASI = $request->subrealisasi[$i];
                    $sub_det->save();
                    $i = $i+1;
                }
            
            }
            // array_push($hasil, $hasils);
            $j = $j+1;

        }

        $modul = "TRANSACTION KPI";

        (new Main_Log)->setLog("Save Data Transaction KPI",json_encode($head),$modul,Auth::user()->ID);

        return redirect('/txkpi');
       }
       else
       {

           return redirect('/txkpi')->with('error','Data Sudah Ada!!!');
       }
        
    }

    public function edit_tx_kpi(Request $request)
    {
        $header_kpi_id = $request->header_kpi_id;
        $head = Head_KPI::where('HEADER_KPI_ID', '=', $header_kpi_id)->first();
        $head->ORGANIZATION_STRUCTURE_ID = Auth::user()->ORG_ID;
        $head->YEAR = $request->years[0];
        $head->PERIOD = $request->months[0];
        $head->STATUS = 'Y';
        $head->save();

        $hasil = array();
        $i = 0;
        $j = 0;
        $k = 0;
        foreach ($request->indicator_id as $data) {
            $item = \DB::table('tm_indicator as t')
                            ->where('INDICATOR_ID', $data)->first();
            $formuladb = $item->FORMULA;
            $pttn='+-/*()';   # standard mathematical operators
            $pttn=sprintf('@([%s])@', preg_quote($pttn)); # an escaped/quoted pattern

            $sub_ind=preg_split($pttn, preg_replace('@\s@', '', $item->FORMULA), -1, PREG_SPLIT_DELIM_CAPTURE);

            //Detil
            $det = Det_KPI::where('INDICATOR_ID', '=', $data)
                                ->where('HEADER_KPI_ID', '=', $header_kpi_id)->first();
            $det->ACTUAL_REALISASI = $request->realisasi[$i];
            $det->save();

            $iddet = $det->DET_KPI_ID;
            // dd($iddet);
            //Sub Detil
            $num_split = array();
            foreach ($sub_ind as $split){
                if(is_numeric($split)){
                    // $formuladb = str_replace($split, $request->actual[$i], $formuladb);
                    $sub_det = Sub_Det_KPI::where('SUB_INDICATOR_ID', '=', $split)
                                ->where('DET_KPI_ID', '=', $iddet)->first();
                    $sub_det->ACTUAL_REALISASI = $request->subrealisasi[$i];
                    $sub_det->save();
                    $i = $i+1;
                }
            }
            // array_push($hasil, $hasils);
            $j = $j+1;

        }


        $modul = "TRANSACTION KPI";

        (new Main_Log)->setLog("Update Data Transaction KPI",json_encode($head),$modul,Auth::user()->ID);

        return redirect('/txkpi');
    }

    public function approve_tx_kpi(Request $request)
    {
        $header_kpi_id = $request->header_kpi_id;
        $head = Head_KPI::where('HEADER_KPI_ID', '=', $header_kpi_id)->first();
        if(Auth::user()->ACCESS == 'DVP SUB DIVISI' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
        {
            $status = '1';
        }else if(Auth::user()->ACCESS == 'VP SUB DIVISI' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
        {
            $status = '2';
        }
        $head->STATUS = $status;
        $head->save();

        return redirect('/txkpi');
    }

    public function txkpi_approve(Request $request)
    {
        // dd('oke');
        $header_kpi_id = $request->id;
        // dd($header_sarmut_id);
        if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
        {
            $head = Head_KPI::where('HEADER_KPI_ID', '=', $header_kpi_id)->first();
            $status = '2';
            $head->STATUS = $status;
            $head->save();

            $modul = "TRANSACTION KPI";

            (new Main_Log)->setLog("Approved DVP Transaction KPI",json_encode($head),$modul,Auth::user()->ID);

        }elseif(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
        {   
            $head = Head_KPI::where('HEADER_KPI_ID', '=', $header_kpi_id)->first();
            $status = '3';
            $head->STATUS = $status;
            $head->save();

            $modul = "TRANSACTION KPI";

            (new Main_Log)->setLog("Approved VP Transaction KPI",json_encode($head),$modul,Auth::user()->ID);
        }

        return redirect('/txkpi');
    }

    public function txkpi_kembalikan(Request $request)
    {
        if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
        {
            $item = Head_KPI::where('HEADER_KPI_ID', '=', $request->id1)->first();

            $item->STATUS = '4';
            $item->IS_DELETED = '1';
            $item->save();

            $modul = "TRANSACTION KPI";

            (new Main_Log)->setLog("Dikembalikan DVP Transaction KPI",json_encode($item),$modul,Auth::user()->ID);
        
        }elseif (Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU') {
            
            $item = Head_KPI::where('HEADER_KPI_ID', '=', $request->id1)->first();

            $item->STATUS = '4';
            $item->IS_DELETED = '1';
            $item->save();

            $modul = "TRANSACTION KPI";

            (new Main_Log)->setLog("Dikembalikan VP Transaction KPI",json_encode($item),$modul,Auth::user()->ID);
        }
        elseif (Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU') {
            
            $item = Head_KPI::where('HEADER_KPI_ID', '=', $request->id1)->first();

            $item->STATUS = '4';
            $item->IS_DELETED = '1';
            $item->save();

            $modul = "TRANSACTION KPI";

            (new Main_Log)->setLog("Dikembalikan ADMIN Transaction KPI",json_encode($item),$modul,Auth::user()->ID);
        }
        return redirect('/txkpi');
    }

    public function delete_mst_kpi(Request $request)
    {
        Master_KPI::where('KPI_ID',$request->id)->delete();

        return redirect('/kpi');
    }

    public function form_input_kpi(Request $request)
    {
        $now            = Carbon::now();
        $items = \DB::table('tm_kpi as a')
                    ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
                    ->leftJoin('tm_organization_structure as c', 'a.ORGANIZATION_STRUCTURE_ID', '=' , 'c.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
                    ->leftJoin('tm_division as d', 'c.DIVISION_ID', '=' , 'd.DIVISION_ID')
                    ->leftJoin('tm_indicator_target as e', 'b.INDICATOR_ID', '=' , 'e.INDICATOR_ID')
                    ->select('a.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'a.KPI_ID as KPI_ID', 'a.PERSPECTIVE as PERSPECTIVE', 'a.PUSAT_CABANG as PUSAT_CABANG', 'b.INDICATOR_ID as INDICATOR_ID', 'b.INDICATOR_NAME as INDICATOR_NAME', 'b.UNIT as UNIT', 'e.TARGET as TARGET', 'd.DIVISION_NAME as DIVISION_NAME', 'b.FORMULA as FORMULA')
                    ->where('a.PUSAT_CABANG', '=', $request->branch[0])
                    ->where('a.ACTIVE', '=', 'Y')
                    ->where('b.STATUS', '=', '3');
        $kpi_list1 = $items->get();
        $kpi_list = $kpi_list1->toArray();
        // dd($kpi_list);
        $triwulan = array();
        if($request->months[0] == "TRIWULAN_1"){
            $triwulan = ["JAN", "FEB", "MAR"];
        }else if($request->months[0] == "TRIWULAN_2"){
            $triwulan = ["JAN", "FEB", "MAR","APR", "MAY", "JUN"];
        }else if($request->months[0] == "TRIWULAN_3"){
            $triwulan = ["JAN", "FEB", "MAR","APR", "MAY", "JUN","JUL", "AUG", "SEP"];
        }else if($request->months[0] == "TRIWULAN_4"){
            $triwulan = ["JAN", "FEB", "MAR","APR", "MAY", "JUN","JUL", "AUG", "SEP","OCT", "NOV", "DEC"];
        }

        $sub_list = array();
        $target_ind_list = array();
        $target_subind_list = array();
        $real_ind_list = array();
        $real_subind_list = array();
        $realavg_subind_list = array();
        $pencapaian_ind_list = array();
        $pencapaian_subind_list = array();
        $score_ind_list = array();
        $score_subind_list = array();
        $hasil = array();

        foreach ($kpi_list1 as $data) {
            $targetind = \DB::table('tm_target_triwulan as a')
                        ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
                        // ->leftJoin('tm_sub_indicator as c', 'a.SUB_INDICATOR_ID', '=' , 'c.SUB_INDICATOR_ID')
                        ->select('a.TARGET_'.$request->months[0].' as TARGET', 'a.BOBOT_'.$request->months[0].' as BOBOT')
                        ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID)
                        ->where('a.YEAR', '=', $request->years[0]);
            $tgtind_list = $targetind->first();
            // $sub_ind = str_split($data->FORMULA, 1);
            $pttn='+-/*()';   # standard mathematical operators
            $pttn=sprintf('@([%s])@', preg_quote($pttn)); # an escaped/quoted pattern

            $sub_ind=preg_split($pttn, preg_replace('@\s@', '', $data->FORMULA), -1, PREG_SPLIT_DELIM_CAPTURE);
            //dd($sub_ind);
            $num_split = array();
            $formuladb1 = $data->FORMULA;
            $formuladb2 = $data->FORMULA;
            $formuladb3 = $data->FORMULA;
            $formuladb4 = $data->FORMULA;
            foreach ($sub_ind as $split){
                if(is_numeric($split)){
                    array_push($num_split, $split);
                    $targetsubind = \DB::table('tm_target_triwulan as a')
                                ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
                                ->select('a.TARGET_'.$request->months[0].' as TARGET', 'a.BOBOT_'.$request->months[0].' as BOBOT')
                                ->where('a.INDICATOR_ID', '=', $split)
                                ->where('a.YEAR', '=', $request->years[0]);
                    $tgtsubind_list = $targetsubind->first();

                    $sub_real = \DB::table('tx_header_sasaran_mutu as a')
                                ->leftJoin('tx_det_sasaran_mutu as b', 'a.HEADER_SASARAN_MUTU_ID', '=' , 'b.HEADER_SASARAN_MUTU_ID')
                                ->leftJoin('tx_sub_det_sasaran_mutu as c', 'b.DET_SASARAN_MUTU_ID', '=' , 'c.DET_SASARAN_MUTU_ID')
                                ->select('a.MONTH as MONTH', 'b.KETERANGAN', 'a.YEAR as YEAR', 'b.INDICATOR_ID as INDICATOR_ID', 'b.ACTUAL_REALISASI as ACTUAL_REALISASI', 'b.KETERANGAN as KETERANGAN', 'c.SUB_INDICATOR_ID as SUB_INDICATOR_ID', 'c.ACTUAL_REALISASI as SUB_ACTUAL_REALISASI')
                                ->where('b.INDICATOR_ID', '=', $split)
                                ->whereIn('a.MONTH', $triwulan)
                                ->where('a.YEAR', '=', $request->years[0])
                                ->where('a.STATUS', '=', '3');
                    $sub_real_list = $sub_real->get();
                    //print_r($sub_real_list);
                    $realisasi = 0;
                    $realisasirata = 0;
                    if(!$sub_real_list->isEmpty()){
                        foreach ($sub_real_list as $data1) {
                            $realisasi = $realisasi+$data1->ACTUAL_REALISASI;
                            //print_r($realisasi);
                            if($data1 <> null){

                                if($data1->MONTH ==  "JAN" || $data1->MONTH == "FEB" || $data1->MONTH == "MAR")
                                {
                                    $formuladb1 = str_replace($split, $data1->ACTUAL_REALISASI, $formuladb1);
                                    $formuladb2 = str_replace($split, "0", $formuladb2);
                                    $formuladb3 = str_replace($split, "0", $formuladb3);
                                    $formuladb4 = str_replace($split, "0", $formuladb4);
                                }
                                elseif ($data1->MONTH == "APR" || $data1->MONTH == "MAY" || $data1->MONTH == "JUN") 
                                {
                                    $formuladb1 = str_replace($split, "0", $formuladb1);
                                    $formuladb2 = str_replace($split, $data1->ACTUAL_REALISASI, $formuladb2);
                                    $formuladb3 = str_replace($split, "0", $formuladb3);
                                    $formuladb4 = str_replace($split, "0", $formuladb4);
                                }
                                elseif($data1->MONTH == "JUL" || $data1->MONTH == "AUG" || $data1->MONTH == "SEP")
                                {
                                    $formuladb1 = str_replace($split, "0", $formuladb1);
                                    $formuladb2 = str_replace($split, "0", $formuladb2);
                                    $formuladb3 = str_replace($split, $data1->ACTUAL_REALISASI, $formuladb3);
                                    $formuladb4 = str_replace($split, "0", $formuladb4);
                                }
                                elseif ($data1->MONTH == "OCT" || $data1->MONTH == "NOV" || $data1->MONTH == "DEC") 
                                {
                                    $formuladb1 = str_replace($split, "0", $formuladb1);
                                    $formuladb2 = str_replace($split, "0", $formuladb2);
                                    $formuladb3 = str_replace($split, "0", $formuladb3);
                                    $formuladb4 = str_replace($split, $data1->ACTUAL_REALISASI, $formuladb4);
                                }

                                // print_r($formuladb1);

                                if($data1->KETERANGAN == '-')
                                {
                                    $realisasirata = $realisasirata+1;
                                }
                                else
                                {
                                    $realisasirata = $realisasirata;   
                                }
                            }else{

                                if($data1->MONTH ==  "JAN" || $data1->MONTH == "FEB" || $data1->MONTH == "MAR")
                                {
                                    $formuladb1 = str_replace($split, "0", $formuladb1);
                                }
                                elseif ($data1->MONTH == "APR" || $data1->MONTH == "MAY" || $data1->MONTH == "JUN") {
                                    $formuladb2 = str_replace($split, "0" , $formuladb2);
                                }
                                elseif($data1->MONTH == "JUL" || $data1->MONTH == "AUG" || $data1->MONTH == "SEP")
                                {
                                    $formuladb3 = str_replace($split, "0" , $formuladb3);
                                }
                                elseif ($data1->MONTH == "OCT" || $data1->MONTH == "NOV" || $data1->MONTH == "DEC") {
                                    $formuladb4 = str_replace($split, "0" , $formuladb4);
                                }
                                $realisasirata = $realisasirata;
                            }
                        }
                    }else{

                        $formuladb1 = str_replace($split, "0", $formuladb1);
                        $formuladb2 = str_replace($split, "0", $formuladb2);
                        $formuladb3 = str_replace($split, "0", $formuladb3);
                        $formuladb4 = str_replace($split, "0", $formuladb4);
                        $realisasirata = 1;
                    }
                    
                    // print_r($realisasirata);

                    if($realisasirata == 0){
                        $realisasirata = 1;
                    }
                    
                    //print_r($split);

                    //$subtarget = $tgtsubind_list->TARGET;
                    //$subbobot = $tgtsubind_list->BOBOT;
                    $polar = \DB::table('tm_indicator as a')
                        ->where('a.INDICATOR_ID', '=', $split);
                    $getpolar = $polar->first();
                    //dd($getpolar);
                    // if($getpolar->POLARITAS == '+'){
                    //     $subpencapaian = (1+(($realisasi-$subtarget)/$subtarget))*100;
                    // }else if($getpolar->POLARITAS == '-'){
                    //     $subpencapaian = (1-(($realisasi-$subtarget)/$subtarget))*100;
                    // }

                    // dd($realisasi);
                    $realavg = $realisasi/$realisasirata;
                    $realbgt = 0;
                    if($getpolar->TIPE_PENJUMLAHAN == '='){
                        $realbgt = round($realisasi,2);
                    }else if($getpolar->TIPE_PENJUMLAHAN == ':'){
                        $realbgt = round($realavg,2);
                        // dd($realbgt);
                    }

                    //$subscore = $subpencapaian/100*$subbobot;
                   //dd( $realbgt);

                    array_push($target_subind_list, $tgtsubind_list);
                    array_push($real_subind_list, $realbgt);
                    array_push($realavg_subind_list, $realavg);
                    //array_push($pencapaian_subind_list, $subpencapaian);
                    //array_push($score_subind_list, $subscore);
                }
            }
            // print_r($real_subind_list);
            //
            $hasil1 = eval('return '.str_replace('x', '*', str_replace(':', '/', $formuladb1)).';');
            $hasil2 = eval('return '.str_replace('x', '*', str_replace(':', '/', $formuladb2)).';');
            $hasil3 = eval('return '.str_replace('x', '*', str_replace(':', '/', $formuladb3)).';');
            $hasil4 = eval('return '.str_replace('x', '*', str_replace(':', '/', $formuladb4)).';');
            //dd($hasil4);
            //print_r($formuladb1.'/'.$formuladb2.'/'.$formuladb3.'/'.$formuladb4);

            $a = 0;

            if($formuladb1 != 0 && $formuladb2 == 0 && $formuladb3 == 0 && $formuladb4 == 0)
            {
                $a = $a + 1; 
            }
            elseif ($formuladb1 == 0 && $formuladb2 != 0 && $formuladb3 == 0 && $formuladb4 == 0) {
                $a = $a + 1;
            }
            elseif ($formuladb1 == 0 && $formuladb2 == 0 && $formuladb3 != 0 && $formuladb4 == 0) {
                $a = $a + 1;
            }
            elseif ($formuladb1 == 0 && $formuladb2 == 0 && $formuladb3 == 0 && $formuladb4 != 0) {
                $a = $a + 1;
            }

            if($a == 0)
            {
                $a = 1;
            }

            
            // $sumrealsub = array_sum($realbgt);
            // $countrealsub = count($real_subind_list);
            // $hasilx = $sumrealsub/$countrealsub;

            // dd($hasilfix);
            $hasilfix = round($realbgt , 2);

            $target = $tgtind_list->TARGET;

            $bobot = $tgtind_list->BOBOT;
            $polar = \DB::table('tm_indicator as a')
                ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID);
            $getpolar = $polar->first();
            if($getpolar->POLARITAS == '+'){
                if($target == '0')
                {
                    $pencapaianx = (1+(($hasilfix-$target)/1))*100;
                }
                else
                {
                    $pencapaianx = (1+(($hasilfix-$target)/$target))*100;
                }

                $pencapaianfix = round($pencapaianx ,2);
                $pencapaianfixs = round($pencapaianx ,2);
            }else if($getpolar->POLARITAS == '-'){
                if($target == '0')
                {
                    $pencapaianx = (1-(($hasilfix-$target)/1))*100;
                }
                else
                {
                    $pencapaianx = (1-(($hasilfix-$target)/$target))*100;
                }
                
                $pencapaianfix = round($pencapaianx ,2);
                $pencapaianfixs = round($pencapaianx ,2);
            }

            //dd($target);

            if(intval($getpolar->MAX_SCORE) <= $pencapaianfixs){
                $pencapaianfixs = intval($getpolar->MAX_SCORE);
            }else if(intval($getpolar->MIN_SCORE) >= $pencapaianfixs){
                $pencapaianfixs = intval($getpolar->MIN_SCORE);
            }

            $scorex = $pencapaianfixs/100*$bobot;
            $scorefix = round($scorex , 2);
            // dd($getpolar);

            $ids_ordered = implode(',', $num_split);
            $items1 = \DB::table('tm_indicator as a')
                        ->leftJoin('tm_sub_division as b','a.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
                        ->whereIn('a.INDICATOR_ID',$num_split)
                        ->orderByRaw(\DB::raw("FIELD(a.INDICATOR_ID, $ids_ordered)"));
            $sub_in1 = $items1->get();
            $sub_in = $sub_in1->toArray();
            // dd($sub_in);
            array_push($sub_list, $sub_in);
            array_push($target_ind_list, $tgtind_list);
            array_push($hasil, $hasilfix);
            array_push($pencapaian_ind_list, $pencapaianfix);
            array_push($score_ind_list, $scorefix);
            unset($num_split);
        }
        $years = array_combine(range(date("Y"), 1960), range(date("Y"), 1960));
        $year = '';
        $months = array("I","II","III","IV");
        $month = '';
        // dd($score_ind_list);

        return view('kpi.input_kpi', [
            'now'                   => $now,
            'kpi_list'     => $kpi_list,
            'kpi'          => '',
            'sub_in'     => $sub_list,
            'years'     => $years,
            'year'     => $request->years[0],
            'months'     => $months,
            'month'     => $request->months[0],
            'target_ind_list'     => $target_ind_list,
            'target_subind_list'     => $target_subind_list,
            'real_subind_list'     => $real_subind_list,
            'pencapaian_subind_list'     => $pencapaian_subind_list,
            'score_subind_list'     => $score_subind_list,
            'hasil'     => $hasil,
            'pencapaian_ind_list'     => $pencapaian_ind_list,
            'score_ind_list'     => $score_ind_list,
        ]);
    }

    public function form_detail_txkpi($id)
    {

        $now            = Carbon::now();
        $items = \DB::table('tx_header_kpi as a')
                    ->leftJoin('tx_det_kpi as b' , 'a.HEADER_KPI_ID', '=', 'b.HEADER_KPI_ID')
                    ->leftJoin('tm_indicator as c', 'b.INDICATOR_ID', '=' , 'c.INDICATOR_ID')
                    ->leftJoin('tm_kpi as d', 'c.INDICATOR_ID', '=' , 'd.INDICATOR_ID')
                    ->select('a.HEADER_KPI_ID as HEADER_KPI_ID','b.DET_KPI_ID as DET_KPI_ID', 'c.INDICATOR_ID as INDICATOR_ID', 'c.INDICATOR_NAME as INDICATOR_NAME','b.ACTUAL_REALISASI as ACTUAL_REALISASI' , 'a.YEAR as YEAR', 'a.PERIOD as PERIOD','c.FORMULA as FORMULA','d.PERSPECTIVE','c.UNIT')
                    ->where('a.HEADER_KPI_ID', '=', $id);
        $kpi_list1 = $items->get();
        $kpi_list = $kpi_list1->toArray();
       
        $target_ind_list = array();
        $target_subind_list = array();
        $real_ind_list = array();
        $real_subind_list = array();
        $pencapaian_ind_list = array();
        $pencapaian_subind_list = array();
        $score_ind_list = array();
        $score_subind_list = array();
        $hasil = array();
        $sub_list = array();
        $sub_in = array();
        foreach ($kpi_list1 as $data) {
            $targetind = \DB::table('tm_target_triwulan as a')
                        ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
                        ->leftJoin('tm_sub_indicator as c', 'a.SUB_INDICATOR_ID', '=' , 'c.SUB_INDICATOR_ID')
                        ->select('a.TARGET_'.$data->PERIOD.' as TARGET', 'a.BOBOT_'.$data->PERIOD.' as BOBOT')
                        ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID)
                        ->where('a.YEAR', '=', $data->YEAR);
            $tgtind_list = $targetind->first();

            $pttn='+-/*()';   # standard mathematical operators
            $pttn=sprintf('@([%s])@', preg_quote($pttn)); # an escaped/quoted pattern

            $sub_ind=preg_split($pttn, preg_replace('@\s@', '', $data->FORMULA), -1, PREG_SPLIT_DELIM_CAPTURE);
            //dd($sub_ind);
            $num_split = array();
            $formuladb = $data->FORMULA;
            foreach ($sub_ind as $split){
                if(is_numeric($split)){
                    array_push($num_split, $split);
                    $targetsubind = \DB::table('tm_target_triwulan as a')
                                ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
                                ->select('a.TARGET_'.$data->PERIOD.' as TARGET', 'a.BOBOT_'.$data->PERIOD.' as BOBOT')
                                ->where('a.INDICATOR_ID', '=', $split)
                                ->where('a.YEAR', '=', $data->YEAR);
                    $tgtsubind_list = $targetsubind->first();

                    $sub_real = \DB::table('tx_det_kpi as a')
                                ->leftJoin('tx_sub_det_kpi as b', 'a.DET_KPI_ID', '=' , 'b.DET_KPI_ID')
                                ->leftJoin('tm_indicator as c', 'b.SUB_INDICATOR_ID', '=' , 'c.INDICATOR_ID')
                                ->leftJoin('tx_header_kpi as d', 'a.HEADER_KPI_ID', '=' , 'd.HEADER_KPI_ID')
                                ->where('c.INDICATOR_ID', '=', $split)
                                ->where('d.PERIOD', '=', $data->PERIOD)
                                ->where('d.YEAR', '=', $data->YEAR)
                                ->where('b.DET_KPI_ID', '=', $data->DET_KPI_ID);
                    $sub_real_list = $sub_real->get();
                   $realisasi = 0;
                    if(!$sub_real_list->isEmpty()){
                        foreach ($sub_real_list as $data1) {
                            $realisasi = $realisasi+$data1->ACTUAL_REALISASI;
                            if($data1 <> null){
                                $formuladb = str_replace($split, $data1->ACTUAL_REALISASI, $formuladb);
                            }else{
                                $formuladb = str_replace($split, "0", $formuladb);
                            }
                        }
                    }else{
                        $formuladb = str_replace($split, "0", $formuladb);
                    }
                    
                    //$subtarget = $tgtsubind_list->TARGET;
                    //$subbobot = $tgtsubind_list->BOBOT;
                    $polar = \DB::table('tm_indicator as a')
                    ->where('a.INDICATOR_ID', '=', $split);
                    $getpolar = $polar->first();
                    // if($getpolar->POLARITAS == '+'){
                    //     $subpencapaian = (1+(($realisasi-$subtarget)/$subtarget))*100;
                    // }else if($getpolar->POLARITAS == '+'){
                    //     $subpencapaian = (1-(($realisasi-$subtarget)/$subtarget))*100;
                    // }

                    // $subscore = $subpencapaian/100*$subbobot;

                    array_push($target_subind_list, $tgtsubind_list);
                    array_push($real_subind_list, $realisasi);
                    //array_push($pencapaian_subind_list, $subpencapaian);
                    //array_push($score_subind_list, $subscore);
                }
            }
            $hasilx = eval('return '.str_replace(':', '/', $formuladb).';');
            $hasilfix = round($hasilx , 2);
            $target = $tgtind_list->TARGET;
            $bobot = $tgtind_list->BOBOT;
            $polar = \DB::table('tm_indicator as a')
            ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID);
            $getpolar = $polar->first();
            if($getpolar->POLARITAS == '+'){
                $pencapaianx = (1+(($hasilfix-$target)/$target))*100;
                $pencapaianfix = round($pencapaianx ,2);
                $pencapaianfixs = round($pencapaianx ,2);
            }else if($getpolar->POLARITAS == '+'){
                $pencapaian = (1-(($hasilfix-$target)/$target))*100;
                $pencapaianfix = round($pencapaianx ,2);
                $pencapaianfixs = round($pencapaianx ,2);
            }

            if(intval($getpolar->MAX_SCORE) <= $pencapaianfixs){
                $pencapaianfixs = intval($getpolar->MAX_SCORE);
            }else if(intval($getpolar->MIN_SCORE) >= $pencapaianfixs){
                $pencapaianfixs = intval($getpolar->MIN_SCORE);
            }

            $scorex = $pencapaianfixs/100*$bobot;
            $scorefix = round($scorex , 2);
            
            $ids_ordered = implode(',', $num_split);
            $items1 = \DB::table('tm_indicator as a')
                        ->leftJoin('tm_sub_division as b','a.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
                        ->whereIn('a.INDICATOR_ID',$num_split)
                        ->orderByRaw(\DB::raw("FIELD(a.INDICATOR_ID, $ids_ordered)"));
            $sub_in1 = $items1->get();
            $sub_in = $sub_in1->toArray();
            array_push($sub_list, $sub_in);
            array_push($target_ind_list, $tgtind_list);
            array_push($hasil, $hasilfix);
            array_push($pencapaian_ind_list, $pencapaianfix);
            array_push($score_ind_list, $scorefix);
            unset($num_split);
        }
        $years = array_combine(range(date("Y"), 1960), range(date("Y"), 1960));
        $year = '';
        $months = array("I","II","III","IV");
        $month = '';


         return view('kpi.detail_kpi', [
            'now'                   => $now,
            'kpi_list'     => $kpi_list,
            'kpi'          => '',
            'sub_in'     => $sub_list,
            'target_ind_list'     => $target_ind_list,
            'target_subind_list'     => $target_subind_list,
            'real_subind_list'     => $real_subind_list,
            'pencapaian_subind_list'     => $pencapaian_subind_list,
            'score_subind_list'     => $score_subind_list,
            'hasil'     => $hasil,
            'pencapaian_ind_list'     => $pencapaian_ind_list,
            'score_ind_list'     => $score_ind_list,
        ]);
    }

    // public function excel_export(){
    //     Excel::create('Filename', function($excel) {

    //         $excel->sheet('Sheetname', function($sheet) {

    //             $sheet->fromArray(array(
    //                 array('data1', 'data2'),
    //                 array('data3', 'data4')
    //             ));

    //         });

    //     })->export('xls');
    // }

     public function excel_export(Request $request)
    {
        $months1 = $request->months1;
        $years1 = $request->years1;
        $branch1 = $request->branch1;

         // $fileExcel = 'Laporandata_'.$triwulan.'-'.$tahun.'-'.$pusatcabang
        
         $fileExcel = 'Laporandata_';
         //dd($excel);
        // Generate and return the spreadsheet
        Excel::create($fileExcel, function($excel) use ($months1, $years1, $branch1) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Payments');
            $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($months1, $years1, $branch1) {
                
                // $cells->setAlignment('center');
                // atur horizontal align

                // Set vertical alignment to middle
                // $cells->setValignment('center');

                // menambbahkan background
                // $cells->setBackground('#000000');


                $sheet->setCellValueByColumnAndRow(1, 1, "REALISASI KEY PERFORMANCE INDICATORS (KPI) TAHUN 2019 ", "");

                $border = array(
                        'borders' => array(
                            'allborders' => array(
                            'style' => 'thin',
                                'color' => array('rgb' => '000000')
                            )
                        )
                );
                

                $sheet->mergeCells('B1:I1');
                $sheet->cells('B1:I1', function($cells) use ($months1, $years1, $branch1) {
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '20',
                        'bold'       =>  true
                    ));

                    // atur horizontal align
                    $cells->setAlignment('center');

                    // atur vertical align
                    $cells->setValignment('center');
                    $cells->setBackground('#d9d9d9');

                });

                $sheet->mergeCells('B2:I2');
                
                $sheet->cell('B2', function($cell) use ($months1, $years1, $branch1) {
                    $cell->setValue('PT PELABUHAN TANJUNG PRIOK');
                });

                $sheet->cells('B2:I2', function($cells) use ($months1, $years1, $branch1) {
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '20',
                        'bold'       =>  true
                    ));

                    // atur horizontal align
                    $cells->setAlignment('center');

                    // atur vertical align
                    $cells->setValignment('center');
                    $cells->setBackground('#d9d9d9');

                    //#c3d79a

                });

                $Line=4;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $data = \DB::select("SELECT * FROM vw_Report_KPI WHERE YEAR= '$years1' and period = '$months1' and Pusat_Cabang = '$branch1'");

                ////////////////////////////////////query////////////////////////////////////

                
                $no=0;
                $total=0;

                        ++$Line;
                            $sheet->setCellValue('B'.$Line, 'NO');
                            $sheet->setSize('B'.$Line, 5, 18);
                            $sheet->setCellValue('C'.$Line, 'KPI TAHUN 2018');
                            $sheet->setSize('C'.$Line, 15, 18);
                            $sheet->setCellValue('D'.$Line, 'SATUAN');
                            $sheet->setSize('D'.$Line, 20, 18);
                            $sheet->setCellValue('E'.$Line, 'BOBOT');
                            $sheet->setSize('E'.$Line, 15, 18);
                            $sheet->setCellValue('F'.$Line, 'TARGET');
                            $sheet->setSize('F'.$Line, 15, 18);
                            $sheet->setCellValue('G'.$Line, 'REALISASI');
                            $sheet->setSize('G'.$Line, 15, 18);
                            $sheet->setCellValue('H'.$Line, 'PENCAPAIAN');
                            $sheet->setSize('H'.$Line, 15, 18);
                            $sheet->setCellValue('I'.$Line, 'SKOR');
                            $sheet->setSize('I'.$Line, 15, 18);
                           
                            $sheet->getStyle('B'. $Line . ':I' . $Line)->applyFromArray($border);
                            $sheet->getStyle('B'. $Line . ':I' . $Line)->getAlignment()->setHorizontal('Center');
                            $sheet->cells('B'. $Line . ':I' . $Line, function($cells) use ($months1, $years1, $branch1) {
                            $cells->setFont(array(
                                'bold'       =>  true
                            ));
                            $cells->setBackground('#d9d9d9');

                    });
                    
                    $no=0;
                       foreach ($data as $dataitem)
                       
                        {
                            ++$Line;
                            $sheet->setCellValue('B'.$Line);
                            $sheet->setSize('B'.$Line, 5, 18);
                            $sheet->setCellValue('C'.$Line, $dataitem->Perspective);
                            $sheet->setSize('C'.$Line, 15, 18);
                            $sheet->setCellValue('D'.$Line, "");
                            $sheet->setSize('D'.$Line, 20, 18);
                            $sheet->setCellValue('E'.$Line, $dataitem->Bobot);
                            $sheet->setSize('E'.$Line, 15, 18);
                            $sheet->setCellValue('F'.$Line, "");
                            $sheet->setSize('F'.$Line, 15, 18);
                            $sheet->setCellValue('G'.$Line, "");
                            $sheet->setSize('G'.$Line, 15, 18);
                            $sheet->setCellValue('H'.$Line,"");
                            $sheet->setSize('H'.$Line, 15, 18);
                            $sheet->setCellValue('I'.$Line, $dataitem->Score);
                            $sheet->setSize('I'.$Line, 15, 18);
                            
                            $sheet->getStyle('B'. $Line . ':I' . $Line)->applyFromArray($border);
                            $sheet->getStyle('B'. $Line . ':I' . $Line)->getAlignment()->setHorizontal('Center');
                            $sheet->cells('B'. $Line . ':I' . $Line, function($cells) use ($months1, $years1, $branch1) {
                            $cells->setFont(array(
                                'bold'       =>  true
                            ));
                            $cells->setBackground('#d9d9d9');

                    });

                        }
                        ////////////////////////////////////////////////////////////////////////////////////////////
                         {
                            ++$no;
                            ++$Line;
                            $sheet->setCellValue('B'.$Line, $no);
                            $sheet->setSize('B'.$Line, 5, 18);
                            $sheet->setCellValue('C'.$Line, $dataitem->Indicator_Name);
                            $sheet->setSize('C'.$Line, 15, 18);
                            $sheet->setCellValue('D'.$Line, $dataitem->Unit);
                            $sheet->setSize('D'.$Line, 20, 18);
                            $sheet->setCellValue('E'.$Line, $dataitem->Bobot);
                            $sheet->setSize('E'.$Line, 15, 18);
                            $sheet->setCellValue('F'.$Line, $dataitem->Target);
                            $sheet->setSize('F'.$Line, 15, 18);
                            $sheet->setCellValue('G'.$Line, $dataitem->Actual_Realisasi);
                            $sheet->setSize('G'.$Line, 15, 18);
                            $sheet->setCellValue('H'.$Line,$dataitem->Pencapaian);
                            $sheet->setSize('H'.$Line, 15, 18);
                            $sheet->setCellValue('I'.$Line, $dataitem->Score);
                            $sheet->setSize('I'.$Line, 15, 18);
                            
                            $sheet->getStyle('B'. $Line . ':I' . $Line)->applyFromArray($border);
                            $sheet->getStyle('B'. $Line . ':I' . $Line)->getAlignment()->setHorizontal('Center');
                            $sheet->cells('B'. $Line . ':F' . $Line, function($cells) use ($months1, $years1, $branch1) {
                            $cells->setBackground('#c3d79a');

                    });
                        }


                    ++$Line;
            });
            
        })->export('xls');
        
        
        }
    }