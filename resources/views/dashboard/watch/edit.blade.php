@extends('layout')



@section('content')

<div class="container">
    <h3 class="text-center">Modification montre : {{ $montre->nom }} </h3>
    <div class="row">
        <div class="col-md-2">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('user.dashboard.watch') }}">Mes montres</a></li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
                <li class="list-group-item">A fourth item</li>
                <li class="list-group-item">And a fifth one</li>
              </ul>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    @include('MontreClient._watch')
                </div>
            </div>
        </div>
    </div>
</div>


@stop
