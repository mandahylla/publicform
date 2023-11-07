<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="table-responsive"><BR/>
        <table id="demandTable" class="table table-striped table-hover my-0">
            <thead>
                <tr style="text-align:center">
                    <th>Début Voyage</th>
                    <th>Fin de voyage</th>
                    <th>Lieu de Destination</th>
                    <th>Passeport</th>
                    <th>Validité</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach ($demands as $demand) : ?> 
                    <?php if(($demand['statusOrder'] !== '2')) :?>   
                    <?php $dest = ""; ?>
                    <?php   foreach ($countries as $country) {
                                if($country['code'] === $demand['destination'])
                                    $dest = $country['name']; 
                            } 
                    ?>                    
                    <?php
                        
                        $dobtF = date_format(new DateTime($demand['dobt']),"d/m/Y");
                        $doetF = date_format(new DateTime($demand['doet']),"d/m/Y");
                    ?>
                    <tr>
                        <td><?= $dobtF; ?></td>
                        <td><?= $doetF; ?></td>
                        <td><?= $dest; ?></td>                        
                        <td><?= $demand['passport_num'];?></td>                        
                        <td><?= (!empty($demand['passport_date'])? date("d/m/Y", strtotime($demand['passport_date'])) : "")  ; ?></td>
                        <td>
                            <?php if($demand['statusOrder'] === '6') :?>
                                <span class="badge bg-danger"><?= $demand['status']; ?></span>
                            <?php elseif($demand['statusOrder'] === '5') :?>
                                <span class="badge bg-success"><?= $demand['status']; ?></span> 
                            <?php elseif($demand['statusOrder'] === '4') :?>    
                                <button type="submit" class="badge st-suspend btnRead" data-bs-toggle="modal" data-bs-target="#suspendListModal" data-id="<?= $demand['demandID']; ?>" data-fullname="<?= $demand['fullname']; ?>" data-dobt="<?= $demand['dobt']; ?>" 
                                    data-doet="<?= $demand['doet']; ?>" data-bctype="<?= $demand['bc_type']; ?>" data-bcnum="<?= $demand['bcnum']; ?>" 
                                    data-bcform="<?= $demand['bc_formula']; ?>" data-country="<?= $dest ; ?>" data-passport="<?= $demand['passport_num']; ?>" 
                                    data-passdate="<?= $demand['passport_date'];?>" data-stat="<?= $demand['status_id']; ?>" 
                                    data-comment="<?= $demand['comment']; ?>"><?= $demand['status']; ?></button>
                            <?php elseif($demand['statusOrder'] === '3') : ?>
                                <span class="badge bg-primary"><?= $demand['status']; ?></span>
                            <?php elseif($demand['statusOrder'] === '1') : ?>
                                <span class="badge st-primary"><?= $demand['status']; ?></span>    
                            <?php endif; ?>
                        </td>
                        <td>
                        <?php if(($demand['status'] === 'Clôturée')): ?>
                            <button type="submit" class="btn btn-primary btn-sm btnEdit" data-bs-toggle="modal" data-bs-target="#demandFormModal" data-id="<?= $demand['demandID']; ?>"
                                    data-dobt="<?= $demand['dobt']; ?>" data-doet="<?= $demand['doet']; ?>" data-bcnum="<?= $demand['bcnum']; ?>" data-zone="myzone<?= $demand['demandID']?>"
                                    data-country="<?= $dest ; ?>" data-passport="<?= $demand['passport_num']; ?>" data-passdate="<?= $demand['passport_date'];?>" data-stat="<?= $demand['status_id']; ?>" disabled>Modifier</button>
                                <form action="<?= base_url('demand/cancel/'. $demand['demandID']); ?>" method="post" class="d-inline">
                                    <!--<input type="hidden" name="_method" value="DELETE">-->
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment annuler cette demande ?')" disabled>Annuler</button>
                                </form>
                            <?php elseif(($demand['statusOrder'] >= 2)): ?>                             
                                <button type="submit" class="btn btn-outline-primary btn-sm" onclick="window.location.href='<?= base_url(); ?>demand/update/<?= $demand['demandID']; ?>';">Modifier</button>
                                    <?php if($user['role_name'] === "Client"):  ?>
                            <form action="<?= base_url('demand/cancel/' . $demand['demandID']); ?>" method="post" class="d-inline">
                                <!--<input type="hidden" name="_method" value="DELETE">-->
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment annuler cette demande ?')" disabled>Annuler</button>
                            </form>
                                    <?php endif; ?>
                            <?php else: ?>                             
                                <button type="submit" class="btn btn-outline-primary btn-sm" onclick="window.location.href='<?= base_url(); ?>demand/update/<?= $demand['demandID']; ?>';">Modifier</button>
                                    <?php if($user['role_name'] === "Client"):  ?>
								<form action="<?= base_url('demand/cancel/' . $demand['demandID']); ?>" method="post" class="d-inline">
									<!--<input type="hidden" name="_method" value="DELETE">-->
									<button class="btn btn-outline-danger btn-sm" onclick="return confirm('Voulez-vous vraiment annuler cette demande ? \n Cette action est irréversible.')">Annuler</button>
								</form>
                            <?php endif; ?>    
                        <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>