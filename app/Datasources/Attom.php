<?php

namespace App\Datasources;

class Attom extends Datasource
{
    const API_PROPERTY_URL = 'https://api.gateway.attomdata.com/propertyapi/v1.0.0/property/';

    const ADDRESS_ENDPOINT = 'address';
    const DETAIL_ENDPOINT = 'detail';

    private function request($endpoint, $payload, $method = 'get')
    {
        $url = self::API_PROPERTY_URL . $endpoint;

        $apiKey = env('ATTOM_API_KEY') ?? '';

        $data = [
            'query' => $payload,
        ];

        $data['headers']['apikey'] = $apiKey;
        $data['headers']['accept'] = 'application/json';

        return $this->getContent($url, $method, $data);
    }


    /**
     * Make request to sql search
     *
     * @param array $data
     *
     * @return array
     */
    public function address($data)
    {
        $response = $this->request(self::ADDRESS_ENDPOINT,  $data);

        return $response;
    }

    /**
     * Make request to sql search
     *
     * @param array $data
     *
     * @return Object
     */
    public function detail($data)
    {
        $response = $this->request(self::DETAIL_ENDPOINT,  $data);

        return $response;
    }
}