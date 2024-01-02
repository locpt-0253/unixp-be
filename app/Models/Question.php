<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'content',
        'isanonymous',
        'viewcount',
        'userid',
        'acceptedanswerid',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'question_tag','question_id','tag_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
