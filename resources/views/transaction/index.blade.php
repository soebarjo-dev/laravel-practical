<div class="bg-white shadow p-4">
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold mb-2">Transaksi</h2>
        <a href="{{ route('transactions.create') }}" class="bg-blue-600 text-white p-1 hover:bg-blue-700 inline-block mb-2">
            + Transaksi Baru
        </a>
    </div>

    <table class="w-full border-collapse mt-4">
        <thead>
            <tr class="bg-gray-200 border">
                <th class="text-center p-2">No.</th>
                <th class="text-center p-2">No. Invoice</th>
                <th class="text-center p-2">Tanggal</th>
                <th class="text-center p-2">Pelanggan</th>
                <th class="text-center p-2">Kasir</th>
                <th class="text-center p-2">Subtotal</th>
                <th class="text-center p-2">Pajak</th>
                <th class="text-center p-2">Grand Total</th>
                <th class="text-center p-2 w-20">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($data['products']))
                <tr>
                    <td colspan="9" class="p-4 text-center text-gray-400">Belum ada data produk</td>
                </tr>
            @else
                @foreach($data['products'] as $i => $product)
                <tr class="border hover:bg-gray-100">
                    <td class="w-24 border-x p-2 text-center">{{ $i+1 }}</td>
                    <td class="py-2 border-x p-2">{{ $product['name'] }}</td>
                    <td class="py-2 border-x p-2">{{ $product['unit']['name'] }}</td>
                    <td class="py-2 border-x p-2 text-right">Rp{{ $product['price'] }}</td>
                    <td class="py-2 border-x p-2 text-center">
                        <a href="{{ route('transactions.detail', ['id' => $product['id']]) }}">Detail</a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <p class="text-xs mt-3">Total Data : {{ count($data['products']) }}</p>
</div>
