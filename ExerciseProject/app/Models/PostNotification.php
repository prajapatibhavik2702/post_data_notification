<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'message',
        'expiration_date',
        'user_id',
    ];

    protected $dates = [
        'expiration_date',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'post_notification_user', 'post_notification_id', 'user_id');
    }


    public function getX($search) {

        $notifications = DB::table('post_notifications')
        ->where('type', 'LIKE', '%' . $search . '%')
        ->orWhere('message', 'LIKE', '%' . $search . '%')
        ->orWhere('expiration_date', 'LIKE', '%' . $search . '%')
        ->get();

        return $notifications;
     }
}
