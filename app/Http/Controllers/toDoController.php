<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\toDo;
use Illuminate\Support\Facades\Auth;

class toDoController extends Controller
{
    // goes to admin dashboard :
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

            return redirect()->back()->with('flash_msg', 'To-do Added!');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'Failed to add To-do: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $deletedRecord = toDo::find($id);

        if ($deletedRecord) {
            $deletedRecord->delete();
            return redirect()->back()->with('flash_msg', 'To-do deleted successfully.');
        } else {
            return redirect()->back()->with('flash_msg', 'To-do not found or already deleted.');
        }
    }

}
