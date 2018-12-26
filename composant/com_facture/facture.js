var url = "composant/com_facture/controllerFacture.php";
var datatable = "";
$(function () {
    getAlphabetiqueWord();
    getAllClient();
    getAllBranche();
    useFiltre();

    $('.date_timepicker_start2').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                maxDate:jQuery('.date_timepicker_end').val()?jQuery('.date_timepicker_end').val():false
            })
        },
        timepicker:false
    });
    $('.date_timepicker_end2').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                minDate:jQuery('.date_timepicker_start').val()?jQuery('.date_timepicker_start').val():false
            })
        },
        timepicker:false
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
    $('#add_key_form').submit(function (e) {
        e.preventDefault();
        var str_FILE_NAME = $('#add_key_form #str_FILE_NAME').val();
//alert(str_FILE_NAME)
        printCourriers(str_FILE_NAME);
    });
    $('.btn[id="modal_add_key"]').click(function () {
        $("#download").addClass('hidden');
        $('.modal[id="modal_add_key"]').modal('show');
    });
    $('.btn[id="modal_add_data"]').click(function () {
        $('.modal[id="modal_add_data"]').modal('show');
    });
    $('.btn[id="modal_add_file"]').click(function () {
        $("#str_BRANCHE_FILE").val("C")
        $("#str_CLIENT_FILE").val("B")
        $("#str_NUMERO_POLICE_FILE").val("A")
        $("#str_DATE_EFFET_FILE").val("D")
        $("#str_DATE_ECHEANCE_FILE").val("E")
        $("#str_ACCESSOIRE_FILE").val("G")
        $("#int_TAXE_FILE").val("H")
        $("#int_PRIMENETTE_FILE").val("F")
        $("#str_BP_FILE").val("I")
        $("#str_TEL_FILE").val("J")
        $('.modal[id="modal_add_file"]').modal('show');
    });
    $('#add_file_key_form').submit(function (e) {
        e.preventDefault();

        addFileFacture();
    });
    $('#add_key_form').submit(function (e) {
        e.preventDefault();

        var str_NUMERO_POLICE = $('#modal_add_data #str_NUMERO_POLICE').val();
        var dt_EFFET = $('#modal_add_data #dt_EFFET').val();
        var dt_ECHEANCE = $('#modal_add_data #dt_ECHEANCE').val();
        var int_ACCESSOIRE = $('#modal_add_data #int_ACCESSOIRE').val();
        var int_TAXE = $('#modal_add_data #int_TAXE').val();
        var int_PRIME_NETTE = $('#modal_add_data #int_PRIME_NETTE').val();
        var str_BRANCHE_ID = $('#modal_add_data #str_BRANCHE_ID').val();
        var lg_CLIENT_ID = $('#modal_add_data #lg_CLIENT_ID').val();
        if ( str_NUMERO_POLICE == "" || dt_EFFET == "" || dt_ECHEANCE == "" || int_ACCESSOIRE == "" || int_TAXE == "" || int_PRIME_NETTE == "" || str_BRANCHE_ID == "" || lg_CLIENT_ID == "") {
            swal({
                title: "Echec",
                text: "Veuillez remplir tous les champs",
                type: "error",
                confirmButtonText: "Ok"
            });
            return false;
        } else {
            addCourrier();
        }
    });
    $("#generate").on('click', function(e){
        e.preventDefault();
        swal({
                title: 'Demande de Confirmation',
                text: "Etes-vous sûr de vouloir vous générer les courriers avec en-tête de cette période?\n\r Cella peut prendre du temps.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff5858',
                cancelButtonColor: '#fe4500',
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
                    swal(
                        'Génération',
                        'Génération en cours, veuillez patienter',
                        'info'
                    );
                    var lg_CLIENT_ID = $("#form_filter #lg_CLIENT_ID").val();
                    var str_DATE_DEBUT = $("#form_filter #str_DATE_DEBUT").val();
                    var str_DATE_FIN = $("#form_filter #str_DATE_FIN").val();
                    var str_BRANCHE_ID = $("#form_filter #str_BRANCHE_ID").val();
					//var str_PHASE_ID = $("#form_filter #str_PHASE").val();
                    //alert(str_BRANCHE_ID);
                    printCourriers('', lg_CLIENT_ID, str_BRANCHE_ID, str_DATE_DEBUT, str_DATE_FIN, 'printfAll');
                } else {
                    swal(
                        'Annulation',
                        'Opération annulé',
                        'error'
                    );
                }
            });
    });

    $("#generate_sans").on('click', function(e){
        e.preventDefault();
        swal({
                title: 'Demande de Confirmation',
                text: "Etes-vous sûr de vouloir vous générer les courriers sans en-tête de cette période?\n\r Cella peut prendre du temps.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff5858',
                cancelButtonColor: '#fe4500',
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
                    swal(
                        'Génération',
                        'Génération en cours, veuillez patienter',
                        'info'
                    );
                    var lg_CLIENT_ID = $("#form_filter #lg_CLIENT_ID").val();
                    var str_DATE_DEBUT = $("#form_filter #str_DATE_DEBUT").val();
                    var str_DATE_FIN = $("#form_filter #str_DATE_FIN").val();
                    var str_BRANCHE_ID = $("#form_filter #str_BRANCHE_ID").val();
                    var str_PHASE_ID = $("#form_filter #str_PHASE").val();
                    //alert(str_BRANCHE_ID);
                    //printCourriers('', str_INTERMEDIAIRE_ID, str_BRANCHE_ID, str_PHASE_ID, str_DATE_DEBUT, str_DATE_FIN, 'printfAllSansEntete');
                    printCourriers('', lg_CLIENT_ID, str_BRANCHE_ID, str_DATE_DEBUT, str_DATE_FIN, 'printfAllSansEntete');
                } else {
                    swal(
                        'Annulation',
                        'Opération annulé',
                        'error'
                    );
                }
            });
    });
});
function addFileFacture() {
    var form = $('#add_file_key_form').get(0);
    var formData = new FormData(form);
    $('#save_file').addClass('hidden');
    $.ajax({
        type		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url		: url, // the url where we want to POST
        data		: formData, // our data object
        dataType	: 'text', // what type of data do we expect back from the server
        processData: false,
        contentType: false,
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
                $('#save_file').removeClass('hidden');
            } else {
                $('#save_file').removeClass('hidden');
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
function getAlphabetiqueWord(){
    var task = "getAlphabetiqueWord";
    $.get(url+"?task="+task, function(json, textStatus){
        var obj = $.parseJSON(json);
        if (obj[0].code_statut == "1")
        {
            var results = obj[0].results;

            if (obj[0].results.length > 0)
            {
                $.each(results, function (i, value)//
                {
                    var option = $('<option value="' + results[i].str_WORD + '">'+results[i].str_WORD+'</tr>');
                    $('.ma_liste').append(option);
                });
            }
        }
    });
}

function addCourrier() {
    var form = $('#add_key_form').get(0);
    var formData = new FormData(form);
    $('#save_file').addClass('hidden');
    $.ajax({
        type		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url		: url, // the url where we want to POST
        data		: formData, // our data object
        dataType	: 'text', // what type of data do we expect back from the server
        processData: false,
        contentType: false,
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
                $('#save_file').removeClass('hidden');
                //getAllRevue("");
            } else {
                $('#save_file').removeClass('hidden');
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
function getAlphabetiqueWord(){
    var task = "getAlphabetiqueWord";
    $.get(url+"?task="+task, function(json, textStatus){
        var obj = $.parseJSON(json);
        if (obj[0].code_statut == "1")
        {
            var results = obj[0].results;

            if (obj[0].results.length > 0)
            {
                $.each(results, function (i, value)//
                {
                    var option = $('<option value="' + results[i].str_WORD + '">'+results[i].str_WORD+'</tr>');
                    $('.ma_liste').append(option);
                });
            }
        }
    });
}
function getAllClient(){
    var task = "getAllClient";
    $.get(url+"?task="+task+"&lg_CLIENT_ID=", function(json, textStatus){
        var obj = $.parseJSON(json);
        if (obj[0].code_statut == "1")
        {
            var results = obj[0].results;

            if (obj[0].results.length > 0)
            {
                $.each(results, function (i, value)//
                {
                    var option = $('<option value="' + results[i].lg_CLIENT_ID + '">'+results[i].str_NAME+'</tr>');
                    var optionMd = $('<option value="' + results[i].lg_CLIENT_ID + '">'+results[i].str_NAME+'</tr>');
                    $('#form_filter #lg_CLIENT_ID').append(option);

                    $('#modal_add_data #lg_CLIENT_ID').append(optionMd);
                });
                $('#form_filter #lg_CLIENT_ID').select2();
                //$('#modal_add_data #lg_CLIENT_ID').select2();
            }
        }
    });
}
function getAllBranche(){
    var task = "getAllBranche";
    $.get(url+"?task="+task+"&str_BRANCHE_ID=", function(json, textStatus){
        var obj = $.parseJSON(json);
        if (obj[0].code_statut == "1")
        {
            var results = obj[0].results;

            if (obj[0].results.length > 0)
            {
                $.each(results, function (i, value)//
                {
                    //console.log(results[i].lg_BRANCHE_ID)
                    let option = $('<option value="' + results[i].lg_BRANCHE_ID + '">'+results[i].str_LIBELLE+'</tr>');
                    let optionMd = $('<option value="' + results[i].lg_BRANCHE_ID + '">'+results[i].str_LIBELLE+'</tr>');
                    $('#form_filter #str_BRANCHE_ID').append(option);

                    $('#modal_add_data #str_BRANCHE_ID').append(optionMd);
                });
                $('#form_filter #str_BRANCHE_ID').select2();
            }
        }
    });
}

function useFiltre(){
    $("#form_filter").on('change', function() {

        var str_POLICE = $("#form_filter #str_POLICE").val();
        var lg_CLIENT_ID = $("#form_filter #lg_CLIENT_ID").val();
        var str_DATE_DEBUT = $("#form_filter #str_DATE_DEBUT").val();
        var str_DATE_FIN = $("#form_filter #str_DATE_FIN").val();
        var str_BRANCHE_ID = $("#form_filter #str_BRANCHE_ID").val();
        if(!(str_POLICE=="" && lg_CLIENT_ID == "" && str_DATE_DEBUT == "" && str_DATE_FIN == "" && str_BRANCHE_ID == ""))
        {
            getAllFacture("", lg_CLIENT_ID, str_DATE_DEBUT, str_DATE_FIN, str_BRANCHE_ID, str_POLICE);
        }
    });

}

function getAllFacture(lg_FACTURE_ID, str_INTERMEDIAIRE_ID, str_DATE_DEBUT, str_DATE_FIN, str_BRANCHE_ID, str_POLICE){
    var task = "getAllFacture";
    if($.fn.DataTable.isDataTable('#examples')) {
        datatable.destroy();
    }
    $.get(url+"?task="+task+"&lg_FACTURE_ID="+lg_FACTURE_ID+"&lg_CLIENT_ID="+str_INTERMEDIAIRE_ID+"&str_DATE_DEBUT="+str_DATE_DEBUT+"&str_DATE_FIN="+str_DATE_FIN+"&str_BRANCHE_ID="+str_BRANCHE_ID+"&str_POLICE="+str_POLICE, function(json, textStatus){

        var obj = $.parseJSON(json);
        $("#examples tbody").empty();

        if (obj[0].code_statut == "1")
        {
            var results = obj[0].results;

            if (obj[0].results.length > 0)
            {
                $.each(results, function (i, value)//
                {

                    var tr = $('<tr class="line-data-table" id="' + results[i].lg_FACTURE_ID + '"></tr>');
                    var td_FACTURE = $('<td class="column-data-table">' + (results[i].int_NUMFACT<10?+'0'+results[i].int_NUMFACT:results[i].int_NUMFACT) +'/'+ results[i].dt_DATE + '</td>');
                    var td_CLIENT = $('<td class="column-data-table">' + results[i].str_NAME + '</td>');
                    var td_BRANCHE = $('<td class="column-data-table">' + results[i].str_LIBELLE + '</td>');
                    var td_DATE_EFFET = $('<td class="column-data-table">' + results[i].dt_EFFET + '</td>');
                    var td_FIN_GARANTIE = $('<td class="column-data-table">' + results[i].dt_ECHEANCE + '</td>');
                    var td_POLICE = $('<td class="column-data-table">' + results[i].str_POLICE + '</td>');
                    var td_PRIME_TTC = $('<td class="column-data-table">' + results[i].int_ACCESSOIRE + '</td>');
                    var td_TAXE = $('<td class="column-data-table">' + results[i].int_TAXE + '</td>');
                    var td_PRIME_NETTE = $('<td class="column-data-table">' + results[i].int_PRIME_NETTE + '</td>');
                    var td_RIEN = $('<td class="column-data-table"></td>');
                    var btn_edit = $('<span class=" btn-action-custom btn-action-edit" id="modal_edit_key" data-toggle="modal"  title="modifier"><i class="fa fa-edit"></i> | </span> ').click(function () {
                        $('.modal[id="modal_edit_key"]').modal('show');
                        var id_key = $(this).parent().parent().attr('id');
                        //alert(id_key);return;
                        $('#edit-key-form #str_PHASE_ID').val(id_key);
                        getKeyById(id_key);
                    });
                    var btn_print = $('<span class=" btn-action-custom btn-action-edit" id="modal_edit_key" data-toggle="modal"  title="Imprimer sans en-tête" ><i class="fa fa-print"></i> | </span> ').click(function () {

                        let lg_FACTURE_ID = $(this).parent().parent().attr('id');
                        printCourriers(lg_FACTURE_ID, '', '', '', '', 'printf');
                    });

                    var btn_print_entete = $('<span class=" btn-action-custom btn-action-edit" id="modal_edit_key" data-toggle="modal"  title="imprimer avec en-tête"><i style="color: red;" class="fa fa-print"></i>  </span> ').click(function () {

                        let lg_FACTURE_ID = $(this).parent().parent().attr('id');
                        printCourriers(lg_FACTURE_ID,  '', '', '', '', 'print');
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
                    var td_action = $('<td class="column-data-table" colspan="2" align="center"></td>');
                    td_action.append(btn_print);
                    td_action.append(btn_print_entete);
                    /*td_action.append(btn_edit);
                    td_action.append(btn_delete);*/
                    tr.append(td_FACTURE);
                    tr.append(td_CLIENT);
                    tr.append(td_BRANCHE);
                    tr.append(td_DATE_EFFET);
                    tr.append(td_FIN_GARANTIE);
                    tr.append(td_POLICE);
                    tr.append(td_PRIME_TTC);
                    tr.append(td_TAXE);
                    tr.append(td_PRIME_NETTE);
                    tr.append(td_action);
                    tr.append(td_RIEN);
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
function isInteger(string) {
    var regx = /^\d+$/;
    if (!regx.test(string)) {
        return false
    } else {
        return true;
    }
}
function printCourriers(lg_FACTURE_ID, lg_CLIENT_ID, str_BRANCHE_ID, str_DATE_DEBUT, str_DATE_FIN, task)
{

    $.get("printf.php?task=" + task + "&lg_FACTURE_ID=" + lg_FACTURE_ID+ "&lg_CLIENT_ID=" + lg_CLIENT_ID+ "&str_BRANCHE_ID=" + str_BRANCHE_ID+ "&str_DATE_DEBUT=" + str_DATE_DEBUT+ "&str_DATE_FIN=" + str_DATE_FIN, function (json, textStatus)
    {
        var obj = $.parseJSON(json);
        if (obj[0].code_statut == "1")
        {
            var results = obj[0].results;
            console.log(obj[0].results.length)
            if (obj[0].results.length > 0)
            {
                /*swal({
                    title: 'Opération réussi !',
                    html: obj[0].results,
                    confirmButtonText: "<a href='"+obj[0].link_file+"' download=''>Télécharger</a>",
                });*/
                window.open(obj[0].link_file , '_blank');
                //window.location.href = obj[0].link_file;
            }
        }
        else{
            var results = obj[0].results;
            console.log(obj[0].results.length)
            if (obj[0].results.length > 0)
            {
                /*swal({
                    title: 'Opération réussi !',
                    html: obj[0].results,
                    confirmButtonText: "<a href='"+obj[0].link_file+"' download=''>Télécharger</a>",
                });*/
                window.open(obj[0].link_file , '_blank');
                //window.location.href = obj[0].link_file;
            }
        }
    });
}