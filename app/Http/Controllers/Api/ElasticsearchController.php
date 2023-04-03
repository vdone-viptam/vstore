<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Illuminate\Http\Request;
use Elastic\Elasticsearch\ClientBuilder;
class ElasticsearchController extends Controller
{

    /**
     * @throws AuthenticationException
     */
    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts([config('elasticsearch.node')])
            ->build();
    }

    /**
     * @throws ServerResponseException
     * @throws ClientResponseException
     * @throws MissingParameterException
     */
    public function createDocProduct($id, $name, $description, $nameCategory, $productCode) {
        $params = [
            'index' => config('elasticsearch.vstore_products'),
            'id' => $id,
            'body' => [
                "name" => $name,
                "description" => $description,
                "category" => $nameCategory,
                "product_code" => $productCode,
                "id" => $id,
            ],
        ];
        return $this->client->index($params);
    }

    public function searchDocProduct($keyword, $from = 0, $size = 10): array
    {
        $params = [
            "index" => config('elasticsearch.vstore_products'),
            "body" => [
                "from" => $from,
                "size" => $size,
                "fields" => ["id"],
                "query" => [
                    "multi_match" => [
                        "query" => $keyword,
                        "fields" => [
                            "name",
                            "description",
                            "category",
                            "product_code",
                        ],
                    ],
                ]
            ],
        ];
        $response = $this->client->search($params);
        $hits = $response['hits']['hits'];
        $arrIdProduct = [];
        foreach ($hits as $hit) {
            array_push($arrIdProduct, $hit['_id']);
        }
        return $arrIdProduct;
    }

}
