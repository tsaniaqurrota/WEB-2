<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Buku</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Buku') }}
            </h2>
        </x-slot>

        <div class="container mt-5 p-5 rounded-lg shadow-md bg-white block text-m font-medium leading-6 text-gray-900">
            <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
                </div>

                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}">
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}">
                </div>

                <div class="form-group">
                    <label for="tgl_terbit">Tgl. Terbit</label>
                    <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $buku->tgl_terbit }}">
                </div>

                <div>
                    <label for="thumbnail">Thumbnail</label>
                    <div class="mt-2">
                        <input type="file" name="thumbnail" id="thumbnail">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="gallery">Gallery</label>
                    <div><a href="javascript:void(0);" id="tambah" onclick="addFileInput()" class="btn btn-outline-primary mb-2"><i class="fas fa-plus"></i></a></div>
                    <div class="mt-2" id="fileinput_wrapper"></div>
                    <script type="text/javascript">
                        function addFileInput() {
    var div = document.getElementById('fileinput_wrapper');
    var input = document.createElement('input');
    input.type = 'file';
    input.name = 'gallery[]';
    input.className = 'block w-full';
    input.style.marginBottom = '5px';
    div.appendChild(input);
}

                    </script>
                </div>

                <div class="container-fluid">
                    <div class="row align-items-start mr-3">
                        @foreach($buku->galleries()->get() as $gallery)
                            <div class="col-3 px-0 position-relative mr-3">
                                <img src="{{ asset($gallery->path) }}" alt="" width="400"/>
                                <a href="{{ route('buku.deleteGallery', $gallery->id) }}" class="btn btn-secondary" style="position: absolute; top: 10px; right: 10px;"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button onclick="return confirm('Apakah ingin menyimpan perubahan?')" type="submit" class="btn btn-primary mr-2">Simpan Perubahan</button>
                    <a href="/buku" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    </body>
    </html>
</x-app-layout>
