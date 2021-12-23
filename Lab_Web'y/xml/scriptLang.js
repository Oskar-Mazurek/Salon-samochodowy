const DOM_nav = document.querySelector('#navMenu');
const DOM_lang_selection = document.querySelector('#lang_selection');

let obecnyJezyk = '';
const domyslnyJezyk = 'pl';
const jezyki = ['pl', 'en', 'de'];

function wczytajMenu(jezyk) {

    let wczytanyJezyk = localStorage.getItem('jezyk', jezyk);

    if (!jezyk && wczytanyJezyk) {
        jezyk = wczytanyJezyk;
        localStorage.setItem('jezyk', domyslnyJezyk);
    }


    if (!jezyk && !wczytanyJezyk) {
        jezyk = domyslnyJezyk;
        localStorage.setItem('jezyk', domyslnyJezyk);
    }


    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            $(`#jezyk-${jezyk}`).toggleClass('active_lang');
            $(`#jezyk-${obecnyJezyk}`).toggleClass('active_lang');

            localStorage.setItem('jezyk', jezyk);
            obecnyJezyk = jezyk;
            pokazMenu(this);

        }
    };

    xmlhttp.open("GET", `./xml/menu-${jezyk}.xml`, true);
    xmlhttp.send();


}


function pokazMenu(xml) {

    let xmlDoc = xml.responseXML;
    let menuTag = xmlDoc.children[0];
    let menuItemsList = menuTag.children;

    DOM_nav.children[0].innerHTML = '';

    for (item of menuItemsList) {

        let label = item.children[0].textContent;
        let link = item.children[1].textContent;
        DOM_nav.children[0].innerHTML += `<li><a href=${link}>${label}</a></li>`;
    }

}


function wyborJezykaMenu() {

    for (jezyk of jezyki) {

        let button = `<button id='jezyk-${jezyk}' type="button" onclick="wczytajMenu('${jezyk}')">${jezyk.toUpperCase()}</button>`;
        DOM_lang_selection.innerHTML += button;
    }

}


wczytajMenu();
wyborJezykaMenu();