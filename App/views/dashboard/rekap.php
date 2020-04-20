<div class="pt-3">
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
            <table class="table table-striped">
                <thead>
                    <th>Jadwal</th>
                    <th>Terbesar</th>
                    <th>Terkecil</th>
                    <th>Jumlah</th>
                </thead>
                <tbody>
                <?php foreach ($data as $d) : ?>
                    <tr id="row<?=$d['idJadwal']?>">
                        <td>
                            <!-- <a href="<?php//BASEURL?>rekap/data/<?php//$d['idJadwal']?>" class="btn btn-primary"> -->
                            <a href="#row<?=$d['idJadwal']?>" class="btn btn-primary">
                                <?=date_format(date_create($d['tanggal']),'d/m/y')?>
                            </a>
                        </td>
                        <td><?=$d['min']?></td>
                        <td><?=$d['max']?></td>
                        <td><?=$d['total']?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>