<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    public $timestamps = false;
    
    protected $fillable = [
        'firstName',
        'lastName',
        'middleName',
        'birthday',
        'age',
        'sex',
        'sector',
        'barangay',
        'city',
        'province',
        'region',
        'orgName',
        'phoneNumber',
        'license',
        'email',
        'password',
        'profileImage',
        'accountVerified',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'rememberToken',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    /* protected $casts = [
        'emailVerified' => 'datetime',
    ]; */

    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return ! is_null($this->emailVerified);
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'emailVerified' => $this->freshTimestamp()->setTimezone('Asia/Manila'),
        ])->save();
    }

    public function posts(){
      return $this->hasMany('App\Models\Post');
    }


}
