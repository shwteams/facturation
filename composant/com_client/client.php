<?php

class Client {

    static function showAllClient() {
        ?>
        <script src="composant/com_client/client.js"></script>
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
									Configuration
								</span>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            -
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
								<span class="m-nav__link-text">
									Client
								</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="m-content">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Liste des clients
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="pull-right">
                                <button type="button" class="btn btn-danger" id="modal_add_key" data-toggle="modal">
                                    <i class="fa fa-plus"></i> Ajouter
                                </button>
                            </div>
                        </div>
                        <table class="table table-striped table-hover clo" id="examples" >
                            <thead>
                                <tr>
                                    <td>Nom</td>
                                    <td>Téléphone</td>
                                    <td>Boite postal</td>
                                    <td>Actions</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-success fade" id="modal_add_key" role="dialog">
            <div class="modal-dialog ">
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
                                    <label for="str_LIBELLE" class="col-sm-12 control-label">Libelle <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_LIBELLE" name="str_LIBELLE" placeholder="Client" type="text" required="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="str_BP" class="control-label">Boite postale :</label>
                                    <input type="text" name="str_BP" id="str_BP" class="form-control">
                                </div>
                                <div class="col-sm-12">
                                    <label for="str_TEL" class="control-label">Téléphone :</label>
                                    <input type="tel" name="str_TEL" id="str_TEL" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger pull-right" id="saved" style="margin-left: 3px;">Enregistrer</button>
                            <button type="reset" class="btn btn-default pull-right" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal modal-success fade" id="modal_edit_key" role="dialog">
            <div class="modal-dialog ">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modifier</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form class="form-horizontal" role="form" id="edit_key_form">
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="str_LIBELLE_EDIT" class="col-sm-12 control-label">Libelle <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_LIBELLE_EDIT" name="str_LIBELLE_EDIT" placeholder="Client" type="text" required="">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="str_BP_EDIT" class="control-label">Boite postale :</label>
                                        <input type="text" name="str_BP" id="str_BP_EDIT" class="form-control">
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="str_TEL_EDIT" class="control-label">Téléphone :</label>
                                        <input type="tel" name="str_TEL" id="str_TEL_EDIT" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="lg_CLIENT_ID" id="lg_CLIENT_ID" />
                            <button type="submit" class="btn btn-danger pull-right" id="saved_edit" style="margin-left: 3px;">Enregistrer</button>
                            <button type="reset" class="btn btn-default pull-right" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php

    }

}
