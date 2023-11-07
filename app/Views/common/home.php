<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<?php if ($user['role_name'] === "Banquier"):  ?>
    <div class="w-100">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Nouvelles demandes (<?= date('d/m/Y'); ?>)</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text align-middle"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $newDayDemands ; ?></h1>
                        <div class="mb-0">
                            
                            <span class="text-muted">Sur <span class="badge badge-primary-light"><i class="mdi mdi-arrow-bottom-right"></i> <?= $traitingDemands; ?> </span> Demande(s) totale(s) à traiter</span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Demandes en Attente de Compléments Ce mois (<?= date('m/Y'); ?>)</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $waitingMDemands; ?></h1>
                        <div class="mb-0">
                            <span class="text-muted">Sur</span>
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> <?= $waitingDemands; ?> </span>
                            <span class="text-muted">Au total</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Demandes Validées au (<?= date('d/m/Y'); ?>)</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle align-middle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $enabledDayDemands; ?></h1>
                        <div class="mb-0">
                            <span class="text-muted">Sur</span>
                            <span class="badge badge-danger-light"> <i class="mdi mdi-arrow-bottom-right"></i> <?= $enabledDemands; ?> </span>
                            <span class="text-muted">au Total ce Mois</span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Demandes Clôturées Ce mois (<?= date('m/Y'); ?>)</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder-minus align-middle"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="9" y1="14" x2="15" y2="14"></line></svg>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $closedMDemands; ?></h1>
                        <div class="mb-0">
                            <span class="text-muted">Sur</span>
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i><?= $closedDemands; ?> </span>
                            <span class="text-muted">Au total </span>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
<?php endif ?>
    
<?= $this->endSection(); ?>