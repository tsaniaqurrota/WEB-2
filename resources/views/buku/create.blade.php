<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Buku</title>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

        
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
    </head>
    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Buku') }}
            </h2>
        </x-slot>

        <div class="container mt-5 p-5 rounded-lg shadow-md bg-white block text-m font-medium leading-6 text-gray-900">
            <form method="post" action="{{ route('buku.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul">
                </div>
                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga">
                </div>
                <div class="form-group">
                    <label for="tgl_terbit">Tgl. Terbit</label>
                    <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" placeholder="dd/mm/yyyy">
                </div>
                
                <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
            </div>

            <div class="mt-2">
                
    <label for="gallery">Gallery</label>
    <div><a href="javascript:void(0);" id="tambah" onclick="addFileInput()" class="btn btn-outline-primary mb-2"><i class="fas fa-plus"></i></a>
</div>
    <div class="mt-2" id="fileinput_wrapper">
    </div>
    <script type="text/javascript">
        function addFileInput() {
            var div = document.getElementById('fileinput_wrapper');
            var input = document.createElement('input');
            input.type = 'file';
            input.name = 'gallery[]';
            input.className = 'form-control-file';
            input.style.marginBottom = '5px';
            div.appendChild(input);
        }
    </script>
</div>

<div class="d-flex justify-content-end mt-4">
<button type="submit" class="btn btn-primary mr-2">Simpan</button>
                <a href="/buku" class="btn btn-secondary">Batal</a>
</div>
                
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    </body>
    </html>
</x-app-layout>