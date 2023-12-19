<x-app-layout>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ 'My favorite' }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

    @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
</head>

    <x-slot name="header">
        <h2 class="font-semibold font-sans text-center text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Top 10 Buku Populer') }}
        </h2>
    </x-slot>
    

    <div class="container bg-white mt-10 mb-4 p-4 rounded-lg shadow-md">

    <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="text-center">
                    <th class="py-2 px-4 border-b">Peringkat</th>
                    <th class="py-2 px-4 border-b">Cover</th>
                    <th class="py-2 px-4 border-b">Judul</th>
                    <th class="py-2 px-4 border-b">Rating</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data_buku as $index => $buku)
                    <tr class="text-center">
                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($buku->filepath)
                                <img class="h-20 w-14 object-fit-contain mx-auto"
                                    src="{{ asset($buku->filepath) }}"
                                    alt="{{ $buku->judul }}"
                                />
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">{{ $buku->judul }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format($buku->averageRate(), 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="py-2 px-4 border-b" colspan="4" class="text-center font-semibold mt-3" style="color: grey; font-size: 20px;">Tidak ada buku populer.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</x-app-layout>
