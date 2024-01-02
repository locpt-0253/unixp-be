<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $appends = ['count'];

    protected $table = 'tags';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'tagname',
        'color',
    ];

    protected function count() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->questions()->count(),
        );
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_tag', 'tag_id', 'question_id');
    }
}
