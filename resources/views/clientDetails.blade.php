<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$title}}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                @if(session('success'))
    <div style="color:green; font-weight:bold;">
        {{ session('success') }}
    </div>
@endif
                <table border="1" cellpadding="8" cellspacing="0" style="width:100%;border:1px solid #000;text-align: center;">
    <thead>
      <tr>
      <th>#</th>
        <th>Client Name</th>
        <th>User</th>
        <th>Total Generate URLs</th>
        <th>Total URL Hits</th>
      </tr>
    </thead>
    <tbody>
    @php
        if(request()->get('page')!="" && request()->get('page') >1){
            $i = (intval(request()->get('page'))-1)*2;
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
        <td>{{$value->TotalClient}}</td>
        <td>{{$value->TotalShorUrl}}</td>
        <td>{{$value->totalHit ?? 0}}</td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
@if ($data->hasPages())
    {{ $data->appends(Request::except('page'))->links() }}
 @else  
 showing  {{ $data->lastItem() }} of total {{ $data->total() }}  
@endif

               </div>
            </div>
        </div>
    </div>
</x-app-layout>