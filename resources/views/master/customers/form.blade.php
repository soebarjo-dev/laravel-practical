<div class="bg-white shadow-xl p-4 w-96">
    <h3 class="text-lg font-bold mb-4">{{ $label['formTitle'] }}</h3>
    <form method="POST" action="{{ $formActionURL }}" autocomplete="off">
        @csrf
        @method($formActionMethod)
        <div class="mb-3">
            <label class="block text-sm text-gray-600 mb-1">Nama</label>
            <input type="text" name="name" class="w-full border p-1 focus:outline-none focus:border-blue-800" value="{{ $data['customer']['name'] ?? '' }}" required autofocus />
        </div>
        <div class="mb-3">
            <label class="block text-sm text-gray-600 mb-1">E-Mail</label>
            <input type="email" name="email" class="w-full border p-1 focus:outline-none focus:border-blue-800" value="{{ $data['customer']['email'] ?? '' }}" required />
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('master-customers.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm">{{ $label['submitButton'] }}</button>
        </div>
    </form>
</div>
