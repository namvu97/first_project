<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkCount;

class ExportController extends Controller implements FromCollection, WithHeadings
{

    public function collection()
    {
        $user = new User();
        $exportExcel = $user->join('division', 'division_id', '=', 'division.id')
                ->select('user.full_name', 'user.username', 'user.email', 'division.division_name', 'division.manager_name')->get();
        $export = array();
        return ($exportExcel);
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

    public function exportExcel()
    {
        return Excel::download(new exportController(), 'dsnv.xlsx');
    }
}
