@extends('layout')



@section('content')

<div class="container">
    <h3 class="text-center">Vos differentes montres </h3>
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('user.dashboard.watch') }}">Mes montres</a></li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
                <li class="list-group-item">A fourth item</li>
                <li class="list-group-item">And a fifth one</li>
              </ul>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">CreatedAt</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->montres->reverse() as $montre)
                            <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $montre->nom }}</td>
                              <td>{{ $montre->created_at->diffForHumans()}}</td>
                              <td>
                                <div class="btn-group">
                                    <a href="{{ route('user.dashboard.watch.update', $montre) }}" class="btn btn-info">Editer</a>
                                    <a href="" class="btn btn-danger">Supprimer</a>
                                </div>
                              </td>
                            </tr>

                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>


@stop
