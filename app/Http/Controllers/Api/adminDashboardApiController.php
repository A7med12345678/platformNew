<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class adminDashboardApiController extends Controller
{

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

        $responseData = [
            'current' => $current,
            'countTotal' => $countTotal,
            'count' => $count,
            'count2' => $count2,
            'count3' => $count3,
            'countRecent' => $countRecent,
            'data' => $data,
            'chat' => $chat,
            'toDo' => $toDo,
        ];

        return response()->json($responseData, 200);
    }

    // other classes functions :
    public function currentWeek_Sec()
    {
        $new = new selectApiController();
        $data = $new->indexAdmin();
        return $data;
    }

    public function chatAdmin()
    {
        $new = new chatApiController();
        $chat = $new->index();
        return $chat;
    }

    public function toDo()
    {
        $toDoController = new toDoApiController();
        $toDo = $toDoController->index();
        return $toDo;
    }

}
