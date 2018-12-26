<?php
if(!isset($_SESSION))
    session_start();
//if($_SESSION['str_PRIV_ID'] <> "opt" ) {
    if($_SESSION['str_PRIV_ID'] == "admin") {
        ?>
        <div
                id="m_ver_menu"
                class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                data-menu-vertical="true"
                data-menu-scrollable="false" data-menu-dropdown-timeout="500"
        >
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
                    <a href="index.php" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
					<span class="m-menu__link-wrap">
						<span class="m-menu__link-text">
							Tableau de bord
						</span>
						
					</span>
				</span>
                    </a>
                </li>
                <li class="m-menu__section">
                    <h4 class="m-menu__section-text">
                        Menu principal
                    </h4>
                    <i class="m-menu__section-icon flaticon-more-v3"></i>
                </li>
                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
                    <a href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-layers"></i>
                        <span class="m-menu__link-text">
					Factures
				</span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu" style="">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                                <a href="#" class="m-menu__link ">
							<span class="m-menu__link-text">
								Factures
							</span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a class="m-menu__link m_link" id="showListe" href="#">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
								Liste
							</span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a class="m-menu__link m_link" id="showExtractFile" href="#">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
								Extrait
							</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
                    <a href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-interface-1"></i>
                        <span class="m-menu__link-text">
					Configuration
				</span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                                <a href="#" class="m-menu__link ">
							<span class="m-menu__link-text">
								Configuration
							</span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a class="m-menu__link m_link" id="showPhase" href="#">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
								Branche
							</span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a class="m-menu__link m_link" id="showClient" href="#">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
								Client
							</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
                    <a href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-signs-2"></i>
                        <span class="m-menu__link-text">
					Sécurité
				</span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                                <a href="#" class="m-menu__link ">
							<span class="m-menu__link-text">
								Sécurité
							</span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a id="showUser" href="#" class="m-menu__link m_link">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
								Utilisateur
							</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <?php
    }
    else
    {
    ?>
        <div
                id="m_ver_menu"
                class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                data-menu-vertical="true"
                data-menu-scrollable="false" data-menu-dropdown-timeout="500"
        >
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
                    <a href="index.php" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
					<span class="m-menu__link-wrap">
						<span class="m-menu__link-text">
							Tableau de bord
						</span>
						
					</span>
				</span>
                    </a>
                </li>
                <li class="m-menu__section">
                    <h4 class="m-menu__section-text">
                        Menu principal
                    </h4>
                    <i class="m-menu__section-icon flaticon-more-v3"></i>
                </li>
                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
                    <a href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-layers"></i>
                        <span class="m-menu__link-text">
					Factures
				</span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu" style="">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                                <a href="#" class="m-menu__link ">
							<span class="m-menu__link-text">
								Factures
							</span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a class="m-menu__link m_link" id="showListe" href="#">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
								Liste
							</span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a class="m-menu__link m_link" id="showExtractFile" href="#">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
								Extrait
							</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
                    <a href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-interface-1"></i>
                        <span class="m-menu__link-text">
					Configuration
				</span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                                <a href="#" class="m-menu__link ">
							<span class="m-menu__link-text">
								Configuration
							</span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a class="m-menu__link m_link" id="showPhase" href="#">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
								Branche
							</span>
                                </a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a class="m-menu__link m_link" id="showClient" href="#">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
								Client
							</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    <?php
    }

?>	