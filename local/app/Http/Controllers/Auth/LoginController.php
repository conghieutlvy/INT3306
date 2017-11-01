<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\sinhvien;
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
    }
	
	 /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('login');
    }
	
	public function postLogin(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'username'   => 'required',
        'password' => 'required'
      ]);
	
      if($request->option == 'pdt'){
		  if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
			// if successful, then redirect to their intended location
			return redirect()->route('pdt.home');
		  }
		  // if unsuccessful, then redirect back to the login with the form data
		  return redirect()->back()->withInput($request->only('username', 'remember'));
	  }else{
		  $sv = sinhvien::where('username','=',$request->username)->value('Kích hoạt');
		  if($sv){
			// if successful, then redirect to their intended location
			$result = $this->svlogin($request->username, $request->password);
			if($result == 302){
                Auth::guard('sinhvien')->attempt(['username'=>$request->username],$request->remember);
				return redirect()->route('sv.home');
			}
		  	else{
				return redirect()->back()->withInput($request->only('username', 'remember'));
			}
		  }else{
			  // if unsuccessful, then redirect back to the login with the form data
			  return redirect()->back()->withInput($request->only('username', 'remember'));
		  }
	  }
    }
	
	/**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
	
	/**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
		if(Auth::guard('sinhvien')->check())
        	return Auth::guard('sinhvien');
		return Auth::guard('web');
    }
	
	
	
	protected function svlogin($username,$password){
		$url = 'http://ctmail.vnu.edu.vn/webmail/src/redirect.php';
		$data = array(
		'login_username' => $username, 'secretkey' => $password, 'js_autodetect_results'=>1, 'just_logged_in' => 1);
		//$postString = http_build_query($data, '', '&');
		$ch = curl_init( $url );
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);   
		$result = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);    
		//echo($httpcode."\n\n\n\n".$result);
		return $httpcode;
	}
}
