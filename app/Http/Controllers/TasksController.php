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

        $task->status = false;

        $task->color = '#FFFFFF';

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

    /**
     * Return task
     */
    public function updateTask(Tasks $task, Request $request) {

        $card = $task->card;

        $validatedData = $request->validate([
            'taskName' => 'nullable|max:100',
            'taskColor' => 'nullable|max:7|min:7',
            'status' => 'nullable|boolean'
        ]);

        if (isset($request->status)) {
            $task->status = $request->status;
        }

        if (!empty($request->taskColor)) {
            $task->color = $request->taskColor;
        }

        if (!empty($request->taskName)) {
            $task->name = $request->taskName;
        }

        $task->save();

        $card['tasks'] = Tasks::where('card_id', $card->id)->get();

        return response()->json([
            'card' => $card,
        ]);
    }
}
