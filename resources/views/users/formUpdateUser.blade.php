@extends('layout.index')
@section('TitleTab', 'Form Update User')
@section('Title', 'Form Update User')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item">Users</li>
<li class="breadcrumb-item active">Form Update Users</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <?php if($alert): ?>
        <div class="card m-b-30">
            <div class="card-body">
                <?= $alert ?>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Form Update User</h4>
                <form class="form-horizontal auth-form my-4" action="<?= route('prosesUpdateUser') ?>" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="username">Full Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-id-card"></i></span>
                                    </div>
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Full Name" value="{{ $user->username }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Role</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <select id="role_id" name="role_id" class="form-control" required>
                                        <option value="">Please Select Option</option>
                                        <?php
                                            foreach($roleList as $list){
                                                if($user->role_id == $list->role_id){
                                                    $sel = 'selected';
                                                }else{
                                                    $sel = '';
                                                }
                                                echo "<option value='$list->role_id' $sel>$list->role_name</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                    </div>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kelompok</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <select id="kelompok_id" name="kelompok_id" class="form-control" required>
                                        <option value="">Please Select Option</option>
                                        <?php
                                            foreach($kelompokList as $list){
                                                if($list->id == $user->kelompok_id)
                                                {
                                                    $sel = 'selected';
                                                }else{
                                                    $sel = '';
                                                }
                                                echo "<option value='$list->id' $sel>$list->kelompok</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="userId" name="userId" class="form-control" value="{{ $user->id }}" hidden>
                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-paper-plane"></i>&nbsp;&nbsp;Submit
                                </button>
                            </div> <!--end form-grop-->
                        </div>
                    </div>
                </form><!--end form-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection