<?php

namespace App\Http\Controllers;

use App\Models\Master_PTKAK;
use App\Models\Master_FilePTKAK;
use App\Models\Main_Log;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Session;
use PDF;

class PTKAKController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function ptkak_list(Request $request)
    {
        /*$value = $request->cookie('ORG_ID');
    
        $indicator_list = array();*/
        $org_id = Auth::user()->ORG_ID;
        $access = Auth::user()->ACCESS;
        $iduser = Auth::user()->ID;

        $dbutama = \DB::table('tm_organization_structure as a')
        ->Join('tm_directorate as b', 'a.DIRECTORATE_ID', '=' , 'b.DIRECTORATE_ID')
        ->select('a.DIVISION_ID','a.BRANCH_OFFICE_ID','b.IS_CABANG')
        ->where('a.ORGANIZATION_STRUCTURE_ID', '=' , Auth::user()->ORG_ID)
        ->first();

        if($dbutama->IS_CABANG == "0"){

            $organize_struct = \DB::table('tm_organization_structure as a')
            ->Join('tm_sub_division  as b', 'a.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
            ->select('b.SUB_DIVISION_NAME','b.SUB_DIVISION_ID','a.ORGANIZATION_STRUCTURE_ID')
            ->where('a.DIVISION_ID', '=' , $dbutama->DIVISION_ID);

        }
        elseif ($dbutama->IS_CABANG == "1") {

           $organize_struct = \DB::table('tm_organization_structure as a')
           ->Join('tm_sub_division  as b', 'a.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
           ->select('b.SUB_DIVISION_NAME','b.SUB_DIVISION_ID','a.ORGANIZATION_STRUCTURE_ID')
           ->where('a.BRANCH_OFFICE_ID', '=' , $dbutama->BRANCH_OFFICE_ID);

       }

       $organize_struct_list = $organize_struct->get();

        // $oganisasi = \DB::table('tm_organization_structure as o')
        //             ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
        //             ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
        //             ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
        //             ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
        //             ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME')->get();
        // $organize_struct_list = $oganisasi->toArray();

        $oganisasi1 = \DB::table('tm_organization_structure as o')
                    ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
                    ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
                    ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
                    ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME')
                    ->where('o.ORGANIZATION_STRUCTURE_ID', $org_id)
                    ->get();
        $organize_struct_list1 = $oganisasi1->toArray();

            

        //dd($organize_struct_list1);
        /*$divisi = \DB::table('tm_organization_structure as a')
        ->leftJoin('users as b' , 'a.ORGANIZATION_STRUCTURE_ID' , '=' , 'b.ORG_ID')
        ->where('ORGANIZATION_STRUCTURE_ID', $org_id)
        ->where('b.ID', $iduser)
        ->first();

        //dd($divisi);

        $subdivisi = $divisi->SUB_DIVISION_ID;*/

        if($access == 'VP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || $access == 'DVP PENGENDALIAN KINERJA DAN JAMINAN MUTU' || $access == 'ADMIN PENGENDALIAN KINERJA DAN JAMINAN MUTU')
        {
            $items = \DB::table('tx_ptkak as a')
            ->leftJoin('tm_sub_division as b', 'a.PROPOSER_AUDITOR', '=' , 'b.Sub_Division_ID')
            ->leftJoin('tm_sub_division as c', 'a.TO_AUDITAN', '=' , 'c.Sub_Division_ID')
            ->select('a.*','b.SUB_DIVISION_NAME as F_SUB_DIVISION_NAME','c.SUB_DIVISION_NAME as T_SUB_DIVISION_NAME')
            ->where('IS_DELETED', '0')
            ->Where('CREATED_ORG_ID', $org_id)
            ->orWhere('a.VERIFIED_STATUS_1', '1')
            //->orWhere('a.TO_AUDITAN', $org_id)
            ->orderBy('a.created_at','DESC');
            $ptkak_list = $items->get();
            $now            = Carbon::now();
            
            return view('ptkak.tabel_ptkak', [
                'now'                   => $now,
                'ptkak_list'        => $ptkak_list,
                'org_id'         => $org_id,
                'organize_struct_list' => $organize_struct_list
            ]);    
        }
        else
        {
             $items = \DB::table('tx_ptkak as a')
            ->leftJoin('tm_sub_division as b', 'a.PROPOSER_AUDITOR', '=' , 'b.Sub_Division_ID')
            ->leftJoin('tm_sub_division as c', 'a.TO_AUDITAN', '=' , 'c.Sub_Division_ID')
            ->select('a.*','b.SUB_DIVISION_NAME as F_SUB_DIVISION_NAME','c.SUB_DIVISION_NAME as T_SUB_DIVISION_NAME')
            ->where('IS_DELETED', '0')
            ->where('CREATED_ORG_ID', $org_id)
            //->orWhere('a.TO_AUDITAN', $org_id)
            ->orderBy('a.created_at','DESC');
            $ptkak_list = $items->get();
        // dd($ptkak_list);
            $now            = Carbon::now();
            
            return view('ptkak.tabel_ptkak', [
                'now'                   => $now,
                'ptkak_list'        => $ptkak_list,
                'org_id'         => $org_id,
                'organize_struct_list' => $organize_struct_list
            ]);    
        }
        
    }
    
    public function form_ptkak(Request $request)
    {   
        $items = \DB::table('tm_source')
        ->where('ACTIVE', 'Y');
        $source = $items->get();

        $subdiv = \DB::table('tm_sub_division')
        ->where('ACTIVE', 'Y');
        $getsubdiv = $subdiv->get();
        
        $now            = Carbon::now();
        return view('ptkak.form',[
            'now'                   => $now,
            'source_list'        => $source,
            'subdiv'            => $getsubdiv
        ]);
    }

    public function save_mst_ptkak(Request $request)
    {

        $org_id = Auth::user()->ORG_ID;

        $divisi = \DB::table('tm_organization_structure as a')
        ->leftJoin('users as b' , 'a.ORGANIZATION_STRUCTURE_ID' , '=' , 'b.ORG_ID')
        ->where('ORGANIZATION_STRUCTURE_ID', $org_id)
        ->first();

        $subdivisi = $divisi->SUB_DIVISION_ID;
        $bukti    = $request->bukti;

        if($bukti != '' || $bukti != null)
        {
           date_default_timezone_set('Asia/Jakarta');
           $no    = '-';
           $rvsi    = $request->revisi;
           $tgl    = date("Y-m-d",strtotime($request->tanggal));
           $wktu = date('H:i:s');
           $tglfix = $tgl.' '.$wktu;
           $hlmn    = $request->halaman;
           $noptkak    = $request->noptkak;
           $noptkakrpl = str_replace('/', '_', $noptkak);
           $jns    = $request->jenis;
           $sbr    = $request->sumber;
           $pgslauditor    = $request->pengusulauditor;
           $dtjk    = $request->ditujuakan;
           $urn    = $request->uraian;
           $lk    = $request->lokasi;
           $type_file    = $request->file('bukti')->getClientOriginalExtension();
           $size_file    = $request->file('bukti')->getSize();
           $path         = base_path().'/public/ptkak/';
           $folder       = $path.$noptkakrpl.'/'; 
           $dokumen      = $folder.'bukti/';
           $file         = $noptkakrpl.'_'.date('Ymd_his').'.'.$type_file;
           $file_location    = 'ptkak/'.$noptkakrpl.'/bukti/'.$file;
           $name_file    = $file;

           if(!file_exists($folder)){
              if(mkdir($folder, 0777,true)){
                chmod($folder, 0777);
            }  
            } 
            if(!file_exists($dokumen)){
                if(mkdir($dokumen, 0777,true)){
                    chmod($dokumen, 0777);
                }   
            } 
            $pathfix = $dokumen;
            $request->file('bukti')->move($pathfix, $file);
            $rfnsi    = $request->referensi;
            $tdkn    = $request->tindakan;
            $pyb    = $request->penyebab;
            $tdknkorek    = $request->tindakankorek;
            $pyb1    = $request->penyebab1;
            $iduser = Auth::user()->ID;


            $datautama = new Master_PTKAK;
            $datautama->NOMOR = $no;
            $datautama->SOURCE_ID = $sbr;
            $datautama->PTKAK_DATE = $tglfix;
            $datautama->NO_PTKAK = $noptkak;
            $datautama->LOCATION = $lk;
            $datautama->PTKAK_REFERENCES = $rfnsi;
            $datautama->FIRST_ACT = $tdkn;
            $datautama->CAUSE = $pyb;
            $datautama->ACT = $tdknkorek;
            $datautama->PREVENTIVE = $pyb1;
            // $datautama->VERIFIED_BY_1 = '1';
            // $datautama->VERIFIED_STATUS_1 = '1';
            // $datautama->VERIFIED_BY_2 = '1';
            // $datautama->VERIFIED_STATUS_2 = '1';
            $datautama->REVISION = $rvsi;
            $datautama->PAGE = $hlmn;
            $datautama->TYPE = $jns;
            $datautama->PROPOSER_AUDITOR = $pgslauditor;
            $datautama->TO_AUDITAN = $dtjk;
            $datautama->DESCRIPTION = $urn;
            $datautama->CREATED_BY = $iduser;
            $datautama->CREATED_SUB_DIV = $subdivisi;
            $datautama->CREATED_ORG_ID = $org_id;
            $datautama->save();

            $idutama = \DB::getPdo()->lastInsertId();

            if($idutama != '')
            {
                $datafile = new Master_FilePTKAK;
                $datafile->PTKAK_ID = $idutama;
                $datafile->FILE_NAME = $name_file;
                $datafile->FILE_LOCATION = $file_location;
                $datafile->FILE_TYPE = $type_file;
                $datafile->save();
            }

            $modul = "PTKAK";

            (new Main_Log)->setLog("Save Data PTKAK",json_encode($datautama),$modul,Auth::user()->ID);

            return redirect('/ptkaklist');
        }
        else
        {
            date_default_timezone_set('Asia/Jakarta');
            $no    = '-';
            $rvsi    = $request->revisi;
            $tgl    = date("Y-m-d",strtotime($request->tanggal));
            $wktu = date('H:i:s');
            $tglfix = $tgl.' '.$wktu;
            $hlmn    = $request->halaman;
            $noptkak    = $request->noptkak;
            $noptkakrpl = str_replace('/', '_', $noptkak);
            $jns    = $request->jenis;
            $sbr    = $request->sumber;
            $pgslauditor    = $request->pengusulauditor;
            $dtjk    = $request->ditujuakan;
            $urn    = $request->uraian;
            $lk    = $request->lokasi;
            $rfnsi    = $request->referensi;
            $tdkn    = $request->tindakan;
            $pyb    = $request->penyebab;
            $tdknkorek    = $request->tindakankorek;
            $pyb1    = $request->penyebab1;
            $iduser = Auth::user()->ID;


            $datautama = new Master_PTKAK;
            $datautama->NOMOR = $no;
            $datautama->SOURCE_ID = $sbr;
            $datautama->PTKAK_DATE = $tglfix;
            $datautama->NO_PTKAK = $noptkak;
            $datautama->LOCATION = $lk;
            $datautama->PTKAK_REFERENCES = $rfnsi;
            $datautama->FIRST_ACT = $tdkn;
            $datautama->CAUSE = $pyb;
            $datautama->ACT = $tdknkorek;
            $datautama->PREVENTIVE = $pyb1;
            // $datautama->VERIFIED_BY_1 = '1';
            // $datautama->VERIFIED_STATUS_1 = '1';
            // $datautama->VERIFIED_BY_2 = '1';
            // $datautama->VERIFIED_STATUS_2 = '1';
            $datautama->REVISION = $rvsi;
            $datautama->PAGE = $hlmn;
            $datautama->TYPE = $jns;
            $datautama->PROPOSER_AUDITOR = $pgslauditor;
            $datautama->TO_AUDITAN = $dtjk;
            $datautama->DESCRIPTION = $urn;
            $datautama->CREATED_BY = $iduser;
            $datautama->CREATED_SUB_DIV = $subdivisi;
            $datautama->CREATED_ORG_ID = $org_id;
            $datautama->save();

            $modul = "PTKAK";

            (new Main_Log)->setLog("Save Data PTKAK",json_encode($datautama),$modul,Auth::user()->ID);

            return redirect('/ptkaklist');
        }
       
}

public function form_edit_ptkak(Request $request)
{
    $items = \DB::table('tm_source')
    ->where('ACTIVE', 'Y');
    $source = $items->get();

    $subdiv = \DB::table('tm_sub_division')
    ->where('ACTIVE', 'Y');
    $getsubdiv = $subdiv->get();

    $itemselects = \DB::table('tx_ptkak as a')
        ->leftJoin('tx_ptkak_file as b', 'a.PTKAK_ID', '=' , 'b.PTKAK_ID')
        ->where('a.PTKAK_ID', $request->id)->first();
    //dd($itemselects->NOMOR);
    $id = $request->id;
    //$no = $itemselects->NOMOR;
    $sbr = $itemselects->SOURCE_ID;
    $ptkakdt = $itemselects->PTKAK_DATE;
    $noptkak = $itemselects->NO_PTKAK;
    $lk = $itemselects->LOCATION;
    $ptkakref = $itemselects->PTKAK_REFERENCES;
    $firstact = $itemselects->FIRST_ACT;
    $cause = $itemselects->CAUSE;
    $act = $itemselects->ACT;
    $preven = $itemselects->PREVENTIVE;
    $rev = $itemselects->REVISION;
    $page = $itemselects->PAGE;
    $type = $itemselects->TYPE;
    $auditor = $itemselects->PROPOSER_AUDITOR;
    $auditan = $itemselects->TO_AUDITAN;
    $uraian = $itemselects->DESCRIPTION;
    $file = $itemselects->FILE_LOCATION;
    $filename = $itemselects->FILE_NAME;
    $isdeletefile = $itemselects->IS_DELETED;
    $now            = Carbon::now();

    return view('ptkak.formedit', [
        'source_list'                   => $source,
        'subdiv'                   => $getsubdiv,
        'now'                   => $now,
        'id'                => $id,
        'sbr'                => $sbr,
        'ptkakdate'     => $ptkakdt,
        'noptkak'          => $noptkak,
        'loc'     => $lk,
        'ptkakref'          => $ptkakref,
        'firstact'          => $firstact,
        'cause'          => $cause,
        'act'  => $act,
        'preven'  => $preven,
        'revision'  => $rev,
        'page'  => $page,
        'type'  => $type,
        'auditor'  => $auditor,
        'auditan'  => $auditan,
        'uraian'  => $uraian,
        'getfile' => $file,
        'getfilename' => $filename,
        'isdeleted' => $isdeletefile
    ]);
}



public function saveedit_ptkak(Request $request)
{
       
        $cekfile = $request->bukti;

        if($cekfile == '' || $cekfile == null)
        {
            date_default_timezone_set('Asia/Jakarta');
         
            $rvsi    = $request->revisi;
            $tgl    = date("Y-m-d",strtotime($request->tanggal));
            $wktu = date('H:i:s');
            $tglfix = $tgl.' '.$wktu;
            $hlmn    = $request->halaman;
            $noptkak    = $request->noptkak;
            $noptkakrpl = str_replace('/', '_', $noptkak);
            $jns    = $request->jenis;
            $sbr    = $request->sumber;
            $pgslauditor    = $request->pengusulauditor;
            $dtjk    = $request->ditujuakan;
            $urn    = $request->uraian;
            $lk    = $request->lokasi;

            $rfnsi    = $request->referensi;
            $tdkn    = $request->tindakan;
            $pyb    = $request->penyebab;
            $tdknkorek    = $request->tindakankorek;
            $pyb1    = $request->penyebab1;
            $iduser = Auth::user()->ID;


            $datautama = Master_PTKAK::where('PTKAK_ID',$request->id)->first();
            $datautama->SOURCE_ID = $sbr;
            $datautama->PTKAK_DATE = $tglfix;
            $datautama->NO_PTKAK = $noptkak;
            $datautama->LOCATION = $lk;
            $datautama->PTKAK_REFERENCES = $rfnsi;
            $datautama->FIRST_ACT = $tdkn;
            $datautama->CAUSE = $pyb;
            $datautama->ACT = $tdknkorek;
            $datautama->PREVENTIVE = $pyb1;
            $datautama->REVISION = $rvsi;
            $datautama->PAGE = $hlmn;
            $datautama->TYPE = $jns;
            $datautama->PROPOSER_AUDITOR = $pgslauditor;
            $datautama->TO_AUDITAN = $dtjk;
            $datautama->DESCRIPTION = $urn;
            $datautama->CREATED_BY = $iduser;
            $datautama->update();

            $modul = "PTKAK";

            (new Main_Log)->setLog("Update Data PTKAK",json_encode($datautama),$modul,Auth::user()->ID);

            return redirect('/ptkaklist');
        }
        else
        {
            $itemselects = \DB::table('tx_ptkak_file')
             ->where('PTKAK_ID', $request->id)->first();

            if($itemselects->IS_DELETED == '0')
            {
                date_default_timezone_set('Asia/Jakarta');

                $rvsi    = $request->revisi;
                $tgl    = date("Y-m-d",strtotime($request->tanggal));
                $wktu = date('H:i:s');
                $tglfix = $tgl.' '.$wktu;
                $hlmn    = $request->halaman;
                $noptkak    = $request->noptkak;
                $noptkakrpl = str_replace('/', '_', $noptkak);
                $jns    = $request->jenis;
                $sbr    = $request->sumber;
                $pgslauditor    = $request->pengusulauditor;
                $dtjk    = $request->ditujuakan;
                $urn    = $request->uraian;
                $lk    = $request->lokasi;

                $rfnsi    = $request->referensi;
                $tdkn    = $request->tindakan;
                $pyb    = $request->penyebab;
                $tdknkorek    = $request->tindakankorek;
                $pyb1    = $request->penyebab1;
                $iduser = Auth::user()->ID;


                $datautama = Master_PTKAK::where('PTKAK_ID',$request->id)->first();
                $datautama->SOURCE_ID = $sbr;
                $datautama->PTKAK_DATE = $tglfix;
                $datautama->NO_PTKAK = $noptkak;
                $datautama->LOCATION = $lk;
                $datautama->PTKAK_REFERENCES = $rfnsi;
                $datautama->FIRST_ACT = $tdkn;
                $datautama->CAUSE = $pyb;
                $datautama->ACT = $tdknkorek;
                $datautama->PREVENTIVE = $pyb1;
                $datautama->REVISION = $rvsi;
                $datautama->PAGE = $hlmn;
                $datautama->TYPE = $jns;
                $datautama->PROPOSER_AUDITOR = $pgslauditor;
                $datautama->TO_AUDITAN = $dtjk;
                $datautama->DESCRIPTION = $urn;
                $datautama->CREATED_BY = $iduser;
                $datautama->update();

                $modul = "PTKAK";

                (new Main_Log)->setLog("Update Data PTKAK",json_encode($datautama),$modul,Auth::user()->ID);

                return redirect('/ptkaklist');
            }
            else
            {

                date_default_timezone_set('Asia/Jakarta');
                $no    = $request->no;
                $rvsi    = $request->revisi;
                $tgl    = date("Y-m-d",strtotime($request->tanggal));
                $wktu = date('H:i:s');
                $tglfix = $tgl.' '.$wktu;
                $hlmn    = $request->halaman;
                $noptkak    = $request->noptkak;
                $noptkakrpl = str_replace('/', '_', $noptkak);
                $jns    = $request->jenis;
                $sbr    = $request->sumber;
                $pgslauditor    = $request->pengusulauditor;
                $dtjk    = $request->ditujuakan;
                $urn    = $request->uraian;
                $lk    = $request->lokasi;
                $type_file    = $request->file('bukti')->getClientOriginalExtension();
                $size_file    = $request->file('bukti')->getSize();
                $path         = base_path().'/public/ptkak/';
                $folder       = $path.$noptkakrpl.'/'; 
                $dokumen      = $folder.'bukti/';
                $file         = $noptkakrpl.'_'.date('Ymd_his').'.'.$type_file;
                $file_location    = 'ptkak/'.$noptkakrpl.'/bukti/'.$file;
                $name_file    = $file;

                if(!file_exists($folder)){
                  if(mkdir($folder, 0777,true)){
                    chmod($folder, 0777);
                }  
                } 
                if(!file_exists($dokumen)){
                    if(mkdir($dokumen, 0777,true)){
                        chmod($dokumen, 0777);
                    }   
                } 
                $pathfix = $dokumen;
                $request->file('bukti')->move($pathfix, $file);
                $rfnsi    = $request->referensi;
                $tdkn    = $request->tindakan;
                $pyb    = $request->penyebab;
                $tdknkorek    = $request->tindakankorek;
                $pyb1    = $request->penyebab1;
                $iduser = Auth::user()->ID;


                $datautama = Master_PTKAK::where('PTKAK_ID',$request->id)->first();
                $datautama->NOMOR = $no;
                $datautama->SOURCE_ID = $sbr;
                $datautama->PTKAK_DATE = $tglfix;
                $datautama->NO_PTKAK = $noptkak;
                $datautama->LOCATION = $lk;
                $datautama->PTKAK_REFERENCES = $rfnsi;
                $datautama->FIRST_ACT = $tdkn;
                $datautama->CAUSE = $pyb;
                $datautama->ACT = $tdknkorek;
                $datautama->PREVENTIVE = $pyb1;
                $datautama->REVISION = $rvsi;
                $datautama->PAGE = $hlmn;
                $datautama->TYPE = $jns;
                $datautama->PROPOSER_AUDITOR = $pgslauditor;
                $datautama->TO_AUDITAN = $dtjk;
                $datautama->DESCRIPTION = $urn;
                $datautama->CREATED_BY = $iduser;
                $datautama->save();

                if($datautama->save())
                {
                    $datafile = Master_FilePTKAK::where('PTKAK_ID',$request->id)->first();
                    $datafile->FILE_NAME = $name_file;
                    $datafile->FILE_LOCATION = $file_location;
                    $datafile->FILE_TYPE = $type_file;
                    $datafile->IS_DELETED = '0';
                    $datafile->save();
                }

                $modul = "PTKAK";

                (new Main_Log)->setLog("Update Data PTKAK",json_encode($datautama),$modul,Auth::user()->ID);

                return redirect('/ptkaklist');
            }
        }
}

public function delete_file(Request $request)
{
    $data = Master_FilePTKAK::where('PTKAK_ID',$request->id)->update([
        'IS_DELETED' => '1']);

    return $data;
}


public function close_ptkak(Request $request)
{
    $items = \DB::table('tm_source')
    ->where('ACTIVE', 'Y');
    $source = $items->get();

    $subdiv = \DB::table('tm_sub_division')
    ->where('ACTIVE', 'Y');
    $getsubdiv = $subdiv->get();

    $itemselects = \DB::table('tx_ptkak as a')
        ->leftJoin('tx_ptkak_file as b', 'a.PTKAK_ID', '=' , 'b.PTKAK_ID')
        ->where('a.PTKAK_ID', $request->id)->first();
    //dd($itemselects->NOMOR);
    $id = $request->id;
    $no = $itemselects->NOMOR;
    $sbr = $itemselects->SOURCE_ID;
    $ptkakdt = $itemselects->PTKAK_DATE;
    $noptkak = $itemselects->NO_PTKAK;
    $lk = $itemselects->LOCATION;
    $ptkakref = $itemselects->PTKAK_REFERENCES;
    $firstact = $itemselects->FIRST_ACT;
    $cause = $itemselects->CAUSE;
    $act = $itemselects->ACT;
    $preven = $itemselects->PREVENTIVE;
    $rev = $itemselects->REVISION;
    $page = $itemselects->PAGE;
    $type = $itemselects->TYPE;
    $auditor = $itemselects->PROPOSER_AUDITOR;
    $auditan = $itemselects->TO_AUDITAN;
    $uraian = $itemselects->DESCRIPTION;
    $file = $itemselects->FILE_LOCATION;
    $filename = $itemselects->FILE_NAME;
    $isdeletefile = $itemselects->IS_DELETED;
    $ver1 = $itemselects->VERIFIED_STATUS_1;
    $ver2 = $itemselects->VERIFIED_STATUS_2;
    $now            = Carbon::now();

    return view('ptkak.formclose', [
        'source_list'                   => $source,
        'subdiv'                   => $getsubdiv,
        'now'                   => $now,
        'id'                => $id,
        'no'                => $no,
        'sbr'                => $sbr,
        'ptkakdate'     => $ptkakdt,
        'noptkak'          => $noptkak,
        'loc'     => $lk,
        'ptkakref'          => $ptkakref,
        'firstact'          => $firstact,
        'cause'          => $cause,
        'act'  => $act,
        'preven'  => $preven,
        'revision'  => $rev,
        'page'  => $page,
        'type'  => $type,
        'auditor'  => $auditor,
        'auditan'  => $auditan,
        'uraian'  => $uraian,
        'getfile' => $file,
        'getfilename' => $filename,
        'isdeleted' => $isdeletefile,
        'ver1'      => $ver1,
        'ver2'      => $ver2
    ]);
}

public function closemutu_ptkak(Request $request)
{
    $items = \DB::table('tm_source')
    ->where('ACTIVE', 'Y');
    $source = $items->get();

    $subdiv = \DB::table('tm_sub_division')
    ->where('ACTIVE', 'Y');
    $getsubdiv = $subdiv->get();

    $itemselects = \DB::table('tx_ptkak as a')
        ->leftJoin('tx_ptkak_file as b', 'a.PTKAK_ID', '=' , 'b.PTKAK_ID')
        ->where('a.PTKAK_ID', $request->id)->first();
    //dd($itemselects->NOMOR);
    $id = $request->id;
    $no = $itemselects->NOMOR;
    $sbr = $itemselects->SOURCE_ID;
    $ptkakdt = $itemselects->PTKAK_DATE;
    $noptkak = $itemselects->NO_PTKAK;
    $lk = $itemselects->LOCATION;
    $ptkakref = $itemselects->PTKAK_REFERENCES;
    $firstact = $itemselects->FIRST_ACT;
    $cause = $itemselects->CAUSE;
    $act = $itemselects->ACT;
    $preven = $itemselects->PREVENTIVE;
    $rev = $itemselects->REVISION;
    $page = $itemselects->PAGE;
    $type = $itemselects->TYPE;
    $auditor = $itemselects->PROPOSER_AUDITOR;
    $auditan = $itemselects->TO_AUDITAN;
    $uraian = $itemselects->DESCRIPTION;
    $file = $itemselects->FILE_LOCATION;
    $filename = $itemselects->FILE_NAME;
    $isdeletefile = $itemselects->IS_DELETED;
    $ver1 = $itemselects->VERIFIED_STATUS_1;
    $ver2 = $itemselects->VERIFIED_STATUS_2;
    $now            = Carbon::now();

    return view('ptkak.formclosemutu', [
        'source_list'                   => $source,
        'subdiv'                   => $getsubdiv,
        'now'                   => $now,
        'id'                => $id,
        'no'                => $no,
        'sbr'                => $sbr,
        'ptkakdate'     => $ptkakdt,
        'noptkak'          => $noptkak,
        'loc'     => $lk,
        'ptkakref'          => $ptkakref,
        'firstact'          => $firstact,
        'cause'          => $cause,
        'act'  => $act,
        'preven'  => $preven,
        'revision'  => $rev,
        'page'  => $page,
        'type'  => $type,
        'auditor'  => $auditor,
        'auditan'  => $auditan,
        'uraian'  => $uraian,
        'getfile' => $file,
        'getfilename' => $filename,
        'isdeleted' => $isdeletefile,
        'ver1'      => $ver1,
        'ver2'      => $ver2
    ]);
}

public function form_preview_ptkak(Request $request)
{
    $items = \DB::table('tm_source')
    ->where('ACTIVE', 'Y');
    $source = $items->get();

    $subdiv = \DB::table('tm_sub_division')
    ->where('ACTIVE', 'Y');
    $getsubdiv = $subdiv->get();

    $itemselects = \DB::table('tx_ptkak as a')
        ->leftJoin('tx_ptkak_file as b', 'a.PTKAK_ID', '=' , 'b.PTKAK_ID')
        ->where('a.PTKAK_ID', $request->id)->first();
    //dd($itemselects->NOMOR);
    $id = $request->id;
    $no = $itemselects->NOMOR;
    $sbr = $itemselects->SOURCE_ID;
    $ptkakdt = $itemselects->PTKAK_DATE;
    $noptkak = $itemselects->NO_PTKAK;
    $lk = $itemselects->LOCATION;
    $ptkakref = $itemselects->PTKAK_REFERENCES;
    $firstact = $itemselects->FIRST_ACT;
    $cause = $itemselects->CAUSE;
    $act = $itemselects->ACT;
    $preven = $itemselects->PREVENTIVE;
    $rev = $itemselects->REVISION;
    $page = $itemselects->PAGE;
    $type = $itemselects->TYPE;
    $auditor = $itemselects->PROPOSER_AUDITOR;
    $auditan = $itemselects->TO_AUDITAN;
    $uraian = $itemselects->DESCRIPTION;
    $file = $itemselects->FILE_LOCATION;
    $filename = $itemselects->FILE_NAME;
    $isdeletefile = $itemselects->IS_DELETED;
    $ver1 = $itemselects->VERIFIED_STATUS_1;
    $ver2 = $itemselects->VERIFIED_STATUS_2;
    $now            = Carbon::now();

    return view('ptkak.formpreview', [
        'source_list'                   => $source,
        'subdiv'                   => $getsubdiv,
        'now'                   => $now,
        'id'                => $id,
        'no'                => $no,
        'sbr'                => $sbr,
        'ptkakdate'     => $ptkakdt,
        'noptkak'          => $noptkak,
        'loc'     => $lk,
        'ptkakref'          => $ptkakref,
        'firstact'          => $firstact,
        'cause'          => $cause,
        'act'  => $act,
        'preven'  => $preven,
        'revision'  => $rev,
        'page'  => $page,
        'type'  => $type,
        'auditor'  => $auditor,
        'auditan'  => $auditan,
        'uraian'  => $uraian,
        'getfile' => $file,
        'getfilename' => $filename,
        'isdeleted' => $isdeletefile,
        'ver1'      => $ver1,
        'ver2'      => $ver2
    ]);
}

public function saveedit_close(Request $request)
{


    date_default_timezone_set('Asia/Jakarta');
    $status    = $request->status;
    $iduser = Auth::user()->ID;


    $datautama = Master_PTKAK::where('PTKAK_ID',$request->id)->first();
    $datautama->VERIFIED_STATUS_1 = $status;
    $datautama->VERIFIED_BY_1 = $iduser;
    $datautama->VERIFIED_STATUS_2 = $status;
    $datautama->VERIFIED_BY_2 = $iduser;
    $datautama->update();

    $modul = "PTKAK";

    (new Main_Log)->setLog("Update Closed Data PTKAK",json_encode($datautama),$modul,Auth::user()->ID);

    return redirect('/ptkaklist');
}

public function saveedit_closemutu(Request $request)
{


    date_default_timezone_set('Asia/Jakarta');
    $status    = $request->status;
    $iduser = Auth::user()->ID;


    $datautama = Master_PTKAK::where('PTKAK_ID',$request->id)->first();
    $datautama->VERIFIED_STATUS_1 = $status;
    $datautama->VERIFIED_BY_1 = $iduser;
    $datautama->VERIFIED_STATUS_2 = $status;
    $datautama->VERIFIED_BY_2 = $iduser;
    $datautama->update();

    $modul = "PTKAK";

    (new Main_Log)->setLog("Update Closed Data PTKAK",json_encode($datautama),$modul,Auth::user()->ID);
    
    return redirect('/ptkaklist');
}


public function delete_ptkak(Request $request)
{
    
    Master_PTKAK::where('PTKAK_ID',$request->id)->update([
        'IS_DELETED' => '1']);

    return redirect('/ptkaklist');
}

 public function filter_ptkak($org_id)
    {
        // $oganisasi = \DB::table('tm_organization_structure as o')
        //             ->leftJoin('tm_directorate as dr', 'dr.DIRECTORATE_ID', '=' , 'o.DIRECTORATE_ID')
        //             ->leftJoin('tm_sub_division as sd', 'sd.SUB_DIVISION_ID', '=' , 'o.SUB_DIVISION_ID')
        //             ->leftJoin('tm_division as d', 'd.DIVISION_ID', '=' , 'o.DIVISION_ID')
        //             ->leftJoin('tm_branch_office as c', 'c.BRANCH_OFFICE_ID', '=' , 'o.BRANCH_OFFICE_ID')
        //             ->select('o.ORGANIZATION_STRUCTURE_ID as ORGANIZATION_STRUCTURE_ID', 'dr.DIRECTORATE_NAME as DIRECTORATE_NAME', 'c.BRANCH_OFFICE_NAME as BRANCH_OFFICE_NAME', 'd.DIVISION_NAME as DIVISION_NAME', 'sd.SUB_DIVISION_NAME as SUB_DIVISION_NAME')->get();
        // $organize_struct_list = $oganisasi->toArray();

       $dbutama = \DB::table('tm_organization_structure as a')
       ->Join('tm_directorate as b', 'a.DIRECTORATE_ID', '=' , 'b.DIRECTORATE_ID')
       ->select('a.DIVISION_ID','a.BRANCH_OFFICE_ID','b.IS_CABANG')
       ->where('a.ORGANIZATION_STRUCTURE_ID', '=' , Auth::user()->ORG_ID)
       ->first();

        // dd($dbutama);

        if($dbutama->IS_CABANG == "0"){

            $organize_struct = \DB::table('tm_organization_structure as a')
            ->Join('tm_sub_division  as b', 'a.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
            ->select('b.SUB_DIVISION_NAME','b.SUB_DIVISION_ID','a.ORGANIZATION_STRUCTURE_ID')
            ->where('a.DIVISION_ID', '=' , $dbutama->DIVISION_ID);

        }
        elseif ($dbutama->IS_CABANG == "1") {

           $organize_struct = \DB::table('tm_organization_structure as a')
           ->Join('tm_sub_division  as b', 'a.SUB_DIVISION_ID', '=' , 'b.SUB_DIVISION_ID')
           ->select('b.SUB_DIVISION_NAME','b.SUB_DIVISION_ID','a.ORGANIZATION_STRUCTURE_ID')
           ->where('a.BRANCH_OFFICE_ID', '=' , $dbutama->BRANCH_OFFICE_ID);

       }

       $organize_struct_list = $organize_struct->get();

     
        $items = \DB::table('tx_ptkak as a')
        ->leftJoin('tm_sub_division as b', 'a.PROPOSER_AUDITOR', '=' , 'b.Sub_Division_ID')
        ->leftJoin('tm_sub_division as c', 'a.TO_AUDITAN', '=' , 'c.Sub_Division_ID')
        ->select('a.*','b.SUB_DIVISION_NAME as F_SUB_DIVISION_NAME','c.SUB_DIVISION_NAME as T_SUB_DIVISION_NAME')
        ->where('IS_DELETED', '0')
        ->where('CREATED_ORG_ID', $org_id);
        $ptkak_list = $items->get();

        $now            = Carbon::now();
        return view('ptkak.tabel_ptkak', [
            'now'                   => $now,
            'ptkak_list'        => $ptkak_list,
            'org_id'         => $org_id,
            'organize_struct_list' => $organize_struct_list
        ]);

        
    }

    public function print_report_ptkak($id)
    {         

        $items = \DB::table('tx_ptkak as a')
            ->leftJoin('tm_sub_division as b', 'a.PROPOSER_AUDITOR', '=' , 'b.Sub_Division_ID')
            ->leftJoin('tm_sub_division as c', 'a.TO_AUDITAN', '=' , 'c.Sub_Division_ID')
            ->leftJoin('users as d', 'a.VERIFIED_BY_1', '=' , 'd.ID')
            ->leftJoin('users as e', 'a.VERIFIED_BY_2', '=' , 'd.ID')
            ->select('a.*','b.SUB_DIVISION_NAME as F_SUB_DIVISION_NAME','c.SUB_DIVISION_NAME as T_SUB_DIVISION_NAME','d.NAMA as NAMA_VERIFIED_BY_1','e.NAMA as NAMA_VERIFIED_BY_2')
            ->where('IS_DELETED', '0')
            ->where('a.PTKAK_ID', $id)->first();

        $data = compact('items');

        $filename = "Report PTKAK.pdf";
        $pdf = PDF::setOptions(['isRemoteEnabled' => true])->loadView('ptkak.pdf_report_ptkak',$data)
        ->setPaper('a4','landscape')
        ->download();
        return $pdf;    
    }

}
