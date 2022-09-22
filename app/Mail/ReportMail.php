<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $path = storage_path('app/public/docs/user_docs/');
        $fileName = $this->details->id .'_reports.csv';

        return $this->subject('Links reports!')
                    ->attach($path,  [
                                'as' => $fileName,
                                'mime' => 'text/csv'
                            ])
                    ->view('emails.report');
    }
}
