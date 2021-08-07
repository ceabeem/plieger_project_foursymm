<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use Illuminate\Support\Facades\Log;

class testmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:testmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'testmail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::emergency('The system is down!');
        $arr=['prajapati.sabim@gmail.com'];
        $data = array('messages'=>"Virat Gandhi",'sender_name'=>'aaa','email'=>'aaa','contact'=>'aaa');
        Mail::send('emails.inquirymail', $data, function($message)use ($arr) {
            $message->to($arr)->subject('Weekly Status of Plieger Data Enrichment Project');
            $message->from('xyz@gmail.com','Plieger Nepal Team');
        });
        $this->info("Basic Email Sent. Check your inbox.");
    }
}
