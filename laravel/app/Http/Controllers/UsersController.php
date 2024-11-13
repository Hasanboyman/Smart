<?php

namespace App\Http\Controllers;

use App\Models\table;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = table::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'user_id' => 'required|unique:users,user_id',
        ]);


        $user = table::create([
            'full_name' => $request->full_name,
            'user_id' => $request->user_id,
            'group' => $request->group,
            'status' => $request->status,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
        ]);

        return response()->json($user, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        table::findOrFail($id);
        return response()->json(table::all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $users = table::findOrFail($id);

        $users->update($request->all());

    }


    public function destroy($id)
    {
        $users = table::findOrFail($id);
        $users = table::destroy($id);
        return response()->json(['message' => 'User deleted successfully.']);
    }
}
