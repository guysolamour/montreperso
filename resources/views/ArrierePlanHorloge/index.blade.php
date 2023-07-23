@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des ArrierePlanHorloges</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('arriere_plan_horloge.create') }}"> Nouveau ArrierePlanHorloge</a>
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
        <th>nom_arriere_plan </th>
        <th>image_arriere_plan </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($arrierePlanHorloges as $arrierePlanHorloge)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $arrierePlanHorloge -> nom_arriere_plan }}</td> 
            <?php $file_url = url("uploads/arriere_plan_horloge/$arrierePlanHorloge->image_arriere_plan") ; ?>
            <td> <img src="{{$file_url}}" style="width:20%"></td> 
            <td>{{ $arrierePlanHorloge -> created_at }}</td> 
            <td>{{ $arrierePlanHorloge -> updated_at }}</td> 
            <td>
            <form action="{{ route('arriere_plan_horloge.destroy',$arrierePlanHorloge -> id_arriere_plan) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('arriere_plan_horloge.edit',$arrierePlanHorloge -> id_arriere_plan) }}">Modifier</a>
 
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

{!! $arrierePlanHorloges -> links() !!}

    
        
@endsection