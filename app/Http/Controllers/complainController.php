<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\complain;

class complainController extends Controller
{
    public function complainPage()
    {
        $complaints = Complain::where('user_id', Auth::user()->center_code)
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($complaints);
        return view('students.complain', compact('complaints'));
    }

    public function complainInsert(Request $request)
    {
        $student = User::where('center_code', Auth::user()->center_code)->first();

        if ($student) {
            // Create a complaint
            Complain::create([
                'user_id' => Auth::user()->center_code,
                'grade' => Auth::user()->grade,
                'user_name' => Auth::user()->name,
                'content' => $request->input('content'),
                // Use the content from the request
            ]);

            return back()->with('done', 'Your Complain has been submitted , thank you ! ');
            // return back()->with('done', 'تم إضافة الشكوى بنجاح, نشكركم على تعوانكم معنا');
        }

        // If the user is not found, return an error message
        return back()->with('error', 'Error , please try again later .. ');
        // return back()->with('error', 'حدث خطأ ما, الرجاء المحاولة لاحقًا');

    }

    public function showAllComplains(Request $request)
    {
        $query = complain::query();

        // Check the selected 'sort' value from the request
        $selectedSort = $request->input('sort');

        if ($selectedSort === 'done') {
            $query->where('done', 1);
        } elseif ($selectedSort === 'notDone') {
            $query->where('done', 0);
        } elseif ($selectedSort === 'allComplaints') {
            $query->all;
        }


        // allComplaints

        // Get the filtered complaints
        $complains = $query->get();

        return view('admin.showAllComplains', compact('complains'));
    }

    public function complainDone(Request $request, $id)
    {
        try {
            $complain = Complain::findOrFail($id);
            // dd($id);

            // Check if the complain exists
            if ($complain) {
                $complain->update(['done' => 1]);
                $complain->update(['response' => $request->response]);
                return back()->with('done', 'Complain status Changed ! ');
            } else {
                return back()->with('done', 'Failed: Complaint not found.');
            }

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('done', 'Failed: ' . $e->getMessage());
        }
    }

    public function destroyComplain($id)
    {
        // Find the complaint by ID
        $complaint = complain::find($id);

        // Check if the complaint exists
        if (!$complaint) {
            return redirect()->back()->with('done', 'Complaint not found');
        }

        // Delete the complaint
        $complaint->delete();

        return redirect()->back()->with('done', 'Complaint deleted successfully');
    }

    public function aproveComplain($id)
    {

        // Get the admin by id
        $complain = complain::find($id);

        // Check if the admin exists
        if (!$complain) {
            // Handle the case where the admin doesn't exist (optional)
            return redirect()->back()->with('flash_msg', 'Admin not Found ! ');
        }

        try {

            $updated = false;

            if ($complain) {
                if ($complain->aprove === "1") {
                    $complain->aprove = "0";
                    $updated = $complain->save();
                } elseif ($complain->aprove === "0") {
                    $complain->aprove = "1";
                    $updated = $complain->save();
                }
            }

            if ($updated) {
                return redirect()->back()->with('flash_msg', 'Admin status Updated!');
            } else {
                return redirect()->back()->with('flash_msg', 'Failed to update Role status');
            }


        } catch (\Exception $e) {
            // You can log the error or handle it as per your application's requirement
            return redirect()->back()->with('flash_msg', 'Failed to update Role status : ' . $e->getMessage());
        }
    }
}