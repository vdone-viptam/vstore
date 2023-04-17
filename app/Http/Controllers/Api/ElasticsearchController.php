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
    public function createDocProduct($id, $name, $description, $nameCategory, $productCode)
    {
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
        try {
            $response = $this->client->search($params);
        } catch (ClientResponseException $e) {
            if ($e->getCode() == 400) {
                return ['BAD_REQUEST'];
            }
        }
        $hits = $response['hits']['hits'];
        $arrIdProduct = [];
        foreach ($hits as $hit) {
            array_push($arrIdProduct, $hit['_id']);
        }
        return $arrIdProduct;
    }

    /**
     * @throws ServerResponseException
     * @throws ClientResponseException
     * @throws MissingParameterException
     */
    public function createDocVStore($id, $name)
    {
        $params = [
            'index' => config('elasticsearch.vstore_products'),
            'id' => $id,
            'body' => [
                "name" => $name
            ],
        ];
        return $this->client->index($params);
    }

    public function updateDocVStore($id, $name)
    {
        $params = [
            'index' => 'vstore',
            'id' => $id,
            'body' => [
                'doc' => [
                    'name' => $name
                ]
            ]
        ];

        $response = $this->client->update($params);

        return $response;
    }


    public function searchDocVStore($keyword, $from = 0, $size = 10): array
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
                            "name"
                        ],
                    ],
                ]
            ],
        ];
        try {
            $response = $this->client->search($params);
        } catch (ClientResponseException $e) {
            if ($e->getCode() == 400) {
                return ['BAD_REQUEST'];
            }
        }
        $hits = $response['hits']['hits'];
        $arrIdVStore = [];
        foreach ($hits as $hit) {
            array_push($arrIdVStore, $hit['_id']);
        }
        return $arrIdVStore;
    }


    public function createDocNCC($id, $name)
    {
        $params = [
            'index' => config('elasticsearch.supplier'),
            'id' => $id,
            'body' => [
                "name" => $name
            ],
        ];
        return $this->client->index($params);
    }

    public function createDocCategory($id, $name)
    {
        $params = [
            'index' => config('elasticsearch.category'),
            'id' => $id,
            'body' => [
                "name" => $name
            ],
        ];
        return $this->client->index($params);
    }

    public function updateDocCategory($id, $name)
    {
        $params = [
            'index' => config('elasticsearch.category'),
            'id' => $id,
            'body' => [
                'doc' => [
                    'name' => $name
                ]
            ]
        ];

        $response = $this->client->update($params);

        return $response;
    }

    public function updateDocNCC($id, $name)
    {
        $params = [
            'index' => 'supplier',
            'id' => $id,
            'body' => [
                'doc' => [
                    'name' => $name
                ]
            ]
        ];

        $response = $this->client->update($params);

        return $response;
    }


    public function searchDocNCC($keyword, $from = 0, $size = 10): array
    {
        $params = [
            "index" => config('elasticsearch.supplier'),
            "body" => [
                "from" => $from,
                "size" => $size,
                "fields" => ["id"],
                "query" => [
                    "multi_match" => [
                        "query" => $keyword,
                        "fields" => [
                            "name"
                        ],
                    ],
                ]
            ],
        ];
        try {
            $response = $this->client->search($params);
        } catch (ClientResponseException $e) {
            if ($e->getCode() == 400) {
                return ['BAD_REQUEST'];
            }
        }
        $hits = $response['hits']['hits'];
        $arrIdVStore = [];
        foreach ($hits as $hit) {
            array_push($arrIdVStore, $hit['_id']);
        }
        return $arrIdVStore;
    }

    public function searchDocVShop($keyword, $from = 0, $size = 10): array
    {
        $params = [
            "index" => config('elasticsearch.vshop'),
            "body" => [
                "from" => $from,
                "size" => $size,
                "fields" => ["id"],
                "query" => [
                    "multi_match" => [
                        "query" => $keyword,
                        "fields" => [
                            "name"
                        ],
                    ],
                ]
            ],
        ];
        try {
            $response = $this->client->search($params);
        } catch (ClientResponseException $e) {
            if ($e->getCode() == 400) {
                return ['BAD_REQUEST'];
            }
        }
        $hits = $response['hits']['hits'];
        $arrIdVStore = [];
        foreach ($hits as $hit) {
            array_push($arrIdVStore, $hit['_id']);
        }
        return $arrIdVStore;
    }

    public function createDocVShop($id, $name)
    {
        $params = [
            'index' => config('elasticsearch.vshop'),
            'id' => $id,
            'body' => [
                "name" => $name
            ],
        ];
        return $this->client->index($params);
    }

    public function updateDocVShop($id, $name)
    {
        $params = [
            'index' => config('elasticsearch.vshop'),
            'id' => $id,
            'body' => [
                "name" => $name
            ],
        ];
        return $this->client->update($params);
    }

    public function searchDocCategory($keyword, $from = 0, $size = 10): array
    {
        $params = [
            "index" => config('elasticsearch.vstore_categories'),
            "body" => [
                "from" => $from,
                "size" => $size,
                "fields" => ["id"],
                "query" => [
                    "multi_match" => [
                        "query" => $keyword,
                        "fields" => [
                            "name"
                        ],
                    ],
                ]
            ],
        ];
        try {
            $response = $this->client->search($params);
        } catch (ClientResponseException $e) {
            if ($e->getCode() == 400) {
                return ['BAD_REQUEST'];
            }
        }
        $hits = $response['hits']['hits'];
        $arrIdVStore = [];
        foreach ($hits as $hit) {
            array_push($arrIdVStore, $hit['_id']);
        }
        return $arrIdVStore;
    }

}
