<x-modal size="modal-sm">

    <x-slot name="title">
        Tambah Prioritas
    </x-slot>
    
    @method('post')

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" onclick="submitForm(this.form)" class="btn btn-primary">Simpan</button>
    </x-slot>

</x-modal>
