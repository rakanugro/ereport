<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\Indicator_Target;
use App\Models\Indicator_Target_Triwulan;
use App\Models\Sub_Indicator;
use App\Models\Period;
use App\Models\Sub_Division;
use App\Models\Organisasi;
use App\Models\Directorate;
use App\Models\Divisi;
use App\Models\Branch_Office;
use App\Models\Dokumen;
use App\Models\User;
use App\Models\Main_Log;
use Auth;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MasterController extends Controller
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


    public function get_ajax($action,$id)
    {
        // dd($action);
        if ($action == "division") {
            $divisi = \DB::table('tm_division')
            ->SELECT('DIVISION_ID','DIVISION_NAME')
            ->WHERE('BRANCH_OFFICE_ID', '=', $id)
            ->get();
            return $divisi;
        }elseif ($action == "subdivision") {
            $subdivisi = \DB::table('tm_sub_division')
            ->SELECT('SUB_DIVISION_ID','SUB_DIVISION_NAME')
            ->WHERE('DIVISION_ID', '=', $id)
            ->get();
            
            return $subdivisi;

        }

        
    }

    public function master_menu(Request $request)
    {
        $now            = Carbon::now();
        // dd($indicator_list);
        
        return view('master.master', [
                        'now'                   => $now,
        ]);
    }
    
    public function indicator_list(Request $request)
    {
        // $indicator_list = array();
        $items = \DB::table('tm_indicator as t')
                    ->leftJoin('tm_organization_structure as o', 'o.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID')
                    ->leftJoin('tm_sub_division as ds', 'ds.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID_PENGISI')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as b', 'b.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_period as p', 'p.PERIOD_ID', '=' , 't.PERIOD_ID')
                    ->select('t.INDICATOR_ID as INDICATOR_ID', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 'sd.SUB_DIVISION_CODE as SUB_DIVISION_CODE', 'd.DIVISION_NAME as DIVISION_NAME', 'b.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'ds.SUB_DIVISION_NAME as SUB_DIVISION_NAME_PENGISI', 'p.PERIOD_NAME as PERIOD_NAME', 't.INDICATOR_NAME as INDICATOR_NAME', 't.FORMULA as FORMULA', 't.UNIT as UNIT', 't.INPUTABLE as INPUTABLE', 't.STATUS as STATUS', 't.ACTIVE as ACTIVE', 't.ALASAN_KEMBALIKAN')
                    ->orderBy('t.created_at', 'desc');
        $indicator_list = $items->get();
        $now            = Carbon::now();
        // dd($indicator_list);
        
        return view('master.indicator.indicator_list', [
                        'now'                   => $now,
                        'indicator_list'        => $indicator_list,
        ]);
    }

    public function indicator_target_list(Request $request)
    {
        // $indicator_list = array();
        // $items = \DB::table('tm_indicator_target as t')
        //             ->leftJoin('tm_indicator as i', 'i.INDICATOR_ID', '=' , 't.INDICATOR_ID')
        //             ->select('t.INDICATOR_TARGET_ID as INDICATOR_TARGET_ID', 'i.INDICATOR_NAME as INDICATOR_NAME', 't.INDICATOR_YEAR as INDICATOR_YEAR', 't.WEIGHT_UNIT as WEIGHT_UNIT', 't.WEIGHT as WEIGHT', 't.TARGET as TARGET', 't.TARGET_UNIT as TARGET_UNIT');
        $items = \DB::table('tm_target_month as t')
                    ->leftJoin('tm_indicator as i', 'i.INDICATOR_ID', '=' , 't.INDICATOR_ID')
                    ->leftJoin('tm_sub_division as c', 'i.SUB_DIVISION_ID', '=' , 'c.SUB_DIVISION_ID')
                    ->select('t.TARGET_MONTH_ID as TARGET_MONTH_ID', 'i.INDICATOR_NAME as INDICATOR_NAME', 't.YEAR as YEAR', 'i.UNIT as UNIT','c.SUB_DIVISION_NAME as SUB_DIVISION_NAME')
                    ->orderBy('t.created_at', 'desc');
        $indicator_target_list = $items->get();
        $now            = Carbon::now();

        $indicator_list      = \DB::table('tm_indicator as t')
                                ->leftJoin('tm_sub_division as d', 'd.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID')
                                ->where('IS_SASARAN_MUTU', 1)
                                ->get()->toArray();
        $indicator = '';

        //$years = array_combine(range(date("Y"), 1960), range(date("Y"), 1960));
        $years = array(date('Y'),date('Y')-1);
        $year  = '';
        
        return view('master.indicator_target.indicator_target_list', [
                        'now'                   => $now,
                        'indicator_target_list'        => $indicator_target_list,
                        'indicator'                 => $indicator,
                        'indicator_list'            => $indicator_list,
                        'year'                      => $year,
                        'years'                     => $years
        ]);
    }

    public function indicator_target_triwulan_list(Request $request)
    {
        $items = \DB::table('tm_target_triwulan as t')
                    ->leftJoin('tm_indicator as i', 'i.INDICATOR_ID', '=' , 't.INDICATOR_ID')
                    ->leftJoin('tm_sub_division as c', 'i.SUB_DIVISION_ID', '=' , 'c.SUB_DIVISION_ID')
                    ->select('t.TARGET_TRIWULAN_ID as TARGET_TRIWULAN_ID', 'i.INDICATOR_NAME as INDICATOR_NAME', 't.YEAR as YEAR', 'i.UNIT as UNIT','c.SUB_DIVISION_NAME as SUB_DIVISION_NAME')
                    ->orderBy('t.created_at', 'desc');
        $indicator_target_list = $items->get();

        $indicator_list      = \DB::table('tm_indicator as t')
                                ->leftJoin('tm_sub_division as d', 'd.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID')
                                ->where('IS_KPI', 1)
                                ->get()->toArray();
        $indicator = '';

        $now            = Carbon::now();
        $years = array(date('Y'),date('Y')-1);
        $year  = '';
        // dd($indicator_list);
        
        return view('master.indicator_target_triwulan.indicator_target_list', [
                        'now'                   => $now,
                        'indicator_target_list'        => $indicator_target_list,
                        'indicator'                 => $indicator,
                        'indicator_list'           => $indicator_list,
                        'year'                      => $year,
                        'years'                     => $years
        ]);
    }

    public function sub_indicator_list(Request $request)
    {
        // $indicator_list = array();
        $sub_indicator_list = Sub_Indicator::all()->toArray();
        $now            = Carbon::now();
        // dd($sub_indicator_list);
        
        return view('master.sub_indicator.sub_indicator_list', [
                        'now'                   => $now,
                        'sub_indicator_list'        => $sub_indicator_list,
        ]);
    }
    
    public function organization_structure_list(Request $request)
    {

        $oganisasi = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 'o.ACTIVE', 'o.APPROVED_1_STATUS', 'o.APPROVED_2_STATUS', 'o.ALASAN_KEMBALIKAN')
                    ->orderBy('o.created_at', 'desc')->get();
        $organisasi_list = $oganisasi->toArray();
        $now            = Carbon::now();
        
        return view('master.organization_structure.list_organization_structure', [
                        'now'                   => $now,
                        'organization_structure_list'        => $organisasi_list,
        ]);
    }

     public function organization_structure_listx(Request $request)
    {

         $directorat = \DB::table('tm_directorate')
        ->select('DIRECTORATE_ID', 'DIRECTORATE_NAME', 'IS_CABANG')
        ->where('ACTIVE', 'Y');
        $directorat_list = $directorat->get();

        $subbranch = \DB::table('tm_directorate as a')
                    ->leftJoin('tm_organization_structure as b', 'b.DIRECTORATE_ID', '=' , 'a.DIRECTORATE_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'b.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'b.DIVISION_ID')
                    ->leftJoin('tm_sub_division as e', 'e.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
                    ->select('b.ORGANIZATION_STRUCTURE_ID','a.DIRECTORATE_ID' , 'a.DIRECTORATE_NAME' , 'a.IS_CABANG' , 'c.BRANCH_OFFICE_ID',
                     'c.BRANCH_OFFICE_NAME', 'd.DIVISION_ID' , 'd.DIVISION_NAME','e.SUB_DIVISION_ID', 'e.SUB_DIVISION_NAME')
                    ->orderBy('a.DIRECTORATE_NAME', 'desc')
                    ->orderBy('a.IS_CABANG', 'asc')
                    ->orderBy('d.DIVISION_ID', 'asc')
                    ->orderBy('c.BRANCH_OFFICE_ID', 'asc')
                    ->distinct()->get();
        $subbranch_list = $subbranch->toArray();
        $now            = Carbon::now();
        //  dd($organisasi_list);
        
        return view('master.organization_structure.list_organization_structurex', [
                        'now'                   => $now,
                        'directorat'            => $directorat_list,
                        'subbranch_list'        => $subbranch_list
        ]);

    }

    public function master_user_list(Request $request)
    {
        /// $indicator_list = array();

        // $master_user_list = User::all()->toArray();
        $now            = Carbon::now();
        $items = \DB::table('users as users')
                    ->leftJoin('tm_organization_structure as os', 'users.ORG_ID', '=' , 'os.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_branch_office as b', 'b.BRANCH_OFFICE_ID', '=' , 'os.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'os.DIVISION_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'os.SUB_DIVISION_ID')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'os.DIRECTORATE_ID')
                    ->select('os.ORGANIZATION_STRUCTURE_ID', 'b.BRANCH_OFFICE_NAME', 
                             'os.DIVISION_ID', 'd.DIVISION_NAME',
                             'os.SUB_DIVISION_ID', 'sd.SUB_DIVISION_NAME', 'dr.DIRECTORATE_NAME', 
                             'os.ACTIVE', 'users.NAMA', 'users.STATUS', 'users.ORG_ID', 'users.ID','users.NIPP', 'users.APPROVED_1_STATUS' , 'users.APPROVED_2_STATUS', 'users.ALASAN_KEMBALIKAN')
                    ->orderBy('users.created_at', 'desc');
        $master_user_list = $items->get()->toArray();

        // dd($sub_indicator_list);


        
        return view('master.master_user.master_user_list', [
                        'now'                   => $now,
                        'master_user_list'        => $master_user_list,
        ]);
    }

    public function form_indicator(Request $request)
    {
        $period_list         = Period::all()->toArray();
        //$sub_division_list   = Sub_Division::all()->toArray();
        $sub_division_list   = \DB::table('tm_sub_division as s')
                                ->leftJoin('tm_organization_structure as o', 'o.SUB_DIVISION_ID', '=' , 's.SUB_DIVISION_ID')
                                ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                                ->leftJoin('tm_branch_office as e', 'o.BRANCH_OFFICE_ID', '=' , 'e.BRANCH_OFFICE_ID')
                                ->select('s.SUB_DIVISION_ID', 's.SUB_DIVISION_NAME', 'e.BRANCH_OFFICE_NAME')
                                ->get();
                                //dd($sub_division_list);
        $indicator_list  = Indicator::all()->toArray();
        $sub_division   = '';
        $period         = '';
        $sub_indicator  = '';
        $now            = Carbon::now();
        
        return view('master.indicator.form', [
                        'now'                   => $now,
                        'period'                => $period,
                        'period_list'                => $period_list,
                        'sub_division_list'     => $sub_division_list,
                        'sub_division'          => $sub_division,
                        'indicator_list'     => $indicator_list,
                        'sub_indicator'          => $sub_indicator,
        ]);
    }

    public function form_edit_indicator(Request $request)
    {
        $items = Indicator::where('INDICATOR_ID', $request->id)->first();
        $selectedperiod = $items->PERIOD_ID;
        $selectedsd = $items->SUB_DIVISION_ID;
        $itemsget = \DB::table('tm_indicator as t')
                    ->leftJoin('tm_sub_division as d', 'd.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID')
                    ->leftJoin('tm_period as p', 'p.PERIOD_ID', '=' , 't.PERIOD_ID')
                    ->select('t.INDICATOR_ID as INDICATOR_ID', 'd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 'p.PERIOD_NAME as PERIOD_NAME', 't.INDICATOR_NAME as INDICATOR_NAME', 't.FORMULA as FORMULA', 't.UNIT as UNIT')
                    ->where('t.INDICATOR_ID', '=', $request->id);
        $indicator = $itemsget->first();
        // dd($indicator);
        $indicator_name = $indicator->INDICATOR_NAME;
        $unit = $indicator->UNIT;
        $formula = $indicator->FORMULA;

        $period_list         = Period::all()->toArray();
        $sub_division_list   = \DB::table('tm_sub_division as s')
                                ->leftJoin('tm_organization_structure as o', 'o.SUB_DIVISION_ID', '=' , 's.SUB_DIVISION_ID')
                                ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                                ->leftJoin('tm_branch_office as e', 'o.BRANCH_OFFICE_ID', '=' , 'e.BRANCH_OFFICE_ID')
                                ->select('s.SUB_DIVISION_ID', 's.SUB_DIVISION_NAME', 'e.BRANCH_OFFICE_NAME')
                                ->get();
        $sub_indicator_list  = Sub_Indicator::all()->toArray();
        $sub_division   = '';
        $period         = '';
        $sub_indicator  = '';
        $now            = Carbon::now();
        
        return view('master.indicator.formedit', [
                        'id'    => $request->id,
                        'now'                   => $now,
                        'period'                => $period,
                        'period_list'                => $period_list,
                        'sub_division_list'     => $sub_division_list,
                        'sub_division'          => $sub_division,
                        'sub_indicator_list'     => $sub_indicator_list,
                        'sub_indicator'          => $sub_indicator,
                        'selectedperiod'          => $selectedperiod,
                        'selectedsd'          => $selectedsd,
                        'indicator_name'          => $indicator_name,
                        'unit'          => $unit,
                        'formula'          => $formula,
        ]);
    }

    public function form_edit_status_indicator(Request $request)
    {
        $items = Indicator::where('INDICATOR_ID', $request->id)->first();
        $selectedperiod = $items->PERIOD_ID;
        $selectedsd = $items->SUB_DIVISION_ID;
        $itemsget = \DB::table('tm_indicator as t')
                    ->leftJoin('tm_sub_division as d', 'd.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID')
                    ->leftJoin('tm_period as p', 'p.PERIOD_ID', '=' , 't.PERIOD_ID')
                    ->select('t.INDICATOR_ID as INDICATOR_ID', 'd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 'p.PERIOD_NAME as PERIOD_NAME', 't.INDICATOR_NAME as INDICATOR_NAME', 't.FORMULA as FORMULA', 't.UNIT as UNIT' , 't.ACTIVE as ACTIVE')
                    ->where('t.INDICATOR_ID', '=', $request->id);
        $indicator = $itemsget->first();
        // dd($indicator);
        $indicator_name = $indicator->INDICATOR_NAME;
        $unit = $indicator->UNIT;
        $formula = $indicator->FORMULA;
        $status = $indicator->ACTIVE;

        $period_list         = Period::all()->toArray();
        $sub_division_list   = Sub_Division::all()->toArray();
        $sub_indicator_list  = Sub_Indicator::all()->toArray();
        $sub_division   = '';
        $period         = '';
        $sub_indicator  = '';
        $now            = Carbon::now();
        
        return view('master.indicator.formstatus', [
                        'id'    => $request->id,
                        'now'                   => $now,
                        'period'                => $period,
                        'period_list'                => $period_list,
                        'sub_division_list'     => $sub_division_list,
                        'sub_division'          => $sub_division,
                        'sub_indicator_list'     => $sub_indicator_list,
                        'sub_indicator'          => $sub_indicator,
                        'selectedperiod'          => $selectedperiod,
                        'selectedsd'          => $selectedsd,
                        'indicator_name'          => $indicator_name,
                        'unit'          => $unit,
                        'formula'          => $formula,
                        'status'           =>  $status
        ]);
    }

    public function form_sub_indicator(Request $request)
    {
        $now            = Carbon::now();
        
        return view('master.sub_indicator.form', [
                        'now'                   => $now,
        ]);
    }

    public function form_edit_sub_indicator(Request $request)
    {
        $items = Sub_Indicator::where('SUB_INDICATOR_ID', $request->id)->first();
        $sub_indicator_name = $items->SUB_INDICATOR_NAME;
        $unit = $items->UNIT;
        $now            = Carbon::now();
        
        return view('master.sub_indicator.formedit', [
                        'id'                    => $request->id,
                        'now'                   => $now,
                        'sub_indicator_name'    => $sub_indicator_name,
                        'unit'                  => $unit,
        ]);
    }

    public function form_indicator_target(Request $request)
    {
        // $indicator_list      = Indicator::all()->toArray();
        $indicator_list      = \DB::table('tm_indicator as t')
                                ->leftJoin('tm_sub_division as d', 'd.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID')->get()->toArray();
        $now            = Carbon::now();
        $indicator = '';
        // dd($indicator);
        
        return view('master.indicator_target.form', [
                        'now'                   => $now,
                        'indicator'             => $indicator,
                        'indicator_list'             => $indicator_list,
        ]);
    }

    public function form_indicator_triwulan_target(Request $request)
    {
        // $indicator_list      = Indicator::all()->toArray();
        $indicator_list      = \DB::table('tm_indicator as t')
                                ->leftJoin('tm_sub_division as d', 'd.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID')->get()->toArray();
        $now            = Carbon::now();
        $indicator = '';
        // dd($indicator);
        
        return view('master.indicator_target_triwulan.form', [
                        'now'                   => $now,
                        'indicator'             => $indicator,
                        'indicator_list'             => $indicator_list,
        ]);
    }


    public function form_edit_indicator_target(Request $request)
    {

        $years = array(date('Y'),date('Y')-1);

        $items = Indicator_Target::where('TARGET_MONTH_ID', $request->id)->first();
        $selectedindicator = $items->INDICATOR_ID;
        $indicator_year = $items->YEAR;
        $weight_unit = $items->WEIGHT_UNIT;
        $weight = $items->WEIGHT;
        $target_unit = $items->TARGET_UNIT;
        $target = $items->TARGET;
        // $indicator_list      = Indicator::all()->toArray();
        $indicator_list      = \DB::table('tm_indicator as t')
                                ->leftJoin('tm_sub_division as d', 'd.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID')
                                ->where('IS_SASARAN_MUTU', 1)
                                ->get()->toArray();
        $now            = Carbon::now();
        $indicator = '';
        dd($indicator_list);

        $TARGET_JAN = $items->TARGET_JAN;
        $TARGET_FEB = $items->TARGET_FEB;
        $TARGET_MAR = $items->TARGET_MAR;
        $TARGET_APR = $items->TARGET_APR;
        $TARGET_MAY = $items->TARGET_MAY;
        $TARGET_JUN = $items->TARGET_JUN;
        $TARGET_JUL = $items->TARGET_JUL;
        $TARGET_AUG = $items->TARGET_AUG;
        $TARGET_SEP = $items->TARGET_SEP;
        $TARGET_OCT = $items->TARGET_OCT;
        $TARGET_NOV = $items->TARGET_NOV;
        $TARGET_DES = $items->TARGET_DES;
        $BOBOT_JAN = $items->BOBOT_JAN;
        $BOBOT_FEB = $items->BOBOT_FEB;
        $BOBOT_MAR = $items->BOBOT_MAR;
        $BOBOT_APR = $items->BOBOT_APR;
        $BOBOT_MAY = $items->BOBOT_MAY;
        $BOBOT_JUN = $items->BOBOT_JUN;
        $BOBOT_JUL = $items->BOBOT_JUL;
        $BOBOT_AUG = $items->BOBOT_AUG;
        $BOBOT_SEP = $items->BOBOT_SEP;
        $BOBOT_OCT = $items->BOBOT_OCT;
        $BOBOT_NOV = $items->BOBOT_NOV;
        $BOBOT_DES = $items->BOBOT_DES;


        // dd($indicator);
        
        return view('master.indicator_target.formedit', [
                        'id'    => $request->id,
                        'now'                   => $now,
                        'indicator'             => $indicator,
                        'indicator_list'             => $indicator_list,
                        'selectedindicator'             => $selectedindicator,
                        'indicator_year'             => $indicator_year,
                        'weight_unit'             => $weight_unit,
                        'weight'             => $weight,
                        'target_unit'             => $target_unit,
                        'target'             => $target,
                        'years'              => $years,

                        'TARGET_JAN'             => $TARGET_JAN,
                        'TARGET_FEB'             => $TARGET_FEB,
                        'TARGET_MAR'             => $TARGET_MAR,
                        'TARGET_APR'             => $TARGET_APR,
                        'TARGET_MAY'             => $TARGET_MAY,
                        'TARGET_JUN'             => $TARGET_JUN,
                        'TARGET_JUL'             => $TARGET_JUL,
                        'TARGET_AUG'             => $TARGET_AUG,
                        'TARGET_SEP'             => $TARGET_SEP,
                        'TARGET_OCT'             => $TARGET_OCT,
                        'TARGET_NOV'             => $TARGET_NOV,
                        'TARGET_DES'             => $TARGET_DES,
                        'BOBOT_JAN'             => $BOBOT_JAN,
                        'BOBOT_FEB'             => $BOBOT_FEB,
                        'BOBOT_MAR'             => $BOBOT_MAR,
                        'BOBOT_APR'             => $BOBOT_APR,
                        'BOBOT_MAY'             => $BOBOT_MAY,
                        'BOBOT_JUN'             => $BOBOT_JUN,
                        'BOBOT_JUL'             => $BOBOT_JUL,
                        'BOBOT_AUG'             => $BOBOT_AUG,
                        'BOBOT_SEP'             => $BOBOT_SEP,
                        'BOBOT_OCT'             => $BOBOT_OCT,
                        'BOBOT_NOV'             => $BOBOT_NOV,
                        'BOBOT_DES'             => $BOBOT_DES,

        ]);
    }

    public function form_edit_indicator_triwulan_target(Request $request)
    {
        $years = array(date('Y'),date('Y')-1);
        $items = Indicator_Target_Triwulan::where('TARGET_TRIWULAN_ID', $request->id)->first();
        $selectedindicator = $items->INDICATOR_ID;
        $indicator_year = $items->YEAR;
        $weight_unit = $items->WEIGHT_UNIT;
        $weight = $items->WEIGHT;
        $target_unit = $items->TARGET_UNIT;
        $target = $items->TARGET;
        // $indicator_list      = Indicator::all()->toArray();
        $indicator_list      = \DB::table('tm_indicator as t')
                                ->leftJoin('tm_sub_division as d', 'd.SUB_DIVISION_ID', '=' , 't.SUB_DIVISION_ID')
                                ->where('IS_KPI', 1)
                                ->get()->toArray();
        $now            = Carbon::now();
        $indicator = '';

        $TARGET_TRIWULAN_1 = $items->TARGET_TRIWULAN_1;
        $TARGET_TRIWULAN_2 = $items->TARGET_TRIWULAN_2;
        $TARGET_TRIWULAN_3 = $items->TARGET_TRIWULAN_3;
        $TARGET_TRIWULAN_4 = $items->TARGET_TRIWULAN_4;
        $BOBOT_TRIWULAN_1 = $items->BOBOT_TRIWULAN_1;
        $BOBOT_TRIWULAN_2 = $items->BOBOT_TRIWULAN_2;
        $BOBOT_TRIWULAN_3 = $items->BOBOT_TRIWULAN_3;
        $BOBOT_TRIWULAN_4 = $items->BOBOT_TRIWULAN_4;


        // dd($indicator);
        
        return view('master.indicator_target_triwulan.formedit', [
                        'id'    => $request->id,
                        'now'                   => $now,
                        'indicator'             => $indicator,
                        'indicator_list'             => $indicator_list,
                        'selectedindicator'             => $selectedindicator,
                        'indicator_year'             => $indicator_year,
                        'weight_unit'             => $weight_unit,
                        'weight'             => $weight,
                        'target_unit'             => $target_unit,
                        'target'             => $target,
                        'years'              => $years,

                        'TARGET_TRIWULAN_1'             => $TARGET_TRIWULAN_1,
                        'TARGET_TRIWULAN_2'             => $TARGET_TRIWULAN_2,
                        'TARGET_TRIWULAN_3'             => $TARGET_TRIWULAN_3,
                        'TARGET_TRIWULAN_4'             => $TARGET_TRIWULAN_4,
                        'BOBOT_TRIWULAN_1'             => $BOBOT_TRIWULAN_1,
                        'BOBOT_TRIWULAN_2'             => $BOBOT_TRIWULAN_2,
                        'BOBOT_TRIWULAN_3'             => $BOBOT_TRIWULAN_3,
                        'BOBOT_TRIWULAN_4'             => $BOBOT_TRIWULAN_4,

        ]);
    }
    
    public function form_organization_structure(Request $request)
    {

        $directorat = \DB::table('tm_directorate')
        ->select('DIRECTORATE_ID', 'DIRECTORATE_NAME', 'IS_CABANG')
        ->where('ACTIVE', 'Y');
        $directorat_list = $directorat->get();

        $branch = \DB::table('tm_branch_office')
        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
        ->where('ACTIVE', 'Y');
        $branch_list = $branch->get();
        
        $division = \DB::table('tm_division')
        ->select('DIVISION_ID', 'DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $division_list = $division->get();

        $sub_division = \DB::table('tm_sub_division')
        ->select('SUB_DIVISION_ID', 'SUB_DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $sub_division_list = $sub_division->get();

        $now            = Carbon::now();
        //  dd($organisasi_list);
        
        return view('master.organization_structure.form_organisasi_struktur', [
                        'now'                   => $now,
                        'directorat'            => $directorat_list,
                        'branch'                => $branch_list,
                        'division'              => $division_list,
                        'sub_division'             => $sub_division_list,
        ]);

       //

    }

    public function form_organization_structurex(Request $request)
    {

        $directorat = \DB::table('tm_directorate')
        ->select('DIRECTORATE_ID', 'DIRECTORATE_NAME', 'IS_CABANG')
        ->where('ACTIVE', 'Y');
        $directorat_list = $directorat->get();

        $branch = \DB::table('tm_branch_office')
        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
        ->where('ACTIVE', 'Y');
        $branch_list = $branch->get();
        
        $division = \DB::table('tm_division')
        ->select('DIVISION_ID', 'DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $division_list = $division->get();

        $sub_division = \DB::table('tm_sub_division')
        ->select('SUB_DIVISION_ID', 'SUB_DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $sub_division_list = $sub_division->get();

        $subbranch = \DB::table('tm_directorate as a')
                    ->leftJoin('tm_organization_structure as b', 'b.DIRECTORATE_ID', '=' , 'a.DIRECTORATE_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'b.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'b.DIVISION_ID')
                    ->leftJoin('tm_sub_division as e', 'e.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
                    ->select('a.DIRECTORATE_ID' , 'a.DIRECTORATE_NAME' , 'a.IS_CABANG' , 'c.BRANCH_OFFICE_ID',
                     'c.BRANCH_OFFICE_NAME', 'd.DIVISION_ID' , 'd.DIVISION_NAME','e.SUB_DIVISION_ID', 'e.SUB_DIVISION_NAME')
                    ->orderBy('a.DIRECTORATE_NAME', 'desc')->distinct()->get();
        $subbranch_list = $subbranch->toArray();
        $now            = Carbon::now();
        //  dd($organisasi_list);
        
        return view('master.organization_structure.form_organisasi_strukturx', [
                        'now'                   => $now,
                        'directorat'            => $directorat_list,
                        'branch'                => $branch_list,
                        'division'              => $division_list,
                        'sub_division'             => $sub_division_list,
                        'subbranch_list' =>$subbranch_list
        ]);

       //

    }

     public function form_organization_structurefix(Request $request)
    {

        $directorat = \DB::table('tm_directorate')
        ->select('DIRECTORATE_ID', 'DIRECTORATE_NAME', 'IS_CABANG')
        ->where('ACTIVE', 'Y');
        $directorat_list = $directorat->get();

        $branch = \DB::table('tm_branch_office')
        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
        ->where('ACTIVE', 'Y');
        $branch_list = $branch->get();
        
        $division = \DB::table('tm_division')
        ->select('DIVISION_ID', 'DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $division_list = $division->get();

        $sub_division = \DB::table('tm_sub_division')
        ->select('SUB_DIVISION_ID', 'SUB_DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $sub_division_list = $sub_division->get();

        $subbranch = \DB::table('tm_directorate as a')
                    ->leftJoin('tm_organization_structure as b', 'b.DIRECTORATE_ID', '=' , 'a.DIRECTORATE_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'b.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'b.DIVISION_ID')
                    ->leftJoin('tm_sub_division as e', 'e.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
                    ->select('a.DIRECTORATE_ID' , 'a.DIRECTORATE_NAME' , 'a.IS_CABANG' , 'c.BRANCH_OFFICE_ID',
                     'c.BRANCH_OFFICE_NAME', 'd.DIVISION_ID' , 'd.DIVISION_NAME','e.SUB_DIVISION_ID', 'e.SUB_DIVISION_NAME')
                    ->orderBy('a.DIRECTORATE_NAME', 'desc')->distinct()->get();
        $subbranch_list = $subbranch->toArray();
        $now            = Carbon::now();
        //  dd($organisasi_list);
        
        return view('master.organization_structure.form_organisasi_strukturfix', [
                        'now'                   => $now,
                        'directorat'            => $directorat_list,
                        'branch'                => $branch_list,
                        'division'              => $division_list,
                        'sub_division'             => $sub_division_list,
                        'subbranch_list' =>$subbranch_list
        ]);

       //

    }

    public function form_master_user(Request $request)
    {

        //$master_user_list = User::all()->toArray();
        $now            = Carbon::now();
        $user = '';
        $items = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME')->get();
        $organize_struct_list = $items->toArray();
        
        return view('master.master_user.form', [
                        'now'                   => $now,
                        'user'             => $user,
                        'organize_struct'       => $organize_struct_list,
        ]);

       //

    }

    public function save_indicator(Request $request)
    {
        $sub_division_id    = $request->sub_division_list[0];
        $sub_division_id_pengisi    = $request->sub_division_pengisi_list[0];
        $period_id          = $request->period_list[0];
        $indicator_name     = $request->indicator_name;
        $formula            = $request->formula;
        $unit               = $request->unit;
        $minscore               = $request->minscore;
        $maxscore               = $request->maxscore;
        $tipetkp               = $request->tipetkp[0];


        $item = new Indicator;
        
        $item->INDICATOR_NAME = $indicator_name;
        $item->SUB_DIVISION_ID = $sub_division_id;
        $item->SUB_DIVISION_ID_PENGISI = $sub_division_id_pengisi;
        $item->PERIOD_ID = $period_id;
        $item->MIN_SCORE = $minscore;
        $item->MAX_SCORE = $maxscore;
        $item->TIPE_TKP = $tipetkp;
        $formula = ltrim(ltrim($formula, '+'), '-');
        $formula = ltrim(ltrim($formula, '*'), '/');
        $item->FORMULA = $formula;
        $item->UNIT = $unit;
        $item->save();

        $modul = "INDICATOR"; 

        (new Main_Log)->setLog("Save Data",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/indicator_list');
    }


    public function edit_indicator(Request $request)
    {
        $sub_division_id    = $request->sub_division_list[0];
        $sub_division_id_pengisi    = $request->sub_division_pengisi_list[0];
        $period_id          = $request->period_list[0];
        $indicator_name     = $request->indicator_name;
        $formula            = $request->formula;
        $unit               = $request->unit;
        $minscore               = $request->minscore;
        $maxscore               = $request->maxscore;
        $tipetkp               = $request->tipetkp[0];

        $item = Indicator::where('INDICATOR_ID', '=', $request->id)->first();
        
        $item->INDICATOR_NAME = $indicator_name;
        $item->SUB_DIVISION_ID = $sub_division_id;
        $item->SUB_DIVISION_ID_PENGISI = $sub_division_id_pengisi;
        $item->PERIOD_ID = $period_id;
        $item->MIN_SCORE = $minscore;
        $item->MAX_SCORE = $maxscore;
        $item->TIPE_TKP = $tipetkp;
        $formula = ltrim(ltrim($formula, '+'), '-');
        $formula = ltrim(ltrim($formula, '*'), '/');
        $item->FORMULA = $formula;
        $item->UNIT = $unit;
        $item->STATUS = '1';
        $item->save();

        $modul = "INDICATOR"; 

        (new Main_Log)->setLog("Update Data",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/indicator_list');
    }

    public function indicator_active(Request $request)
    {
        $item = Indicator::where('INDICATOR_ID', '=', $request->id)->first();
        
        $item->ACTIVE = 'Y';
        $item->save();

        $modul = "INDICATOR"; 

        (new Main_Log)->setLog("Update Active",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/indicator_list');
    }

    public function indicator_inactive(Request $request)
    {
        $item = Indicator::where('INDICATOR_ID', '=', $request->id)->first();
        
        $item->ACTIVE = 'N';
        $item->save();

        $modul = "INDICATOR"; 

        (new Main_Log)->setLog("Update Inactive",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/indicator_list');
    }

    public function indicator_approve(Request $request)
    {
       $item = Indicator::where('INDICATOR_ID', '=', $request->id1)->first();
    //    dd($request->id1);
        
        if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
            $item->STATUS = '2';
            $item->save();

            $modul = "INDICATOR"; 

            (new Main_Log)->setLog("Approved DVP/DGM",json_encode($item),$modul,Auth::user()->ID);

        }elseif(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
            $item->STATUS = '3';
            $item->save();

            $modul = "INDICATOR"; 

            (new Main_Log)->setLog("Approved VP/GM",json_encode($item),$modul,Auth::user()->ID);
        }
        return redirect('/master/indicator_list');
    }

    public function indicator_kembalikan(Request $request)
    {

        if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
            $item = Indicator::where('INDICATOR_ID', '=', $request->id2)->first();

            $item->STATUS = '4';
            $item->ALASAN_KEMBALIKAN = $request->alasan;
            $item->save();

            $modul = "INDICATOR"; 

            (new Main_Log)->setLog("Dikembalikan DVP/DGM",json_encode($item),$modul,Auth::user()->ID);

        }elseif(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){
            $item = Indicator::where('INDICATOR_ID', '=', $request->id2)->first();

            $item->STATUS = '4';
            $item->ALASAN_KEMBALIKAN = $request->alasan;
            $item->save();

            $modul = "INDICATOR"; 

            (new Main_Log)->setLog("Dikembalikan VP/GM",json_encode($item),$modul,Auth::user()->ID);
        }
        return redirect('/master/indicator_list');
    }

    public function indicator_edit_status(Request $request)
    {
        $item = Indicator::where('INDICATOR_ID', '=', $request->id)->first();
        
        $item->ACTIVE = $request->status;
        $item->save();

        $modul = "INDICATOR"; 

        (new Main_Log)->setLog("Update Status",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/indicator_list');
    }

    // public function delete_indicator(Request $request)

    // {
    //     $sub_division_id    = $request->sub_division_list[0];
    //     $period_id          = $request->period_list[0];
    //     $indicator_name     = $request->indicator_name;
    //     $formula            = $request->formula;
    //     $unit               = $request->unit;
    //     $is_sarmut          = $request->is_sarmut;
    //     $is_kpi             = $request->is_kpi;
    //     $is_tkp             = $request->is_tkp;

    //     $item = Indicator::where('INDICATOR_ID', $request->id)->first();
        
    //     $item->INDICATOR_NAME = $indicator_name;
    //     $item->SUB_DIVISION_ID = $sub_division_id;
    //     $item->PERIOD_ID = $period_id;
    //     $formula = rtrim(rtrim($formula, '+'), '-');
    //     $formula = rtrim(rtrim($formula, '*'), '/');
    //     $item->FORMULA = $formula;
    //     $item->UNIT = $unit;
    //     $item->save();

    //     return redirect('/master/indicator_list');
    // }

    public function delete_indicator(Request $request)
    {
        Indicator::where('INDICATOR_ID',$request->id)->delete();

        return redirect('/master/indicator_list');
    }

    public function save_sub_indicator(Request $request)
    {
        $sub_indicator_name     = $request->sub_indicator_name;
        $sub_unit               = $request->sub_unit;
        $indicator_id              = $request->indicator_id;

        $item = new Sub_Indicator;
        $item->SUB_INDICATOR_NAME = $sub_indicator_name;
        $item->UNIT = $sub_unit;
        $item->save();

        return redirect('/master/sub_indicator_list');
    }

    public function edit_sub_indicator(Request $request)
    {
        $sub_indicator_name     = $request->sub_indicator_name;
        $sub_unit               = $request->sub_unit;
        $indicator_id              = $request->indicator_id;

        // dd($request->id);
        $item = Sub_Indicator::where('SUB_INDICATOR_ID', '=', $request->id)->first();
        $item->SUB_INDICATOR_NAME = $sub_indicator_name;
        $item->UNIT = $sub_unit;
        $item->save();

        return redirect('/master/sub_indicator_list');
    }

    public function delete_sub_indicator(Request $request)
    {
        Sub_Indicator::where('SUB_INDICATOR_ID',$request->id)->delete();

        return redirect('/master/sub_indicator_list');
    }

    public function save_indicator_target(Request $request)
    {
        // $user_id            = Auth::user()->id;
        $indicator_id       = $request->indicator_id[0];
        $indicator_year     = $request->indicator_year;
        // $weight_unit        = $request->weight_unit;
        // $weight             = $request->weight;
        // $target             = $request->target;
        $target_januari     = $request->target_januari;
        $target_februari    = $request->target_februari;
        $target_maret       = $request->target_maret;
        $target_april       = $request->target_april;
        $target_mei         = $request->target_mei;
        $target_juni        = $request->target_juni;
        $target_juli        = $request->target_juli;
        $target_agustus     = $request->target_agustus;
        $target_september   = $request->target_september;
        $target_oktober     = $request->target_oktober;
        $target_november    = $request->target_november;
        $target_desember    = $request->target_desember;
        $bobot_januari      = $request->bobot_januari;
        $bobot_februari     = $request->bobot_februari;
        $bobot_maret        = $request->bobot_maret;
        $bobot_april        = $request->bobot_april;
        $bobot_mei          = $request->bobot_mei;
        $bobot_juni         = $request->bobot_juni;
        $bobot_juli         = $request->bobot_juli;
        $bobot_agustus      = $request->bobot_agustus;
        $bobot_september    = $request->bobot_september;
        $bobot_oktober      = $request->bobot_september;
        $bobot_november     = $request->bobot_november;
        $bobot_desember     = $request->bobot_desember;

        // $target_triwulan1     = $request->target_triwulan1;
        // $target_triwulan2     = $request->target_triwulan2;
        // $target_triwulan3     = $request->target_triwulan3;
        // $target_triwulan4     = $request->target_triwulan4;
        // $bobot_triwulan1     = $request->bobot_triwulan1;
        // $bobot_triwulan2     = $request->bobot_triwulan2;
        // $bobot_triwulan3     = $request->bobot_triwulan3;
        // $bobot_triwulan4     = $request->bobot_triwulan4;

        $item = new Indicator_Target;
        // $item_triwulan = new Indicator_Target_Triwulan;

        $item->INDICATOR_ID = $indicator_id;
        $item->YEAR = $indicator_year;

        // $item_triwulan->INDICATOR_ID = $indicator_id;
        // $item_triwulan->YEAR = $indicator_year;
        // $item-> = $indicator_year;
        // $item->WEIGHT_UNIT = $weight_unit;
        // $item->WEIGHT = $weight;
        // $item->TARGET = $target;
        // $item->TARGET_UNIT = $target_unit;
        $item->TARGET_JAN = $target_januari;
        $item->TARGET_FEB = $target_februari;
        $item->TARGET_MAR = $target_maret;
        $item->TARGET_APR = $target_april;
        $item->TARGET_MAY = $target_mei;
        $item->TARGET_JUN = $target_juni;
        $item->TARGET_JUL = $target_juli;
        $item->TARGET_AUG = $target_agustus;
        $item->TARGET_SEP = $target_september;
        $item->TARGET_OCT = $target_oktober;
        $item->TARGET_NOV = $target_november;
        $item->TARGET_DES = $target_desember;
        $item->BOBOT_JAN  = $bobot_januari;
        $item->BOBOT_FEB  = $bobot_februari;
        $item->BOBOT_MAR  = $bobot_maret;
        $item->BOBOT_APR  = $bobot_april;
        $item->BOBOT_MAY  = $bobot_mei;
        $item->BOBOT_JUN  = $bobot_juni;
        $item->BOBOT_JUL  = $bobot_juli;
        $item->BOBOT_AUG  = $bobot_agustus;
        $item->BOBOT_SEP  = $bobot_september;
        $item->BOBOT_OCT  = $bobot_oktober;
        $item->BOBOT_NOV  = $bobot_november;
        $item->BOBOT_DES  = $bobot_desember;

        // $item_triwulan->TARGET_TRIWULAN_1  = $target_triwulan1;
        // $item_triwulan->TARGET_TRIWULAN_2  = $target_triwulan2;
        // $item_triwulan->TARGET_TRIWULAN_3  = $target_triwulan3;
        // $item_triwulan->TARGET_TRIWULAN_4  = $target_triwulan4;
        // $item_triwulan->BOBOT_TRIWULAN_1  = $bobot_triwulan1;
        // $item_triwulan->BOBOT_TRIWULAN_2  = $bobot_triwulan2;
        // $item_triwulan->BOBOT_TRIWULAN_3  = $bobot_triwulan3;
        // $item_triwulan->BOBOT_TRIWULAN_4  = $bobot_triwulan4;
        
        $item->save();
        // $item_triwulan->save();

        $modul = "INDICATOR TARGET BULANAN"; 

        (new Main_Log)->setLog("Save Data Target Bulanan",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/indicator_target_list');
    }

    public function save_indicator_triwulan_target(Request $request)
    {
        // $user_id            = Auth::user()->id;
        $indicator_id       = $request->indicator_id[0];
        $indicator_year     = $request->indicator_year;

        $target_triwulan1     = $request->target_triwulan1;
        $target_triwulan2     = $request->target_triwulan2;
        $target_triwulan3     = $request->target_triwulan3;
        $target_triwulan4     = $request->target_triwulan4;
        $bobot_triwulan1     = $request->bobot_triwulan1;
        $bobot_triwulan2     = $request->bobot_triwulan2;
        $bobot_triwulan3     = $request->bobot_triwulan3;
        $bobot_triwulan4     = $request->bobot_triwulan4;

        // $item = new Indicator_Target;
        $item = new Indicator_Target_Triwulan;

        // $item->INDICATOR_ID = $indicator_id;
        // $item->YEAR = $indicator_year;

        $item->INDICATOR_ID = $indicator_id;
        $item->YEAR = $indicator_year;
        // $item-> = $indicator_year;
        // $item->WEIGHT_UNIT = $weight_unit;
        // $item->WEIGHT = $weight;
        // $item->TARGET = $target;
        // $item->TARGET_UNIT = $target_unit;
        

        $item->TARGET_TRIWULAN_1  = $target_triwulan1;
        $item->TARGET_TRIWULAN_2  = $target_triwulan2;
        $item->TARGET_TRIWULAN_3  = $target_triwulan3;
        $item->TARGET_TRIWULAN_4  = $target_triwulan4;
        $item->BOBOT_TRIWULAN_1  = $bobot_triwulan1;
        $item->BOBOT_TRIWULAN_2  = $bobot_triwulan2;
        $item->BOBOT_TRIWULAN_3  = $bobot_triwulan3;
        $item->BOBOT_TRIWULAN_4  = $bobot_triwulan4;
        
        // $item->save();
        $item->save();

        $modul = "INDICATOR TARGET TRIWULAN"; 

        (new Main_Log)->setLog("Save Data Target Triwulan",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/indicator_target_triwulan_list');
    }

    public function edit_indicator_target(Request $request)
    {
        // $user_id            = Auth::user()->id;
        $indicator_id       = $request->indicator_id[0];
        $indicator_year     = $request->indicator_year;
        // $weight_unit        = $request->weight_unit;
        // $weight             = $request->weight;
        // $target             = $request->target;
        // $target_unit        = $request->target_unit;

        $target_januari     = $request->target_januari;
        $target_februari    = $request->target_februari;
        $target_maret       = $request->target_maret;
        $target_april       = $request->target_april;
        $target_mei         = $request->target_mei;
        $target_juni        = $request->target_juni;
        $target_juli        = $request->target_juli;
        $target_agustus     = $request->target_agustus;
        $target_september   = $request->target_september;
        $target_oktober     = $request->target_oktober;
        $target_november    = $request->target_november;
        $target_desember    = $request->target_desember;
        $bobot_januari      = $request->bobot_januari;
        $bobot_februari     = $request->bobot_februari;
        $bobot_maret        = $request->bobot_maret;
        $bobot_april        = $request->bobot_april;
        $bobot_mei          = $request->bobot_mei;
        $bobot_juni         = $request->bobot_juni;
        $bobot_juli         = $request->bobot_juli;
        $bobot_agustus      = $request->bobot_agustus;
        $bobot_september    = $request->bobot_september;
        $bobot_oktober      = $request->bobot_september;
        $bobot_november     = $request->bobot_november;
        $bobot_desember     = $request->bobot_desember;

        $item = Indicator_Target::where('TARGET_MONTH_ID', '=', $request->id)->first();
        $item->INDICATOR_ID = $indicator_id;
        $item->YEAR = $indicator_year;
        // $item->WEIGHT_UNIT = $weight_unit;
        // $item->WEIGHT = $weight;
        // $item->TARGET = $target;
        // $item->TARGET_UNIT = $target_unit;
        $item->TARGET_JAN = $target_januari;
        $item->TARGET_FEB = $target_februari;
        $item->TARGET_MAR = $target_maret;
        $item->TARGET_APR = $target_april;
        $item->TARGET_MAY = $target_mei;
        $item->TARGET_JUN = $target_juni;
        $item->TARGET_JUL = $target_juli;
        $item->TARGET_AUG = $target_agustus;
        $item->TARGET_SEP = $target_september;
        $item->TARGET_OCT = $target_oktober;
        $item->TARGET_NOV = $target_november;
        $item->TARGET_DES = $target_desember;
        $item->BOBOT_JAN  = $bobot_januari;
        $item->BOBOT_FEB  = $bobot_februari;
        $item->BOBOT_MAR  = $bobot_maret;
        $item->BOBOT_APR  = $bobot_april;
        $item->BOBOT_MAY  = $bobot_mei;
        $item->BOBOT_JUN  = $bobot_juni;
        $item->BOBOT_JUL  = $bobot_juli;
        $item->BOBOT_AUG  = $bobot_agustus;
        $item->BOBOT_SEP  = $bobot_september;
        $item->BOBOT_OCT  = $bobot_oktober;
        $item->BOBOT_NOV  = $bobot_november;
        $item->BOBOT_DES  = $bobot_desember;
        $item->save();

        $modul = "INDICATOR TARGET BULANAN"; 

        (new Main_Log)->setLog("Update Data Target Bulanan",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/indicator_target_list');
    }

    public function edit_indicator_triwulan_target(Request $request)
    {
        // $user_id            = Auth::user()->id;
        $indicator_id       = $request->indicator_id[0];
        $indicator_year     = $request->indicator_year;

        $TARGET_TRIWULAN_1     = $request->TARGET_TRIWULAN_1;
        $TARGET_TRIWULAN_2     = $request->TARGET_TRIWULAN_2;
        $TARGET_TRIWULAN_3     = $request->TARGET_TRIWULAN_3;
        $TARGET_TRIWULAN_4     = $request->TARGET_TRIWULAN_4;
        $BOBOT_TRIWULAN_1     = $request->BOBOT_TRIWULAN_1;
        $BOBOT_TRIWULAN_2     = $request->BOBOT_TRIWULAN_2;
        $BOBOT_TRIWULAN_3     = $request->BOBOT_TRIWULAN_3;
        $BOBOT_TRIWULAN_4     = $request->BOBOT_TRIWULAN_4;

        $item = Indicator_Target_Triwulan::where('TARGET_TRIWULAN_ID', '=', $request->id)->first();
        $item->INDICATOR_ID = $indicator_id;
        $item->YEAR = $indicator_year;
        $item->TARGET_TRIWULAN_1 = $TARGET_TRIWULAN_1;
        $item->TARGET_TRIWULAN_2 = $TARGET_TRIWULAN_2;
        $item->TARGET_TRIWULAN_3 = $TARGET_TRIWULAN_3;
        $item->TARGET_TRIWULAN_4 = $TARGET_TRIWULAN_4;
        $item->BOBOT_TRIWULAN_1 = $BOBOT_TRIWULAN_1;
        $item->BOBOT_TRIWULAN_2 = $BOBOT_TRIWULAN_2;
        $item->BOBOT_TRIWULAN_3 = $BOBOT_TRIWULAN_3;
        $item->BOBOT_TRIWULAN_4 = $BOBOT_TRIWULAN_4;
        $item->save();

        $modul = "INDICATOR TARGET TRIWULAN"; 

        (new Main_Log)->setLog("Update Data Target Triwulan",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/indicator_target_triwulan_list');
    }

    public function delete_indicator_target(Request $request)
    {
        Indicator_Target::where('TARGET_MONTH_ID',$request->id)->delete();

        return redirect('/master/indicator_target_list');
    }

    public function delete_indicator_triwulan_target(Request $request)
    {
        Indicator_Target_Triwulan::where('TARGET_TRIWULAN_ID',$request->id)->delete();

        return redirect('/master/indicator_target_triwulan_list');
    }

    public function save_organization_structure(Request $request)
    {

        $cek = \DB::table('tm_sub_division as a')
        ->leftJoin('tm_organization_structure as b' , 'a.SUB_DIVISION_ID', '=', 'b.SUB_DIVISION_ID')
        ->select('a.SUB_DIVISION_ID as SUB_DIVISION_ID')
        ->where('a.SUB_DIVISION_ID', '=', $request->sub_divisi)
        ->count();
        
        if ($cek == 0) {
            $gabungan = $request->directorat;
            $pisahiddir = explode('-', $gabungan);
            $iddir = $pisahiddir[0];
            $branch_office       = $request->branchoffice;
            $division            = $request->divisi;
            $sub_division        = $request->sub_divisi;
            $active              = 'Y';

            $item = new Organisasi;
            $item->DIRECTORATE_ID = $iddir;
            $item->BRANCH_OFFICE_ID = $branch_office;
            $item->DIVISION_ID = $division;
            $item->SUB_DIVISION_ID = $sub_division;
            $item->ACTIVE = $active;
            $item->save();

            $modul = "ORGANIZATION STRUCTURE"; 

            (new Main_Log)->setLog("Save Data Organisasi Strukture",json_encode($item),$modul,Auth::user()->ID);

            return redirect('/master/organization_structurex');
        }
        else
        {
             return redirect('/master/form_organization_structurefix')->with('error','Data Sudah Ada!!!');
        }

    }

     public function save_edit_organization_structure(Request $request)
    {
        if($request->branchoffice){
           $id = $request->id;
           $gabungan = $request->directorat;
           $pisahiddir = explode('-', $gabungan);
           $iddir = $pisahiddir[0];
           $branch_office       = $request->branchoffice;
           $division            = NULL;
           $sub_division        = $request->sub_divisi;
           $active              = $request->status;

           $item = Organisasi::where('ORGANIZATION_STRUCTURE_ID', $id)->first();
           $item->DIRECTORATE_ID = $iddir;
           $item->BRANCH_OFFICE_ID = $branch_office;
           $item->DIVISION_ID = $division;
           $item->SUB_DIVISION_ID = $sub_division;
           $item->ACTIVE = $active;
           $item->APPROVED_1_STATUS = '0';
           $item->APPROVED_2_STATUS = '0';
           $item->update();

           $modul = "ORGANIZATION STRUCTURE"; 

           (new Main_Log)->setLog("Update Data Organisasi Strukture",json_encode($item),$modul,Auth::user()->ID);

           return redirect('/master/organization_structure');
        }
        else
        {
            $id = $request->id;
            $gabungan = $request->directorat;
            $pisahiddir = explode('-', $gabungan);
            $iddir = $pisahiddir[0];
            $branch_office       = NULL;
            $division            = $request->divisi;
            $sub_division        = $request->sub_divisi;
            $active              = $request->status;

            $item = Organisasi::where('ORGANIZATION_STRUCTURE_ID', $id)->first();
            $item->DIRECTORATE_ID = $iddir;
            $item->BRANCH_OFFICE_ID = $branch_office;
            $item->DIVISION_ID = $division;
            $item->SUB_DIVISION_ID = $sub_division;
            $item->ACTIVE = $active;
            $item->APPROVED_1_STATUS = '0';
            $item->APPROVED_2_STATUS = '0';
            $item->update();

            $modul = "ORGANIZATION STRUCTURE"; 

           (new Main_Log)->setLog("Update Data Organisasi Strukture",json_encode($item),$modul,Auth::user()->ID);

            return redirect('/master/organization_structurex');
        }
        

    }

    public function delete_organization_structure(Request $request, $ORGANIZATION_STRUCTURE_ID)
    {
        Organisasi::where('ORGANIZATION_STRUCTURE_ID',$ORGANIZATION_STRUCTURE_ID)->delete();

        return redirect('/master/organization_structure');
    }

     public function edit_organization_structure($id)
    {
        
        $directorat = \DB::table('tm_directorate')
        ->select('DIRECTORATE_ID', 'DIRECTORATE_NAME', 'IS_CABANG')
        ->where('ACTIVE', 'Y');
        $directorat_list = $directorat->get();

        $branch = \DB::table('tm_branch_office')
        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
        ->where('ACTIVE', 'Y');
        $branch_list = $branch->get();
        
        $division = \DB::table('tm_division')
        ->select('DIVISION_ID', 'DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $division_list = $division->get();

        $sub_division = \DB::table('tm_sub_division')
        ->select('SUB_DIVISION_ID', 'SUB_DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $sub_division_list = $sub_division->get();

        $now            = Carbon::now();
        $organisasi = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 'o.ACTIVE', 'o.APPROVED_1_STATUS', 'o.APPROVED_2_STATUS', 'o.DIRECTORATE_ID' , 'o.BRANCH_OFFICE_ID', 'o.DIVISION_ID', 'o.SUB_DIVISION_ID')
                    ->where('ORGANIZATION_STRUCTURE_ID', $id)
                    ->first();

        $id = $organisasi->ORGANIZATION_STRUCTURE_ID;
        $id_directorat = $organisasi->DIRECTORATE_ID;
        $id_branch = $organisasi->BRANCH_OFFICE_ID;
        $id_division = $organisasi->DIVISION_ID;
        $id_sub_division = $organisasi->SUB_DIVISION_ID;
        $status  = $organisasi->ACTIVE;
        
        return view('master.organization_structure.form_edit_organization_structure', [
                        'now'                   => $now,
                        'directorat'            => $directorat_list,
                        'branch'                => $branch_list,
                        'division'              => $division_list,
                        'sub_division'             => $sub_division_list,
                        'id'                    => $id,
                        'id_directorat'         => $id_directorat,
                        'id_branch'             => $id_branch,
                        'id_division'           => $id_division,
                        'id_sub_division'       => $id_sub_division,
                        'status'                => $status
        ]);
        
    }

     public function form_status_organisasi_strukture($id)
    {
        
        $directorat = \DB::table('tm_directorate')
        ->select('DIRECTORATE_ID', 'DIRECTORATE_NAME', 'IS_CABANG')
        ->where('ACTIVE', 'Y');
        $directorat_list = $directorat->get();

        $branch = \DB::table('tm_branch_office')
        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
        ->where('ACTIVE', 'Y');
        $branch_list = $branch->get();
        
        $division = \DB::table('tm_division')
        ->select('DIVISION_ID', 'DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $division_list = $division->get();

        $sub_division = \DB::table('tm_sub_division')
        ->select('SUB_DIVISION_ID', 'SUB_DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $sub_division_list = $sub_division->get();

        $now            = Carbon::now();
        $organisasi = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 'o.ACTIVE', 'o.APPROVED_1_STATUS', 'o.APPROVED_2_STATUS', 'o.DIRECTORATE_ID' , 'o.BRANCH_OFFICE_ID', 'o.DIVISION_ID', 'o.SUB_DIVISION_ID')
                    ->where('ORGANIZATION_STRUCTURE_ID', $id)
                    ->first();

        $id = $organisasi->ORGANIZATION_STRUCTURE_ID;
        $id_directorat = $organisasi->DIRECTORATE_ID;
        $id_branch = $organisasi->BRANCH_OFFICE_ID;
        $id_division = $organisasi->DIVISION_ID;
        $id_sub_division = $organisasi->SUB_DIVISION_ID;
        $status = $organisasi->ACTIVE;
        
        return view('master.organization_structure.form_status_organization_structure', [
                        'now'                   => $now,
                        'directorat'            => $directorat_list,
                        'branch'                => $branch_list,
                        'division'              => $division_list,
                        'sub_division'             => $sub_division_list,
                        'id'                    => $id,
                        'id_directorat'         => $id_directorat,
                        'id_branch'             => $id_branch,
                        'id_division'           => $id_division,
                        'id_sub_division'       => $id_sub_division,
                        'status'                => $status
        ]);
        
    }

    public function save_status_organisasi_strukture(Request $request)
    {
        
           $id = $request->id;
           $active = $request->status;

           $item = Organisasi::where('ORGANIZATION_STRUCTURE_ID', $id)->first();
           $item->ACTIVE = $active;
           $item->update();

           $modul = "ORGANIZATION STRUCTURE"; 

           (new Main_Log)->setLog("Update Status Organisasi Strukture",json_encode($item),$modul,Auth::user()->ID);

           return redirect('/master/organization_structurex');

    }

    public function getorganisasistrukturebyid($id){

         $data = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 'o.ACTIVE', 'o.APPROVED_1_STATUS', 'o.APPROVED_2_STATUS', 'o.DIRECTORATE_ID' , 'o.BRANCH_OFFICE_ID', 'o.DIVISION_ID', 'o.SUB_DIVISION_ID')
                    ->where('ORGANIZATION_STRUCTURE_ID', $id)
                    ->first();

        return response()->json($data);

    }

     public function save_approvaldvporganisasistrukture(Request $request)
    {

        $id    = $request->id;
        $iduser = Auth::user()->ID;

        $datautama = Organisasi::where('ORGANIZATION_STRUCTURE_ID',$id)->first();
        $datautama->APPROVED_1_BY = $iduser;
        $datautama->APPROVED_1_STATUS = '1';
        $datautama->update();

        $modul = "ORGANIZATION STRUCTURE"; 

        (new Main_Log)->setLog("Approved DVP Organisasi Strukture",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/organization_structure');
    }

     public function save_approvalvporganisasistrukture(Request $request)
    {
        $id    = $request->id1;
        $iduser = Auth::user()->ID;

        $datautama = Organisasi::where('ORGANIZATION_STRUCTURE_ID',$id)->first();
        $datautama->APPROVED_2_BY = $iduser;
        $datautama->APPROVED_2_STATUS = '1';
        $datautama->ACTIVE = 'Y';
        $datautama->update();

        $modul = "ORGANIZATION STRUCTURE"; 

        (new Main_Log)->setLog("Approved VP Organisasi Strukture",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/organization_structure');
    }

     public function save_kembalikanorganisasistrukture(Request $request)
    {
        $id    = $request->id2;
        $alasan = $request->alasan;
        $iduser = Auth::user()->ID;
        if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){

            $datautama = Organisasi::where('ORGANIZATION_STRUCTURE_ID',$id)->first();
            $datautama->APPROVED_1_BY = $iduser;
            $datautama->APPROVED_1_STATUS = '2';
            $datautama->APPROVED_2_BY = $iduser;
            $datautama->APPROVED_2_STATUS = '2';
            $datautama->ACTIVE = 'N';
            $datautama->ALASAN_KEMBALIKAN = $alasan;
            $datautama->update();

            $modul = "ORGANIZATION STRUCTURE"; 

            (new Main_Log)->setLog("Dikembalikan DVP Organisasi Strukture",json_encode($datautama),$modul,Auth::user()->ID);

        }
        elseif(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
        {
            $datautama = Organisasi::where('ORGANIZATION_STRUCTURE_ID',$id)->first();
            $datautama->APPROVED_1_BY = $iduser;
            $datautama->APPROVED_1_STATUS = '2';
            $datautama->APPROVED_2_BY = $iduser;
            $datautama->APPROVED_2_STATUS = '2';
            $datautama->ACTIVE = 'N';
            $datautama->ALASAN_KEMBALIKAN = $alasan;
            $datautama->update();

            $modul = "ORGANIZATION STRUCTURE"; 

            (new Main_Log)->setLog("Dikembalikan VP Organisasi Strukture",json_encode($datautama),$modul,Auth::user()->ID);
        }
        
        
        return redirect('/master/organization_structure');

    }

    public function preview_organisasistrukture($id)
    {
        
        $directorat = \DB::table('tm_directorate')
        ->select('DIRECTORATE_ID', 'DIRECTORATE_NAME', 'IS_CABANG')
        ->where('ACTIVE', 'Y');
        $directorat_list = $directorat->get();

        $branch = \DB::table('tm_branch_office')
        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
        ->where('ACTIVE', 'Y');
        $branch_list = $branch->get();
        
        $division = \DB::table('tm_division')
        ->select('DIVISION_ID', 'DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $division_list = $division->get();

        $sub_division = \DB::table('tm_sub_division')
        ->select('SUB_DIVISION_ID', 'SUB_DIVISION_NAME')
        ->where('ACTIVE', 'Y');;
        $sub_division_list = $sub_division->get();

        $now            = Carbon::now();
        $organisasi = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME', 'o.ACTIVE', 'o.APPROVED_1_STATUS', 'o.APPROVED_2_STATUS', 'o.DIRECTORATE_ID' , 'o.BRANCH_OFFICE_ID', 'o.DIVISION_ID', 'o.SUB_DIVISION_ID')
                    ->where('ORGANIZATION_STRUCTURE_ID', $id)
                    ->first();

        $id = $organisasi->ORGANIZATION_STRUCTURE_ID;
        $id_directorat = $organisasi->DIRECTORATE_ID;
        $id_branch = $organisasi->BRANCH_OFFICE_ID;
        $id_division = $organisasi->DIVISION_ID;
        $id_sub_division = $organisasi->SUB_DIVISION_ID;
        $status = $organisasi->ACTIVE;
        
        return view('master.organization_structure.form_preview_organization_structure', [
                        'now'                   => $now,
                        'directorat'            => $directorat_list,
                        'branch'                => $branch_list,
                        'division'              => $division_list,
                        'sub_division'          => $sub_division_list,
                        'id'                    => $id,
                        'id_directorat'         => $id_directorat,
                        'id_branch'             => $id_branch,
                        'id_division'           => $id_division,
                        'id_sub_division'       => $id_sub_division,
                        'status'                => $status
        ]);
        
    }

    public function save_master_user(Request $request)
    {

        // $user_id            = Auth::user()->id;
        //$id_jabatan    = $request->id_jabatan;
        //$kelas     = $request->kelas;
        $username          = strtolower($request->nipp);
        $nama            = $request->nama;
        $access             = $request->access;
        $status             = 'INAKTIF';
        $email          = $request->email;
        //$tgl_pensiun             = $request->tgl_pensiun;
        $org_id             = $request->organize_struct_list;
        $password             = '12356';
        //$encpass             = $request->encpass;

        $item = new User;
        //$item->ID_JABATAN  = $id_jabatan;
        //$item->KELAS = $kelas;
        //$item->TIPE = $tipe;
        //$item->TGL_PENSIUN = $tgl_pensiun;
        $item->NIPP = $username;
        $item->NAMA = $nama;
        $item->ACCESS = $access;
        $item->STATUS = $status;
        $item->ORG_ID = $org_id;
        $item->EMAIL = $email;
        $item->PASSWORD= bcrypt($password);
        $item->ENCPASS = bcrypt($password);
        $item->save();

        $modul = "MASTER USER"; 

        (new Main_Log)->setLog("Save Data User",json_encode($item),$modul,Auth::user()->ID);

        return redirect('/master/master_user');

        //

        
    }

    public function edit_master_user(Request $request)
    {

        //$master_user_list = User::all()->toArray();
        $items = \DB::table('users as users')
                    ->leftJoin('tm_organization_structure as os', 'users.ORG_ID', '=' , 'os.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_branch_office as b', 'b.BRANCH_OFFICE_ID', '=' , 'os.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'os.DIVISION_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'os.SUB_DIVISION_ID')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'os.DIRECTORATE_ID')
                    ->where('users.ID', $request->id)->first();
        $now            = Carbon::now();

        $selectorgstruktur = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME')->get();
        $organize_struct_list = $selectorgstruktur->toArray();


        $id = $request->id;
        $nipp = $items->NIPP;
        $nama = $items->NAMA;
        $email = $items->EMAIL;
        $access = $items->ACCESS;
        //dd($access);
        $organize_struktur = $items->ORG_ID;
        
        return view('master.master_user.edit', [
                        'now'                   => $now,
                        'id'        => $id,
                        'nipp'        => $nipp,
                        'nama'        => $nama,
                        'access'        => $access,
                        'email'         => $email,
                        'organize_struktur'        => $organize_struktur,
                        'organize_struct'        => $organize_struct_list
        ]);
        
    }

    public function save_edit_master_user(Request $request)
    {
        //dd($request);
        $id    = $request->id;
        $nipp    = strtolower($request->nipp);
        $nama    = $request->nama;
        $email    = $request->email;
        $access    = $request->access;
        $orgid    = $request->organize_struct_list;

        $datautama = User::where('ID',$id)->first();
        $datautama->NIPP = $nipp;
        $datautama->NAMA = $nama;
        $datautama->EMAIL = $email;
        $datautama->ACCESS = $access;
        $datautama->ORG_ID = $orgid;
        $datautama->APPROVED_1_STATUS = '0';
        $datautama->APPROVED_2_STATUS = '0';
        $datautama->update();

        $modul = "MASTER USER"; 

        (new Main_Log)->setLog("Update Data User",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/master_user');
    }

    public function edit_status_master_user(Request $request)
    {

        //$master_user_list = User::all()->toArray();
        $items = \DB::table('users as users')
                    ->leftJoin('tm_organization_structure as os', 'users.ORG_ID', '=' , 'os.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_branch_office as b', 'b.BRANCH_OFFICE_ID', '=' , 'os.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'os.DIVISION_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'os.SUB_DIVISION_ID')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'os.DIRECTORATE_ID')
                    ->where('users.ID', $request->id)->first();
        $now            = Carbon::now();

        $selectorgstruktur = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME')->get();
        $organize_struct_list = $selectorgstruktur->toArray();


        $id = $request->id;
        $nipp = $items->NIPP;
        $nama = $items->NAMA;
        $email = $items->EMAIL;
        $access = $items->ACCESS;
        $status = $items->STATUS;
        $organize_struktur = $items->ORG_ID;
        //dd($access);
        
        return view('master.master_user.status', [
                        'now'                   => $now,
                        'id'        => $id,
                        'nipp'        => $nipp,
                        'nama'        => $nama,
                        'email'        => $email,
                        'access'        => $access,
                        'status'        => $status,
                        'organize_struktur'        => $organize_struktur,
                        'organize_struct'        => $organize_struct_list
        ]);
        
    }

    public function save_edit_status_master_user(Request $request)
    {
        //dd($request);
        $id    = $request->id;
        $status    = $request->status;
        $datautama = User::where('ID',$id)->first();
        $datautama->STATUS = $status;
        $datautama->update();

        $modul = "MASTER USER"; 

        (new Main_Log)->setLog("Update Status User",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/master_user');
    }

    public function getmasteruserbyid($id)
    {
        //$master_user_list = User::all()->toArray();
        $data = \DB::table('users as users')
                    ->leftJoin('tm_organization_structure as os', 'users.ORG_ID', '=' , 'os.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_branch_office as b', 'b.BRANCH_OFFICE_ID', '=' , 'os.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'os.DIVISION_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'os.SUB_DIVISION_ID')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'os.DIRECTORATE_ID')
                    ->where('users.ID', $id)->first();

        return response()->json($data);
        
    }

     public function save_approvaldvpmaster(Request $request)
    {

        $id    = $request->id;
        $iduser = Auth::user()->ID;

        $datautama = User::where('ID',$id)->first();
        $datautama->APPROVED_1_BY = $iduser;
        $datautama->APPROVED_1_STATUS = '1';
        $datautama->update();

        $modul = "MASTER USER"; 

        (new Main_Log)->setLog("Approved DVP Master User",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/master_user');
    }

     public function save_approvalvpmaster(Request $request)
    {
        $id    = $request->id1;
        $iduser = Auth::user()->ID;

        $datautama = User::where('ID',$id)->first();
        $datautama->APPROVED_2_BY = $iduser;
        $datautama->APPROVED_2_STATUS = '1';
        $datautama->STATUS = 'AKTIF';
        $datautama->update();

        $modul = "MASTER USER"; 

        (new Main_Log)->setLog("Approved VP Master User",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/master_user');
    }

     public function save_kembalikanmaster(Request $request)
    {
        $id    = $request->id2;
        $iduser = Auth::user()->ID;
        $alasan = $request->alasan;

        if(Auth::user()->ACCESS == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU'){

            $datautama = User::where('ID',$id)->first();
            $datautama->APPROVED_1_BY = $iduser;
            $datautama->APPROVED_1_STATUS = '2';
            $datautama->APPROVED_2_BY = $iduser;
            $datautama->APPROVED_2_STATUS = '2';
            $datautama->STATUS = 'INAKTIF';
            $datautama->ALASAN_KEMBALIKAN = $alasan;
            $datautama->update();

            $modul = "MASTER USER"; 

            (new Main_Log)->setLog("Dikembalikan DVP Organisasi Strukture",json_encode($datautama),$modul,Auth::user()->ID);

        }
        elseif(Auth::user()->ACCESS == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU')
        {
            $datautama = User::where('ID',$id)->first();
            $datautama->APPROVED_1_BY = $iduser;
            $datautama->APPROVED_1_STATUS = '2';
            $datautama->APPROVED_2_BY = $iduser;
            $datautama->APPROVED_2_STATUS = '2';
            $datautama->STATUS = 'INAKTIF';
            $datautama->ALASAN_KEMBALIKAN = $alasan;
            $datautama->update();

            $modul = "MASTER USER"; 

            (new Main_Log)->setLog("Dikembalikan VP Organisasi Strukture",json_encode($datautama),$modul,Auth::user()->ID);
        }

        
        return redirect('/master/master_user');
    }

     public function preview_master_user(Request $request)
    {

        $items = \DB::table('users as users')
                    ->leftJoin('tm_organization_structure as os', 'users.ORG_ID', '=' , 'os.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_branch_office as b', 'b.BRANCH_OFFICE_ID', '=' , 'os.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'os.DIVISION_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'os.SUB_DIVISION_ID')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'os.DIRECTORATE_ID')
                    ->where('users.ID', $request->id)->first();
        $now            = Carbon::now();

        $selectorgstruktur = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME')->get();
        $organize_struct_list = $selectorgstruktur->toArray();


        $id = $request->id;
        $nipp = $items->NIPP;
        $nama = $items->NAMA;
        $access = $items->ACCESS;
        $status = $items->STATUS;
        $email = $items->EMAIL;
        $organize_struktur = $items->ORG_ID;
        //dd($access);
        
        return view('master.master_user.preview', [
                        'now'                   => $now,
                        'id'        => $id,
                        'nipp'        => $nipp,
                        'nama'        => $nama,
                        'access'        => $access,
                        'status'        => $status,
                        'email'        => $email,
                        'organize_struktur'        => $organize_struktur,
                        'organize_struct'        => $organize_struct_list
        ]);
        
    }

    public function check_master_user()
    {
     
        $username = Input::get('usernm');
        $cek = strtolower($username);
        $data = \DB::table('users')->select('NIPP')->where('NIPP', $cek)->count();
        
        return $data;
    }

///////////////////////////////////////// DIRECTORATE////////////////////////////////////

     public function list_directorate()
    {
        $now            = Carbon::now();
        $user = '';
        $items = \DB::table('tm_directorate')->get();
        $list_directorate = $items->toArray();
        
        return view('master.organization_structure.list_directorate', [
                        'now'                    => $now,
                        'user'                   => $user,
                        'list_directorate'       => $list_directorate,
        ]);
          // return view('master.organization_structure/list_directorate',$data);

    }

     public function form_list_directorate()
    {
         return view('master.organization_structure.form_directorate'); 
    }


     public function save_list_directorate(Request $request)
    {
        $directorate_code       = $request->directorate_code;
        $directorate_name       = $request->directorate_name;
        $directorate_tipe       = $request->is_cabang;
        $active                 = 'Y';

        $items = new Directorate;
        $items->DIRECTORATE_CODE = $directorate_code;
        $items->DIRECTORATE_NAME = $directorate_name;
        $items->IS_CABANG = $directorate_tipe;
        $items->ACTIVE = $active;
        $items->save();

        $modul = "MASTER DIRECTORATE"; 

        (new Main_Log)->setLog("Save Data Directorate",json_encode($items),$modul,Auth::user()->ID);

        return redirect('/master/form_organization_structurefix');
    }

     public function check_codedirectorat()
    {
     
        $codedir = Input::get('codedir');
        $data = \DB::table('tm_directorate')->select('DIRECTORATE_CODE')->where('DIRECTORATE_CODE', $codedir)->count();
        
        return $data;
    }

    public function form_editdirectorate($id)
    {

        $items = \DB::table('tm_directorate')
        ->where('DIRECTORATE_ID', $id)->first();
        $now            = Carbon::now();

        $id = $id;
        $dircode = $items->DIRECTORATE_CODE;
        $dirname = $items->DIRECTORATE_NAME;
        $iscabang = $items->IS_CABANG;
        $status = $items->ACTIVE;
        
        return view('master.organization_structure.form_edit_directorate', [
            'now'                   => $now,
            'id'        => $id,
            'dircode'        => $dircode,
            'dirname'        => $dirname,
            'iscabang'       => $iscabang,
            'status'         => $status
        ]);
    }

    public function save_edit_directorate(Request $request)
    {
        $id    = $request->id;
        $dircode    = $request->directorate_code;
        $dirname    = $request->directorate_name;
        $directorate_tipe       = $request->is_cabang;
        $status       = $request->status;

        $datautama = Directorate::where('DIRECTORATE_ID',$id)->first();
        $datautama->DIRECTORATE_CODE = $dircode;
        $datautama->DIRECTORATE_NAME = $dirname;
        $datautama->IS_CABANG = $directorate_tipe;
        $datautama->ACTIVE = $status;
        $datautama->update();

        $modul = "MASTER DIRECTORATE"; 

        (new Main_Log)->setLog("Update Data Directorate",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/organization_structurex');
    }

     public function form_statusdirectorate($id)
    {

        $items = \DB::table('tm_directorate')
        ->where('DIRECTORATE_ID', $id)->first();
        $now            = Carbon::now();

        $id = $id;
        $dircode = $items->DIRECTORATE_CODE;
        $dirname = $items->DIRECTORATE_NAME;
        $iscabang = $items->IS_CABANG;
        $status = $items->ACTIVE;
        
        return view('master.organization_structure.form_status_directorate', [
            'now'                   => $now,
            'id'        => $id,
            'dircode'        => $dircode,
            'dirname'        => $dirname,
            'iscabang'       => $iscabang,
            'status'        => $status
        ]);
    }

    public function save_status_directorate(Request $request)
    {
        $id    = $request->id;
        $status    = $request->status;

        $datautama = Directorate::where('DIRECTORATE_ID',$id)->first();
        $datautama->ACTIVE = $status;
        $datautama->update();

        $modul = "MASTER DIRECTORATE"; 

        (new Main_Log)->setLog("Update Status Directorate",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/list_directorate');
    }

///////////////////////////////////////// DIRECTORATE////////////////////////////////////
    

    public function list_branch_office()
    { 
        $now            = Carbon::now();
        $items = \DB::table('tm_branch_office')->get();
        $list_branchoffice = $items->toArray();
        
        return view('master/organization_structure/list_branch_office',[
                        'now'                    => $now,
                        'list_branchoffice'       => $list_branchoffice ,
        ]);
        
    }

      public function form_branch_office()
    {
         return view('master.organization_structure.form_branch_office'); 
    }

    public function save_branchoffice(Request $request)
    {
        $branchoffice_code       = $request->branchoffice_code;
        $branchoffice_name       = $request->branchoffice_name;
        $active                 = 'Y';

        $items = new Branch_Office;
        $items->BRANCH_OFFICE_CODE = $branchoffice_code;
        $items->BRANCH_OFFICE_NAME = $branchoffice_name;
        $items->ACTIVE = $active;
        $items->save();

        $modul = "MASTER BRANCH OFFICE"; 

        (new Main_Log)->setLog("Save Data Branch Office",json_encode($items),$modul,Auth::user()->ID);

        return redirect('/master/form_organization_structurefix');
    }

    public function check_branchoffice_code()
    {

        $codebranch = Input::get('codebranch');
        $data = \DB::table('tm_branch_office')->select('BRANCH_OFFICE_CODE')->where('BRANCH_OFFICE_CODE', $codebranch)->count();
        
        return $data;
    }

    public function form_editbranchoffice($id)
    {

        $items = \DB::table('tm_branch_office')
        ->where('BRANCH_OFFICE_ID', $id)->first();
        $now            = Carbon::now();

        $id = $id;
        $codebranchoffice = $items->BRANCH_OFFICE_CODE;
        $namebranchoffice = $items->BRANCH_OFFICE_NAME;
        $status = $items->ACTIVE;
        
        return view('master.organization_structure.form_edit_branch_office', [
            'now'                   => $now,
            'id'        => $id,
            'codebranchoffice'        => $codebranchoffice,
            'namebranchoffice'        => $namebranchoffice,
            'status'                  => $status
        ]);
    }

    public function save_edit_branchoffice(Request $request)
    {
        $id    = $request->id;
        $branchcode    = $request->branchoffice_code;
        $branchname    = $request->branchoffice_name;
        $status    = $request->status;

        $datautama = Branch_Office::where('BRANCH_OFFICE_ID',$id)->first();
        $datautama->BRANCH_OFFICE_CODE = $branchcode;
        $datautama->BRANCH_OFFICE_NAME = $branchname;
        $datautama->ACTIVE = $status;
        $datautama->update();

        $modul = "MASTER BRANCH OFFICE"; 

        (new Main_Log)->setLog("Update Data Branch Office",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/organization_structurex');
    }

     public function form_statusbranchoffice($id)
    {

         $items = \DB::table('tm_branch_office')
        ->where('BRANCH_OFFICE_ID', $id)->first();
        $now            = Carbon::now();

        $id = $id;
        $codebranchoffice = $items->BRANCH_OFFICE_CODE;
        $namebranchoffice = $items->BRANCH_OFFICE_NAME;
        $status = $items->ACTIVE;
        
        return view('master.organization_structure.form_status_branch_office', [
            'now'                   => $now,
            'id'        => $id,
            'codebranchoffice'        => $codebranchoffice,
            'namebranchoffice'        => $namebranchoffice,
            'status'        => $status
        ]);
    }

    public function save_status_branchoffice(Request $request)
    {
        $id    = $request->id;
        $status    = $request->status;

        $datautama = Branch_Office::where('BRANCH_OFFICE_ID',$id)->first();
        $datautama->ACTIVE = $status;
        $datautama->update();

        $modul = "MASTER BRANCH OFFICE"; 

        (new Main_Log)->setLog("Update Status Branch Office",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/list_branch_office');
    }


     public function list_divisi()
    {
         $now            = Carbon::now();
         $items = \DB::table('tm_division')->get();
         $list_divisi = $items->toArray();

        return view('master/organization_structure/list_divisi',[
            'now'                    => $now,
            'list_divisi'       => $list_divisi ,
        ]);
    }

    public function form_divisi()
    {
         return view('master.organization_structure.form_divisi'); 
    }

    public function save_divisi(Request $request)
    {
        $division_code       = $request->division_code;
        $division_name       = $request->division_name;
        $active                 = 'Y';

        $items = new Divisi;
        $items->DIVISION_CODE = $division_code;
        $items->DIVISION_NAME = $division_name;
        $items->ACTIVE = $active;
        $items->save();

        $modul = "MASTER DIVISI"; 

        (new Main_Log)->setLog("Save Data Divisi",json_encode($items),$modul,Auth::user()->ID);

        return redirect('/master/form_organization_structurefix');
    }

    public function check_divisi_code()
    {

        $codedivisi = Input::get('codedivision');
        $data = \DB::table('tm_division')->select('DIVISION_CODE')->where('DIVISION_CODE', $codedivisi)->count();
        
        return $data;
    }

    public function form_editdivisi($id)
    {

        $items = \DB::table('tm_division')
        ->where('DIVISION_ID', $id)->first();
        $now            = Carbon::now();

        $id = $id;
        $divisioncode = $items->DIVISION_CODE;
        $divisionname = $items->DIVISION_NAME;
        $status = $items->ACTIVE;
        
        return view('master.organization_structure.form_edit_divisi', [
            'now'                   => $now,
            'id'        => $id,
            'divisioncode'        => $divisioncode,
            'divisionname'        => $divisionname,
            'status'              => $status
        ]);
    }

    public function save_edit_divisi(Request $request)
    {
        $id    = $request->id;
        $divisicode    = $request->division_code;
        $divisiname    = $request->division_name;
        $status        = $request->status;

        $datautama = Divisi::where('DIVISION_ID',$id)->first();
        $datautama->DIVISION_CODE = $divisicode;
        $datautama->DIVISION_NAME = $divisiname;
        $datautama->ACTIVE = $status;
        $datautama->update();

        $modul = "MASTER DIVISI"; 

        (new Main_Log)->setLog("Update Data Divisi",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/organization_structurex');
    }

     public function form_statusdivisi($id)
    {

         $items = \DB::table('tm_division')
        ->where('DIVISION_ID', $id)->first();
        $now            = Carbon::now();

        $id = $id;
        $divisicode = $items->DIVISION_CODE;
        $divisiname = $items->DIVISION_NAME;
        $status = $items->ACTIVE;
        
        return view('master.organization_structure.form_status_divisi', [
            'now'                   => $now,
            'id'        => $id,
            'divisioncode'        => $divisicode,
            'divisionname'        => $divisiname,
            'status'        => $status
        ]);
    }

    public function save_status_divisi(Request $request)
    {
        $id    = $request->id;
        $status    = $request->status;

        $datautama = Divisi::where('DIVISION_ID',$id)->first();
        $datautama->ACTIVE = $status;
        $datautama->update();

        $modul = "MASTER DIVISI"; 

        (new Main_Log)->setLog("Update Status Divisi",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/list_divisi');
    }

     public function list_sub_divisi()
    {
      $now            = Carbon::now();
      $items = \DB::table('tm_sub_division')->get();
      $list_sub_divisi = $items->toArray();
        return view('master/organization_structure/list_sub_divisi',[
            'now'                    => $now,
            'list_sub_divisi'       => $list_sub_divisi ,
        ]);  
    }

     public function form_subdivisi()
    {
         return view('master.organization_structure.form_sub_divisi'); 
    }

    public function save_subdivisi(Request $request)
    {
        $sub_division_code       = $request->sub_division_code;
        $sub_division_name       = $request->sub_division_name;
        $active                 = 'Y';

        $items = new Sub_Division;
        $items->SUB_DIVISION_CODE = $sub_division_code;
        $items->SUB_DIVISION_NAME = $sub_division_name;
        $items->ACTIVE = $active;
        $items->save();

        $modul = "MASTER SUB DIVISI"; 

        (new Main_Log)->setLog("Save Data Sub Divisi",json_encode($items),$modul,Auth::user()->ID);

        return redirect('/master/form_organization_structurefix');
    }

    public function check_subdivisi_code()
    {

        $codedivisi = Input::get('codesubdivision');
        $data = \DB::table('tm_sub_division')->select('SUB_DIVISION_CODE')->where('SUB_DIVISION_CODE', $codedivisi)->count();
        
        return $data;
    }

    public function form_editsubdivisi($id)
    {

        $items = \DB::table('tm_sub_division')
        ->where('SUB_DIVISION_ID', $id)->first();
        $now            = Carbon::now();

        $id = $id;
        $subdivisioncode = $items->SUB_DIVISION_CODE;
        $subdivisionname = $items->SUB_DIVISION_NAME;
        $status = $items->ACTIVE;
        
        return view('master.organization_structure.form_edit_sub_divisi', [
            'now'                   => $now,
            'id'        => $id,
            'subdivisioncode'        => $subdivisioncode,
            'subdivisionname'        => $subdivisionname,
            'status'                 => $status
        ]);
    }

    public function save_edit_subdivisi(Request $request)
    {
        $id    = $request->id;
        $subdivisicode    = $request->sub_division_code;
        $subdivisiname    = $request->sub_division_name;
        $status    = $request->status;

        $datautama = Sub_Division::where('SUB_DIVISION_ID',$id)->first();
        $datautama->SUB_DIVISION_CODE = $subdivisicode;
        $datautama->SUB_DIVISION_NAME = $subdivisiname;
        $datautama->ACTIVE = $status;
        $datautama->update();

        $modul = "MASTER SUB DIVISI"; 

        (new Main_Log)->setLog("Update Data Sub Divisi",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/organization_structurex');
    }

     public function form_statussubdivisi($id)
    {

         $items = \DB::table('tm_sub_division')
        ->where('SUB_DIVISION_ID', $id)->first();
        $now            = Carbon::now();

        $id = $id;
        $subdivisicode = $items->SUB_DIVISION_CODE;
        $subdivisiname = $items->SUB_DIVISION_NAME;
        $status = $items->ACTIVE;
        
        return view('master.organization_structure.form_status_sub_divisi', [
            'now'                   => $now,
            'id'        => $id,
            'subdivisicode'        => $subdivisicode,
            'subdivisiname'        => $subdivisiname,
            'status'        => $status
        ]);
    }

    public function save_status_subdivisi(Request $request)
    {
        $id    = $request->id;
        $status    = $request->status;

        $datautama = Sub_Division::where('SUB_DIVISION_ID',$id)->first();
        $datautama->ACTIVE = $status;
        $datautama->update();

        $modul = "MASTER SUB DIVISI"; 

        (new Main_Log)->setLog("Update Status Sub Divisi",json_encode($datautama),$modul,Auth::user()->ID);

        return redirect('/master/list_sub_divisi');
    }

    public function delete_master_user(Request $request)
    {
        //
    }
}
