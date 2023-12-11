<?php

namespace App\Http\Controllers;

use App\Models\courseRequest;
use App\Models\User;
use App\Notifications\NotifyCoursePay;
use App\Notifications\NotifyNewCourse;
use App\Notifications\sendCourseLinks;
use App\Services\SpecialLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class CourseRequestController extends Controller
{

    // return pages (admin page , guest page)

    public function courseBuyRequestsPage(Request $request)
    {
        $requests = courseRequest::get();


        $sort = $request->input('sort');
        // Set default query:
        $current_fetch = courseRequest::whereNotNull('created_at');

        if (isset($sort)) {
            switch ($sort) {
                case "1":
                    $current_fetch->where('course', '1');
                    break;
                case "2":
                    $current_fetch->where('course', '2');
                    break;
                case "3":
                    $current_fetch->where('course', '3');
                    break;
                case "guest":
                    $current_fetch->where('student_code', 0);
                    break;

            }
        }
        // Fetch all table data:
        // $requests = $current_fetch->get();
        $requests = $current_fetch->with('user_details')->get();


        $currentCount = $current_fetch->count();

        // if ($admins->isEmpty()) {
        //     return back()->with('flash_msg', 'No admin users found');
        // }

        // $request22 = courseRequest::find(14)->with('user_details')->get();
        // dd($request22);


        return view('admin.courseBuyRequests', compact('requests', 'currentCount'));
    }

    public function courseBuyGuest(Request $request)
    {
        return view('courseBuyGuest');
    }

    // ------------------ guest create and get request :   ------------------

    public function submitCourseRequest(Request $request)
    {
        try {
            $course = $request->input('course');
            $name = $request->input('name');
            $from = $request->input('from');
            $mail = $request->input('email');
            $phone = $request->input('phone');
            $comment = $request->input('comment');
            $request_code = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

            // Create a new instruction using the provided data
            $createBuy = courseRequest::create([
                'student_code' => 0,
                'course' => $course,
                'name' => $name,
                'from' => $from,
                'email' => $mail,
                'phone' => $phone,
                'comment' => $comment,
                'request_code' => $request_code,
            ]);

            // Create a new User instance and populate it with data
            $mailUser = (new User())->fill([
                'name' => $name,
                'email' => $mail,
            ]);

            // Now you can send notifications to $mailUser
            // $mailUser->notify(new NotifyNewCourse($name, $course));

            return redirect()->back()->with(['response' => $request_code]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['flash_msg' => 'An error occurred while creating the instruction: ' . $e->getMessage()]);
        }
    }

    public function getCourseRequest(Request $request)
    {
        try {
            $code = $request->input('code');

            // Retrieve a course request using the provided code
            $get = courseRequest::where('request_code', $code)->first();

            if ($get) {
                // Course request found, redirect with the result
                return redirect()->back()->with('response_get', $get)->with('code', $code);
            } else {
                // Course request not found, set a custom error message
                return redirect()->back()->with('response_get_failed', 'Course request not found for code: ' . $code);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('response_get', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function deliverCourseRequest($code)
    {
        try {
            $request_record = courseRequest::where('request_code', $code)->first();
            $links = [];

            foreach (Storage::files('public/videos/' . $request_record->course) as $file) {
                // $links[] = '<a href="' . asset('storage/videos/' . $request_record . '/' . basename($file)) . '">Download File</a>';
                $links[] = asset('storage/videos/' . $request_record->course . '/' . basename($file));
            }

            // Create a new User instance and populate it with data
            $mailUser = (new User())->fill([
                'name' =>  $request_record->name,
                'email' => $request_record->email,
            ]);

            // Now you can send notifications to $mailUser
            $mailUser->notify(new sendCourseLinks($links, $request_record->name));
            // \Log::info('Notification sent successfully');
            return redirect()->back()->with(['flash_msg' => 'Course sent to your mail successfully']);

        } catch (\Exception $e) {
            // \Log::error("Error sending notification: " . $e->getMessage());
            return redirect()->back()->with('response_get', 'An error occurred: ' . $e->getMessage());
        }
    }


    // ------------------ Student create and delete request :   ------------------

    public function requestCourse($course)
    {
        try {
            // Create a new instruction using the provided data
            courseRequest::create([
                'student_code' => Auth::user()->center_code,
                'course' => $course,
                // 'status' => $request->input('content'),
            ]);

            return redirect()->back()
                ->with(['flash_msg' => 'Course Buy reserved successfully ! ']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['flash_msg' => 'An error occurred while creating the instruction : ' . $e->getMessage()]);
        }
    }
    public function deleteRequestCourse($course)
    {
        $courseRequest = CourseRequest::where('student_code', Auth::user()->center_code)->where('course', $course);

        try {
            $courseRequest->delete();
            return redirect()->back()->with(['flash_msg' => 'Course request deleted successfully!']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['flash_msg' => 'An error occurred while deleting the course request: ' . $e->getMessage()]);
        }
    }

    // ------------------ Admin Dashboard requestrs control :   ------------------
    public function deleteRequestCourseAdmin($id)
    {
        $courseRequest = CourseRequest::find($id);

        try {
            if ($courseRequest) {
                $courseRequest->delete();
                return redirect()->back()->with(['flash_msg' => 'Course request deleted successfully!']);
            } else {
                return redirect()->back()->with(['flash_msg' => 'Course request not found.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['flash_msg' => 'An error occurred : ' . $e->getMessage()]);
        }

    }

    public function statusCourseRequest(Request $request, $student, $course)
    {

        try {
            $action = $request->input('action');

            courseRequest::
                where('student_code', $student)->
                where('course', $course)->
                update([
                    'status' => $action,
                ]);

            SpecialLogService::createLog('3', "Updated request for " . $student . ', to : ' . $action);

            return redirect()->back()->with(['flash_msg' => 'Request status updated successfully!']);

        } catch (\Exception $e) {
            // Handle exceptions here
            return redirect()->back()->with(['flash_msg' => 'An error occurred : ' . $e->getMessage()]);
        }

    }

    public function mailCoursePayment($userId)
    {
        try {
            // Retrieve the user from the database using the ID
            $user = User::find($userId);

            if ($user) {
                // Send the notification
                $user->notify(new NotifyCoursePay($user));
                return redirect()->back()->with(['flash_msg' => 'Mail Notification sent successfully!']);
            } else {
                return redirect()->back()->with(['flash_msg' => 'User not found!']);
            }
        } catch (\Exception $e) {
            // Handle exceptions here
            return redirect()->back()->with(['flash_msg' => 'An error occurred while sending the notification: ' . $e->getMessage()]);
        }
    }


}
