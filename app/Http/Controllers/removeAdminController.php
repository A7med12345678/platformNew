<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\adminChat;
use App\Models\exam;
use App\Models\homework;


class removeAdminController extends Controller
{

    public function removeAdminPage(Request $request)
    {
        $admins = User::where('role', 'admin')
            ->orWhere('role', 'sadmin')
            ->get();

        // if ($admins->isEmpty()) {
        //     return back()->with('flash_msg', 'No admin users found');
        // }

        return view('admin.adminManager', compact('admins'));
    }

    public function deleteAdmin($id)
    {
        // Get the admin by id
        $user = User::find($id);

        // Check if the admin exists
        if (!$user) {
            // Handle the case where the admin doesn't exist (optional)
            return redirect()->back()->with('flash_msg', 'Admin not Found ! ');
        }

        try {
            // Delete all related records from adminschat table
            adminChat::where('sender_id', $id)->delete();
            Exam::where('user_id', $id)->delete();
            homework::where('user_id', $id)->delete();

            // Now, delete the admin from the users table
            $user->delete();

            return redirect()->back()->with('flash_msg', 'Admin deleted !');

        } catch (\Exception $e) {
            // You can log the error or handle it as per your application's requirement
            return redirect()->back()->with('flash_msg', 'Failed to delete admin: ' . $e->getMessage());
        }
    }

    public function pormoteAdmin($id)
    {

        // Get the admin by id
        $user = User::where('center_code', $id);

        // Check if the admin exists
        if (!$user) {
            // Handle the case where the admin doesn't exist (optional)
            return redirect()->back()->with('flash_msg', 'Admin not Found ! ');
        }

        try {

            $user = User::where('center_code', $id)->first();
            $updated = false;

            if ($user) {
                if ($user->role === "admin") {
                    $user->role = "Sadmin";
                    $updated = $user->save();
                } elseif ($user->role === "Sadmin") {
                    $user->role = "admin";
                    $updated = $user->save();
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
