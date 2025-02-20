<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
  /**
   * Display a listing of the Users
   *
   * @return void
   */
  public function index()
  {
    $users = User::paginate(5);
    return view('users.index', compact(['users',]));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return void
   */
  public function create()
  {
    return view('users.create');
  }

  /**
   * Store a newly created resource in storage
   *
   * @param Request $request
   * @return void
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'given_name' => ['required', 'nullable', 'min:2', 'max:255', 'string', 'sometimes'],
      'family_name' => ['nullable', 'min:2', 'max:255', 'string', 'sometimes'],
      'name' => ['nullable', 'min:2', 'max:255', 'string'],
      'preferred_pronouns' => ['required', 'min:2', 'max:10', 'string'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class,],
      'password' => ['required', 'confirmed', 'min:4', 'max:255', Password::defaults(),],
      'profile_photo' => ['nullable', 'min:4', 'max:255'],
    ]);

    
    /**
     * Check if name is not provided use given / family name as default
     */
    if (empty($request->name)) {
      if ($validated['given_name'] != null) {
        $validated['name'] = $validated['given_name'];
      } else {
        $validated['name'] = $validated['family_name'];
      }
    }

    if (empty($request->profile_photo)) {
        $validated['profile_photo'] = "avatar.png";
    }
    
    // TODO: Assign the user's role

    /**
     * Create user after validated
     */
    User::create($validated);

    /** 
     * Redirect with success message
     */
    return redirect(route('users.index'))->with('success', 'User created');

    // 
  }


  /**
   * Display the specified resource.
   *
   * @param string $id
   * @return void
   */
  public function show(string $id)
  {
    $user = User::whereId($id)->get()->first();

    if ($user) {
      return view('users.show', compact(['user',]))->with('success', 'User found');
    } else {
      return redirect(route('users.index'))->with('warning', 'User not found');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param string $id
   * @return void
   */
  public function edit(string $id)
  {
    $user = User::where('id', '=', $id)->get()->first();

    if ($user) {
      return view('users.update', compact(['user',]))->with('success', 'User Found');
    } else {
      return redirect(route('users.index'))->with('error', 'User not found');
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param string $id
   * @return void
   */
  public function update(Request $request, string $id)
  {
    if (!$request->password) {
      unset($request['password'], $request['password_confirmation']);
    }

    $validated = $request->validate([
      'given_name' => ['nullable', 'min:2', 'max:255', 'string', 'required_without:family_name'],
      'family_name' => ['nullable', 'min:2', 'max:255', 'string', 'required_without:given_name'],
      'name' => ['nullable', 'min:2', 'max:255', 'string'],
      'preferred_pronouns' => ['required', 'min:2', 'max:10', 'string'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class,],
      'password' => ['required', 'confirmed', 'min:4', 'max:255', Password::defaults(),],
      'profile_photo' => ['nullable', 'min:4', 'max:255'],
    ]);

    $user = User::where('id', '=', $id)->get()->first();

    /**
     * Check if name is not provided use given / family name as default
     */
    if (empty($request->name)) {
      if ($validated['given_name'] != null) {
        $validated['name'] = $validated['given_name'];
      } else {
        $validated['name'] = $validated['family_name'];
      }
    }

    // TODO: Sync the user's role

    if ($user->isDirty('email')) {
      $user->email_verified_at = null;
    }

    $user->save();

    return redirect(route('users.show', compact(['user'])))->with('success', 'User updated');
  }

  public function destroy(string $id)
  {
    $user = User::where('id', '=', $id)->get()->first();

    if ($user) {
      $user->delete();
      return redirect(route('users.index'))->with('success', 'User deleted');
    } else {
      return back()->with('error', 'User not Found');
    }
  }
}
