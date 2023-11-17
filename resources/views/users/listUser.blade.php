@extends('layout.index')
@section('TitleTab', 'List User')
@section('Title', 'List User')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item">Users</li>
<li class="breadcrumb-item active">List Users</li>
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Kelompok</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $no = 1;
                            foreach($userList as $list){
                                $button = "
                                <a href='".route('formUpdateUser', ['id' => $list->userId])."' class='btn btn-outline-warning' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit'>
                                    <i class='fas fa-pencil-alt'></i>
                                </a> |
                                <a href='".route('prosesDeleteUser', ['id' => $list->userId])."' class='btn btn-outline-danger' data-toggle='tooltip' data-placement='top' title='' data-original-title='Hapus'>
                                    <i class='fas fa-trash-alt'></i>
                                </a>";
                                echo "
                                    <tr>
                                        <td class='text-center'>$no</td>
                                        <td>$list->username</td>
                                        <td>$list->email</td>
                                        <td>$list->role_name</td>
                                        <td>$list->kelompok</td>
                                        <td class='text-center'>$button</td>
                                    </tr>
                                ";
                                $no++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection