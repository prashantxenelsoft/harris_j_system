<?php
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;

protected function unauthenticated($request, AuthenticationException $exception)
{
    if ($request->is('api/*')) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    return redirect()->guest(route('login'));
}