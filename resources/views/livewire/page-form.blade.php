<form class="pt-4" wire:submit="submit">
    @foreach ($formFields as $fieldType)
        @if (in_array($fieldType, $acceptedFields))
            <div class="flex gap-6 items-end mt-8 first:mt-0" wire:key="{{ rand() }}">
                <div class="relative w-full">
                    @if ($fieldType === 'feedback')
                        <label for="feedback" class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">
                            Feedback
                        </label>
                        <textarea
                        class="
                        input-brand-color
                        block w-full rounded-xl border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:leading-6
                        @error($fieldType)
                        ring-red-500
                        @else
                        ring-gray-300
                        @enderror
                        "
                        name="feedback"
                        id="feedback"
                        oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
                        wire:model="{{$fieldType}}"
                        ></textarea>
                    @else
                        <label for="{{$fieldType}}" class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">
                            @if ($fieldType === 'email')
                                Email
                            @elseif($fieldType === 'phone')
                                Phone Number
                            @elseif($fieldType === 'full_name')
                                Full Name
                            @endif
                        </label>
                        <input
                        name="{{$fieldType}}"
                        id="{{$fieldType}}"
                        class="
                        input-brand-color
                        block w-full rounded-xl border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:leading-6
                        @error($fieldType)
                        ring-red-500
                        @else
                        ring-gray-300
                        @enderror
                        "
                        required
                        maxlength="100"

                        wire:model="{{$fieldType}}"

                        @if ($fieldType === 'email')
                            type="email"
                            placeholder="example@email.com"
                        @elseif($fieldType === 'phone')
                            type="tel"
                            placeholder="(555) 555 5555"
                        @elseif($fieldType === 'full_name')
                            type="text"
                            placeholder="John Doe"
                        @endif
                        >
                    @endif
                    @error($fieldType)
                        <span class="text-xs font-medium text-red-500 block ml-3">
                            {{$message}}
                        </span>
                    @enderror
                </div>

            </div>
        @endif
    @endforeach

    <div class="mt-6 flex items-center justify-end gap-x-6">
        {{-- <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button> --}}
        <button
        class="bg-brand-color hover:opacity-70 transition-opacity inline-flex items-center gap-1 justify-center rounded-xl px-3 py-2 text-sm font-semibold shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600"
        >
            Submit
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 inline">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>                  
        </button>
      </div>
</form>