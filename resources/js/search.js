export const triggerSearchBar = function() {

    const searchBar = document.querySelector(".search-bar")?.addEventListener("submit", (e) => {
        e.preventDefault();
        let mainEl = e.target;
        const input = mainEl.querySelector("input").value;

        if (!input) {
            return;
        }

        mainEl.submit();
    });
}