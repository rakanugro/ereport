<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\Indicator_Target;
use App\Models\Sub_Indicator;
use App\Models\Period;
use App\Models\Sub_Division;
use App\Models\Master_Sarmut;
use App\Models\Det_Sarmut;
use App\Models\Sub_Det_Sarmut;
use App\Models\Head_Sarmut;
use App\Models\Main_Log;
use Auth;
use Session, Cookie;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SarmutController extends Controller
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
    
    public function sarmut_list(Request $request)
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

        $items = \DB::table('tm_indicator as a')
        ->leftJoin('tm_ind_sasaran_mutu as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
        ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
                    // ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
                    // ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
                    // ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
        ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','a.SUB_DIVISION_ID_PENGISI','a.INDICATOR_NAME','a.UNIT','a.PERIODE_PENGISIAN','a.TIPE_PENJUMLAHAN','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','g.SUB_DIVISION_NAME')
        ->where('a.IS_SASARAN_MUTU', 1)
        ->orderBy('a.created_at', 'desc');
        $sarmut_list = $items->get();
        $now            = Carbon::now();
        //dd($sarmut_list);
        
        return view('sarmut.tabel_sarmut', [
            'now'                   => $now,
            'sarmut_list'        => $sarmut_list,
            'directorat_list'   => $directorat_list,
            'subdiv_list' => $subdiv_list
        ]);
    }

    public function form_edit_mstsarmutfix($id)
    {


        $items = \DB::table('tm_indicator as a')
        ->leftJoin('tm_ind_sasaran_mutu as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
        ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
        ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
        ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
        ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
        ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
        ->leftJoin('tm_sub_division as h', 'h.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID_PENGISI')
        ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','a.SUB_DIVISION_ID_PENGISI','a.INDICATOR_NAME','a.INPUTABLE','a.UNIT','a.PERIODE_PENGISIAN','a.TIPE_PENJUMLAHAN','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','g.SUB_DIVISION_NAME',
            'h.SUB_DIVISION_ID as SUB_DIVISION_ID_PENGISI','h.SUB_DIVISION_NAME as SUB_DIVISION_NAME_PENGISI','d.DIRECTORATE_ID','d.DIRECTORATE_NAME','d.IS_CABANG','e.BRANCH_OFFICE_ID','e.BRANCH_OFFICE_NAME','f.DIVISION_ID','f.DIVISION_NAME','c.ORGANIZATION_STRUCTURE_ID')
        ->where('a.IS_SASARAN_MUTU', 1)
        ->where('a.INDICATOR_ID', $id)
        ->orderBy('a.created_at', 'desc');
        $sarmut_list    = $items->get();

        $now            = Carbon::now();

        $indicatorid    = $sarmut_list[0]->INDICATOR_ID;
        $iddir          = $sarmut_list[0]->DIRECTORATE_ID;
        $namedir        = $sarmut_list[0]->DIRECTORATE_NAME;
        $idbranch       = $sarmut_list[0]->BRANCH_OFFICE_ID;
        $namebranch     = $sarmut_list[0]->BRANCH_OFFICE_NAME;
        $iddiv          = $sarmut_list[0]->DIVISION_ID;
        $namediv        = $sarmut_list[0]->DIVISION_NAME;
        $idsubdiv       = $sarmut_list[0]->SUB_DIVISION_ID;
        $namesubdiv     = $sarmut_list[0]->SUB_DIVISION_NAME;
        $nameindicator  = $sarmut_list[0]->INDICATOR_NAME;
        $inputable      = $sarmut_list[0]->INPUTABLE;
        $idsubdivpeng   = $sarmut_list[0]->SUB_DIVISION_ID_PENGISI;
        $namesubdivpeng = $sarmut_list[0]->SUB_DIVISION_NAME_PENGISI;
        $unit           = $sarmut_list[0]->UNIT;
        $perpengsisi    = $sarmut_list[0]->PERIODE_PENGISIAN;
        $tipepenjum     = $sarmut_list[0]->TIPE_PENJUMLAHAN;
        $iscabang       = $sarmut_list[0]->IS_CABANG;
        $orgid          = $sarmut_list[0]->ORGANIZATION_STRUCTURE_ID;

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

       return view('sarmut.formedittmsrtmaster', [
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
        'inputable'             => $inputable,
        'idsubdivpeng'          => $idsubdivpeng,
        'namesubdivpeng'        => $namesubdivpeng,
        'unit'                  => $unit,
        'perpengsisi'           => $perpengsisi,
        'tipepenjum'            => $tipepenjum,
        'iscabang'              => $iscabang,
        'orgid'                 => $orgid,
        'datalist'              => $datalist,
        'datalist2'             => $datalist2    

    ]);
   }

   public function form_edit_status_mstsarmutfix($id)
   {

    $items = \DB::table('tm_indicator as a')
    ->leftJoin('tm_ind_sasaran_mutu as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
    ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
    ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
    ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
    ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
    ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
    ->leftJoin('tm_sub_division as h', 'h.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID_PENGISI')
    ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','a.SUB_DIVISION_ID_PENGISI','a.INDICATOR_NAME','a.INPUTABLE','a.UNIT','a.PERIODE_PENGISIAN','a.TIPE_PENJUMLAHAN','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','g.SUB_DIVISION_NAME',
        'h.SUB_DIVISION_ID as SUB_DIVISION_ID_PENGISI','h.SUB_DIVISION_NAME as SUB_DIVISION_NAME_PENGISI','d.DIRECTORATE_ID','d.DIRECTORATE_NAME','d.IS_CABANG','e.BRANCH_OFFICE_ID','e.BRANCH_OFFICE_NAME','f.DIVISION_ID','f.DIVISION_NAME','c.ORGANIZATION_STRUCTURE_ID')
    ->where('a.IS_SASARAN_MUTU', 1)
    ->where('a.INDICATOR_ID', $id)
    ->orderBy('a.created_at', 'desc');
    $sarmut_list    = $items->get();

    $now            = Carbon::now();

    $indicatorid    = $sarmut_list[0]->INDICATOR_ID;
    $iddir          = $sarmut_list[0]->DIRECTORATE_ID;
    $namedir        = $sarmut_list[0]->DIRECTORATE_NAME;
    $idbranch       = $sarmut_list[0]->BRANCH_OFFICE_ID;
    $namebranch     = $sarmut_list[0]->BRANCH_OFFICE_NAME;
    $iddiv          = $sarmut_list[0]->DIVISION_ID;
    $namediv        = $sarmut_list[0]->DIVISION_NAME;
    $idsubdiv       = $sarmut_list[0]->SUB_DIVISION_ID;
    $namesubdiv     = $sarmut_list[0]->SUB_DIVISION_NAME;
    $nameindicator  = $sarmut_list[0]->INDICATOR_NAME;
    $inputable      = $sarmut_list[0]->INPUTABLE;
    $idsubdivpeng   = $sarmut_list[0]->SUB_DIVISION_ID_PENGISI;
    $namesubdivpeng = $sarmut_list[0]->SUB_DIVISION_NAME_PENGISI;
    $unit           = $sarmut_list[0]->UNIT;
    $perpengsisi    = $sarmut_list[0]->PERIODE_PENGISIAN;
    $tipepenjum     = $sarmut_list[0]->TIPE_PENJUMLAHAN;
    $iscabang       = $sarmut_list[0]->IS_CABANG;
    $orgid          = $sarmut_list[0]->ORGANIZATION_STRUCTURE_ID;
    $status         = $sarmut_list[0]->ACTIVE;

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

   return view('sarmut.formeditstatustmsrtmaster', [
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
    'inputable'             => $inputable,
    'idsubdivpeng'          => $idsubdivpeng,
    'namesubdivpeng'        => $namesubdivpeng,
    'unit'                  => $unit,
    'perpengsisi'           => $perpengsisi,
    'tipepenjum'            => $tipepenjum,
    'iscabang'              => $iscabang,
    'orgid'                 => $orgid,
    'datalist'              => $datalist,
    'datalist2'             => $datalist2,
    'status'                => $status    

]);
}

