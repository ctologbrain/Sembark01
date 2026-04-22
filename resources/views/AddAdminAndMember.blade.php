<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$title}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   
                 
                   <a href="{{url('AddAdminAndMember')}}" class="btn btn-default" style="float:right">Invite</a>
                </div>
                <form method="post" action="{{url('postAdminAndMember')}}">
                @csrf
                <table border="1" cellpadding="8" cellspacing="0" style="width:100%;border:1px solid #000;text-align: center;">
    <thead>
      <tr>
     
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Company Name</th>
        <th>Role</th>
       
      </tr>
    </thead>
    <tbody>
     <tr>
        <td><input type="text" name="name" value="{{ old('name') }}">
        <br>
        @error('name')
         <span style="color:red;">{{ $message }}</span>
        @enderror
    </td>
    <td>
      <input type="text" name="email">
      <br>
        @error('email')
         <span style="color:red;">{{ $message }}</span>
        @enderror
    </td>
    <td>
      <input type="password" name="password">
      <br>
        @error('password')
         <span style="color:red;">{{ $message }}</span>
        @enderror
    </td>
    <td>
    <select name="company">
        @foreach($client as $company)
            <option value=" {{$company->id}}">
                 {{$company->name}}
            </option>
        @endforeach    
        </select>
        <br>
        @error('company')
         <span style="color:red;">{{ $message }}</span>
        @enderror
    </td>
    
    <td>
        <select name="role">
            @foreach($role as $roles)
            <option value="{{$roles->id}}">
                 {{$roles->name}}
            </option>
            @endforeach
        </select>
        
        @error('role')
         <span style="color:red;">{{ $message }}</span>
        @enderror</td>

     </tr>
     <tr>
        <td><button type="submit" class="btn btn-primary">Send Invitation</button></td>
       

     </tr>
      
      
    </tbody>
  </table>
</form>
               </div>
            </div>
        </div>
    </div>
</x-app-layout>