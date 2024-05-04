<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Contacts;

class CreditController extends Controller
{
    protected $credits;
    protected $contacts;
    protected $data_view;

    public function __construct(
        Credit $credits,
        Contacts $contacts,

    )
    {
        $this->credits   = $credits->where('is_active', 1)->get()->first()->toArray();
        $this->contacts  = $contacts->get()->first()->toArray();
        $this->data_view = [
            'credits' => $this->credits,
            'contact' => $this->contacts
        ];
    }

    public function credit_terms()
    {
        $this->data_view['title'] = 'Syarat Kredit';
        return view('public.credits.credit_terms', $this->data_view);
    }

    public function credit_simulation()
    {
        $this->data_view['title'] = 'Simulasi Kredit';
        return view('public.credits.credit_simulation', $this->data_view);
    }
}
