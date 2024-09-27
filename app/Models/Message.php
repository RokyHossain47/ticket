<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'sender_id',
        'message',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($message) {
            event(new \App\Events\MessageSent($message));
        });
    }
}
