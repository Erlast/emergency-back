<?php
namespace App\Http\Controllers;

use App\Models\TechMove;
use Illuminate\Http\Request;

class TechMoveController extends Controller
{
    public function techmove()
    {
        return view('techmove');
    }

    public function techtable(Request $req)
    {
      $type = $req->get('type');
      $inn = $req->get('inv');
      $target = $req->get('target');

     // TechMove::query()->insert(['type'=>$type,'invnum'=>$inn,'target'=>$target]);
        $model = new TechMove();
        $model->type=$type;
        $model->invnum=$inn;
        $model->target=$target;
        $model->save();

    }

    public function allwork(Request $req)
    {
        $type = $req->get('type');
        $inn = $req->get('inv');

        if(!$inn && $type=='all'){
           $result = TechMove::all();
            return view('tabmove', ['table'=>$result]);
        }

        if($inn && $type=='all'){
            $result = TechMove::where('invnum', $inn)->get();
            return view('tabmove', ['table'=>$result]);
        }

        if($inn && $type){
            $result = TechMove::where(['invnum'=>$inn, 'type'=>$type])->get();
            return view('tabmove', ['table'=>$result]);
        }

        if(!$inn && $type){
            $result = TechMove::where('type', $type)->get();
            return view('tabmove', ['table'=>$result]);
        }


    }

}
