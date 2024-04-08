@php
    $data = $content['data'];
    $formId = $data['id'];
    $formFields = $data['form_fields'];
@endphp

@if (isset($formFields) && ! empty($formFields))
    @livewire('page-form', ['pageId' => $page->id, 'formId' => $formId, 'formFields' => $formFields])
@endif