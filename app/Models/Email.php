<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'subject', 'email', 'body', 'status'
    ];

    public function isPending() {
        return $this->status === 'pending';
    }

    public function isSent() {
        return $this->status === 'sent';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
