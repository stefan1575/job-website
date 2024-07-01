<?php

namespace App\Models;

use App\Events\JobApplicationSubmitted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => JobApplicationSubmitted::class
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function jobSeeker(): BelongsTo
    {
        return $this->belongsTo(JobSeeker::class);
    }
}
