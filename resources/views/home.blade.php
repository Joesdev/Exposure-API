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
        {{--Hiearchy_id is set to  placeholder number for now, this firm is strictly for testing--}}
        <form method="post" action="{{route('store.actions', $heirarchy_id = 9)}}">
            @csrf
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" name="description_one" id="description_one" maxlength="75">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" name="description_two" id="description_two" maxlength="75">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" name="description_three" id="description_three" maxlength="75">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" name="description_four" id="description_four" maxlength="75">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" name="description_five" id="description_five" maxlength="75">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" name="description_six" id="description_six" maxlength="75">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" name="description_seven" id="description_seven" maxlength="75">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" name="description_eight" id="description_eight" maxlength="75">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" name="description_nine" id="description_nine" maxlength="75">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-10">
                    <label for="action">Action</label>
                    <input type="text" class="form-control" name="description_ten" id="description_ten" maxlength="75">
                </div>
            </div>
            <div class=""form-control>
                <button type="btn" id="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
</div>
@endsection
