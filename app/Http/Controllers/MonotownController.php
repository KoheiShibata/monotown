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
            $fileName = "instagram/LILL.json";
            $brand_query = "&brand_id=58989";

            if ($request->has("condition") == true) {
                $request->session()->put("condition", $request->condition);
            }

            if ($request->has("mensBrand") == true) {
                $request->session()->put("mensBrand", $request->mensBrand);
            }

            if ($request->has("sort") == true) {
                $request->session()->put("sort", $request->sort);
            }

            if ($request->has("name") == true) {
                $request->session()->put("name", $request->name);
            }

            if ($request->session()->has("condition") == true) {
                $yahoo_url .= "&{$request->session()->get('condition')}";
            }

            if ($request->session()->has("mensBrand") == true) {
                $brand_query = "&{$request->session()->get('mensBrand')}";
            }

            if ($request->session()->has("sort") == true) {
                $sort_encode = urlencode($request->session()->get("sort"));
                $yahoo_url .= "&sort={$sort_encode}";
            }

            if ($request->session()->has("name") == true) {
                $fileName = "instagram/{$request->session()->get('name')}.json";
            }

            $yahoo_json = file_get_contents($yahoo_url . $brand_query, false, $context);
            $yahoo_datas = json_decode($yahoo_json, true);

            $instagram_json = file_get_contents($fileName, false, $context);
            $instagram_datas = json_decode($instagram_json, true);


            if (array_key_exists("Error", $yahoo_datas)) {
                throw new \Exception();
            }

            $totalResults = $yahoo_datas["totalResultsReturned"];
            $itemDatas = $this->yahooDataFormater($yahoo_datas);
            $postDatas = $this->instgramDataFormater($instagram_datas);

            return view("/main", compact("itemDatas", "totalResults", "postDatas"));
        } catch (Exception $e) {
            abort(404);
        }
    }


    /**
     * yahoo_api表示に必要なデータをフォーマット
     *
     * @param array|null $datas
     * @return array
     */
    private function yahooDataFormater($yahoo_datas): array
    {
        $items = [];
        if (empty($yahoo_datas)) {
            return [];
        }

        foreach ($yahoo_datas["hits"] as $data) {
            if (strpos($data["exImage"]["url"], "noimage") !== false) {
                continue;
            }
            $items[] = [
                "price" => "¥" . number_format($data["price"]),
                "image" => $data['exImage']['url'],
                "url" =>  $data['url'],
                "condition" => $data["condition"],
            ];
        }
        return $items;
    }

    /**
     * instagram_api表示に必要なデータをフォーマット
     *
     * @param [type] $instagram_datas
     * @return array
     */
    private function instgramDataFormater($instagram_datas): array
    {
        $post_datas = [];
        if (empty($instagram_datas)) {
            return [];
        }

        foreach ($instagram_datas["business_discovery"]["media"]["data"] as $data) {
            if ($data["media_type"] !== "VIDEO") {
                $post_datas[] = [
                    "image" => $data["media_url"],
                    "page_url" => $data["permalink"]
                ];
            }

            if (count($post_datas) == 8) {
                break;
            }
        }
        return $post_datas;
    }
}
