<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use App\Models\PostNotificationUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $user;
    public $post;
    public function __construct()
        {
            $this->user = new User;
            $this->post = new PostNotificationUser;
        }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $name = Auth::user();

        $users = User::all();

        return view('users.index',compact('users','name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.add-notification');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $data = $this->user->store_user_data($request);

        return redirect()->route('users.index')->with('success', 'Notification sent to users with notification_on_off set to 0.');
    }

    /**Notification Update
     *
     */
    public function updateNotificationStatus(Request $request)
        {
            $request->validate([
                'userId' => 'required|integer',
                'notificationEnabled' => 'required|boolean',
            ]);

            $userId = $request->input('userId');
            $notificationEnabled = $request->input('notificationEnabled');

            // Find the user
            $user = User::find($userId);

            if (!$user)
            {
                return response()->json(['error' => 'User not found'], 404);
            }

            // Update the notification status for the user
            $user->update(['notification_on_off' => $notificationEnabled]);

            return back()->with('success', 'Notification status updated successfully');
        }


    /**
     * Display the specified resource.
     */
    public function show(String  $id)
    {
            $user=User::find($id);

            //post notification data query in PostNotification models
            $postNotifications = $this->post->post_notification_data($id);

            return view('users.message_show', compact('user', 'postNotifications'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
