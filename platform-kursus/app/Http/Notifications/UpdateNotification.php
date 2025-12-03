<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UpdateNotification extends Notification
{
    public $type;
    public $message;
    public $course_name;
    public $task_name;
    public $due_date;

    /**
     * Create a new notification instance.
     *
     * @param string $type
     * @param string $message
     * @param string|null $course_name
     * @param string|null $task_name
     * @param string|null $due_date
     * @return void
     */
    public function __construct($type, $message, $course_name = null, $task_name = null, $due_date = null)
    {
        $this->type = $type;
        $this->message = $message;
        $this->course_name = $course_name;
        $this->task_name = $task_name;
        $this->due_date = $due_date;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast']; // Anda bisa menambah channel lain seperti 'mail' atau 'sms'
    }

    /**
     * Get the array representation of the notification for database storage.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'type' => $this->type,
            'message' => $this->message,
            'course_name' => $this->course_name,
            'task_name' => $this->task_name,
            'due_date' => $this->due_date
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'type' => $this->type,
            'message' => $this->message,
            'course_name' => $this->course_name,
            'task_name' => $this->task_name,
            'due_date' => $this->due_date
        ]);
    }
}
