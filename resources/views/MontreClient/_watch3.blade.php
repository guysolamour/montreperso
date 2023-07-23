@php
// $formes  = \App\Models\Forme::with(['index', 'index.images'])->get();
// $polices = \App\Police::get();
// $arrierePlans = \App\Models\ArrierePlan::with(['images'])->get();
@endphp



@push('js')
<script defer src="{{ asset('js/alpine.js') }}" ></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('buildwatch', () => ({
            init(){
                alert('chargé')
            }
        }))
    })
</script>
@endpush
<div class="row" x-data="buildwatch">

    <div class="col-md-8">
        <div class="card" x-show='data.etape == 1'>
            <div class="card-body">

            </div>
        </div>
        <div class="card" x-show='data.etape == 2'>
            <div class="card-body">
                <p class="alert alert-success">Etape de connexion</p>

            </div>
        </div>
        <div class="card" x-show='data.etape == 3'>
            <div class="card-body">
                <p class="alert alert-info">
                    Etape inscription
                </p>

            </div>
        </div>
    </div>

    --}}
    <div class="col-md-4">
        <div class="row">
            <div class="col-12 text-center">
                <div class="card">
                    <div class="card-body align-self-center" style="height: 300px;">


                    </div>

                    <p class="px-2" style="background-color: lime; height: 60px">

                    </p>
                    <div class="card-footer">
                        <div class="d-grid gap-2">
                            <button  type="submit" class="btn btn-success" form="enregisterMontreClient">
                                Enregistrer la montre
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
