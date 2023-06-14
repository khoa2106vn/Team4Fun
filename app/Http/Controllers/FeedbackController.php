<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'feedback_body' => 'required',
            'email' => 'required',
        ]);

        $input = $request->all();
        Feedback::create($input);
        return back();
    }
}
