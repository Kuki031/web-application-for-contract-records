import {PHONE_RESPONSIVITY} from './constants';
import hamburgerIcon from '../images/hamburger.png';
import closeIcon from '../images/close.png';


export const toggleHamburgerMenu = function () {
    const headerNormal = document.querySelector(".header-wrap")?.parentElement;
    const hamburger = document.querySelector(".hamburger");
    const menu = document.querySelector(".hamburger-wrap");
    let isMenuOpen = false;

    const updateMenuVisibility = () => {
        const isMobile = window.matchMedia(`(max-width: ${PHONE_RESPONSIVITY})`).matches;

        if (isMobile) {
            hamburger.classList.remove("hidden");
            headerNormal?.querySelectorAll("a").forEach(a => a.parentElement.classList.add("hidden"));
            headerNormal?.querySelector("form")?.classList.add("hidden");
        } else {
            hamburger.classList.add("hidden");
            isMenuOpen = false;
            updateMenuDisplay();
            headerNormal?.querySelectorAll("a").forEach(a => a.parentElement.classList.remove("hidden"));
            headerNormal?.querySelector("form")?.classList.remove("hidden");
        }
    };

    const updateMenuDisplay = () => {
        menu.style.display = isMenuOpen ? "flex" : "none";
        hamburger.style.backgroundImage = `url(${isMenuOpen ? closeIcon : hamburgerIcon})`;
    };

    updateMenuVisibility();
    window.addEventListener("resize", updateMenuVisibility);

    hamburger.addEventListener("click", (e) => {
        isMenuOpen = !isMenuOpen;
        updateMenuDisplay();
    });
};
