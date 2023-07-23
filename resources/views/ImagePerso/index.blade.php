@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des ImagePersos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('image_perso.create') }}"> Nouveau ImagePerso</a>
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
        <th>adresse </th>
        <th>id_user </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($imagePersos as $imagePerso)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $imagePerso -> adresse }}</td> 
            <td>{{ $imagePerso -> id_user }}</td> 
            <td>{{ $imagePerso -> created_at }}</td> 
            <td>{{ $imagePerso -> updated_at }}</td> 
            <td>
            <form action="{{ route('image_perso.destroy',$imagePerso -> id_image_perso) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('image_perso.edit',$imagePerso -> id_image_perso) }}">Modifier</a>
 
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

{!! $imagePersos -> links() !!}

    
        
@endsection