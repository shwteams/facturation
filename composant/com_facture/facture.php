<?php
class Facture{
    public static function showAllFacture(){
        ?>
        <script src="composant/com_facture/facture.js"></script>
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Tableau de bord
                    </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            -
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
								<span class="m-nav__link-text">
									Facture
								</span>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            -
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
								<span class="m-nav__link-text">
									Liste
								</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="m-content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Liste des factures
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body" >
                            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <form action="/action_page.php" role="form" id="form_filter">
                                            <div class="form-group m-form__group row align-items-center">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="m-form__group m-form__group--inline">
                                                            <div class="m-form__label">
                                                                <label class="m-label m-label--single" for="str_POLICE">
                                                                    Numéro&nbsp;de&nbsp;police:
                                                                </label>
                                                            </div>
                                                            <div class="m-form__control">
                                                                <input type="text" class="form-control" id="str_POLICE" name="str_POLICE">
                                                            </div>
                                                        </div>
                                                        <div class="d-md-none m--margin-bottom-10"></div>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-6">
                                                        <div class="m-form__group m-form__group--inline">
                                                            <div class="m-form__label">
                                                                <label>
                                                                    Client:
                                                                </label>
                                                            </div>
                                                            <div class="m-form__control">
                                                                <select name="lg_CLIENT_ID" id="lg_CLIENT_ID" class="form-control select2me" >
                                                                    <option value="">Selectionner un client</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="d-md-none m--margin-bottom-10"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="m-form__group m-form__group--inline">
                                                            <div class="m-form__label">
                                                                <label>
                                                                    Branche:
                                                                </label>
                                                            </div>
                                                            <div class="m-form__control">
                                                                <select name="str_BRANCHE_ID" id="str_BRANCHE_ID" class="form-control select2me" >
                                                                    <option value="">Selectionner une branche</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="d-md-none m--margin-bottom-10"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="m-form__group m-form__group--inline">
                                                            <div class="m-form__label">
                                                                <label class="m-label m-label--single">
                                                                    Date&nbsp;de&nbsp;début:
                                                                </label>
                                                            </div>
                                                            <div class="m-form__control">
                                                                <input type="text" class="form-control date_timepicker_start" id="str_DATE_DEBUT" name="str_DATE_DEBUT">
                                                            </div>
                                                        </div>
                                                        <div class="d-md-none m--margin-bottom-10"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="m-form__group m-form__group--inline">
                                                            <div class="m-form__label">
                                                                <label class="m-label m-label--single">
                                                                    Date&nbsp;de&nbsp;fin:
                                                                </label>
                                                            </div>
                                                            <div class="m-form__control">
                                                                <input type="text" class="form-control date_timepicker_end" id="str_DATE_FIN" name="str_DATE_FIN">
                                                            </div>
                                                        </div>
                                                        <div class="d-md-none m--margin-bottom-10"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                        <button type="button" class="btn btn-danger" id="modal_add_file" data-toggle="modal">
                                            <i class="fa fa-plus"></i> Intégrer le fichier
                                        </button>
                                        <button type="button" class="btn btn-danger" id="modal_add_data" data-toggle="modal">
                                            <i class="fa fa-plus"></i> Ajouter
                                        </button>
                                        <button type="button" class="btn btn-outline-primary" id="generate" data-toggle="modal">
                                            <i class="fa fa-file-o"></i> Générer
                                        </button>

                                        <button type="button" class="btn btn-default" id="generate_sans" data-toggle="modal">
                                            <i class="fa fa-file-o"></i> Générer sans entête
                                        </button>
                                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-hover clo" id="examples" >
                                <thead>
                                <tr>
                                    <td>N° Factures</td>
                                    <td>Clients</td>
                                    <td>Branches</td>
                                    <td>dates effets</td>
                                    <td>date échéances</td>
                                    <td>N° police</td>
                                    <td>Accessoire</td>
                                    <td>Taxes</td>
                                    <td>Prime nettes</td>
                                    <td>Actions</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody >

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-success fade" id="modal_add_data" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form class="form-horizontal" role="form" id="add_key_form">
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="str_BRANCHE_ID" class="control-label">Branche <span class="require">*</span> :</label>
                                        <select name="str_BRANCHE_ID" id="str_BRANCHE_ID" class="form-control select2me" required>

                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="lg_CLIENT_ID" class="control-label">Client <span class="require">*</span> :</label>
                                        <select name="lg_CLIENT_ID" id="lg_CLIENT_ID" class="form-control select2me" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="str_NUMERO_POLICE" class="control-label">N° police <span class="require">*</span> :</label>
                                        <input type="text" name="str_NUMERO_POLICE" id="str_NUMERO_POLICE" class="form-control">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="dt_EFFET" class="control-label">Date effet <span class="require">*</span> :</label>
                                        <input type="text" name="dt_EFFET" id="dt_EFFET" class="form-control date_timepicker_start2">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="dt_ECHEANCE" class="control-label">Date echéance <span class="require">*</span> :</label>
                                        <input type="text" name="dt_ECHEANCE" id="dt_ECHEANCE" class="form-control date_timepicker_end2">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="int_ACCESSOIRE" class="control-label">Accessoire <span class="require">*</span> :</label>
                                        <input type="number" min="0" name="int_ACCESSOIRE" id="int_ACCESSOIRE" class="form-control">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="int_TAXE" class="control-label">Taxe <span class="require">*</span> :</label>
                                        <input type="number" step="any" min="0" max="100" name="int_TAXE" id="int_TAXE" class="form-control">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="int_PRIME_NETTE" class="control-label">Prime nette <span class="require">*</span> :</label>
                                        <input type="number" min="0" name="int_PRIME_NETTE" id="int_PRIME_NETTE" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="addFacture" id="addFacture" value="addFacture"/>
                            <button type="submit" class="btn btn-danger pull-right" id="save_file" style="margin-left: 3px;">Enregistrer</button>
                            <button type="reset" class="btn btn-default pull-right" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal modal-success fade" id="modal_add_file" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form class="form-horizontal" role="form" id="add_file_key_form">
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="col-xs-12 col-xs-offset-2" >
                                        <label for="str_FILE" class="control-label">Selectionner un fichier xlsx <span class="require">*</span> :</label>
                                        <input type="file" id="str_FILE" accept=".xlsx" name="str_ILLUSTRATION" class="str_ILLUSTRATION" data-buttonText="Charger fichier utilisateurs" data-buttonName="btn-primary" data-iconName="glyphicon glyphicon-inbox" data-buttonBefore="true" data-placeholder="Aucun fichier selectionné" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="str_BRANCHE_FILE" class="control-label">Branche <span class="require">*</span> :</label>
                                        <select name="str_BRANCHE_FILE" id="str_BRANCHE_FILE" class="form-control ma_liste select2me" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="str_CLIENT_FILE" class="control-label">Client <span class="require">*</span> :</label>
                                        <select name="str_CLIENT_FILE" id="str_CLIENT_FILE" class="form-control ma_liste select2me" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="str_NUMERO_POLICE_FILE" class="control-label">Numéro police <span class="require">*</span> :</label>
                                        <select name="str_NUMERO_POLICE_FILE" id="str_NUMERO_POLICE_FILE" class="form-control ma_liste select2me" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="str_DATE_EFFET_FILE" class="control-label">Date effet <span class="require">*</span> :</label>
                                        <select name="str_DATE_EFFET_FILE" id="str_DATE_EFFET_FILE" class="form-control ma_liste select2me" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="str_DATE_ECHEANCE_FILE" class="control-label">Date échéance <span class="require">*</span> :</label>
                                        <select name="str_DATE_ECHEANCE_FILE" id="str_DATE_ECHEANCE_FILE" class="form-control ma_liste select2me" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12"><!--- -->
                                        <label for="str_ACCESSOIRE_FILE" class="control-label">Accessoire <span class="require">*</span> :</label>
                                        <select name="str_ACCESSOIRE_FILE" id="str_ACCESSOIRE_FILE" class="form-control ma_liste select2me" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="int_TAXE_FILE" class="control-label">Taxe <span class="require">*</span> :</label>
                                        <select name="int_TAXE_FILE" id="int_TAXE_FILE" class="form-control ma_liste select2me" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="int_PRIMENETTE_FILE" class="control-label">Prime nette <span class="require">*</span> :</label>
                                        <select name="int_PRIMENETTE_FILE" id="int_PRIMENETTE_FILE" class="form-control ma_liste select2me" required>
                                            <option value=""></option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="str_BP_FILE" class="control-label">Boite postal <span class="require"></span> :</label>
                                        <select name="str_BP_FILE" id="str_BP_FILE" class="form-control ma_liste select2me" >
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="str_TEL_FILE" class="control-label">Téléphone <span class="require"></span> :</label>
                                        <select name="str_TEL_FILE" id="str_TEL_FILE" class="form-control ma_liste select2me" >
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="addFactureFile" id="addFactureFile" value="addFactureFile"/>
                            <button type="submit" class="btn btn-danger pull-right" id="save_file" style="margin-left: 3px;">Enregistrer</button>
                            <button type="reset" class="btn btn-default pull-right" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}