<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getClient=Client::withCount('UserDetails as TotalClient')->withCount('ShortUrlDetails as TotalShorUrl')->withSum('ShortUrlDetails as totalHit','No_of_hits')->paginate(2);
      
        $data['data']=$getClient;
        $data['title']='Clients';
        return view('clientList')->with($data);
    }
    public function clientList()
    {
        $getClient=Client::withCount('UserDetails as TotalClient')->withCount('ShortUrlDetails as TotalShorUrl')->withSum('ShortUrlDetails as totalHit','No_of_hits')->paginate(2);
         $data['data']=$getClient;
        $data['title']='Clients';
        return view('clientDetails')->with($data);
    }
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']='Add Company';
        return view('Addclient')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $data = $request->validated();
        Client::create($data);
        return redirect('client')->with('success', 'Client added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
