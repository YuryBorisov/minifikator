<?php

namespace App\Http\Controllers;

use App\Models\Browser;
use App\Models\Statistics;
use App\Models\Url;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{

    public function home(Url $urlModel){
        return view('master', ['data' => $urlModel->getUrlsUser(Session::getId())]);
    }

    public function add(Request $request, Url $urlModel){
        return json_encode($urlModel->add(
            Session::getId(),
            $request->input('url'), $this->generateUrlShort($urlModel),
            $checked = $request->input('checked'),
            date('Y-m-d h:i:s'))
        );
    } 

    public function redirectUrl($address, Url $urlModel, Browser $browserModel, Statistics $statisticsModel){
        if(($data = $urlModel->isUrlShort($address)) != null){
            if($data->checked == 1){
               $date = date('d-m-Y H:i:s', strtotime("+1 hours", strtotime($data->created_at)));
               if(strtotime(date('d-m-Y H:i:s')) > strtotime($date)){
                  return view('error', ['status' => 'timeout']);
               }
            }
            (new Statistics())->add(
                $data->id,
                ($b = $browserModel->getBrowserId(get_browser(null, true)['browser'])) != null ?
                                                              $browserId = $b->id :
                                                              $browserId = $browserModel->getBrowserId('Other')->id
            );
            return redirect(preg_match('/^(http|https|ftp):/', $data->url) ? $data->url : 'http://'.$data->url);
        }
    }

    private function generateUrlShort(Url $urlModel, int $length = 5){
        do {
            $str = '';
            for ($i = 0, $characters = array_merge(range('A', 'Z'), range('a', 'z')), $max = count($characters) - 1; $i <= $length; $i++)
                 $str .= $characters[rand(0, $max)];
        }while($urlModel->isUrlShort($str) != null);
        return $str;
    }

    public function statistics($address){
        return view('statistics');
    }

    public function statisticsUrlShort(Request $urlShort, Statistics $statisticsModel, Url $urlModel, Browser $browserModel){
        $r =  $statisticsModel->getStat($urlModel->getId($urlShort->input('url'))->id);
        $arr = [];
        $arr[] = ['Task', 'Hours per Day'];
        foreach ($r as $item)
            $arr[] = [$browserModel->getBrowserName($item->browser_id)->name, $item->count];
        return json_encode($arr);
    }

}
