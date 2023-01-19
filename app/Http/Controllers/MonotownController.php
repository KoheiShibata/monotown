<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use SebastianBergmann\Type\FalseType;

use function PHPUnit\Framework\isEmpty;

class MonotownController extends Controller
{
    //

    public function monotown(Request $request)
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

            $yahoo_url = YAHOO_API;
            $json = file_get_contents($yahoo_url."&brand_id=58989", false, $context);
            $datas = json_decode($json, true);
            
            if($request->has("condition") == true) {
                $request->session()->put("condition", $request->condition);
                // echo $request->session()->get("condition");
                // exit;
            }

            if($request->has("mensBrand") == true) {
                $request->session()->put("mensBrand", $request->mensBrand);
            }

            if($request->has("sort") == true) {
                
            }

            if($request->session()->has("condition") == true) {
                $yahoo_url .= "&{$request->session()->get('condition')}";
            }

            if($request->session()->has("mensBrand") == true) {
                $yahoo_url .= "&{$request->session()->get('mensBrand')}";
            }
            // echo $yahoo_url;
            // exit;

            $json = file_get_contents($yahoo_url, false, $context);
            $datas = json_decode($json, true);


         
            
            // if($request->has("condition") == true) {
            //     $json = file_get_contents(YAHOO_API."&{$request->condition}", false, $context);
            //     $datas = json_decode($json, true);
            // }
            
            // if($request->has("mensBrand") == true) {
            //     $json = file_get_contents(YAHOO_API."&{$request->mensBrand}", false, $context);
            //     $datas = json_decode($json, true);
            // }
            
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
