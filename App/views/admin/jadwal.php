<div class="col-md-12">
    <div class="col-md-12">
        <?=Flasher::get()?>
    </div>
    <div class="row">
        <?php if(isset($data['jadwal'])) : ?>
        <?php foreach ($data['jadwal'] as $d) :?>
        <div class="col-md-4">
            <div class="card <?=$d['status']==2 ? 'bg-primary' : '';?>">
                <div class="card-body">
                    <button type="button" class="btn btn-tool float-right" onclick="btnAjax(<?=$d['id']?>,'<?=BASEURL?>admin/delete_jadwal')" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    <form action="<?=BASEURL?>admin/<?=$d['status']==2 ? 'inactive_jadwal' : 'activated_jadwal' ;?>" method="post">
                        <input type="hidden" name="id" value="<?=$d['id']?>">
                        Tanggal : <?=date_format(date_create($d['tanggal']),'D, d-m-Y')?>
                        <?php if($d['status']==1) :?>
                                <button type="submit" class="btn btn-primary btn-sm">Enable</button>
                        <?php else: ?>
                            <button class="btn btn-danger btn-sm">Disable</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <?php endif;?>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sesi</h4>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="<?=BASEURL?>admin/set_sesi" method="post">
                                <div class="form-group">
                                    <label class="text-md">Jadwal</label>
                                    <select class="custom-select" name="presensi_jadwal">
                                        <?php foreach ($data['jadwal'] as $d) : ?>
                                        <option value="<?=$d['id']?>"><?=date_format(date_create($d['tanggal']),'D, d-m-Y')?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Acara : </label>
                                    <input class="form-control d-inline" type="text" name="presensi_sesi">
                                </div>
                                <div class="form-group">
                                    <!-- <label for="">Tanggal</label>
                                    <input class="form-control d-inline dateform" type="date" name="presensi_tanggal" required> -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Mulai :</label>
                                            <input class="form-control timepicker-minute" type="time" name="presensi_waktu_mulai" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Selesai :</label>
                                            <input class="form-control timepicker-minute" type="time" name="presensi_waktu_selesai" required>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary float-right">Set Sesi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">jadwal</h4>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="<?=BASEURL?>admin/set_jadwal" method="post">
                                <!-- <ul class="list-unstyled m-0">
                                    <li>
                                        <span class="bg-primary pl-1 pr-1">Sesi 1 : 08.00 ~ 09.00</span>
                                    </li>
                                    <li>
                                        <span class="bg-primary pl-1 pr-1">Sesi 2 : 09.30 ~ 11.00</span>
                                    </li>
                                    <li>
                                        <span class="bg-primary pl-1 pr-1">Sesi 3 : 13.30 ~ 14.30</span>
                                    </li>
                                    <li>
                                        <span class="bg-primary pl-1 pr-1">Sesi 4 : 20.00 ~ 21.30</span>
                                    </li>
                                </ul> -->
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input class="form-control d-inline dateform" type="date" name="presensi_tanggal" required>
                                </div>
                                <button class="btn btn-primary float-right">Set jadwal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Presensi Asrama</h4>
    </div>
    <div class="card-body">
        <div class="row">
        <?php if(isset($data['sesi'])) : ?>
        <?php $no=1; foreach ($data['sesi'] as $d) :?>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="alert alert-info alert-dismissible" >
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="btnAjax(<?=$d['id']?>,'<?=BASEURL?>admin/delete_sesi')" >&times;</button>
                    <span class="jadwal-card">
                        <i class="icon fas fa-calendar"></i>
                        <a href="<?=BASEURL?>admin/jadwal_detail/<?=$d['id']?>" class="text-lg">
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