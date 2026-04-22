<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$title}}
        </h2>
    </x-slot>
  <form method="get">
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  
                  
                   <a href="{{url('AddAdminAndMember')}}" class="btn btn-default" style="float:right">Invite </a> 
                   <button type="submit" style="float:right" name="submit" value="download">Download &nbsp;| &nbsp;</button>
                </div>
                @if(session('success'))
    <div style="color:green; font-weight:bold;">
        {{ session('success') }}
    </div>
@endif
                <table border="1" cellpadding="8" cellspacing="0" style="width:100%;border:1px solid #000;text-align: center;">
    <thead>
      <tr>
      <th>#</th>
        <th>Name</th>
        <th>email</th>
        <th>Company</th>
        <th>Role</th>
       
      </tr>
    </thead>
    <tbody>
    @php
        if(request()->get('page')!="" && request()->get('page') >1){
            $i = (intval(request()->get('page'))-1)*10;
        }
        else{
            $i = 0;
        }
        @endphp
        @foreach($data as  $value)
        @php
        $i++;
        @endphp
      <tr>
        <td>{{$i}}</td>
        <td>{{$value->name}}</td>
        <td>{{$value->email}}</td>
        <td>@if(isset($value->CompanyDetails->name)){{$value->CompanyDetails->name}}@endif</td>
        <td>@if(isset($value->RoleDetails->name)){{$value->RoleDetails->name}}@endif</td>
       
     
      </tr>
      @endforeach
      
    </tbody>
  </table>
 showing  {{ $data->lastItem() }} of total {{ $data->total() }}  <a href="{{url('AdminAndMemberListDisplay')}}" class="btn btn-primary">View All</a>
               </div>
            </div>
        </div>
    </div>
    </form>
</x-app-layout>