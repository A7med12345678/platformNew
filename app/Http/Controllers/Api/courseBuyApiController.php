<?php

namespace App\Http\Controllers\Api;


use App\Models\courseRequest;
use App\Models\User;
use App\Notifications\sendCourseLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class courseBuyApiController extends Controller
{
    public function courseBuyRequestsPage(Request $request)
    {
        $requests = courseRequest::with('user_details')->get();

        $sort = $request->input('sort');
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

        $requests = $current_fetch->with('user_details')->get();
        $currentCount = $current_fetch->count();

        return response()->json(['requests' => $requests, 'currentCount' => $currentCount]);
    }

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

            $mailUser = (new User())->fill([
                'name' => $name,
                'email' => $mail,
            ]);

            return response()->json(['response' => $request_code]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the instruction: ' . $e->getMessage()]);
        }
    }

    public function getCourseRequest(Request $request)
    {
        try {
            $code = $request->input('code');
            $get = courseRequest::where('request_code', $code)->first();

            if ($get) {
                return response()->json(['response_get' => $get, 'code' => $code]);
            } else {
                return response()->json(['error' => 'Course request not found for code: ' . $code]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function deliverCourseRequest($code)
    {
        try {
            $request_record = courseRequest::where('request_code', $code)->first();
            $links = [];

            foreach (Storage::files('public/videos/' . $request_record->course) as $file) {
                $links[] = asset('storage/videos/' . $request_record->course . '/' . basename($file));
            }

            $mailUser = (new User())->fill([
                'name' => $request_record->name,
                'email' => $request_record->email,
            ]);

            $mailUser->notify(new sendCourseLinks($links, $request_record->name));

            return response()->json(['flash_msg' => 'Course sent to your mail successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    // ------------------ Student create and delete request :   ------------------

    public function requestCourse($course)
    {
        try {
            CourseRequest::create([
                'student_code' => Auth::user()->center_code,
                'course' => $course,
            ]);

            return response()->json(['message' => 'Course Buy reserved successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the instruction: ' . $e->getMessage()]);
        }
    }

    public function deleteRequestCourse($course)
    {
        $courseRequest = CourseRequest::where('student_code', Auth::user()->center_code)->where('course', $course);

        try {
            $courseRequest->delete();
            return response()->json(['message' => 'Course request deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the course request: ' . $e->getMessage()]);
        }
    }

    // ------------------ Admin Dashboard requestrs control :   ------------------

}
