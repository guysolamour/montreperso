@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des MontrePersoIndexs</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('montre_perso_index.create') }}"> Nouveau MontrePersoIndex</a>
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
        <th>nom_index </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($montrePersoIndexs as $montrePersoIndex)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $montrePersoIndex -> nom_index }}</td> 
            <td>{{ $montrePersoIndex -> created_at }}</td> 
            <td>{{ $montrePersoIndex -> updated_at }}</td> 
            <td>
            <form action="{{ route('montre_perso_index.destroy',$montrePersoIndex -> id_index) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('montre_perso_index.edit',$montrePersoIndex -> id_index) }}">Modifier</a>
 
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

{!! $montrePersoIndexs -> links() !!}

    
        
@endsection