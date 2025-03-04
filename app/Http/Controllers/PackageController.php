<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;


class PackageController extends Controller
{   

    protected $packageValidationRules;

    /**
     * Validation Rules for Package data
     */
    public function __construct(){
        $this->packageValidationRules = [
            'national_code' => ['required', 'string','max:3', 'uppercase'],
            'title' => ['required', 'string','min:2', 'max:255'],
            'tga_status' => ['required', 'string','min:2', 'max:10']
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::paginate(10);
        return view("packages.index", compact(['packages']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request )
    {
        $validated = $request->validate($this->packageValidationRules);

        Package::create($validated);

        return redirect()->route('packages.index')->with('success','Package Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $package = Package::with('courses')->find($id);

        if ($package) {

            $courses = $package->courses;

            return view('packages.show', compact(['package', 'courses']))->with('success', 'Package found');
        } else {
            return redirect(route('packages.index'))->with('warning', 'Package not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $package = Package::where('id', '=', $id)->get()->first();

        if ($package) {
            return view('packages.update', compact(['package']))->with('success', 'Package Edited');
        } else {
            return redirect(route('packages.index'))->with('error','Package not Edited');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Gets the Validation Rules
        $validated = $request->validate($this->packageValidationRules);

        // Gets the chosen resource
        $package = Package::where('id','=', $id)->get()->first();

        // Updated the resource
        $package->update([
            'national_code'=> $validated['national_code'],
            'title'=> $validated['title'],
            'tga_status'=> $validated['tga_status'],
        ]);

        return redirect(route('packages.show', compact(['package'])))->with('success','Package Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = Package::where('id','=', $id)->get()->first();

        if ($package) {
            $package->delete();
            return redirect(route('packages.index'))->with('success','Package Deleted');
        } else {
            return back()->with('error','Package Not Found');
        }
    }
}
