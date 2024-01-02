<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';

    protected $primaryKey = 'id';

    protected $appends = ['createdat', 'updatedat'];

    protected $fillable = [
        'content',
        'isanonymous',
        'user_id',
        'question_id',
    ];

    public function getCreatedatAttribute()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedatAttribute()
    {
        return $this->attributes['updated_at'];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'question');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
