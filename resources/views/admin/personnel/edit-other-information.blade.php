<div class="flex flex-col md:flex-row border-b border-gray-200 pb-4 mb-4">
    <div class="flex-1 flex flex-col md:flex-row">
        <div class="w-full flex-1 mx-2">
            <label>
                Firstname
                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
            </label>
            <div
                class="p-1 bg-white flex border rounded  {{ $errors->has('firstname')  ? 'border-red-500' : '' }}">
                <input
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text" placeholder="e.g. Christopher" aria-invalid="true"
                name="firstname"
                value="{{  old('firstname') ?? $personnel->firstname }}">
            </div>
            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                @if($errors->has('firstname'))
                {{  $errors->first('firstname') }}
                @else
                Required, at least 3 characters
                @endif
            </span>
        </div>
        <div class="w-full flex-1 mx-2">
            Middlename
            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
            <div
                class="p-1 bg-white flex border {{ $errors->has('middlename')  ? 'border-red-500' : '' }} rounded">
                <input
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text" placeholder="e.g. Platino" name="middlename"
                value="{{ old('middlename') ?? $personnel->middlename }}">
            </div>
            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                    @if($errors->has('middlename'))
                    {{  $errors->first('middlename') }}
                    @else
                    Required, at least 3 characters
                    @endif
                </span>
            </span>
        </div>
        <div class="w-full flex-1 mx-2">
            Lastname
            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">*</span>
            <div
                class="p-1 bg-white flex border {{ $errors->has('lastname')  ? 'border-red-500' : '' }} rounded">
                <input
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text" placeholder="e.g. Vistal" name="lastname"
                value="{{  old('lastname') ?? $personnel->lastname }}">
            </div>
            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-600">
                @if($errors->has('lastname'))
                {{  $errors->first('lastname') }}
                @else
                Required, at least 3 characters
                @endif
            </span>
        </div>
        <div class="w-full flex-1 mx-2">
            Suffix
            <div class="p-1 bg-white flex border rounded">
                <input placeholder="Enter Suffix"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text" maxlength="3" placeholder="e.g. Jr" name="suffix"
                value="{{  old('suffix') ?? $personnel->suffix }}">
            </div>
        </div>
    </div>
</div>
