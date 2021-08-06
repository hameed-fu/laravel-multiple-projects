<?php 


namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class UserExport implements FromCollection, WithHeadings,ShouldAutoSize,WithEvents
{
    public function collection()
    {

        // return \DB::table("users")
        //             ->select('id','name','email','role')
        //             ->get();
        
        $data = [
            ['','timetraker','manual'],
            ['Sameer','3','3'],
            ['Hameed','2','33'],
        ];
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Mamber',
            'day1',
            ' ',
            
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:Z1'; // 
                
                $styleArray = [
                    'font' => [
                        'bold' => true,
                        'family'=> 'verdana'
                    ],
                    'alignment' => [
                        // 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        // 'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'EB2B02']
                    ]
                ];
                $merge = [
                    'font' => [
                        'bold' => true,
                        'family'=> 'verdana'
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'  => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                    'color' => ['rgb'   => 'red'],
                    
                ];
              
                // $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->mergeCells('A1:A2')->getStyle('B2:C2')->applyFromArray($merge);
                $event->sheet->getDelegate()->mergeCells('B1:C1')->getStyle('A1:C1')->applyFromArray($merge);

            },
            
        ];
        
        
        
        
       
        
        
    }

}