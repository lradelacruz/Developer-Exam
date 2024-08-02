<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalTasks = Task::where('user_id', $user->id)->count();
        $assignedTasks = Task::where('assigned_user_id', $user->id)->count();
        $completedTasks = Task::where('user_id', $user->id)->where('status', 'done')->count();
        
        return view('dashboard', compact('totalTasks', 'assignedTasks', 'completedTasks'));
    }
}

