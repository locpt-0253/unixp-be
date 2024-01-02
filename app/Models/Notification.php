<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'notifiable_id',
        'notifiable_type',
        'content',
        'url',
        'has_read',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class,'recipient_id', 'id');
    }

    public function notifiable()
    {
        return $this->morphTo();
    }
}
