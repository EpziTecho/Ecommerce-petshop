const flagElement = document.getElementById("flags");
const textsToChange = document.querySelectorAll("[data-section]");
const flagsElements = document.querySelectorAll(".flags__item");
const tooltipFlagElement = document.querySelectorAll(".item-tooltip");

const changeLanguage = (language) => {
    // const requestJson = await fetch(`Assets/json/${language}.json`);
    // const texts = await requestJson.json();
    // const json = getCookie(language);
    const texts = JSON.parse(localStorage.getItem(language));
    localStorage.setItem("leng", language);

    for (const element of flagsElements) {
        if (element.dataset.language == language) {
            element.classList.add("flag-selected");
        } else {
            element.classList.remove("flag-selected");
        }
    }

    for (const textToChange of textsToChange) {
        const section = textToChange.dataset.section;
        const value = textToChange.dataset.value;
        textToChange.innerHTML = texts[section][value];
    }
};

flagElement.addEventListener("click", (e) => {
    if (!e.target.closest(".tooltip-language") && !document.querySelector(".tooltip-language").classList.contains("active")) {
        document.querySelector(".tooltip-language").classList.add("active");
    } else {
        document.querySelector(".tooltip-language").classList.remove("active");
    }
});

tooltipFlagElement.forEach(flag => {
    flag.addEventListener('click', (e) => {
        changeLanguage(e.target.closest(".item-tooltip").dataset.language);
        e.target.closest('.tooltip-language').classList.remove("active");
    });
});

const getJson = async(language) => {
    const requestJsonEN = await fetch(`Assets/json/en.json`);
    const requestJsonES = await fetch(`Assets/json/es.json`);
    const textsEN = await requestJsonEN.json();
    const textsES = await requestJsonES.json();
    localStorage.setItem("en", JSON.stringify(textsEN));
    localStorage.setItem("es", JSON.stringify(textsES));
}

// Para utilizar por search params el idioma seleccionado
const urlSetLanguage = () => {
    let leng = localStorage.getItem("leng");
    const urlParams = new URLSearchParams(window.location.search);
    if (leng == null) {
        leng = "es";
        if (urlParams == "" ) {
            urlParams.set('language', leng);
            window.location.search = urlParams;
        }
    }
}

window.addEventListener('load', function() {
    getJson();
    // Obtenemos del ls el lenguaje seleccionado
    let leng = localStorage.getItem("leng");
    ( leng != null) ? changeLanguage(leng) : changeLanguage("es");
    
}, false);