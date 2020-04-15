<div class="card">
    <div class="card-body">
        <div class="row">
        <!-- PIE CHART -->
            <div class="col-md-5">
                <div id="pieCard" class="card card-primary" onload="pieChart()">
                    <div class="card-header">
                        <h3 class="card-title">Persentase Daerah</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <?php $counData = count($data['tpq']); for ($a=0; $a < $counData; $a++) :?>
                    <div class="col-md-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info">
                            <?=$data['jumlahdata'][$a]['jumlah']?>
                        </span>
                        <div class="info-box-content">
                            <a href="<?=BASEURL?>pengurus/tpq/<?=$data['jumlahdata'][$a]['idtpq']?>">
                            <span class="info-box-text">TPQ <?=$data['tpq'][$a]['tpq']?></span>
                            </a>
                            <span class="info-box-number"><?=$data['tpq'][$a]['desa']?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.card -->
<script>
    window.onload = function(event) {pieChart()}
</script>