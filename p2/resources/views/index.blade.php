@extends('layouts.master')

@section('header')
    <h1>Volunteer Hour Calculator</h1>
    <p id="subtitle">Calculates the total number of volunteer hours recorded for the specified student</p>
    <br>
@endsection

@section('form')
 
<div id="vHourInput">
    <form method='GET' action='/search'>
        <fieldset>
            
            <label for='inputFile'
                   id="headerMedium">
            Choose a Data Set: </label>
            
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

            <p id="headerMedium">Student Name</p>
            
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
        
    </form>
    
    @if(!is_null($searchResults))
        @if(count($searchResults) == 0)
            <br><br>
            <div class='results alert alert-warning'>
                No results found.
            </div>
        @else
            <br><br>
            <div class='results alert alert-primary'>

               {{ count($searchResults) }} 
               {{ Str::plural('Entry', count($searchResults)) }}:
                <br><br>
                <!--show detailedReport-->
                @if($detailedReport=='yes')
                   <h3>Volunteer Hour Report</h3>
                   <table>
                        @foreach($searchResults as $slug => $entry)
                            
                       <tr>
                           <td>{{$entry['date']}}</td>
                           <td>{{$entry['volunteerFirstName'] }}</td>
                           <td>{{$entry['volunteerLastName'] }}</td>
                           <td>{{$entry['volunteerTimeToday'] }}</td>
                       </tr>
                       
                       @endforeach
                   </table>
                
                       <br><br>
                       <p><b>Hours Complete:</b> {{number_format($totalVolunteerTime, 2)}}</p>
                       <p><b>Hours Remaining:</b> {{number_format($remainingVolunteerTime, 2)}}</p>
                       
                <!--Do Not Show detailedReport-->
                @else
                    <h3>Volunteer Hour Report</h3>

                    <p><b>Hours Complete:</b> {{number_format($totalVolunteerTime, 2)}}</p>
                    <p><b>Hours Remaining:</b> {{number_format($remainingVolunteerTime, 2)}}</p>
                @endif
                
            </div>
        @endif
    @endif

</div>
@endsection


