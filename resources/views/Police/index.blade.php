@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des Polices</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('police.create') }}"> Nouvelle Police</a>
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
        <th>valeur_police </th>
        <th>valeur_anglaise </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($polices as $police)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $police -> valeur_police }}</td> 
            <td>{{ $police -> valeur_anglaise }}</td> 
            <td>{{ $police -> created_at }}</td> 
            <td>{{ $police -> updated_at }}</td> 
            <td>
            <form action="{{ route('police.destroy',$police -> id_police) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('police.edit',$police -> id_police) }}">Modifier</a>
 
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

{!! $polices -> links() !!}

    
        
@endsection