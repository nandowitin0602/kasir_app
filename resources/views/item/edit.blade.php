<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <h5 class="card-title fw-semibold mb-4">Edit Item</h5>
                        </div>

                        <!-- Form untuk menambahkan item -->
                        <form action="{{ route('item.update', $item) }}" method="POST">
                            @csrf <!-- Menyertakan token CSRF untuk keamanan -->
                            @method('patch')

                            <div class="mb-3 row">
                                <x-input-label for="item_code" :value="__('Item Code')"
                                    class="col-sm-2 col-form-label text-nowrap" />
                                <div class="col-sm-10">
                                    <x-text-input id="item_code" name="item_code" type="text" class="form-control"
                                        :value="old('item_code', $item->item_code)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('item_code')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <x-input-label for="item_name" :value="__('Item Name')"
                                    class="col-sm-2 col-form-label text-nowrap" />
                                <div class="col-sm-10">
                                    <x-text-input id="item_name" name="item_name" type="text" class="form-control"
                                        :value="old('item_name', $item->item_name)" required autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('item_name')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <x-input-label for="item_price" :value="__('Item Price')"
                                    class="col-sm-2 col-form-label text-nowrap" />
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <x-text-input id="item_price" name="item_price" type="text"
                                            class="form-control" :value="old('item_price', number_format($item->item_price, 2, '.', ''))" required autofocus />
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('item_price')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <x-input-label for="selling_unit" :value="__('Selling Unit')"
                                    class="col-sm-2 col-form-label text-nowrap" />
                                <div class="col-sm-10">
                                    <select id="selling_unit" name="selling_unit" class="form-select" required>
                                        <option value="/kg"
                                            {{ old('selling_unit', $item->selling_unit) == '/kg' ? 'selected' : '' }}>
                                            /kg
                                        </option>
                                        <option value="/satuan"
                                            {{ old('selling_unit', $item->selling_unit) == '/satuan' ? 'selected' : '' }}>
                                            /satuan</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('selling_unit')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <x-input-label for="stock" :value="__('Stock')"
                                    class="col-sm-2 col-form-label text-nowrap" />
                                <div class="col-sm-10">
                                    <x-text-input id="stock" name="stock" type="text" class="form-control"
                                        :value="old('stock', $item->stock)" required autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 d-flex justify-content-center gap-1">
                                    <a class="btn btn-danger" href="{{ route('item.index') }}"
                                        style="width: 100px;">Back</a>
                                    <button type="submit" class="btn btn-info" style="width: 100px;">Edit Item</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Fungsi untuk memformat angka ke format ribuan
            function formatRibuan(value) {
                value = value.toString().replace(/[^\d]/g, ''); // Hapus karakter non-angka
                return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan tanda titik sebagai pemisah ribuan
            }

            // Targetkan input item_price
            const itemPriceInput = document.getElementById('item_price');

            // Format ulang saat halaman pertama kali dimuat
            document.addEventListener('DOMContentLoaded', function() {
                let initialValue = itemPriceInput.value.replace(/\.\d+$/, ''); // Hapus desimal jika ada
                itemPriceInput.value = formatRibuan(initialValue);
            });

            // Format angka saat user mengetik
            itemPriceInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^\d]/g, ''); // Hanya angka
                e.target.value = formatRibuan(value); // Terapkan format ribuan
            });
        </script>

        <script>
            document.getElementById('stock').addEventListener('input', function(e) {
                // Ambil nilai input
                let value = e.target.value;

                // Ubah koma menjadi titik
                value = value.replace(/,/g, '.');

                // Hapus karakter yang bukan angka, titik
                value = value.replace(/[^0-9.]/g, '');

                // Perbarui nilai input
                e.target.value = value;
            });
        </script>
    @endpush
</x-app-layout>
