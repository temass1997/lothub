<?php

namespace App\Services;

use App\Services\Datasources\AttomService;
use Illuminate\Http\Request;

class SearchService
{
    public function searchZip(Request $request)
    {
        $zip = $request->q;
        $pageSize = $request->pageSize ?? null;
        $limit = $request->limit ?? null;

        $attomService = new AttomService();
        $response = $attomService->searchZip($zip, $pageSize, $limit);

        $filteredResults = $this->filterMultipleLots($response);

        return $filteredResults;
    }

    public function filterMultipleLots($response)
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