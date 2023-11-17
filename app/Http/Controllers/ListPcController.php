<?php
namespace App\Http\Controllers;

use App\Models\FreeIp;
use App\Models\ListPc;
use App\Models\MisDoc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class ListPcController extends Controller
{
    public function pcpanel(){
        return view("pc");
    }

    public function makepclist(Request $request)
    {
        $invnum=$request->get('inpnum');
        $ip=$request->get('inpip');
        $krp=$request->get('krp');
        if(!empty($invnum)){
            $res=ListPc::where('inv',$invnum)->get();
	    $cin=$res->count();
            return view("pctable",['tab'=>$res, 'cin'=>$cin]);
        }

        if(!empty($ip)){
            $res=ListPc::where('ip',$ip)->get();
	    $cin=$res->count();
            return view("pctable",['tab'=>$res, 'cin'=>$cin]);
        }

        if(!empty($krp)){
            $res=ListPc::where('korp',$krp)->orderBy('etaj')->orderBy('pom')->get();
	    $cin=$res->count();
            if($krp=='all') {$res=ListPc::all();$cin=$res->count();}
            return view("pctable",['tab'=>$res, 'cin'=>$cin]);
        }

    }

    public function ffip(){

      //  $list36=FreeIp::with(['findfreeip'])->whereNull('listPc.ip')->where('freeIp.ip', 'like', '10.174.36.%')->get();
        $list36=FreeIp::query()->select('free_ips.*')->
        leftJoin('list_pcs', function ($join) {
            $join->on('free_ips.ip', '=', 'list_pcs.ip');
        })->whereNull('list_pcs.ip')->where('free_ips.ip', 'like', '10.174.36.%')->get();

        $list37=FreeIp::query()->select('free_ips.*')->
        leftJoin('list_pcs', function ($join) {
            $join->on('free_ips.ip', '=', 'list_pcs.ip');
        })->whereNull('list_pcs.ip')->where('free_ips.ip', 'like', '10.174.37.%')->get();

        $list38=FreeIp::query()->select('free_ips.*')->
        leftJoin('list_pcs', function ($join) {
            $join->on('free_ips.ip', '=', 'list_pcs.ip');
        })->whereNull('list_pcs.ip')->where('free_ips.ip', 'like', '10.174.38.%')->get();

        $list39=FreeIp::query()->select('free_ips.*')->
        leftJoin('list_pcs', function ($join) {
            $join->on('free_ips.ip', '=', 'list_pcs.ip');
        })->whereNull('list_pcs.ip')->where('free_ips.ip', 'like', '10.174.39.%')->get();

        return view('listfreeip',['tab36'=>$list36,'tab37'=>$list37,'tab38'=>$list38,'tab39'=>$list39]);
    }

    public function addfio(Request $req){
        $id = $req->get('id');
        $fio = $req->get('fio');
        $model=ListPc::find($id);
        $model->doctor=$fio;
        $model->save();
    }

}



