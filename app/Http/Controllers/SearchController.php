<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController
{
    public function index(Request $request)
    {
        return view('search');
    }

    public function searchZip(SearchRequest $request)
    {
        $searchService = new SearchService();
        $response = $searchService->searchZip($request);

        return response()->json($response);
    }
}