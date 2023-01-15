<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

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
            $json = file_get_contents("https://shopping.yahooapis.jp/ShoppingWebService/V3/itemSearch?appid=dj00aiZpPXRJb0R5MUJzRVRSMyZzPWNvbnN1bWVyc2VjcmV0Jng9MDk-&brand_id=58989&genre_category_id=13457&image_size=300&results=100&in_stock=true", false, $context);
            $datas = json_decode($json, true);
            
            if (array_key_exists("Error", $datas)) {
                throw new \Exception();
            }
            
            $totalResults = $datas["totalResultsReturned"];
            $itemDatas = $this->dataformater($datas);

            return view("/main", compact("itemDatas", "totalResults"));
            
        } catch (Exception $e) {
            abort(404);
        }
    }


    /**
     * viewに必要なデータを抽出する
     *
     * @param array|null $datas
     * @return array
     */
    private function dataformater($datas): array
    {
        $items = [];
        if (empty($datas)) {
            return [];
        }

        foreach($datas["hits"] as $data) {
            $items[] = [
                "price" => "¥".number_format($data["price"]),
                "image" => $data['exImage']['url'],
                "url" =>  $data['url'],
                "condition" => $data["condition"],
            ];  
        }
        return $items;
    }
}
