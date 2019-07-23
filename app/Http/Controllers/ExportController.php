<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportController extends Controller implements FromCollection, WithHeadings
{
    public function collection(){
        $user = new User();
        $exportExcel = $user->join('division','division_id','=','division.id')
        ->select('user.full_name','user.username','user.email','division.division_name','division.manager_name')
        ->get();
        $export = array();
        foreach ($exportExcel as $row) {
            $export[] = array(
                '0' => $row->full_name,
                '1' => $row->username,
                '2' => $row->email,
                '3' => $row->division_name,
                '4' => $row->manager_name,
            );
        }
        return (collect($export));
    }
    public function headings(): array{
        return [
            'Họ Tên',
            'Tài khoản',
            'Email',
            'Bộ phận',
            'Quản lý',
        ];
    }
    //Export excel file
    public function exportExcel(){
        return Excel::download(new exportController(), 'dsnv.xlsx');
    }
}
