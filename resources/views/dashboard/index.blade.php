@extends('layout')



@section('content')

<div class="container">
    <h3 class="text-center">Bienvenue <b>{{ auth()->user()->nom_complet }}</b> sur votre tableau de bord </h3>
    <div class="row">
        <div class="col-md-3">
            <ul>
                <li><a href="{{ route('user.dashboard.watch') }}">Mes montres</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum quam similique et totam distinctio vitae accusantium ut ex ipsa veritatis obcaecati doloribus, consequatur officia sed voluptates cupiditate pariatur ipsam excepturi.
                </div>
            </div>
        </div>
    </div>
</div>


@stop
