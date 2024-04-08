@php
    $data = $content['data'];
    // dd($data);
@endphp

<img
src="{{asset('/storage/'.$data['image'])}}"
alt="{{$data['alt']}}"
class="rounded-2xl shadow-lg"
>