<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Daftar Buku</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

        @if(count($data_buku))
            <div class="alert alert-success">
                Ditemukan <strong>{{count($data_buku)}}</strong> data dengan kata: <strong>{{ $cari }}</strong>
            </div>
        @else
            <div class="alert alert-warning">
                <h4>Data {{ $cari }} tidak ditemukan</h4>
                <a href="/buku" class="btn btn-warning">Kembali</a>
            </div>
        @endif

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    </head>
    <body>
    <x-slot name="header">
        <h2 class="font-semibold font-sans text-center text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="container bg-white mt-10 mb-4 p-4 rounded-lg shadow-md">
        <div class="flex justify-between items-center">
        @if (Auth::check() && Auth::user()->role == 'admin')
            <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</i></a>
        @endif
            <form action="{{ route('buku.search') }}" method="get" class="flex items-center">
                <input type="text" name="kata" class="form-control rounded" placeholder="Cari..." style="width: 100%; display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">       
                <a href="{{ route('buku.search') }}" class="ml-2 btn btn-primary"><i class="fas fa-search"></i></a>
            </form>
        </div>  

        <table class="table table-striped">
            <thead class="text-center">
                <tr>
                    <th>id</th>
                    <th>Cover</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tgl. Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @foreach($data_buku as $buku)
                <tr>
                    </div>
                    <td class="text-center">{{ $buku->id }}</td>
                    <td class="text-center">
                    @if ($buku->filepath)
                    <div class="flex items-center justify-center">
                        <img class="h-20 w-14 object-fit-contain"
                        src="{{ asset($buku->filepath) }}"
                        alt=""
                        />
                    @endif
                    </td>

                    <td class="text-center">{{ $buku->judul }}</td>
                    <td class="text-center">{{ $buku->penulis }}</td>
                    <td class="text-center">{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                    <td class="row justify-content-center align-items-center">
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <form class="col-4 align-items-center" action="{{ route('buku.destroy', $buku->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                            <button onclick="return confirm('Apakah yakin ingin menghapus data?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <form class="col-4 align-items-center" action="{{ route('buku.edit', $buku->id) }}" method="GET">
                        @csrf
                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        </form>
                    @endif

                    <form class="col-3 align-items-center">
                            @csrf
                            <a href="{{ route('buku.detail', $buku->judul) }}" class="btn btn-sm btn-warning"><i class="fas fa-eye fa-inverse"></i> </a>
                    </form>
                    </td>

                </tr>
            @endforeach
            </tbody>        
        </table>

        <div>{{ $data_buku->links() }}</div>

    </div>
         

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>
    </html>
</x-app-layout>