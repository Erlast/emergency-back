<?php


namespace App\Http\Controllers;
use GuzzleHttp\Promise\RejectionException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class OkController extends Controller
{
    public function showOkFiles(Request $request){
        $id=$request->get('id');
        $folderdir=array();
        $folderfile=array();

        $dirs=Storage::disk('public')->directories($id);
        $files=Storage::disk('public')->files($id);

        foreach ($dirs as $dir){
            $d=pathinfo($dir);
            $folderdir[]=$d['basename'];
        }
        foreach ($files as $fil){
            $f=pathinfo($fil);
            $folderfile[]=$f['filename'].'.'.$f['extension'];
        }

        return view('ok',['path'=>$id,'fdirs'=>$folderdir,'ffiles'=>$folderfile]);
    }

}
/*
            echo '<pre>';
            print_r($dir);
            echo '</pre>';

        echo $id;
        die('ok');
 */
