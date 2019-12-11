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

use Illuminate\Http\Request;
use Carbon\Carbon;

class TKPController extends Controller
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
    
    public function tkp_list(Request $request)
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

       $items = \DB::table('tm_indicator as a')
                    ->leftJoin('tm_ting_kes_per as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
                    ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
                    // ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
                    // ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
                    // ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
                    ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
                    ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','a.INDICATOR_NAME','a.UNIT','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','g.SUB_DIVISION_NAME')
                    ->where('a.IS_TINGKAT_KESEHATAN_PERUSAHAAN', 1)
                    ->orderBy('a.created_at', 'desc');
        $tkp_list = $items->get();
        $now            = Carbon::now();
        // dd($indicator_list);
        
        return view('tkp.tabel_tkp', [
                        'now'                   => $now,
                        'tkp_list'        => $tkp_list,
                        'directorat_list'   => $directorat_list,
                        'subdiv_list' => $subdiv_list,
                        'indicator_list' => $indicator_list
        ]);
    }

    public function form_edit_msttkpfix($id)
    {
           

        $items = \DB::table('tm_indicator as a')
                    ->leftJoin('tm_ting_kes_per as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
                    ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
                    ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
                    ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
                    ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','a.INDICATOR_NAME','a.UNIT','a.FORMULA','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','a.TIPE_TKP','g.SUB_DIVISION_NAME','d.DIRECTORATE_ID','d.DIRECTORATE_NAME','d.IS_CABANG','e.BRANCH_OFFICE_ID','e.BRANCH_OFFICE_NAME','f.DIVISION_ID','f.DIVISION_NAME','c.ORGANIZATION_STRUCTURE_ID','a.FORMULA_ALIAS','b.TARGET','b.BOBOT')
                    ->where('a.IS_TINGKAT_KESEHATAN_PERUSAHAAN', 1)
                    ->where('a.INDICATOR_ID', $id)
                    ->orderBy('a.created_at', 'desc');
        $tkp_list    = $items->get();
        //dd($tkp_list);
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

        $indicatorid    = $tkp_list[0]->INDICATOR_ID;
        $iddir          = $tkp_list[0]->DIRECTORATE_ID;
        $namedir        = $tkp_list[0]->DIRECTORATE_NAME;
        $idbranch       = $tkp_list[0]->BRANCH_OFFICE_ID;
        $namebranch     = $tkp_list[0]->BRANCH_OFFICE_NAME;
        $iddiv          = $tkp_list[0]->DIVISION_ID;
        $namediv        = $tkp_list[0]->DIVISION_NAME;
        $idsubdiv       = $tkp_list[0]->SUB_DIVISION_ID;
        $namesubdiv     = $tkp_list[0]->SUB_DIVISION_NAME;
        $nameindicator  = $tkp_list[0]->INDICATOR_NAME;
        $unit           = $tkp_list[0]->UNIT;
        $target         = $tkp_list[0]->TARGET;
        $bobot          = $tkp_list[0]->BOBOT;
        $formula        = $tkp_list[0]->FORMULA;
        $formulaalias   = $tkp_list[0]->FORMULA_ALIAS;
        $iscabang       = $tkp_list[0]->IS_CABANG;
        $tipetkp        = $tkp_list[0]->TIPE_TKP;
        $orgid          = $tkp_list[0]->ORGANIZATION_STRUCTURE_ID;

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

        return view('tkp.formedittmsrttkp', [
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
                        'unit'                  => $unit,
                        'target'                => $target,
                        'bobot'                 => $bobot,
                        'formula'               => $formula,
                        'formulaalias'          => $formulaalias,
                        'iscabang'              => $iscabang,
                        'tipetkp'               => $tipetkp,
                        'orgid'                 => $orgid,
                        'datalist'              => $datalist,
                        'datalist2'             => $datalist2,
                        'indicator_list'        => $indicator_list,
                        'branch_listx'          => $branch_listx    

        ]);
    }


    public function form_edit_status_msttkpfix($id)
    {
           

        $items = \DB::table('tm_indicator as a')
                    ->leftJoin('tm_ting_kes_per as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
                    ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
                    ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
                    ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
                    ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','a.INDICATOR_NAME','a.UNIT','a.FORMULA','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','a.TIPE_TKP','g.SUB_DIVISION_NAME','d.DIRECTORATE_ID','d.DIRECTORATE_NAME','d.IS_CABANG','e.BRANCH_OFFICE_ID','e.BRANCH_OFFICE_NAME','f.DIVISION_ID','f.DIVISION_NAME','c.ORGANIZATION_STRUCTURE_ID','a.FORMULA_ALIAS','b.TARGET','b.BOBOT')
                    ->where('a.IS_TINGKAT_KESEHATAN_PERUSAHAAN', 1)
                    ->where('a.INDICATOR_ID', $id)
                    ->orderBy('a.created_at', 'desc');
        $tkp_list    = $items->get();
        //dd($tkp_list);
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

        $indicatorid    = $tkp_list[0]->INDICATOR_ID;
        $iddir          = $tkp_list[0]->DIRECTORATE_ID;
        $namedir        = $tkp_list[0]->DIRECTORATE_NAME;
        $idbranch       = $tkp_list[0]->BRANCH_OFFICE_ID;
        $namebranch     = $tkp_list[0]->BRANCH_OFFICE_NAME;
        $iddiv          = $tkp_list[0]->DIVISION_ID;
        $namediv        = $tkp_list[0]->DIVISION_NAME;
        $idsubdiv       = $tkp_list[0]->SUB_DIVISION_ID;
        $namesubdiv     = $tkp_list[0]->SUB_DIVISION_NAME;
        $nameindicator  = $tkp_list[0]->INDICATOR_NAME;
        $unit           = $tkp_list[0]->UNIT;
        $target         = $tkp_list[0]->TARGET;
        $bobot          = $tkp_list[0]->BOBOT;
        $formula        = $tkp_list[0]->FORMULA;
        $formulaalias   = $tkp_list[0]->FORMULA_ALIAS;
        $iscabang       = $tkp_list[0]->IS_CABANG;
        $tipetkp        = $tkp_list[0]->TIPE_TKP;
        $status       	= $tkp_list[0]->ACTIVE;
        $orgid          = $tkp_list[0]->ORGANIZATION_STRUCTURE_ID;

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

        return view('tkp.formeditstatustmsrttkp', [
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
                        'unit'                  => $unit,
                        'target'                => $target,
                        'bobot'                 => $bobot,
                        'formula'               => $formula,
                        'formulaalias'          => $formulaalias,
                        'iscabang'              => $iscabang,
                        'tipetkp'				=> $tipetkp,
                        'orgid'                 => $orgid,
                        'datalist'              => $datalist,
                        'datalist2'             => $datalist2,
                        'indicator_list'        => $indicator_list,
                        'branch_listx'          => $branch_listx,
                        'status'                => $status    

        ]);
    }

    public function form_detail_msttkpfix($id)
    {
           

        $items = \DB::table('tm_indicator as a')
                    ->leftJoin('tm_ting_kes_per as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
                    ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
                    ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
                    ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
                    ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','a.INDICATOR_NAME','a.UNIT','a.FORMULA','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','a.TIPE_TKP','g.SUB_DIVISION_NAME','d.DIRECTORATE_ID','d.DIRECTORATE_NAME','d.IS_CABANG','e.BRANCH_OFFICE_ID','e.BRANCH_OFFICE_NAME','f.DIVISION_ID','f.DIVISION_NAME','c.ORGANIZATION_STRUCTURE_ID','a.FORMULA_ALIAS','b.TARGET','b.BOBOT')
                    ->where('a.IS_TINGKAT_KESEHATAN_PERUSAHAAN', 1)
                    ->where('a.INDICATOR_ID', $id)
                    ->orderBy('a.created_at', 'desc');
        $tkp_list    = $items->get();
        //dd($tkp_list);
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

        $indicatorid    = $tkp_list[0]->INDICATOR_ID;
        $iddir          = $tkp_list[0]->DIRECTORATE_ID;
        $namedir        = $tkp_list[0]->DIRECTORATE_NAME;
        $idbranch       = $tkp_list[0]->BRANCH_OFFICE_ID;
        $namebranch     = $tkp_list[0]->BRANCH_OFFICE_NAME;
        $iddiv          = $tkp_list[0]->DIVISION_ID;
        $namediv        = $tkp_list[0]->DIVISION_NAME;
        $idsubdiv       = $tkp_list[0]->SUB_DIVISION_ID;
        $namesubdiv     = $tkp_list[0]->SUB_DIVISION_NAME;
        $nameindicator  = $tkp_list[0]->INDICATOR_NAME;
        $unit           = $tkp_list[0]->UNIT;
        $target         = $tkp_list[0]->TARGET;
        $bobot          = $tkp_list[0]->BOBOT;
        $formula        = $tkp_list[0]->FORMULA;
        $formulaalias   = $tkp_list[0]->FORMULA_ALIAS;
        $iscabang       = $tkp_list[0]->IS_CABANG;
        $tipetkp        = $tkp_list[0]->TIPE_TKP;
        $status         = $tkp_list[0]->ACTIVE;
        $orgid          = $tkp_list[0]->ORGANIZATION_STRUCTURE_ID;

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

        return view('tkp.formdetailtmsrttkp', [
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
                        'unit'                  => $unit,
                        'target'                => $target,
                        'bobot'                 => $bobot,
                        'formula'               => $formula,
                        'formulaalias'          => $formulaalias,
                        'iscabang'              => $iscabang,
                        'tipetkp'				=> $tipetkp,
                        'orgid'                 => $orgid,
                        'datalist'              => $datalist,
                        'datalist2'             => $datalist2,
                        'indicator_list'        => $indicator_list,
                        'branch_listx'          => $branch_listx,
                        'status'                => $status    

        ]);
    }

     public function save_mst_indikator_tkp(Request $request)
    {
        //dd($request);
        $sub_division_idgabungan    = $request->sub_division_list;
        $explodesubdiv              = explode('-',$sub_division_idgabungan);
        $sub_division_id            = $explodesubdiv[0];
        $org_id                     = $explodesubdiv[1];
        $indicator_name             = $request->indicator_name;
        $unit                       = $request->unit;
        $tipetkp                    = $request->tipetkp;
        $target                     = $request->target;
        $bobot                      = $request->bobot;
        $formula                    = $request->formula;
        $formulaalias               = $request->formula_alias;

        $item = new Indicator;
        $item->SUB_DIVISION_ID = $sub_division_id;
        $item->INDICATOR_NAME = $indicator_name;
        $item->UNIT = $unit;
        $item->TIPE_TKP = $tipetkp;
        $item->IS_TINGKAT_KESEHATAN_PERUSAHAAN = '1';
        $formula = ltrim(ltrim($formula, '+'), '-');
        $formula = ltrim(ltrim($formula, '*'), '/');
        $item->FORMULA = $formula;
        $item->FORMULA_ALIAS = $formulaalias;
        $item->save();

        $idutama = \DB::getPdo()->lastInsertId();

            if($idutama != '')
            {
                $data2 = new Master_TKP;
                $data2->INDICATOR_ID = $idutama;
                $data2->ORGANIZATION_STRUCTURE_ID = $org_id;
                $data2->ACTIVE = 'N';
                $data2->TARGET = $target;
                $data2->BOBOT = $bobot;
                $data2->save();
            }

            $modul = "MASTER TKP";

            (new Main_Log)->setLog("Save Data Master TKP",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/tkp');
    }

    public function save_edit_mst_indikator_tkp(Request $request)
    {

        $id                         = $request->id;
        $sub_division_idgabungan    = $request->sub_division_list;
        $explodesubdiv              = explode('-',$sub_division_idgabungan);
        $sub_division_id            = $explodesubdiv[0];
        $org_id                     = $explodesubdiv[1];
        $indicator_name             = $request->indicator_name;
        $unit                       = $request->unit;
        $tipetkp                    = $request->tipetkp;
        $target                     = $request->target;
        $bobot                      = $request->bobot;
        $formula                    = $request->formula;
        $formulaalias               = $request->formula_alias;

        $item = Indicator::where('INDICATOR_ID', $id)->first();
        $item->SUB_DIVISION_ID = $sub_division_id;
        $item->INDICATOR_NAME = $indicator_name;
        $item->UNIT = $unit;
        $item->TIPE_TKP = $tipetkp;
        $item->IS_TINGKAT_KESEHATAN_PERUSAHAAN = '1';
        $formula = ltrim(ltrim($formula, '+'), '-');
        $formula = ltrim(ltrim($formula, '*'), '/');
        $item->FORMULA = $formula;
        $item->FORMULA_ALIAS = $formulaalias;
        $item->STATUS = '1';
        $item->update();

        if($item)
        {
            $data2 = Master_TKP::where('INDICATOR_ID', $id)->first();
            $data2->ORGANIZATION_STRUCTURE_ID = $org_id;
            $data2->ACTIVE = 'N';
            $data2->TARGET = $target;
            $data2->BOBOT = $bobot;
            $data2->update();
        }

        $modul = "MASTER TKP";

        (new Main_Log)->setLog("Update Data Master TKP",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/tkp');
    }

     public function save_edit_status_mst_indikator_tkp(Request $request)
    {
        //dd($request);
        $id                         = $request->id;
        $status                     = $request->status;

        
        $item = Indicator::where('INDICATOR_ID', $id)->first();
        $item->ACTIVE = $status;
        $item->update();

        if($item)
        {
            $data2 = Master_TKP::where('INDICATOR_ID', $id)->first();
            $data2->ACTIVE = $status;
            $data2->update();
        }

        $modul = "MASTER TKP";

        (new Main_Log)->setLog("Update Status Master TKP",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/tkp');
    }

     public function approve_mst_tkp_indikator(Request $request)
    {
    //    dd($request->id1);
        
        if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
            
            $item = Indicator::where('INDICATOR_ID', '=', $request->id)->first();
            $item->STATUS = '2';
            $item->save();

            $modul = "MASTER TKP";

            (new Main_Log)->setLog("Approved DVP Master TKP",json_encode($item),$modul,Auth::user()->ID);

        }else if(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){

            $item = Indicator::where('INDICATOR_ID', '=', $request->id)->first();
            $item->STATUS = '3';
            $item->ACTIVE = 'Y';
            $item->save();

            if($item)
            {
                $data2 = Master_TKP::where('INDICATOR_ID', $request->id)->first();
                $data2->ACTIVE = 'Y';
                $data2->update();
            }

            $modul = "MASTER TKP";

            (new Main_Log)->setLog("Approved VP Master TKP",json_encode($item),$modul,Auth::user()->ID);
        }
        return redirect('/tkp');
    }

    public function kembalikan_mst_tkp_indikator(Request $request)
    {

        if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){

           $item = Indicator::where('INDICATOR_ID', '=', $request->id1)->first();     
           $item->STATUS = '4';
           $item->ACTIVE = 'N';
           $item->ALASAN_KEMBALIKAN = $request->alasan;
           $item->save();

           $modul = "MASTER TKP";

           (new Main_Log)->setLog("Dikembalikan DVP Master TKP",json_encode($item),$modul,Auth::user()->ID);

        }elseif (Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU') {
            
           $item = Indicator::where('INDICATOR_ID', '=', $request->id1)->first();     
           $item->STATUS = '4';
           $item->ACTIVE = 'N';
           $item->ALASAN_KEMBALIKAN = $request->alasan;
           $item->save();

           if($item)
           {
            $data2 = Master_TKP::where('INDICATOR_ID', $request->id1)->first();
            $data2->ACTIVE = 'N';
            $data2->update();
           }

           $modul = "MASTER TKP";

           (new Main_Log)->setLog("Dikembalikan VP Master TKP",json_encode($item),$modul,Auth::user()->ID);

        }

        return redirect('/tkp');
    }
    
   
    public function form_tkp(Request $request)
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
        
        return view('tkp.form', [
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

    public function form_edit_msttkp(Request $request)
    {
        // dd($request->id);
        $itemselects = Master_TKP::where('TING_KES_PER_ID', $request->id)->first();
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
        
        return view('tkp.formedit', [
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

   public function save_mst_tkp(Request $request)
    {
        $indicator     = $request->indicator_list;
        $org     = Auth::user()->ORG_ID;
        foreach ($indicator as $indicator) {
            $item = new Master_TKP;
            $item->INDICATOR_ID = $indicator;
            $item->ORGANIZATION_STRUCTURE_ID = $org;
            $item->ACTIVE = 'Y';
            $item->save();
        }

        return redirect('/tkp');
    }

    public function edit_mst_tkp(Request $request)
    {
        //$organize_struct          = $request->organize_struct_list[0];
        $indicator     = $request->indicator_list[0];
        $status            = $request->status[0];

        $item = Master_TKP::where('TING_KES_PER_ID', $request->id)->first();
        $item->INDICATOR_ID = $indicator;
        $item->ACTIVE = $status;
        $item->save();

        return redirect('/tkp');
    }
   

    public function delete_mst_tkp(Request $request)
    {
        Master_TKP::where('TING_KES_PER_ID',$request->id)->delete();

        return redirect('/tkp');
    }


    //tkpx


     public function txtkp_list(Request $request)
    {   
        $items = \DB::table('tx_header_ting_kes_per as t')
                    ->leftJoin('tm_organization_structure as o', 'o.ORGANIZATION_STRUCTURE_ID', '=' , 't.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'sd.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'd.BRANCH_OFFICE_ID')
                    ->select('t.HEADER_TING_KES_PER_ID as TING_KES_PER_ID', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 't.YEAR as YEAR','t.APPROVED_1_STATUS', 't.APPROVED_2_STATUS', 't.ALASAN_KEMBALIKAN','t.TOTAL_KRITERIA')
                    ->where('o.ORGANIZATION_STRUCTURE_ID', '=', Auth::user()->ORG_ID)
                    ->where('t.IS_DELETED', 0)
                    ->orderBy('t.created_at','DESC');
        $tkp_list = $items->get();
        $now            = Carbon::now();
        
        $years = array(date('Y'),date('Y')-1);
        $year = '';

        return view('tkp.tabel_txtkp', [
                        'now'                   => $now,
                        'txtkp_list'        => $tkp_list,
                        'years'             => $years
        ]);
    }
    
    public function form_input_tkp(Request $request)
    {
        $years = $request->years;
        $now            = Carbon::now();
        $items = \DB::table('tm_ting_kes_per as a')
        ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
                    //->leftJoin('tm_organization_structure as c', 'a.ORGANIZATION_STRUCTURE_ID', '=' , 'c.ORGANIZATION_STRUCTURE_ID')
        ->select('a.TING_KES_PER_ID as TING_KES_PER_ID', 'b.INDICATOR_ID as INDICATOR_ID', 'b.INDICATOR_NAME as INDICATOR_NAME', 'b.UNIT as UNIT', 'b.FORMULA as FORMULA', 'b.TIPE_TKP','a.BOBOT','a.TARGET')
                    //->where('a.ORGANIZATION_STRUCTURE_ID', '=', Auth::user()->ORG_ID)
        ->where('a.ACTIVE', '=', 'Y')
        ->where('b.ACTIVE', '=', 'Y');
        $tkp_list1 = $items->get();
        $tkp_list = $tkp_list1->toArray();
        //dd($tkp_list);
        $sub_list = array();
        $real_ind_list = array();
        $real_subind_list = array();
        $hasil = array();
        $scores = array();
        $pencapaians = array();
        //dd($tkp_list);
        foreach ($tkp_list as $data) {
            $pttn='+-/*()';   # standard mathematical operators
            $pttn=sprintf('@([%s])@', preg_quote($pttn)); # an escaped/quoted pattern

            $sub_ind=preg_split($pttn, preg_replace('@\s@', '', $data->FORMULA), -1, PREG_SPLIT_DELIM_CAPTURE);
            $num_split = array();
            $formuladb = $data->FORMULA;
            $target = $data->TARGET;
            $bobot = $data->BOBOT;
            // print_r($formuladb);
            foreach ($sub_ind as $split){
                if(is_numeric($split)){
                    array_push($num_split, $split);
                    // print_r($split);
                    $avg = \DB::table('tx_header_sasaran_mutu as a')
                    ->leftJoin('tx_det_sasaran_mutu as b', 'a.HEADER_SASARAN_MUTU_ID', '=' , 'b.HEADER_SASARAN_MUTU_ID')
                    ->leftJoin('tm_indicator as c', 'c.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
                    ->Select(\DB::raw('avg(b.ACTUAL_REALISASI) as ACTUAL_REALISASI'),'b.KETERANGAN as KETERANGAN')
                    ->groupBy('b.INDICATOR_ID','KETERANGAN')
                     ->where('b.INDICATOR_ID', $split)
                    ->where('a.YEAR', $years)
                    ->where('a.STATUS', '3')
                    ->where('b.KETERANGAN', '-')
                    ->WHERE('c.TIPE_PENJUMLAHAN',':');
                    
                    $sum = \DB::table('tx_header_sasaran_mutu as a')
                    ->leftJoin('tx_det_sasaran_mutu as b', 'a.HEADER_SASARAN_MUTU_ID', '=' , 'b.HEADER_SASARAN_MUTU_ID')
                    ->leftJoin('tm_indicator as c', 'c.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
                    ->Select(\DB::raw('sum(b.ACTUAL_REALISASI) as ACTUAL_REALISASI'),'b.KETERANGAN as KETERANGAN')
                    ->groupBy('b.INDICATOR_ID','KETERANGAN')
                    ->where('b.INDICATOR_ID', $split)
                    ->where('a.YEAR', $years)
                    ->where('a.STATUS', '3')
                    ->where('b.KETERANGAN', '-')
                    ->WHERE('c.TIPE_PENJUMLAHAN','=')
                    ->union($avg);
                    
                    $sub_real_list = $sum->get();

                    // print_r($num_split);
                    // print_r($sub_real_list);
                    $realisasi = 0;
                    $realisasirata = 0;
                    if(!$sub_real_list->isEmpty()){
                        foreach ($sub_real_list as $data1) {
                            $realisasi = $realisasi+$data1->ACTUAL_REALISASI;
                            // print_r($realisasi);
                            if($data <> null){
                                $formuladb = str_replace($split, $data1->ACTUAL_REALISASI, $formuladb);
                                // print_r($formuladb);

                                if($data1->KETERANGAN == '-')
                                {
                                    $realisasirata = $realisasirata+1;
                                }
                                else
                                {
                                    $realisasirata = $realisasirata;   
                                }

                            }else{
                                $formuladb = str_replace($split, "0", $formuladb);
                                $realisasirata = $realisasirata;
                            }
                        }
                    }else{
                        $formuladb = str_replace($split, "0", $formuladb);
                        $realisasirata = 1;
                    }

                    if($realisasirata == 0){
                        $realisasirata = 1;
                    }

                    $tipepenjum = \DB::table('tm_indicator as a')
                        ->where('a.INDICATOR_ID', '=', $split);
                    $gettipepenjum = $tipepenjum->first();
                    //print_r($gettipepenjum);
                    // unset($plit);
                    $realavg = $realisasi/$realisasirata;

                    // $realbgt = 0;
                    if($gettipepenjum->TIPE_PENJUMLAHAN == '='){
                        $realbgt = round($realisasi, 2);
                    }else if($gettipepenjum->TIPE_PENJUMLAHAN == ':'){
                        $realbgt = round($realavg, 2);
                    }


                    array_push($real_subind_list, $realbgt);
                    // $real_subind_list['actual-'.$data1->ACTUAL_REALISASI] = $realbgt;
                    // print_r($real_subind_list);
                }
            }


            unset($realbgt);
            
            // print_r($realisasi);
            
            $hasilx = eval('return '.str_replace('x', '*', str_replace(':', '/', $formuladb)).';');
            $hasils = round($hasilx,2);
            // $pencapaianx = ($hasils-$target)/$target*100;
            $pencapaianx = $hasils/$target*100;
            $pencapaian = round($pencapaianx,2);
           
            // dd($hasils);
            if($sub_real_list != '')
            {
                foreach ($tkp_list as $tipe) {
                if ($tipe->TIPE_TKP == "ROE")
                {
                    if (15 < $hasils)
                    {
                        $score = 15;
                    }
                    else if (13 <$hasils && $hasils <= 15)
                    {
                        $score = 13.5;
                    }
                    else if (11 <$hasils && $hasils <= 13)
                    {
                        $score = 12;
                    }
                    else if (9 <$hasils && $hasils <= 11)
                    {
                        $score = 10.5;
                    }
                    else if (7.9 <$hasils && $hasils <= 9)
                    {
                        $score = 9;
                    }
                    else if (6.6 <$hasils && $hasils <= 7.9)
                    {
                        $score = 7.5;
                    }
                    else if (5.3 <$hasils && $hasils <= 6.6)
                    {
                        $score = 6;
                    }
                    else if (4 <$hasils && $hasils <= 5.3)
                    {
                        $score = 5;
                    }
                    else if (2.5 <$hasils && $hasils <= 4)
                    {
                        $score = 4;
                    }
                    else if (1 <$hasils && $hasils <= 2.5)
                    {
                        $score = 3;
                    }
                    else if (0 <$hasils && $hasils <= 1)
                    {
                        $score = 1.5;
                    }
                    else if ($hasils < 0)
                    {
                        $score = 1;
                    }
                }
                else if ($tipe->TIPE_TKP == "ROI")
                {
                    if (18 <$hasils)
                    {
                        $score = 10;
                    }
                    else if (15 <$hasils && $hasils <= 18)
                    {
                        $score = 9;
                    }
                    else if (13 <$hasils && $hasils <= 15)
                    {
                        $score = 8;
                    }
                    else if (12 <$hasils && $hasils <= 13)
                    {
                        $score = 7;
                    }
                    else if (10.5 <$hasils && $hasils <= 12)
                    {
                        $score = 6;
                    }
                    else if (9 <$hasils && $hasils <= 10.5)
                    {
                        $score = 5;
                    }
                    else if (7 <$hasils && $hasils <= 9)
                    {
                        $score = 4;
                    }
                    else if (5 <$hasils && $hasils <= 7)
                    {
                        $score = 3.5;
                    }
                    else if (3 <$hasils && $hasils <= 5)
                    {
                        $score = 3;
                    }
                    else if (1 <$hasils && $hasils <= 3)
                    {
                        $score = 2.5;
                    }
                    else if (0 <$hasils && $hasils <= 1)
                    {
                        $score = 2;
                    }
                    else if ($hasils < 0)
                    {
                        $score = 0;
                    }
                }
                else if ($tipe->TIPE_TKP == "CASH RATIO")
                {
                    if ($hasils >= 35)
                    {
                        $score = 3;
                    }
                    else if (25 <=$hasils && $hasils < 35)
                    {
                        $score = 2.5;
                    }
                    else if (15 <=$hasils && $hasils < 25)
                    {
                        $score = 2;
                    }
                    else if (10 <=$hasils && $hasils < 15)
                    {
                        $score = 1.5;
                    }
                    else if (5 <=$hasils && $hasils < 10)
                    {
                        $score = 1;
                    }
                    else if (0 <=$hasils && $hasils < 5)
                    {
                        $score = 0;
                    }
                }
                else if ($tipe->TIPE_TKP == "CURRENT RATIO")
                {
                    if (125 <=$hasils)
                    {
                        $score = 3;
                    }
                    else if (110 <=$hasils && $hasils < 125)
                    {
                        $score = 2.5;
                    }
                    else if (100 <=$hasils && $hasils < 110)
                    {
                        $score = 2;
                    }
                    else if (95 <=$hasils && $hasils < 100)
                    {
                        $score = 1.5;
                    }
                    else if (90 <=$hasils && $hasils < 95)
                    {
                        $score = 1;
                    }
                    else if ($hasils < 90)
                    {
                        $score = 0;
                    }
                }
                else if ($tipe->TIPE_TKP == "COLLECTION PERIOD")
                {
                    if ($hasils <= 60)
                    {
                        $score = 4;
                    }
                    else if (60 <$hasils && $hasils <= 90)
                    {
                        $score = 3.5;
                    }
                    else if (90 <$hasils && $hasils <= 120)
                    {
                        $score = 3;
                    }
                    else if (120 <$hasils && $hasils <= 150)
                    {
                        $score = 2.5;
                    }
                    else if (150 <$hasils && $hasils <= 180)
                    {
                        $score = 2;
                    }
                    else if (180 <$hasils && $hasils <= 210)
                    {
                        $score = 1.6;
                    }
                    else if (210 <$hasils && $hasils <= 240)
                    {
                        $score = 1.2;
                    }
                    else if (240 <$hasils && $hasils <= 270)
                    {
                        $score = 0.8;
                    }
                    else if (270 <$hasils && $hasils <= 300)
                    {
                        $score = 0.4;
                    }
                    else if (300 <$hasils)
                    {
                        $score = 0;
                    }
                }
                else if ($tipe->TIPE_TKP == "INVENTORY TURNOVER")
                {
                    if ($hasils <= 60)
                    {
                        $score = 4;
                    }
                    else if (60 <$hasils && $hasils <= 90)
                    {
                        $score = 3.5;
                    }
                    else if (90 <$hasils && $hasils <= 120)
                    {
                        $score = 3;
                    }
                    else if (120 <$hasils && $hasils <= 150)
                    {
                        $score = 2.5;
                    }
                    else if (150 <$hasils && $hasils <= 180)
                    {
                        $score = 2;
                    }
                    else if (180 <$hasils && $hasils <= 210)
                    {
                        $score = 1.6;
                    }
                    else if (210 <$hasils && $hasils <= 240)
                    {
                        $score = 1.2;
                    }
                    else if (240 <$hasils && $hasils <= 270)
                    {
                        $score = 0.8;
                    }
                    else if (270 <$hasils && $hasils <= 300)
                    {
                        $score = 0.4;
                    }
                    else if (300 <$hasils)
                    {
                        $score = 0;
                    }
                }
                else if ($tipe->TIPE_TKP == "TATO")
                {
                    if (120 <$hasils)
                    {
                        $score = 4;
                    }
                    else if (105 <$hasils && $hasils <= 120)
                    {
                        $score = 3.5;
                    }
                    else if (90 <$hasils && $hasils <= 105)
                    {
                        $score = 3;
                    }
                    else if (75 <$hasils && $hasils <= 90)
                    {
                        $score = 2.5;
                    }
                    else if (60 <$hasils && $hasils <= 75)
                    {
                        $score = 2;
                    }
                    else if (40 <$hasils && $hasils <= 60)
                    {
                        $score = 1.5;
                    }
                    else if (20 <$hasils && $hasils <= 40)
                    {
                        $score = 1;
                    }
                    else if ($hasils <= 20)
                    {
                        $score = 0.5;
                    }
                }
                else if ($tipe->TIPE_TKP == "TMS Terhadap TA")
                {
                    if ($hasils < 0)
                    {
                        $score = 0;
                    }
                    else if (0 <=$hasils && $hasils < 10)
                    {
                        $score = 2;
                    }
                    else if (10 <=$hasils && $hasils < 20)
                    {
                        $score = 3;
                    }
                    else if (20 <=$hasils && $hasils < 30)
                    {
                        $score = 4;
                    }
                    else if (30 <=$hasils && $hasils < 40)
                    {
                        $score = 6;
                    }
                    else if (40 <=$hasils && $hasils < 50)
                    {
                        $score = 5.5;
                    }
                    else if (50 <=$hasils && $hasils < 60)
                    {
                        $score = 5;
                    }
                    else if (60 <=$hasils && $hasils < 70)
                    {
                        $score = 4.5;
                    }
                    else if (70 <=$hasils && $hasils < 80)
                    {
                        $score = 4.25;
                    }
                    else if (80 <=$hasils && $hasils < 90)
                    {
                        $score = 4;
                    }
                    else if (90 <=$hasils && $hasils < 100)
                    {
                        $score = 3.5;
                    }
                }
                elseif($tipe->TIPE_TKP == "Operasional")
                {
                    if ($pencapaian >= 100)
                    {
                        $score = $bobot*100/100;
                    }
                    else if ($pencapaian > 90 && $pencapaian < 100)
                    {
                        $score = $bobot *80/100;
                    }
                    else if ($pencapaian > 80 && $pencapaian <= 90)
                    {
                        $score = $bobot*50/100;
                    }
                    else if ($pencapaian <= 80)
                    {
                        $score = $bobot*20/100;
                    }
                }
            }
            }
            else
            {
                $score = 0;
            }
           
            $ids_ordered = implode(',', $num_split);           
            $items1 = \DB::table('tm_indicator as a')
            ->leftJoin('tm_sub_division as b','a.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
            ->whereIn('a.INDICATOR_ID',$num_split)
            ->orderByRaw(\DB::raw("FIELD(a.INDICATOR_ID, $ids_ordered)"));
            $sub_in1 = $items1->get();
            $sub_in = $sub_in1->toArray();
            // print_r($sub_in);
            array_push($sub_list, $sub_in);
            array_push($hasil, $hasils);
            array_push($scores, $score);
            array_push($pencapaians, $pencapaian);
            unset($num_split);
        }
        //dd($pencapains);
        return view('tkp.input_tkp', [
            'now'                   => $now,
            'tkp_list'     => $tkp_list,
            'tkp'          => '',
            'sub_in'     => $sub_list,
            'years'     => $years,
            'real_subind_list' => $real_subind_list,
            'hasil'     => $hasil,
            'score'     => $scores,
            'pencapaian' => $pencapaians
        ]);
    }

     public function save_tx_tkp(Request $request)
    {

       $iscek = \DB::table('tx_header_ting_kes_per as a')
       ->select('a.YEAR')
       ->where('a.YEAR',$request->tahun[0])
       ->where('a.IS_DELETED', '=' , 0)
       ->count();
       if($iscek == 0)
        {
            $head = new Head_TKP;
            $head->ORGANIZATION_STRUCTURE_ID = Auth::user()->ORG_ID;
            $head->YEAR = $request->tahun[0];
            $head->TOTAL_KRITERIA = $request->totalfix;
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
                $det = new Det_TKP;
                $det->HEADER_TING_KES_PER_ID = $idhead;
                $det->INDICATOR_ID = $data;
                $det->ACTUAL_REALISASI = $request->hasilratio[$i];
                $det->SCORE = $request->score[$i];
                $det->PENCAPAIAN = $request->pencapaian[$i];
                $det->save();
                $i = $i+1;

                $iddet = \DB::getPdo()->lastInsertId();
                //Sub Detil
                $num_split = array();
                foreach ($sub_ind as $split){
                    if(is_numeric($split)){
                        // $formuladb = str_replace($split, $request->actual[$i], $formuladb);
                        $sub_det = new Sub_Det_TKP;
                        $sub_det->DET_TINGKAT_KESEHATAN_PERUSAHAAN_ID = $iddet;
                        $sub_det->INDICATOR_ID = $request->sub_ind_id[$j];
                        $sub_det->ACTUAL_REALISASI = $request->realisasi[$j];
                        $sub_det->save();
                        $j = $j+1;
                    }
                    
                }
                // array_push($hasil, $hasils);
                $k = $k+1;
            }

            $modul = "TRANSACTION TKP";

            (new Main_Log)->setLog("Save Data TRANSACTION TKP",json_encode($head),$modul,Auth::user()->ID);

            return redirect('/txtkp');
        }
        else
        {

             return redirect('/txtkp')->with('error','Data Sudah Ada!!!');
        }

        
    }


    public function getmastertxtkp($id)
    {
        $data = \DB::table('tx_header_ting_kes_per as a')
        ->where('a.HEADER_TING_KES_PER_ID', $id)->first();

        return response()->json($data);
        
    }

     public function save_approvaldvptxtkp(Request $request)
    {

        $id    = $request->id;
        $iduser = Auth::user()->ID;

        $datautama = Head_TKP::where('HEADER_TING_KES_PER_ID',$id)->first();
        $datautama->APPROVED_1_BY = $iduser;
        $datautama->APPROVED_1_STATUS = '1';
        $datautama->update();

        $modul = "TRANSACTION TKP";

        (new Main_Log)->setLog("Approved DVP TRANSACTION TKP",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/txtkp');
    }

     public function save_approvalvptxtkp(Request $request)
    {
        $id    = $request->id1;
        $iduser = Auth::user()->ID;

        $datautama = Head_TKP::where('HEADER_TING_KES_PER_ID',$id)->first();
        $datautama->APPROVED_2_BY = $iduser;
        $datautama->APPROVED_2_STATUS = '1';
        $datautama->update();

        $modul = "TRANSACTION TKP";

        (new Main_Log)->setLog("Approved VP TRANSACTION TKP",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/txtkp');
    }

     public function save_kembalikantxtkp(Request $request)
    {
        $id    = $request->id2;
        $iduser = Auth::user()->ID;
        $alasan = $request->alasan;

        if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
        {

           $datautama = Head_TKP::where('HEADER_TING_KES_PER_ID',$id)->first();
           $datautama->APPROVED_1_BY = $iduser;
           $datautama->APPROVED_1_STATUS = '2';
           $datautama->APPROVED_2_BY = $iduser;
           $datautama->APPROVED_2_STATUS = '2';
           $datautama->IS_DELETED = '1';
           $datautama->ALASAN_KEMBALIKAN = $alasan;
           $datautama->update();

           $modul = "TRANSACTION TKP";

           (new Main_Log)->setLog("Dikembalikan DVP TRANSACTION TKP",json_encode($datautama),$modul,Auth::user()->ID);

        }elseif (Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU') {
            
            $datautama = Head_TKP::where('HEADER_TING_KES_PER_ID',$id)->first();
            $datautama->APPROVED_1_BY = $iduser;
            $datautama->APPROVED_1_STATUS = '2';
            $datautama->APPROVED_2_BY = $iduser;
            $datautama->APPROVED_2_STATUS = '2';
            $datautama->IS_DELETED = '1';
            $datautama->ALASAN_KEMBALIKAN = $alasan;
            $datautama->update();

            $modul = "TRANSACTION TKP";

            (new Main_Log)->setLog("Dikembalikan VP TRANSACTION TKP",json_encode($datautama),$modul,Auth::user()->ID);

        }elseif (Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU') {
            
            $datautama = Head_TKP::where('HEADER_TING_KES_PER_ID',$id)->first();
            $datautama->APPROVED_1_BY = $iduser;
            $datautama->APPROVED_1_STATUS = '2';
            $datautama->APPROVED_2_BY = $iduser;
            $datautama->APPROVED_2_STATUS = '2';
            $datautama->IS_DELETED = '1';
            $datautama->ALASAN_KEMBALIKAN = $alasan;
            $datautama->update();

            $modul = "TRANSACTION TKP";

            (new Main_Log)->setLog("Dikembalikan ADMIN TRANSACTION TKP",json_encode($datautama),$modul,Auth::user()->ID);

        }


        return redirect('/txtkp');
    }

    public function form_preview_txtkp($id)
    {

        $now            = Carbon::now();
        $items = \DB::table('tx_header_ting_kes_per as a')
                    ->leftJoin('tx_det_tingkat_kesehatan_perusahaan as b' , 'a.HEADER_TING_KES_PER_ID', '=', 'b.HEADER_TING_KES_PER_ID')
                    ->leftJoin('tm_indicator as c', 'b.INDICATOR_ID', '=' , 'c.INDICATOR_ID')
                    ->leftJoin('tm_ting_kes_per as d', 'c.INDICATOR_ID', '=' , 'd.INDICATOR_ID')
                    ->select('a.HEADER_TING_KES_PER_ID as HEADER_TING_KES_PER_ID', 'c.INDICATOR_ID as INDICATOR_ID', 'c.INDICATOR_NAME as INDICATOR_NAME', 'a.TOTAL_KRITERIA as TOTAL_KRITERIA', 'b.ACTUAL_REALISASI as ACTUAL_REALISASI', 'b.SCORE as SCORE','c.UNIT as UNIT' , 'a.YEAR','d.BOBOT','d.TARGET','c.TIPE_TKP','b.PENCAPAIAN')
                    ->where('a.HEADER_TING_KES_PER_ID', '=', $id);
        $tkp_list1 = $items->get();
        $tkp_list = $tkp_list1->toArray();
        //dd($tkp_list);
        $sub_in = array();
        foreach ($tkp_list as $data) {
                    $sub_real = \DB::table('tx_det_tingkat_kesehatan_perusahaan as a')
                    ->leftJoin('tx_sub_det_tingkat_kesehatan_perusahaan as b', 'a.DET_TINGKAT_KESEHATAN_PERUSAHAAN_ID', '=' , 'b.DET_TINGKAT_KESEHATAN_PERUSAHAAN_ID')
                    ->leftJoin('tm_indicator as c', 'b.INDICATOR_ID', '=' , 'c.INDICATOR_ID')
                    ->leftJoin('tm_sub_division as d','c.SUB_DIVISION_ID', '=' , 'd.SUB_DIVISION_ID')
                    ->select('a.DET_TINGKAT_KESEHATAN_PERUSAHAAN_ID as DET_TINGKAT_KESEHATAN_PERUSAHAAN_ID', 'b.INDICATOR_ID as INDICATOR_ID', 'c.INDICATOR_NAME as INDICATOR_NAME', 'a.HEADER_TING_KES_PER_ID as HEADER_TING_KES_PER_ID', 'b.ACTUAL_REALISASI as ACTUAL_REALISASI','c.UNIT as UNIT','d.SUB_DIVISION_NAME as SUB_DIVISION_NAME')
                    ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID);
                    $sub_real_list = $sub_real->get();
                    $real_subind_list = $sub_real_list->toArray();
                    // dd($real_subind_list);
                    array_push($sub_in, $real_subind_list);
        }
        // dd($sub_in);
        // dd($real_subind_list[0]->DET_TINGKAT_KESEHATAN_PERUSAHAAN_ID);
        return view('tkp.preview_tkp', [
            'now'                   => $now,
            'tkp_list'     => $tkp_list,
            'tkp'          => '',
            'sub_in_list'     => $sub_in,
        ]);
    }
}
