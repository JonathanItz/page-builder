@php
    $data = $content['data'];
    // dd($data);
@endphp

<{{$data['level']}} style="text-align:{{$data['alignment']}};">
    {{$data['content']}}
</{{$data['level']}}>