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
            @foreach($actions as $action)
                <tr>
                    <th scope="row">{{$action->fear_level}}</th>
                    <td>{{$action->description}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        <form method="post" action="{{url('/home/action')}}">
            @csrf
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" name="action" id="action" maxlength="110">
                </div>
                <div class="col-md-2">
                    <label for="fear-level">Fear Level</label>
                    <select class="form-control custom-select mr-sm-2" name="fear_level">
                        <option selected>Choose...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
            <div class=""form-control>
                <button type="btn" id="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
</div>
@endsection
