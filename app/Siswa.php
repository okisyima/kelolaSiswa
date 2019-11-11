<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'jenis_kelamin',
        'agama',
        'alamat',
        'avatar',
        'user_id'
    ];

    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('images/saitama.png');
        }
        return asset('images/' . $this->avatar);
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai'])->withTimestamps();
    }

    public function ratarata()
    {
        $total          = 0;
        $jumlahMapel    = 0;

        foreach ($this->mapel as $mapel) {

            $total += $mapel->pivot->nilai;
            $jumlahMapel++;
        }

        return $jumlahMapel == 0 ? 0 : round($total / $jumlahMapel);
    }

    public function namaLengkap()
    {
        return $this->nama_depan . ' ' . $this->nama_belakang;
    }
}
