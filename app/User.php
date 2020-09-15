<?php

namespace App;

use App\Notifications\CustomEmailVerifyNotification;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//implements mustverifyemail to use verification of email when user creates an account also in Auth::routes(['verify'=>true]);
class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orders(){
        return $this->hasMany('App\Order');
    }
    public function likedposts(){
        return $this->belongsToMany('TCG\Voyager\Models\Post','liked_posts');//passing the pivot table name as second argument because the default pivot name that laravel searches is post_user table
    }
    public function wishlistproducts(){
        return $this->belongsToMany('App\Product','wishlist_pivots');//passing the pivot table name as second argument because the default pivot name that laravel searches is post_user table
    }

    //thisportion below is brought from vendor/laravel/src/illuminate/auth/password/canresetpassword.php for custom reset emails so we are simply overriding the notification
       /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
      //  $this->notify(new ResetPasswordNotification($token)); we override this default with our own
      $this->notify(new CustomResetPasswordNotification($token));
    }



 //thisportion below is brought from vendor/laravel/src/illuminate/auth/mustverifyemail.php for custom verification emails so we are simply overriding the notification
    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        //$this->notify(new VerifyEmail);
        $this->notify(new CustomEmailVerifyNotification);
    }


}
