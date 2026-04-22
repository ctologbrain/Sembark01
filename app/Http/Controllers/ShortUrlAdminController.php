<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreshortUrlRequest;
use App\Http\Requests\UpdateshortUrlRequest;
use App\Models\shortUrl;
use App\Export\ShortUrlExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class ShortUrlAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        $companyId = Auth::user()->client_id;
        $roleId = Auth::user()->role_id;
        $shortUrl=shortUrl::with('UserDetails')->where('company_id',$companyId);
       
         if($roleId==3)
         {
            $userId=Auth::id();
            $shortUrl = $shortUrl->where('user_id',$userId);
         }
         if($roleId==2)
         {
            $userId=Auth::id();
            $shortUrl = $shortUrl->where('company_id',$companyId);
         }
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
        return view('ShortUrlAdmin')->with($data);
    }
    public function shoturlDetails(Request $request)
    {
        $companyId = Auth::user()->client_id;
         $roleId = Auth::user()->role_id;
        $shortUrl=shortUrl::with('UserDetails');
         if($roleId==3)
         {
            $userId=Auth::id();
            $shortUrl = $shortUrl->where('user_id',$userId);
         }
          if($roleId==2)
         {
            $userId=Auth::id();
            $shortUrl = $shortUrl->where('company_id',$companyId);
         }
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
        return view('ShortUrlDetails')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']='Genrate ULRs';
        return view('genrateurl')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreshortUrlRequest $request)
    {
        $UserId = Auth::id();
        $companyId = Auth::user()->client_id;
        $url = shortUrl::create([
            'url' => $request->url,
            'user_id' =>$UserId,
            'company_id'=>$companyId,
           
        ]);
        return redirect('ShortUrlAdmin')->with('success', 'Url added successfully!');
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
    public function  hitsUrl(Request $request)
    {
         $geturl=shortUrl::where('id',$request->id)->first();
         if($geturl->No_of_hits =='')
        {
            $numberofHist=1;
        }
        else
        {
            $numberofHist=$geturl->No_of_hits+1;
        }
       
        shortUrl::where('id',$request->id)->update(['No_of_hits'=>$numberofHist]);

    }
}
