<?php

namespace App\Datasources;

use \GuzzleHttp\Client;

class Datasource
{
    const DATASOURCE_ID = 'abstract';
    const API_URL       = 'abstract';

    protected $connection;

    public function __construct()
    {
        $this->connection = new Client(['base_uri' => static::API_URL]);
    }

    public function getContent($url, $method = 'get', $data = [])
    {
        $contents = null;

        try {
            $response = $this->connection->request($method, $url, $data);
            $stream = $response->getBody();

            if ($stream->getSize()) {
                $contents = json_decode($stream->getContents());
            }
        } catch (\GuzzleException $e) {
            \Log::error($e);
        } catch (\Exception $e) {
            \Log::error($e);
        }

        return $contents;
    }
}
