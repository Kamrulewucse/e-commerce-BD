<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswerType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function questionAnswers()
    {
        return $this->hasMany(QuestionAnswer::class)->orderBy('sort');
    }
}
