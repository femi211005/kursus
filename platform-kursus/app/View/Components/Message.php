<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Message extends Component
{
    public $message;
    public $type;

    /**
     * Buat instans komponen.
     *
     * @param string $message
     * @param string $type
     * @return void
     */
    public function __construct($message, $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Mendapatkan tampilan untuk komponen.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.message');
    }
}
