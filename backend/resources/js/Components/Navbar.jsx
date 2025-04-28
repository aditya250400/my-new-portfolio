import { useEffect, useState } from "react";

export default function Navbar() {
    const [isOpen, setIsOpen] = useState(false);
    const [isDark, setIsDark] = useState(false);
    const [isScrolled, setIsScrolled] = useState(false);

    // Toggle hamburger
    const toggleHamburger = () => {
        setIsOpen(!isOpen);
    };

    // Toggle dark mode
    const toggleDarkMode = () => {
        setIsDark(!isDark);
        if (!isDark) {
            document.documentElement.classList.add("dark");
            localStorage.theme = "dark";
        } else {
            document.documentElement.classList.remove("dark");
            localStorage.theme = "light";
        }
    };

    // On scroll, handle navbar fixed
    useEffect(() => {
        const handleScroll = () => {
            if (window.scrollY > 0) {
                setIsScrolled(true);
            } else {
                setIsScrolled(false);
            }
        };

        window.addEventListener("scroll", handleScroll);

        return () => window.removeEventListener("scroll", handleScroll);
    }, []);

    // On load, set dark mode if needed
    useEffect(() => {
        if (localStorage.theme === "dark") {
            setIsDark(true);
            document.documentElement.classList.add("dark");
        } else {
            setIsDark(false);
            document.documentElement.classList.add("light");
        }
    }, []);

    return (
        <>
            {/* <!-- Back to top start --> */}
            <a
                href="#home"
                id="to-top"
                className={`rounded-full bg-primary bottom-4 right-4 p-4 fixed z-[9999] h-14 w-14 items-center justify-center  hover:animate-pulse  ${
                    isScrolled ? "flex" : "hidden"
                }`}
            >
                <span className="block w-5 h-5 border-t-2 border-l-2 rotate-45 mt-2"></span>
            </a>
            {/* <!-- Back to top end --> */}

            <header
                className={`bg-transparent absolute top-0 left-0 w-full flex items-center z-10 ${
                    isScrolled ? "navbar-fixed" : ""
                }`}
            >
                <div className="container">
                    <div className="flex items-center justify-between relative">
                        <div className="px-4">
                            <a
                                href="#home"
                                className="font-bold text-primary block py-6"
                            >
                                MuhamadRizkiAditya
                            </a>
                        </div>
                        <div className="flex items-center px-4">
                            <button
                                id="hamburger"
                                name="hamburger"
                                type="button"
                                onClick={toggleHamburger}
                                className={`${
                                    isOpen ? "hamburger-active" : ""
                                } block absolute right-4 lg:hidden`}
                            >
                                <span className="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
                                <span className="hamburger-line transition duration-300 ease-in-out"></span>
                                <span className="hamburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
                            </button>
                            <nav
                                id="nav-menu"
                                className={`${
                                    isOpen ? "block" : "hidden"
                                } absolute py-5 bg-white shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none dark:bg-dark dark:shadow-slate-500 lg:dark:bg-transparent `}
                            >
                                <ul className="block lg:flex">
                                    <li className="group">
                                        <a
                                            href="#home"
                                            className="text-base text-dark py-2 mx-8 group-hover:text-primary flex dark:text-white"
                                        >
                                            Beranda
                                        </a>
                                    </li>
                                    <li className="group">
                                        <a
                                            href="#about"
                                            className="text-base text-dark py-2 mx-8 group-hover:text-primary flex dark:text-white"
                                        >
                                            Tentang Saya
                                        </a>
                                    </li>
                                    <li className="group">
                                        <a
                                            href="#portofolio"
                                            className="text-base text-dark py-2 mx-8 group-hover:text-primary flex dark:text-white"
                                        >
                                            Portofolio
                                        </a>
                                    </li>
                                    <li className="group">
                                        <a
                                            href="#blog"
                                            className="text-base text-dark py-2 mx-8 group-hover:text-primary flex dark:text-white"
                                        >
                                            Blog
                                        </a>
                                    </li>

                                    <li className="flex items-center pl-8 mt-3 lg:mt-0 ">
                                        <div className="flex">
                                            <span className="mr-2 text-sm text-slate-500">
                                                light
                                            </span>
                                            <input
                                                type="checkbox"
                                                id="dark-toggle"
                                                className="hidden"
                                                checked={isDark}
                                                onChange={toggleDarkMode}
                                            />
                                            <label htmlFor="dark-toggle">
                                                <div className="flex h-5 w-9 cursor-pointer items-center rounded-full bg-slate-500 p-1">
                                                    <div className="toggle-circle h-4 w-4 rounded-full bg-white transition duration-300 ease-in-out"></div>
                                                </div>
                                            </label>
                                            <span className="ml-2 text-sm text-slate-500">
                                                dark
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
        </>
    );
}
