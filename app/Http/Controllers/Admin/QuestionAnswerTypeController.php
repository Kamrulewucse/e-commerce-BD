<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionAnswerType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuestionAnswerTypeController extends Controller
{
    public function bdDripIndex() {

        $questions = QuestionAnswerType::where('type',1)
            ->orderBy('sort')->get();

        return view('admin.answer_question.bd_drip_question_type.all', compact('questions'));
    }

    public function bdDripAdd() {
        $maxSort = QuestionAnswerType::where('type',1)->max('sort') + 1;
        return view('admin.answer_question.bd_drip_question_type.add',compact('maxSort'));
    }

    public function bdDripAddPost(Request $request) {

        $request->validate([
            'title' => [
                'required','max:255',
                Rule::unique('question_answer_types')
                    //->ignore($subSubCategory)
                    ->where('title', $request->title)
                    ->where('type',1)

            ],
            'sort' => 'required|integer|min:1',
            'status' => 'required',

        ]);


        $type = new QuestionAnswerType();
        $type->type = 1;
        $type->title = $request->title;
        $type->sort = $request->sort;
        $type->status = $request->status;
        $type->save();

        return redirect()->route('nike_and_bd_drip_question_type')->with('message', 'Type add successfully.');
    }

    public function bdDripEdit(QuestionAnswerType $type) {
        return view('admin.answer_question.bd_drip_question_type.edit', compact('type'));
    }

    public function bdDripEditPost(QuestionAnswerType $type, Request $request) {
        $request->validate([
            'title' => [
                'required','max:255',
                Rule::unique('question_answer_types')
                    ->ignore($type)
                    ->where('title', $request->title)
                    ->where('type',1)

            ],
            'sort' => 'required|integer|min:1',
            'status' => 'required',
        ]);


        $type->title = $request->title;
        $type->sort = $request->sort;
        $type->status = $request->status;
        $type->save();

        return redirect()->route('nike_and_bd_drip_question_type')->with('message', 'Type edit successfully.');
    }
    //Faq Question Type

    public function faqIndex() {

        $questions = QuestionAnswerType::where('type',2)
            ->orderBy('sort')->get();
        return view('admin.answer_question.faq_question_type.all', compact('questions'));
    }

    public function faqAdd() {
        $maxSort = QuestionAnswerType::where('type',2)->max('sort') + 1;
        return view('admin.answer_question.faq_question_type.add',compact('maxSort'));
    }

    public function faqAddPost(Request $request) {

        $request->validate([
            'title' => [
                'required','max:255',
                Rule::unique('question_answer_types')
                    //->ignore($subSubCategory)
                    ->where('title', $request->title)
                    ->where('type',2)

            ],
            'sort' => 'required|integer|min:1',
            'status' => 'required',

        ]);


        $type = new QuestionAnswerType();
        $type->type = 2;
        $type->title = $request->title;
        $type->sort = $request->sort;
        $type->status = $request->status;
        $type->save();

        return redirect()->route('faq_question_type')->with('message', 'Type add successfully.');
    }

    public function faqEdit(QuestionAnswerType $type) {
        return view('admin.answer_question.faq_question_type.edit', compact('type'));
    }

    public function faqEditPost(QuestionAnswerType $type, Request $request) {

        $request->validate([
            'title' => [
                'required','max:255',
                Rule::unique('question_answer_types')
                    ->ignore($type)
                    ->where('title', $request->title)
                    ->where('type',2)

            ],
            'sort' => 'required|integer|min:1',
            'status' => 'required',
        ]);


        $type->title = $request->title;
        $type->sort = $request->sort;
        $type->status = $request->status;
        $type->save();

        return redirect()->route('faq_question_type')->with('message', 'Type edit successfully.');
    }


    //Product Care Type

    public function productCareIndex() {

        $questions = QuestionAnswerType::where('type',3)
            ->orderBy('sort')->get();
        return view('admin.answer_question.product_care_question_type.all', compact('questions'));
    }

    public function productCareAdd() {
        $maxSort = QuestionAnswerType::where('type',3)->max('sort') + 1;
        return view('admin.answer_question.product_care_question_type.add',compact('maxSort'));
    }

    public function productCareAddPost(Request $request) {

        $request->validate([
            'title' => [
                'required','max:255',
                Rule::unique('question_answer_types')
                    //->ignore($subSubCategory)
                    ->where('title', $request->title)
                    ->where('type',3)

            ],
            'sort' => 'required|integer|min:1',
            'status' => 'required',

        ]);


        $type = new QuestionAnswerType();
        $type->type = 3;
        $type->title = $request->title;
        $type->sort = $request->sort;
        $type->status = $request->status;
        $type->save();

        return redirect()->route('product_care_question_type')->with('message', 'Type add successfully.');
    }

    public function productCareEdit(QuestionAnswerType $type) {
        return view('admin.answer_question.product_care_question_type.edit', compact('type'));
    }

    public function productCareEditPost(QuestionAnswerType $type, Request $request) {
        $request->validate([
            'title' => [
                'required','max:255',
                Rule::unique('question_answer_types')
                    ->ignore($type)
                    ->where('title', $request->title)
                    ->where('type',3)

            ],
            'sort' => 'required|integer|min:1',
            'status' => 'required',
        ]);


        $type->title = $request->title;
        $type->sort = $request->sort;
        $type->status = $request->status;
        $type->save();

        return redirect()->route('product_care_question_type')->with('message', 'Type edit successfully.');
    }
}
