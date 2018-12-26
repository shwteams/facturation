var url = "composant/com_client/controlerClient.php";
var datatable = "";
$(function () {
    getAllClient("");

    $('#modal_edit_key').submit(function (e) {
        e.preventDefault();
        var lg_CLIENT_ID = $('#modal_edit_key #lg_CLIENT_ID').val();
        var str_NAME = $('#modal_edit_key #str_LIBELLE_EDIT').val();
        var str_BP = $('#modal_edit_key #str_BP_EDIT').val();
        var str_TEL = $('#modal_edit_key #str_TEL_EDIT').val();

        if (lg_CLIENT_ID =="" || str_NAME == "" ) {
            swal({
                title: "Echec",
                text: "Veuillez remplir tous le champ",
                type: "error",
                confirmButtonText: "Ok"
            });
            return false;
        } else {
            editClient(lg_CLIENT_ID, str_NAME, str_BP, str_TEL);
        }

    });

    $('#add_key_form').submit(function (e) {
        e.preventDefault();
        var lg_CLIENT_ID = $('#add_key_form #lg_CLIENT_ID').val();
        var str_NAME = $('#add_key_form #str_LIBELLE').val();
        var str_BP = $('#add_key_form #str_BP').val();
        var str_TEL = $('#add_key_form #str_TEL').val();

        if ( str_NAME == "" ) {
            swal({
                title: "Echec",
                text: "Veuillez remplir tous les champs",
                type: "error",
                confirmButtonText: "Ok"
            });
            return false;
        } else {
            //console.log("add table")
            //lert(str_BP, str_TEL);
            addClient(str_NAME, str_BP, str_TEL);
        }
    });

    $('.btn[id="modal_add_key"]').click(function () {
        /*$('#modal_edit_key #str_LIBELLE').val("");
         $('#modal_edit_key #int_NUMBER_PLACE').val("");*/
        $('.modal[id="modal_add_key"]').modal('show');
        $('#modal_add_key select').select2({
            language: "fr"
        });
    });
});

$(document).ready(function(){
    $('.date_timepicker_start').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                maxDate:jQuery('.date_timepicker_end').val()?jQuery('.date_timepicker_end').val():false
            })
        },
        timepicker:false
    });
    $('.date_timepicker_end').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                minDate:jQuery('.date_timepicker_start').val()?jQuery('.date_timepicker_start').val():false
            })
        },
        timepicker:false
    });
});

