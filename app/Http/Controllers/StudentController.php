<?php

namespace App\Http\Controllers;

use App\Helpers\UploadImage;
use App\Models\homework;
use App\Models\User;
use App\Models\exam;
use Illuminate\Http\Request;
use App\Http\Controllers\SelectController;
use App\Models\adminChat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentController extends Controller
{


    //  ------------ student page (edit ) : ---------

    public function editAccunt(string $center_code)
    {
        $user = User::where('center_code', $center_code)->first();

        if (!$user) {
            return back()->with('flash_msg', 'Account not found');
        }

        return view('students.editAccount')->with('user', $user);
    }

    //  ------- Student update himself : -----------------------

    public function updateAccount(Request $request, string $center_code)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'name' => ['required'],
                'phone' => ['required'],
                'password' => ['sometimes', 'nullable', 'confirmed'],
                'current_password' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            // Retrieve the authenticated user
            $user = Auth::user();

            // Verify if the provided current password matches the authenticated user's password
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Incorrect current password.');
            }

            // Retrieve the user and related exam record (if exists)
            $student = User::where('center_code', $center_code)->firstOrFail();

            // Update user information
            $userInput = $request->only(['name', 'phone']);

            // Check if a new password is provided and update it if needed
            if ($request->filled('password')) {
                $userInput['password'] = Hash::make($request->password);
            }

            $student->update($userInput);

            // update other related tables : 
            $student_exam = exam::where('user_id', $center_code)->first();
            $homework_exam = homework::where('user_id', $center_code)->first();

            // Update related exam records if they exist
            $this->updateRelatedExam($student_exam, $request->input('name'));
            $this->updateRelatedExam($homework_exam, $request->input('name'));

            return redirect()->back()->with('done', 'Your data has been saved!');
        } catch (ValidationException $e) {
            // Validation errors (e.g., password confirmation failure)
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (ModelNotFoundException $e) {
            // User or exam record not found
            return redirect()->back()->with('error', 'User not found.');
        } catch (\Exception $e) {
            // Other unexpected errors
            return redirect()->back()->with('error', 'An error occurred while updating your data: ' . $e->getMessage());
        }
    }

    private function updateRelatedExam($examRecord, $userName)
    {
        if ($examRecord) {
            $examRecord->user_name = $userName;
            $examRecord->save();
        }
    }

    //  -------  update profile photo : -----------------------

    public function updateProfile(Request $request, $id)
    {

        try {
            // dd($request->hasFile('profile_photo'));
            if ($request->hasFile('profile_photo')) {
                $filename = UploadImage::generalUpload($request, 'profiles', 'profile_photo', false);
                // dd($filename);
                if ($filename !== false) {
                    user::where('center_code', $id)->update(['profile_photo' => $filename]);
                    return redirect()->back()->with('flash_msg', 'Image uploaded successfully.');
                }
            }
            return redirect()->back()->with('flash_msg', 'An error occurred while uploading the image.');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred while uploading the image: ' . $e->getMessage());
        }

    }


    public function studentSwithcourse(Request $request)
    {
        try {
            $course = $request->input('update_grade');
    
            // Get the current user
            $user = Auth::user();
    
            // Update the user's grade in the main user table
            if ($course) {
                $user->update(['grade' => $course]);
            }
    
            $user_id = Auth::user()->center_code;
            $user_grade = Auth::user()->grade;
            $user_name = Auth::user()->name;
    
            // Use firstOrCreate() to create an exam record if it doesn't exist
            $exam = exam::firstOrCreate([
                'user_id' => $user_id,
                'user_grade' => $user_grade,
                'user_name' => $user_name,
            ]);
    
            // Use firstOrCreate() to create a homework record if it doesn't exist
            homework::firstOrCreate([
                'user_id' => $user_id,
                'user_grade' => $user_grade,
                'user_name' => $user_name,
            ]);
    
            return redirect()->back()->with('flash_msg', 'Course swithced successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred while swithing the Course: ' . $e->getMessage());
        }
    }
    


    // public function studentSwithcourse(Request $request)
    // {
    //     try {
    //         $course = $request->input('update_grade');
    //         // dd($course);
    //         if ($course) {
    //             user::where('center_code', Auth::user()->center_code)->update(['grade' => $course]);
    //         }

    //         return redirect()->back()->with('flash_msg', 'Brief updated successfully.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('flash_msg', 'An error occurred while uploading the Brief : ' . $e->getMessage());
    //     }
    // }




}