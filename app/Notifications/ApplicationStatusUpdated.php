<?php

namespace App\Notifications;

use App\Models\JobPost;
use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ApplicationStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(
        public JobPost $job,
        public JobApplication $application,
        public string $status // 'pending', 'accepted', 'rejected', 'shortlisted'
    ) {}

    // store in database (in-app notifications)
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        // friendly text for the developer
        $pretty = ucfirst($this->status); // Pending / Accepted / Rejected / Shortlisted

        return [
            'job_post_id'    => $this->job->id,
            'job_title'      => $this->job->title,
            'application_id' => $this->application->id,
            'status'         => $this->status,
            'message'        => "Your application for “{$this->job->title}” is {$pretty}.",
            // where the dev should go when opening the notification
            'url'            => route('jobposts.show', $this->job->id),
        ];
    }
}
