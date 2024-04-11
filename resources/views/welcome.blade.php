<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="bg-white" x-data="{open: false}">
            <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                <a href="/" class="-m-1.5 p-1.5">
                    <span class="sr-only">Igloo Pages</span>
                    <img class="h-8 w-auto" src="{{asset('assets/images/logo.svg')}}" alt="Igloo Pages logo">
                </a>
                </div>
                <div class="flex lg:hidden">
                <button x-on:click="open = true" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                </div>
                {{-- <div class="hidden lg:flex lg:gap-x-12">
                    <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Product</a>
                    <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Features</a>
                    <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Marketplace</a>
                    <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Company</a>
                </div> --}}
                <div class="hidden lg:flex lg:flex-1 lg:justify-end gap-4">
                    @auth
                        <a href="{{route('filament.website.pages.dashboard')}}" class="text-sm font-semibold leading-6 text-gray-900">Dashboard <span aria-hidden="true">&rarr;</span></a>
                    @else
                      	<a href="{{route('register')}}" class="text-sm font-semibold leading-6 text-gray-900">Register</a>
                        <a href="{{route('login')}}" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
                    @endauth
                </div>
            </nav>
            <!-- Mobile menu, show/hide based on menu open state. -->
            <div x-show="open" class="lg:hidden" role="dialog" aria-modal="true">
                <!-- Background backdrop, show/hide based on slide-over state. -->
                <div class="fixed inset-0 z-50"></div>
                <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto" src="{{asset('assets/images/logo.svg')}}" alt="Logo">
                    </a>
                    <button x-on:click="open = false" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        {{-- <div class="space-y-2 py-6">
                            <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Product</a>
                            <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>
                            <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Marketplace</a>
                            <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Company</a>
                        </div> --}}
                        <div class="py-6">
                            @auth
                                <a href="{{route('filament.website.pages.dashboard')}}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Dashboard</a>
                            @else
                                <a href="{{route('login')}}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</a>
                            @endauth
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </header>
        
            <div class="relative isolate pt-14">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#67e8f9] to-[#06b6d4] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
            <div class="py-24 sm:py-32 lg:pb-40">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-3xl text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                        Page builder for <span id="typed"></span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Create a variety of pages with our sleek minimalist design. Use Igloo Pages as your website, coming soon page or gathing leads and information from users.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="{{route('register')}}" class="rounded-md bg-cyan-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Start your 7 day trial</a>

                        <button x-on:click="document.getElementById('prices').scrollIntoView({ behavior: 'smooth' });" class="text-sm font-semibold leading-6 text-gray-900">
                            Prices <span aria-hidden="true" class="rotate">↓</span>
                        </button>
                    </div>
                </div>
                <div class="mt-16 flow-root sm:mt-24">
                    <div class="-m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                    <img src="{{asset('/assets/images/homepage/hero.png')}}" alt="Igloo Pages page builder" width="2432" height="1442" class="rounded-md shadow-2xl ring-1 ring-gray-900/10">
                    </div>
                </div>
                </div>
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#06b6d4] to-[#67e8f9] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
            </div>
        </div>


        <div class="overflow-hidden bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl md:px-6 lg:px-8">
              <div class="grid grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:grid-cols-2 lg:items-start">
                <div class="px-6 lg:px-0 lg:pr-4 lg:pt-4">
                  <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-lg">
                    <h2 class="text-base font-semibold leading-7 text-cyan-600">Pick your own design</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Match your brand</p>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Design your perfect webpage effortlessly with Igloo Pages. Our minimalist design and user-friendly interface make building your site a breeze. Simply select a design that complements your brand and start creating today!
                    </p>
                    <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 lg:max-w-none">
                      <div class="relative pl-9">
                        <dt class="inline font-semibold text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-1 top-1 h-5 w-5 text-cyan-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                              </svg>
                          Page Creation
                        </dt>
                        <dd class="inline">Build up to five unique pages for your website, each tailored to your specific needs and vision.</dd>
                      </div>
                      <div class="relative pl-9">
                        <dt class="inline font-semibold text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-1 top-1 h-5 w-5 text-cyan-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                              </svg>
                          
                          Section Reordering.
                        </dt>
                        <dd class="inline">Effortlessly rearrange page sections to achieve the perfect layout for your content with just a few clicks.</dd>
                      </div>
                      <div class="relative pl-9">
                        <dt class="inline font-semibold text-gray-900">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-1 top-1 h-5 w-5 text-cyan-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                          </svg>
                          
                          Dynamic Forms.
                        </dt>
                        <dd class="inline">Engage your audience effectively by seamlessly integrating dynamic forms into your pages, making interactions with your site smooth and intuitive.</dd>
                      </div>
                    </dl>
                  </div>
                </div>
                <div class="sm:px-6 lg:px-0">
                  <div class="relative isolate overflow-hidden bg-cyan-500 px-6 pt-8 sm:mx-auto sm:max-w-2xl sm:rounded-3xl sm:pl-16 sm:pr-0 sm:pt-16 lg:mx-0 lg:max-w-none">
                    <div class="absolute -inset-y-px -left-3 -z-10 w-full origin-bottom-left skew-x-[-30deg] bg-cyan-100 opacity-20 ring-1 ring-inset ring-white" aria-hidden="true"></div>
                    <div class="mx-auto max-w-2xl sm:mx-0 sm:max-w-none">
                      <img src="{{asset('/assets/images/homepage/featured.png')}}" alt="Product screenshot" width="2432" height="1442" class="-mb-12 w-[57rem] max-w-none rounded-tl-xl bg-gray-800 ring-1 ring-white/10">
                    </div>
                    <div class="pointer-events-none absolute inset-0 ring-1 ring-inset ring-black/10 sm:rounded-3xl" aria-hidden="true"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>


        
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="gap-8 max-w-full grid md:grid-cols-2">
                <div class="mx-auto lg:mx-0">
                    {{-- <h2 class="text-base font-semibold leading-7 text-cyan-600">Pick your own design</h2> --}}
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Section Reordering</p>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Tailor each page to fit your requirements. Choose from up to four different section types and rearrange them effortlessly to create the ideal layout. Easily incorporate forms for interaction or showcase your content beautifully.
                    </p>
                </div>

                <div class="relative">
                    <img
                    src="{{asset('/assets/images/homepage/featured-2.png')}}"
                    alt="Product screenshot" class="rounded-3xl w-full max-w-full bg-gray-800 ring-1 ring-white/10 shadow-xl">
                </div>
            </div>
        </div>
        

        <div class="bg-white py-24 sm:py-32" id="prices">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
              <div class="mx-auto max-w-2xl sm:text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Simple no-tricks pricing</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">$3 every month. Get all features listed and cancel whenever you want.</p>
              </div>
              <div class="mx-auto mt-16 max-w-2xl rounded-3xl ring-1 ring-gray-200 sm:mt-20 lg:mx-0 lg:flex lg:max-w-none">
                <div class="p-8 sm:p-10 lg:flex-auto">
                  <h3 class="text-2xl font-bold tracking-tight text-gray-900">Standard Plan</h3>
                  <p class="mt-6 text-base leading-7 text-gray-600">Build dynamic pages to showcase what you need. Show-off your brand, create waitlist pages, or build forms to collect leads.</p>
                  <div class="mt-10 flex items-center gap-x-4">
                    <h4 class="flex-none text-sm font-semibold leading-6 text-cyan-600">What's included</h4>
                    <div class="h-px flex-auto bg-gray-100"></div>
                  </div>
                  <ul role="list" class="mt-8 grid grid-cols-1 gap-4 text-sm leading-6 text-gray-600 sm:grid-cols-2 sm:gap-6">
                    <li class="flex gap-x-3">
                      <svg class="h-6 w-5 flex-none text-cyan-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                      </svg>
                      Create up to five pages for your website
                    </li>
                    <li class="flex gap-x-3">
                      <svg class="h-6 w-5 flex-none text-cyan-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                      </svg>
                      Reorderable page sections
                    </li>
                    <li class="flex gap-x-3">
                      <svg class="h-6 w-5 flex-none text-cyan-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                      </svg>
                      Dynamic forms
                    </li>
                    <li class="flex gap-x-3">
                      <svg class="h-6 w-5 flex-none text-cyan-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                      </svg>
                      Custom design to match your brand
                    </li>
                  </ul>
                </div>
                <div class="-mt-2 p-2 lg:mt-0 lg:w-full lg:max-w-md lg:flex-shrink-0">
                  <div class="rounded-2xl bg-gray-50 py-10 text-center ring-1 ring-inset ring-gray-900/5 lg:flex lg:flex-col lg:justify-center lg:py-16">
                    <div class="mx-auto max-w-xs px-8">
                      {{-- <p class="text-base font-semibold text-gray-600">Per month</p> --}}
                      <p class="mt-6 flex items-baseline justify-center gap-x-2">
                        <span class="text-5xl font-bold tracking-tight text-gray-900">$3</span>
                        <span class="text-sm font-semibold leading-6 tracking-wide text-gray-600">/mo</span>
                      </p>
                      <a href="{{route('register')}}" class="mt-10 block w-full rounded-md bg-cyan-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">7 day trial when you sign up</a>
                      <p class="mt-6 text-xs leading-5 text-gray-600">Invoices and receipts available</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          

        @livewireScripts
    </body>
</html>
