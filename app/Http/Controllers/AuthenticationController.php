<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Alerts;
use App\Models\UsersModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function loginPage(Request $request)
	{
        $alert = $request->session()->get('alert');
        $alertSuccess = $request->session()->get('alertSuccess');
        $alertInfo = $request->session()->get('alertInfo');
        if($alertSuccess){
            $showalert = Alerts::alertSuccess($alertSuccess);
        }else if($alertInfo){
            $showalert = Alerts::alertinfo($alertInfo);
        }else{
            $showalert = Alerts::alertDanger($alert);
        }

        $passing = array(
            'alert' => $showalert,
        );

		return view('auth.login', $passing);
	}

    public function loginProcess(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $today = date("Y-m-d");
        $email = $request->email;
        $password  = $request->password;
        $userLogin = UsersModel::getLoginUsers($email);
        if($userLogin){ //apakah email tersebut ada atau tidak
            $pass = $userLogin->password;
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = array(
                    'userId' => $userLogin->userId,
                    'username' => $userLogin->username,
                    'email' => $userLogin->email,
                    'password' => $userLogin->password,
                    'role_id' => $userLogin->role_id,
                    'role_name' => $userLogin->role_name,
                    'kelompok_id' => $userLogin->kelompok_id,
                    'isLogin' => TRUE
                );
                $request->session()->put($ses_data);
                return redirect('dashboardApp');
            }else{
                return redirect()->back()->with('alert', 'Password Salah');
            }
        }else{
            return redirect('/login')->with('alert', 'Email Belum Terdaftar');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}
