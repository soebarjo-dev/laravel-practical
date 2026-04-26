<div class="bg-white shadow-xl p-4 w-96">
    <h3 class="text-lg font-bold mb-4">{{ $label['formTitle'] }}</h3>
    <form method="POST" action="{{ $formActionURL }}" autocomplete="off">
        @csrf
        @method($formActionMethod)
        <div class="mb-3">
            <label class="block text-sm text-gray-600 mb-1">Nama</label>
            <input type="text" name="name" class="w-full border p-1 focus:outline-none focus:border-blue-800" value="{{ $data['product']['name'] ?? '' }}" required autofocus />
        </div>
        <div class="mb-3">
            <label class="block text-sm text-gray-600 mb-1">Unit Barang</label>
            <select class="w-full border p-1 focus:outline-none focus:border-blue-800" name="unit_id" required>
                <option value="-">Pilih Unit Barang</option>
                @foreach($data['units'] as $unit)
                    <option value="{{ $unit['id'] }}" {{ $data['product']['unit_id'] == $unit['id'] ? 'selected':'' }}>{{ $unit['name'] }} ({{ $unit['symbol'] }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="block text-sm text-gray-600 mb-1">Harga</label>
            <input type="number" step="5" min="0" name="price" class="w-full text-right border p-1 focus:outline-none focus:border-blue-800" value="{{ $data['product']['price'] ?? '0' }}" required />
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('master-products.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm">{{ $label['submitButton'] }}</button>
        </div>
    </form>
</div>
