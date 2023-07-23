@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des Users</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('user.create') }}"> Nouveau User</a>
            </div>
        </div>
    </div>
    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
         <table class="table table-bordered">
         <tr>
             <th>No</th>
        <th>nom </th>
        <th>prenoms </th>
        <th>contact </th>
        <th>password </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $user -> nom }}</td> 
            <td>{{ $user -> prenoms }}</td> 
            <td>{{ $user -> contact }}</td> 
            <td>{{ $user -> password }}</td> 
            <td>
            <form action="{{ route('user.destroy',$user -> id_user) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('user.edit',$user -> id_user) }}">Modifier</a>
 
                @csrf
                @method('DELETE')
    
                <a class="btn btn-danger" href="#"
                onclick="
                        event.preventDefault(); 
                        if (confirm('Etes vous sûr de supprimer l\'enregistrement ?')){
                            document.getElementById('deleteform{{$i}}').submit()
                        }
                  " 
                >Supprimer</a>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $users -> links() !!}

    
        
@endsection