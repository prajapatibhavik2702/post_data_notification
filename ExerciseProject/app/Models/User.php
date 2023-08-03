<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'notification_switch',
        'phone_number',
        'notification_on_off',

    ];

    public static $rules = [
        // Your existing rules...
        'phone_number' => 'nullable|regex:/^[0-9]{10,}$/',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function unreadNotifications()
    {
        return $this->hasMany(Notification::class)->where('read', false);
    }

    public function postNotifications()
    {
        return $this->belongsToMany(PostNotification::class, 'post_notification_user', 'user_id', 'post_notification_id');
    }

    public function store_user_data($request) {

        // Get all users whose notification_on_off value is 0
        $usersToNotify = User::select('notification_on_off', 0)->get();

        // Create a new notification instance for the current user
        $notification = new Notification([
            'message' => $request->message,
            'read' => false, // Set read status to false (0)
        ]);

        // Loop through users with notification_on_off set to 0 and create a notification for each of them
        foreach ($usersToNotify as $user) {
            $user->notifications()->save(new Notification([
                'message' => $request->message,
                'read' => false, // Set read status to false (0)
            ]));
        }

      return true;
   }


}
