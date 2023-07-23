@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des TailleCadrans</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('taille_cadran.create') }}"> Nouveau TailleCadran</a>
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
        <th>valeur_taille </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($tailleCadrans as $tailleCadran)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $tailleCadran -> valeur_taille }}</td> 
            <td>{{ $tailleCadran -> created_at }}</td> 
            <td>{{ $tailleCadran -> updated_at }}</td> 
            <td>
            <form action="{{ route('taille_cadran.destroy',$tailleCadran -> id_taille_cadran) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('taille_cadran.edit',$tailleCadran -> id_taille_cadran) }}">Modifier</a>
 
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

{!! $tailleCadrans -> links() !!}

    
        
@endsection