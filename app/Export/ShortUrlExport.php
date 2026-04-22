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
class ShortUrlExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $offcie;
    function __construct($getShortUrl){
       $this->ShortUrl=$getShortUrl;

    }
    public function collection()
    {
       
        $i=0;
       foreach($this->ShortUrl as $value)
       {
        
        $i++;
        if(isset($value->UserDetails->name))
        {
            $user=$value->UserDetails->name;
        }
        else{
            $user='';
        }
        
            
            
        $bucket[] =array(
            "SR" =>$i,
            "ShortUrls" =>$value->url,
            "hits" =>$value->No_of_hits,
            "createdby" =>$user,
            "createdOn" =>date('d M y',strtotime($value->created_at)),
           
            

        );
       }
        return collect($bucket);
    }
    public function headings(): array
    {
        return [
            'SN',
            'Short Urls	',
            'Hits',
            'Created By',
            'Created On',
            
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