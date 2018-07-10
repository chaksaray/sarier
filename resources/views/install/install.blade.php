@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Install step 2</h3></div>
                    <div class="panel-body">
                        <p>Get started integrating Facebook into your app or website</p>
                        <form class="form-horizontal" method="post" action="/install">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="page">Select Page:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="page" id="page">
                                        @for ($i = 0; $i < count($pages); $i++)
                                            <option value="{{$pages[$i]->id}}">{{$pages[$i]->name}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Display Name:</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="name" placeholder="Enter name" name="name">
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label class="control-label col-sm-2" for="plan">Select Plan:</label>--}}
                                {{--<div class="col-sm-10">--}}
                                    {{--<select class="form-control" name="plan" id="plan">--}}
                                        {{--<option value="0">Try Free</option>--}}
                                        {{--<option value="1">Broze</option>--}}
                                        {{--<option value="2">Silver</option>--}}
                                        {{--<option value="3">Gold</option>--}}
                                        {{--<option value="4">Diamond</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <p>By proceeding, you agree to the Facebook Platform Policies
                                    </p>
                                    <button type="submit" class="btn btn-default btn-primary">Install</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{--<div class="panel-footer">--}}
                        {{--<p>By proceeding, you agree to the Facebook Platform Policies--}}
                        {{--</p>--}}
                    {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
