<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function getRegister()
    {
    	return view('pages.register');
    }

    public function getLogin()
    {
        return view('pages.login');
    }

    public function postRegister(Request $request)
    {
    	$this->validate($request, [
    		'ime' => 'required',
    		'familiya' => 'required',
    		'password' => 'required|min:8|confirmed',
    		'password_confirmation' => 'required',
    		'email' => 'required|unique:users|email|max:225',
    		'nomer' => 'required',
    		'grad' => 'required',
    		'adres' => 'required',
    	]);

    	User::create([
    		'ime' => $request->input('ime'),
    		'familiya' => $request->input('familiya'),
    		'password' => bcrypt($request->input('password')),
    		'email' => $request->input('email'),
    		'nomer' => $request->input('nomer'),
    		'grad' => $request->input('grad'),
    		'adres' => $request->input('adres'),
    		'postal_code' => $request->input('pcode'),
    	]);

    	return redirect()->back()
    		->with($request->session()->flash('acc-info', 'Успешна регистрация, веднага може да използвате профила си.'));
    }

    public function postLogin(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required',
    		'password' => 'required',
    	]);

    	if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
			return redirect()->back()->with($request->session()->flash('acc-error', 'Неуспешен вход.'));
		}

		return redirect('/profile/'.Auth::user()->id)->with($request->session()->flash('acc-info', 'Успешно влезнахте в системата.'));
    }

    public function getProfile($id)
    {
        return view('pages.show-profile');
    }

    public function updateProfile(Request $request, $id)
    {
        User::where('id', $id)
            ->update([
                'ime' => $request->input('ime'),
                'familiya' => $request->input('familiya'),
                'nomer' => $request->input('nomer'),
                'grad' => $request->input('grad'),
                'adres' => $request->input('adres'),
                'postal_code' => $request->input('pcode'),
            ]);

        return redirect('/profile/'.Auth::user()->id)->with($request->session()->flash('acc-info', 'Успешно обновихте профила си.'));
    }

    public function changePassProfile(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        User::where('id', $id)
            ->update([
                'password' => bcrypt($request->input('password')),
            ]);
            
        return redirect()->back()->with($request->session()->flash('acc-info', 'Успешно обновихте паролата си.'));
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('/');
    }

    public function getAdminLogin()
    {
    	return view('admin.login');
    }

    public function postAdminLogin(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required',
    		'password' => 'required',
    	]);

    	if ($request->input('email') == 'manchev@avtoparts.bg') {

    		if (!Auth::attempt($request->only(['email', 'password']))) {
				return redirect()->back()->with($request->session()->flash('acc-error', 'Неуспешен вход.'));
			}

			return redirect('/admin/dashboard')->with($request->session()->flash('acc-info', 'Успешно влезнахте в системата.'));
    	
    	}
    	else {

    		return redirect()->back()->with($request->session()->flash('acc-error', 'Вие не сте удостоверен за тази секция.'));
    	
    	}
    }
}
