<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
        protected $fillable = [
        'customer_id',
        'message',
        'ai_response',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class , 'customer_id');
    }
}
