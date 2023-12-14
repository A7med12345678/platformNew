<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\complain;
use App\Models\User;

class complainApiController extends Controller
{
    public function complainInsert(Request $request)
    {
        $student = User::where('center_code', Auth::user()->center_code)->first();

        if ($student) {
            Complain::create([
                'user_id' => Auth::user()->center_code,
                'grade' => Auth::user()->grade,
                'user_name' => Auth::user()->name,
                'content' => $request->input('content'),
            ]);

            return response()->json(['message' => 'Your Complain has been submitted, thank you!']);
        }

        return response()->json(['error' => 'Error, please try again later.']);
    }

    public function showAllComplains(Request $request)
    {
        $query = Complain::query();
        $selectedSort = $request->input('sort');

        if ($selectedSort === 'done') {
            $query->where('done', 1);
        } elseif ($selectedSort === 'notDone') {
            $query->where('done', 0);
        }

        $complains = $query->get();

        return response()->json(['complains' => $complains]);
    }

    public function complainDone(Request $request, $id)
    {
        try {
            $complain = Complain::findOrFail($id);

            if ($complain) {
                $complain->update(['done' => 1, 'response' => $request->response]);
                return response()->json(['message' => 'Complain status changed!']);
            } else {
                return response()->json(['error' => 'Failed: Complaint not found.']);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Failed: ' . $e->getMessage()]);
        }
    }

    public function destroyComplain($id)
    {
        $complaint = Complain::find($id);

        if (!$complaint) {
            return response()->json(['error' => 'Complaint not found']);
        }

        $complaint->delete();

        return response()->json(['message' => 'Complaint deleted successfully']);
    }

    public function approveComplain($id)
    {
        $complain = Complain::find($id);

        if (!$complain) {
            return response()->json(['error' => 'Complain not found']);
        }

        try {
            $updated = false;

            if ($complain) {
                $complain->aprove = !$complain->aprove;
                $updated = $complain->save();
            }

            if ($updated) {
                return response()->json(['message' => 'Complain status updated!']);
            } else {
                return response()->json(['error' => 'Failed to update complain status']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update complain status: ' . $e->getMessage()]);
        }
    }
}
