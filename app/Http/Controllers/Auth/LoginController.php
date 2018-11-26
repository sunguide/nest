<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InternalException;
use App\Http\Controllers\Controller;
use \Illuminate\Http\Request as Request;
use App\Services\UserService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        if(!Str::contains(url()->full(), 'passport.')){
            $this->redirectTo = url()->full();
        }else if(!Str::contains(url()->previous(), 'passport.')){
            $this->redirectTo = url()->previous();
        }else if(session('redirect_url')){
            $this->redirectTo = session('redirect_url');
        }

        if(!session('redirect_url') && $this->redirectTo != '/'){
            session(['redirect_url' => $this->redirectTo]);
        }
        if($this->redirectTo == '/'){
            $this->redirectTo = route('www.root');
        }
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver, UserService $userService)
    {
        $socialite = Socialite::driver($driver)->stateless()->user();
        if($socialite){
            $user = $userService->getUserBySocialite($driver, $socialite->id);
            if(!$user){
                $user = $userService->createByOAuth($driver, $socialite);
            }
            if($user){
                $this->guard()->login($user, true);
                return redirect(route('www.root'));
            }
        }
        throw new InternalException("认证失败", "认证失败，请稍后重试");
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        //记录登录后重定向地址
        $referer = '';
        session(['redirect_url' => $referer?:url()->previous()]);
        $data = [];
        return view('auth.login', $data);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return session('redirect_url')?redirect(session('redirect_url')):back();
    }


    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut($request){
        return back();
    }


}
