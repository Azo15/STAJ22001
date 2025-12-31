<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentalStatusUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $rental;
    public $status;
    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct($rental, $status, $message = null)
    {
        $this->rental = $rental;
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $msg = $this->message;
        if (!$msg) {
            switch($this->status) {
                case 'approved': $msg = " '{$this->rental->book->title}' için ödünç isteğiniz onaylandı."; break;
                case 'rejected': $msg = " '{$this->rental->book->title}' için ödünç isteğiniz reddedildi."; break;
                case 'overdue': $msg = " '{$this->rental->book->title}' kitabının iade süresi geçti!"; break;
                default: $msg = " '{$this->rental->book->title}' kira durumu güncellendi: {$this->status}";
            }
        }

        return [
            'rental_id' => $this->rental->id,
            'book_title' => $this->rental->book->title,
            'status' => $this->status,
            'message' => $msg,
            'url' => route('myrentals'),
        ];
    }
}
