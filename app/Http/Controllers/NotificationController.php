<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show($id)
    {
        try {

        } catch (Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }
}
