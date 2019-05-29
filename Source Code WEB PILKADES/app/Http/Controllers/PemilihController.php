<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemilih;

class PemilihController extends Controller
{

    protected $pemilih;

    public function __construct()
    {
        $this->middleware('auth');
        $this->pemilih = new Pemilih;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemilih = $this->pemilih->get();
        return view('pemilih.index', compact('pemilih'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pemilih.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "nik" => "required",
            "gender" => "required",
        ]);

        $pemilih = $this->pemilih->create($request->all());
        if ($pemilih) {
            return redirect('/pemilih')->with(['success' => 'Data Berhasil Di Simpan']);
        }
        return redirect('/pemilih')->with(['success' => 'Data Berhasil Di Simpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemilih = $this->pemilih->findOrFail($id)->get();
        return view('pemilih.show', compact('pemilih'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pemilih = $this->pemilih->findOrFail($id)->get();
        return view('pemilih.edit', compact('pemilih'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "nik" => "required",
            "gender" => "required",
        ]);

        $pemilih = $this->pemilih->find($id);
        $pemilih->update($request);
        if ($pemilih) {
            return redirect('/pemilih')->with(['success' => 'Data Berhasil Di Update']);
        }
        return redirect('/pemilih')->with(['success' => 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemilih = $this->pemilih->delete($id);
        if ($pemilih) {
            return redirect('/pemilih')->with(['success' => 'Data Berhasil Di Hapus']);
        }
        return redirect('/pemilih')->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
