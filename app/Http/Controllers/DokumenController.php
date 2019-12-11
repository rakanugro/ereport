<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;

class DokumenController extends Controller
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
        $data = Dokumen::get();
        return view('dokumen.dokumen_pendukung', compact('data'));
    }

    public function add_post(Request $request){
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'dokumen';
        $file->move($tujuan_upload, $nama_file);
        $simpan = new Dokumen();
        $simpan->ORGANIZATION_STRUCTURE_ID = $request->organisasi_id;
        $simpan->FILE_NAME = $nama_file;
        $simpan->FILE_LOCATION = $tujuan_upload;
        $simpan->FILE_TYPE = $ext;
        $simpan->save();

        return redirect('dokumen_pendukung');
    }

    public function download($id){
        return response()->download(public_path('dokumen/'.$id));
    }

    public function master_menu(Request $request)
    {
        $now            = Carbon::now();
        // dd($indicator_list);
        
        return view('master.master', [
                        'now'                   => $now,
        ]);
    }

    public function dokumen_pendukung_list(Request $request)
    {
        //
    }

    public function table_dokumen(){
        // dd($data);
        $data = Dokumen::get();
        
        return view('dokumen.dokumen_table', compact('data'));
    }


}
