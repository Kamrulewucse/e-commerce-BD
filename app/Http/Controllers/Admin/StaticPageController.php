<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function edit(Page $page) {

        return view('admin.page.edit',  compact('page'));
    }

    public function editPost(Page $page, Request $request) {
        $request->validate([
            'content' => 'nullable'
        ]);

        $page->content = $request->input('content');
        $page->save();

        return redirect()->back()->with('message', 'Page content saved.');
    }
}
