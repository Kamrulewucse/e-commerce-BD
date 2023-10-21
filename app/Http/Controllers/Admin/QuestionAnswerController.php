<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionAnswer;
use App\Models\QuestionAnswerType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;

class QuestionAnswerController extends Controller
{
    public function bdDripIndex() {

        $questions = QuestionAnswer::where('question_type',1)
            ->orderBy('sort')->get();

        return view('admin.answer_question.bd_drip_question.all', compact('questions'));
    }

    public function bdDripAdd() {
        $maxSort = QuestionAnswer::where('question_type',1)->max('sort') + 1;
//        $types = QuestionAnswerType::where('type',1)->get();
        return view('admin.answer_question.bd_drip_question.add',compact('maxSort'));
    }

    public function bdDripAddPost(Request $request) {

        $request->validate([
            'question' => [
                'required','max:255',
                Rule::unique('question_answers')
                    ->where('question_type',1)

            ],
            'question_answer_type' => 'nullable',
            'answer' => 'required',
            'sort' => 'required|integer|min:1',
            'status' => 'required',

        ]);


        $questionAnswer = new QuestionAnswer();
        $questionAnswer->question_type = 1;
        $questionAnswer->question_answer_type_id = $request->question_answer_type;
        $questionAnswer->question = $request->question;
        $questionAnswer->answer = $request->answer;
        $questionAnswer->sort = $request->sort;
        $questionAnswer->status = $request->status;
        $questionAnswer->save();

        return redirect()->route('nike_and_bd_drip_question')->with('message', 'Question Answer add successfully.');
    }

    public function bdDripEdit(QuestionAnswer $questionAnswer) {
        //$types = QuestionAnswerType::where('type',1)->get();
        return view('admin.answer_question.bd_drip_question.edit', compact('questionAnswer'));
    }

    public function bdDripEditPost(QuestionAnswer $questionAnswer, Request $request) {
        $request->validate([
            'question' => [
                'required','max:255',
                Rule::unique('question_answers')
                    ->ignore($questionAnswer)
                    ->where('question_type',1)

            ],
            'question_answer_type' => 'nullable',
            'answer' => 'required',
            'sort' => 'required|integer|min:1',
            'status' => 'required',
        ]);


        $questionAnswer->question_answer_type_id = $request->question_answer_type;
        $questionAnswer->question = $request->question;
        $questionAnswer->answer = $request->answer;
        $questionAnswer->sort = $request->sort;
        $questionAnswer->status = $request->status;
        $questionAnswer->save();

        return redirect()->route('nike_and_bd_drip_question')->with('message', 'Question answer edit successfully.');
    }
    //Faq Question

    public function faqIndex() {

        $questions = QuestionAnswer::where('question_type',2)
            ->orderBy('sort')->get();
        return view('admin.answer_question.faq_question.all', compact('questions'));
    }

    public function faqAdd() {
        $maxSort = QuestionAnswer::where('question_type',2)->max('sort') + 1;
        return view('admin.answer_question.faq_question.add',compact('maxSort'));
    }

    public function faqAddPost(Request $request) {

        $request->validate([
            'question' => [
                'required','max:255',
                Rule::unique('question_answers')
                    ->where('question_type',2)

            ],
            'question_answer_type' => 'nullable',
            'answer' => 'required',
            'sort' => 'required|integer|min:1',
            'status' => 'required',

        ]);


        $questionAnswer = new QuestionAnswer();
        $questionAnswer->question_type = 2;
        $questionAnswer->question_answer_type_id = $request->question_answer_type;
        $questionAnswer->question = $request->question;
        $questionAnswer->answer = $request->answer;
        $questionAnswer->sort = $request->sort;
        $questionAnswer->status = $request->status;
        $questionAnswer->save();

        return redirect()->route('faq_question')->with('message', 'Question answer add successfully.');
    }

    public function faqEdit(QuestionAnswer $questionAnswer) {
        return view('admin.answer_question.faq_question.edit', compact('questionAnswer'));
    }

    public function faqEditPost(QuestionAnswer $questionAnswer, Request $request) {

        $request->validate([
            'question' => [
                'required','max:255',
                Rule::unique('question_answers')
                    ->ignore($questionAnswer)
                    ->where('question_type',2)

            ],
            'question_answer_type' => 'nullable',
            'answer' => 'required',
            'sort' => 'required|integer|min:1',
            'status' => 'required',
        ]);


        $questionAnswer->question_answer_type_id = $request->question_answer_type;
        $questionAnswer->question = $request->question;
        $questionAnswer->answer = $request->answer;
        $questionAnswer->sort = $request->sort;
        $questionAnswer->status = $request->status;
        $questionAnswer->save();

        return redirect()->route('faq_question')->with('message', 'Question answer edit successfully.');
    }


    //Product Care

    public function productCareIndex() {
        $questions = QuestionAnswer::where('question_type',3)
                        ->orderBy('sort')->get();
        return view('admin.answer_question.product_care_question.all', compact('questions'));
    }

    public function productCareAdd() {
        $types = QuestionAnswerType::where('type',3)->get();
        $maxSort = QuestionAnswer::where('question_type',3)->max('sort') + 1;
        return view('admin.answer_question.product_care_question.add',compact('maxSort','types'));
    }

    public function productCareAddPost(Request $request) {

        $request->validate([
            'question' => [
                'required','max:255',
                Rule::unique('question_answers')
                    ->where('question_type',3)
            ],
            'question_answer_type' => 'required',
            'answer' => 'required',
            'sort' => 'required|integer|min:1',
            'status' => 'required',

        ]);


        $questionAnswer = new QuestionAnswer();
        $questionAnswer->question_type = 3;
        $questionAnswer->question_answer_type_id = $request->question_answer_type;
        $questionAnswer->question = $request->question;
        $questionAnswer->answer = $request->answer;
        $questionAnswer->sort = $request->sort;
        $questionAnswer->status = $request->status;
        $questionAnswer->save();

        return redirect()->route('product_care_question')->with('message', 'Question answer add successfully.');
    }

    public function productCareEdit(QuestionAnswer $questionAnswer) {
        $types = QuestionAnswerType::where('type',3)->get();
        return view('admin.answer_question.product_care_question.edit', compact('types','questionAnswer'));
    }

    public function productCareEditPost(QuestionAnswer $questionAnswer, Request $request) {
        $request->validate([
            'question' => [
                'required','max:255',
                Rule::unique('question_answers')
                    ->ignore($questionAnswer)
                    ->where('question_type',3)

            ],
            'question_answer_type' => 'required',
            'answer' => 'required',
            'sort' => 'required|integer|min:1',
            'status' => 'required',
        ]);


        $questionAnswer->question_answer_type_id = $request->question_answer_type;
        $questionAnswer->answer = $request->answer;
        $questionAnswer->question = $request->question;
        $questionAnswer->sort = $request->sort;
        $questionAnswer->status = $request->status;
        $questionAnswer->save();

        return redirect()->route('product_care_question')->with('message', 'Question answer edit successfully.');
    }
}
