<?php

namespace App\Http\Controllers\Api;

use App\Http\Middleware\VerifyCaptcha;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
class UserResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $this->middleware(VerifyCaptcha::class);
        $this->validate($request, $this->rules(), $this->validationErrorMessages());
        $user = User::where('phone', $request->phone)->first();
        if(!$user){
            return $this->response->error('用户不存在', 422);
        }
        $this->resetPassword($user, $request->getPassword());
        return $this->response->item($user, new UserTransformer())->setStatusCode(201);
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'phone' => 'required|phone_number',
            'password' => 'required|min:6',
            'verification_key' => 'required',
            'verification_code' => 'required',
        ];
    }
}
