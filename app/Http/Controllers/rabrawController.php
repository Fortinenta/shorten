<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rabrawModel;

class rabrawController extends Controller
{
    public function __construct(){
        session(['paging' => 5]);
        session(['divisi' => "PIT"]);
    }
    public function index(){
        session(['paging' => 5]);
        session(['divisi' => "PIT"]);
        return $this->show(1);

    }

    //checked
    public function show($halaman){
        $paging = session('paging');
        $divisi = session('divisi');
        $model = new rabrawModel();
        $list = $model->get_list($divisi,/*start*/(($halaman-1)*$paging),/*limit*/$paging);
		    $count =$model->get_paging($divisi,$paging);
        // dd($count);
		    return view('home',['posts' => $list],['page' => $count]);
    }


    //checked
    public function paging($page){
      session(['paging' => $page]);
      return $this->show(1);
    }


    //checked
    public function search(Request $request){
      $option = $request->option;
      $key = $request->key;
      $model = new rabrawModel();
      $list = $model->search($option,$key,session('divisi'));
      if (!$list) {
        return redirect()->back() ->with('alert', 'You not lucky today, dont comeback');
    	}else{
        $paging = session('paging');
        $divisi = session('divisi');
        $count =$model->get_paging($divisi,$paging);
    		return view('home',['posts' => $list],['page' =>$count]);
    	}
    }

    //checked
    public function tambah_url(Request $request){
      $short = $request->short;
      $url = $request->url;
      $model = new rabrawModel();
      $chek_short = $model->go_link($short);
      if ($chek_short) {
        return redirect()->back()->with('alert', 'Sorry Son this Short is alredy taken!');
      }else {
        $list = $model->tambah_url($url,$short,session('divisi'));
        session(['alert' => 'Succsessfully Add short Son, Good Job']);
        return $this->show(1);
      }
    }

    //checked
    public function delete_link($short){
      $model = new rabrawModel();
      $url = $model->delete_link($short);
      return redirect()->back() ->with('alert', 'Succsessfully Delete that short Son, Good Job');
    }

    //checked
    public function short($link){
      $model = new rabrawModel();
      $url = $model->go_link($link);
  		if (!$url) {
  			return abort(404);
  		}else {
  			return redirect($url->url_asli);
  		}
    }
}
