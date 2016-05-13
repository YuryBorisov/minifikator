<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{

    protected $fillable = [
        'session_id',
        'url',
        'url_short',
        'checked',
        'created_at'
    ];

    protected $table = 'urls';

    public $timestamps = false;

    public function add(string $sessionId, string $url, string $urlShort, $checked, $dateTime){
        /*
         if($this->isUrl($url) == null){
            $id = app('db')->table($this->table)->insertGetId([
                'session_id' => $sessionId,
                'url' => $url,
                'url_short' => $urlShort,
                'checked' => $checked,
                'created_at' => $dateTime]);
            $response['response'] = [
                'status' => 'ok',
                'url_short' => $_SERVER['SERVER_NAME'].'/'.$this->getUrlShort($id)->url_short
            ];
        }

        else $response['response'] = [
            'status' => 'info',
            'message' => 'Такой URL уже добавлен'
        ];
         */
        return ['response' => [
            'status' => 'ok',
            'url_short' => $_SERVER['SERVER_NAME'].'/'.$this->getUrlShort($id = app('db')->table($this->table)->insertGetId([
                    'session_id' => $sessionId,
                    'url' => $url,
                    'url_short' => $urlShort,
                    'checked' => $checked,
                    'created_at' => $dateTime]))->url_short
        ]];
    }

    public function isUrl(string $url){
        return $this->db()->where(['url' => $url])->first();
    }

    public function isUrlShort(string $urlShort){
        return $this->db()->where(['url_short' => $urlShort])->first();
    }

    public function getUrl(){
        return $this->db()->select('url')->get();
    }

    public function getUrlShort($id){
        return $this->db()->where(['id' => $id])->first(['url_short']);
    }

    public function getUrlsUser($sessionId){
        return $this->db()->select(['url', 'url_short', 'checked', 'created_at'])->where(['session_id' => $sessionId])->get();
    }
    
    protected function db(){
        return app('db')->table($this->table);
    }

    public function getId($urlShort){
        return $this->db()->where(['url_short' => $urlShort])->first(['id']);
    }

}
