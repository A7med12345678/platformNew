<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\QuizController;
use App\Models\exam;
use App\Models\specialLog;
use App\Notifications\NewUserNotification;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\SpecialLogService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => [
             function ($attribute, $value, $fail) {
                    // Check if the center_code exists in the users table
                    $exists = User::where('phone', $value)->exists();
                    if ($exists) {
                        $fail('هذا الرقم مُسجل لدينا مسبقًا');
                    }
                }
                ],
            'parent_phone' => ['required', 'string', 'max:11'],
            'grade' => ['required', 'string', 'max:1'],
                     // 'pay' => ['required', 'string', 'max:1'],
                     // 'develop_mode' => ['required', 'string', 'max:1'],
                     // 'force_stop' => ['required', 'string', 'max:1'],
            // 'subscription' => ['required', 'string', 'max:1'],
            'whatsapp' => ['required', 'string', 'max:11'],
            // 'start_from' => ['required', 'string', 'max:2'],
            'learn_type' => ['required', 'string', 'max:5'],
            'group' => ['required', 'string'],
            // 'last_seen' => ['nullable'],
            // 'role' => ['string', 'max:7'],
            'center_code' => [
                // 'required',
                // 'string',
                // 'max:6'  ,
                function ($attribute, $value, $fail) {
                    // Check if the center_code exists in the users table
                    $exists = User::where('center_code', $value)->exists();
                    if ($exists) {
                        $fail('هذا الكود مسجل لدينا مسبقًا');
                    }
                }
            ],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $grade = $data['grade'];
        $defaultCenterCode = $grade . '000';
    
        $maxCenterCode = (float) User::where('grade', $grade)->max('center_code') ?? $defaultCenterCode;
    
        // Check if there are any records in the 'center_code' field
        if ($maxCenterCode > 0) {
            $numericPart = (int) substr($maxCenterCode, strlen($grade)); // Extract numeric part
            $numericPart += 1;
            $newCenterCode = $grade . str_pad($numericPart, 3, '0', STR_PAD_LEFT);
        } else {
            $newCenterCode = $defaultCenterCode;
        }
    
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'parent_phone' => $data['parent_phone'],
            'grade' => $data['grade'],
            'avilable_grades' => json_encode([$data['grade']]),
                // 'pay' => $data['pay'],
                // 'force_stop' => $data['force_stop'],
                // 'develop_mode' => $data['develop_mode'],
            'center_code' => $newCenterCode,
            'whatsapp' => $data['whatsapp'],
            'learn_type' => $data['learn_type'],
            'group' => $data['group'],
        ]);
    
        // Queue the notification for better performance
        // $user->notify(new NewUserNotification($user));
    
        SpecialLogService::createLog('3', "New user: " . $data['email'] . ', name: ' . $data['name']);
    
        return $user;
    }
    








}