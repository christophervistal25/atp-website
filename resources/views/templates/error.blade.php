@if ($errors->any())
    <div class="bg-danger text-white">
        <div class="p-3">
                @foreach (array_unique($errors->all()) as $error)
                    <li>{{ $error }}</li>
                @endforeach
        </div>
    </div>
@endif




