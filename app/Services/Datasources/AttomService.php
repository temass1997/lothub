<?php

namespace App\Services\Datasources;

use App\Datasources\Attom;

class AttomService
{
    const PAGE_SIZE = 10000;
    const LIMIT = 10000;

    /**
     * Search By zip code in attom
     * 
     * @param integer $zip
     * @param integer $pageSize
     * @param integer $limit
     * 
     * @return array
     */
    public function searchZip($zip, $pageSize = self::PAGE_SIZE, $limit = self::LIMIT)
    {
        $data = [
            'postalcode' => $zip,
            'pagesize' => $pageSize,
            'page' => 1,
        ];

        return $this->searchWithPaginate($data, $pageSize, $limit);
    }

    /**
     * Search By zip code in attom with paginate
     * 
     * @param integer $zip
     * @param integer $pageSize
     * @param integer $limit
     * 
     * @return array
     */
    public function searchWithPaginate($data, $pageSize, $limit)
    {
        $attom = new Attom();
        $response = $attom->detail($data);

        if ($response) {
            $response = collect($response);
            $limit = $limit <= $response['status']->total ? $limit : $response['status']->total;

            while ($limit > $data['page'] * $pageSize)
            {
                $data['page']++;
                $pageResponse = $attom->detail($data);

                if (!$pageResponse) {
                    break;
                }

                $pageResponse = collect($pageResponse);
                $response['property'] = array_merge($response['property'], $pageResponse['property']);
            }

            if (count($response['property']) > $limit) {
                $response['property'] = array_slice($response['property'], 0, $limit);
            }

            $response = $response->toArray();
        }

        return $response;
    }
}