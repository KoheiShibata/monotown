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
            // $ig_json = file_get_contents(INSTAGRAM_API_URL.CLEL_QUERY.ACCESS_TOKEN, false, $context);


            // file_put_contents("instagram/CLEL.json", print_r($ig_json, true), LOCK_EX);
            // exit;
            // $instagram_datas = json_decode($instagram_json, true);
            $fileName = "instagram/remer.json";

            if ($request->has("condition") == true) {
                $request->session()->put("condition", $request->condition);
            }

            if ($request->has("mensBrand") == true) {
                $request->session()->put("mensBrand", $request->mensBrand);
            }

            if ($request->has("sort") == true) {
                $request->session()->put("sort", $request->sort);
            }

            if ($request->session()->has("condition") == true) {
                $yahoo_url .= "&{$request->session()->get('condition')}";
            }

            if ($request->session()->has("mensBrand") == true) {
                $yahoo_url .= "&{$request->session()->get('mensBrand')}";
            }

            if ($request->session()->has("sort") == true) {
                $sort_encode = urlencode($request->session()->get("sort"));
                $yahoo_url .= "&sort={$sort_encode}";
            }

            $yahoo_json = file_get_contents($yahoo_url, false, $context);
            $yahoo_datas = json_decode($yahoo_json, true);


            if (array_key_exists("Error", $yahoo_datas)) {
                throw new \Exception();
            }

            $totalResults = $yahoo_datas["totalResultsReturned"];
            $itemDatas = $this->dataformater($yahoo_datas);

            $instagram_json = file_get_contents($fileName, false, $context);
            $instagram_datas = json_decode($instagram_json, true);
            // print_r($instagram_datas);
            // exit;
            $hashtagDatas = $this->instgramDataFormater($instagram_datas);
            // print_r($hashtagDatas);
            // exit;

            return view("/main", compact("itemDatas", "totalResults", "hashtagDatas"));
        } catch (Exception $e) {
            echo $e;
            exit;
            abort(404);
        }
    }


    /**
     * viewに必要なデータを抽出する
     *
     * @param array|null $datas
     * @return array
     */
    private function dataformater($yahoo_datas): array
    {
        $items = [];
        if (empty($yahoo_datas)) {
            return [];
        }

        foreach ($yahoo_datas["hits"] as $data) {
            $items[] = [
                "price" => "¥" . number_format($data["price"]),
                "image" => $data['exImage']['url'],
                "url" =>  $data['url'],
                "condition" => $data["condition"],
                "sale_price" => $data['priceLabel']['discountedPrice'],
            ];
        }
        return $items;
    }


    private function instgramDataFormater($instagram_datas)
    {
        $image_datas = [];
        if (empty($instagram_datas)) {
            return [];
        }

        foreach ($instagram_datas["business_discovery"]["media"]["data"] as $data) {
            if ($data["media_type"] !== "VIDEO") {
                $image_datas[] = [
                    "image" => $data["media_url"],
                    "page_url" => $data["permalink"]
                ];
            }

            if(count($image_datas) == 8) {
                break;
            }
        }
        return $image_datas;
    }
}
