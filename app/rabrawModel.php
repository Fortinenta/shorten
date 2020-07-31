<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class rabrawModel extends Model
{
    public function search($option,$key,$divisi){
        $query = DB::select("SELECT * FROM tb_short_url WHERE divisi = '$divisi' AND $option LIKE '%$key%'");
        return $query;
    }

    public function get_list($divisi,$start,$list){
        $query = DB::select("SELECT * FROM tb_short_url WHERE divisi = '$divisi' LIMIT $start,$list ");
        return $query;
    }

    public function get_paging($divisi,$list){
        $query = DB::select("SELECT ceil(COUNT(short)/$list) AS num FROM `tb_short_url` WHERE divisi ='$divisi'");
        return $query;
    }

    //funsi delete
    public function delete_link($short) {
      DB::table('tb_short_url')->where('short', $short)->delete();
    }

    public function go_link($short){
        $query = DB::table('tb_short_url')->select('url_asli')->where('short', $short)->first();
        if ($query == null) {
        return false;
        }else {
          return $query;
        }
    }

    //check and get short
    public function get_short($short){
        $query = DB::table('tb_short_url')->select('short')->where('short', $short)->first();
        if ($query == null ) {
            return false;
        }else {
            return $query;
        }
    }
    //tambah short
    public function tambah_url($url,$short,$divisi){
        $data = array(
            'url_asli'=>$url,
            'short'=>$short,
            'divisi'=>$divisi
            );
        DB::table('tb_short_url')->insert($data
        );
    }
}
