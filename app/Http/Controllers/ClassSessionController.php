<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use App\Models\Cluster;
use App\Models\User;
use Illuminate\Http\Request;

class ClassSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classSessions = ClassSession::with(['cluster', 'staff', 'students'])->get();
        return view('class_sessions.index', compact('classSessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clusters = Cluster::all();
        $staff = User::where('role', 'staff')->get();
        return view('class_sessions.create', compact('clusters', 'staff'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cluster_id' => 'required|exists:clusters,id',
            'user_id' => 'required|exists:users,id',
        ]);

        ClassSession::create($request->all());

        return redirect()->route('class_sessions.index')->with('success', 'Class session created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassSession $classSession)
    {
        return view('class_sessions.show', compact('classSession'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassSession $classSession)
    {
        $clusters = Cluster::all();
        $staff = User::where('role', 'staff')->get();
        return view('class_sessions.edit', compact('classSession', 'clusters', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassSession $classSession)
    {
        $request->validate([
            'cluster_id' => 'required|exists:clusters,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $classSession->update($request->all());

        return redirect()->route('class_sessions.index')->with('success', 'Class session updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassSession $classSession)
    {
        $classSession->delete();
        return redirect()->route('class_sessions.index')->with('success', 'Class session deleted successfully.');
    }
}
