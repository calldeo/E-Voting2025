<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PemasukanExport implements FromView
{
    protected $pemasukan;
    protected $year;

    public function __construct($pemasukan, $year)
    {
        $this->pemasukan = $pemasukan;
        $this->year = $year;
    }

    public function view(): View
    {
        return view('pemasukan.excel', [
            'pemasukan' => $this->pemasukan,
            'year' => $this->year,
        ]);
    }
}

