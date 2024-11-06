@extends('./layouts/beneficiary_page')
@section('title')
@endsection
@section('css')
@endsection
@section('content')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
<div class="table-responsive">
   
</div>
</div>
</div></div></div></section>
@endsection
@section('modal_part')

@endsection
<script>
    function confirmDeletion(articleId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce critere ?')) {
            // Si l'utilisateur confirme, soumettre le formulaire
            document.getElementById('delete-form-' + articleId).submit();
        }
    }
</script>
    <script>
        function edit_grille(id){
                    var id=id;
                   // alert(id);
                    var url = "{{ route('critere.modif') }}";
                    $.ajax({
                        url: url,
                        type:'GET',
                        dataType:'json',
                        data: {id: id} ,
                        error:function(){alert('error');},
                        success:function(data){
                            console.log(data)
                            $("#grille_id").val(data.id);
                            $("#rubrique_u").val(data.rubrique_id); 
                            $("#type_entreprise_u").val(data.type_entreprise); 
                             
                            $("#categorie_u").val(data.categorie);                           
                           $("#libelle_u").val(data.libelle);
                           $("#ponderation_u").val(data.ponderation);
                          
                        }
                    });
            }
    </script>

    <script>

    function detailUser(id){
                var id=id;

                $.ajax({
                    url: url,
                    type:'GET',
                    dataType:'json',
                    data: {id: id} ,
                    error:function(){alert('error');},
                    success:function(data){
                        $("#nom_user").text(data.nomUser);
                        $("#prenom_user").text(data.prenomUser);
                        $("#email_user").text(data.emailUser);
                        $("#telephone_user").text(data.telephone);
                        $("#login_user").text(data.login);
                    }
                });
        }
        function idstatus (id){
            var id= id;

            $.ajax({
                url: url,
                type:'GET',
                data: {id: id} ,
                error:function(){alert('error');},
                success:function(){
                }

            });
        }
        function delConfirm (id){
            //alert(id);
            $(function(){
                //alert(id);
                document.getElementById("id_table").setAttribute("value", id);
            });

        }

        function recu_id(){
            //var id= document.getElementById('id_table').value;
            $(function(){
                var id= $("#id_table").val();

                //alert(id);
                $.ajax({
                    url: url,
                    type:'GET',
                    data: {id: id} ,
                    error:function(){alert('error');},
                    success:function(){
                        $('#modal-user-reinitialise').hide();
                        location.reload();

                    }
                });
            });
        }

        function supp_id(){
            $(function(){
                var id= $("#id_table").val();

                //alert(id);
                $.ajax({
                    url: url,
                    type:'GET',
                    data: {id: id} ,
                    error:function(){alert('error');},
                    success:function(){
                        $('#modal-confirm-delete').hide();
                        location.reload();

                    }
                });
            });
        }
    </script>


