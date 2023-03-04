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
            if ($_SERVER['REQUEST_URI'] === "/") {
                session()->forget(config(FILTER_KEY));
            }
            $yahoo_url = YAHOO_API;
            $fileName = "instagram/yu.json";
            $brand_query = "&brand_id=58989";

            $filter = $request->only(config(FILTER_KEY));
            $formated_filter = $this->filtering($filter);
            if (!empty($formated_filter)) {
                foreach ($formated_filter as $key => $filter) {
                    session()->put($key, $filter);
                }
            }

            if (session()->has("condition")) {
                $yahoo_url .= "&" . session()->get('condition');
            }
            if (session()->has("brand")) {
                $brand_query = "&" . session()->get('brand');
            }
            if (session()->has("sort")) {
                $sort_encode = urlencode(session()->get("sort"));
                $yahoo_url .= "&sort={$sort_encode}";
            }
            if (session()->has("name")) {
                $fileName = "instagram/" . session()->get('name') . ".json";
            }

            $yahoo_json = file_get_contents($yahoo_url . $brand_query, false, $context);
            if (property_exists($yahoo_json, "Error")) {
                throw new \Exception();
            }
            $yahoo_data = json_decode($yahoo_json, true);
            $instagram_json = file_get_contents($fileName, false, $context);
            $instagram_data = json_decode($instagram_json, true);

            $totalResults = $yahoo_data["totalResultsReturned"];
            $itemData = $this->yahooDataFormater($yahoo_data);
            $postData = $this->instgramDataFormater($instagram_data);

            return view("/main", compact("itemData", "totalResults", "postData"));
        } catch (Exception $e) {
            // echo $e;
            abort(404);
        }
    }


    /**
     * yahoo_api表示に必要なデータをフォーマット
     *
     * @param array|null $data
     * @return array
     */
    private function yahooDataFormater($yahoo_data): array
    {
        $items = [];
        if (empty($yahoo_data)) {
            return [];
        }

        foreach ($yahoo_data["hits"] as $key => $data) {
            if (strpos($data["exImage"]["url"], "noimage") !== false) {
                continue;
            }
            $items[] = [
                "price" => "¥" . number_format($data["price"]),
                "image" => $data['exImage']['url'],
                "url" =>  $data['url'],
                "condition" => $data["condition"],
                "visibility" => "visible",
            ];
            if (count($items) > MAX) {
                $items[$key]["visibility"] = "hidden";
            }
        }
        return $items;
    }

    /**
     * instagram_api表示に必要なデータをフォーマット
     *
     * @param [type] $instagram_data
     * @return array
     */
    private function instgramDataFormater($instagram_data): array
    {
        $post_data = [];
        if (empty($instagram_data)) {
            return [];
        }

        foreach ($instagram_data["business_discovery"]["media"]["data"] as $data) {
            if ($data["media_type"] !== "VIDEO") {
                $post_data[] = [
                    "image" => $data["media_url"],
                    "page_url" => $data["permalink"]
                ];
            }

            if (count($post_data) == 9) {
                break;
            }
        }
        return $post_data;
    }

    /**
     * filterが正しい値か判別
     *
     * @param [type] $filter
     * @return array
     */
    private function filtering($filter): array
    {
        if (empty($filter)) {
            return [];
        }

        foreach ($filter as $key => $value) {
            $absolute = FILTER;
            if (!in_array($value, array_keys(config($absolute . $key)), true)) {
                unset($filter[$key]);
                continue;
            }
        }

        return $filter;
    }
}
