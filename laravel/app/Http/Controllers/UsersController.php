<?php

namespace App\Http\Controllers;

use App\Models\persons;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = persons::all();
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


        $user = persons::create([
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

        persons::findOrFail($id);
        return response()->json(persons::all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, $id)
    {
        try {


            $users = persons::findOrFail($id);

            $users->update($request->all());

            return response()->json([
                'message' => 'User has been updated successfully!',
                'user' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the user.',
                'error' => $e->getMessage()
            ], 500);
        }

    }


    public function destroy($id)
    {
        $users = persons::findOrFail($id);
        $users = persons::destroy($id);
        return response()->json(['message' => 'User deleted successfully.']);
    }

    public function getGroups()
    {
        $groups = ['English', 'It'];
        return response()->json($groups);
    }

    public function pagination(Request $request)
    {

        $totalItems = persons::all()->count();

        $totalPages = ceil($totalItems / 8.5);

        $currentPage = $request->query('page', 1);

        $data = persons::skip(($currentPage - 1) * 8.5)->take(8.5)->get();

        return response()->json([
            'current_page' => $currentPage,
            'total_pages' => $totalPages - 1,
            'data' => $data,
        ]);
    }

    public function updateBackground(Request $request)
    {
        $request->validate([
            'color1' => 'required|string',
            'color2' => 'required|string',
            'color3' => 'required|string',
            'color4' => 'required|string',
            'color5' => 'required|string',
            'color6' => 'required|string',
        ]);


        session([
            'color1' => $request->color1,
            'color2' => $request->color2,
            'color3' => $request->color3,
            'color4' => $request->color4,
            'color5' => $request->color5,
            'color6' => $request->color6,
        ]);

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('background_images', 'public');
            session(['background_image' => $imagePath]);
        }
        return redirect()->back()->with('status', 'Background color and image updated!');
    }

    public function Image_delete()
    {
        $backgroundImage = session('background_image');

        if ($backgroundImage) {
            Storage::disk('local')->delete('background_images/' . $backgroundImage);
            session()->forget('background_image');

            return response()->json([
                'success' => true,
                'message' => 'Background image deleted successfully!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No background image found.'
        ], 404);
    }



}
