<div id="dokumentasi">
    <table id="tabel_dokumentasi" class="ui selectable celled table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Waktu</th>
                <th>Judul</th>
                <th>Penanggung Jawab</th>
                <th>Keterangan</th>
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
            <form class="ui form" method="POST" action="#">
                <div class="field">
                    <label>Judul</label>
                    <input type="text" name="username" placeholder="Username">
                </div>
                <div class="field">
                    <label>Penanggung Jawab</label>
                    <select id="daftar_anggota_tim" multiple="" class="ui dropdown" name="nrp" placeholder="Penanggung Jawab">
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
        $('#tabel_dokumentasi').DataTable();
        $.get( "<?php echo site_url('user/getDataMahasiswa'); ?>", function( data ) {
          var mahasiswa = $.parseJSON(data);
          for (i = 0; i < mahasiswa.length; i++) {
            $('#tabel_anggota_tim > tbody:last-child').append('<tr><td>' + ( i + 1 ) + '</td><td>' + mahasiswa[i].nrp + '</td><td>' + mahasiswa[i].nama + '</td></tr>');  
            $('#daftar_anggota_tim')
             .append($("<option></option>")
             .attr("value",mahasiswa[i].nrp)
             .text(mahasiswa[i].nama)); 
          }
          
          console.log(mahasiswa[0].nama);
        });

        $('select.dropdown').dropdown();
    });

    function tambahDokumentasi() {
        $('.ui.modal').modal('show');    
    }
</script>