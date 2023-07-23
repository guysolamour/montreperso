@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des PositionTextes</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('position_texte.create') }}"> Nouveau PositionTexte</a>
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
        <th>valeur_position </th>
        <th>valeur_anglaise </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($positionTextes as $positionTexte)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $positionTexte -> valeur_position }}</td> 
            <td>{{ $positionTexte -> valeur_anglaise }}</td> 
            <td>{{ $positionTexte -> created_at }}</td> 
            <td>{{ $positionTexte -> updated_at }}</td> 
            <td>
            <form action="{{ route('position_texte.destroy',$positionTexte -> id_position_texte) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('position_texte.edit',$positionTexte -> id_position_texte) }}">Modifier</a>
 
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

{!! $positionTextes -> links() !!}

    
        
@endsection