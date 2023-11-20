<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $buku->judul }}</title>

    <link href="{{ asset('dist/css/lightbox.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mt-5 p-5 rounded-lg shadow-md bg-white">
        <h1 class="text-3xl font-bold mb-5">{{ $buku->judul }}</h1>

        <div class="row">
            <div class="col-md-6 mb-4">
                @if ($buku->filepath)
                    <div class="mb-3">
                        <img class="img-fluid" src="{{ asset($buku->filepath) }}" alt="{{ $buku->judul }}">
                    </div>
                @endif

                <div class="row">
                    <div class="col-2 font-weight-bold">Penulis </div>
                    <div class="col-6">: {{ $buku->penulis }}</div>
                </div>

                <div class="row">
                    <div class="col-2 font-weight-bold">Terbit </div>
                    <div class="col-6">: {{ $buku->tgl_terbit }}</div>
                </div>

                <div class="row">
                    <div class="col-2 font-weight-bold">Harga </div>
                    <div class="col-6">: {{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <h1 class="mb-3"><i class="fas fa-images fa-2x"></i></h1>
                @if (count($galeri) > 0)
                    <div class="row">
                        @foreach ($galeri as $data)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card object-cover shadow rounded-lg">
                                    <a href="{{ asset('storage/uploads/'.$data->foto) }}" data-lightbox="image-1" data-title="{{ $data->keterangan }}">
                                        <img src="{{ asset('storage/uploads/'.$data->foto) }}"
                                            class="card-img-top w-100 h-40 object-cover rounded-lg mb-2"
                                            alt="{{ $data->nama_galeri }}">
                                    </a>
                                    <div class="card-body">
                                        <p class="card-text text-sm font-semibold text-center">{{ $data->nama_galeri }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h1 class="font-semibold mt-3 text-center" style="color: grey; font-size: 20px;">Tidak ada galeri yang tersedia</h1>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="/buku" class="btn btn-outline-primary font-semibold" style="border-width: 3px;">Kunjungi SooPedia</a>
        </div>
    </div>

    <script src="{{ asset('dist/js/lightbox-plus-jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