function getAllClient(lg_CLIENT_ID){
    var task = "getAllClient";
    
    $.get(url+"?task="+task+"&lg_CLIENT_ID="+lg_CLIENT_ID, function(json, textStatus){
        
        var obj = $.parseJSON(json);
        $("#examples tbody").empty();
        
        if (obj[0].code_statut == "1")
        {
            var results = obj[0].results;
            
            if (obj[0].results.length > 0)
            {
                $.each(results, function (i, value)//
                {
                    var tr = $('<tr class="line-data-table" id="' + results[i].lg_CLIENT_ID + '"></tr>');
                    var td_LIBELLE = $('<td class="column-data-table">' + results[i].str_NAME + '</td>');
                    var td_BP = $('<td class="column-data-table">' + results[i].str_BP + '</td>');
                    var td_TEL = $('<td class="column-data-table">' + results[i].str_TEL + '</td>');
                    var td_RIEN = $('<td class="column-data-table"></td>');
                    var btn_edit = $('<span class=" btn-action-custom btn-action-edit" id="modal_edit_key" data-toggle="modal"  title="Modifier"><i class="fa fa-edit"></i> | </span> ').click(function () {
                        $('.modal[id="modal_edit_key"]').modal('show');
                        var id_key = $(this).parent().parent().attr('id');
                        //alert(id_key);return;
                        $('#edit-key-form #lg_CLIENT_ID').val(id_key);
                        getKeyById(id_key);
                    });
                    
                    var btn_delete = $('<span class="btn-action-custom btn-action-delete" title="Supprimer"> <i class="fa fa-trash"></i></span>').click(function () {
                        var id_key = $(this).parent().parent().attr('id');
                        
                        //$('#edit-key-form #lg_OFFRE_ID').val(id_key);
                        swal({
                            title: 'Demande de Confirmation',
                            text: "Etes-vous sûr de vouloir supprimer cette donnée ?'",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#f44336',
                            cancelButtonColor: '#f48928',
                            confirmButtonText: 'Oui',
                            cancelButtonText: 'Non',
                            confirmButtonClass: 'btn btn-success',
                            cancelButtonClass: 'btn btn-danger',
                            buttonsStyling: false,
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                deletePhase(id_key);
                            } else {
                                swal(
                                    'Annulation',
                                    'Opération annulé',
                                    'error'
                                );
                            }
                        })
                        getKeyById(id_key);
                    });
                    var td_action = $('<td class="column-data-table" align="center"></td>');
                    var td_rien = $('<td class="column-data-table" ></td>');
                    td_action.append(btn_edit);
                    td_action.append(btn_delete);
                    tr.append(td_LIBELLE);
                    tr.append(td_BP);
                    tr.append(td_TEL);
                    tr.append(td_action);
                    tr.append(td_rien);
                    $("#examples tbody").append(tr);
                });
            }
            
                
            if ($.fn.dataTable.isDataTable('#example')) {
                table = $('#example').DataTable();
            }
            else {
                table = $('#example').DataTable({
                    paging: false
                });
            }
            datatable = $('#examples').DataTable({
                "language": {
                    "lengthMenu": "Afficher _MENU_ enregistrements",
                    "zeroRecords": "Aucune ligne trouvée",
                    "info": "Affichage des enregistrements _START_ &agrave; _END_ sur _TOTAL_ enregistrements",
                    "infoEmpty": "Aucun enregistrement trouvé",
                    "infoFiltered": "(filtr&eacute; de _MAX_ enregistrements au total)",
                    "emptyTable": "Aucune donnée disponible dans le tableau",
                    "search": "Recherche",
                    "zeroRecords":    "Aucun enregistrement &agrave; afficher",
                            "paginate": {
                                "first": "Premier",
                                "last": "Dernier",
                                "next": "Suivant",
                                "previous": "Précédent"
                            }
                },
                aria: {
                    sortAscending: ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }, responsive: true, retrieve: true
            });
        }

    });
}
function addClient(str_NAME, str_BP, str_TEL) {

    $.ajax({
        url: url, // La ressource ciblée
        type: 'POST', // Le type de la requête HTTP.
        data: 'addClient=addClient&str_LIBELLE=' + str_NAME +'&str_BP='+str_BP+"&str_TEL="+str_TEL,
        dataType: 'text',
        success: function (response) {
            var obj = $.parseJSON(response);
            if (obj[0].code_statut == "1")
            {
                swal({
                    title: "Opération réussie!",
                    text: obj[0].results,
                    type: "success",
                    confirmButtonText: "Ok"
                });
                $('#contenue-application .modal').modal('hide');
                if ($.fn.DataTable.isDataTable('#examples')) {
                    if ($.fn.DataTable.isDataTable('#examples')) {
                        datatable.destroy();
                    }
                }
                getAllClient("");
            } else {
                //alert(obj[0].results);
                swal({
                    title: "Echec de l'opéraion",
                    text: obj[0].results,
                    type: "error",
                    confirmButtonText: "Ok"
                });
                $('#contenue-application .modal').modal('hide');
            }
        }
    });
}
function editClient(lg_CLIENT_ID, str_NAME, str_BP, str_TEL) {
    $.ajax({
        url: url, // La ressource ciblée
        type: 'POST', // Le type de la requête HTTP.
        data: 'editClient=editClient&str_LIBELLE_EDIT=' + str_NAME+'&str_BP_EDIT='+str_BP+"&str_TEL_EDIT="+str_TEL + '&lg_CLIENT_ID='+lg_CLIENT_ID,
        dataType: 'text',
        success: function (response) {
            //alert(json);return;
            var obj = $.parseJSON(response);
            if (obj[0].code_statut == "1")
            {
                swal({
                    title: "Opération réussie!",
                    text: obj[0].results,
                    type: "success",
                    confirmButtonText: "Ok"
                });
                $('#contenue-application .modal').modal('hide');
                if ($.fn.DataTable.isDataTable('#examples')) {
                    datatable.destroy();
                }
                getAllClient("");
            } else {
                //alert(obj[0].results);
                swal({
                    title: "Echec de l'opéraion",
                    text: obj[0].results,
                    type: "error",
                    confirmButtonText: "Ok"
                });
                $('#contenue-application .modal').modal('hide');
            }
        }
    });
}
function deletePhase(lg_CLIENT_ID) {
    //alert(lg_CLIENT_ID);
    $.ajax({
        url: url, // La ressource ciblée
        type: 'GET', // Le type de la requête HTTP.
        data: 'task=deletePhase&lg_CLIENT_ID=' + lg_CLIENT_ID,
        dataType: 'text',
        success: function (response) {
            var obj = $.parseJSON(response);
            if (obj[0].code_statut == "1")
            {
                swal({
                    title: "Opération réussie!",
                    text: obj[0].results,
                    type: "success",
                    confirmButtonText: "Ok"
                });
                $('#contenue-application .modal').modal('hide');
                if ($.fn.DataTable.isDataTable('#examples')) {
                    datatable.destroy();
                }
                getAllClient("");
            } else {
                //alert(obj[0].results);
                swal({
                    title: "Echec de l'opéraion",
                    text: obj[0].results,
                    type: "error",
                    confirmButtonText: "Ok"
                });
                $('#contenue-application .modal').modal('hide');
            }
        }
    });
}
function getKeyById(lg_CLIENT_ID)
{
    //alert(lg_OFFRE_ID);
    var task = "getAllClient";
    $.get(url + "?task=" + task + "&lg_CLIENT_ID=" + lg_CLIENT_ID, function (json, textStatus)
    {
        var obj = $.parseJSON(json);
        if (obj[0].code_statut == "1")
        {

            var results = obj[0].results;
            if (obj[0].results.length > 0)
            {
                $.each(results, function (i, value)
                {
                    $('#modal_edit_key #lg_CLIENT_ID').val(results[i].lg_CLIENT_ID);
                    $('#modal_edit_key #str_LIBELLE_EDIT').val(results[i].str_NAME);
                    $('#modal_edit_key #str_DATE_DEBUT_EDIT').val(results[i].dt_DEBUT);
                    $('#modal_edit_key #str_DATE_FIN_EDIT').val(results[i].dt_FIN);
                });
            }
        }
    });
}

function isInteger(string) {
    var regx = /^\d+$/;
    if (!regx.test(string)) {
        return false
    } else {
        return true;
    }
}