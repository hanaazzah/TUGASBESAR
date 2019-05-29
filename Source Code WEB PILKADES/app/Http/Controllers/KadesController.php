<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kades;
use Carbon\Carbon;
use Image;
use File;

class KadesController extends Controller
{
    public $path;
    public $dimensions;

    public function __construct()
    {
        $this->middleware('auth');
        //DEFINISIKAN PATH
        $this->path = storage_path('app/public/images');
        //DEFINISIKAN DIMENSI
        $this->dimensions = ['245', '300', '500'];
    }

    public function add()
    {
        return view('kades.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            "no_urut" => "required",
            "name" => "required",
            "visi" => "required",
            "misi" => "required",
            "image" => "required|image|mimes:jpg,png,jpeg"
        ]);

        //JIKA FOLDERNYA BELUM ADA
        if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path);
        }

        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('image');
        //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        Image::make($file)->save($this->path . '/' . $fileName);

        //LOOPING ARRAY DIMENSI YANG DI-INGINKAN
        //YANG TELAH DIDEFINISIKAN PADA CONSTRUCTOR
        foreach ($this->dimensions as $row) {
            //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY
            $canvas = Image::canvas($row, $row);
            //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY
            //DENGAN MEMPERTAHANKAN RATIO
            $resizeImage  = Image::make($file)->resize($row, $row, function ($constraint) {
                $constraint->aspectRatio();
            });

            //CEK JIKA FOLDERNYA BELUM ADA
            if (!File::isDirectory($this->path . '/' . $row)) {
                //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
                File::makeDirectory($this->path . '/' . $row);
            }

            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            $canvas->insert($resizeImage, 'center');
            //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
            $canvas->save($this->path . '/' . $row . '/' . $fileName);
        }

        $kades = Kades::create([
            "no_urut" => $request->no_urut,
            "name" => $request->name,
            "visi" => $request->visi,
            "misi" => $request->misi,
            "image" => $fileName,
            "path" => $this->path
        ]);

        if ($kades) {
            return redirect('/home')->with(['success' => 'Data Berhasil Di Simpan']);
        }
        return redirect('/home')->with(['error' => 'Data Gagal Di Simpan']);
    }

    public function delete($id)
    {
        $kades = Kades::find($id);
        $kades->delete();
        if ($kades) {
            return redirect('/home')->with(['success' => 'Data Berhasil Di Hapus']);
        }
        return redirect('/home')->with(['error' => 'Data Gagal Di Hapus']);
    }
}
