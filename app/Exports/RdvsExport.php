<?php

namespace App\Exports;
use App\Rdv;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RdvsExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('exports.rdvs', [
            'rdvs' => Rdv::all()
        ]);
    }
}

/*
use App\Rdv;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
//Formatting the fonts and sizes
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

// use Illuminate\Support\Facades\DB; //MongoDB


class RdvsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
	
    public function collection()
    {
        return Rdv::all();
        // return Rdv::where('statut', '=', 'Rendez-vous brut');
    }
	


    public function headings(): array
    {
        return [
            '_id',
            'Name',
            'Email',
            'Created at',
            'Updated at'
        ];
    }
	
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}

*/