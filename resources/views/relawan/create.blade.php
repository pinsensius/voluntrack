<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('relawan.store') }}" method="POST">

                            @csrf
                            <input type="text" class="form-control" name="event_id" value="{{$event->id_event}}" hidden>
                            <input type="text" class="form-control" name="user_id" value="{{auth()->id()}}" hidden>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    name="nama_lengkap" value="{{ old('nama_lengkap') ?? auth()->user()->username }}"
                                    placeholder="Masukkan Nama Lengkap">

                                <!-- error message untuk title -->
                                @error('nama_lengkap')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nomor Telepon</label>
                                <input type="text" max="14"
                                    class="form-control @error('nomor_telepon') is-invalid @enderror"
                                    name="nomor_telepon" value="{{ old('nomor_telepon') ?? auth()->user()->no_hp }}"
                                    placeholder="Masukkan Nomor Telepon">

                                @error('nomor_telepon')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nama Organisasi</label>
                                <input type="text" class="form-control @error('nama_organisasi') is-invalid @enderror"
                                    name="nama_organisasi" value="{{ old('nama_organisasi') }}"
                                    placeholder="Masukkan Nama Organisasi">

                                @error('nama_organisasi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label class="font-weight-bold">NIK</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                    value="{{ old('nik') ?? auth()->user()->nik}}" placeholder="Masukkan NIK">

                                @error('nik')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('event_detail');
        CKEDITOR.replace('requirement');
    </script>
</body>

</html>