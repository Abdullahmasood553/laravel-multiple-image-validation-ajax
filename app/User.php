<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Constants\GlobalConstants;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class User extends Authenticatable

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

    public static function sendVerificationEmail($user)
    {
        $activate_code = bcrypt(Str::random(15));
        $user->remember_token = $activate_code;
        $user->save();
        $viewData['full_name'] = $user->fname . ' ' . $user->lname;
        $email_code = $user->remember_token;
        $viewData['link'] = asset('/verify_account?token=') . $email_code;
        Mail::send('layouts.email_templates.email_verification', $viewData, function ($m) use ($user) {
            $m->from(env('FROM_EMAIL'), env('APP_NAME'));
            $m->to($user->email, $user->fname)->subject('Confirmation Email');
        });
    }


    public static function requestPasswordReset($email)
    {
        self::generatePasswordResetToken($email);
        return self::sendPasswordResetEmail($email);
    }


    public static function generatePasswordResetToken($email)
    {
        if (User::where('email', $email)->first()) {
            DB::table('password_resets')->where('email', $email)->delete();
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => bcrypt(Str::random(15)),
                'created_at' => Carbon::now()
            ]);
        }
    }



    public static function sendPasswordResetEmail($email)
    {
        $token = DB::table('password_resets')->where('email', $email)->first();
        if ($token) {
            $user = DB::table('users')->where('email', $email)->select('fname', 'lname', 'email')->first();
            $viewData['full_name'] = $user->fname . ' ' . $user->lname;
            $viewData['link'] = asset('/reset_password?token=') . $token->token;
            Mail::send('templates.forgot_password', $viewData, function ($m) use ($user) {
                $m->from(env('FROM_EMAIL'), env('APP_NAME'));
                $m->to($user->email, $user->fname)->subject('Forget Password Email');
            });
            return true;
        }
        return false;
    }

    public static function searchProfile($country) {

      $profile = DB::table('users')->get();
        if($country && $country != GlobalConstants::ALL) {
            $profile = $profile->where('users.country', $country);
            dd($profile);   
        }
        return $profile;
    }
}
