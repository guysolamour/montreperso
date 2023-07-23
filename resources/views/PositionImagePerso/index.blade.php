@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des PositionImagePersos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('position_image_perso.create') }}"> Nouveau PositionImagePerso</a>
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
        <th>valeur_position_img </th>
        <th>valeur_anglaise </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($positionImagePersos as $positionImagePerso)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $positionImagePerso -> valeur_position_img }}</td> 
            <td>{{ $positionImagePerso -> valeur_anglaise }}</td> 
            <td>{{ $positionImagePerso -> created_at }}</td> 
            <td>{{ $positionImagePerso -> updated_at }}</td> 
            <td>
            <form action="{{ route('position_image_perso.destroy',$positionImagePerso -> id_position_image_perso) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('position_image_perso.edit',$positionImagePerso -> id_position_image_perso) }}">Modifier</a>
 
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

{!! $positionImagePersos -> links() !!}

    
        
@endsection