<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sop;
use App\Models\Organisasi;
use App\Models\Form_File;
use App\Models\Wi_File;
use App\Models\Header_Sop;
use Auth;

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

        $data = Sop::get()->where('HEADER_SOP_ID', $id);
        if ($data != null ){
           $data = Sop::get()->where('HEADER_SOP_ID', $id);
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
        $data = Sop::get()->where('HEADER_SOP_ID', $id);
        if ($data != null ){
           $data = Sop::get()->where('HEADER_SOP_ID', $id);
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

        $items = \DB::table('tm_grouping_user as g')
                    ->select('g.G_USER_ID','g.G_CODE')->get();
        $group_list = $items->toArray();
        $sop_list = Sop::all()->toArray();
        // dd($organisasi;
        
        return view('sop.form', [
                        'sop_list'        => $sop_list,
                        'org_list'        => $organize_struct_list,
                        'group_list'       => $group_list
        ]);
        
        return view('');
    }


    public function sop_list()
    {

        $org_id = Auth::user()->ORG_ID;
        $org_id_2 = Auth::user()->ORG_ID_2;
        $access = Auth::user()->ACCESS;
        $username = Auth::user()->NIPP;
        // $sop_list = Header_Sop::get();
        if($access == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || $access == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || $access == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU') 
        {
            // dd(Auth::user()->ACCESS);
            $items = \DB::table('tx_header_sop as p')
                    ->leftJoin('tm_organization_structure as os', 'p.ORGANIZATION_STRUCTURE_ID', '=' , 'os.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_organization_structure as os2', 'p.ORGANIZATION_STRUCTURE_ID_2', '=' , 'os2.ORGANIZATION_STRUCTURE_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'os.DIVISION_ID')
                    ->leftJoin('tm_branch_office as b', 'b.BRANCH_OFFICE_ID', '=' , 'os.BRANCH_OFFICE_ID')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'os.SUB_DIVISION_ID')
                    ->leftJoin('tm_directorate as di', 'di.DIRECTORATE_ID', '=' , 'os.DIRECTORATE_ID')
                    ->leftJoin('tm_sub_division as sd2', 'sd2.SUB_DIVISION_ID', '=' , 'os2.SUB_DIVISION_ID')
                    ->leftJoin('tm_grouping_user as g', 'g.G_CODE', '=' , 'p.G_CODE')
                    ->select('os.ORGANIZATION_STRUCTURE_ID', 'd.DIVISION_NAME',
                             'os.SUB_DIVISION_ID', 'sd.SUB_DIVISION_NAME as Sub_Divisi_1','sd2.SUB_DIVISION_NAME as Sub_Divisi_2',
                             'os.BRANCH_OFFICE_ID', 'b.BRANCH_OFFICE_NAME',
                             'os.DIRECTORATE_ID', 'di.DIRECTORATE_NAME',
                             'p.G_CODE',
                             'p.ALASAN as Alasan',
                             'p.ACTIVE as Active',
                             'p.SOP_CODE_NAME as SOP_Code_Name',
                             'p.FROM_DATE as From_Date',
                             'p.HEADER_SOP_ID as header_sop_id',
                             'p.TO_DATE as To_Date')
                    ->distinct()
                    ->where('p.ACTIVE', '=', 'Y')
                    ->orderBy('p.created_at', 'desc');
        $sop_list = $items->get()->toArray();

        return view('sop.sop_list', compact('sop_list'));
        }
        else{
            $items = \DB::select("SELECT * FROM vw_HeaderSOP a
                    WHERE G_Code = (SELECT G_Code FROM users a
                        LEFT JOIN tm_organization_structure b ON a.ORG_ID=b.ORGANIZATION_STRUCTURE_ID
                LEFT JOIN tm_directorate c ON b.DIRECTORATE_ID=c.DIRECTORATE_ID
                LEFT JOIN tm_grouping_user d ON a.ACCESS=d.USER_ROLE AND c.IS_CABANG=d.IS_CABANG
                WHERE NIPP='$username')");

     //             WHERE G_Code=(SELECT G_Code FROM users a
                    // LEFT JOIN tm_organization_structure b ON a.ORG_ID=b.ORGANIZATION_STRUCTURE_ID
                    // LEFT JOIN tm_directorate c ON b.DIRECTORATE_ID=c.DIRECTORATE_ID
                    // LEFT JOIN tm_grouping_user d ON a.ACCESS=d.USER_ROLE AND c.IS_CABANG=d.IS_CABANG
                    // WHERE NIPP='$username')
            $sop_list = $items;
                            // dd($sop_list);
                    
        return view('sop.sop_list', compact('sop_list'));
        }
        

    }

    public function save_sop(Request $request)
    {
    
        $subdiv = $request->subdivisi_id;
        $subdiv2 = $request->subdivisi_id_2;
        $g_user_id = $request->g_user_id;
        $code = $request->sopcodename;
        $alasan = $request->ALASAN;
        $active = $request->active;
        $formd = $request->FROM_DATE;
        $tod = $request->TO_DATE;

        $simpan = new Header_Sop();
        $simpan->ORGANIZATION_STRUCTURE_ID = $subdiv;
        $simpan->ORGANIZATION_STRUCTURE_ID_2 = $subdiv2;
        $simpan->G_CODE = $g_user_id;
        $simpan->SOP_CODE_NAME = $code;
        $simpan->ALASAN = $alasan;
        $simpan->active = $active;
        $simpan->FROM_DATE = $formd;
        $simpan->TO_DATE = $tod;
        $simpan->save();

        return redirect('/sop_list');
    }



    public function add_post(Request $request){
        $idheader = $request->id;
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'sop';
        $file->move($tujuan_upload, $nama_file);

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

}
