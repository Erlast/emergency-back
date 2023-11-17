<?php


namespace App\Http\Controllers;
use App\Models\Otdel;
use App\Models\Cartrige;
use App\Models\Printmodel;
use App\Models\ListTech;
use App\Models\Model;
use Illuminate\Http\Request;

class OrgtechController extends Controller
{
    public function orgpanel(){
      $res=Otdel::orderBy("otd_name")->get();
      return view('orgtech',['data'=>$res, 'idotd'=>"techotd"]);
    }

    public function addorgModal(Request $req){
	$id = $req->id;
	if ($id){

	}else{
	$listOtdels=Otdel::orderBy("otd_name")->get();
	$listModels = Printmodel::orderBy("name")->get();
	$listCart = Cartrige::orderBy("name")->get();
	return view('edittech',['listOtdels'=>$listOtdels,'listModels'=>$listModels,'listCart'=>$listCart,'id'=>'0', 'idotd'=>"selectotdel"]);
	}
    }

    public function cart_list(){
    $cartList = Cartrige::orderBy("name")->get();

    return view('listcart',['listCart'=>$cartList,'type'=>'cart']);
    }

    public function add_cartrige(Request $cartdata){
        $name = $cartdata->name;
	$add_type = $cartdata->addtype;
	if($add_type == 'cart'){
	    $cartModel = new Cartrige();
	}else{
	    $cartModel = new Printmodel();
	}
	$cartModel->name = $name;
        $cartModel->save();
    }

    public function model_list(){
	$printModels = Printmodel::orderBy("name")->get();
	return view('listcart',['listCart'=>$printModels,'type'=>'print']);
    }

    public function editTech(Request $req){
	$id = $req->id;
	$otdel = $req->otd;
	$model = $req->model;
	$cart = $req->cart;
	$drum = $req->drum;
	$inv = $req->inv;
	$ip = $req->ip;
	$target = $req->target;
	$in_repair = $req->in_repair;
	if($id){
	    $orgModel = ListTech::find($id);
    	    $orgModel->inv_num = $inv;
	    $orgModel->otdel_id = $otdel;
	    $orgModel->ip = $ip;
	    $orgModel->mesto = $target;
	    $orgModel->in_repair = $in_repair;
            $orgModel->drum = $drum;
	    $orgModel->save();
	}else{
	$orgModel = new ListTech();
	$orgModel->inv_num = $inv;
	$orgModel->otdel_id = $otdel;
	$orgModel->printmodel_id = $model;
	$orgModel->cartrige_id = $cart;
	$orgModel->ip = $ip;
	$orgModel->drum = $drum;
	$orgModel->mesto = $target;
	$orgModel->save();
	}
    }

    public function showtech(Request $req){
	$id = $req->id;
	if ($id){
	$listOrg = Otdel::with(['searchOrg.printName'])->find($id)->searchOrg;
	return view('techtable',['tab'=>$listOrg]);
	}else{
	    $listOrg = Otdel::with(['searchOrg.printName'])->get();
	    return view('alltechtable',['tab'=>$listOrg, 'idotd'=>'techotd']);
	    
	}	
    }


    public function delOrg(Request $req){
       $id = $req->get('id');
       $del = new ListTech();
       $del::find($id)->delete();

    }

    public function showDetail(Request $req){
       $id = $req->get('id');
       $cart = ListTech::find($id)->searchDetalisation;
	$detail = ListTech::find($id);
       return view('detail',['cart'=>$cart,'tab'=>$detail]);
    }

    public function editDisloc(Request $req){
       $id = $req->get('id');
	$listOtdels=Otdel::orderBy("otd_name")->get();
	$detail = ListTech::find($id);
       return view('orgdislocation',['listOtdels'=>$listOtdels,'detail'=>$detail]);
    }

    public function findTech(Request $req){
	$inv = $req->inv;
	$ip = $req->ip;
      if ($inv){
	$listOrg = ListTech::where('inv_num', $inv)->get();
	$tech = ListTech::with('otdName')->where('inv_num', $inv)->firstOrFail();
	$printname = ListTech::with('printName')->where('inv_num', $inv)->firstOrFail();
	$print = $printname->printName->name;
	$name = $tech->otdName->otd_name;
	return view('findtable',['tab'=>$listOrg, 'name'=>$name, 'print'=>$print]);
      }

      if ($ip){
	$listOrg = ListTech::where('ip', $ip)->get();
	$tech = ListTech::with('otdName')->where('ip', $ip)->firstOrFail();
	$name = $tech->otdName->otd_name;
	$printname = ListTech::with('printName')->where('ip', $ip)->firstOrFail();
	$print = $printname->printName->name;
	return view('findtable',['tab'=>$listOrg, 'name'=>$name, 'print'=>$print]);
      }

	
    }

    public function showRepair(){
	$listOrg = ListTech::with(['printName','otdName'])->where('in_repair', '1')->get();
	
	if(empty($listOrg)) {
	    return 0;
	}else{
	    return view('repairtable',['tab'=>$listOrg]);
	}

    }

}
