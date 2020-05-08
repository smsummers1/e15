@extends('layouts.master')

@section('editInfo')
<h2 dusk="choose-student-to-edit-heading">Choose Student</h2>

<div class="alert alert-secondary" role="alert">

    @if(count($students) == 0)
    No students have been added yet...
    @else

    <form method="post" action="">
        <h6 class="floatLeft"><a href="/editInfo">Back</a></h6>
        <br>
        <!-- security token used to make sure data isn't coming from another site -->
        {{ csrf_field() }}

        <label for='selectStudent' class="col-form-label-lg">Choose a Student: </label>

        <!-- How to turn dropdown items into links - https://www.quora.com/How-do-I-insert-link-in-select-tag-in-HTML -->
        <select id='selectStudent' name="selectStudent" onchange="location = this.value;">
            <option> Click here to choose a student.... </option>

            @foreach($students as $student)
            <option value="/editStudent/{{ $student->id }}">
                {{ $student->firstName }} {{$student->lastName}}
            </option>
            @endforeach

        </select>
    </form>
    <br>
</div>
@endif

@endsection