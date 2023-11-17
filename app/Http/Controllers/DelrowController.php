<?php


namespace App\Http\Controllers;


use App\Models\MisDoc;
use Illuminate\Http\Request;
class DelrowController extends Controller
{
    public function deldata(Request $req){
       $id = $req->get('id');
       $del = new MisDoc();
       $del::find($id)->delete();

    }
}
