<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Alerts;
use App\Models\RoleModel;
use App\Models\UsersModel;
use App\Models\KelompokModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function getListUsers(Request $request)
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

        $role = $request->session()->get('role_id');
        $kelompok = $request->session()->get('kelompok_id');
        if($role == 7){
		    $userList = UsersModel::getListUserSuperAdmin();
        }else{
            $userList = UsersModel::getListUserAdminKelompok($kelompok);
        }

		$data = array(
            'alert' => $showalert,
			'userList' => $userList,
        ); 

		return view('Users.listUser', $data);
	}

    public function formAddUser(Request $request)
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

        $role = $request->session()->get('role_id');
        if($role == 7){
            $roleList = RoleModel::get();
        }else{
            $roleList = RoleModel::where('role_id', '!=', 7)->get();
        }
        $kelompokList = KelompokModel::get();

        $data = array(
            'alert' => $showalert,
            'roleList' => $roleList,
            'kelompokList' => $kelompokList,
        );
        return view('Users.formAddUser', $data);
    }

    public function prosesAddUser(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); //set you countary name from below timezone list
        $password = Hash::make($request->password);
        $checkUser = UsersModel::checkEmailExists($request->email);

        if($checkUser == 1){
            return redirect('users/formAdd')->with('alert', 'Email Already Taken');
        }elseif($request->password != $request->confirm_password){
            return redirect('users/formAdd')->with('alert', 'Please Enter Same Password');
        }else{
            $data = array(
                'username' => $request->username,
                'email' => $request->email,
                'password' => $password,
                'role_id' => $request->role_id,
                'kelompok_id' => $request->kelompok_id,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
            );
            UsersModel::insert($data);

            return redirect('users/list')->with('alertSuccess', 'User Successfully Added');
        }
    }

    public function formUpdateUser(Request $request)
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

        $user = UsersModel::getUserById($request->id);
        $kelompokList = KelompokModel::get();
        $role = $request->session()->get('role_id');
        if($role == 7){
            $roleList = RoleModel::get();
        }else{
            $roleList = RoleModel::where('role_id', '!=', 7)->get();
        }

        $data = array(
            'alert' => $showalert,
            'user' => $user,
            'roleList' => $roleList,
            'kelompokList' => $kelompokList,
        );
        return view('Users.formUpdateUser', $data);
    }
    
    public function prosesUpdateUser(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); //set you countary name from below timezone list
        $id = $request->userId;
        $oldPassword = $request->oldPassword;
        $password = Hash::make($request->password);
        $checkUser = UsersModel::where('email', $request->email)->count();
        if($checkUser > 1){
            return redirect('users/formUpdate/'.$id)->with('alert', 'Email Already Taken');
        }elseif($request->password != $request->confirm_password){
            return redirect('users/formUpdate/'.$id)->with('alert', 'Please Enter Same Password');
        }else{
            $data = array(
                'username' => $request->username,
                'email' => $request->email,
                'password' => $password,
                'role_id' => $request->role_id,
                'kelompok_id' => $request->kelompok_id,
                'updated_at' => date("Y-m-d h:i:s"),
            );
            UsersModel::where('id', $id)->update($data);

            return redirect('users/list')->with('alertSuccess', 'User Successfully Updated');
        }
    }

    public function prosesDeleteUser(Request $request)
    {
        UsersModel::where('id', $request->id)->delete();
        return redirect()->back()->with('alertSuccess', 'Useer Has Been Deleted');
    }

    function checkEmailExists(Request $request)
    {
        $id = $request->id;
        $email = $request->email;

        if(empty($userId)){
            $result = UsersModel::check_email_exists($email);
        }else{
            $result = UsersModel::check_email_exists($email, $id);
        }

        dd($result);
        if(empty($result)){
            echo("true");
        }else{
            echo("false");
        }
    }
}
