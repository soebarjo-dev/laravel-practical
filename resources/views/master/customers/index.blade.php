<div class="bg-white shadow p-4">
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold mb-2">Master Pelanggan</h2>
        <a href="{{ route('master-customers.create') }}" class="bg-blue-600 text-white p-1 hover:bg-blue-700 inline-block mb-2">
            + Tambah
        </a>
    </div>

    <table class="w-full border-collapse mt-4">
        <thead>
            <tr class="bg-gray-200 border">
                <th class="text-center p-2">No.</th>
                <th class="text-center p-2">Nama</th>
                <th class="text-center p-2">E-Mail</th>
                <th class="text-center p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($data['customers']))
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-400">Belum ada data pelanggan</td>
                </tr>
            @else
                @foreach($data['customers'] as $i => $customer)
                <tr class="border hover:bg-gray-100">
                    <td class="w-24 border-x p-2 text-center">{{ $i+1 }}</td>
                    <td class="py-2 border-x p-2">{{ $customer['name'] }}</td>
                    <td class="py-2 border-x p-2">{{ $customer['email'] }}</td>
                    <td class="py-2 border-x p-2 text-center">
                        <a href="{{ route('master-customers.edit', ['customer' => $customer['id']]) }}">Edit</a> |
                        <a onclick="
                            event.preventDefault();
                            if(confirm('Apakah anda yakin ingin menghapus data : {{ $customer['name'] }}?')){
                                document.getElementById('form-submit-delete-{{ $customer['id'] }}').submit()
                            }
                        ">
                            Hapus
                        </a>

                        <form id="form-submit-delete-{{ $customer['id'] }}" class="hidden" method="post" action="{{ route('master-customers.destroy', ['customer' => $customer['id']]) }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <p class="text-xs mt-3">Total Data : {{ $data['customers']->count() }}</p>
</div>
