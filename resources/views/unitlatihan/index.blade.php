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
					<h3 class="card-label ml-2 mb-0"><b>{{ $title ?? __('Unit Latihan') }}</b></h3>
                    <div class="card-toolbar ml-auto">
                        <a href="javascript:void(0)" onclick="onRefresh()" class="btn btn-md btn-warning mr-1">
                            <i class="bi bi-arrow-clockwise"></i>
                            Refresh
                        </a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalAddUl" style="background-color: #0D2A0D; color: white;" onclick="$('#unit_name').val('');" class="btn btn-md">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Tambah
                        </a>
                    </div>
				</div>
			</div>
			<div class="card-body">
                <div class="">
                    <table class="table table-striped table-row-bordered gy-5 gs-7 tdFirstCenter" id="tableUnitLatihan">
                        <thead>
                            <tr class="fw-bolder text-muted">
                                <th class="ps-4" width="20">No</th>
                                <th>ID Unit Latihan</th>
                                <th>Nama Unit Latihan</th>
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
    <div class="modal fade" id="modalAddUl" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="javascript:onSave()" method="post" id="formUnit" name="formUnit" autocomplete="off" enctype="multipart/form-data" data-tour-add="1-ini adalah form anda" data-tour-update="4-mulai edit data">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Tambah Unit Latihan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="unit_latihan_id" id="unit_latihan_id">

                        <div class="fv-row mb-2">
                            <label for="" class="form-label" style="font-size: 15px">Nama Unit Latihan <span class="text-danger">*</span></label>
                            <input type="text" id="unit_name" name="unit_name" class="form-control form-control-solid" required placeholder="Silahkan isi Nama Unit Latihan" />
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

    @include('unitlatihan.javascript')
@endsection


{{-- @push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush --}}
