<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wi_File;

class WiController extends Controller
{
    public function add_post(Request $request){
        $idheader = $request->id;
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'sop';
        // $file->move($tujuan_upload, $nama_file);
        
        $simpan = new Wi_File();
        $simpan->FILE_NAME = $nama_file;
        $simpan->FILE_LOCATION = $tujuan_upload;
        $simpan->FILE_TYPE = $ext;
        $simpan->HEADER_SOP_ID = $idheader;
        $simpan->save();

        return redirect('sop_list');
    }

    public function upload_wi($id)
    {
        $id = $id;
        return view('sop.wi_upload', compact('id'));
    }

    public function wi($id){
        $data = Wi_File::get()->where('HEADER_SOP_ID', $id);
        //dd($data);
        if ($data != null ){
           $data = Wi_File::get()->where('HEADER_SOP_ID', $id);
           $id = $id;
           $tes = 2;
           return view('sop.wi', compact('data','id','tes'));
        }
        else
        {
           $id = $id;
           $tes = 1;
           return view('sop.wi', compact('id','tes'));
        }
    }
}


