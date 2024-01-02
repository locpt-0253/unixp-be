<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        try {
            $tags = Tag::all();

            return response()->json($tags, 200);
        } catch (Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }

    public function top(Request $request)
    {
        try {
            $tags = Tag::limit(20)
                ->get()
                ->sortByDesc('count')
                ->values();

            return response()->json($tags, 200);
        } catch (Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }
}
