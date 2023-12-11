Route::post('/parentStudentChart', [FreeContentPageController::class,
'parentStudentChart'])->name('parentStudentChart');


// public function parentStudentChart(Request $request)
// {
// try {
// $request->validate([
// 'id' => 'required',
// ]);

// $id = $request->input('id');

// $marks = exam::where('user_id', $id)->first();

// if ($marks) {
// $data = $this->processMarks($marks, 'week', 'sec4');
// $examTotals = $this->generateExamTotals(45); // Generate exam totals array
// $type = "Exam";
// return view('parentChart', compact('data', 'id', 'type', 'examTotals'));
// } else {
// $errorMessage = 'Student marks not found.';
// return back()->with('flash_msg', $errorMessage);
// }
// } catch (Exception $e) {
// return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
// }
// }

// public function parentStudentChartHW(Request $request)
// {
// try {
// $request->validate([
// 'id' => 'required',
// ]);

// $id = $request->input('id');

// $marks = homework::where('user_id', $id)->first();

// if ($marks) {
// $data = $this->processMarks($marks, 'week', 'sec3h');
// $examTotals = $this->generateExamTotals(45); // Generate exam totals array
// $type = "Homework";
// return view('parentChart', compact('data', 'id', 'type', 'examTotals'));
// } else {
// $errorMessage = 'Student marks not found.';
// return back()->with('flash_msg', $errorMessage);
// }
// } catch (Exception $e) {
// return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
// }
// }





























// ----------------------------- Admin : Student End : --------------------------

// public function studentEnd(Request $request)
// {
// $id = $request->input('id');
// $week = $request->input('week');

// $update = User::where('center_code', $id)->update(['student_end' => $week]);

// if ($update > 0) {
// return redirect('/Admin')->with('flash_msg', 'Student End updated !');
// } else {
// return back()->with('error', 'No students found in Grade ');
// }
// }
// Route::post('admin/studentEnd', [StudentController::class, 'studentEnd'])->name('admin/studentEnd');





public function getUserIP(Request $request)
{
$userIP = $request->ip();

// Now, $userIP contains the user's IP address
return "User IP Address: " . $userIP;
}
Route::get('/ip', [StudentController::class, 'getUserIP'])->name('ip');





// public function storeInstructions(Request $request)
// {
// // Retrieve the existing data from the database
// $existingData = json_decode(instruction::pluck('content')->first(), true) ?: [];

// // Extract the video IDs from the new URL and add them to the array
// $new = $request->input('instruction');
// $existingData[] = $new;

// // Encode the updated array and store it in the database
// instruction::updateOrInsert(['id' => 4], ['urlinstruction' => json_encode($existingData)]);

// return redirect()->back()->with('flash_msg', 'Done!');
// }






{{-- <td>
    <span class="{{ $item->last_seen === '1' ? 'text-success' : 'text-danger' }}">
        {{ $item->last_seen === '1' ? 'Online' : 'Offline' }}
    </span>
</td> --}}



{{-- <form method="POST" action="{{ route('Admin.destroy', $item->email) }}" accept-charset="UTF-8"
    style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" title="Delete Student">x
        {{-- onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
        Delete</button>

</form> --}}



// public function deleteAdmin(Request $request)
    // {
    //     $admin_id = $request->input('admin_id');

    //     // Get the admin by id
    //     $user = User::find($admin_id);

    //     // Check if the admin exists
    //     if (!$user) {
    //         // Handle the case where the admin doesn't exist (optional)
    //         return redirect()->route('admin/showAdmin')->with('flash_msg', 'Admin not found.');
    //     }

    //     // Begin a database transaction to ensure data integrity
    //     DB::beginTransaction();

    //     try {
    //         // Delete all related records from adminschat table
    //         adminChat::where('sender_id', $admin_id)->delete();

    //         // Now, delete the admin from the users table
    //         $user->delete();

    //         // If everything is successful, commit the transaction
    //         DB::commit();

    //         // Redirect to a route indicating successful deletion (optional)
    //         return redirect()->route('admin/removeAdmin')->with('flash_msg', 'Admin deleted successfully.');
    //     } catch (\Exception $e) {
    //         // If an error occurs, rollback the transaction and handle the error
    //         DB::rollback();
    //         // You can log the error or handle it as per your application's requirement
    //         return redirect()->route('admin/showAdmin')->with('flash_msg', 'An error occurred while deleting the admin.');
    //     }
    // }