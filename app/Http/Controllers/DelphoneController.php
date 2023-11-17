<?php


namespace App\Http\Controllers;


use App\Models\Phone;
use Illuminate\Http\Request;
class DelphoneController extends Controller
{
    public function delphone(Request $req){
       $id = $req->get('id');
       $del = new Phone();
       $del::find($id)->delete();

    }
}
