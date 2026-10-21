<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        $preferences = $user->preferences;

        return view(
            'questionnaire.create',
            compact('preferences')
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'p1'  => 'required|integer|between:1,5',
            'p2'  => 'required|integer|between:1,5',
            'p3'  => 'required|integer|between:1,5',
            'p4'  => 'required|integer|between:1,5',
            'p5'  => 'required|integer|between:1,5',
            'p6'  => 'required|integer|between:1,5',
            'p7'  => 'required|integer|between:1,5',
            'p8'  => 'required|integer|between:1,5',
            'p9'  => 'required|integer|between:1,5',
            'p10' => 'required|integer|between:1,5',
            'p11' => 'required|integer|between:1,5',
            'p12' => 'required|integer|between:1,5',
            'p13' => 'required|integer|between:1,5',
            'p14' => 'required|integer|between:1,5',
            'p15' => 'required|integer|between:1,5',
        ]);

        $validated['user_id'] = auth()->id();

        UserPreference::updateOrCreate(
            [
                'user_id' => auth()->id()
            ],
            $validated
        );

        $user = auth()->user();

        $user->questionnaire_completed_at = now();

        $user->save();

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Tus preferencias se guardaron correctamente.'
            );
    }
}
