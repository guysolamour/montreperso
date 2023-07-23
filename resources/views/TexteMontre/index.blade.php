@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des TexteMontres</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('texte_montre.create') }}"> Nouveau TexteMontre</a>
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
        <th>id_police </th>
        <th>taille_police </th>
        <th>id_couleur </th>
        <th>id_position_texte </th>
        <th>contenu_texte </th>
        <th>id_montre_client </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($texteMontres as $texteMontre)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $texteMontre -> id_police }}</td> 
            <td>{{ $texteMontre -> taille_police }}</td> 
            <td>{{ $texteMontre -> id_couleur }}</td> 
            <td>{{ $texteMontre -> id_position_texte }}</td> 
            <td>{{ $texteMontre -> contenu_texte }}</td> 
            <td>{{ $texteMontre -> id_montre_client }}</td> 
            <td>{{ $texteMontre -> created_at }}</td> 
            <td>{{ $texteMontre -> updated_at }}</td> 
            <td>
            <form action="{{ route('texte_montre.destroy',$texteMontre -> id_texte_montre) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('texte_montre.edit',$texteMontre -> id_texte_montre) }}">Modifier</a>
 
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

{!! $texteMontres -> links() !!}

    
        
@endsection