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
use App\Models\User;

use Auth;
use Redirect;
use Session;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $items = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
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
        $iduser = Auth::user()->ID;
        return view('index', [
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
                        'iduser'        => $iduser
        ]);
    }

     public function save_edit_changepass(Request $request)
    {
        $id    = $request->idchangepass;
        $nipp    = strtolower($request->confirmnewpass);

        $datautama = User::where('ID',$id)->first();
        $datautama->NIPP = $nipp;
        $datautama->update();

        return Redirect::to('dashboard');
    }
}
