<nav class="navbar navbar-expand navbar-light navbar-bg">

    <?php if(!empty($user) AND ($user['role_name'] === 'Administrateur') ): ?>
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a> 
    <?php endif ?>
    <ul class="navbar-nav d-none d-lg-flex">
    <?php if (!empty($user) AND ($user['role_name'] === 'Client') ):  ?>
        <li class="nav-item px-2">
            <a class="nav-link" href="<?= base_url('home') ?>" id="megaDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Accueil
            </a>
        </li>
        <li class="nav-item px-2">
            <a class="nav-link" href="<?= base_url('demand') ?>" id="megaDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Ouvrir une nouvelle demande
            </a>
        </li>
         <li class="nav-item">
            <a class="nav-link" href="<?= base_url('demands') ?>" id="resourcesDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Mes demandes
            </a>
        </li>
    <?php elseif (!empty($user) AND ($user['role_name'] === "Banquier")):  ?>
        <li class="nav-item px-2">
            <a class="nav-link" href="<?= base_url('home') ?>" id="megaDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Tableau de Bord
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('demands') ?>" id="resourcesDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Liste des demandes
            </a>
        </li>
    <?php endif ?>
    </ul>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">            
            <?php if(!empty($user) AND ($user['role_name'] === ('Administrateur' || 'Banquier')) ): ?>
                <?= $this->include('layouts/notifications'); ?>    
            <?php endif ?>               
                
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="<?= base_url('assets/img/avatars/avatar-6.png') ?>" class="avatar img-fluid rounded me-1" alt="<?= $user['fullname']; ?>" /> <span class="text-dark"><?= $user['fullname']; ?></span>
                </a>        
                <div class="dropdown-menu dropdown-menu-end">
                    <?php if(!empty($user) AND ($user['role_name'] ===('Administrateur')) ): ?>
                    <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="pages-settings.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                    <div class="dropdown-divider"></div>
                    <?php endif ?>
                    <a class="dropdown-item" href="<?= base_url('Welcome/logout'); ?> ">Déconnexion</a>
                </div>               
            </li>
        </ul>
    </div>
</nav>