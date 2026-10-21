<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureQuestionnaireCompleted
{
    public function handle(
        Request $request,
        Closure $next
    ): Response
    {
        $user = $request->user();

        if (
            $user &&
            is_null($user->questionnaire_completed_at)
        ) {

            return redirect()
                ->route('questionnaire.create');

        }

        return $next($request);
    }
}