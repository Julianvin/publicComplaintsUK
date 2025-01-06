<?php
namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExcel implements FromCollection, WithHeadings, WithMapping
{
    protected $date;
    protected $province;

    public function __construct($date = null, $province = null)
    {
        $this->date = $date;
        $this->province = $province;
    }

    public function collection()
    {
        // Jika ada tanggal, filter data berdasarkan tanggal
        if ($this->date) {
            return Report::whereDate('created_at', $this->date)->get();
        }

        // Jika ada province, filter data berdasarkan province
        if ($this->province) {
            return Report::where('province', $this->province)->get();
        }

        // Mengambil semua data jika tidak ada filter
        return Report::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Description',
            'Type',
            'Province',
            'Regency',
            'Subdistrict',
            'Village',
            'Voting Count',
            'Viewers',
            'Image',
            'Statement',
            'Created At',
        ];
    }

    public function map($report): array
    {
        $votingCount = $report->voting ? count(json_decode($report->voting)) : 0;

        return [
            $report->id,
            $report->user_id,
            $report->description,
            $report->type,
            $report->province,
            $report->regency,
            $report->subdistrict,
            $report->village,
            $votingCount,
            $report->viewers,
            $report->image,
            $report->statement ? 'Yes' : 'No',
            \Carbon\Carbon::parse($report->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY'),
        ];
    }
}

