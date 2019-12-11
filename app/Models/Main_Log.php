<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Main_Log extends Model
{
    public function setLog($information="",$objek,$modul,$user)
    {
    	$arrayLog = array('LOG_ID' =>\DB::table('tm_tbl_log')->max('LOG_ID')+1,
    						'INFORMATION'=>$information,
    						'OBJEK'=>$objek,
    						'MODUL'=>$modul,
    						'USER_ID'=>$user);
    	\DB::table('tm_tbl_log')
    				->insert($arrayLog);
    }
}
