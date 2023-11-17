<?php


namespace App\Http\Controllers;


use App\Models\MisDoc;
use Illuminate\Support\Facades\DB;


class ContMisController extends Controller
{
 public function makedata($id){
    // Storage::disk('public')->put('ok/example.txt', 'dsadsadsadsa');
       // $res = MisDoc::all();

          $res = MisDoc::where('razdel',$id)->orderBy('created_at','desc')->get();
          if($id=='video' || $id == 'telemed'){
              return view('video', ['docs' => $res, 'id'=>$id]);
          }else {
              return view('page', ['docs' => $res, 'id'=>$id]);
          }
  }
}
