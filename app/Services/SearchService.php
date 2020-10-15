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
        if ($response && $response['property']) {
            $countMultiple = 0;
            foreach ($response['property'] as $id => $obj) {
                if (isset($obj->summary->legal1) && $this->checkIsThisLotIsMultiple($obj->summary->legal1)) {
                    $response['property'][$id]->multiple = true;
                    $countMultiple++;
                } else {
                    $response['property'][$id]->multiple = false;
                }
            }
            $response['status']->countMultiple = $countMultiple;
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