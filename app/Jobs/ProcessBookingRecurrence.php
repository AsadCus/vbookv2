<?php

namespace App\Jobs;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessBookingRecurrence implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $dataParticipant;
    public function __construct($dataParticipant)
    {
        $this->dataParticipant = $dataParticipant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Participant::create($this->dataParticipant);
    }
}
