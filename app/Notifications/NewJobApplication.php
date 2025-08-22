<?php

namespace App\Notifications;

use App\Models\JobPost;
use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewJobApplication extends Notification
{
    use Queueable;

    public function __construct(
        public JobPost $job,
        public JobApplication $application
    ) {}

    
    public function via($notifiable)
    {
        return ['database']; 
    }

    
    public function toDatabase($notifiable): array
    {
        return [
            'job_post_id'     => $this->job->id,
            'job_title'       => $this->job->title,
            'application_id'  => $this->application->id,
            'applicant_id'    => $this->application->user_id,
            'applicant_name'  => $this->application->user->name,
            'message'         => "{$this->application->user->name} applied to {$this->job->title}.",
            'url'             => route('employer.applications'),
        ];
    }

    
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Job Application')
            ->line($this->application->user->name.' applied to '.$this->job->title)
            ->action('View applications', route('employer.applications'));
    }
}
