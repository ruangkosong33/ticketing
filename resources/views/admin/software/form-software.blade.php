<x-modal size="modal-lg">

    <x-slot name="title">
        Tambah Perangkat Lunak
    </x-slot>
    
    @method('post')

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="title">Nama Software/Aplikasi</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
        </div>
         <div class="col-lg-6">
            <div class="form-group">
                <label for="type">Jenis Software</label>
                <input type="text" name="type" id="type" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="system">Jenis Sistem</label>
                <input type="text" name="system" id="system" class="form-control">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="license">Jenis Lisensi</label>
                <input type="text" name="license" id="license" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
         <div class="col-lg-6">
            <div class="form-group">
                <label for="owner">Pemilik Lisensi</label>
                <input type="text" name="owner" id="owner" class="form-control">
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" onclick="submitForm(this.form)" class="btn btn-primary">Simpan</button>
    </x-slot>

</x-modal>
