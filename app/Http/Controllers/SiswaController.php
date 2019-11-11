<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('temukan')) {
            $siswa = \App\Siswa::where('nama_depan', 'LIKE', '%' . $request->temukan . '%')->get();
        } else {
            $siswa = \App\Siswa::all();
        }

        // $siswa = \App\Siswa::all();
        return view('siswa.index', ['siswa' => $siswa]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_depan'    => 'required|string|min:3',
            'email'         => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'alamat'        => 'required',
            'avatar'        => 'mimes:jpg,jpeg,png|max:2048'

        ]);
        // insert to table user
        $user = new \App\User;
        $user->role     = 'siswa';
        $user->name     = $request->nama_depan . ' ' . $request->nama_belakang;
        $user->email    = $request->email;
        $user->password = bcrypt('siswa');
        $user->remember_token = str_random(60);
        $user->save();

        // insert to table siswa
        $request->request->add(['user_id' => $user->id]);
        $siswa = \App\Siswa::create($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data Berhasil Ditambah!');
    }

    public function edit($id)
    {
        $siswa = \App\Siswa::find($id);
        return view('siswa.edit', ['siswa' => $siswa]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $siswa = \App\Siswa::find($id);
        $siswa->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        return redirect('/siswa')->with('sukses', 'Data Berhasil Diupdate!');
    }

    public function delete($id)
    {
        $siswa = \App\Siswa::find($id);
        $siswa->delete();

        return redirect('/siswa')->with('sukses', 'Data Berhasil Didelete!');
    }

    public function profile($id)
    {
        $siswa = \App\Siswa::find($id);
        $matapel = \App\Mapel::all();
        // dd($mapel);

        // menyiapkan data untuk chart
        $categories = [];
        $dataNilai  = [];

        foreach ($matapel as $mp) {
            if ($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()) {

                $categories[]   = $mp->nama;
                $dataNilai[]    = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }
        }
        // dd($categories);
        // dd($dataNilai);

        return view('siswa.profile', [
            'siswa'         => $siswa,
            'matapel'       => $matapel,
            'categories'    => $categories,
            'dataNilai'     => $dataNilai
        ]);
    }

    public function addNilai(Request $request, $id)
    {
        // dd($request->all());
        $siswa = \App\Siswa::find($id);
        if ($siswa->mapel()->where('mapel_id', $request->mapel)->exists()) {
            return redirect('siswa/' . $id . '/profile')->with('gagal', 'Mata pelajaran tersebut sudah ada!');
        }
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);

        return redirect('siswa/' . $id . '/profile')->with('sukses', 'Data niali ditambahkan!');
    }

    public function deleteNilai($idsiswa, $idmapel)
    {
        $siswa = \App\Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);

        return redirect()->back()->with('sukses', 'Data Nilai Terhapus!');
    }
}
