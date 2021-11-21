@extends('layouts.main')
@section('title','بازاریاب های زیردست')
@section('content')

<div>




        <div class="card-box shadow">


            {{-- <h4 class="header-title mt-0 mb-3">درخت ساده</h4> --}}

            <div id="basicTree">
                <ul>
                   @foreach ($marketers as $marketer )
                    <li>{{$marketer->name .' '.$marketer->last_name}}</li>
                   @endforeach

                    {{-- <li data-jstree='{"type":"file"}'>فرانت اند</li> --}}
                </ul>
            </div>
        </div>

</div>
@endsection
