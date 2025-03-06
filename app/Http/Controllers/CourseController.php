<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Package;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseValidationRules;

    /**
     * Validation Rules for course data
     */
    public function __construct(){
        $this->courseValidationRules = [
            'package_id' => ['required', 'exists:packages,id'],
            'national_code' => ['required', 'string','max:8', 'uppercase'],
            'aqf_level' => ['required', 'string','min:10', 'max:25'],
            'title' => ['required', 'string','min:2', 'max:255'],
            'tga_status' => ['required', 'string','min:2', 'max:10'],
            'status_code' => ['required', 'string', 'max:4', 'uppercase'],
            'nominal_hours'=> ['required', 'integer', 'min:1', 'max:1000'],
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gets the packageId & paginates
        $courses = Course::with('package')->paginate(10);

        return view("courses.index", compact(['courses']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::all();

        return view('courses.create', compact(['packages']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->courseValidationRules);

        Course::create($validated);

        return redirect()->route('courses.index')->with('success','course Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Gets the packageId, clusterId and unitId
        $course = Course::with('package', 'clusters', 'units')->find($id);

        if ($course) {
            return view('courses.show', compact(['course']))->with('success', 'Course found');
        } else {
            return redirect(route('courses.index'))->with('warning', 'Course not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::where('id', '=', $id)->get()->first();
        
        $packages = Package::all();

        if ($course) {
            return view('courses.update', compact(['course', 'packages']))->with('success', 'Course Edited');
        } else {
            return redirect(route('courses.index'))->with('error','Course not Edited');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  string $id)
    {
        // Gets the Validation Rules
        $validated = $request->validate($this->courseValidationRules);
        
        // Gets the chosen resource
        $course = Course::where('id','=', $id)->get()->first();

        // Updated the resource
        $course->update([
            'package_id' => $validated['package_id'],
            'national_code' => $validated['national_code'],
            'aqf_level' => $validated['aqf_level'],
            'title' => $validated['title'],
            'tga_status' => $validated['tga_status'],
            'status_code' => $validated['status_code'],
            'nominal_hours'=> $validated['nominal_hours'],
        ]);

        return redirect(route('courses.show', compact(['course'])))->with('success','Course Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::where('id','=', $id)->get()->first();

        if ($course) {
            $course->delete();
            return redirect(route('courses.index'))->with('success','course Deleted');
        } else {
            return back()->with('error','course Not Found');
        }
    }
}
