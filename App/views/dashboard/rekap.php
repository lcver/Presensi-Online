<div class="mb-3 pt-3">
    <h5><a href="<?=BASEURL?>pengurus">
        <i class="fas fa-chevron-left" ></i>
        Kembali
    </a></h5>
</div>
<div class="card card-outline card-indigo">
    <div class="card-header">
        Data Rekap Tahun 2020
    </div>
    <div class="card-body">
        <div class="row">
        <?php foreach ($data as $d) : ?>
            <div class="col-md-4">
                <a href="#" class="">
                <div class="info-box">
                    <span class="info-box-icon bg-primary" style="background:#<?=$bgcolor[$a]?>!important">
                        <i class="fas fa-calendar-times"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text text-md mt-3">Jadwal <?=date_format(date_create($d['tanggal']),'d/m/Y')?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                </a>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>