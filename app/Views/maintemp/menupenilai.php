<li class="nav-item">
    <a href="<?php echo base_url(); ?>/manbimbing" class="nav-link">
        <i class="fas fa-users nav-icon"></i>
        <p>Daftar Peserta Yang Dibimbing</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo base_url(); ?>/manujipk" class="nav-link">
        <i class="fas fa-graduation-cap nav-icon"></i>
        <p>Pengujian Praktik Keinsinyuran</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo base_url(); ?>/mannilairpl" class="nav-link">
        <i class="fas fa-graduation-cap nav-icon"></i>
        <p>Penilaian RPL</p>
    </a>
</li>
<li class="nav-item">
    <a href="<?php echo base_url(); ?>/penilai/dokumen" class="nav-link">
        <i class="fas fa-folder-open nav-icon"></i>
        <p>Dokumen Akreditasi Penilai</p>
    </a>
</li>

<?php
if (isset($koor_tugasakhir) && ($koor_tugasakhir)) {
?>
    <li class="nav-item">
        <a href="<?php echo base_url(); ?>/mannilairpl" class="nav-link">
            <i class="fas fa-graduation-cap nav-icon"></i>
            <p>Manajemen Seminar Regular</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo base_url(); ?>/penilai/dokumen" class="nav-link">
            <i class="fas fa-folder-open nav-icon"></i>
            <p>Manajemen Tugas Akhir Regular</p>
        </a>
    </li>
<?php
}
?>