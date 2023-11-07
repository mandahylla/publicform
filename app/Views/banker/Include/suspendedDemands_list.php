<div class="tab-pane fade" id="nav-suspend" role="tabpanel" aria-labelledby="nav-suspend-tab">
    <div class="table-responsive"><BR/>
        <table id="demandTable3" class="table table-striped table-hover my-0">
            <thead>
                <?= $this->include('banker/include/thead_table'); ?>
            </thead>
            <tbody>                                                               
            <?php foreach ($demands as $demand) : ?>
                <?php if (($demand['st_order'] === '4')) : ?>
                    <?php $dest = ""; ?>
                    <?php   
                        foreach ($countries as $country) {
                            if($country['code'] === $demand['destination'])
                                $dest = $country['name']; 
                        } 
                    ?>        
                    <?php
                        $dobtF = date_format(new DateTime($demand['dobt']),"d/m/Y");
                        $doetF = date_format(new DateTime($demand['doet']),"d/m/Y");
                    ?>
                    <tr>
                        <?php if($user['role_name'] === 'Banquier'): ?>
                        <td><?= $demand['fullname'] ?></td>
                        <td><?= $demand['bankAccount'] ?></td>
                        <td><?= $demand['bc_type'] ?></td>
                        <td><?= $demand['bcnum'] ?></td>
                        <?php endif; ?>
                        <td><?= $dobtF; ?></td>
                        <td class="d-none d-md-table-cell"><?= $doetF; ?></td>
                        <td><span><?= $dest ; ?></span></td>
						<td><?= $demand['passport_num'];?></td>                        
                        <td><?= (!empty($demand['passport_date'])? date("d/m/Y", strtotime($demand['passport_date'])) : "")  ; ?></td>
						<td><span class="badge st-suspend"><?= $demand['status']; ?></span></td>
                        <td>                         
                            <?= view('banker/include/table_td_action', ['demand' => $demand]); ?>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>