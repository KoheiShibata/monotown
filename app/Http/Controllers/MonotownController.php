<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class MonotownController extends Controller
{
    //

    public function monotownshop()
    {
        try {
            $context = stream_context_create(
                [
                    "http" =>
                    [
                        "ignore_errors" => true
                    ]
                ]
            );
            
            $json = file_get_contents("https://shopping.yahooapis.jp/ShoppingWebService/V3/itemSearch?appid=dj00aiZpPXRJb0R5MUJzRVRSMyZzPWNvbnN1bWVyc2VjcmV0Jng9MDk-&brand_id=58989&genre_category_id=13457&results=100", false, $context);
            $datas = json_decode($json, true);

            if (empty($datas)) {
                throw new \Exception();
            }
            return view("/main", compact("datas"));
        } catch (Exception $e) {
            abort(404);
        }
    }
}
