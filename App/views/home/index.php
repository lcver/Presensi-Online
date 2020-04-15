<div class="container">
    <div class="col-md-10 mx-auto">
        <div class="card bg-transparent shadow-none">
            <div class="text-center">
                <img src="<?=BASEURL?>img/logoPPG.jpeg" alt="" class="img-thumbnail img-circle p-0" style="max-width:100px">
                <h3>Presensi Online Asrama Remaja Jakarta Pusat</h3>
                <h5>PPG Jakarta Pusat</h5>
            </div>
        </div>
        <?= Flasher::get(); ?>
        <form action="<?=BASEURL?>home/submitData" method="post">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="" class="text-lg col-form-label-sm">Nama</label>
                            <input type="text" name="presensi_nama" id="" class=" form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-check-label">
                                <label>Jenis Kelamin</label>
                            </div>
                            <div class="custom-control custom-radio d-inline-block">
                                <input class="custom-control-input" type="radio" id="customRadio1" name="presensi_jeniskelamin" value="l">
                                <label for="customRadio1" class="custom-control-label mr-3" style="font-weight:600">Laki - Laki</label>
                            </div>
                            <div class="custom-control custom-radio d-inline-block">
                                <input class="custom-control-input" type="radio" id="customRadio2" name="presensi_jeniskelamin" value="p">
                                <label for="customRadio2" class="custom-control-label" style="font-weight:600">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama TPQ</label>
                            <select class="custom-select" name="presensi_tpq">
                                <?php foreach ($data as $d) : ?>
                                <option value="<?=$d['id']?>"><?=$d['tpq']?> (<?=$d['desa']?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-transparent shadow-none">
                <div class="card-body">
                <button class="btn btn-primary float-right">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>