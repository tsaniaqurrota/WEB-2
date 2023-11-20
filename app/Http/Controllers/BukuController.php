<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Buku; 

use App\Models\Gallery; 

use Intervention\Image\Facades\Image;


// use Image;



class BukuController extends Controller
{
    public function index() {
        $batas = 7;
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
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail' => 'required|image|mimes:jpeg,jpg,png|max:2048' 
        ]); 

        $fileName = time() . '_' . $request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
    
        Image::make(storage_path().'/app/public/uploads/'.$fileName)
        ->fit(240, 320)
        ->save();
    
        $buku = Buku::create([
            'judul'     => $request->judul,
            'foto'      => $fileName,
            'penulis'   => $request->penulis,
            'harga'     => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
            'filename'  => $fileName,
            'filepath'  => '/storage/' . $filePath

            ]);

        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $key => $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads', $fileName, 'public');
        
                    $gallery = Gallery::create([
                        'nama_galeri' => $fileName,
                        'path' => '/storage/' . $filePath,
                        'foto' => $fileName,
                        'buku_id' => $buku->id
                    ]);
                }
        }
        return redirect('/buku')->with('pesan', 'Data buku berhasil disimpan');
    }
    
    

    public function edit($id) {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id) {
        $buku = Buku::find($id);

        if ($request->file('thumbnail')) {
            $request->validate([
                'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
            ]);

            $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
            
            Image::make(storage_path().'/app/public/uploads/'.$fileName)->fit(140,220)->save();
        }

        if ($request->file('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/'. $filePath,
                    'foto' => $fileName,
                    'buku_id' => $id
                ]);
            }
        }
        
        if ($request->file('thumbnail')) {
            $buku->update([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'harga' => $request->harga,
                'tgl_terbit' => $request->tgl_terbit,
                'filename' => $fileName,
                'filepath' => '/storage/' . $filePath
            ]);
        } else {
            if ($buku->filepath) {
                $buku->update([
                    'judul' => $request->judul,
                    'penulis' => $request->penulis,
                    'harga' => $request->harga,
                    'tgl_terbit' => $request->tgl_terbit,
                    'filename' => $buku->filename,
                    'filepath' => $buku->filepath
                ]);
            }
        }
        return redirect('/buku')->with('pesan', 'Data buku berhasil diubah');
    }

    public function destroy($id) {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('pesan','Data buku berhasil di hapus');
    }

    public function deleteGallery($id) {
        $gallery = Gallery::findOrFail($id);

        $gallery->delete();

        return redirect()->back();
    }

    public function galbuku($judul) {
        $buku = Buku::where('judul', $judul)->first();
        $galeri = $buku->galleries()->orderBy('id','desc')->paginate(6);
        return view('buku.detail', compact('buku', 'galeri'));
    }
    

}