<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="img/adit.png" type="image/png">

    <!-- Scripts -->
    @routes
    @viteReactRefresh
    @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"])
    @inertiaHead

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="font-sans antialiased">
    @inertia


    {{-- <script>
        // Navbar Fixed
        window.onscroll = () => {
            const header = document.querySelector("header");
            const fixedNav = header.offsetTop;
            const toTop = document.querySelector("#to-top");

            if (window.pageYOffset > fixedNav) {
                header.classList.add("navbar-fixed");
                toTop.classList.remove("hidden");
                toTop.classList.add("flex");
            } else {
                header.classList.remove("navbar-fixed");
                toTop.classList.add("hidden");
                toTop.classList.remove("flex");
            }
        };

        // Hamburger
        const hamburger = document.querySelector("#hamburger");
        const navMenu = document.querySelector("#nav-menu");

        hamburger.addEventListener("click", () => {
            hamburger.classList.toggle("hamburger-active");
            navMenu.classList.toggle("hidden");
        });

        // klik diluar hamburger
        window.addEventListener("click", (e) => {
            if (e.target != hamburger && e.target != navMenu) {
                alert('oke')
                hamburger.classList.remove("hamburger-active");
                navMenu.classList.add("hidden");
            }
        });


        //dark mode toggle

        const darkToggle = document.querySelector('#dark-toggle');
        const html = document.querySelector('html');

        darkToggle.addEventListener('click', () => {

            if (darkToggle.checked) {
                html.classList.add('dark');
                localStorage.theme = 'dark';
            } else {
                html.classList.remove('dark');
                localStorage.theme = 'light';

            }
        });


        //move toggle position by mode
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            darkToggle.checked = true;
        } else {
            darkToggle.checked = false;
        }
    </script> --}}
</body>

</html>
