// import './bootstrap';

import Toastify from 'toastify-js'
import Typed from 'typed.js';
window.Toastify = Toastify

import "/node_modules/toastify-js/src/toastify.css"

if(document.querySelector('#typed')) {
    new Typed('#typed', {
        strings: [
            'gathering leads.',
            'coming soon pages.',
            'contact forms.',
            'getting feedback.',
        ],
        typeSpeed: 50,
        backDelay: 2000,
        loop: true,
    });
}
