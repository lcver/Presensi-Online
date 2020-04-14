<?php
    /**
     * 
     * SET URL to back page
     */
    $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
?>
<div class="mb-3">
<h5><a href="<?=$url?>">
    <i class="fas fa-chevron-left" ></i>
    Kembali
</a></h5>
</div>
<div class="card">
    <div class="card-body">
        <h3>TPQ <?=$data['tpq']['tpq']?></h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                <?php if($data['peserta']!==NULL): ?>
                    <?php $no=1; foreach ($data['peserta'] as $d) : ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$d['nama']?></td>
                    </tr>
                    <?php endforeach ?>
                <?php endif;?>
            </tbody>
        </table>
    </div>
</div>