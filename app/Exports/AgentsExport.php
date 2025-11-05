<?php

namespace App\Exports;

use App\Models\Agent;
use Maatwebsite\Excel\Concerns\FromCollection;

class AgentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //  return Agent::select(['user_id','address','speciality','years_of_experience','deals_closed'])
        //                 ->orderBy('deals_closed'); 

        return Agent::all();
    }
}
