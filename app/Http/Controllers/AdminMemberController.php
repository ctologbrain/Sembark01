<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\User;
use App\Models\Client;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Export\AdminExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
class AdminMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companyId = Auth::user()->client_id;
        $getAdmin=User::with('RoleDetails','CompanyDetails')->where('client_id',$companyId)->paginate(2);
        if($request->submit=='download')
        {
            return   Excel::download(new AdminExport($getAdmin), 'AdminExport.xlsx');
        }
        $data['data']=$getAdmin;
        $data['title']='Admin List';
        return view('AdminAndmemberList')->with($data);
    }
      public function AdminAndMemberListDisplay(Request $request)
    {
        $companyId = Auth::user()->client_id;
        $getAdmin=User::with('RoleDetails','CompanyDetails')->where('client_id',$companyId)->paginate(2);
        if($request->submit=='download')
        {
            return   Excel::download(new AdminExport($getAdmin), 'AdminExport.xlsx');
        }
        $data['data']=$getAdmin;
        $data['title']='Admin List';
        return view('AdminAndmemberListDisplay')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']='Add Admin';
        $companyId = Auth::user()->client_id;
        $data['client']=Client::where('id',$companyId)->get();
        $data['role']=Role::where('id','!=',1)->get();
        return view('AddAdminAndMember')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
       
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['required'],
            'role' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'client_id'=>$request->company,
            'role_id'=>$request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect('AdminAndMemberList')->with('success', 'Admin added successfully!');
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
