<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\toDo;
use Illuminate\Support\Facades\Auth;

class toDoApiController extends Controller
{
    public function index()
    {
        $toDo = toDo::latest()->paginate(6);
        return $toDo;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        try {
            toDo::create([
                'sender_id' => Auth::user()->id,
                'content' => $validatedData['content'],
            ]);

            return response()->json(['message' => 'To-do Added!'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add To-do', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        $deletedRecord = toDo::find($id);

        if ($deletedRecord) {
            $deletedRecord->delete();
            return response()->json(['message' => 'To-do deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'To-do not found or already deleted'], 404);
        }
    }


}
