<?php
namespace App\Export;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\CompanySetup\PincodeMaster;
use DB;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
class AdminExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $offcie;
    function __construct($getAdmin){
       $this->adminData=$getAdmin;

    }
    public function collection()
    {
       
        $i=0;
       foreach($this->adminData as $value)
       {
        
        $i++;
        if(isset($value->CompanyDetails->name))
        {
            $companyName=$value->CompanyDetails->name;
        }
        else{
            $companyName='';
        }
        if(isset($value->RoleDetails->name))
        {
            $role=$value->RoleDetails->name;
        }
        else{
            $role='';
        }
            
            
        $bucket[] =array(
            "SR" =>$i,
            "Name" => $value->name,
            "email" =>$value->email,
            "company" =>$companyName,
            "role" =>$role,
           
            

        );
       }
        return collect($bucket);
    }
    public function headings(): array
    {
        return [
            'SN',
            'Name',
            'Email',
            'Company',
            'Role',
            
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
  
                $event->sheet->getStyle('A1:E1')->applyFromArray([
                    'font' => [
                        'name' => 'Arial',
                        'size' => 10,
                        'bold' => true,
                        'color' => [
                            'argb' => 'FFFFFFFF'
                         ]
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => [
                            'argb' => 'FF37474f'
                        ]
                    ]
                ]);

                $event->sheet->getStyle('A:E')->applyFromArray([
                    'font' => [
                        'name' => 'Arial',
                        'size' => 10,
                        ]
                    ]);
                     
                    $i =0;
                    $a=1;
                     
                        $event->sheet->setCellValue('A1', "SN");
                        for($i=2; $i <= $event->sheet->getHighestRow(); $i++){
                            $m =$i-1;
                            $event->sheet->setCellValue('A'.$i, $m);
                        }
                    
                      
            }
            
        ];
    }

}