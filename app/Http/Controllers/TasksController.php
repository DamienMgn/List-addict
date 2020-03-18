<?php

namespace App\Http\Controllers;

use App\Cards;
use App\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Return task
     */
    public function addTask(Request $request, Cards $card) {

        $task = new Tasks;

        $task->name = $request->taskName;

        $task->card_id = $card->id;

        $task->save();

        $card['tasks'] = Tasks::where('card_id', $card->id)->get();

        return response()->json([
            'card' => $card,
        ]);
    }

    /**
    * Return task
    */
    public function deleteTask(Tasks $task) {

        $card = $task->card;

        $taskToDelete =  Tasks::find($task->id);

        $taskToDelete->delete();

        $card['tasks'] = Tasks::where('card_id', $card->id)->get();

        return response()->json([
            'card' => $card,
        ]);
    }
}
