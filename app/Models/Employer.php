<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class Employer extends Model
{
    use HasFactory, Notifiable;

    public function routeNotificationForMail(Notification $notification): array|string
    {
        return $this->user->email;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function jobApplications(): HasManyThrough
    {
        return $this->hasManyThrough(JobApplication::class, Job::class);
    }
}
