@php
    $data = $content['data'];
    // dd($data);
@endphp

<{{$data['level']}} style="text-align:{{$data['alignment']}};" class="dark:text-white">
    {{$data['content']}}
</{{$data['level']}}>