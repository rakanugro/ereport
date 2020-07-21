<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sop;
use App\Models\Organisasi;
use App\Models\Form_File;
use App\Models\Wi_File;
use App\Models\Header_Sop;
use App\Models\sop_ind;
use Validator;
use Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;


class SopController extends Controller
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

    public function index($id){

        $username = Auth::user()->NIPP;
        $items = \DB::select("CALL SP_Detail_SOP('$username','$id')");
        $data = $items;       
        if ($data != null ){
            $items = \DB::select("CALL SP_Detail_SOP('$username','$id')");
            $data = $items;  
           $id = $id;
           $tes = 2;
           return view('sop.sop', compact('data','id','tes'));
        }
        else
        {
           $id = $id;
           $tes = 1;
           return view('sop.sop', compact('id','tes'));
        }
        
    }

    public function upload_sop($id)
    {
        $id = $id;
        return view('sop.sop_upload', compact('id'));
    }
    
    public function table_sop($id){
        // dd($data);
        $username = Auth::user()->NIPP;
        $items = \DB::select("CALL SP_Detail_SOP('$username','$id')");
        $data = $items;       
        if ($data != null ){
            $items = \DB::select("CALL SP_Detail_SOP('$username','$id')");
            $data = $items;       
           $id = $id;
           $tes = 2;
           return view('sop.sop_table', compact('data','id','tes'));
        }
        else
        {
           $id = $id;
           $tes = 1;
           return view('sop.sop_table', compact('id','tes'));
        }
        
    }

     public function table_wi($id){
        // dd($data);
       $data = Wi_File::get()->where('HEADER_SOP_ID', $id);
        if ($data != null ){
           $data = Wi_File::get()->where('HEADER_SOP_ID', $id);
           $id = $id;
           $tes = 2;
           return view('sop.wi_table', compact('data','id','tes'));
        }
        else
        {
           $id = $id;
           $tes = 1;
           return view('sop.wi_table', compact('id','tes'));
        }
    }

    public function table_form_file($id){
        // dd($data);
        $data = Form_File::get()->where('HEADER_SOP_ID', $id);
        if ($data != null ){
           $data = Form_File::get()->where('HEADER_SOP_ID', $id);
           $id = $id;
           $tes = 2;
           return view('sop.form_file_table', compact('data','id','tes'));
        }
        else
        {
           $id = $id;
           $tes = 1;
           return view('sop.form_file_table', compact('id','tes'));
        }
    }

    public function form_sop(){
        $form_sop = Sop::get();
        // $divisi = Organisasi::get();
        $items = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'sd.DIVISION_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID',
                             'dr.DIRECTORATE_NAME as DIRECTORATE_NAME',
                             'd.DIVISION_NAME as DIVISION_NAME', 
                             'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME')->get();
        $organize_struct_list = $items->toArray();

        $items = \DB::table('tm_indicator as o')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->where('o.ACTIVE','Y')
                    ->select(\DB::raw("CONCAT(REPLACE(REPLACE(Indicator_Name, '\r', ''), '\n', '')) as INDICATOR_NAME,INDICATOR_ID"))->get();
        $Indicator = $items->toArray();

        $items = \DB::table('tm_grouping_user as g')
                    ->select('g.G_USER_ID','g.G_CODE')->get();
        $group_list = $items->toArray();
        $sop_list = Sop::all()->toArray();
        // dd($organisasi;
        
        return view('sop.form', [
                        'sop_list'        => $sop_list,
                        'org_list'        => $organize_struct_list,
                        'group_list'       => $group_list,
                        'Indicator'        => $Indicator
        ]);
        
        return view('');
    }

     public function edit($id){
        $form_sop = Sop::get();
        // $divisi = Organisasi::get();
        $items = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'sd.DIVISION_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID',
                             'dr.DIRECTORATE_NAME as DIRECTORATE_NAME',
                             'd.DIVISION_NAME as DIVISION_NAME', 
                             'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME')->get();
        $organize_struct_list = $items->toArray();

        $items = \DB::table('tm_indicator as o')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->where('o.ACTIVE','Y')
                    ->select(\DB::raw("CONCAT(sd.SUB_DIVISION_CODE,'--',REPLACE(REPLACE(Indicator_Name, '\r', ''), '\n', '')) as INDICATOR_NAME,INDICATOR_ID"))->get();
        $Indicator = $items->toArray();

        $items = \DB::table('tm_grouping_user as g')
                    ->select('g.G_USER_ID','g.G_CODE')->get();
        $group_list = $items->toArray();
        $sop_list = Sop::all()->toArray();

        $SOPData = \DB::table('tx_sop as sp')
                    ->leftJoin('tm_organization_structure as os', 'sp.ORGANIZATION_STRUCTURE_ID', '=' , 'os.ORGANIZATION_STRUCTURE_ID')
                    ->select('sp.SOP_ID','os.ORGANIZATION_STRUCTURE_ID','G_Code',
                             'sp.SOP_NO AS No_SOP','sp.SOP_Name AS Nama_SOP','sp.NO_REV AS SOP_No_Revisi','sp.ALS_REV AS SOP_Alasan_Revisi','sp.FILE_NAME AS SOP_File_Name','sp.FILE_LOCATION AS SOP_File_Location','sp.ACTIVE AS SOP_Active')
                    ->where('sp.SOP_ID', '=', $id);
        $SOPData = $SOPData->get();
        //dd($SOPData);

        $WIData = \DB::table('tx_sop as sp')
                    ->leftJoin('tx_wi as wi', 'sp.SOP_ID', '=' , 'wi.SOP_ID')
                    ->select('wi.WI_ID','wi.WI_NO AS No_WI','wi.WI_Name AS Nama_WI','wi.NO_REV AS WI_No_Revisi','wi.ALS_REV AS WI_Alasan_Revisi','wi.FILE_NAME AS WI_File_Name','wi.FILE_LOCATION AS WI_File_Location','wi.ACTIVE AS WI_Active')
                    ->where('sp.SOP_ID', '=', $id);
        $WIData = $WIData->get();

        $FMData = \DB::table('tx_sop as sp')
                    ->leftJoin('tx_wi as wi', 'sp.SOP_ID', '=' , 'wi.SOP_ID')
                    ->leftJoin('tx_form as fm', 'fm.WI_ID', '=' , 'wi.WI_ID')
                    ->select('wi.WI_ID','fm.FM_NO AS No_FM','fm.FM_Name AS Nama_FM','fm.NO_REV AS FM_No_Revisi','fm.ALS_REV AS FM_Alasan_Revisi','fm.FILE_NAME AS FM_File_Name','fm.FILE_LOCATION AS FM_File_Location','fm.ACTIVE AS FM_Active')
                    ->where('sp.SOP_ID', '=', $id);
        $FMData = $FMData->get();

        $IndData = \DB::table('tx_sop as sp')
                    ->leftJoin('tx_sop_ind as si', 'sp.SOP_ID','=','si.SOP_ID')
                    ->leftJoin('tm_indicator as id', 'si.INDICATOR_ID','=','id.INDICATOR_ID')
                    ->select('Indicator_Name')
                    ->where('sp.SOP_ID', '=', $id);
        $IndData = $IndData->get();
        
        return view('sop.edit', [
                        'sop_list'        => $sop_list,
                        'org_list'        => $organize_struct_list,
                        'group_list'      => $group_list,
                        'Indicator'       => $Indicator,
                        'SOPData'         => $SOPData,
                        'WIData'          => $WIData,
                        'FMData'          => $FMData,
                        'IndData'         => $IndData
        ]);

        return view('');
    }



    public function sop_list()
    {
        $division = \DB::table('tm_division')
        ->select('DIVISION_ID', 'DIVISION_NAME')
        ->where('ACTIVE', 'Y');
        $division_list = $division->get();

        $brnch = \DB::table('tm_branch_office')
        ->select('BRANCH_OFFICE_ID', 'BRANCH_OFFICE_NAME')
        ->where('ACTIVE', 'Y');
        $brnch_list = $brnch->get();

        $subdiv1 = \DB::table('tm_sub_division as sd')
        ->leftJoin('tm_organization_structure as os', 'sd.SUB_DIVISION_ID', '=' , 'os.SUB_DIVISION_ID')
        ->select('os.DIVISION_ID','sd.SUB_DIVISION_ID', 'sd.SUB_DIVISION_NAME');
        $subdiv1_list = $subdiv1->get();

        $subdiv2 = \DB::table('tm_sub_division as sd')
        ->leftJoin('tm_organization_structure as os', 'sd.SUB_DIVISION_ID', '=' , 'os.SUB_DIVISION_ID')
        ->select('os.BRANCH_OFFICE_ID','sd.SUB_DIVISION_ID', 'sd.SUB_DIVISION_NAME');
        $subdiv2_list = $subdiv2->get();

        $subdiv2 = \DB::table('tm_sub_division as sd')
        ->leftJoin('tm_organization_structure as os', 'sd.SUB_DIVISION_ID', '=' , 'os.SUB_DIVISION_ID')
        ->select('os.BRANCH_OFFICE_ID','sd.SUB_DIVISION_ID', 'sd.SUB_DIVISION_NAME');
        $subdiv2_list = $subdiv2->get();

        $sop = \DB::table('tx_sop as s')
        ->leftJoin('tm_organization_structure as os', 's.ORGANIZATION_STRUCTURE_ID', '=' , 'os.ORGANIZATION_STRUCTURE_ID')
        ->select(\DB::raw("CONCAT(s.SOP_NO,'-',s.SOP_NAME) as SOP_NAME,SUB_DIVISION_ID,SOP_ID"))
        ->where('s.ACTIVE','Y');
        $sop_list = $sop->get();

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
        //  dd($organisasi_list);
        
        return view('sop.sop_list', [
                        'division'      => $division_list,
                        'branch'        => $brnch_list,
                        'subdiv1'       => $subdiv1_list,
                        'subdiv2'       => $subdiv2_list,
                        'sop'           => $sop_list
        ]);
    }

    public function sopinactive(Request $request)
    {
        // dump($request->id);
        $active = \App\Models\Header_Sop::find($request->id);
        $active->ACTIVE = 'N';
        $active->save();

        return redirect()->back();

    }

    public function save_sop(Request $request)
    {
        $subdiv = $request->subdivisi_id;
        $SOPno = $request->SOPNO;
        $SOPname = $request->SOPNAME;
        $g_user_id = $request->g_user_id;
        $type_file = 'pdf';
        $SOPfile   = $request->SOPfile;
        $SOPfilePath = $request->SOPfilePath;
        $path      = base_path().'/public/sop/sop/';

        $simpan = new Header_Sop();
        $simpan->ORGANIZATION_STRUCTURE_ID = $subdiv;
        $simpan->SOP_NO = $SOPno;
        $simpan->SOP_NAME = $SOPname;
        $simpan->G_CODE = $g_user_id;
        $simpan->FILE_NAME = $SOPno.'-'.$SOPname.'.pdf';
        $simpan->FILE_LOCATION = $path;
        $simpan->FILE_TYPE =$type_file;
        $simpan->save();

        $request->file('SOPfile')->move($path,$SOPno.'-'.$SOPname.'.pdf');

        $SOPID = \DB::getPdo()->lastInsertId();
        $TotalInd = $request->CountInd;
        if($TotalInd>0)
        {
            for($c=1;$c<=$TotalInd;$c++)
            {
                $Ind_Name='IndName'.$c;
                $Ind_ID = $request->$Ind_Name;
                if($Ind_ID!=null)
                {
                    $simpanInd = new sop_ind();
                    $simpanInd->SOP_ID = $SOPID;
                    $simpanInd->INDICATOR_ID = $Ind_ID;
                    $simpanInd->save();
                }
            }
        }

        $TotalWI = $request->CountWI;
        if($TotalWI>0)
        {
             for($a=1;$a<=$TotalWI;$a++)
             {
                 $WINUM='WINO'.$a;
                 $WINM='WINAME'.$a;
                 $WINo = $request->$WINUM;
                 $WIname = $request->$WINM;
                 $type_file = 'pdf';
                 $WIfile   = $request->WIfile;
                 $WIfilePath = $request->WIfilePath;
                 $path      = base_path().'/public/sop/wi/';

                 $simpanWI = new Wi_File();
                 $simpanWI->SOP_ID = $SOPID;
                 $simpanWI->WI_NO = $WINo;
                 $simpanWI->WI_NAME = $WIname;
                 $simpanWI->FILE_NAME = $WINo.'-'.$WIname.'.pdf';
                 $simpanWI->FILE_LOCATION = $path;
                 $simpanWI->FILE_TYPE =$type_file;
                 $simpanWI->save();

                 $request->file('WIfile'.$a)->move($path,$WINo.'-'.$WIname.'.pdf');

                 $Count='CountForm'.$a;
                 $TotalFM = $request->$Count;
                 $WIID = \DB::getPdo()->lastInsertId();
                 if($TotalFM>0)
                {
                    for($b=1;$b<=$TotalFM;$b++)
                    {
                        $FormNUM='FMNO'.$a.$b;
                        $FormNM='FMNAME'.$a.$b;
                        $FormNo = $request->$FormNUM;
                        $Formname = $request->$FormNM;
                        $type_file = $request->file('Formfile'.$a.$b)->getClientOriginalExtension();
                        $Formfile   = $request->Formfile;
                        $FormfilePath = $request->FormfilePath;
                        $path      = base_path().'/public/sop/form/';

                        $simpanForm = new Form_File();
                        $simpanForm->WI_ID = $WIID;
                        $simpanForm->FM_NO = $FormNo;
                        $simpanForm->FM_NAME = $Formname;
                        $simpanForm->FILE_NAME = $FormNo.'-'.$Formname.'.pdf';
                        $simpanForm->FILE_LOCATION = $path;
                        $simpanForm->FILE_TYPE =$type_file;
                        $simpanForm->save();

                        $request->file('Formfile'.$a.$b)->move($path,$FormNo.'-'.$Formname.'.pdf');
                    }
                }
             }
        }

        //dd(\DB::getPdo()->lastInsertId());

        return redirect('/sop_list');
    }

     public function update(Request $request)
    {
    
        $subdiv = $request->subdivisi_id;
        $subdiv2 = $request->subdivisi_id_2;
        $g_user_id = $request->g_user_id;
        $code = $request->sopcodename;
        $no = $request->NO;
        $alasan = $request->ALASAN;
        $active = $request->active;
        $formd = $request->FROM_DATE;
        $tod = $request->TO_DATE;

        $update = Header_Sop::find($request->HEADER_SOP_ID);
        $update->ORGANIZATION_STRUCTURE_ID = $subdiv;
        $update->ORGANIZATION_STRUCTURE_ID_2 = $subdiv2;
        $update->G_CODE = $g_user_id;
        $update->SOP_CODE_NAME = $code;
        $update->NO = $no;
        $update->ALASAN = $alasan;
        $update->active = $active;
        $update->FROM_DATE = $formd;
        $update->TO_DATE = $tod;
        $update->save();

        return redirect('/sop_list');
    }



    public function add_post(Request $request){
        $idheader = $request->id;
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'sop';
        // $file->move($tujuan_upload, $nama_file);

        $simpan = new Sop();
        $simpan->HEADER_SOP_ID = $idheader;
        $simpan->FILE_NAME = $nama_file;
        $simpan->FILE_LOCATION = $tujuan_upload;
        $simpan->FILE_TYPE = $ext;
        $simpan->save();
        return redirect('sop_list');
    }

    public function download($id){
        return response()->download(public_path('sop/'.$id));
    }

    public function master_menu(Request $request)
    {
        $now            = Carbon::now();
        // dd($indicator_list);
        
        return view('master.master', [
                        'now'    => $now,
        ]);
    }

    public function sop_check()
    {
     
        $Code = Input::get('Code');
        $cek = strtolower($Code);
        $data = \DB::table('tx_sop')->select('SOP_NO)')->where('SOP_NO', $cek)->count();
        
        return $data;
    }

}
