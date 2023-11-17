<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $guarded = [];

    public function getLoginUsers($email)
    {
        $users = new UsersModel;
        $data = $users
        ->select('users.*', 'users.id as userId', 'role.*', 'kelompok.id as kelompok_id', 'kelompok.kelompok')
        ->leftJoin('role', 'role.role_id', '=', 'users.role_id')
        ->leftjoin('kelompok', 'kelompok.id', '=', 'users.kelompok_id')
        ->where('users.email', $email)
        ->first();
        return $data;
    }

    public function getListUserSuperAdmin()
    {
        $users = new UsersModel();
        $data = $users
        ->select('users.*', 'users.id as userId', 'role.*', 'kelompok.id as kelompok_id', 'kelompok.kelompok')
        ->join('role', 'role.role_id', '=', 'users.role_id')
        ->join('kelompok', 'kelompok.id', '=', 'users.kelompok_id')
        ->get();
        return $data;
    }

    public function getListUserAdminKelompok($kelompok_id)
    {
        $users = new UsersModel();
        $data = $users
        ->select('users.*', 'users.id as userId', 'role.*', 'kelompok.id as kelompok_id', 'kelompok.kelompok')
        ->join('role', 'role.role_id', '=', 'users.role_id')
        ->join('kelompok', 'kelompok.id', '=', 'users.kelompok_id')
        ->where('kelompok_id', $kelompok_id)
        ->get();
        return $data;
    }

    public function getUserById($userId)
    {
        $users = new UsersModel();
        $data = $users
        ->where('id', $userId)
        ->first();
        return $data;
    }

    public function checkEmailExists($email)
    {
        $users = new UsersModel();
        $data = $users
        ->where('email', $email)
        ->first();
        return $data;
    }
}
