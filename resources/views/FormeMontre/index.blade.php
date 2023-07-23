@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des FormeMontres</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('forme_montre.create') }}"> Nouveau FormeMontre</a>
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
        <th>libelle_forme </th>
        <th>image_forme </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($formeMontres as $formeMontre)
        <tr>
            <td>{{ ++$i }}</td>            
            <td>{{ $formeMontre -> libelle_forme }}</td> 
                 <?php $file_url = url("uploads/forme_montre/$formeMontre->image_forme") ; ?>
            <td> <img src="{{$file_url}}" style="width:20%"></td>  
            <td>{{ $formeMontre -> created_at }}</td> 
            <td>{{ $formeMontre -> updated_at }}</td> 
            <td>
            <form action="{{ route('forme_montre.destroy',$formeMontre -> id_forme_montre) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('forme_montre.edit',$formeMontre -> id_forme_montre) }}">Modifier</a>
 
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

{!! $formeMontres -> links() !!}

    
        
@endsection