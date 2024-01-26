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
					<h3 class="card-label ml-2 mb-0"><b>{{ $title ?? __('Data Kesehatan Anggota PGB') }}</b></h3>
                    <div class="card-toolbar ml-auto">
                        <a href="javascript:void(0)" onclick="onRefresh()" class="btn btn-md btn-warning mr-1">
                            <i class="bi bi-arrow-clockwise"></i>
                            Refresh
                        </a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalAddDatakesehatan" style="background-color: #0D2A0D; color: white;" onclick="onCreate()" class="btn btn-md">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Tambah
                        </a>
                    </div>
				</div>
			</div>
			<div class="card-body">
                <div class="">
                    <table class="table table-striped table-row-bordered gy-5 gs-7 tdFirstCenter" id="tableDatakesehatan">
                        <thead>
                            <tr class="fw-bolder text-muted">
                                <th>Tanggal Tes</th>
                                <th>Nama Anggota</th>
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
    <div class="modal fade bd-example-modal-lg" id="modalAddDatakesehatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="width: 800px;">
                <form action="javascript:onSave()" method="post" id="formDatakesehatan" name="formDatakesehatan" autocomplete="off" enctype="multipart/form-data" data-tour-add="1-ini adalah form anda" data-tour-update="4-mulai edit data">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Tambah Data Kesehatan Anggota PGB</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="data_kesehatan_id" id="data_kesehatan_id">
                        <div class="row">
                            <div class="col-6">
                                <div class="fv-row mb-2">
                                    <label for="" class="form-label mb-1" style="font-size: 15px">Anggota <span class="text-danger">*</span></label>
                                    <select id="data_kesehatan_anggota_id" name="data_kesehatan_anggota_id" class="custom-select form-control form-control-solid">
                                    </select>
                                </div>
                                <div class="fv-row mb-2">
                                    <label for="" class="form-label mb-1" style="font-size: 15px">Jenis Pemeriksaan <span class="text-danger">*</span></label>
                                    <select id="data_kesehatan_jenis_periksa1" name="data_kesehatan_jenis_periksa1" class="custom-select form-control form-control-solid">
                                        <option selected disabled>Pilih Jenis Pemeriksaan</option>
                                        <option value="tanda vital">Tanda Vital</option>
                                        <option value="gula darah">Gula Darah</option>
                                        <option value="kolestrol">Kolestrol</option>
                                        <option value="komponen fisik">Komponen Fisik</option>
                                        <option value="kebugaran jasmani">Kebugaran Jasmani</option>
                                        <option value="asam urat">Asam Urat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="fv-row mb-2">
                                    <label for="" class="form-label mb-1" style="font-size: 15px">Tanggal Pengambilan Data <span class="text-danger">*</span></label>
                                    <input type="date" id="data_kesehatan_pengambilan_tanggal" name="data_kesehatan_pengambilan_tanggal" class="form-control form-control-solid" required placeholder="Silahkan isi Tanggal Lahir Anggota PGB" />
                                </div>
                                <div class="fv-row mb-2">
                                    <label for="" class="form-label mb-1" style="font-size: 15px">Unit Pengecekan <span class="text-danger">*</span></label>
                                    <select id="data_kesehatan_unit_latihan_id" name="data_kesehatan_unit_latihan_id" class="custom-select form-control form-control-solid">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="formPlace">
                            <div id="formPeriksa">  
                                {{-- <div class="row">
                                    <div class="col-6">
                                        <div class="fv-row mb-2">
                                            <label for="" class="form-label mb-1" style="font-size: 15px">Systol Awal  <span class="text-danger">*</span></label>
                                            <input type="text" id="anggota_tempat_lahir" name="anggota_tempat_lahir" class="form-control form-control-solid" required placeholder="Systol Awal" />
                                        </div>
                                        <div class="fv-row mb-2">
                                            <label for="" class="form-label mb-1" style="font-size: 15px">Dyastol Awal  <span class="text-danger">*</span></label>
                                            <input type="text" id="anggota_tempat_lahir" name="anggota_tempat_lahir" class="form-control form-control-solid" required placeholder="Dyastol Awal" />
                                        </div>
                                        <div class="fv-row mb-2">
                                            <label for="" class="form-label mb-1" style="font-size: 15px">DNM Awal  <span class="text-danger">*</span></label>
                                            <input type="text" id="anggota_tempat_lahir" name="anggota_tempat_lahir" class="form-control form-control-solid" required placeholder="DNM Awal" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="fv-row mb-2">
                                            <label for="" class="form-label mb-1" style="font-size: 15px">Systol Pasca Latihan  <span class="text-danger">*</span></label>
                                            <input type="text" id="anggota_tempat_lahir" name="anggota_tempat_lahir" class="form-control form-control-solid" required placeholder="Systol Pasca Latihan" />
                                        </div>
                                        <div class="fv-row mb-2">
                                            <label for="" class="form-label mb-1" style="font-size: 15px">Dyastol Pasca Latihan  <span class="text-danger">*</span></label>
                                            <input type="text" id="anggota_tempat_lahir" name="anggota_tempat_lahir" class="form-control form-control-solid" required placeholder="Dyastol Pasca Latihan" />
                                        </div>
                                        <div class="fv-row mb-2">
                                            <label for="" class="form-label mb-1" style="font-size: 15px">DNM Pasca Latihan  <span class="text-danger">*</span></label>
                                            <input type="text" id="anggota_tempat_lahir" name="anggota_tempat_lahir" class="form-control form-control-solid" required placeholder="DNM Pasca Latihan" />
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" onclick="addPeriksa()">Tambah Data Lainnya</button>
                        <button type="submit" class="btn" style="background-color: #0D2A0D; color: white;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="detail_card" style="display: none" class="col-xl-12 mb-5" >
        <div class="d-flex align-items-center">
            <a href="javascript:void(0)" style="margin-bottom: 15px; background-color: white; color: black; border-radius: 10px;" onclick="onBack()" class="btn btn-md">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="ml-2" style="font-weight: bold">Detail Data <span id="backName"></span></h4>
        </div>
        
		<div class="card card-bordered" style="border-top-radius: 15px !important; border: 0; padding: 10px 20px;">
            <form id="detailAnggota" name="detailAnggota" autocomplete="off" enctype="multipart/form-data" data-tour-add="1-ini adalah form anda" data-tour-update="4-mulai edit data">
                <div class="card-body">
                    <input type="hidden" name="anggota_id" id="anggota_id">
                    <div class="row">
                        <div class="col-9">
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Nama Anggota </label>
                                <input type="text" id="anggota_nama" name="anggota_nama" class="form-control form-control-solid" required placeholder="Silahkan isi Nama Anggota PGB" disabled />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Unit Latihan </label>
                                {{-- <input type="text" id="unit_name" name="unit_name" class="form-control form-control-solid" required placeholder="Silahkan isi Nama Unit Latihan" /> --}}
                                <input type="text" id="unit_latihan_nama_detail" name="unit_latihan_nama" class="form-control form-control-solid" disabled />
                                {{-- </select> --}}
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Tempat Lahir  </label>
                                <input type="text" id="anggota_tempat_lahir" name="anggota_tempat_lahir" class="form-control form-control-solid" required placeholder="Silahkan isi Nama Unit Latihan" disabled />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Tanggal Lahir  </label>
                                <input type="date" id="anggota_tgl_lahir" name="anggota_tgl_lahir" class="form-control form-control-solid" required placeholder="Silahkan isi Nama Unit Latihan" disabled />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Jenis Kelamin </label>
                                <select id="anggota_jenis_kelamin" name="anggota_jenis_kelamin" class="custom-select form-control form-control-solid" disabled>
                                    <option selected>Open this select menu</option>
                                    <option value="1">Laki -laki</option>
                                    <option value="0">Perempuan</option>
                                </select>
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-0" style="font-size: 15px">Alamat Rumah </label>
                                <textarea name="anggota_alamat" class="form-control form-control-solid" id="anggota_alamat" cols="10" rows="5" required disabled></textarea>
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Jenis Kartu Identitas </label>
                                <input type="text" id="anggota_jenis_identitas" name="anggota_jenis_identitas" class="form-control form-control-solid" disabled />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Nomor Kartu Identitas </label>
                                <input type="text" id="anggota_no_identitas" name="anggota_no_identitas" class="form-control form-control-solid" required placeholder="Silahkan isi Nama Unit Latihan" disabled />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Jenis Pekerjaan </label>
                                <input type="text" id="anggota_jenis_pekerjaan" name="anggota_jenis_pekerjaan" class="form-control form-control-solid" required placeholder="Silahkan isi Nama Unit Latihan" disabled />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Email </label>
                                <input type="text" id="anggota_email" name="anggota_email" class="form-control form-control-solid" required placeholder="Silahkan isi Nama Unit Latihan" disabled />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">No HP </label>
                                <input type="text" id="anggota_no_hp" name="anggota_no_hp" class="form-control form-control-solid" required placeholder="Silahkan isi Nama Unit Latihan" disabled />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Golongan Darah </label>
                                <input type="text" id="anggota_gol_darah" name="anggota_gol_darah" class="form-control form-control-solid" disabled />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-0" style="font-size: 15px">Catatan Alergi </label>
                                <textarea name="anggota_catatan_alergi" class="form-control form-control-solid" id="anggota_catatan_alergi" cols="10" rows="5" required disabled></textarea>
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="required form-label mb-0">Riwayat Sakit / Operasi</label>
                                <textarea name="anggota_riwayat_sakit" class="form-control form-control-solid" id="anggota_riwayat_sakit" cols="10" rows="5" required disabled></textarea>
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Tanggal Mulai Latihan </label>
                                <input type="date" id="anggota_tanggal_mulai" name="anggota_tanggal_mulai" class="form-control form-control-solid" required placeholder="Silahkan isi Nama Unit Latihan" disabled />
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="image-input mt-2 w-100" id="kt_image_input_profile_detail" data-kt-image-input="false" style="height: 230px !important; background-image: url({{ asset('img/blank.png') }})">
                                <div class="image-input-wrapper w-100" id="photoPreviewDetail" style="height: 230px; background-image: url({{ asset('img/blank.png') }})"></div>
                                <a href="" target="_blank" id="downloadLink" class="downloadProfile btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-30px h-30px bg-body shadow download" data-kt-image-input-action="download" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Download Profile">
                                    <i class="bi bi-arrow-down"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('datakesehatan.javascript')
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
