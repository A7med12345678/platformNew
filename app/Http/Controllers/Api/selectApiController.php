<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\select;

class selectApiController extends Controller
{
    public function indexAdmin()
    {
        $weekIds = [1, 2, 3];
        $data = [];

        foreach ($weekIds as $weekId) {
            $data["currentWeek{$weekId}"] = Select::where('id', $weekId)->latest()->first();
        }

        return $data;
    }
}
