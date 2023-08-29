<?php

namespace App\Exports;

use App\Models\BookingRoom;
use App\Models\Company;
use App\Models\Division;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($request)
    {
        $this->request = $request;
    }



    public function view(): View
    {
        $division = $this->request->query('division');
        $companyId = Auth::user()->company_id;

        $company = Company::where('id', $companyId)->first();
        $division = Division::where('id', $division)->first();



        return view('admin.report-booking.excel.export-template', [
            'company' => $company,
            'division' => $division,

        ]);
    }
}
