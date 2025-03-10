<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    protected $unitValidationRules;

    /**
     * Validation Rules for course data
     */
    public function __construct(){
        $this->unitValidationRules = [
            'national_code' => ['required', 'string','max:10', 'uppercase'],
            'title' => ['required', 'string','min:2', 'max:255'],
            'tga_status' => ['required', 'string','min:2', 'max:10'],
            'status_code' => ['required', 'string', 'max:5', 'uppercase'],
            'nominal_hours'=> ['required', 'integer', 'min:1', 'max:1000'],
            'course_id' => ['required', 'exists:courses,id'],
            'cluster_id' => ['required', 'exists:clusters,id'],
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gets the unit info & paginates
        $units = Unit::paginate(10);

        return view("units.index", compact(['units']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gets the course info
        $courses = Course::all();

        // Gets the cluster info
        $clusters = Cluster::all();

        return view('units.create', compact(['courses', 'clusters']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Gets the Unit validation Rules
        $validated = $request->validate($this->unitValidationRules);

        /**
         * Creates the Unit
         * 
         * Attaches the selected CourseId and the ClusterId 
         * to the Unit via the course_unit pivot table
         */
        $unit = Unit::create($validated);

        if ($unit) {
            $unit->courses()->attach($validated['course_id']);
            $unit->clusters()->attach($validated['cluster_id']);
        }
        
        return redirect()->route('units.index')->with('success','Unit Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Gets the courseId and clusterId
        $unit = Unit::with('courses', 'clusters')->find($id);

        if ($unit) {
            return view('units.show', compact(['unit']))->with('success', 'Unit found');
        }else {
            return redirect(route('units.index'))->with('error','Unit not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unit = Unit::where('id', '=', $id)->get()->first();
        
        // Gets the course info
        $courses = Course::all();

        // Gets the cluster info
        $clusters = Cluster::all();

        if ($unit) {
            return view('units.update', compact(['unit', 'courses', 'clusters']))->with('success', 'Unit Edited');
        } else {
            return redirect(route('units.index'))->with('error','Unit not Edited');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Gets the Unit validation Rules
        $validated = $request->validate($this->unitValidationRules);

        // Gets the chosen resource
        $unit = Unit::where('id','=', $id)->get()->first();

        // Updated the resource
        $unit->update([
            'national_code' => $validated['national_code'],
            'title' => $validated['title'],
            'tga_status' => $validated['tga_status'],
            'status_code' => $validated['status_code'],
            'nominal_hours'=> $validated['nominal_hours'],
        ]);

        // Sync with the selected course(s) and cluster(s)
        if (isset($validated['course_id'])) {
            $unit->courses()->sync($validated['course_id']);
        }

        if (isset($validated['cluster_id'])) {
            $unit->clusters()->sync($validated['cluster_id']);
        }

        return redirect(route('units.show', compact(['unit'])))->with('success','Unit Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::where('id','=', $id)->get()->first();

        if ($unit) {
            $unit->delete();
            return redirect(route('units.index'))->with('success','Unit Deleted');
        } else {
            return back()->with('error','Unit Not Found');
        }
    }
}
