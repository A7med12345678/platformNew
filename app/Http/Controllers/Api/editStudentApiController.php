<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\homework;
use App\Models\Exam;

class editStudentApiController extends Controller
{

    public function showAllData(Request $request)
    {
        $sort = $request->input('sort');
        $search = $request->input('search');

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
                case "online":
                    $current_fetch->where('last_seen', '1');
                    break;
                case "offline":
                    $current_fetch->where(function ($query) {
                        $query->where('last_seen', '0')
                            ->orWhereNull('last_seen');
                    });
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
                case "block1":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '1')->where('force_stop', '1');
                    break;
                case "block2":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '2')->where('force_stop', '1');
                    break;
                case "block3":
                    $current_fetch->where('role', '<>', 'admin')->where('grade', '3')->where('force_stop', '1');
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

        // Apply search logic
        if (isset($search)) {
            $current_fetch->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('parent_phone', 'like', '%' . $search . '%')
                    ->orWhere('whatsapp', 'like', '%' . $search . '%');
            });
        }

        // Paginate the results
        $current = $current_fetch->paginate(2);
        $currentCount = $current->total(); // total count for pagination

        // Prepare the response data
        $responseData = [
            'current' => $current,
            'sort' => $sort,
            'currentCount' => $currentCount,
        ];

        // Return the response as JSON
        return response()->json($responseData);
    }

    //  ------------ student manager (edit page) : ------------

    public function editStudentPage(string $center_code)
    {
        $user = User::where('center_code', $center_code)->first();

        if (!$user) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        return response()->json(['user' => $user], 200);
    }

    //  -------------- student manager (update)  : -----------------

    public function updateStudent(Request $request, string $center_code)
    {
        try {
            $student = User::where('center_code', $center_code)->first();

            if (!$student) {
                return response()->json(['error' => 'Student not found'], 404);
            }

            $input = $request->all();

            // Get the original values before updating
            $originalName = $student->name;
            $originalGrade = $student->grade;

            // Check if name or grade is being modified
            $nameChanged = $originalName !== $input['name'];
            $gradeChanged = $originalGrade !== $input['grade'];

            // Update exam table if necessary
            if ($nameChanged || $gradeChanged) {
                homework::where('user_id', $student->center_code)->update([
                    'user_name' => $input['name'],
                    'user_grade' => $input['grade']
                ]);
            }

            if ($nameChanged || $gradeChanged) {
                exam::where('user_id', $student->center_code)->update([
                    'user_name' => $input['name'],
                    'user_grade' => $input['grade']
                ]);
            }

            // Update the user's information
            $student->update($input);

            return response()->json(['message' => 'Student updated'], 200);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => 'Failed to update student: ' . $e->getMessage()], 500);
        }
    }

    //  ------------ student manager (delete) : ------------

    public function destroyStudent(string $center_code)
    {
        try {
            // Delete the user and associated exam records
            $deletedCount = User::where('center_code', $center_code)->delete();
            $deletedCountExam = Exam::where('user_id', $center_code)->delete();
            $deletedCountHomework = Homework::where('user_id', $center_code)->delete();

            if ($deletedCount > 0 and $deletedCountExam > 0 and $deletedCountHomework > 0) {
                return response()->json(['message' => 'Student and associated exam records deleted'], 200);
            }

            return response()->json(['error' => 'Student not found'], 404);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => 'Failed to delete student: ' . $e->getMessage()], 500);
        }
    }

    //  ------------ student manager (ban function) : ---------

    public function forceStopManager(string $center_code)
    {
        try {

            $user = User::where('center_code', $center_code)->first();

            $updated = false;

            if ($user) {
                if ($user->force_stop === "1") {
                    $user->force_stop = "0";
                    $updated = $user->save();
                } elseif ($user->force_stop === "0") {
                    $user->force_stop = "1";
                    $updated = $user->save();
                }
            }

            if ($updated) {
                // Return a JSON response for API
                return response()->json(['message' => 'Student status updated'], 200);
            } else {
                // Return a JSON response for API
                return response()->json(['error' => 'Failed to update force stop status'], 500);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the update
            // Return a JSON response for API
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    //  ------------ student manager (activate function) : ---------

    public function activationManager(string $center_code)
    {
        try {

            $user = User::where('center_code', $center_code)->first();

            $updated = false;

            if ($user) {
                if ($user->pay === "1") {
                    $user->pay = "0";
                    $updated = $user->save();
                } elseif ($user->pay === "0") {
                    $user->pay = "1";
                    $updated = $user->save();
                }

                if ($updated) {
                    // Return a JSON response for API
                    return response()->json(['message' => 'Student status updated'], 200);
                } else {
                    // Return a JSON response for API
                    return response()->json(['error' => 'Failed to update activation status'], 500);
                }
            } else {
                // Return a JSON response for API
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the update
            // Return a JSON response for API
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}


