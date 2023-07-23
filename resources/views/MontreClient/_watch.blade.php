@php
    $formes       = \App\Models\Forme::with(['index', 'index.images'])->get();
    $polices      = \App\Police::get();
    $aiguilles    = \App\Models\Aiguille::get();
    $arrierePlans = \App\Models\ArrierePlan::with(['images'])->get();
@endphp

@push('css')
    <style>
        #designMontre [data-previsualisation="card"] {
            height: 300px;
        }
        #designMontre [data-previsualisation="box"] {
            position: relative; background-position: center; overflow: hidden; background-repeat: no-repeat;
        }

        #designMontre [data-previsualisation="box"] [data-texte="contenu"] {
             position: absolute; font-weight: 700;
        }

        /* FORME */
        #designMontre [data-forme="ronde"] [data-previsualisation="box"] {
            width: 250px; background-size: 250px;
        }
        #designMontre [data-forme="ronde"] [data-image="forme"]{
            width: 250px;
        }
        #designMontre [data-forme="ronde"] [data-image="index"]{
            width: 193px; position: absolute;left: 22px; top: 42px;
        }
        #designMontre [data-forme="ronde"] [data-image="aiguille"]{
            width: 110px; height: 110px; position: absolute;left: 62px; top: 76px;
        }
        #designMontre [data-forme="ronde"] [data-texte="contenu"] {
            width: 80%;
        }

        /* CARRE */
        #designMontre [data-forme="carre"] [data-previsualisation="box"] {
            width: 300px; background-size: 300px;
        }
        #designMontre [data-forme="carre"] [data-image="forme"]{
            width: 300px;
        }
        #designMontre [data-forme="carre"] [data-image="index"]{
            width: 160px; position: absolute;left: 70px; top: 53px;
        }
        #designMontre [data-forme="carre"] [data-image="aiguille"]{
            width: 110px; height: 110px; position: absolute;left: 95px; top: 76px;
        }
        #designMontre [data-forme="carre"] [data-texte="contenu"] {
            width: 80%;
        }
    </style>
@endpush

