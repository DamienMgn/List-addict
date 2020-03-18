<?php

namespace App\Http\Middleware;

use App\Tasks;
use Closure;

class CheckTasks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $params = $request->route()->parameters();

        $tasks = Tasks::all();

        $task =  $tasks->find($params['task']);

        if ($task->card->category->user_id === $request->user()->id) {
            return $next($request);
        }
    }
}
