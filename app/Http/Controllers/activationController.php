<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;


class activationController extends Controller
{

    public function paymentPage()
    {
        return view('admin.payment');
    }
    //  ------------------------------------------- activate separater page : ------------------------------


    public function showAllActivations(Request $request)
    {
        $sort = $request->input('sort');
        // Set default query:
        $current_fetch = User::where('role', '<>', 'admin');

        if (isset($sort)) {
            switch ($sort) {
                case "pay":
                    $current_fetch->where('pay', '1');
                    break;
                case "nopay":
                    $current_fetch->where('pay', '0');
                    break;
                case "allWithAdmin":
                    $current_fetch = User::query();
                    break;
                case "all":
                    $current_fetch->where('role', '<>', 'admin');
                    break;
                case "pay1":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '1')->where('pay', '1');
                    break;
                case "pay2":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '2')->where('pay', '1');
                    break;
                case "pay3":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '3')->where('pay', '1');
                    break;
                case "nopay1":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '1')->where('pay', '0');
                    break;
                case "nopay2":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '2')->where('pay', '0');
                    break;
                case "nopay3":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '3')->where('pay', '0');
                    break;
                case "typegradeGENERAL":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'عام');
                    break;
                case "typegradeAZHAR":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'أزهر');
                    break;
                case "typegradeGENERAL1":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '1')->where('learn_type', 'عام');
                    break;
                case "typegradeGENERAL2":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '2')->where('learn_type', 'عام');
                    break;
                case "typegradeGENERAL3":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '3')->where('learn_type', 'عام');
                    break;
                case "typegradeAZHAR1":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '1')->where('learn_type', 'أزهر');
                    break;
                case "typegradeAZHAR2":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '2')->where('learn_type', 'أزهر');
                    break;
                case "typegradeAZHAR3":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '3')->where('learn_type', 'أزهر');
                    break;
                case "typegradeGENERALpay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'عام')->where('pay', '1');
                    break;
                case "typegradeAZHARpay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'أزهر')->where('pay', '1');
                    break;
                case "typegradeGENERALnopay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'عام')->where('pay', '0');
                    break;
                case "typegradeAZHARnopay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'أزهر')->where('pay', '0');
                    break;
                case "typegradeGENERAL1pay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'عام')->where('pay', '1')->where('grade', '1');
                    break;
                case "typegradeGENERAL2pay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'عام')->where('pay', '1')->where('grade', '2');
                    break;
                case "typegradeGENERAL3pay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'عام')->where('pay', '1')->where('grade', '3');
                    break;
                case "typegradeAZHAR1pay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'أزهر')->where('pay', '1')->where('grade', '1');
                    break;
                case "typegradeAZHAR2pay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'أزهر')->where('pay', '1')->where('grade', '2');
                    break;
                case "typegradeAZHAR3pay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'أزهر')->where('pay', '1')->where('grade', '3');
                    break;
                case "typegradeGENERAL1nopay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'عام')->where('pay', '0')->where('grade', '1');
                    break;
                case "typegradeGENERAL2nopay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'عام')->where('pay', '0')->where('grade', '2');
                    break;
                case "typegradeGENERAL3nopay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'عام')->where('pay', '0')->where('grade', '3');
                    break;
                case "typegradeAZHAR1nopay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'أزهر')->where('pay', '0')->where('grade', '1');
                    break;
                case "typegradeAZHAR2nopay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'أزهر')->where('pay', '0')->where('grade', '2');
                    break;
                case "typegradeAZHAR3nopay":
                    $current_fetch->where('role', '<>', 'admin')->where('learn_type', 'أزهر')->where('pay', '0')->where('grade', '3');
                    break;
                case "allDeleted":
                    $current_fetch->onlyTrashed()->where('role', '<>', 'admin')->get();
                    break;
                case "deleted1":
                    $current_fetch->onlyTrashed()->where('grade', '1')->where('role', '<>', 'admin')->get();
                    break;
                case "deleted2":
                    $current_fetch->onlyTrashed()->where('grade', '2')->where('role', '<>', 'admin')->get();
                    break;
                case "deleted3":
                    $current_fetch->onlyTrashed()->where('grade', '3')->where('role', '<>', 'admin')->get();
                    break;
                default:
                    $current_fetch->where('grade', $sort);
                    break;
            }
        }


        //  if (Auth::check()) {
        //     $user = Auth::user();
        //     $user->update(['last_seen' => Carbon::now()]);
        // }

        // Fetch all table data:
        $current = $current_fetch->get();

        // $usersWithOnlineStatus = [];
        // foreach ($current as $user) {
        //     if ($user->last_seen_at) {
        //         $onlineThreshold = Carbon::now()->subMinutes(5);
        //         $isOnline = $user->last_seen_at >= $onlineThreshold;
        //         $usersWithOnlineStatus[$user->id] = $isOnline;
        //     } else {
        //         $usersWithOnlineStatus[$user->id] = false; // User has no last_seen_at timestamp
        //     }
        // }
        // compact : , 'usersWithOnlineStatus'
        // dd($usersWithOnlineStatus);

        $currentCount = $current_fetch->count();
        return view('admin.showAllActivations', compact('current', 'currentCount'));
    }

    //  ------------------------------------------- activate separate page funciton : ------------------------------

    public function manageActivations(Request $request)
    {
        try {
            // dd($request->input('activate'));

            $center_codes = $request->input('center_codes');

            // Update 'pay' to 1 for records where 'center_code' is in $center_codes
            $update = User::whereIn('center_code', $center_codes)->update(['pay' => $request->input('activate')]);
            // dd($update);
            // Redirect or return a success response
            return back()->with('flash_msg', 'Students paing status updated ! !');
        } catch (QueryException $e) {
            // Handle the database query exception
            return back()->with('flash_msg', 'Failed to update : ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other exceptions
            return back()->with('flash_msg', 'An error occurred: ' . $e->getMessage());
        }
    }

    //  ------------------------------------- Admin Lesson Control  : --------------------------

    public function studentSearch(Request $request)
    {
        try {
            // Validate the input ID (assuming you have a form field named 'user_id')
            $request->validate([
                'user_id' => 'required',
            ]);

            // Get the user ID from the request
            $userId = $request->input('user_id');

            // Fetch the user's data
            // $user = User::findOrFail($userId);
            $user = User::where('center_code', $userId)->first();

            // Retrieve the user_start_from and user_end columns
            $userStartFrom = json_decode($user->start_from);
            $userEnd = json_decode($user->student_end);

            // dd($userStartFrom , $userEnd);
            // Return the data to your view
            return redirect()->back()
                ->with('userStartFrom', $userStartFrom)
                ->with('userEnd', $userEnd)
                ->with('userId', $userId);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the user is not found
            // dd($e->getMessage());
            return redirect()->back()->with('flash_msg', 'User not found  : ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other generic exceptions here'
            // dd($e->getMessage());
            return redirect()->back()->with('flash_msg', 'An error occurred : ' . $e->getMessage());
        }
    }

    public function deleteLessonfromuser($index, $user)
    {
        try {
            // Fetch the user's data
            $update_pay = User::where('center_code', $user)->first();

            if (!$update_pay) {
                return redirect()->back()->with('flash_msg', 'User not found.');
            }

            $userStartFrom = json_decode($update_pay->start_from, true); // Convert to associative array
            $userEnd = json_decode($update_pay->student_end, true); // Convert to associative array

            // dd($userStartFrom , $userEnd , $index);
            // Check if the index exists
            if (array_key_exists($index, $userStartFrom) && array_key_exists($index, $userEnd)) {
                // Remove the values at the specified index
                array_splice($userStartFrom, $index, 1);
                array_splice($userEnd, $index, 1);

                // Update the content in your database table
                User::where('center_code', $user)->update([
                    'start_from' => json_encode($userStartFrom),
                    'student_end' => json_encode($userEnd),
                ]);

                return redirect()->back()->with('success', 'Row deleted successfully.');
            }

            return redirect()->back()->with('error', 'Invalid index.');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the update
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function addLessonToUser(request $request)
    {
        try {

            $addLessonStart = (int) $request->input('start');
            $addLessonEnd = (int) $request->input('end');
            $user = $request->input('id');

            // Fetch the user's data
            $update_pay = User::where('center_code', $user)->first();

            if (!$update_pay) {
                return redirect()->back()->with('flash_msg', 'User not found.');
            }

            $userStartFrom = json_decode($update_pay->start_from, true); // Convert to associative array
            $userEnd = json_decode($update_pay->student_end, true); // Convert to associative array

            // Add the new lesson data to the arrays
            $userStartFrom[] = $addLessonStart;
            $userEnd[] = $addLessonEnd;

            // Update the content in your database table
            User::where('center_code', $user)->update([
                'start_from' => json_encode($userStartFrom),
                'student_end' => json_encode($userEnd),
            ]);

            return redirect()->back()->with('flash_msg', 'Lesson added successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the update
            dd($e->getMessage());
            return redirect()->back()->with('flash_msg', 'An error occurred: ' . $e->getMessage());
        }
    }

    //  ------------------------------------- Admin Block & paymeNt  : --------------------------

    public function forceStop(Request $request)
    {
        $force_stop = $request->input('force_stop');
        $id = $request->input('id');

        $user = User::where('center_code', $id)->first(); // Use first() to get a single user

        if ($user) {
            $user->force_stop = $force_stop;
            $updated = $user->save(); // Update the user's properties
            // $updated = User::where('center_code', $id)->update(['start_from' => $startFrom]);

            if ($updated) {
            return redirect()->back()->with('flash_msg', 'Student Banned!');
            } else {
            return redirect()->back()->with('flash_msg', 'Failed to update force stop status');
            }
        } else {
            return redirect()->back()->with('flash_msg', 'Student not found');
        }
    }

    public function updatePayment(Request $request)
    {
        try {
            $pay = $request->input('pay');
            $id = $request->input('id');

            // Update the 'pay' attribute in the database
            User::where('center_code', $id)->update(['pay' => $pay]);

            return redirect()->back()->with('flash_msg', 'Students Updated!');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the database update
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    //  ----------------------------- Admin All grades display  : --------------------------


    public function disableAllGrades(Request $request)
    {
        // Update all users with 'pay' column set to '1'
        $updatedCount = User::whereNotNull('center_code')
            ->where('role', 'studnt')
            ->update(['pay' => '0']);

        if ($updatedCount > 0) {
            return redirect()->back()->with('flash_msg', 'Students Updated!');
        } else {
            return redirect()->back()->with('flash_msg', 'No students found to update');
        }
    }


    public function disableGrade(Request $request)
    {
        $grade = $request->input('disable_grade');

        $updatedCount = User::where('grade', $grade)->update(['pay' => '0']);

        if ($updatedCount > 0) {
            return redirect('adminDashboard')->with('flash_msg', 'All Students Grade ' . $grade . ' Disabled!');
        } else {
            return redirect()->back()->with('error', 'No students found in Grade ' . $grade);
        }
    }

    //  ------------------------------------- Admin Develop Mode  : -------------------------

    public function developMode(Request $request)
    {
        $id = $request->input('mood');

        // Update all users in one query
        $updatedCount = User::query()->update(['develop_mode' => $id]);

        if ($updatedCount > 0) {
            return redirect('adminDashboard')->with('flash_msg', 'Platform Status updated!');
        }

        // If no users were updated
        return redirect()->back()->with('error', 'No students found to update to');
    }

    //  --------------------------------- Admin add grade to student  : ---------------------

    public function addGrade(Request $request)
    {
        // Get the input values
        $studentCode = $request->input('student_code');
        $newGrade = $request->input('new_grade');
    
        // Retrieve the existing data from the database and decode it
        $existingGrades = json_decode(user::where('center_code', $studentCode)->pluck('avilable_grades')->first(), true) ?: [];
    
        // Add the new grade to the existing grades array
        $existingGrades[] = $newGrade;
    
        // Encode the updated array and store it in the database
        user::where('center_code', $studentCode)->update(['avilable_grades' => json_encode($existingGrades)]);
    
        return redirect()->back()->with('flash_msg', 'Grade added successfully!');
    }
    


    // public function disableGrade(Request $request)
    // {
    //     $grade = $request->input('disable_grade');
    //     User::where('grade', $grade)->update(['pay' => '0']);
    //     return redirect('/Admin')->with('flash_msg', 'All Students Grade' . ' ' . $grade . ' ' . 'Disabled!');
    // }


    //   public function forceStop(Request $request)
    // {
    //     $force_stop = $request->input('force_stop');
    //     $id = $request->input('id');

    //     $user = User::where('center_code', $id)->first();

    //     if ($user) {
    //         $updated = $user->update(['force_stop' => $force_stop]);

    //         if ($updated) {
    //             return redirect('/Admin')->with('flash_msg', 'Students Banned!');
    //         } else {
    //             return back()->with('flash_msg', 'Failed to update force stop status');
    //         }
    //     } else {
    //         return back()->with('flash_msg', 'Student not found');
    //     }
    // }

    // public function disableAllGrades(Request $request)
    // {
    //     // Retrieve all users
    //     $users = User::all();

    //     // Loop through each user and update the pay field
    //     foreach ($users as $user) {
    //         $user->update(['pay' => '1']);
    //     }
    //     return redirect()->back()->with('flash_msg', 'Students Updated!');
    // }



    //  -------------- Admin :disable content monthly (grade 1 or 2 or 3)  : -----------


}
