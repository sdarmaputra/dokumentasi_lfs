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

    <button class="ui teal vertical animated large button" tabindex="0" onclick="tambahDokumentasi();">
        <div class="hidden content"><i class="plus icon"></i></div>
            <div class="visible content">
            Tambah Dokumentasi
        </div>
    </button>

    <div class="ui modal">
        <i class="close icon"></i>
        <div class="header">
            Tambah Dokumentasi
        </div>
        <div class="content">
            <form class="ui form" method="POST" action="<?php echo site_url('user/insertDataDokumentasi'); ?>">
                <div class="field">
                    <label>Judul</label>
                    <input type="text" name="judul" placeholder="Judul">
                </div>
                <div class="field">
                    <label>Penanggung Jawab</label>
                    <select id="daftar_anggota_tim" multiple="" class="ui search dropdown" name="nrp[]" placeholder="Penanggung Jawab">
                    </select>
                </div>
                <div class="field">
                    <label>Keterangan</label>
                    <textarea name="keterangan"></textarea>
                </div>
                <div class="actions">
                    <button class="ui red vertical animated large deny button" tabindex="0" type="submit">
                        <div class="hidden content">Batal</div>
                            <div class="visible content">
                            <i class="close icon"></i>
                        </div>
                    </button>
                    <button class="ui teal vertical animated large button" tabindex="0" type="submit">
                        <div class="hidden content">Simpan</div>
                            <div class="visible content">
                            <i class="send icon"></i>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>

        
</div>

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

    <form class="ui form padding-top-3" method="POST" action="<?php echo site_url('user/insertDataMahasiswa'); ?>">
        <h4 class="ui dividing header">Tambah Anggota Tim</h4>
        <div class="two fields">
            <div class="field">
                <label>NRP</label>
                <input type="text" name="nrp" placeholder="NRP">
            </div>
            <div class="field">
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Nama">
            </div>
        </div>
        <button class="ui teal vertical animated large button" tabindex="0" type="submit">
            <div class="hidden content">Simpan</div>
                <div class="visible content">
                <i class="send icon"></i>
            </div>
        </button>
    </form>            
</div>

<script>
    $(document).ready( function () {
        var table = $('#tabel_dokumentasi').DataTable({
            "ajax": "<?php echo site_url('user/getDataDokumentasi'); ?>",
            "columns": [
                { "data": "idDokumentasi", "visible": false },
                { "data": "waktu" },
                { "data": "judul" },
                { "data": "nrp" },
                { "data": "keterangan" },
                { "data": null, "defaultContent": '<button class="ui red icon button" title="Hapus Dokumentasi"><i class="ui trash icon"></i></button>' }
            ]
        });

        $('#tabel_dokumentasi tbody').on('click','button', function() {
            var data = table.row( $(this).parents('tr') ).data();
            var url = "<?php echo site_url('user/deleteDataDokumentasi'); ?>/" + data['idDokumentasi'];
            $(location).attr('href',url);
        })

        $.get( "<?php echo site_url('user/getDataMahasiswa'); ?>", function( data ) {
          var mahasiswa = $.parseJSON(data);
          for (i = 0; i < mahasiswa.length; i++) {
            $('#tabel_anggota_tim > tbody:last-child').append('<tr><td>' + ( i + 1 ) + '</td><td>' + mahasiswa[i].nrp + '</td><td>' + mahasiswa[i].nama + '</td><td><a class="ui red icon button" title="Hapus Anggota" href="<?php echo site_url("user/deleteDataMahasiswa/'+mahasiswa[i].nrp+'"); ?>"><i class="ui trash icon"></i></a></td></tr>');  
            $('#daftar_anggota_tim')
             .append($("<option></option>")
             .attr("value",mahasiswa[i].nrp)
             .text(mahasiswa[i].nama)); 
          }
          
          console.log(mahasiswa[0].nama);
        });
        $('select.dropdown').dropdown();        

        <?php 
            if ($this->session->flashdata('section') == 'anggota_tim') echo "navigateDashboard('dokumentasi_menu', 'dokumentasi', 'tabel_anggota_tim_menu', 'anggota_tim');";
            else if ($this->session->flashdata('section') == 'dokumentasi') echo "navigateDashboard('tabel_anggota_tim_menu', 'anggota_tim', 'dokumentasi_menu', 'dokumentasi');";
        ?>
    });

    function tambahDokumentasi() {
        $('.ui.modal').modal('show');    
    }
</script>