<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use App\Models\Category;
use Illuminate\Http\Request;

class PromptController extends Controller
{
    public function index(Request $request)
    {
        $prompts = Prompt::with('category')
            ->where('user_id', auth()->id())
            ->where(function ($query) use ($request) {

                if ($request->search) {
                    $query->where('title', 'LIKE', '%' . $request->search . '%')
                          ->orWhere('prompt', 'LIKE', '%' . $request->search . '%');
                }

            })
            ->latest()
            ->get();

        return view('prompts.index', compact('prompts'));
    }


    public function create()
    {
        $categories = Category::all();

        return view('prompts.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required',
            'category_id' => 'required',
            'prompt' => 'required'

        ]);


        Prompt::create([

            'title' => $request->title,

            'category_id' => $request->category_id,

            'prompt' => $request->prompt,

            'description' => $request->description,

            'user_id' => auth()->id()

        ]);


        return redirect('/prompts');
    }
}