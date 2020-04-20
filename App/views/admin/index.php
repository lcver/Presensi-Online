<?php if($data['activated']!==null) : ?>
<div class="col-md-7" id="card-active">
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                <?php foreach ($data['activated'] as $d) : ?>
                    <tr>
                        <td><?=$d['sesi']?></td>
                        <td><?= date_format(date_create($d['tanggal']),'d F Y')?></td>
                        <td>Sedang aktif</td>
                        <td>
                            <!-- <button class="btn btn-light" id="btn-inactive" data-dismiss="alert" aria-hidden="true" onclick="btnAjax(<?php//$d['id']?>,'<?php//BASEURL?>admin/inactive_jadwal')" >pause</button> -->
                            <button class="btn btn-danger" id="btn-inactive" data-dismiss="alert" aria-hidden="true" onclick="btnAjax(<?=$d['id']?>,'<?=BASEURL?>admin/sesi/nonaktif')" >selesai</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif;?>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <th>Nama Sesi</th>
                <th>Tanggal Sesi</th>
                <th>Waktu</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php if(isset($data['set_sesi'])) : ?>
                <?php foreach ($data['set_sesi'] as $d) : ?>
                <tr>
                    <td><?=$d['sesi']?></td>
                    <td><?=date_format(date_create($d['tanggal']),'d,F Y')?></td>
                    <td><?=$d['waktu_mulai']?> - <?= $d['waktu_selesai']?></td>
                    <td>
                        <form action="<?=BASEURL?>admin/sesi/aktivasi" method="post">
                            <input type="hidden" class="d-none" name="presensi_jadwal" value="<?=$d['id']?>">
                            <button type="submit" class="btn btn-primary" >Aktif</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">Belum ada sesi baru</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table> 
        <!-- <div class="custom-control custom-checkbox float-right">
            <input type="checkbox" class="custom-control-input" id="customCheckbox" onChange="btnAjax(<?=$d['id']?>,'<?=BASEURL?>admin/auto_jadwal')" <?=$d['auto_active']=='active' ? "checked" : "";?>>
            <label for="customCheckbox" class="custom-control-label">Auto aktif</label>
        </div> -->
        <!-- <form action="<?php//BASEURL?>admin/auto_load" method="post">
            <div class="form-group">
                <label>Set Aktif Sesi</label>
                <select class="custom-select" name="presensi_jadwal">
                    <?php //foreach ($data['set_sesi'] as $d) : ?>
                        <option value="<?php//$d['id']?>">Sesi <?php//$d['sesi']?> | (<?php// date_format(date_create($d['tanggal']),'d,F Y')?>)</option>
                    <?php //endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right mt-3">Auto Active</button>
            </div>
        </form> -->
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Jadwal Asrama</h4>
    </div>
    <div class="card-body">
        <div class="row">
        <?php if(isset($data['sesi'])) : ?>
        <?php $no=1; foreach ($data['sesi'] as $d) : ?>
            <div class="col-md-3 col-sm-6 col-12">
                <?php if($d['status']==3) : ?>
                    <div class="alert alert-dark alert-dismissible" style="cursor:default;">
                <?php else :?>
                    <div class="alert <?= $d['status']==2 ? 'alert-primary' : 'shadow-sm border-primary';?> alert-dismissible" style="cursor:default;">
                <?php endif;?>
                        <i class="icon fas fa-calendar"></i>
                            <span class="text-lg">
                                <a href="<?=BASEURL?>admin/jadwal_detail/<?=$d['id']?>" class=" text-decoration-none <?= $d['status']==1 ? 'text-dark' : ''; ?>">
                                    <?= $d['sesi'] ?>
                                </a>
                        </span>
                    <p class="schedule">
                        <?= date_format(date_create($d['tanggal']),'d,F Y')?>
                    </p>
                    <p class="schedule" >
                        <?= date_format(date_create($d['waktu_mulai']),'h.i a')?>
                         s/d 
                        <?= date_format(date_create($d['waktu_selesai']),'h.i a')?>
                    </p>
                </div>
            </div>
        <?php
            endforeach;
            endif;
        ?>
        </div>
    </div>
</div>