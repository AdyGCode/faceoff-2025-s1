<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    protected $clusterValidationRules;

    /**
     * Validation Rules for course data
     */
    public function __construct(){
        $this->clusterValidationRules = [
            'code' => ['required', 'string','max:10', 'uppercase'],
            'title' => ['required', 'string','min:2', 'max:255'],
            'qualification'=> ['required', 'string','max:8','uppercase'],
            'qs_code'=> ['required', 'string','max:4','uppercase'],
            'course_id' => ['required', 'exists:courses,id'],
            'unit_id' => ['required', 'exists:units,id'],
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gets the clsuter info & paginates
        $clusters = Cluster::paginate(10);

        return view("clusters.index", compact(['clusters']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gets the course info
        $courses = Course::all();

        // Gets the unit info
        $units = Unit::all();

        return view('clusters.create', compact(['courses', 'units']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Gets the Cluster validation Rules
        $validated = $request->validate($this->clusterValidationRules);

        /**
         * Creates the Cluster
         * 
         * Attaches the selected CourseId and the UnitId 
         * to the Cluster via the pivot tables
         */
        $cluster = Cluster::create($validated);

        if ($cluster) {
            $cluster->courses()->attach($validated['course_id']);
            $cluster->units()->attach($validated['unit_id']);
        }
        
        return redirect()->route('clusters.index')->with('success','Cluster Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Gets the courseId and unitId
        $cluster = Cluster::with('courses', 'units')->find($id);

        if ($cluster) {
            return view('clusters.show', compact(['cluster']))->with('success', 'Cluster found');
        }else {
            return redirect(route('clusters.index'))->with('error','Cluster not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cluster = Cluster::where('id', '=', $id)->get()->first();
        
        // Gets the course info
        $courses = Course::all();

        // Gets the unit info
        $units = Unit::all();

        if ($cluster) {
            return view('clusters.update', compact(['cluster', 'courses', 'units']))->with('success', 'Cluster Edited');
        } else {
            return redirect(route('clusters.index'))->with('error','Cluster not Edited');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Gets the Cluster validation Rules
        $validated = $request->validate($this->clusterValidationRules);

        // Gets the chosen resource
        $cluster = Cluster::where('id','=', $id)->get()->first();

        // Updated the resource
        $cluster->update([
            'code' => $validated['code'],
            'title' => $validated['title'],
            'qualification' => $validated['qualification'],
            'qs_code' => $validated['qs_code'],
        ]);

        // Sync with the selected course(s) and unit(s)
        if (isset($validated['course_id'])) {
            $cluster->courses()->sync($validated['course_id']);
        }

        if (isset($validated['unit_id'])) {
            $cluster->units()->sync($validated['unit_id']);
        }

        return redirect(route('clusters.show', compact(['cluster'])))->with('success','Cluster Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cluster = Cluster::where('id','=', $id)->get()->first();

        if ($cluster) {
            $cluster->delete();
            return redirect(route('clusters.index'))->with('success','Cluster Deleted');
        } else {
            return back()->with('error','Cluster Not Found');
        }
    }
}
