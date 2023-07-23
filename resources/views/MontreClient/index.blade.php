@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des MontreClients</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('montre_client.create') }}"> Nouveau MontreClient</a>
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
        <th>id_forme_montre </th>
        <th>id_taille_cadran </th>
        <th>id_couleur_index </th>
        <th>id_texte_montre </th>
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
        @foreach ($montreClients as $montreClient)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $montreClient -> id_forme_montre }}</td> 
            <td>{{ $montreClient -> id_taille_cadran }}</td> 
            <td>{{ $montreClient -> id_couleur_index }}</td> 
            <td>{{ $montreClient -> id_texte_montre }}</td> 
            <td>{{ $montreClient -> id_image_perso }}</td> 
            <td>{{ $montreClient -> id_position_image_perso }}</td> 
            <td>{{ $montreClient -> id_arriere_plan }}</td> 
            <td>{{ $montreClient -> quantite }}</td> 
            <td>{{ $montreClient -> prix }}</td> 
            <td>{{ $montreClient -> id_user }}</td> 
            <td>{{ $montreClient -> created_at }}</td> 
            <td>{{ $montreClient -> updated_at }}</td> 
            <td>
            <form action="{{ route('montre_client.destroy',$montreClient -> id_montre_client) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('montre_client.edit',$montreClient -> id_montre_client) }}">Modifier</a>
 
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

{!! $montreClients -> links() !!}

    
        
@endsection