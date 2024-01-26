@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1> --}}

    <div id="panel-main" class="col-xl-12" >
		<div class="card card-bordered" style="border-top-radius: 15px !important">
			<div class="card-header pt-4 pb-4">
				<div class="card-title d-flex align-items-center mb-0 ml-3 mr-3">
					<span class="card-icon">
						<i class="fas fa-table"></i>
					</span>
					<h3 class="card-label ml-2 mb-0"><b>{{ $title ?? __('User') }}</b></h3>
                    <div class="card-toolbar ml-auto">
                        <a href="javascript:void(0)" onclick="onRefresh()" class="btn btn-md btn-warning mr-1">
                            <i class="bi bi-arrow-clockwise"></i>
                            Refresh
                        </a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalAddUser" style="background-color: #0D2A0D; color: white;" onclick="onCreate()" class="btn btn-md">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Tambah
                        </a>
                    </div>
				</div>
			</div>
			<div class="card-body">
                <div class="">
                    <table class="table table-striped table-row-bordered gy-5 gs-7 tdFirstCenter" id="tableUser">
                        <thead>
                            <tr class="fw-bolder text-muted">
                                <th class="ps-4" width="20">No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="javascript:onSave()" method="post" id="formUser" name="formUser" autocomplete="off" enctype="multipart/form-data" data-tour-add="1-ini adalah form anda" data-tour-update="4-mulai edit data">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">

                        <div class="fv-row mb-2">
                            <label for="" class="form-label" style="font-size: 15px">Name<span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control form-control-solid" required placeholder="Silahkan isi Nama User" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label" style="font-size: 15px">Last Name<span class="text-danger">*</span></label>
                            <input type="text" id="last_name" name="last_name" class="form-control form-control-solid" required placeholder="Silahkan isi Last Name User" />
                        </div>
                        <div class="fv-row mb-2">
                            <label for="" class="form-label" style="font-size: 15px">Email<span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control form-control-solid" required placeholder="Silahkan isi Email User" />
                        </div>
                        <div class="fv-row mb-2" id="formInputPass">
                            <label for="" class="form-label" style="font-size: 15px">Password<span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" class="form-control form-control-solid" required placeholder="Silahkan isi Password User" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="background-color: #0D2A0D; color: white;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('basic.javascript')
    {{-- <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <a href="{{ route('basic.create') }}" class="btn btn-primary mb-3">New User</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('basic.edit', $user->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <form action="{{ route('basic.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }} --}}
@endsection

