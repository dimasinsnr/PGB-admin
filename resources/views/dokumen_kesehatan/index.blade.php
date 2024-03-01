@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1> --}}

    <div id="panel-main" class="col-xl-12">
        <div class="card card-bordered" style="border-top-radius: 15px !important">
            <div class="card-header pt-4 pb-4">
                <div class="card-title d-flex align-items-center mb-0 ml-3 mr-3">
                    <span class="card-icon">
                        <i class="fas fa-table"></i>
                    </span>
                    <h3 class="card-label ml-2 mb-0"><b>{{ $title ?? __('Dokumen Kesehatan') }}</b></h3>
                    {{-- <div class="card-toolbar ml-auto">
                        <a href="javascript:void(0)" onclick="onRefresh()" class="btn btn-md btn-warning mr-1">
                            <i class="bi bi-arrow-clockwise"></i>
                            Refresh
                        </a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalAddDatakesehatan" style="background-color: #0D2A0D; color: white;" onclick="onCreate()" class="btn btn-md">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Tambah
                        </a>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="javascript:generateDoc()" class="d-flex w-100 flex-column" id="form-dokumen">
                        <div class="row p-5">
                            <div class="col-6">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Anggota <span class="text-danger">*</span></label>
                                <select id="anggota_id" name="anggota_id"
                                    class="custom-select form-control form-control-solid anggota_id">
                                    <option selected value="">-Pilih Anggota-</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Periode Pemeriksaan <span class="text-danger">*</span></label>
                                <select id="periode_pemeriksaan" name="periode_pemeriksaan" class="custom-select form-control form-control-solid">
                                    <option selected="" disabled="">- Pilih Periode -</option>
                                    <option value="3">Triwulan</option>
                                    <option value="6">Semester</option>
                                    <option value="12">Satu Tahun</option>
                                    <option value="24">Dua Tahun</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-end p-5">
                            <button role="button" type="button" class="btn btn-md btn-warning mr-2" onclick="clear()">Reset</button>
                            <button type="submit" class="btn btn-md btn-success">
                                Preview
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-bordered preview-el mt-4" style="border-top-radius: 15px !important">
            <div class="card-header pt-4 pb-4 d-flex align-items-center 100">
                <div class="card-title d-flex align-items-center mb-0 ml-3 mr-3">
                    <h3 class="card-label ml-2 mb-0"><b>{{ __('Preview') }}</b></h3>
                </div>
                <div class="card-toolbar ml-auto">
                    <button class="btn btn-primary" onclick="generateDoc()">Reset</button>
                    <button class="btn btn-success" onclick="downloadPDF()">Export</button>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="" id="preview">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dokumen_kesehatan.javascript')
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
