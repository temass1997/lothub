<?php

namespace App\Services;

use App\Services\Datasources\AttomService;
use Illuminate\Http\Request;

class SearchService
{
    /**
     * Search By Zip code in attom
     *
     * @param Strign $zip
     * @param Strign $pageSize
     * @param Strign $limit
     *
     * @return Json
     */
    public function searchZip($zip, $pageSize = null, $limit = null)
    {
        $attomService = new AttomService();
        $response = $attomService->searchZip($zip, $pageSize, $limit);

        $filteredResults = $this->processMultipleLots($response);

        return $filteredResults;
    }
    
    /**
     * Process property array and return only multiple lots
     *
     * @param array $response
     *
     * @return array
     */
    public function processMultipleLots($response)
    {
        $multipleLots = [];
        if ($response && $response['property']) {
            foreach ($response['property'] as $id => $obj) {
                $propertyType = $obj->summary->propsubtype ?? '';

                if (stripos($propertyType, 'residential') !== false) {
                    if (isset($obj->summary->legal1) && $this->checkIsThisLotIsMultiple($obj->summary->legal1)) {
                        $multipleLots[] = $obj;
                    }
                }
            }

            $response['status']->countElements = count($response['property']);
            $response['property'] = $multipleLots;
        }

        return $response;
    }

    /**
     * Check this slot multiple or not
     *
     * @param String $lot
     *
     * @return bool
     */
    public function checkIsThisLotIsMultiple($lot)
    {
        if (substr_count(strtolower($lot), 'lot') > 1) {
            return true;
        }

        if (stripos($lot, '&') !== false) {
            return true;
        }

        if (stripos($lot, '-') !== false) {
            return true;
        }

        if (stripos($lot, ',') !== false) {
            return true;
        }

        return false;
    }
}