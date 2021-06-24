<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController
{
    public SearchService $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Return search page
     * 
     * @param Request $request
     * 
     * @return View
     */
    public function index(Request $request)
    {
        return view('search.index');
    }

    /**
     * Search multiple lots by zip
     * 
     * @param SearchRequest $request
     * 
     * @return Json
     */
    public function searchZip(SearchRequest $request)
    {
        $zip = $request->q;
        $pageSize = $request->pageSize ?? null;
        $limit = $request->limit ?? null;

        $response = $this->searchService->searchZip($zip, $pageSize, $limit);

        return response()->json($response);
    }
}