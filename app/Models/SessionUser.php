<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionUser extends Model
{
    protected $table = 'session_users';
    protected $fillable = ['user_id', 'token', 'refresh_token', 'token_expired', 'refresh_token_expired', 'created_at', 'updated_at'];
}
