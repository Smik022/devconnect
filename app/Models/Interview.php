<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id','developer_id','job_post_id',
        'title','type','notes','location',
        'scheduled_at','duration_minutes',
        'reminder_minutes_before','reminder_sent_at','status'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'reminder_sent_at' => 'datetime',
    ];

    public function employer(){ return $this->belongsTo(User::class,'employer_id'); }
    public function developer(){ return $this->belongsTo(User::class,'developer_id'); }
    public function jobPost(){ return $this->belongsTo(JobPost::class); }
}
