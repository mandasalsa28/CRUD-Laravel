<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePekerjaRequest;

class PekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', [
            'pekerja' => pekerja::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePekerjaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['no_tlp'] = $request->no_tlp;

        Mahasiswa::create($data);
        return redirect('/')->with('success', 'Data Pekerja Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pekerja  $pekerja
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerja $pekerja)
    {
        return view('show', [
            'pekerja' => $pekerja
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pekerja  $pekerja
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerja $pekerja)
    {
        return view('edit', [
            'pekerja' => $pekerja,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePekerjaRequest  $request
     * @param  \App\Models\Pekerja  $pekerja
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePekerjaRequest $request, Pekerja $pekerja)
    {
        $rules = [
            'name' => 'required|max:255',
            'no_tlp' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Pekerja::where('id', $pekerja->id)->update($validatedData);

        return redirect('/')->with('success', 'Employee Has ben Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerja  $pekerja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Pekerja::destroy($pekerja->id);
        // return redirect('/')->with('success', 'Data Pekerja Berhasil Dihapus!');
        pekerja::find($id)->delete();
        return response()->json(['success'=>'Data Pekerja Berhasil Dihapus!']);
    }
}