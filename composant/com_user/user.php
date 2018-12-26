<?php

class User {

    static function showAllUser() {
        ?>
        <script src="composant/com_user/user.js"></script>
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
									Sécurité
								</span>
							</a>
						</li>
						<li class="m-nav__separator">
							-
						</li>
						<li class="m-nav__item">
							<a href="" class="m-nav__link">
								<span class="m-nav__link-text">
									Liste des utilisateurs
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
									Liste des utilisateurs
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
									<td>Logins</td>
									<td>Noms</td>
									<td>Prénoms</td>
									<td>Emails</td>
									<td>Types utilisateur</td>
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
                                    <label for="str_NAME" class="col-sm-12 control-label">Nom <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_NAME" name="str_NAME" placeholder="Nom" type="text" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_LASTNAME" class="col-sm-12 control-label">Prénom <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_LASTNAME" name="str_LASTNAME" placeholder="Prénom" type="text" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_EMAIL" class="col-sm-12 control-label">Email <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_EMAIL" name="str_EMAIL" type="email" placeholder="Email" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_LOGIN" class="col-sm-12 control-label">Nom d'utilisateur <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_LOGIN" name="str_LOGIN" placeholder="Nom d'utilisateur" type="text" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_PASSWORD" class="col-sm-12 control-label">Mot de passe <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_PASSWORD" name="str_PASSWORD" placeholder="Mot de passe" type="password" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_PASSWORD_CONF" class="col-sm-12 control-label">Mot de passe <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_PASSWORD_CONF" name="str_PASSWORD_CONF" placeholder="Confirmer le mot de passe" type="password" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_PRIVILEGE" class="col-sm-12 control-label">Privilège <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <select name="str_PRIVILEGE" id="str_PRIVILEGE" class="select2me" required="" style="width: 100% !important;" >
                                            <option value="opt">Opérateur</option>
                                            <option value="dec">Décideur</option>
                                            <option value="admin">Administrateur</option>
                                        </select>
                                    </div>
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
            <div class="modal-dialog">
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
                                    <label for="str_NAME" class="col-sm-12 control-label">Nom <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_NAME_EDIT" name="str_NAME_EDIT" placeholder="Nom" type="text" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_LASTNAME" class="col-sm-12 control-label">Prénom <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_LASTNAME_EDIT" name="str_LASTNAME_EDIT" placeholder="Prénom" type="text" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_EMAIL" class="col-sm-12 control-label">Email <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_EMAIL_EDIT" name="str_EMAIL_EDIT" type="email" placeholder="Email" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_LOGIN" class="col-sm-12 control-label">Nom d'utilisateur <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_LOGIN_EDIT" name="str_LOGIN_EDIT" placeholder="Nom d'utilisateur" type="text" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_PASSWORD" class="col-sm-12 control-label">Mot de passe <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_PASSWORD_EDIT" name="str_PASSWORD_EDIT" placeholder="Mot de passe" type="password" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_PASSWORD_CONF" class="col-sm-12 control-label">Mot de passe <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" id="str_PASSWORD_CONF_EDIT" name="str_PASSWORD_CONF_EDIT" placeholder="Confirmer le mot de passe" type="password" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="str_PRIVILEGE" class="col-sm-12 control-label">Privilège <span class="require">*</span> :</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="str_PRIVILEGE_EDIT" id="str_PRIVILEGE_EDIT" required="" style="width: 100% !important;" >
                                            <option value="opt">Opérateur</option>
                                            <option value="dec">Décideur</option>
                                            <option value="admin">Administrateur</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="str_SECURITY_ID" id="str_SECURITY_ID" />
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
