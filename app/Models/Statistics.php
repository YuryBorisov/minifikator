<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Statistics extends Model
{

    protected $fillable = ['url_id', 'browser_id'];

    public $timestamps = false;

    protected $table = 'statistics';

    public function add(int $urlId, int $browserId){
        return app('db')->table($this->table)->insert([
            'url_id' => $urlId,
            'browser_id' => $browserId
        ]);
    }

    public function getStat($urlId){
        return app('db')->table($this->table)->select('browser_id', DB::raw('count(url_id) as count'))->where(['url_id' => $urlId])->groupBy('browser_id')->get();
    }

}
