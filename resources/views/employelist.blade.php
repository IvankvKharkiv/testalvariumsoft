<x-app-layout>

    <x-slot name="header">
        <h2>
            {{ __('Employe list') }}
        </h2>
    </x-slot>

    
    <div class="ml-20 mr-20">


        <div class="flex">
            <div class="flex flex-col">
                @if (isset($dep))
                    <form action="{{ route('employes') . '/' . $dep->department }}" method="GET" role="form">
                @else
                    <form action="{{ route('employes') }}" method="GET" role="form">
                @endif
                {{-- <form action="{{ route('employes') }}" method="GET" role="form"> --}}
                    <div class="flex flex-col">
                        <label for="perPage">Employe per page:  </label>
                            <select onchange="this.form.submit()" id="perPage" name="perPage">
                                <option @if($perpage==10) selected @endif>10</option>
                                <option @if($perpage==25) selected @endif>25</option>
                                <option @if($perpage==50) selected @endif>50</option>
                                <option @if($perpage==100) selected @endif>100</option>
                            </select>
                    </div>
                    <br>
                </form>
    
            <a href="{{ route('employes') . '?perPage='.$perpage  }}" class=" @if(is_null($dep)) bg-green-400 @else bg-green-200 @endif p-1 rounded-md Zhover:bg-gray-400 active:bg-green-400 focus:outline-none my-2">All departments</a>


            @foreach ($departments as $dpr)
                <a href="{{ route('employes') . '/' . $dpr->department . '?perPage='.$perpage }}" class=" @if(isset($dep) &&$dpr->id == $dep->id) bg-green-400 @else bg-green-200 @endif p-1 rounded-md Zhover:bg-gray-400 active:bg-green-400 focus:outline-none my-2">{{$dpr->department}}</a>
            @endforeach    

            
        </div>
            <table class="ml-10 w-3/4">
                <tr>
                  <th>Full name</th>
                  <th>Birth date</th>
                  <th>Department</th>
                  <th>Role</th>
                  <th>Hours/monthly</th>
                  <th>Salary</th>
                </tr>
        
                @foreach ($employes as $employe)
                    <tr>
                        <td class="text-center">{{ $employe->name .' '. $employe->lname .' '. $employe->pname }}</td>
                        <td class="text-center">{{ $employe->bdate }}</td>
                        <td class="text-center">{{ $employe->department->department }}</td>
                        <td class="text-center">{{ $employe->role->role }}</td>
                        <td class="text-center">@if($employe->salary->hourly_wage)Hourly @else Monthly @endif</td>
                        <td class="text-center">{{ $employe->salary->salary }}</td>
                    </tr>        
                @endforeach
        
        
              </table>
        </div>
    
    
    
        <div>
            {{ $employes->appends($_GET)->links() }}
        </div>
    
        <br>

        <div class="flex">
            <input type="hidden" name="depid" @isset($dep) value="{{ $dep->id }}" @endisset >
            
            <div class="lds-dual-ring" style="display: none;" id="waitspinner"></div>
            <button id="dwn-btn" class="bg-green-200 p-1 px-4 rounded-md hover:bg-gray-400 active:bg-green-400 focus:outline-none my-2">Dowload current employe list complete</button>
            
            <div class="lds-dual-ring" style="display: none;" id="waitspinner1"></div>
            <button id="dwn-btn-perpage" class="bg-green-200 m-4 p-1 px-4 rounded-md hover:bg-gray-400 active:bg-green-400 focus:outline-none my-2">Dowload current employe list per page</button>
        </div>
                
        <div class="pt-5 pb-2">Not recommended variant:</div>
        
        <a href="{{ route('getxmlfile') }}" download class="bg-green-200 p-1 rounded-md hover:bg-gray-400 active:bg-green-400 focus:outline-none my-2">Download current employes list xml file with saving to server file</a>

    </div>
    <br>
    <br>
</x-app-layout>