public function form_detail_mstsarmutfix($id)
{

    $items = \DB::table('tm_indicator as a')
    ->leftJoin('tm_ind_sasaran_mutu as b', 'b.INDICATOR_ID', '=' , 'a.INDICATOR_ID')
    ->leftJoin('tm_organization_structure as c', 'c.ORGANIZATION_STRUCTURE_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
    ->leftJoin('tm_directorate as d', 'd.DIRECTORATE_ID', '=' , 'c.DIRECTORATE_ID')
    ->leftJoin('tm_branch_office as e', 'e.BRANCH_OFFICE_ID', '=' , 'c.BRANCH_OFFICE_ID')
    ->leftJoin('tm_division as f', 'f.DIVISION_ID', '=' , 'c.DIVISION_ID')
    ->leftJoin('tm_sub_division as g', 'g.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
    ->leftJoin('tm_sub_division as h', 'h.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID_PENGISI')
    ->select('a.INDICATOR_ID','a.SUB_DIVISION_ID','a.SUB_DIVISION_ID_PENGISI','a.INDICATOR_NAME','a.INPUTABLE','a.UNIT','a.PERIODE_PENGISIAN','a.TIPE_PENJUMLAHAN','a.ACTIVE','a.STATUS','a.ALASAN_KEMBALIKAN','g.SUB_DIVISION_NAME',
        'h.SUB_DIVISION_ID as SUB_DIVISION_ID_PENGISI','h.SUB_DIVISION_NAME as SUB_DIVISION_NAME_PENGISI','d.DIRECTORATE_ID','d.DIRECTORATE_NAME','d.IS_CABANG','e.BRANCH_OFFICE_ID','e.BRANCH_OFFICE_NAME','f.DIVISION_ID','f.DIVISION_NAME','c.ORGANIZATION_STRUCTURE_ID')
    ->where('a.IS_SASARAN_MUTU', 1)
    ->where('a.INDICATOR_ID', $id)
    ->orderBy('a.created_at', 'desc');
    $sarmut_list    = $items->get();

    $now            = Carbon::now();

    $indicatorid    = $sarmut_list[0]->INDICATOR_ID;
    $iddir          = $sarmut_list[0]->DIRECTORATE_ID;
    $namedir        = $sarmut_list[0]->DIRECTORATE_NAME;
    $idbranch       = $sarmut_list[0]->BRANCH_OFFICE_ID;
    $namebranch     = $sarmut_list[0]->BRANCH_OFFICE_NAME;
    $iddiv          = $sarmut_list[0]->DIVISION_ID;
    $namediv        = $sarmut_list[0]->DIVISION_NAME;
    $idsubdiv       = $sarmut_list[0]->SUB_DIVISION_ID;
    $namesubdiv     = $sarmut_list[0]->SUB_DIVISION_NAME;
    $nameindicator  = $sarmut_list[0]->INDICATOR_NAME;
    $inputable      = $sarmut_list[0]->INPUTABLE;
    $idsubdivpeng   = $sarmut_list[0]->SUB_DIVISION_ID_PENGISI;
    $namesubdivpeng = $sarmut_list[0]->SUB_DIVISION_NAME_PENGISI;
    $unit           = $sarmut_list[0]->UNIT;
    $perpengsisi    = $sarmut_list[0]->PERIODE_PENGISIAN;
    $tipepenjum     = $sarmut_list[0]->TIPE_PENJUMLAHAN;
    $iscabang       = $sarmut_list[0]->IS_CABANG;
    $orgid          = $sarmut_list[0]->ORGANIZATION_STRUCTURE_ID;
    $status         = $sarmut_list[0]->ACTIVE;

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

   return view('sarmut.formdetailtmsrtmaster', [
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
    'inputable'             => $inputable,
    'idsubdivpeng'          => $idsubdivpeng,
    'namesubdivpeng'        => $namesubdivpeng,
    'unit'                  => $unit,
    'perpengsisi'           => $perpengsisi,
    'tipepenjum'            => $tipepenjum,
    'iscabang'              => $iscabang,
    'orgid'                 => $orgid,
    'datalist'              => $datalist,
    'datalist2'             => $datalist2,
    'status'                => $status    

]);
}

public function mst_getdivbranch($action,$id)
{
    if($action == 'getbranch')
    {
     $branch = \DB::table('tm_branch_office as a')
     ->leftJoin('tm_organization_structure as b', 'b.BRANCH_OFFICE_ID', '=' , 'a.BRANCH_OFFICE_ID')
     ->select('a.BRANCH_OFFICE_ID', 'a.BRANCH_OFFICE_NAME')
     ->distinct()
     ->where('a.ACTIVE', 'Y')
     ->where('b.DIRECTORATE_ID', $id)
     ->get();
     return $branch;
 }
 else
 {
     $division = \DB::table('tm_division as a')
     ->leftJoin('tm_organization_structure as b', 'b.DIVISION_ID', '=' , 'a.DIVISION_ID')
     ->select('a.DIVISION_ID', 'a.DIVISION_NAME')
     ->distinct()
     ->where('a.ACTIVE', 'Y')
     ->where('b.DIRECTORATE_ID', $id)
     ->get();
     return $division;
 }

}

public function mst_getsubdiv($action,$id)
{
    if($action == 'getsubdivbranch')
    {
     $branch = \DB::table('tm_sub_division as a')
     ->leftJoin('tm_organization_structure as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
     ->select('a.SUB_DIVISION_ID', 'a.SUB_DIVISION_NAME','b.ORGANIZATION_STRUCTURE_ID')
     ->distinct()
     ->where('a.ACTIVE', 'Y')
     ->where('b.BRANCH_OFFICE_ID', $id)
     ->get();
     return $branch;
 }
 else
 {
     $division = \DB::table('tm_sub_division as a')
     ->leftJoin('tm_organization_structure as b', 'b.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
     ->select('a.SUB_DIVISION_ID', 'a.SUB_DIVISION_NAME','b.ORGANIZATION_STRUCTURE_ID')
     ->distinct()
     ->where('a.ACTIVE', 'Y')
     ->where('b.DIVISION_ID', $id)
     ->get();
     return $division;
 }

}

public function save_mst_sarmut_indikator(Request $request)
{
        //dd($request);
    $sub_division_idgabungan    = $request->sub_division_list;
    $explodesubdiv              = explode('-',$sub_division_idgabungan);
    $sub_division_id            = $explodesubdiv[0];
    $org_id                     = $explodesubdiv[1];
    $subdivisionidpengisigabung = $request->sub_division_pengisi_list;
    $explodesubdivpengisi       = explode('-',$subdivisionidpengisigabung);
    $sub_division_id_pengisi    = $explodesubdivpengisi[0];
    $indicator_name             = $request->indicator_name;
    $inputable                  = $request->inputable;
    $unit                       = $request->unit;
    $periodepengisian           = $request->periodepengisian;
    $tipepenjumlahan            = $request->tipepenjumlahan;

    $item = new Indicator;

    $item->SUB_DIVISION_ID = $sub_division_id;
    $item->SUB_DIVISION_ID_PENGISI = $sub_division_id_pengisi;
    $item->INDICATOR_NAME = $indicator_name;
    $item->INPUTABLE = $inputable;
    $item->UNIT = $unit;
    $item->PERIODE_PENGISIAN = $periodepengisian;
    $item->TIPE_PENJUMLAHAN = $tipepenjumlahan;
    $item->IS_SASARAN_MUTU = '1';
    $item->save();

    $idutama = \DB::getPdo()->lastInsertId();

    if($idutama != '')
    {
        $data2 = new Master_Sarmut;
        $data2->INDICATOR_ID = $idutama;
        $data2->ORGANIZATION_STRUCTURE_ID = $org_id;
        $data2->ACTIVE = 'N';
        $data2->save();
    }

    $modul = "MASTER SARMUT";

    (new Main_Log)->setLog("Save Data Master Sarmut",json_encode($item),$modul,Auth::user()->ID);

    return redirect('/sarmut');
}


public function save_edit_mst_sarmut_indikator(Request $request)
{
        //dd($request);
    $id                         = $request->id;
    $sub_division_idgabungan    = $request->sub_division_list;
    $explodesubdiv              = explode('-',$sub_division_idgabungan);
    $sub_division_id            = $explodesubdiv[0];
    $org_id                     = $explodesubdiv[1];
    $subdivisionidpengisigabung = $request->sub_division_pengisi_list;
    $explodesubdivpengisi       = explode('-',$subdivisionidpengisigabung);
    $sub_division_id_pengisi    = $explodesubdivpengisi[0];
    $indicator_name             = $request->indicator_name;
    $inputable                  = $request->inputable;
    $unit                       = $request->unit;
    $periodepengisian           = $request->periodepengisian;
    $tipepenjumlahan            = $request->tipepenjumlahan;


    $item = Indicator::where('INDICATOR_ID', $id)->first();
    $item->SUB_DIVISION_ID = $sub_division_id;
    $item->SUB_DIVISION_ID_PENGISI = $sub_division_id_pengisi;
    $item->INDICATOR_NAME = $indicator_name;
    $item->INPUTABLE = $inputable;
    $item->UNIT = $unit;
    $item->PERIODE_PENGISIAN = $periodepengisian;
    $item->TIPE_PENJUMLAHAN = $tipepenjumlahan;
    $item->ACTIVE = 'N';
    $item->STATUS = '1';
    $item->update();

    if($item)
    {
        $data2 = Master_Sarmut::where('INDICATOR_ID', $id)->first();
        $data2->ORGANIZATION_STRUCTURE_ID = $org_id;
        $data2->ACTIVE = 'N';
        $data2->update();
    }

    $modul = "MASTER SARMUT";

    (new Main_Log)->setLog("Update Data Master Sarmut",json_encode($item),$modul,Auth::user()->ID);

    return redirect('/sarmut');
}

public function save_edit_status_mst_sarmut_indikator(Request $request)
{
        //dd($request);
    $id                         = $request->id;
    $status                     = $request->status;


    $item = Indicator::where('INDICATOR_ID', $id)->first();
    $item->ACTIVE = $status;
    $item->update();

    if($item)
    {
        $data2 = Master_Sarmut::where('INDICATOR_ID', $id)->first();
        $data2->ACTIVE = $status;
        $data2->update();
    }

    $modul = "MASTER SARMUT";

    (new Main_Log)->setLog("Update Status Master Sarmut",json_encode($item),$modul,Auth::user()->ID);

    return redirect('/sarmut');
}

public function approve_mst_sarmut_indikator(Request $request)
{
 $item = Indicator::where('INDICATOR_ID', '=', $request->id)->first();
    //    dd($request->id1);

 if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
    $item->STATUS = '2';
    $item->save();

    $modul = "MASTER SARMUT";

    (new Main_Log)->setLog("Approved DVP Master Sarmut",json_encode($item),$modul,Auth::user()->ID);

}else if(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
    $item->STATUS = '3';
    $item->ACTIVE = 'Y';
    $item->save();

    if($item)
    {
        $data2 = Master_Sarmut::where('INDICATOR_ID', $request->id)->first();
        $item->ACTIVE = 'Y';
        $data2->update();
    }

    $modul = "MASTER SARMUT";

    (new Main_Log)->setLog("Approved VP Master Sarmut",json_encode($item),$modul,Auth::user()->ID);
}
return redirect('/sarmut');
}

public function kembalikan_mst_sarmut_indikator(Request $request)
{
        // dd($request->id1);
    if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
     $item = Indicator::where('INDICATOR_ID', '=', $request->id1)->first();
     $item->STATUS = '4';
     $item->ACTIVE = 'N';
     $item->ALASAN_KEMBALIKAN = $request->alasan;
     $item->save();

     $modul = "MASTER SARMUT";

     (new Main_Log)->setLog("Dikembalikan DVP Master Sarmut",json_encode($item),$modul,Auth::user()->ID);

 }elseif (Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU') {

   $item = Indicator::where('INDICATOR_ID', '=', $request->id1)->first();
   $item->STATUS = '4';
   $item->ACTIVE = 'N';
   $item->ALASAN_KEMBALIKAN = $request->alasan;
   $item->save();

   if($item)
   {
    $data2 = Master_Sarmut::where('INDICATOR_ID', $request->id1)->first();
    $item->ACTIVE = 'N';
    $data2->update();
}

$modul = "MASTER SARMUT";

(new Main_Log)->setLog("Dikembalikan VP Master Sarmut",json_encode($item),$modul,Auth::user()->ID);

}

return redirect('/sarmut');
}  

public function txsarmut_list(Request $request)
{
        // $indicator_list = array();
        // $a = Auth::user()->ACCESS;
        // dd($a);
    $dbutama = \DB::table('tm_organization_structure as a')
    ->Join('tm_directorate as b', 'a.DIRECTORATE_ID', '=' , 'b.DIRECTORATE_ID')
    ->select('a.DIVISION_ID','a.BRANCH_OFFICE_ID','b.IS_CABANG')
    ->where('a.ORGANIZATION_STRUCTURE_ID', '=' , Auth::user()->ORG_ID)
    ->first();

        // dd($dbutama);

    if($dbutama->IS_CABANG == "0"){

        $organize_struct = \DB::table('tm_organization_structure as a')
        ->Join('tm_sub_division  as b', 'a.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
        ->select('b.SUB_DIVISION_NAME','b.SUB_DIVISION_ID')
        ->where('a.DIVISION_ID', '=' , $dbutama->DIVISION_ID);

    }
    elseif ($dbutama->IS_CABANG == "1") {

       $organize_struct = \DB::table('tm_organization_structure as a')
       ->Join('tm_sub_division  as b', 'a.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
       ->select('b.SUB_DIVISION_NAME','b.SUB_DIVISION_ID')
       ->where('a.BRANCH_OFFICE_ID', '=' , $dbutama->BRANCH_OFFICE_ID);

   }

   $organize_struct_list = $organize_struct->get();



   if(Auth::user()->ACCESS == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
    $items = \DB::table('tx_header_sasaran_mutu as t')
    ->leftJoin('tm_organization_structure as o', 'o.ORGANIZATION_STRUCTURE_ID', '=' , 't.ORGANIZATION_STRUCTURE_ID')
    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
    ->select('t.HEADER_SASARAN_MUTU_ID as SASARAN_MUTU_ID', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 't.YEAR as YEAR', 't.MONTH as MONTH', 't.STATUS as STATUS', 't.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 't.ALASAN_KEMBALIKAN as ALASAN_KEMBALIKAN','t.PERCENTAGE')
    ->orWhere('t.ORGANIZATION_STRUCTURE_ID', '=', Auth::user()->ORG_ID)
    ->orWhere('t.STATUS', 3)
    ->orderBy('t.created_at', 'desc');
}
else{
    $items = \DB::table('tx_header_sasaran_mutu as t')
    ->leftJoin('tm_organization_structure as o', 'o.ORGANIZATION_STRUCTURE_ID', '=' , 't.ORGANIZATION_STRUCTURE_ID')
    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
    ->select('t.HEADER_SASARAN_MUTU_ID as SASARAN_MUTU_ID', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 't.YEAR as YEAR', 't.MONTH as MONTH', 't.STATUS as STATUS', 't.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 't.ALASAN_KEMBALIKAN as ALASAN_KEMBALIKAN','t.PERCENTAGE')
    ->where('t.ORGANIZATION_STRUCTURE_ID', '=', Auth::user()->ORG_ID)
    ->orderBy('t.created_at', 'desc');
}
$sarmut_list = $items->get();
$now            = Carbon::now();



$years = array(date('Y'),date('Y')-1);
$year = '';
$months = array("JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DES");

        // $mnow = $months[date('m')-1];
        // $mmin1 = $months[date('m')-2];
        // $monthss = array($mnow, $mmin1);
        // dd($years);
$month = '';
$itemss = \DB::table('tx_header_sasaran_mutu as t')
->select('t.YEAR as YEAR', 't.MONTH as MONTH')
->where('t.ORGANIZATION_STRUCTURE_ID', '=', Auth::user()->ORG_ID);
$cek_list = $itemss->get();
        // dd($cek_list);
        // foreach ($cek_list as $data) {
        //     if (($key = array_search($data->YEAR, $years)) !== false && ($key = array_search($data->MONTH, $monthss)) !== false) {
        //         unset($years[$key]);
        //         unset($monthss[$key]);
        //     }else if (($key = array_search($data->YEAR, $years)) !== true && ($key = array_search($data->MONTH, $monthss)) !== false) {
        //         unset($monthss[$key]);
        //     }else if (($key = array_search($data->YEAR, $years)) !== false && ($key = array_search($data->MONTH, $monthss)) !== true) {
        //         unset($years[$key]);
        //     }
        // }

return view('sarmut.tabel_txsarmut', [
    'now'                   => $now,
    'txsarmut_list'        => $sarmut_list,
    'years'     => $years,
    'year'     => $year,
    'months'     => $months,
    'month'     => $month,
    'organize_struct_list'  => $organize_struct_list
]);
}

public function filter_txsarmut($idsubdiv)
{
        // $indicator_list = array();
        // $a = Auth::user()->ACCESS;
        // dd($a);
    $dbutama = \DB::table('tm_organization_structure as a')
    ->Join('tm_directorate as b', 'a.DIRECTORATE_ID', '=' , 'b.DIRECTORATE_ID')
    ->select('a.DIVISION_ID','a.BRANCH_OFFICE_ID','b.IS_CABANG')
    ->where('a.ORGANIZATION_STRUCTURE_ID', '=' , Auth::user()->ORG_ID)
    ->first();

        // dd($dbutama);

    if($dbutama->IS_CABANG == "0"){

        $organize_struct = \DB::table('tm_organization_structure as a')
        ->Join('tm_sub_division  as b', 'a.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
        ->select('b.SUB_DIVISION_NAME','b.SUB_DIVISION_ID')
        ->where('a.DIVISION_ID', '=' , $dbutama->DIVISION_ID);

    }
    elseif ($dbutama->IS_CABANG == "1") {

       $organize_struct = \DB::table('tm_organization_structure as a')
       ->Join('tm_sub_division  as b', 'a.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
       ->select('b.SUB_DIVISION_NAME','b.SUB_DIVISION_ID')
       ->where('a.BRANCH_OFFICE_ID', '=' , $dbutama->BRANCH_OFFICE_ID);

   }

   $organize_struct_list = $organize_struct->get();




   $items = \DB::table('tx_header_sasaran_mutu as t')
   ->leftJoin('tm_organization_structure as o', 'o.ORGANIZATION_STRUCTURE_ID', '=' , 't.ORGANIZATION_STRUCTURE_ID')
   ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
   ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
   ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
   ->select('t.HEADER_SASARAN_MUTU_ID as SASARAN_MUTU_ID', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 't.YEAR as YEAR', 't.MONTH as MONTH', 't.STATUS as STATUS', 't.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 't.ALASAN_KEMBALIKAN as ALASAN_KEMBALIKAN','t.PERCENTAGE')
   ->where('o.SUB_DIVISION_ID', '=', $idsubdiv)
   // ->where('t.STATUS', '=', 2)
   ->orderBy('t.created_at', 'desc');

   $sarmut_list = $items->get();

   $now            = Carbon::now();



   $years = array(date('Y'),date('Y')-1);
   $year = '';
   $months = array("JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DES");

        // $mnow = $months[date('m')-1];
        // $mmin1 = $months[date('m')-2];
        // $monthss = array($mnow, $mmin1);
        // dd($years);
   $month = '';
   $itemss = \DB::table('tx_header_sasaran_mutu as t')
   ->select('t.YEAR as YEAR', 't.MONTH as MONTH')
   ->where('t.ORGANIZATION_STRUCTURE_ID', '=', Auth::user()->ORG_ID);
   $cek_list = $itemss->get();
        // dd($cek_list);
        // foreach ($cek_list as $data) {
        //     if (($key = array_search($data->YEAR, $years)) !== false && ($key = array_search($data->MONTH, $monthss)) !== false) {
        //         unset($years[$key]);
        //         unset($monthss[$key]);
        //     }else if (($key = array_search($data->YEAR, $years)) !== true && ($key = array_search($data->MONTH, $monthss)) !== false) {
        //         unset($monthss[$key]);
        //     }else if (($key = array_search($data->YEAR, $years)) !== false && ($key = array_search($data->MONTH, $monthss)) !== true) {
        //         unset($years[$key]);
        //     }
        // }

   return view('sarmut.tabel_txsarmut', [
    'now'                   => $now,
    'txsarmut_list'        => $sarmut_list,
    'years'     => $years,
    'year'     => $year,
    'months'     => $months,
    'month'     => $month,
    'organize_struct_list'  => $organize_struct_list
]);
}

public function form_sarmut(Request $request)
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
        // $indicator_list   = Indicator::all()->toArray();
    $indicator_list      = \DB::table('tm_indicator as t')
    ->leftJoin('tm_sub_division as d', 'd.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID')->get()->toArray();
        // dd($organize_struct_list);
    $years = array_combine(range(date("Y"), 1960), range(date("Y"), 1960));
    $period         = '';
    $indicator  = '';
    $year  = '';
    $organize_struct  = '';
    $now            = Carbon::now();

    return view('sarmut.form', [
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

public function form_edit_mstsarmut(Request $request)
{
        // dd($request->id);
    $itemselects = Master_Sarmut::where('IND_SASARAN_MUTU_ID', $request->id)->first();
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
        // $indicator_list   = Indicator::all()->toArray();
    $indicator_list      = \DB::table('tm_indicator as t')
    ->leftJoin('tm_sub_division as d', 'd.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID')->get()->toArray();
    $years = array_combine(range(date("Y"), 1960), range(date("Y"), 1960));
    $status         = '';
    $indicator  = '';
    $year  = '';
    $organize_struct  = '';
    $now            = Carbon::now();

    return view('sarmut.formedit', [
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

public function save_mst_sarmut(Request $request)
{
    $year    = $request->years[0];
    $organize_struct          = $request->organize_struct_list[0];
    $indicator     = $request->indicator_list;
        // $period            = $request->period_list[0];
    foreach ($indicator as $indicator) {
        $item = new Master_Sarmut;
        $item->INDICATOR_ID = $indicator;
        $item->ORGANIZATION_STRUCTURE_ID = $organize_struct;
        $item->ACTIVE = 'Y';
        $item->save();
    }


    return redirect('/sarmut');
}

public function edit_mst_sarmut(Request $request)
{
    $organize_struct          = $request->organize_struct_list[0];
    $indicator     = $request->indicator_list[0];
    $status            = $request->status[0];

    $item = Master_Sarmut::where('IND_SASARAN_MUTU_ID', $request->id)->first();
        // if($is_sarmut == null){
        //     $item->IS_SASARAN_MUTU = $is_sarmut;
        // }
        // if($is_kpi == null){
        //     $item->IS_KPI = $is_kpi;
        // }
        // if($is_tkp == null){
        //     $item->IS_TINGKAT_KESEHATAN_PERUSAHAAN = $is_tkp;
        // }
    $item->INDICATOR_ID = $indicator;
    $item->ORGANIZATION_STRUCTURE_ID = $organize_struct;
        // $item->PERIOD_ID = $period;
    $item->ACTIVE = $status;
    $item->save();

    return redirect('/sarmut');
}

public function mstsarmut_active(Request $request)
{
    $item = Master_Sarmut::where('IND_SASARAN_MUTU_ID', '=', $request->id)->first();

    $item->ACTIVE = 'Y';
    $item->save();

    return redirect('/sarmut');
}

public function mstsarmut_inactive(Request $request)
{
    $item = Master_Sarmut::where('IND_SASARAN_MUTU_ID', '=', $request->id)->first();

    $item->ACTIVE = 'N';
    $item->save();

    return redirect('/sarmut');
}

public function mstsarmut_approve(Request $request)
{
 $item = Master_Sarmut::where('IND_SASARAN_MUTU_ID', '=', $request->id)->first();

 if(Auth::user()->ACCESS == 'DVP SUB DIVISI' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
    $item->STATUS = '2';
    $item->save();
}else if(Auth::user()->ACCESS == 'VP SUB DIVISI' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
    $item->STATUS = '3';
    $item->save();
}
return redirect('/sarmut');
}

public function mstsarmut_kembalikan(Request $request)
{
    $item = Master_Sarmut::where('IND_SASARAN_MUTU_ID', '=', $request->id)->first();

    $item->STATUS = '4';
    $item->save();

    return redirect('/sarmut');
}

public function save_tx_sarmut(Request $request)
{
        // $req = $request->all();
    $countjum = count($request->actual);
    $tes = $request->remark;
    $jml = $countjum;
    for($i = 0; $i < $countjum; $i++)
    {
        if($tes[$i] == "Data Kurang")
        {
            $jml = $jml-1;
        }
    }
        // dd($jml);   
    $percentage = round($jml/$countjum*100,2);
        //dd($percentage);
    $cek = Head_Sarmut::where('YEAR', '=', $request->years)
    ->where('MONTH', '=', $request->months)
    ->where('ORGANIZATION_STRUCTURE_ID', '=', Auth::user()->ORG_ID)->get();
    if($cek->isEmpty()){
        $head = new Head_Sarmut;
        $head->ORGANIZATION_STRUCTURE_ID = Auth::user()->ORG_ID;
        $head->YEAR = $request->years;
        $head->MONTH = $request->months;
        $head->STATUS = '1';
        $head->PERCENTAGE = $percentage;
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
                // dd($formuladb);
            if ($formuladb == '') {
                $hasils = $request->actual[$j];
            }else{
                    // $sub_ind = str_split($item->FORMULA, 1);
                    $pttn='+-/*()';   # standard mathematical operators
                    $pttn=sprintf('@([%s])@', preg_quote($pttn)); # an escaped/quoted pattern

                    $sub_ind=preg_split($pttn, preg_replace('@\s@', '', $item->FORMULA), -1, PREG_SPLIT_DELIM_CAPTURE);
                    foreach ($sub_ind as $split){
                        if(is_numeric($split)){
                            // dd($split);
                            $formuladb = str_replace($split, $req['subreal_'.$data.'_'.$split], $formuladb);
                            $k = $k+1;
                        }
                    }
                    $hasils = eval('return '.str_replace(':', '/', $formuladb).';');
                }

                //Detil
                $det = new Det_Sarmut;
                $det->HEADER_SASARAN_MUTU_ID = $idhead;
                $det->INDICATOR_ID = $data;
                $det->ACTUAL_REALISASI = $hasils;
                $det->KETERANGAN = $request->remark[$j];
                $det->ALASAN = $request->alasan[$j];
                $det->save();

                $iddet = \DB::getPdo()->lastInsertId();
                //Sub Detil
                if ($formuladb <> '') {
                    $num_split = array();
                    foreach ($sub_ind as $split){
                        if(is_numeric($split)){
                            $formuladb = str_replace($split, $req['subreal_'.$data.'_'.$split], $formuladb);
                            $sub_det = new Sub_Det_Sarmut;
                            $sub_det->DET_SASARAN_MUTU_ID = $iddet;
                            $sub_det->SUB_INDICATOR_ID = $request->sub_ind_id[$i];
                            $sub_det->ACTUAL_REALISASI = $req['subreal_'.$data.'_'.$split];
                            $sub_det->save();
                            $i = $i+1;
                        }
                    }
                }
                
                array_push($hasil, $hasils);
                $j = $j+1;
            }

            $modul = "TRANSACTION SARMUT";

            (new Main_Log)->setLog("Save Data Transaction Sarmut",json_encode($head),$modul,Auth::user()->ID);
            return redirect('/txsarmut');
        }
        else
        {

           return redirect('/txsarmut')->with('error','Data Sudah Ada!!!');
       }


        // dd($hasil);


   }

   public function edit_tx_sarmut(Request $request)
   {
        // $req = $request->all();
    $countjum = count($request->actual);
    $tes = $request->remark;
    $jml = $countjum;
    for($i = 0; $i < $countjum; $i++)
    {
        if($tes[$i] == "Data Kurang")
        {
            $jml = $jml-1;
        }
    }
        // dd($jml);   
    $percentage = round($jml/$countjum*100,2);

    $header_sarmut_id = $request->header_sarmut_id;
    $head = Head_Sarmut::where('HEADER_SASARAN_MUTU_ID', '=', $header_sarmut_id)->first();
    $head->ORGANIZATION_STRUCTURE_ID = Auth::user()->ORG_ID;
    $head->YEAR = $request->years;
    $head->MONTH = $request->months;
    $head->STATUS = '1';
    $head->PERCENTAGE = $percentage;
    $head->save();

    $hasil = array();
    $i = 0;
    $j = 0;
    $k = 0;
    foreach ($request->indicator_id as $data) {
        $item = \DB::table('tm_indicator as t')
        ->where('INDICATOR_ID', $data)->first();
        $formuladb = $item->FORMULA;
        if ($formuladb == '') {
            $hasils = $request->actual[$j];
        }else{
                // $sub_ind = str_split($item->FORMULA, 1);
                $pttn='+-/*()';   # standard mathematical operators
                $pttn=sprintf('@([%s])@', preg_quote($pttn)); # an escaped/quoted pattern

                $sub_ind=preg_split($pttn, preg_replace('@\s@', '', $item->FORMULA), -1, PREG_SPLIT_DELIM_CAPTURE);
                foreach ($sub_ind as $split){
                    if(is_numeric($split)){
                        // dd($req['subreal_'.$data.'_'.$split]);
                        $formuladb = str_replace($split, $req['subreal_'.$data.'_'.$split], $formuladb);
                        $k = $k+1;
                    }
                }
                // $hasils = eval('return '.$formuladb.';');
                $hasils = eval('return '.str_replace(':', '/', $formuladb).';');
            }

            //Detil
            $det = Det_Sarmut::where('INDICATOR_ID', '=', $data)
            ->where('HEADER_SASARAN_MUTU_ID', '=', $header_sarmut_id)->first();
            $det->ACTUAL_REALISASI = $hasils;
            $det->KETERANGAN = $request->remark[$j];
            $det->ALASAN = $request->alasan[$j];
            $det->save();

            $iddet = $det->DET_SASARAN_MUTU_ID;
            // dd($iddet);
            //Sub Detil
            if ($formuladb <> '') {
                $num_split = array();
                foreach ($sub_ind as $split){
                    if(is_numeric($split)){
                        $formuladb = str_replace($split, $req['subreal_'.$data.'_'.$split], $formuladb);
                        $sub_det = Sub_Det_Sarmut::where('SUB_INDICATOR_ID', '=', $split)
                        ->where('DET_SASARAN_MUTU_ID', '=', $iddet)->first();
                        $sub_det->ACTUAL_REALISASI = $req['subreal_'.$data.'_'.$split];
                        $sub_det->save();
                        $i = $i+1;
                    }
                }
            }
            array_push($hasil, $hasils);
            $j = $j+1;

        }

        $modul = "TRANSACTION SARMUT";

        (new Main_Log)->setLog("Update Data Transaction Sarmut",json_encode($head),$modul,Auth::user()->ID);

        return redirect('/txsarmut');
    }

    public function txsarmut_approve(Request $request)
    {
        // dd('oke');
        $header_sarmut_id = $request->id1;
        // dd(Auth::user()->ACCESS);
        if(Auth::user()->ACCESS == 'DVP SUB DIVISI' || Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
        {
            $head = Head_Sarmut::where('HEADER_SASARAN_MUTU_ID', '=', $header_sarmut_id)->first();
            $status = '2';
            $head->STATUS = $status;
            $head->save();
            $modul = "TRANSACTION SARMUT";

            (new Main_Log)->setLog("Approved DVP/DGM Transaction Sarmut",json_encode($head),$modul,Auth::user()->ID);

        }else if(Auth::user()->ACCESS == 'VP SUB DIVISI' || Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
        {
            $head = Head_Sarmut::where('HEADER_SASARAN_MUTU_ID', '=', $header_sarmut_id)->first();
            $status = '3';
            $head->STATUS = $status;
            $head->save();

            $modul = "TRANSACTION SARMUT";

            (new Main_Log)->setLog("Approved VP/GM Transaction Sarmut",json_encode($head),$modul,Auth::user()->ID);
        }
        // dd($status);
        

        return redirect('/txsarmut');
    }

    public function txsarmut_kembalikan(Request $request)
    {
        // dd($request);

        $item = Head_Sarmut::where('HEADER_SASARAN_MUTU_ID', '=', $request->id2)->first();
        $item->STATUS = '4';
        $item->ALASAN_KEMBALIKAN = $request->alasan;
        $item->save();
        
        $modul = "TRANSACTION SARMUT";

        (new Main_Log)->setLog("Dikembalikan VP/DVP/GM/DGM Transaction Sarmut",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/txsarmut');
    }

    public function delete_mst_sarmut(Request $request)
    {
        Master_Sarmut::where('IND_SASARAN_MUTU_ID',$request->id)->delete();

        return redirect('/sarmut');
    }

    public function form_input_sarmut(Request $request)
    {
        $now            = Carbon::now();
        $idsubcoy = \DB::table('users as a')
        ->leftJoin('tm_organization_structure as b', 'a.ORG_ID', '=' , 'b.ORGANIZATION_STRUCTURE_ID')
        ->select('b.SUB_DIVISION_ID')
        ->where('b.ORGANIZATION_STRUCTURE_ID', '=', Auth::user()->ORG_ID);
        $idsubcoy_list = $idsubcoy->first();

        $items = \DB::table('tm_ind_sasaran_mutu as a')
        ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
        ->leftJoin('tm_organization_structure as c', 'a.ORGANIZATION_STRUCTURE_ID', '=' , 'c.ORGANIZATION_STRUCTURE_ID')
        ->leftJoin('tm_division as d', 'c.DIVISION_ID', '=' , 'd.DIVISION_ID')
        ->leftJoin('tm_sub_division as sd', 'b.SUB_DIVISION_ID', '=' , 'sd.SUB_DIVISION_ID')
        ->leftJoin('tm_indicator_target as e', 'b.INDICATOR_ID', '=' , 'e.INDICATOR_ID')
        ->select('a.IND_SASARAN_MUTU_ID as SASARAN_MUTU_ID', 'b.INDICATOR_ID as INDICATOR_ID', 'b.INDICATOR_NAME as INDICATOR_NAME', 'b.UNIT as UNIT', 'e.TARGET as TARGET', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 'b.FORMULA as FORMULA', 'b.POLARITAS as POLARITAS', 'b.PERIODE_PENGISIAN as PERIODE_PENGISIAN', 'b.SUB_DIVISION_ID_PENGISI','b.INPUTABLE')
        ->where('a.ORGANIZATION_STRUCTURE_ID', '=', Auth::user()->ORG_ID)
        ->where('b.SUB_DIVISION_ID_PENGISI', '=', $idsubcoy_list->SUB_DIVISION_ID)
        ->where('a.ACTIVE', '=', 'Y')
        ->where('b.STATUS', '=', '3');
        $sarmut_list1 = $items->get();
        //dd($sarmut_list1);
        $sarmut_list = $sarmut_list1->toArray();
        $disabled_list = array();
        $sub_disabled_list = array();
        foreach ($sarmut_list1 as $data) {
        	if ($data->FORMULA <> '') {
        		$disabled = 'disabled';
        	}else{
                $disabled = 'abled';
            }
            array_push($disabled_list, $disabled);
        }
        // dd($sarmut_list);

        $sub_list = array();
        $target_ind_list = array();
        $target_subind_list = array();
        $real_ind_list = array();
        $real_subind_list = array();
        $hasil = array();
        $percentage = array();
        foreach ($sarmut_list1 as $data) {
            $targetind = \DB::table('tm_target_month as a')
            ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
            ->leftJoin('tm_sub_indicator as c', 'a.SUB_INDICATOR_ID', '=' , 'c.SUB_INDICATOR_ID')
            ->select('a.TARGET_'.$request->months[0].' as TARGET', 'a.BOBOT_'.$request->months[0].' as BOBOT')
            ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID)
            ->where('a.YEAR', '=', $request->years[0]);
            $tgtind_list = $targetind->first();
            // $tgtind_list = $tgtind_list1->toArray();
            $real = \DB::table('tx_header_sasaran_mutu as a')
            ->leftJoin('tx_det_sasaran_mutu as b', 'a.HEADER_SASARAN_MUTU_ID', '=' , 'b.HEADER_SASARAN_MUTU_ID')
            ->leftJoin('tx_sub_det_sasaran_mutu as c', 'b.DET_SASARAN_MUTU_ID', '=' , 'c.DET_SASARAN_MUTU_ID')
            ->select('a.MONTH as MONTH', 'a.YEAR as YEAR', 'b.INDICATOR_ID as INDICATOR_ID', 'b.ACTUAL_REALISASI as ACTUAL_REALISASI', 'b.KETERANGAN as KETERANGAN', 'c.SUB_INDICATOR_ID as SUB_INDICATOR_ID', 'c.ACTUAL_REALISASI as SUB_ACTUAL_REALISASI')
            ->where('b.INDICATOR_ID', '=', $data->INDICATOR_ID)
            ->where('a.ORGANIZATION_STRUCTURE_ID', '=', Auth::user()->ORG_ID);
            $real_list1 = $real->get();
            $real_list = $real_list1->toArray();
            // dd($data->INDICATOR_ID);

            $pttn='+-/*()';   # standard mathematical operators
			$pttn=sprintf('@([%s])@', preg_quote($pttn)); # an escaped/quoted pattern

			$sub_ind=preg_split($pttn, preg_replace('@\s@', '', $data->FORMULA), -1, PREG_SPLIT_DELIM_CAPTURE);
            // dd($request->months[0]); 
            // dd($sub_ind);
            $num_split = array();
            $formuladb = $data->FORMULA;
            $countpercen = 0;
            foreach ($sub_ind as $split){
                if(is_numeric($split)){
                    array_push($num_split, $split);
                    $targetsubind = \DB::table('tm_target_month as a')
                    ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
                    ->select('a.TARGET_'.$request->months[0].' as TARGET', 'a.BOBOT_'.$request->months[0].' as BOBOT')
                    ->where('a.INDICATOR_ID', '=', $split)
                    ->where('a.YEAR', '=', $request->years[0]);
                    $tgtsubind_list = $targetsubind->first();
                    // $tgtsubind_list = $tgtsubind_list1->toArray();
                    $sub_real = \DB::table('tx_header_sasaran_mutu as a')
                    ->leftJoin('tx_det_sasaran_mutu as b', 'a.HEADER_SASARAN_MUTU_ID', '=' , 'b.HEADER_SASARAN_MUTU_ID')
                    ->leftJoin('tx_sub_det_sasaran_mutu as c', 'b.DET_SASARAN_MUTU_ID', '=' , 'c.DET_SASARAN_MUTU_ID')
                    ->select('a.MONTH as MONTH', 'a.YEAR as YEAR', 'b.INDICATOR_ID as INDICATOR_ID', 'b.ACTUAL_REALISASI as ACTUAL_REALISASI', 'b.KETERANGAN as KETERANGAN', 'b.KETERANGAN as KETERANGAN', 'c.SUB_INDICATOR_ID as SUB_INDICATOR_ID', 'c.ACTUAL_REALISASI as SUB_ACTUAL_REALISASI')
                    ->where('b.INDICATOR_ID', '=', $split)
                    ->where('a.MONTH', '=', $request->months[0])
                    ->where('a.YEAR', '=', $request->years[0])
                    ->where('a.STATUS', '=', '3');
                    $sub_real_list = $sub_real->first();
                    // $sub_real_list = $sub_real_list1->toArray();
                    // dd($sub_real_list);
                    if($sub_real_list <> null){
                        $formuladb = str_replace($split, $sub_real_list->ACTUAL_REALISASI, $formuladb);
                        $countpercen = $countpercen+1;
                    }else{
                        $formuladb = str_replace($split, "0", $formuladb);
                    }
                    array_push($target_subind_list, $tgtsubind_list);
                    array_push($real_subind_list, $sub_real_list);
                    // $target_subind_list = $tgtsubind_list == '' ? '-' : $tgtsubind_list;
                    // $real_subind_list = $sub_real_list == '' ? '-' : $sub_real_list;
                }
            }
            // dd(count($num_split));
            $hasils = eval('return '.str_replace(':', '/', $formuladb).';');
            if($countpercen == '0'){
                $countpercen = '1';
            }
            if(count($num_split) === 0){
                $percentages = 0;
            }else{
                $percentages = ($countpercen/count($num_split))*100;
            }

            
            $items1 = \DB::table('tm_indicator as a')
            ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
            ->whereIn('a.INDICATOR_ID',$num_split);
            $sub_in1 = $items1->get();
            $sub_in = $sub_in1->toArray();
            foreach ($sub_in1 as $data1) {
              if ($data1->FORMULA <> '') {
                 $disabled = 'disabled';
             }else{
                 $disabled = 'disabled';
             }
             array_push($sub_disabled_list, $disabled);
         }

         array_push($sub_list, $sub_in);
         array_push($hasil, $hasils);
         array_push($percentage, $percentages);
         array_push($target_ind_list, $tgtind_list);
            // $target_ind_list['target-'.$data->INDICATOR_ID] = $tgtind_list;
            // $real_ind_list['real-'.$data->INDICATOR_ID] = $real_list;
         unset($num_split);
     }
        // dd($target_ind_list);
     $years = array(date('Y'),date('Y')-1);
     $year = '';
     $months = array("JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OKT","NOV","DES");

     $mnow = $months[date('m')-1];
     $mmin1 = $months[date('m')-2];
     $monthss = array($mnow, $mmin1);
        // dd($years);
     $month = '';

        // dd($sub_disabled_list);
     Session::put('targetind', $target_ind_list);
     Session::put('targetsubind', $target_subind_list);
     Session::put('realind', $real_ind_list);
     Session::put('realsubind', $real_subind_list);

        // dd(Session::get('realsubind'));

     return view('sarmut.input_sarmut', [
        'now'                   => $now,
        'sarmut_list'     => $sarmut_list,
        'disabled_list'     => $disabled_list,
        'target_ind_list'     => $target_ind_list,
        'target_subind_list'     => $target_subind_list,
        'real_subind_list'     => $real_subind_list,
        'sarmut'          => '',
        'sub_in'     => $sub_list,
        'hasil'     => $hasil,
        'sub_disabled_list'     => $sub_disabled_list,
        'years'     => $years,
        'year'     => $request->years[0],
        'months'     => $monthss,
        'month'     => $request->months[0],
        'percentage'     => $percentage,
    ]);
 }

 public function form_edit_txsarmut(Request $request)
    {   // tekan kene form
        $now            = Carbon::now();
        $items = \DB::table('tx_det_sasaran_mutu as a')
        ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
        ->leftJoin('tm_sub_division as sd', 'b.SUB_DIVISION_ID', '=' , 'sd.SUB_DIVISION_ID')
        ->leftJoin('tm_indicator_target as e', 'b.INDICATOR_ID', '=' , 'e.INDICATOR_ID')
        ->select('b.INDICATOR_ID as INDICATOR_ID', 'b.INDICATOR_NAME as INDICATOR_NAME', 'b.UNIT as UNIT', 'e.TARGET as TARGET', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 'b.FORMULA as FORMULA', 'b.POLARITAS as POLARITAS', 'b.PERIODE_PENGISIAN as PERIODE_PENGISIAN','b.INPUTABLE as INPUTABLE')
        ->where('a.HEADER_SASARAN_MUTU_ID', '=', $request->id);
        $sarmut_list1 = $items->get();
        $sarmut_list = $sarmut_list1->toArray();
        $disabled_list = array();
        $sub_disabled_list = array();
        foreach ($sarmut_list1 as $data) {
            if ($data->FORMULA <> '') {
                $disabled = 'disabled';
            }else{
                $disabled = 'abled';
            }
            array_push($disabled_list, $disabled);
        }

        $items = \DB::table('tx_header_sasaran_mutu as a')
        ->where('a.HEADER_SASARAN_MUTU_ID', '=', $request->id);

        $header_sarmut = $items->first();
        // dd($header_sarmut->HEADER_SASARAN_MUTU_ID);
        $header_sarmut_id = $header_sarmut->HEADER_SASARAN_MUTU_ID;
        $selectedmonth = $header_sarmut->MONTH;
        $selectedyear = $header_sarmut->YEAR;
        $sapprove = $header_sarmut->STATUS;

        $sub_list = array();
        $target_ind_list = array();
        $target_subind_list = array();
        $real_ind_list = array();
        $real_subind_list = array();
        $sel_tgtind_list = array();
        $sel_actual_list = array();
        $sel_subtgtind_list = array();
        $sel_subactual_list = array();
        foreach ($sarmut_list1 as $data) {
            $targetind = \DB::table('tm_target_month as a')
            ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
            ->leftJoin('tm_sub_indicator as c', 'a.SUB_INDICATOR_ID', '=' , 'c.SUB_INDICATOR_ID')
            ->select('a.TARGET_JAN as JAN', 'a.TARGET_FEB as FEB', 'a.TARGET_MAR as MAR', 'a.TARGET_APR as APR', 'a.TARGET_MAY as MAY', 'a.TARGET_JUN as JUN', 'a.TARGET_JUL as JUL', 'a.TARGET_AUG as AUG', 'a.TARGET_SEP as SEP', 'a.TARGET_OCT as OCT', 'a.TARGET_NOV as NOV', 'a.TARGET_DES as DES')
            ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID);
            $tgtind_list1 = $targetind->get();
            $tgtind_list = $tgtind_list1->toArray();
            $real = \DB::table('tx_header_sasaran_mutu as a')
            ->leftJoin('tx_det_sasaran_mutu as b', 'a.HEADER_SASARAN_MUTU_ID', '=' , 'b.HEADER_SASARAN_MUTU_ID')
            ->leftJoin('tx_sub_det_sasaran_mutu as c', 'b.DET_SASARAN_MUTU_ID', '=' , 'c.DET_SASARAN_MUTU_ID')
            ->select('a.MONTH as MONTH', 'a.YEAR as YEAR', 'b.INDICATOR_ID as INDICATOR_ID', 'b.ACTUAL_REALISASI as ACTUAL_REALISASI', 'b.KETERANGAN as KETERANGAN', 'c.SUB_INDICATOR_ID as SUB_INDICATOR_ID', 'c.ACTUAL_REALISASI as SUB_ACTUAL_REALISASI')
            ->where('b.INDICATOR_ID', '=', $data->INDICATOR_ID);
            $real_list1 = $real->get();
            $real_list = $real_list1->toArray();

            $seltargetind = \DB::table('tm_target_month as a')
            ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
            ->leftJoin('tm_sub_indicator as c', 'a.SUB_INDICATOR_ID', '=' , 'c.SUB_INDICATOR_ID')
            ->select('a.TARGET_'.$header_sarmut->MONTH.' as SELECTED')
            ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID);
            $seltgtind_list = $seltargetind->first();
            array_push($sel_tgtind_list, $seltgtind_list);

            $selactualind = \DB::table('tx_det_sasaran_mutu as a')
            ->select('a.ACTUAL_REALISASI as SELECTED', 'a.KETERANGAN as KETERANGAN', 'a.DET_SASARAN_MUTU_ID as DET_SASARAN_MUTU_ID','a.ALASAN as ALASAN')
            ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID)
            ->where('a.HEADER_SASARAN_MUTU_ID', '=', $header_sarmut_id);
            $selactual_list = $selactualind->first();
            array_push($sel_actual_list, $selactual_list);
            // dd($seltgtind_list);

            $pttn='+-/*';   # standard mathematical operators
            $pttn=sprintf('@([%s])@', preg_quote($pttn)); # an escaped/quoted pattern

            $sub_ind=preg_split($pttn, preg_replace('@\s@', '', $data->FORMULA), -1, PREG_SPLIT_DELIM_CAPTURE);
            // dd($sub_ind);
            $num_split = array();
            foreach ($sub_ind as $split){
                if(is_numeric($split)){
                    array_push($num_split, $split);
                    $targetsubind = \DB::table('tm_target_month as a')
                    ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
                    ->leftJoin('tm_sub_indicator as c', 'a.SUB_INDICATOR_ID', '=' , 'c.SUB_INDICATOR_ID')
                    ->select('a.TARGET_JAN as JAN', 'a.TARGET_FEB as FEB', 'a.TARGET_MAR as MAR', 'a.TARGET_APR as APR', 'a.TARGET_MAY as MAY', 'a.TARGET_JUN as JUN', 'a.TARGET_JUL as JUL', 'a.TARGET_AUG as AUG', 'a.TARGET_SEP as SEP', 'a.TARGET_OCT as OCT', 'a.TARGET_NOV as NOV', 'a.TARGET_DES as DES')
                    ->where('a.SUB_INDICATOR_ID', '=', $split);
                    $tgtsubind_list1 = $targetsubind->get();
                    $tgtsubind_list = $tgtsubind_list1->toArray();
                    $target_subind_list['subtarget-'.$data->INDICATOR_ID.'-'.$split] = $tgtsubind_list;

                    $sub_real = \DB::table('tx_header_sasaran_mutu as a')
                    ->leftJoin('tx_det_sasaran_mutu as b', 'a.HEADER_SASARAN_MUTU_ID', '=' , 'b.HEADER_SASARAN_MUTU_ID')
                    ->leftJoin('tx_sub_det_sasaran_mutu as c', 'b.DET_SASARAN_MUTU_ID', '=' , 'c.DET_SASARAN_MUTU_ID')
                    ->select('a.MONTH as MONTH', 'a.YEAR as YEAR', 'b.INDICATOR_ID as INDICATOR_ID', 'b.ACTUAL_REALISASI as ACTUAL_REALISASI', 'b.KETERANGAN as KETERANGAN', 'c.SUB_INDICATOR_ID as SUB_INDICATOR_ID', 'c.ACTUAL_REALISASI as SUB_ACTUAL_REALISASI')
                    ->where('b.INDICATOR_ID', '=', $split);
                    $sub_real_list1 = $sub_real->get();
                    $sub_real_list = $sub_real_list1->toArray();
                    $real_subind_list['subreal-'.$data->INDICATOR_ID.'-'.$split] = $sub_real_list == '' ? '-' : $sub_real_list;
                }
            }
            // dd(count($num_split));
            $items1 = \DB::table('tm_indicator as a')
            ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
            ->whereIn('a.INDICATOR_ID',$num_split);
            $sub_in1 = $items1->get();
            $sub_in = $sub_in1->toArray();

            $selsubtargetind = \DB::table('tm_target_month as a')
            ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
            ->leftJoin('tm_sub_indicator as c', 'a.SUB_INDICATOR_ID', '=' , 'c.SUB_INDICATOR_ID')
            ->select('a.TARGET_'.$header_sarmut->MONTH.' as SELECTED')
            ->whereIn('a.INDICATOR_ID', $num_split);
            $selsubtgtind_list1 = $selsubtargetind->get();
            $selsubtgtind_list = $selsubtgtind_list1->toArray();
            array_push($sel_subtgtind_list, $selsubtgtind_list);

            // dd($data->FORMULA);
            if($data->FORMULA <> '') {
                $selsubactualind = \DB::table('tx_sub_det_sasaran_mutu as a')
                ->leftJoin('tx_det_sasaran_mutu as b', 'b.DET_SASARAN_MUTU_ID', '=', 'a.DET_SASARAN_MUTU_ID')
                ->select('a.ACTUAL_REALISASI as SELECTED')
                ->where('a.DET_SASARAN_MUTU_ID', '=', $selactual_list->DET_SASARAN_MUTU_ID)
                ->whereIn('a.SUB_INDICATOR_ID', $num_split);
                $selsubactual_list1 = $selsubactualind->get();
                $selsubactual_list = $selsubactual_list1->toArray();
                array_push($sel_subactual_list, $selsubactual_list);
            }

            array_push($sub_list, $sub_in);
            // array_push($target_ind_list, $tgtind_list);
            $target_ind_list['target-'.$data->INDICATOR_ID] = $tgtind_list;
            $real_ind_list['real-'.$data->INDICATOR_ID] = $real_list;
            // array_push($target_subind_list, $tgtsubind_list);
            unset($num_split);
        }
        $years = array(date('Y'),date('Y')-1);
        $year = '';
        $months = array("JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OKT","NOV","DES");
        
        $mnow = $months[date('m')-1];
        $mmin1 = $months[date('m')-2];
        $monthss = array($mnow, $mmin1);
        // dd($years);
        $month = '';

        // dd($sel_subtgtind_list[0][0]->SELECTED);
        Session::put('targetind', $target_ind_list);
        Session::put('targetsubind', $target_subind_list);
        Session::put('realind', $real_ind_list);
        Session::put('realsubind', $real_subind_list);

        // dd($sub_list);

        return view('sarmut.edit_sarmut', [
            'now'                   => $now,
            'sarmut_list'     => $sarmut_list,
            'sel_tgtind_list'     => $sel_tgtind_list,
            'sel_actual_list'     => $sel_actual_list,
            'sel_subtgtind_list'     => $sel_subtgtind_list,
            'sel_subactual_list'     => $sel_subactual_list,
            'target_ind_list'     => $target_ind_list,
            'target_subind_list'     => $target_subind_list,
            'selectedmonth'     => $selectedmonth,
            'selectedyear'     => $selectedyear,
            'sub_in'     => $sub_list,
            'header_sarmut_id' => $header_sarmut_id,
            'sub_disabled_list'     => $sub_disabled_list,
            'disabled_list'     => $disabled_list,
            'sarmut'          => '',
            'years'     => $years,
            'year'     => $header_sarmut->YEAR,
            'months'     => $monthss,
            'month'     => $header_sarmut->MONTH,
            'status'     => $sapprove,
        ]);
    }

    public function form_detail_txsarmut(Request $request)
    {   // tekan kene form
        $now            = Carbon::now();
        $items = \DB::table('tx_det_sasaran_mutu as a')
        ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
        ->leftJoin('tm_sub_division as sd', 'b.SUB_DIVISION_ID', '=' , 'sd.SUB_DIVISION_ID')
        ->leftJoin('tm_indicator_target as e', 'b.INDICATOR_ID', '=' , 'e.INDICATOR_ID')
        ->select('b.INDICATOR_ID as INDICATOR_ID', 'b.INDICATOR_NAME as INDICATOR_NAME', 'b.UNIT as UNIT', 'e.TARGET as TARGET', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 'b.FORMULA as FORMULA', 'b.POLARITAS as POLARITAS', 'b.PERIODE_PENGISIAN as PERIODE_PENGISIAN','b.INPUTABLE')
        ->where('a.HEADER_SASARAN_MUTU_ID', '=', $request->id);
        $sarmut_list1 = $items->get();
        $sarmut_list = $sarmut_list1->toArray();
        $disabled_list = array();
        $sub_disabled_list = array();
        foreach ($sarmut_list1 as $data) {
            if ($data->FORMULA <> '') {
                $disabled = 'disabled';
            }else{
                $disabled = 'abled';
            }
            array_push($disabled_list, $disabled);
        }

        $items = \DB::table('tx_header_sasaran_mutu as a')
        ->where('a.HEADER_SASARAN_MUTU_ID', '=', $request->id);

        $header_sarmut = $items->first();
        // dd($header_sarmut->HEADER_SASARAN_MUTU_ID);
        $header_sarmut_id = $header_sarmut->HEADER_SASARAN_MUTU_ID;
        $selectedmonth = $header_sarmut->MONTH;
        $selectedyear = $header_sarmut->YEAR;
        $sapprove = $header_sarmut->STATUS;

        $sub_list = array();
        $target_ind_list = array();
        $target_subind_list = array();
        $real_ind_list = array();
        $real_subind_list = array();
        $sel_tgtind_list = array();
        $sel_actual_list = array();
        $sel_subtgtind_list = array();
        $sel_subactual_list = array();
        foreach ($sarmut_list1 as $data) {
            $targetind = \DB::table('tm_target_month as a')
            ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
            ->leftJoin('tm_sub_indicator as c', 'a.SUB_INDICATOR_ID', '=' , 'c.SUB_INDICATOR_ID')
            ->select('a.TARGET_JAN as JAN', 'a.TARGET_FEB as FEB', 'a.TARGET_MAR as MAR', 'a.TARGET_APR as APR', 'a.TARGET_MAY as MAY', 'a.TARGET_JUN as JUN', 'a.TARGET_JUL as JUL', 'a.TARGET_AUG as AUG', 'a.TARGET_SEP as SEP', 'a.TARGET_OCT as OCT', 'a.TARGET_NOV as NOV', 'a.TARGET_DES as DES')
            ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID);
            $tgtind_list1 = $targetind->get();
            $tgtind_list = $tgtind_list1->toArray();
            $real = \DB::table('tx_header_sasaran_mutu as a')
            ->leftJoin('tx_det_sasaran_mutu as b', 'a.HEADER_SASARAN_MUTU_ID', '=' , 'b.HEADER_SASARAN_MUTU_ID')
            ->leftJoin('tx_sub_det_sasaran_mutu as c', 'b.DET_SASARAN_MUTU_ID', '=' , 'c.DET_SASARAN_MUTU_ID')
            ->select('a.MONTH as MONTH', 'a.YEAR as YEAR', 'b.INDICATOR_ID as INDICATOR_ID', 'b.ACTUAL_REALISASI as ACTUAL_REALISASI', 'b.KETERANGAN as KETERANGAN', 'c.SUB_INDICATOR_ID as SUB_INDICATOR_ID', 'c.ACTUAL_REALISASI as SUB_ACTUAL_REALISASI')
            ->where('b.INDICATOR_ID', '=', $data->INDICATOR_ID);
            $real_list1 = $real->get();
            $real_list = $real_list1->toArray();

            $seltargetind = \DB::table('tm_target_month as a')
            ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
            ->leftJoin('tm_sub_indicator as c', 'a.SUB_INDICATOR_ID', '=' , 'c.SUB_INDICATOR_ID')
            ->select('a.TARGET_'.$header_sarmut->MONTH.' as SELECTED')
            ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID);
            $seltgtind_list = $seltargetind->first();
            array_push($sel_tgtind_list, $seltgtind_list);

            $selactualind = \DB::table('tx_det_sasaran_mutu as a')
            ->select('a.ACTUAL_REALISASI as SELECTED', 'a.KETERANGAN as KETERANGAN', 'a.DET_SASARAN_MUTU_ID as DET_SASARAN_MUTU_ID','a.ALASAN as ALASAN')
            ->where('a.INDICATOR_ID', '=', $data->INDICATOR_ID)
            ->where('a.HEADER_SASARAN_MUTU_ID', '=', $header_sarmut_id);
            $selactual_list = $selactualind->first();
            array_push($sel_actual_list, $selactual_list);
            // dd($seltgtind_list);

            $pttn='+-/*';   # standard mathematical operators
            $pttn=sprintf('@([%s])@', preg_quote($pttn)); # an escaped/quoted pattern

            $sub_ind=preg_split($pttn, preg_replace('@\s@', '', $data->FORMULA), -1, PREG_SPLIT_DELIM_CAPTURE);
            // dd($sub_ind);
            $num_split = array();
            foreach ($sub_ind as $split){
                if(is_numeric($split)){
                    array_push($num_split, $split);
                    $targetsubind = \DB::table('tm_target_month as a')
                    ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
                    ->leftJoin('tm_sub_indicator as c', 'a.SUB_INDICATOR_ID', '=' , 'c.SUB_INDICATOR_ID')
                    ->select('a.TARGET_JAN as JAN', 'a.TARGET_FEB as FEB', 'a.TARGET_MAR as MAR', 'a.TARGET_APR as APR', 'a.TARGET_MAY as MAY', 'a.TARGET_JUN as JUN', 'a.TARGET_JUL as JUL', 'a.TARGET_AUG as AUG', 'a.TARGET_SEP as SEP', 'a.TARGET_OCT as OCT', 'a.TARGET_NOV as NOV', 'a.TARGET_DES as DES')
                    ->where('a.SUB_INDICATOR_ID', '=', $split);
                    $tgtsubind_list1 = $targetsubind->get();
                    $tgtsubind_list = $tgtsubind_list1->toArray();
                    $target_subind_list['subtarget-'.$data->INDICATOR_ID.'-'.$split] = $tgtsubind_list;

                    $sub_real = \DB::table('tx_header_sasaran_mutu as a')
                    ->leftJoin('tx_det_sasaran_mutu as b', 'a.HEADER_SASARAN_MUTU_ID', '=' , 'b.HEADER_SASARAN_MUTU_ID')
                    ->leftJoin('tx_sub_det_sasaran_mutu as c', 'b.DET_SASARAN_MUTU_ID', '=' , 'c.DET_SASARAN_MUTU_ID')
                    ->select('a.MONTH as MONTH', 'a.YEAR as YEAR', 'b.INDICATOR_ID as INDICATOR_ID', 'b.ACTUAL_REALISASI as ACTUAL_REALISASI', 'b.KETERANGAN as KETERANGAN', 'c.SUB_INDICATOR_ID as SUB_INDICATOR_ID', 'c.ACTUAL_REALISASI as SUB_ACTUAL_REALISASI')
                    ->where('b.INDICATOR_ID', '=', $split);
                    $sub_real_list1 = $sub_real->get();
                    $sub_real_list = $sub_real_list1->toArray();
                    $real_subind_list['subreal-'.$data->INDICATOR_ID.'-'.$split] = $sub_real_list == '' ? '-' : $sub_real_list;
                }
            }
            // dd(count($num_split));
            $items1 = \DB::table('tm_indicator as a')
            ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'a.SUB_DIVISION_ID')
            ->whereIn('a.INDICATOR_ID',$num_split);
            $sub_in1 = $items1->get();
            $sub_in = $sub_in1->toArray();

            $selsubtargetind = \DB::table('tm_target_month as a')
            ->leftJoin('tm_indicator as b', 'a.INDICATOR_ID', '=' , 'b.INDICATOR_ID')
            ->leftJoin('tm_sub_indicator as c', 'a.SUB_INDICATOR_ID', '=' , 'c.SUB_INDICATOR_ID')
            ->select('a.TARGET_'.$header_sarmut->MONTH.' as SELECTED')
            ->whereIn('a.INDICATOR_ID', $num_split);
            $selsubtgtind_list1 = $selsubtargetind->get();
            $selsubtgtind_list = $selsubtgtind_list1->toArray();
            array_push($sel_subtgtind_list, $selsubtgtind_list);

            // dd($data->FORMULA);
            if($data->FORMULA <> '') {
                $selsubactualind = \DB::table('tx_sub_det_sasaran_mutu as a')
                ->leftJoin('tx_det_sasaran_mutu as b', 'b.DET_SASARAN_MUTU_ID', '=', 'a.DET_SASARAN_MUTU_ID')
                ->select('a.ACTUAL_REALISASI as SELECTED')
                ->where('a.DET_SASARAN_MUTU_ID', '=', $selactual_list->DET_SASARAN_MUTU_ID)
                ->whereIn('a.SUB_INDICATOR_ID', $num_split);
                $selsubactual_list1 = $selsubactualind->get();
                $selsubactual_list = $selsubactual_list1->toArray();
                array_push($sel_subactual_list, $selsubactual_list);
            }

            array_push($sub_list, $sub_in);
            // array_push($target_ind_list, $tgtind_list);
            $target_ind_list['target-'.$data->INDICATOR_ID] = $tgtind_list;
            $real_ind_list['real-'.$data->INDICATOR_ID] = $real_list;
            // array_push($target_subind_list, $tgtsubind_list);
            unset($num_split);
        }
        $years = array(date('Y'),date('Y')-1);
        $year = '';
        $months = array("JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OKT","NOV","DES");
        
        $mnow = $months[date('m')-1];
        $mmin1 = $months[date('m')-2];
        $monthss = array($mnow, $mmin1);
        // dd($years);
        $month = '';

        // dd($sel_subtgtind_list[0][0]->SELECTED);
        Session::put('targetind', $target_ind_list);
        Session::put('targetsubind', $target_subind_list);
        Session::put('realind', $real_ind_list);
        Session::put('realsubind', $real_subind_list);

        // dd($sub_list);

        return view('sarmut.detail_sarmut', [
            'now'                   => $now,
            'sarmut_list'     => $sarmut_list,
            'sel_tgtind_list'     => $sel_tgtind_list,
            'sel_actual_list'     => $sel_actual_list,
            'sel_subtgtind_list'     => $sel_subtgtind_list,
            'sel_subactual_list'     => $sel_subactual_list,
            'target_ind_list'     => $target_ind_list,
            'target_subind_list'     => $target_subind_list,
            'selectedmonth'     => $selectedmonth,
            'selectedyear'     => $selectedyear,
            'sub_in'     => $sub_list,
            'header_sarmut_id' => $header_sarmut_id,
            'sub_disabled_list'     => $sub_disabled_list,
            'disabled_list'     => $disabled_list,
            'sarmut'          => '',
            'years'     => $years,
            'year'     => $header_sarmut->YEAR,
            'months'     => $monthss,
            'month'     => $header_sarmut->MONTH,
            'status'     => $sapprove,
        ]);
    }

//     public function excel_export(Request $request)
//     {
      
//        $month = $request->month;
      
//        //  $years1 = $request->years1;
//        //  $branch1 = $request->branch1;
//       // $idusr = Auth::user()->ID;

//          // $fileExcel = 'Laporandata_'.$triwulan.'-'.$tahun.'-'.$pusatcabang
        
//          $fileExcel = 'Laporandata_';
//          //dd($excel);
//         // Generate and return the spreadsheet
//         Excel::create($fileExcel, function($excel) use ($month) {

//             // Set the spreadsheet title, creator, and description
//             $excel->setTitle('Payments');
//             $excel->setCreator('Laravel')->setCompany('PT Edi Indonesia');
//             $excel->setDescription('payments file');

//             // Build the spreadsheet, passing in the payments array
//             $excel->sheet('sheet1', function($sheet) {
                
//                 // $cells->setAlignment('center');
//                 // atur horizontal align

//                 // Set vertical alignment to middle
//                 // $cells->setValignment('center');

//                 // menambbahkan background
//                 // $cells->setBackground('#000000');


//                 $sheet->setCellValueByColumnAndRow(1, 1, "REALISASI KEY PERFORMANCE INDICATORS (KPI) TAHUN 2019 ", "");

//                 $border = array(
//                         'borders' => array(
//                             'allborders' => array(
//                             'style' => 'thin',
//                                 'color' => array('rgb' => '000000')
//                             )
//                         )
//                 );
                

//                 $sheet->mergeCells('B1:I1');
//                 $sheet->cells('B1:I1', function($cells) {
//                     $cells->setFont(array(
//                         'family'     => 'Calibri',
//                         'size'       => '20',
//                         'bold'       =>  true
//                     ));

//                     // atur horizontal align
//                     $cells->setAlignment('center');

//                     // atur vertical align
//                     $cells->setValignment('center');
//                     $cells->setBackground('#d9d9d9');

//                 });

//                 $sheet->mergeCells('B2:I2');
                
//                 $sheet->cell('B2', function($cell) {
//                     $cell->setValue('PT PELABUHAN TANJUNG PRIOK');
//                 });

//                 $sheet->cells('B2:I2', function($cells) {
//                     $cells->setFont(array(
//                         'family'     => 'Calibri',
//                         'size'       => '20',
//                         'bold'       =>  true
//                     ));

//                     // atur horizontal align
//                     $cells->setAlignment('center');

//                     // atur vertical align
//                     $cells->setValignment('center');
//                     $cells->setBackground('#d9d9d9');

//                     //#c3d79a

//                 });

//                 $Line=4;
// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//                 $data = \DB::select("CALL SP_Report_Realisasi_Sasaran_Mutu_SD ('$month')");
                


//                 ////////////////////////////////////query////////////////////////////////////

                
//                 $no=0;
//                 $total=0;

//                         ++$Line;
//                             $sheet->setCellValue('B'.$Line, 'NO');
//                             $sheet->setSize('B'.$Line, 5, 18);
//                             $sheet->setCellValue('C'.$Line, 'DIVISI');
//                             $sheet->setSize('C'.$Line, 15, 18);
//                             $sheet->setCellValue('D'.$Line, 'SUB DIVISI');
//                             $sheet->setSize('D'.$Line, 20, 18);
//                             $sheet->setCellValue('E'.$Line, 'INDICATOR TERCAPAI');
//                             $sheet->setSize('E'.$Line, 15, 18);
//                             $sheet->setCellValue('F'.$Line, 'INDICATOR TAK TERCAPAI');
//                             $sheet->setSize('F'.$Line, 15, 18);
//                             $sheet->setCellValue('G'.$Line, 'DATA KURANG');
//                             $sheet->setSize('G'.$Line, 15, 18);
//                             $sheet->setCellValue('H'.$Line, 'BELUM DI UKUR');
//                             $sheet->setSize('H'.$Line, 15, 18);
                           
//                             $sheet->getStyle('B'. $Line . ':H' . $Line)->applyFromArray($border);
//                             $sheet->getStyle('B'. $Line . ':H' . $Line)->getAlignment()->setHorizontal('Center');
//                             $sheet->cells('B'. $Line . ':H' . $Line, function($cells) {
//                             $cells->setFont(array(
//                                 'bold'       =>  true
//                             ));
//                             $cells->setBackground('#d9d9d9');

//                     });
//                         ////////////////////////////////////////////////////////////////////////////////////////////
//                          {
//                             ++$no;
//                             ++$Line;
//                             $sheet->setCellValue('B'.$Line, $no);
//                             $sheet->setSize('B'.$Line, 5, 18);
//                             $sheet->setCellValue('C'.$Line, "");
//                             $sheet->setSize('C'.$Line, 15, 18);
//                             $sheet->setCellValue('D'.$Line, "");
//                             $sheet->setSize('D'.$Line, 20, 18);
//                             $sheet->setCellValue('E'.$Line, "");
//                             $sheet->setSize('E'.$Line, 15, 18);
//                             $sheet->setCellValue('F'.$Line, "");
//                             $sheet->setSize('F'.$Line, 15, 18);
//                             $sheet->setCellValue('G'.$Line, "");
//                             $sheet->setSize('G'.$Line, 15, 18);
//                             $sheet->setCellValue('H'.$Line,"");
//                             $sheet->setSize('H'.$Line, 15, 18);
                            
//                             $sheet->getStyle('B'. $Line . ':H' . $Line)->applyFromArray($border);
//                             $sheet->getStyle('B'. $Line . ':H' . $Line)->getAlignment()->setHorizontal('Center');
//                             $sheet->cells('B'. $Line . ':F' . $Line, function($cells) {
//                             $cells->setBackground('#c3d79a');

//                     });
//                         }


//                     ++$Line;
//             });
            
//         })->export('xls');
        
        
        

//   }

}

    