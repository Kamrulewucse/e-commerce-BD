<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function questionType()
    {
        return $this->belongsTo(QuestionAnswerType::class,'question_answer_type_id','id');
    }

}
