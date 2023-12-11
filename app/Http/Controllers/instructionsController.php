<?php

namespace App\Http\Controllers;

use App\Models\dashboardChange;
use App\Models\instruction;
use App\Models\specialLog;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class instructionsController extends Controller
{

    //  -------------- Admin : instruction page  : -----------

    public function instructionPage(Request $request)
    {
        $currentGroups = dashboardChange::where('description', 'currentGroups');
        $instructions = instruction::get();

        return view('admin.instructions', compact('instructions'));
    }

    public function addInstructions(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'content' => 'required',
                'grade' => 'required',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return redirect()->back()->with(['flash_msg' => 'Validation failed', 'errors' => $validator->errors()]);
            }

            // Create a new instruction using the provided data
            instruction::create([
                'sender_id' => Auth::user()->center_code,
                'grade' => $request->input('grade'),
                'content' => $request->input('content'),
            ]);

            return redirect()->back()->with(['flash_msg' => 'Instruction created successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['flash_msg' => 'An error occurred while creating the instruction : ' . $e->getMessage()]);
        }
    }

    public function deleteInstructions($id)
    {
        try {
            // Find the instruction by its ID
            $instruction = instruction::findOrFail($id);

            // Delete the instruction
            $instruction->delete();

            return redirect()->back()->with('flash_msg', 'Instruction created Successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred while deleting the instruction : ' . $e->getMessage());
        }
    }

    public function editInstructions($id, Request $request)
    {
        try {
            // Find the instruction by its ID
            $instruction = instruction::findOrFail($id);

            // Update the instruction
            $instruction->update([
                'content' => $request->input('content'),
            ]);

            return redirect()->back()->with('flash_msg', 'Instruction updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred while updating the instruction : ' . $e->getMessage());
        }
    }

}