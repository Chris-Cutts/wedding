{{-- <div class="absolute top-0 w-screen"> --}}
{{-- <ul class="flex gap-4 my-2 w-fit mx-auto"> --}}
{{-- <li><a href="/" class="{{ Request::is('/') ? 'active' : '' }}" wire:navigate>Home</a></li> --}}
{{-- <li><a href="/about-us" class="{{ Request::is('about-us') ? 'active' : '' }}" wire:navigate>About Us</a></li> --}}
{{-- <li><a href="/venue" class="{{ Request::is('venue') ? 'active' : '' }}" wire:navigate>Venue</a></li> --}}
{{-- <li><a href="/schedule" class="{{ Request::is('schedule') ? 'active' : '' }}" wire:navigate>Schedule</a></li> --}}
{{-- <li><a href="/rsvp" class="{{ Request::is('rsvp') ? 'active' : '' }}" wire:navigate>RSVP</a></li> --}}
{{-- <li><a href="/faq" class="{{ Request::is('faq') ? 'active' : '' }}" wire:navigate>FAQ</a></li> --}}
{{-- </ul> --}}
{{-- </div> --}}
<nav>
    <button
        data-collapse-toggle="navbar-hamburger"
        type="button"
        class="inline-flex h-10 w-10 cursor-pointer items-center justify-center rounded-lg p-2 text-sm"
        aria-controls="navbar-hamburger"
        aria-expanded="false"
    >
        <span class="sr-only">Open main menu</span>
        <svg
            class="text-dark-green h-5 w-5"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 17 14"
        >
            <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15"
            />
        </svg>
    </button>
    <div class="bg-medium-green absolute z-50 hidden w-full" id="navbar-hamburger">
        <ul class="mt-4 flex flex-col rounded-lg font-medium" id="mobile-nav">
            <li>
                <a
                    href="/"
                    wire:navigate
                    class="{{ Request::is('/') ? 'bg-light-green' : '' }} block px-3 py-2"
                    aria-current="page"
                >
                    Home
                </a>
            </li>
            <li>
                <a
                    href="/about-us"
                    wire:navigate
                    class="{{ Request::is('about-us') ? 'bg-light-green' : '' }} block px-3 py-2"
                >
                    About Us
                </a>
            </li>
            <li>
                <a
                    href="/venue"
                    wire:navigate
                    class="{{ Request::is('venue') ? 'bg-light-green' : '' }} block px-3 py-2"
                >
                    Venue
                </a>
            </li>
            <li>
                <a
                    href="/order-of-service"
                    wire:navigate
                    class="{{ Request::is('order-of-service') ? 'bg-light-green' : '' }} block px-3 py-2"
                >
                    Order of Service
                </a>
            </li>
            <li>
                <a
                    href="{{ route('rsvp', ['rsvp' => '019559f6-a374-72c5-ae21-03abb7be7cb4']) }}"
                    wire:navigate
                    class="{{ Request::is('rsvp') ? 'bg-light-green' : '' }} block px-3 py-2"
                >
                    RSVP
                </a>
            </li>
        </ul>
    </div>
</nav>
