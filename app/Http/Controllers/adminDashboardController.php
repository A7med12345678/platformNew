<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class adminDashboardController extends Controller
{

    //  ------------------------------- Admin Dashboard : ------------------------------------------

    public function index()
    {
        $current = User::paginate(2);
        $countTotal = User::where('role', '<>', 'admin')->count();
        $count = User::where('pay', '1')->where('role', '<>', 'admin')->where('grade', '1')->count();
        $count2 = User::where('pay', '1')->where('role', '<>', 'admin')->where('grade', '2')->count();
        $count3 = User::where('pay', '1')->where('role', '<>', 'admin')->where('grade', '3')->count();
        $weekAgo = Carbon::now()->subDays(7);
        $countRecent = User::where('created_at', '>=', $weekAgo)->where('role', '<>', 'admin')->count();

        //  other classes (index , store) : 
        $data = $this->currentWeek_Sec();
        $chat = $this->chatAdmin();
        $toDo = $this->toDo();
        // $showAllChats = $this->showAllChats();

        return view('admin.adminOptions')->
            // with('toDo', $toDo)->
            // with('showAllChats', $showAllChats)->
            with('toDo', $toDo)->with('chat', $chat)->with('current', $current)->with('countTotal', $countTotal)->with('count', $count)->with('count2', $count2)->with('count3', $count3)->with('countRecent', $countRecent)->with('data', $data);
    }

    // other classes functions :
    public function currentWeek_Sec()
    {
        $new = new SelectController();
        $data = $new->indexAdmin();
        return $data;
    }

    public function chatAdmin()
    {
        $new = new adminChatController();
        $chat = $new->index();
        return $chat;
    }

    public function toDo()
    {
        $toDoController = new toDoController();
        $toDo = $toDoController->index();
        return $toDo;
    }

    public function logAllQueries()
    {

        // Enable query logging
        DB::connection()->enableQueryLog();

        // Perform your database operations here
        $students = DB::table('users')->get();

        // Retrieve the query log
        $queries = DB::getQueryLog();

        // Output the queries using dd
        dd($queries);

        // Disable query logging
        DB::connection()->disableQueryLog();

        // You can return a response or view as needed

    }


    public function online()
    {


        //      // Specify the URL you want to capture
        // $url = 'https://google.com';

        // // Set the output file path
        // $outputPath = public_path('screenshot.png');

        // // Use Browsershot to capture the screenshot
        // Browsershot::url($url)
        //     ->noSandbox() // Use noSandbox() instead of setOption('no-sandbox')
        //     ->save($outputPath);

        // return 'Screenshot captured and saved at ' . $outputPath;
        // // Specify the full file path including the file name and extension
        // $pdfFilePath = public_path('storage/example.pdf');

        // Browsershot::url('https://spatie.be/docs/browsershot/v2/introduction')
        //     ->save($pdfFilePath);

        // $user = Auth::user();

        // $sessions = DB::table('sessions')
        //     ->join('users', 'sessions.user_id', '=', 'users.id')
        //     ->whereIn('user_id', [$user->id]) // Use an array to pass the user's ID
        //     ->select('sessions.*', 'users.name', 'sessions.last_activity', 'users.center_code', 'sessions.ip_address') // Include 'ip_address' in the select statement
        //     // ->select('sessions.id as session_id', 'sessions.created_at as session_start', 'users.name as user_name', 'sessions.ip_address') // Include only necessary data

        //     ->get();

        // foreach ($sessions as $session) {
        //     $userAgent = $session->user_agent;
        //     $browserName = Agent::browser($userAgent); // Use the correct method call
        //     $session->last_activity_formatted = date('Y-m-d H:i:s', $session->last_activity);

        //     $session->browser_name = $browserName;
        //     $session->browser_image = $this->getBrowserImage($browserName);
        // }

        // return view('admin.online', compact('sessions'));
    }
}
