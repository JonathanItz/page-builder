<?php

namespace App\Livewire;

use App\Models\FormSubmission;
use App\Models\Page;
use Livewire\Component;
use Livewire\Attributes\Locked;

class PageForm extends Component
{
    #[Locked]
    public $pageId;

    #[Locked]
    public $formId;

    #[Locked]
    public $formFields = [];

    public $sideId;
    
    public $full_name;
    public $email;
    public $phone;
    public $feedback;

    public $acceptedFields = ['email', 'phone', 'full_name', 'feedback'];

    public function mount() {
        $page = Page::find($this->pageId);
        $sideId = $page->site_id;
        $this->sideId = $sideId;
    }

    public function submit() {
        $rules = [];

        foreach($this->formFields as $field) {
            if($field === 'feedback') {
                $rules[$field] = ['required', 'max:500', 'string'];
            }

            if($field === 'email') {
                $rules[$field] = ['required', 'max:255', 'email'];
            }

            if($field === 'phone') {
                $rules[$field] = ['required', 'max:255', 'string'];
            }

            if($field === 'full_name') {
                $rules[$field] = ['required', 'max:255', 'string'];
            }
        }

        $this->validate($rules);

        $submission = new FormSubmission;

        foreach($this->formFields as $field) {
            if($field === 'feedback') {
                $submission->textarea = $this->{$field};
            } else {
                $submission->{$field} = $this->{$field};
            }
        }

        $submission->page_id = $this->pageId;
        $submission->form_id = $this->formId;
        $submission->site_id = $this->sideId;

        $submission->save();

        $this->reset($this->acceptedFields);

        $this->js('
            Toastify({
                text: "Form Submitted. Thank you!",
                duration: 3000,
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "var(--brand-color)",
                    color: "var(--brand-contrast-color)",
                    borderRadius: "0.75rem",
                    fontWeight: 500,
                    fontSize: "16px",
                },
            }).showToast();
        ');
    }

    public function render()
    {
        return view('livewire.page-form');
    }
}
