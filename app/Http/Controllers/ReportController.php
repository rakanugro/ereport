<?php

namespace App\Http\Controllers;
use App\Models\Indicator;
use App\Models\Indicator_Target;
use App\Models\Sub_Indicator;
use App\Models\Period;
use App\Models\Sub_Division;
use App\Models\Report;

use Illuminate\Http\Request;

class ReportController extends Controller
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

    public function index(){
        $data = Report::get();
        return view('report.management_report', compact('data'));
    }

    public function add_post(Request $request){
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'report';
        $file->move($tujuan_upload, $nama_file);
        $simpan = new Report();
        $simpan->ORGANIZATION_STRUCTURE_ID = $request->organisasi_id;
        $simpan->FILE_NAME = $nama_file;
        $simpan->FILE_LOCATION = $tujuan_upload;
        $simpan->FILE_TYPE = $ext;
        $simpan->save();

        return redirect('management_report_index');
    }

    public function download($id){
        return response()->download(public_path('report/'.$id));
    }

    public function master_menu(Request $request)
    {
        $now            = Carbon::now();
        // dd($indicator_list);
        
        return view('master.master', [
                        'now'                   => $now,
        ]);
    }
    public function report_list(Request $request)
    {
        //
    }

    public function table_report(){
        // dd($data);
        $data = Report::get();
        
        return view('report.report_table', compact('data'));
    }

}