@push('js')
<script defer src="{{ asset('js/alpine.js') }}" ></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('buildwatch', () => ({

            data: {
                formes: @json($formes),
                polices: @json($polices),
                arrierePlans: @json($arrierePlans),
                aiguilles: @json($aiguilles),
                userConnecte: @json(auth()->user() ?: []),
                montre: @json($montre ?? []),

                etape: 1,

                formesAutorisees: ['carre', 'ronde'],

                temporaire: {
                    index: {
                        liste: [],
                        images: []
                    },
                    arrierePlan: {
                        liste: [],
                        images: []
                    },
                },

                form: {
                    montre: {
                        nom: null,
                        bracelet: {
                            couleur: '#BF4040',
                        },
                        forme: {
                            valeur: null,
                            model: {}
                        },
                        index: {
                            valeur: null,
                            model: {},
                            image: {
                                valeur: null,
                                model: {}
                            }
                        },
                        arrierePlan: {
                            valeur: null,
                            model: {},
                            image: {
                                valeur: null,
                                model: {},
                                taille: null,
                                previsualisation: null,
                            }
                        },
                        aiguille: {
                            valeur: null,
                            model: {},
                        },
                        texte: {
                            valeur: null,
                            police: null,
                            couleur: null,
                            taille: 16,
                            positionX: 10,
                            positionY: 48,
                        }
                    },
                    connection: {
                        email: 'rolandassale@aswebagency.com',
                        password: '12345678',
                        erreur: "",
                        errors: {}
                    },
                    inscription: {
                        nom: '',
                        prenoms: '',
                        contact: '',
                        email: '',
                        password: '',
                        password_confirmation: '',
                        erreur: {}
                    }
                },

            },
            init(){
                console.log(this.data.montre);
                if (this.editMode){
                    this.remplirLeFormulaire()
                }
            },
            // METHODS
            remplirLeFormulaire(){

                this.$nextTick(() => {
                    if (this.data.montre.nom){
                        this.data.form.montre.nom = this.data.montre.nom
                    }

                    if (this.data.montre.bracelet['couleur']){
                        this.data.form.montre.bracelet.couleur = this.data.montre.bracelet['couleur']
                    }

                    // forme
                    if (this.data.montre.forme.id_forme){
                        this.data.form.montre.forme.valeur = this.data.montre.forme.id_forme
                        this.selectionnerLaForme(this.data.montre.forme)
                    }

                    // cadre
                    if (this.data.montre.index){
                        this.data.form.montre.index.valeur = this.data.montre.index.id_index
                        this.data.form.montre.index.model  = this.data.montre.index
                        this.data.temporaire.index.images  = this.data.montre.index.images
                    }

                    // Image cadre
                    if (this.data.montre.index_image){
                        this.data.form.montre.index.image.valeur = this.data.montre.index_image.id_index_media
                        this.data.form.montre.index.image.model = this.data.montre.index_image
                    }

                    // Aiguille
                    if (this.data.montre.aiguille){
                        this.data.form.montre.aiguille.valeur = this.data.montre.aiguille.id_aiguille
                        this.data.form.montre.aiguille.model = this.data.montre.aiguille
                    }

                    // ArrierePlan
                    if (this.data.montre.arriere_plan){
                        this.data.form.montre.arrierePlan.valeur = this.data.montre.arriere_plan.id_arriere_plan
                        this.data.form.montre.arrierePlan.model  = this.data.montre.arriere_plan
                        this.data.temporaire.arrierePlan.images  = this.data.montre.arriere_plan.images
                    }

                     // ImageArrierePlan
                    if (this.data.montre.arriere_plan_image){
                        this.data.form.montre.arrierePlan.image.valeur = this.data.montre.arriere_plan_image.id_arriere_plan_media
                        this.data.form.montre.arrierePlan.image.model = this.data.montre.arriere_plan_image
                        this.changerPrevisualisationArrierePlan(this.data.montre.arriere_plan_image.chemin)
                    }
                    else if(this.data.montre.image_fond.image){
                        this.data.form.montre.arrierePlan.image.previsualisation  = this.data.montre.image_fond['image']
                        this.changerPrevisualisationArrierePlan(this.data.montre.image_fond['image'])
                    }

                    if(this.data.montre.image_fond.taille){
                        this.data.form.montre.arrierePlan.image.taille  = parseInt(this.data.montre.image_fond['taille'], 10)
                    }

                    // TextFond
                    if (this.data.montre.texte_fond){
                        this.data.form.montre.texte.valeur    = this.data.montre.texte_fond['texte']
                        this.data.form.montre.texte.police    = this.data.montre.texte_fond['police']
                        this.data.form.montre.texte.couleur   = this.data.montre.texte_fond['couleur']
                        this.data.form.montre.texte.taille    = parseInt(this.data.montre.texte_fond['taille'], 10)
                        this.data.form.montre.texte.positionX = parseInt(this.data.montre.texte_fond['positionX'], 10)
                        this.data.form.montre.texte.positionY = parseInt(this.data.montre.texte_fond['positionY'], 10)
                    }

                    // if (this.data.montre.image_fond){
                        // this.data.form.montre.arrierePlan.image.taille  = parseInt(this.data.montre.image_fond['taille'], 10)
                        // // this.data.form.montre.arrierePlan.image.previsualiation
                        // this.data.form.montre.arrierePlan.image.previsualisation  = this.data.montre.image_fond['image']
                        // this.changerPrevisualisationArrierePlan(this.data.montre.image_fond['image'])
                    // }

                })



            },
            ajouterValeurParDefautAuFormulaire(){
                if (!this.estObjetVide(this.data.formes)){
                    // this.data.form.montre.forme.valeur = this.data.formes[0].id_forme
                }
            },
            adapterLeStyleDeLaPrevisualisation(forme){
                if (!this.data.formesAutorisees.includes(forme.nom.toLowerCase())){
                    return
                }
                this.$refs.previsualisationCard.dataset['forme'] = forme.nom
            },
            retirerLeStyleDeLaPrevisualisation(forme){
                delete this.$refs.previsualisationCard.dataset['forme']
            },
            viderLeFormulaireDeMontre(){
                this.data.form.montre.index.model  = {}
                this.data.form.montre.index.valeur = null
                this.data.temporaire.index.liste   = []

                this.data.form.montre.index.image.model  = {}
                this.data.form.montre.index.image.valeur = null
                this.data.temporaire.index.images        = []

                this.retirerLeStyleDeLaPrevisualisation()
            },
            choisirForme(event){
                const forme = this.data.formes.find(item => item.id_forme == event.target.value)

                if (!forme) {
                    this.viderLeFormulaireDeMontre()
                    this.data.form.montre.forme.valeur = null
                    this.data.form.montre.forme.model  = {}
                    return
                }

                this.viderLeFormulaireDeMontre()
                this.selectionnerLaForme(forme)
            },
            selectionnerLaForme(forme){
                this.adapterLeStyleDeLaPrevisualisation(forme)

                this.data.form.montre.forme.model = forme
                this.data.temporaire.index.liste  = forme.index
            },
            choisirIndex(event){

                const index = this.data.temporaire.index.liste.find(item => item.id_index == event.target.value)

                this.viderIndexImages()

                if (!index) {
                    this.data.temporaire.index.images = []
                    return
                }

                this.data.form.montre.index.model = index
                this.data.temporaire.index.images = index.images
            },
            choisirImageIndex(event){

                const image = this.data.temporaire.index.images.find(item => item.id_index_media == event.target.value)

                if (!image) {
                    this.data.form.montre.index.image.model = {}
                    return
                }

                this.data.form.montre.index.image.model = image
            },
            choisirAiguille(event){

                const aiguille = this.data.aiguilles.find(item => item.id_aiguille == event.target.value)

                if (!aiguille) {
                    this.data.form.montre.aiguille.model = {}
                    return
                }

                this.data.form.montre.aiguille.model = aiguille
            },
            choisirArrierePlan(event){
                const arrierePlan = this.data.arrierePlans.find(item => item.id_arriere_plan == event.target.value)

                if (!arrierePlan) return

                this.data.form.montre.arrierePlan.model = arrierePlan
                this.data.temporaire.arrierePlan.images = arrierePlan.images
            },
            choisirArrierePlanImage(event){
                const arrierePlanImage = this.data.temporaire.arrierePlan.images.find(
                    item => item.id_arriere_plan_media == event.target.value
                )

                if (!arrierePlanImage) {
                    this.changerPrevisualisationArrierePlan("")
                    return
                }

                this.data.form.montre.arrierePlan.image.model = arrierePlanImage

                this.changerPrevisualisationArrierePlan(arrierePlanImage.chemin)
            },
            changerPrevisualisationArrierePlan(chemin){
                let backgroundImage

                if (chemin){
                    backgroundImage = chemin.startsWith('url(') ? chemin : "url("+ chemin  +")"
                }else {
                    backgroundImage = "url("+ chemin  +")"
                }

                this.$refs['previsualisationBox'].style.backgroundImage = backgroundImage
            },
            recupererTailleActuelleImageArrierePlan(){
                return parseInt(window.getComputedStyle(this.$refs.previsualisationBox).backgroundSize.slice(0, -2), 10)
            },
            reduireTailleImageArrierePlan(){
                this.data.form.montre.arrierePlan.image.taille = this.recupererTailleActuelleImageArrierePlan() - 20
            },
            augmenterTailleImageArrierePlan(){
                this.data.form.montre.arrierePlan.image.taille = this.recupererTailleActuelleImageArrierePlan() + 20
            },
            reduireTailleTexte(){
                this.data.form.montre.texte.taille = this.data.form.montre.texte.taille -= 2
            },
            augmenterTailleTexte(){
                this.data.form.montre.texte.taille = this.data.form.montre.texte.taille += 2
            },
            changerPositionTexteVersHaut(){
                this.data.form.montre.texte.positionY = this.data.form.montre.texte.positionY -= 2
            },
            changerPositionTexteVersBas(){
                this.data.form.montre.texte.positionY = this.data.form.montre.texte.positionY += 2
            },
            changerPositionTexteVersGauche(){
                this.data.form.montre.texte.positionX = this.data.form.montre.texte.positionX -= 2
            },
            changerPositionTexteVersDroite(){
                this.data.form.montre.texte.positionX = this.data.form.montre.texte.positionX += 2
            },
            choisirImage(event){

                const file = event.target.files[0]

                if (!file){
                    return
                }

                if (file.type && !file.type.startsWith('image/')) {
                    alert('File is not an image.', file.type, file);
                    return;
                }

                const reader = new FileReader();

                reader.addEventListener('load', (event) => {
                    this.data.form.montre.arrierePlan.image.previsualiation = event.target.result;
                    this.data.form.montre.arrierePlan.image.valeur = null
                    this.changerPrevisualisationArrierePlan(event.target.result)
                });

                // faire l'upload

                reader.readAsDataURL(file);
            },
            enregistrerMontre(event){
                if (!confirm('Avez vous terminé de personnaliser la montre')){
                    return
                }

                if (!this.estUtilisateurConnecte()){
                    this.afficherFormulaireDeConnection()
                    return
                }

                const form = event.target

                this.ajouterAuFormulaire(form, 'id_user', this.data.userConnecte.id_user)

                this.ajouterAuFormulaire(form, 'texte_fond', this.convertirEnChaine({
                    texte: this.data.form.montre.texte.valeur,
                    police: this.data.form.montre.texte.police,
                    couleur: this.data.form.montre.texte.couleur,
                    taille:  this.data.form.montre.texte.taille,
                    positionX:  this.data.form.montre.texte.positionX,
                    positionY: this.data.form.montre.texte.positionY,
                }))


                let image_fond = {
                    taille: this.data.form.montre.arrierePlan.image.taille,
                    image: null,
                }


                if (!this.data.form.montre.arrierePlan.image.valeur  && this.$refs['previsualisationBox'].style.backgroundImage){
                    image_fond['image'] =  this.$refs['previsualisationBox'].style.backgroundImage
                }


                this.ajouterAuFormulaire(form, 'image_fond', this.convertirEnChaine(image_fond))


                form.submit()
            },
            seConnecter(event){

                if (!this.estValideFormulaireConnection){
                    return
                }

                const url = this.$refs['formulaireConnection'].getAttribute('action')
                const data = new FormData();
                data.append('_token', jQuery('meta[name=csrf_token]').attr('content'));
                data.append('email', this.data.form.connection.email);
                data.append('password', this.data.form.connection.password);

                jQuery.ajax({
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data,
                    url,
                    success: (data) => {
                        this.data.userConnecte = data
                        this.afficherFormulaireDeMontre()
                    },
                    error: (error) => {
                        this.data.form.connection.erreur = true
                    }
                });
            },
            seInscrire(event){

                const url = this.$refs['formulaireInscription'].getAttribute('action')

                const data = new FormData();
                data.append('_token', jQuery('meta[name=csrf_token]').attr('content'));
                data.append('nom', this.data.form.inscription.nom);
                data.append('prenoms', this.data.form.inscription.prenoms);
                data.append('contact', this.data.form.inscription.contact);
                data.append('email', this.data.form.inscription.email);
                data.append('password', this.data.form.inscription.password);
                data.append('password_confirmation', this.data.form.inscription.password_confirmation);


                jQuery.ajax({
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data,
                    url,
                    success: (data) => {
                        this.data.userConnecte = data
                        this.afficherFormulaireDeMontre()
                    },
                    error: (data) => {
                        this.data.form.inscription.erreur = data.responseJSON.errors
                    }
                });
            },
            ajouterAuFormulaire(form, name, data){
                const input  = document.createElement('input')
                input.type   = 'hidden'
                input.name   = name
                input.value  = data
                form.appendChild(input)
            },
            convertirEnChaine(data) {
                return JSON.stringify(data)
            },
            estUtilisateurConnecte(){
                return this.data.userConnecte.id_user > 0
            },
            afficherFormulaireDeConnection(){
                this.data.etape = 2
            },
            afficherFormulaireDeInscription(){
                this.data.etape = 3
            },
            afficherFormulaireDeMontre(){
                this.data.etape = 1
            },
            ajouterImage(){
                this.fermerModal('ajouterImageModal')
            },

            // UTILITAIRES
            estObjetVide(tableau){
                return jQuery.isEmptyObject(tableau)
            },
            estTableauVide(tableau){
                return tableau.length == 0
            },
            estEmailValide(email){
                let regex = new RegExp("([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\"\(\[\]!#-[^-~ \t]|(\\[\t -~]))+\")@([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\[[\t -Z^-~]*])");

                return regex.test(email);
            },
            estValideMotDePasse(password){
                return password.length >= 6
            },
            get estValideFormulaireConnection(){
                return this.estEmailValide(this.data.form.connection.email) &&
                        this.estValideMotDePasse(this.data.form.connection.email)
            },
            get editMode(){
                    return !jQuery.isEmptyObject(this.data.montre)
                },
            viderIndexImages(){
                this.data.form.montre.index.image.model = {}
                this.data.form.montre.index.image.valeur = null
            },
            fermerModalAjoutTexte(){
                this.data.form.montre.texte.valeur = null
                this.data.form.montre.texte.police = null
                this.data.form.montre.texte.couleur = null

                this.fermerModal('ajoutTexteModal')
            },
            validerModalAjoutTexte(){
                this.fermerModal('ajoutTexteModal')
            },
            annulerModalAjoutImage(){
                this.data.form.montre.arrierePlan.image.previsualiation = null
                this.fermerModal('ajouterImageModal')
            },
            estFormeRonde(){
                return this.data.form.montre.forme.model.nom == 'ronde'
            },
            estFormeCarre(){
                return this.data.form.montre.forme.model.nom == 'carre'
            },
            fermerModal(ref){
                bootstrap.Modal.getInstance(this.$refs[ref]).hide()
            },
        }))
    })
