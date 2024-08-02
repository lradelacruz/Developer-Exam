<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Auth::user()->tasks()->where('archived', false)->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $tasks = Task::all();
        return view('tasks.create', compact('tasks'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:todo,in-progress,done',
            'priority' => 'required|in:high,medium,low',
            'due_date' => 'nullable|date',
            'prerequisites' => 'nullable|string'
        ]);
    
        $task = Auth::user()->tasks()->create($request->except('prerequisites'));
    
        $prerequisiteIds = array_filter(array_map('trim', explode(',', $request->prerequisites)));
        if (!empty($prerequisiteIds)) {
            $task->prerequisites()->attach($prerequisiteIds);
        }
    
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
    
    
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $allTasks = Task::all();
        return view('tasks.edit', compact('task', 'allTasks'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:todo,in-progress,done',
            'priority' => 'required|in:high,medium,low',
            'due_date' => 'nullable|date',
            'prerequisites' => 'nullable|string'
        ]);
    
        $task->update($request->except('prerequisites'));
    
        $prerequisiteIds = array_filter(array_map('trim', explode(',', $request->prerequisites)));
        $task->prerequisites()->sync($prerequisiteIds);
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function archive(Task $task)
    {
        $this->authorize('update', $task); 

        $task->update(['archived' => true]);
        return redirect()->route('tasks.index')->with('success', 'Task archived successfully.');
    }

    public function restore(Task $task)
    {
        $this->authorize('update', $task); 

        $task->update(['archived' => false]);
        return redirect()->route('tasks.index')->with('success', 'Task restored successfully.');
    }

    public function assign(Request $request, Task $task)
    {
        $this->authorize('assign', Task::class);

        $request->validate([
            'assigned_user_id' => 'nullable|exists:users,id',
        ]);

        $task->update(['assigned_user_id' => $request->assigned_user_id]);

        return redirect()->route('tasks.show', $task)->with('success', 'Task assigned successfully.');
    }

    public function assignedTasks()
    {
        $tasks = Task::where('assigned_user_id', Auth::id())->paginate(10);
        return view('tasks.assigned', compact('tasks'));
    }
    
    public function tasksAssignedByUser()
    {
        $tasks = Auth::user()->tasks()->where('assigned_user_id', Auth::id())->where('archived', false)->paginate(10);
        return view('tasks.assigned_by_user', compact('tasks'));
    }

    public function filterByStatus(Request $request)
    {
        $status = $request->query('status', 'todo');
        $tasks = Auth::user()->tasks()->where('status', $status)->where('archived', false)->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function storeComment(Request $request, Task $task)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $task->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('tasks.show', $task)->with('success', 'Comment added successfully.');
    }
}
