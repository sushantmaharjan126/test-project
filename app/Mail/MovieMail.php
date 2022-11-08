<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MovieMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fav_movie;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fav_movie)
    {
        $this->fav_movie = $fav_movie;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.movie-mail');
        return $this->from('admin@laraveldemo.com')
                    ->subject('Movie Added to Your Favorite List')
                    ->markdown('mail.movie-mail');
    }
}