</script>
@endpush
<div class="row" x-data="buildwatch" id="designMontre">
    <div class="col-md-8">
        <div class="card" x-show='data.etape == 1'>
            <div class="card-body">
                <div class="alert alert-success" x-show="estUtilisateurConnecte">
                    Connection effectuée avec succès <b x-text="data.userConnecte.nomComplet"></b>. Veuillez enregistrer la montre à nouveau.
                </div>
                @if(isset($montre) && $montre->getKey())
                <form @submit.prevent="enregistrerMontre" action="{{ route('user.dashboard.watch.update', $montre) }}" method="post" id="enregisterMontreClient" x-ref="enregisterMontreClient">
                    @method('PUT')
                    @else
                <form @submit.prevent="enregistrerMontre" action="{{ route('enregister_montre_client') }}" method="post" id="enregisterMontreClient" x-ref="enregisterMontreClient">
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="montre[nom]">Nom <span class="text-danger">*</span></label>
                                <input name="nom" required type="text" id="montre[nom]" x-model="data.form.montre.nom" name="nom" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="montre[bracelet][couleur]">Couleur bracelet</label>
                                <input name="bracelet[couleur]" type="color" id="montre[bracelet][couleur]" x-model="data.form.montre.bracelet.couleur" name="bracelet_montre" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="montre[id_forme]">Forme <span class="text-danger">*</span></label>
                                <select
                                    name="id_forme"
                                    x-model.number="data.form.montre.forme.valeur" @change="choisirForme"
                                    id="id_forme" class="form-control"
                                >
                                    <option value="0">-------</option>
                                    <template x-for="forme in data.formes" :key="forme.id_forme">
                                        <option :value="forme.id_forme" x-text="forme.nom"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="col" x-show="data.temporaire.index.liste.length > 0"  x-transition>
                            <div class="mb-3">
                                <label for="montre[id_index]">Cadre</label>
                                <select
                                    x-model.number="data.form.montre.index.valeur" @change="choisirIndex"
                                    name="id_index" id="montre[id_index]" class="form-control"
                                >
                                    <option value="" >-------</option>
                                    <template x-for="index in data.temporaire.index.liste" :key="index.id_index">
                                        <option :value="index.id_index" x-text="index.nom"></option>
                                    </template>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="col" x-show="data.temporaire.index.images.length > 0"  x-transition>
                                <div class="mb-3">
                                    <label for="montre[id_index_image]">Image cadre</label>
                                    <select
                                        name="id_index_image"
                                        x-model.number="data.form.montre.index.image.valeur" @change="choisirImageIndex"
                                        class="form-control" id="montre[id_index_image]"
                                    >
                                        <option value="" >-------</option>
                                        <template x-for="image in data.temporaire.index.images" :key="image.id_index_media">
                                            <option :value="image.id_index_media" x-text="image.nom"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col" x-show="data.form.montre.index.image.valeur"  x-transition>
                                <div class="mb-3">
                                    <label for="montre[id_aiguille]">Aiguille</label>
                                    <select
                                        name="id_aiguille"
                                        x-model.number="data.form.montre.aiguille.valeur" @change="choisirAiguille"
                                        class="form-control" id="montre[id_aiguille]"
                                    >
                                        <option value="" >-------</option>
                                        <template x-for="aiguille in data.aiguilles" :key="aiguille.id_aiguille">
                                            <option :value="aiguille.id_aiguille" x-text="aiguille.nom"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="montre[id_arriere_plan]">Arrière Plan</label>
                                <select
                                    x-model.number="data.form.montre.arrierePlan.valeur"
                                    @change="choisirArrierePlan"
                                    :disabled="!data.form.montre.forme.valeur"
                                    name="id_arriere_plan" id="montre[id_arriere_plan]" class="form-control"
                                    >
                                    <option value="">-------</option>
                                    <template x-for="arrierePlan in data.arrierePlans" :key="arrierePlan.id_arriere_plan">
                                        <option :value="arrierePlan.id_arriere_plan" x-text="arrierePlan.nom"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="col" x-show="data.temporaire.arrierePlan.images.length > 0" x-transition>
                            <div class="mb-3">
                                <label for="montre[id_arriere_plan_image]">image arrière Plan</label>
                                <select
                                    name="id_arriere_plan_image"
                                    x-model.number="data.form.montre.arrierePlan.image.valeur"
                                    @change="choisirArrierePlanImage"
                                    id="montre[id_arriere_plan_image]"
                                    class="form-control"
                                    >
                                    <option value="">-------</option>
                                    <template x-for="arrierePlanImage in data.temporaire.arrierePlan.images" :key="arrierePlanImage.id_arriere_plan_media">
                                        <option :value="arrierePlanImage.id_arriere_plan_media" x-text="arrierePlanImage.nom"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-12 text-center" x-show="data.form.montre.arrierePlan.image.valeur" x-transition>
                            <hr>
                            <label>Taille de l'arriere plan</label>
                            <div>
                                <button :disabled="!data.form.montre.arrierePlan.image.valeur" @click.prevent="reduireTailleImageArrierePlan" type="button" class="btn btn-secondary" title="reduire"> - </button>
                                <button :disabled="!data.form.montre.arrierePlan.image.valeur" @click.prevent="augmenterTailleImageArrierePlan" type="button" class="btn btn-primary" title="augmenter"> + </button>
                            </div>
                        </div> --}}
                        <div class="col-12 text-center">
                            <hr>
                            <label>Taille de l'arriere plan</label>
                            <div>
                                <button @click.prevent="reduireTailleImageArrierePlan" type="button" class="btn btn-secondary" title="reduire"> - </button>
                                <button @click.prevent="augmenterTailleImageArrierePlan" type="button" class="btn btn-primary" title="augmenter"> + </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center" x-show="data.form.montre.forme.valeur" x-transition>
                                <hr class="my-2">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ajoutTexteModal">
                                    <span x-show="!data.form.montre.texte.valeur">Ajouter du texte</span>
                                    <span x-show="data.form.montre.texte.valeur">Modifier le texte</span>
                                </button>
                            </div>
                            <div class="row" x-show="data.form.montre.texte.valeur" x-transition>
                                <div class="col text-start">
                                    <label>Taille du texte</label>
                                    <div>
                                        <button  @click.prevent="reduireTailleTexte" type="button" class="btn btn-secondary" title="reduire"> - </button>
                                        <button  @click.prevent="augmenterTailleTexte" type="button" class="btn btn-primary" title="augmenter"> + </button>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <label>Position du texte</label> &nbsp;&nbsp;&nbsp;
                                    <div>
                                        <button @click.prevent="changerPositionTexteVersHaut" type="button" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"></path>
                                            </svg>
                                        </button>
                                        <button @click.prevent="changerPositionTexteVersBas" type="button" class="btn btn-secondary" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path>
                                                </svg>
                                        </button>
                                        <button @click.prevent="changerPositionTexteVersGauche" type="button" class="btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
                                            </svg>

                                        </button>
                                        <button @click.prevent="changerPositionTexteVersDroite" type="button" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                            </svg>

                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 mt-2" x-show="data.form.montre.forme.valeur">
                            <hr>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterImageModal">
                                    Ajouter une image
                                    </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card" x-show='data.etape == 2'>
            <div class="card-body">
                <div class="card-body">
                    <p class="alert alert-info">
                        Merci de vous connecter afin de poursuivre votre achat.
                    </p>
                    <p class="alert alert-danger" x-show="data.form.connection.erreur">
                        Email ou mot de passe incorrects
                    </p>
                    <form x-ref="formulaireConnection"  action="{{ route('user.login') }}" method="post">
                        <div class="mb-3">
                            <label>Email</label>
                            <input x-model="data.form.connection.email" type="text" :class="!estEmailValide(data.form.connection.email) && 'is-invalid'" class="form-control">
                            <div class="invalid-feedback">
                                Email invalid
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Mot de passe</label>
                            <input x-model="data.form.connection.password" type="password" :class="data.form.connection.password.length < 6 && 'is-invalid'" class="form-control">
                            <div class="invalid-feedback">
                                Le mot de passe doit faire au moins 6 caracteres
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mb-3">
                            <button @click.prevent="afficherFormulaireDeInscription" type="button" class="btn btn-link">S'inscrire</button>
                        </div>
                        <div class="mb-3 text-center">
                            <button @click.prevent="seConnecter" type="button" :disabled="!estValideFormulaireConnection" class="btn btn-primary btn-block">Se connecter</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="card" x-show='data.etape == 3'>
            <div class="card-body">
                <p class="alert alert-info">
                    Veuillez remplir ce formulaire pour vous inscrire
                    Merci de vous connecter afin de poursuivre votre achat.
                </p>
                <div class="alert alert-danger" x-show="!jQuery.isEmptyObject(data.form.inscription.erreur)">
                    <ul>
                        <template x-for="erreur in data.form.inscription.erreur">
                            <li x-text="erreur[0]"></li>
                        </template>
                    </ul>
                </div>
                <form  x-ref="formulaireInscription" action="{{ route('user.register') }}" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Nom</label>
                                <input x-model="data.form.inscription.nom" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Prenoms</label>
                                <input x-model="data.form.inscription.prenoms" type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input x-model="data.form.inscription.email" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Contact</label>
                        <input x-model="data.form.inscription.contact" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Mot de passe</label>
                        <input x-model="data.form.inscription.password" type="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Confirmation Mot de passe</label>
                        <input  x-model="data.form.inscription.password_confirmation"type="password" class="form-control">
                    </div>

                    <div class="d-flex justify-content-end mb-3">
                        <button @click.prevent="afficherFormulaireDeConnection" type="button" class="btn btn-link">Se connecter</button>
                    </div>

                    <div class="mb-3">
                        <button  @click.prevent="seInscrire" type="button" class="btn btn-success btn-block">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-12 text-center">
                <div class="card">
                    <div class="card-body align-self-center" data-previsualisation="card" x-ref="previsualisationCard">

                        <div
                            data-previsualisation="box"
                            x-ref="previsualisationBox"
                            :style="{backgroundSize: data.form.montre.arrierePlan.image.taille + 'px'}"
                            >
                            <img
                                data-image="forme"
                                :src="data.form.montre.forme.model.chemin"
                                x-show="!estObjetVide(data.form.montre.forme.model)"
                                >
                            <img
                                data-image="index"
                                :src="data.form.montre.index.image.model.chemin"
                                x-show="!estObjetVide(data.form.montre.index.image.model)"
                            >
                            <img
                                data-image="aiguille"
                                :src="data.form.montre.aiguille.model.chemin"
                                x-show="!estObjetVide(data.form.montre.aiguille.model)"
                            >

                            <p style="margin-top: 40%;"  x-show="!data.form.montre.forme.valeur">L'apercu de la montre s'affichera ici</p>


                            <p
                                data-texte="contenu"
                                x-ref="textContenu"
                                x-text='data.form.montre.texte.valeur'
                                :style="{
                                    fontSize:   data.form.montre.texte.taille + 'px',
                                    color:      data.form.montre.texte.couleur,
                                    fontFamily: data.form.montre.texte.police,
                                    left: data.form.montre.texte.positionX + '%',
                                    top: data.form.montre.texte.positionY + '%',
                                }"
                                ></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2">
                            <button  type="submit" class="btn btn-success" form="enregisterMontreClient">
                                <span x-show="!editMode">Enregistrer la montre</span>
                                <span x-show="editMode">Modifier la montre</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" x-ref="ajoutTexteModal" id="ajoutTexteModal"  tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" >Ajouter du texte</h1>
                    <button type="button" class="btn-close" @click.prevent="fermerModalAjoutTexte" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  method="POST" x-ref="ajouterTexteForme">
                        <div class="mb-3">
                            <label>Texte</label>
                            <input x-model="data.form.montre.texte.valeur" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Style de texte:</label>
                            <select class="form-contol" x-model="data.form.montre.texte.police">
                                <option value="">----</option>
                                <template x-for="police in data.polices">
                                    <option :value="police.valeur_police" x-text="police.valeur_police"></option>
                                </template>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Taille texte</label>
                            <input type="number" min="1" x-model="data.form.montre.texte.taille" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Couleur du texte</label>
                            <input type="color" x-model="data.form.montre.texte.couleur" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary"   @click.prevent="fermerModalAjoutTexte">Annuler</button>
                    <button type="submit" class="btn btn-primary" @click.prevent="validerModalAjoutTexte">Valider</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" x-ref="ajouterImageModal" id="ajouterImageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une image</h1>
                    <button type="button" class="btn-close" @click.prevent="annulerModalAjoutImage" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="imageMontre">Choisir l'image</label>
                            <input @input="choisirImage" type="file" id="imageMontre" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <template x-if="data.form.montre.arrierePlan.image.previsualiation">
                                <img :src="data.form.montre.arrierePlan.image.previsualiation" class="img-fluid">
                            </template>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button @click.prevent="annulerModalAjoutImage" type="button" class="btn btn-secondary">Annuler</button>
                    <button @click.prevent="ajouterImage" type="submit"  class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </div>
</div>
