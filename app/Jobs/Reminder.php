<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\User;
use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->user = new User();

        $this->user->created_at = Carbon::now();
        $this->user->USER_prenom = 'jesuisunjob';
        $this->user->save();

    }
}
