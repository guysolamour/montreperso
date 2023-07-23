@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des TexteHorloges</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('texte_horloge.create') }}"> Nouveau TexteHorloge</a>
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
        <th>id_horloge_client </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($texteHorloges as $texteHorloge)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $texteHorloge -> id_police }}</td> 
            <td>{{ $texteHorloge -> taille_police }}</td> 
            <td>{{ $texteHorloge -> id_couleur }}</td> 
            <td>{{ $texteHorloge -> id_position_texte }}</td> 
            <td>{{ $texteHorloge -> contenu_texte }}</td> 
            <td>{{ $texteHorloge -> id_horloge_client }}</td> 
            <td>{{ $texteHorloge -> created_at }}</td> 
            <td>{{ $texteHorloge -> updated_at }}</td> 
            <td>
            <form action="{{ route('texte_horloge.destroy',$texteHorloge -> id_texte_horloge) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('texte_horloge.edit',$texteHorloge -> id_texte_horloge) }}">Modifier</a>
 
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

{!! $texteHorloges -> links() !!}

    
        
@endsection