<!-- <?php //if(($demand['status'] === 'Clôturée')): ?>
    <button type="submit" class="btn btn-info btn-sm btnEdit" data-bs-toggle="modal" data-bs-target="#demandFormModal" 
            data-id="<?//= $demand['demandID']; ?>" disabled>Modifier</button>
<?php //endif; ?> -->
<a href="<?= base_url('uploadFile/list'); ?>" title="Voir les fichiers joints" class="btn btn-outline-success btn-sm btnFile" data-id="<?= $demand['demandID']; ?>">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text align-middle me-1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
</a>
<!-- <a href="<?//= base_url('demand/export/pdf/'.$demand['demandID']); ?>" class="btn btn-outline-primary btn-sm" target="”_blank”">
    PDF
</a> -->                                
<button type="submit" class="btn btn-outline-info btn-sm btnEdit" data-bs-toggle="modal" data-bs-target="#demandFormModal" 
    data-id="<?= $demand['demandID']; ?>" data-fullname="<?= $demand['fullname']; ?>" data-dobt="<?= $demand['dobt']; ?>" 
    data-doet="<?= $demand['doet']; ?>" data-bctype="<?= $demand['bc_type']; ?>" data-bcnum="<?= $demand['bcnum']; ?>" 
    data-bcform="<?= $demand['bc_formula']; ?>" data-country="<?= $demand['destination'] ; ?>" data-passport="<?= $demand['passport_num']; ?>" 
    data-passdate="<?= $demand['passport_date'];?>" data-stat="<?= $demand['status_id']; ?>" 
    data-comment="<?= $demand['comment']; ?>">Modifier</button>