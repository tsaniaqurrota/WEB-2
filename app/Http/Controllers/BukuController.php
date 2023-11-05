<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Buku; 


class BukuController extends Controller
{
    public function index() {
        $batas = 5;
        $data_buku = Buku::orderBy('id', 'asc')->paginate($batas);
        $jumlah_data = Buku::count();
        $total_harga = Buku::sum('harga');
    
        // Menghitung nomor urut berdasarkan halaman saat ini
        $no = $batas * ($data_buku->currentPage() - 1);
    
        return view('buku.index', compact('data_buku', 'no', 'jumlah_data', 'total_harga'));
    }

    public function search(Request $request) {
        $batas = 8;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like',"%".$cari."%")->orwhere('penulis','like',"%".$cari."%")
        ->paginate($batas);
        $jumlah_data = Buku::count();
        $total_harga = Buku::sum('harga');
    
        // Menghitung nomor urut berdasarkan halaman saat ini
        $no = $batas * ($data_buku->currentPage() - 1);
    
        return view('buku.search', compact('jumlah_data', 'data_buku', 'no', 'cari'));
    }

    public function create() {
        return view('buku.create');
    }

    public function store(Request $request) {
        
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = date('Y-m-d', strtotime($request->tgl_terbit));

        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ]); 

        $buku->save(); 

    
        return redirect('/buku')->with('pesan', 'Data buku berhasil disimpan');
    }
    

    public function edit($id) {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id) {
        $buku = Buku::find($id);
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        return redirect('/buku')->with('pesan','Data buku berhasil di ubah');
    }

    public function destroy($id) {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('pesan','Data buku berhasil di hapus');
    }
}