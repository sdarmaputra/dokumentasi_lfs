<form class="ui form" method="POST" action="<?php echo site_url('asisten/loadUserData'); ?>">
    <div class="ui three column grid">
        <div class="column field">
            <label>Kelas</label>
            <select id="daftar_kelas" class="ui search dropdown" name="kelas" placeholder="Kelas">
            </select>
        </div>
        <div class="column field">
            <label>Kelompok</label>
            <select id="daftar_kelompok" class="ui search dropdown" name="kelompok" placeholder="Kelompok">
            </select>
        </div>
        <div class="column field">
            <label>&nbsp;</label>
            <button class="ui teal vertical animated medium button" tabindex="0">
                <div class="hidden content"><i class="unhide icon"></i></div>
                    <div class="visible content">
                    Tampilkan Data User
                </div>
            </button>
        </div>
    </div>
</form>
<hr></hr>
<?php if ($this->session->userdata('loaded_user_data')) { ?>
    <h2>Menampilkan Data Kelompok <?php echo strtoupper($this->session->userdata('loaded_user_data_name')); ?></h2>
<?php } ?>
    
<h3>Partisipasi anggota: <span id="partisipasi_container_top"></span></h3>
<div id="dokumentasi">
    <table id="tabel_dokumentasi" class="ui selectable celled table">
        <thead>
            <tr>
                <th>No.</th>
                <th style="width:15%;">Waktu</th>
                <th>Judul</th>
                <th>Penanggung Jawab</th>
                <th>Keterangan</th>
                <th style="width:5%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>    
</div>
<h3>Partisipasi anggota: <span id="partisipasi_container_bottom"></span></h3>

<div id="anggota_tim" class="hidden-element">
    <table id="tabel_anggota_tim" class="ui selectable celled table">
        <thead>
            <tr>
                <th style="width:5%;">No.</th>
                <th style="width:20%;">NRP</th>
                <th>Nama</th>
                <th style="width:5%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>           
</div>

<script>
    function selectedKelas() {
        $("#daftar_kelas > option").each(function() {
            if (this.value == "<?php echo $this->session->userdata('loaded_user_data_kelas'); ?>") {
                $('#daftar_kelas').dropdown('set selected', this.value);
                $('#daftar_kelas').dropdown('set value', this.value);                
            }
        });
        getDaftarKelompok();
        setTimeout(function(){ selectedKelompok(); }, 100);
    }

    function selectedKelompok() {
        console.log('selectedKelas');
        $("#daftar_kelompok > option").each(function() {            
            if (this.value == "<?php echo $this->session->userdata('loaded_user_data'); ?>") {
                $('#daftar_kelompok').dropdown('set selected', this.value);
                $('#daftar_kelompok').dropdown('set value', this.value);
            }
        });
    }

    function getDaftarKelompok() {
        var kelas = $('#daftar_kelas').val();
        $('#daftar_kelompok').html('');
        $('#daftar_kelompok').dropdown('clear');
        $.get( "<?php echo site_url('asisten/getDaftarKelompok'); ?>/" + kelas, function( data ) {
            var kelompok = $.parseJSON(data);
            for (i = 0; i < kelompok.length; i++) {
            $('#daftar_kelompok')
                 .append($("<option></option>")
                 .attr("value", kelompok[i].iduser)
                 .text(kelompok[i].username));
            }
        });
    }

    function loadUserData(user) {
        var table = $('#tabel_dokumentasi').DataTable({
            "ajax": "<?php echo site_url('asisten/getDataDokumentasi'); ?>/" + user,
            "columns": [
                { "data": "idDokumentasi", "visible": false },
                { "data": "waktu" },
                { "data": "judul" },
                { "data": "nrp" },
                { "data": "keterangan" },
                { "data": null, "defaultContent": '<button class="ui disabled icon button" title="Hapus Dokumentasi"><i class="ui trash icon"></i></button>' }
            ]
        });


        $.get( "<?php echo site_url('asisten/getDataMahasiswa'); ?>/" + user, function( data ) {
          var mahasiswa = $.parseJSON(data);
          for (i = 0; i < mahasiswa.length; i++) {
            $('#tabel_anggota_tim > tbody:last-child').append('<tr><td>' + ( i + 1 ) + '</td><td>' + mahasiswa[i].nrp + '</td><td>' + mahasiswa[i].nama + '</td><td><a class="ui disabled icon button" title="Hapus Anggota" href="<?php echo site_url("user/deleteDataMahasiswa/'+mahasiswa[i].nrp+'"); ?>"><i class="ui trash icon"></i></a></td></tr>');  
          }
        });

        var innerHtml = '';
        $.get( "<?php echo site_url('asisten/getPartisipasi'); ?>/" + user, function( data ) {
          var partisipasi = $.parseJSON(data);
          for (i = 0; i < partisipasi.length; i++) {
            innerHtml = innerHtml + '<div class="ui blue image label">' + partisipasi[i].nrp + '<div class="detail">' + partisipasi[i].partisipasi + '</div></div>';
          }
          $('#partisipasi_container_top').html(innerHtml);
          $('#partisipasi_container_bottom').html(innerHtml);
        });
    }

    $(document).ready( function () {
        <?php if ($this->session->userdata('loaded_user_data')) { ?>
            loadUserData(<?php echo $this->session->userdata('loaded_user_data'); ?>);
        <?php } ?>

        <?php if ($daftar_kelas) {
            foreach ($daftar_kelas as $rw) { 
                if (strcmp($rw['kelas'], 'special') < 0) {
        ?>
            $('#daftar_kelas')
                 .append($("<option></option>")
                 .attr("value", "<?php echo $rw['kelas']; ?>")
                 .text("<?php echo 'Kelas '.$rw['kelas']; ?>"));

        <?php   }
            }
        }
        ?>
        $('#daftar_kelas').dropdown({onChange:function(){
            getDaftarKelompok();
        }});
        $('#daftar_kelompok').dropdown();        
        selectedKelas();

        <?php 
            if ($this->session->flashdata('section') == 'anggota_tim') echo "navigateDashboard('dokumentasi_menu', 'dokumentasi', 'tabel_anggota_tim_menu', 'anggota_tim');";
            else if ($this->session->flashdata('section') == 'dokumentasi') echo "navigateDashboard('tabel_anggota_tim_menu', 'anggota_tim', 'dokumentasi_menu', 'dokumentasi');";
        ?>
    });
</script>
