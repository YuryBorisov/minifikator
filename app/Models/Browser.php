<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Browser extends Model
{

    protected $fillable = ['name'];

    public $timestamps = false;

    protected $table = 'browsers';

    public function getBrowserName($browserId){
        return $this->db()->where(['id' => $browserId])->first(['name']);
    }

    public function getBrowserId($browserName){
        return $this->db()->where(['name' => $browserName])->first(['id']);
    }

    public function getAllBrowser(){
        return $this->db()->get();
    }

    public function getAllBrowserName(){
        return $this->db()->select('name')->get();
    }

    public function getAllBrowserId(){
        return $this->db()->select('id')->get();
    }

    protected function db(){
        return app('db')->table($this->table);
    }

}
