<div class="col-md-3">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Set jadwal</h4>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <div class="form-group">
                <form action="<?=BASEURL?>admin/set_jadwal" method="post">
                    <div class="form-group">
                        <label for="">Nama Acara : </label>
                        <input class="form-control d-inline" type="text" name="presensi_sesi">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input class="form-control d-inline dateform" type="date" name="presensi_tanggal" required>
                        <label for="">Mulai :</label>
                        <input class="form-control timepicker-minute" type="time" name="presensi_waktu_mulai" required>
                        <label for="">Selesai :</label>
                        <input class="form-control timepicker-minute" type="time" name="presensi_waktu_selesai" required>
                    </div>
                    <button class="btn btn-primary float-right">Set Tanggal</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Presensi Asrama</h4>
    </div>
    <div class="card-body">
        <div class="row">
        <?php if(isset($data)) : ?>
        <?php $no=1; foreach ($data as $d) :?>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="alert alert-info alert-dismissible" >
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="delAjax(<?=$d['id']?>, 'Jadwal/hapus')" >&times;</button>
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