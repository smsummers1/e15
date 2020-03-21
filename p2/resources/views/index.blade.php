@extends('layouts.master')

@section('header')
    <br>
    <h1>Volunteer Hour Calculator</h1>
    <p id="subtitle">Calculates the monthly volunteer hours recorded for each student</p>
    <br>
@endsection

@section('form')
 
<div id="vHourInput">
    <form method='GET' action='/search'>
        <fieldset>
            
            <label for='inputFile'
                   id="headerMedium">
            Choose a Month: </label>
            
            <br>
            
            <select id="inputFile" name="inputFile">
              <option 
                value="jan2020"
                {{ (old('inputFile') == 'jan2020' or $inputFile == 'jan2020') ? 'selected="selected"' : ''}}
                      >January 2020</option>
              <option 
                value="feb2020"
                {{ (old('inputFile') == 'feb2020' or $inputFile == 'feb2020') ? 'selected="selected"' : ''}}      
                >February 2020</option>
            </select>
            
            <br><br><br>

            <p id="headerMedium">Student Name:</p>
            
            <label for='studentFirstName'> </label>
            <input type='text'
                   name='studentFirstName' id='studentFirstName' 
                   placeholder="First"
                   value='{{ old("studentFirstName", $studentFirstName) }}'
                   >
            
            <br>
            
            <label for='studentLastName'></label>
            <input type='text' 
                   name='studentLastName' id='studentLastName' 
                   placeholder="Last"
                   value='{{ old("studentLastName", $studentLastName) }}'
                   >
            
            <br><br><br>

            <p id="headerMedium">Detailed Report:</p>
            
            <label>Yes</label>
            <input type='radio' 
                   id='yes' 
                   name='detailedReport' 
                   value='yes'
                   {{ (old('detailedReport') == 'yes' or $detailedReport == 'yes') ? 'checked' : ''}}
                   >
            <br>
            
            <label>No</label>
            <input type='radio'
                   id='no' 
                   name='detailedReport' 
                   value='no'
                   {{ (old('detailedReport') == 'no' or $detailedReport == 'no') ? 'checked' : ''}}
                   >

            <br><br><br>

            <button type='submit'>Process</button>
            
        </fieldset>
        
        @if(count($errors) > 0)
            <br><br>
            <ul class='alert alert-danger' style='list-style-type: none;'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        @if(!is_null($searchResults))
            <br>
            <p id="reportAvailable">** Scroll Down For Report **</p>
        @endif
        
    </form>
</div>
@endsection
    
@section('report')
    
    <!-- if user submitted form show Results -->
<div>
    @if(!is_null($searchResults))
    
        <!-- No results found -->
        @if(count($searchResults) == 0)
            <br><br>
            <div class='results alert alert-warning'>
                No results found.
            </div>
    
        <!-- Results Found-->
        @else
            <div class='results alert alert-primary' id="report">

               {{ count($searchResults) }} 
               {{ Str::plural('Entry', count($searchResults)) }}:
                <br><br>
                
                <!--user chose to view detailed report-->
                @if($detailedReport=='yes')
                   <h1>Volunteer Hour Report</h1>
                   <br>
                   <table id="details">
                       <tr>
                           <th colspan="4">
                               <!-- Display the Month-->
                                @if($inputFile == 'jan2020')
                                    <b> January 2020 </b>
                                @else
                                    <b> February 2020 </b>
                                @endif
                            </th>
                       </tr>
                       
                        @foreach($searchResults as $slug => $entry)
                        <tr>   
                           <td>{{$entry['date']}}</td>
                           <td>{{$entry['volunteerFirstName'] }}</td>
                           <td>{{$entry['volunteerLastName'] }}</td>
                           <td>{{$entry['volunteerTimeToday'] }}&nbsp; 
                               {{ Str::plural('min', $entry['volunteerTimeToday']) }}</td>
                       </tr>
                       @endforeach
                       
                   </table>
            
                
                   <br><br>
                
                    <table id="overview">
                        <th colspan="2">Overview</th>
                        <tr>
                            <td id="important"><b>Student:</b> </td>
                            <td id="data">{{$studentFirstName}}&nbsp;
                            {{$studentLastName}}</td>
                        </tr>
                       
                        <tr>
                            <td id="important"><b>Complete:</b> </td>
                            <td id="data">{{number_format($totalVolunteerTime, 2)}}&nbsp;
                            {{ Str::plural('hour', $totalVolunteerTime) }}</td>
                        </tr>
                        <tr>
                            <td id="important"><b>Remaining:</b> </td>
                            <td id="data">{{number_format($remainingVolunteerTime, 2)}}&nbsp;
                            {{ Str::plural('hour', $remainingVolunteerTime) }}</td>
                        </tr>
                    </table>
                <!--Do Not Show detailedReport-->
                @else
                    <h1>Volunteer Hour Report</h1>
                    <br>
                    <table id="overview">
                        <th colspan="2">
                           <!-- Display the Month-->
                            @if($inputFile == 'jan2020')
                                <b> January 2020 </b>
                            @else
                                <b> February 2020 </b>
                            @endif
                        </th>
                        <tr>
                            <td id="important"><b>Student:</b></td><td id="data">{{$studentFirstName}}&nbsp; {{$studentLastName}}</td>
                        </tr>
                        <tr>
                            <td id="important"><b>Complete:</b></td><td id="data">{{number_format($totalVolunteerTime, 2)}}&nbsp;{{ Str::plural('hour', $totalVolunteerTime) }}</td>
                        </tr>
                        <tr>
                            <td id="important"><b>Remaining:</b></td>
                            <td id="data">{{number_format($remainingVolunteerTime, 2)}}&nbsp;{{ Str::plural('hour', $remainingVolunteerTime) }}</td>
                        </tr>
                    </table>
                @endif
            </div>
        @endif
    @endif

</div>
@endsection


