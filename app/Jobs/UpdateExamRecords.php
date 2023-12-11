<?php
namespace App\Jobs;



use App\Models\exam; // Import the exam model
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class UpdateExamRecords implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
  public $selectedWeek;
  public $selectedSection;
  public $selectedGrade;

public function __construct($selectedWeek, $selectedSection, $selectedGrade)
{
    $this->selectedWeek = $selectedWeek;
    $this->selectedSection = $selectedSection;
    $this->selectedGrade = $selectedGrade;
}


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Job started: ' . now());

    // Rest of your code


 
    $current = 'week' . $this->selectedWeek . $this->selectedSection;
    // $current = 'week1sec3';
    //          week00
    //          week*sec3

       exam::where('user_grade', $this->selectedGrade)
        ->where($current, '#')
        ->update([
            $current => 'غائب',
        ]);
        
    Log::info('Job completed: ' . now());
    }
}
