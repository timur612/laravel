<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Item;
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/getLastPosts',function(){
   header('Access-Control-Allow-Origin:*');
    $item = App\Item::orderBy("created_at","desc")->take(2)->get();
    return $item;
});
Route::get('/found',function(){
    header('Access-Control-Allow-Origin:*');
   $found = App\Item::where('status','=','1')->get();
    return $found;
});
Route::get('/lost',function(){
    header('Access-Control-Allow-Origin:*');
   $lost = App\Item::where('status','=','0')->get();
    return $lost;
});
Route::get('/add',function(Request $req){
    header('Access-Control-Allow-Origin:*');
    App\Item::create(["status"=>1,"title"=>$req->title,"description"=>$req->descp,"contact"=>$req->contact,"done"=>0]) ;
});
Route::get('/search',function(Request $req){
     header('Access-Control-Allow-Origin:*');
       $result= App\Item::where('title','like',"%{$req->find}%")->orWhere('description','like',"%{$req->find}%")->get();
    return $result;
    
});