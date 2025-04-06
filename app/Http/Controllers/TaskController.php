<?php

namespace App\Http\Controllers;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\TaskToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::query()->where('user_id', auth()->id())->orderByDesc('id');

        if ($request->filled('priority')) {
            $query->where('priority', $request->input('priority'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('deadline_from')) {
            $query->whereDate('deadline', '>=', $request->input('deadline_from'));
        }

        if ($request->filled('deadline_to')) {
            $query->whereDate('deadline', '<=', $request->input('deadline_to'));
        }

        $tasks = $query->paginate(10);

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => ['required', Rule::in(array_column(TaskPriority::cases(), 'value'))],
            'status' => ['required', Rule::in(array_column(TaskStatus::cases(), 'value'))],
            'deadline' => 'nullable|date',
        ]);

        Task::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
            'priority' => $request->input('priority'),
            'status' => $request->input('status'),
            'deadline' => $request->input('deadline'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $taskToken = $task->tokens()->where('expires_at', '>', Carbon::now())->first();
        return view('tasks.show', [
            'task' => $task,
            'taskToken' => $taskToken,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => ['required', Rule::in(array_column(TaskPriority::cases(), 'value'))],
            'status' => ['required', Rule::in(array_column(TaskStatus::cases(), 'value'))],
            'deadline' => 'nullable|date',
        ]);

        $task->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'status' => $request->input('status'),
            'deadline' => $request->input('deadline'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function generateToken(Task $task)
    {
        $token = Str::random(32);
        $expiresAt = Carbon::now()->addHours(24); // Token valid for 24 hours

        TaskToken::create([
            'task_id' => $task->id,
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);

        return redirect()->route('tasks.show', ['task' => $task])->with('success', 'Token created successfully.');
    }

    public function showPublic($token)
    {
        $taskToken = TaskToken::where('token', $token)->firstOrFail();

        if ($taskToken->isExpired()) {
            abort(403, 'This link has expired.');
        }

        $task = $taskToken->task;

        return view('tasks.show', compact('task'));
    }
}
