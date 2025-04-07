<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use App\Models\Cluster;
use App\Models\User;
use Illuminate\Http\Request;

class ClassSessionController extends Controller
{
    protected $sessionValidationRules;

    /**
     * Validation Rules for class session data
     */
    public function __construct(){
        $this->sessionValidationRules = [
            'cluster_id' => ['required', 'exists:clusters,id'],
            'user_id' => ['required', 'exists:users,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'students' => ['nullable', 'array'],
            'students.*' => ['exists:users,id'],
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classSessions = ClassSession::with(['cluster', 'staff'])->paginate(10);
        return view('class_sessions.index', compact('classSessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clusters = Cluster::all();
        $staff = User::where('role', 'staff')->get();
        $students = User::where('role', 'student')->get();
        return view('class_sessions.create', compact('clusters', 'staff', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->sessionValidationRules);

        $classSession = ClassSession::create($validated);

        if ($classSession) {
            $classSession->students()->attach($request->students);
        }

        return redirect()->route('class_sessions.index')->with('success', 'Class session created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classSession = ClassSession::with(['cluster', 'staff'])->find($id);

        if ($classSession) {
            return view('class_sessions.show', compact('classSession'));
        } else {
            return redirect(route('class_sessions.index'))->with('error', 'Class session not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classSession = ClassSession::where('id', '=', $id)->get()->first();
        $staff = User::where('role', 'staff')->get();
        return view('class_sessions.update', compact('classSession', 'classSession', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassSession $classSession)
    {
        $request->validate([
            'cluster_id' => 'required|exists:clusters,id',
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
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
