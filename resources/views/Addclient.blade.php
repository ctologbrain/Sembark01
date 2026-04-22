<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$title}}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               
                <form method="post" action="{{url('PostClient')}}">
                @csrf
                <table border="1" cellpadding="8" cellspacing="0" style="width:100%;border:1px solid #000;text-align: center;">
    <thead>
      <tr>
     
        <th>Client Name</th>
        <th>Email</th>
       
      </tr>
    </thead>
    <tbody>
     <tr>
        <td><input type="text" name="name" value="{{ old('name') }}">
        @error('name')
         <span style="color:red;">{{ $message }}</span>
        @enderror
    </td>
        <td><input type="text" name="email" value="{{ old('email') }}">
        @error('email')
         <span style="color:red;">{{ $message }}</span>
        @enderror
    </td>

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