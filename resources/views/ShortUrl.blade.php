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
                <select onchange="redirectToReport(this.value)" name="month">
                  <option value="">All</option>
                    <option value="thismonth" {{ request('month')=='thismonth' ? 'selected' : '' }}>This Month</option>
                    <option value="lastmonth" {{ request('month')=='lastmonth' ? 'selected' : '' }}>Last Month</option>
                    <option value="lastweek" {{ request('month')=='lastweek' ? 'selected' : '' }}>Last Week</option>
                    <option value="today" {{ request('month')=='today' ? 'selected' : '' }}>Today</option>
                  </select> 

                  <button type="submit" style="float:right" name="submit" value="download">Download &nbsp;&nbsp;</button>
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
        <th>Short Urls</th>
        <th>Hits</th>
        <th>Client Name</th>
        <th>Created On</th>
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
        <td>{{$value->url}}</td>
        <td>{{$value->No_of_hits}}</td>
        <td>@if(isset($value->UserDetails->name)){{$value->UserDetails->name}}@endif</td>
      
        <td>{{date('d M y',strtotime($value->created_at))}}</td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
  showing  {{ $data->lastItem() }} of total {{ $data->total() }}  <a href="{{url('shoturlDetails')}}" class="btn btn-primary">View All</a>
               </div>
            </div>
        </div>
    </div>
    </form>
</x-app-layout>
<script>
function redirectToReport(val) {
  var url='{{url('')}}';
    if(val !== "") {
    
        window.location.href = url+ "/shorturl?month=" + val;
    }
    else
    {
      window.location.href = url+"/shorturl"
    }
}
</script>