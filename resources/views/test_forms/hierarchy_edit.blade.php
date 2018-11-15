@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Fear Rank</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="container">
        <form method="post" action="{{route('hierarchy.update', $hierarchy->id)}}">
            {{method_field('PATCH')}}
            @csrf
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Goal</label>
                    <input type="text" class="form-control" value="{{$hierarchy->goal}}"name="goal" id="goal" maxlength="75">
                </div>
            </div>
            <div class=""form-control>
                <button type="btn" id="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
</div>
@endsection
