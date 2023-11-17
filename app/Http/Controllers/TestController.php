<?php
namespace App\Http\Controllers;

use App\Models\Otdel;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller {

public function test(){
$res=Otdel::orderBy("otd_name")->get();
return view('testviews', ['data'=>$res]);
}

    public function add_otd(Request $res){
        $newotd = $res->otd_name;
        $model=new Otdel;
        $model->otd_name=$newotd;
        $model->save();
    }

    public function add_phone(Request $phdata){
	$id = $phdata->id;
	$idotd = $phdata->idotd;
	$sitynum = $phdata->sitynum;
	$locnum = $phdata->locnum;
	$location = $phdata->location;
	$model=new Phone();
	if($id){
	$model=Phone::find($id);
	}
	$model->idotd=$idotd;
	$model->location=$location;
	$model->loc_num=$locnum;
	$model->sity_num=$sitynum;
	$model->save();
       
}
   public function find_phones(Request $req)
    {
            $id=$req->id;
            $res=Phone::where('idotd',$id)->get();
            return view("listphone",['spisok'=>$res]);
    }

public function modalphone(Request $req)
    {
        $id=$req->id;
	$model=new Phone();
        if($id){
        $model=Phone::find($id);
        }
         return view("modal",["num_data"=>$model]);
        
    }


}