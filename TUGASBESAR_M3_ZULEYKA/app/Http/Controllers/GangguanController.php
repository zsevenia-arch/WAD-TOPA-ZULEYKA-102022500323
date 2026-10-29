<?php

namespace App\Http\Controllers;

use App\Models\Gangguan;
use Illuminate\Http\Request;

class GangguanController extends Controller
{
    public function index()
    {
        $gangguan = Gangguan::all();

        return view('gangguan.index', compact('gangguan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_gangguan' => 'required',
            'kategori' => 'required',
            'tingkat_prioritas' => 'required',
        ]);

        Gangguan::create($request->only([
            'jenis_gangguan',
            'kategori',
            'tingkat_prioritas',
        ]));

        return redirect('/gangguan')
            ->with('success', 'Gangguan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = Gangguan::findOrFail($id);
        $gangguan = Gangguan::all();

        return view('gangguan.index', compact('gangguan', 'item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_gangguan' => 'required',
            'kategori' => 'required',
            'tingkat_prioritas' => 'required',
        ]);

        $item = Gangguan::findOrFail($id);

        $item->update($request->only([
            'jenis_gangguan',
            'kategori',
            'tingkat_prioritas',
        ]));

        return redirect('/gangguan')
            ->with('success', 'Gangguan berhasil diubah!');
    }

    public function destroy($id)
    {
        Gangguan::findOrFail($id)->delete();

        return redirect('/gangguan')
            ->with('success', 'Gangguan berhasil dihapus!');
    }
}
