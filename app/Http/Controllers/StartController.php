<?php


namespace App\Http\Controllers;


use App\Models\News;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;


class StartController extends Controller
{
 
public function mainpage(){
	$rss = News::orderBy('id', 'desc')->cursorPaginate(10);
//	$rss = $collect->map(function($item){return ['id'=>$item->id, 'news_title'=>$item->news_title, 'news_body'=>$item->news_body, 'created_at'=>Carbon::parse($item->created_at)->format('d.m.Y')];});
	return view('idx',['rss' => $rss]);

  }

public function add_news(Request $req){
    
    $new_news = new News();
    $new_news->news_title = $req->newtit;
    $new_news->news_body = $req->newbody;
    $new_news->save();
}

public function delnews(Request $req){
   $id = $req->get('id');
   $del = new News();
   $del::find($id)->delete();

}


}
