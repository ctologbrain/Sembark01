<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Export\AdminExport;
use Maatwebsite\Excel\Facades\Excel;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
        $getAdmin=User::with('RoleDetails','CompanyDetails')->paginate(2);
        if($request->submit=='download')
        {
             $getAdmin = User::with('RoleDetails','CompanyDetails')->get(); 
            return   Excel::download(new AdminExport($getAdmin), 'AdminExport.xlsx');
        }
        $data['data']=$getAdmin;
        $data['title']='Admin List';
        return view('AdminList')->with($data);
    }
    public function AdminListDisplay(Request $request)
    {
    
        $getAdmin=User::with('RoleDetails','CompanyDetails')->paginate(2);
        if($request->submit=='download')
        {
            $getAdmin = User::with('RoleDetails','CompanyDetails')->get(); 
            return   Excel::download(new AdminExport($getAdmin), 'AdminExport.xlsx');
        }
        $data['data']=$getAdmin;
        $data['title']='Admin List';
        return view('AdminListDisplay')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']='Add Admin';
        $data['client']=Client::get();
        return view('AddAdmin')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request): RedirectResponse
    {
       
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'company' => ['required'],
        //     'role' => ['required'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', Rules\Password::defaults()],
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'client_id'=>$request->company,
            'role_id'=>$request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect('AdminList')->with('success', 'Admin added successfully!');
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
