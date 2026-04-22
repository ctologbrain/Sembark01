<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreshortUrlRequest;
use App\Http\Requests\UpdateshortUrlRequest;
use App\Models\shortUrl;
use Auth;
use App\Export\ShortUrlExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ShortUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companyId = Auth::user()->client_id;
        $shortUrl=shortUrl::with('UserDetails');
        if ($request->month) {

            if ($request->month == 'thismonth') {
                $shortUrl = $shortUrl->whereMonth('created_at', now()->month);
            }
    
            if ($request->month == 'lastmonth') {
                $shortUrl = $shortUrl->whereMonth('created_at', now()->subMonth()->month);
            }
    
            if ($request->month == 'lastweek') {
                $shortUrl = $shortUrl->whereBetween('created_at', [
                    now()->subWeek()->startOfWeek(),
                    now()->subWeek()->endOfWeek()
                ]);
            }
    
            if ($request->month == 'today') {
                $shortUrl = $shortUrl->whereDate('created_at', today());
            }
        }
        
       
        if($request->submit=='download')
        {
            return   Excel::download(new ShortUrlExport($shortUrl->get()), 'ShortUrlExport.xlsx');
        }
        $data['data']= $shortUrl->paginate(2)->withQueryString();
        $data['title']='Short ULRs';
        return view('ShortUrl')->with($data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreshortUrlRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(shortUrl $shortUrl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(shortUrl $shortUrl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateshortUrlRequest $request, shortUrl $shortUrl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(shortUrl $shortUrl)
    {
        //
    }
}
