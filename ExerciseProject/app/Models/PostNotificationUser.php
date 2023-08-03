<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostNotificationUser extends Model
{
    use HasFactory;

    public function userview($id) {

        $post_notification_data = DB::table('post_notification_user')
        ->where('post_notification_id', $id)
        ->get();

        return $post_notification_data;
     }

     public function readnotification($userId, $notification) {

          // Ensure the notification belongs to the specified user_id
          $notificationData = DB::table('post_notification_user')
                                ->where('post_notification_id', $notification)
                                ->where('user_id', $userId)
                                ->first();

        return $notificationData;
     }

     public function post_notification_data($id)
     {
          $messages = DB::table('post_notification_user')
                        ->where('user_id', $id)
                        ->get();

          $notificationIds = $messages->pluck('post_notification_id')->toArray();

          // Fetch the related post_notifications based on the extracted IDs
          $postNotifications = DB::table('post_notifications')
                                ->whereIn('id', $notificationIds)
                                ->get();

          return $postNotifications;
     }
}
