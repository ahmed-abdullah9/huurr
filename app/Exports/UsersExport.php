<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
class UsersExport implements FromCollection,WithHeadings,ShouldAutoSize,WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $limit;
    protected $type;


    public function __construct(int $limit,string $type)
    {
        $this->limits = $limit;
        $this->type = $type;
    }

    public function collection()
    {
        $users=User::select('user_nicename','email','user_role','created_at')->get();
        if ($this->limits!=0){
            $users=$users->limit($this->limits);
        }
        if ($this->type!='false'){
            $users=$users->where('user_role',$this->type);
        }
        return $users;
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'User Role',
            'Registration Date',
        ];
    }
    public function startCell(): string
    {
        return 'B2';
    }

}
