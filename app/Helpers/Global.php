<?php

use App\Siswa;
use App\Guru;

function rank5besar()
{
    $siswa = Siswa::all();
    $siswa->map(function ($sis) {
        $sis->ratarata = $sis->ratarata();
        return $sis;
    });
    $siswa = $siswa->sortByDesc('ratarata')->take(5);

    return $siswa;
}

function totalSiswa()
{
    return Siswa::count();
}

function totalGuru()
{
    return Guru::count();
}
