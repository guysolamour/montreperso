@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des HorlogeClients</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('horloge_client.create') }}"> Nouveau HorlogeClient</a>
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
        <th>id_forme_horloge </th>
        <th>id_taille </th>
        <th>id_couleur_index </th>
        <th>id_text </th>
        <th>id_image_perso </th>
        <th>id_position_image_perso </th>
        <th>id_arriere_plan </th>
        <th>quantite </th>
        <th>prix </th>
        <th>id_user </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($horlogeClients as $horlogeClient)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $horlogeClient -> id_forme_horloge }}</td> 
            <td>{{ $horlogeClient -> id_taille }}</td> 
            <td>{{ $horlogeClient -> id_couleur_index }}</td> 
            <td>{{ $horlogeClient -> id_text }}</td> 
            <td>{{ $horlogeClient -> id_image_perso }}</td> 
            <td>{{ $horlogeClient -> id_position_image_perso }}</td> 
            <td>{{ $horlogeClient -> id_arriere_plan }}</td> 
            <td>{{ $horlogeClient -> quantite }}</td> 
            <td>{{ $horlogeClient -> prix }}</td> 
            <td>{{ $horlogeClient -> id_user }}</td> 
            <td>{{ $horlogeClient -> created_at }}</td> 
            <td>{{ $horlogeClient -> updated_at }}</td> 
            <td>
            <form action="{{ route('horloge_client.destroy',$horlogeClient -> id_horloge_client) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('horloge_client.edit',$horlogeClient -> id_horloge_client) }}">Modifier</a>
 
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

{!! $horlogeClients -> links() !!}

    
        
@endsection