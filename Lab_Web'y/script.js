document.getElementById("year").innerText = new Date().getFullYear();
document.getElementById("header").style.color = "#36454F";
document.getElementById("header").style.fontSize = "36px";
document.getElementById("header").style.fontWeight = "900";

class Company {

    constructor(Name, Street, City, PostalCode, NIP) {
        this.name = Name;
        this.street = Street;
        this.city = City;
        this.postalcode = PostalCode;
        this.nip = NIP;
    }

    showData() {
        return this.name + "\n" + this.street + "\n" + this.city + "\n" + this.postalcode + "\n" + this.nip
    }


}

const firma = new Company("AutoSell sp. Z.O.O", "ul. Auciarska 15", "Warszawa", "44-555", "NIP: 106-00-00-062")

document.getElementById("asideR").innerText = firma.showData();
document.getElementById("stopka").style.margin = "0px";

jQuery(document).ready(function ($) {
    $("a[href='#top']").click(function () {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
});

function cookiesEnabled() {
    var cookiesEnabled = window.navigator.cookieEnabled;
    if (!cookiesEnabled) {
        alert("Obsługa ciasteczek jest wyłączona!");
    }
    return cookiesEnabled;
}
function findCookie(cookieName) {
    var cookieValue = getCookie(cookieName);
    if (cookieValue != "" && cookieValue != null) {
        return true;
    }
    return false;
}
function setCookie(cookieName, cookieValue, cookieExpiredDays) {
    if (cookieName) {
        var d = new Date();
        d.setTime(d.getTime() + (cookieExpiredDays * 24 * 60 * 60 * 1000));
        var expires = d.toUTCString()
        var cookieData = cookieName + "=" + escape(cookieValue) + ";expires=" + expires + ";path=/";
        document.cookie = cookieData;
    }
}

function getCookie(cookieName) {
    var name = cookieName + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookies = decodedCookie.split(';');
    var cookieValue = "";
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) == ' ') {
            cookie = cookie.substring(1);
        }
        if (cookie.indexOf(name) == 0) {
            cookieValue = cookie.substring(name.length, cookie.length);
            return cookieValue;
        }
    }
    return cookieValue;
}
function deleteCookie(cookieName) {
    if (findCookie(cookieName)) {
        var cookieExpiredDays = new Date();
        cookieExpiredDays.setMonth(-1);
        setCookie(cookieName, "", cookieExpiredDays);
    }
}
function odwiedziny() {
    cookiesEnabled();
    if (!findCookie("odwiedziny")) {
        setCookie("odwiedziny", 1, 1);
        var element = document.getElementById("counter");
        element.innerHTML = "Jesteś tu po raz pierwszy.";
    }
    else {
        var cookieValue = getCookie("odwiedziny");
        cookieValue = parseInt(cookieValue) + 1;
        setCookie("odwiedziny", cookieValue, 1);
        var element = document.getElementById("counter");
        element.innerHTML = "Jesteś na tej stronie już " + cookieValue + " raz.";
    }
}

const DOM_table = document.querySelector('#table2')

async function createTable() {

    //fetch and extract data
    const row_data = await fetch('./db/modele.json');
    const json_data = await row_data.json();


    //define DOM elements
    const thead = DOM_table.children[0];
    const tbody = DOM_table.children[1];


    //create table head
    thead.innerHTML = `
        <tr>
            <th class="th1">${json_data.tableHeaders.id}</th>
            <th class="th2">${json_data.tableHeaders.marka}</th>
            <th class="th3">${json_data.tableHeaders.model}</th>
            <th class="th4" colspan="3">${json_data.tableHeaders.silnik}</th>
            <th class="th5">${json_data.tableHeaders.typ_silnika}</th>
            <th class="th6">${json_data.tableHeaders.cena}</th>
        </tr>
    `

    //create table body
    for (const item of json_data.models) {

        tbody.innerHTML += `
            <tr>
                <td class="td1">${item.id}</td>
                <td class="td2">${item.brand}</td>
                <td class="td3">${item.model}</td>
                <td class="td4">${item.silnik.fuel}</td>
                <td class="td5">${item.silnik.volume}</td>
                <td class="td6">${item.silnik.power}</td>
                <td class="td7">${item.type}</td>
                <td class="td8">${item.prise}</td>
            </tr>
        `
    }


}




createTable('./db/car_table.json')

$(document).ready(function () {
    $("#media1").html('<a href="https://www.facebook.com/" target="_blank">Nasz funpage</a>');
    $("#media1").css({
        "height": "1.2em",
        "padding": "3px 6px",
        "margin": "10px 0",
        "float": "left"
    });
    $("#media2").html('<a href="https://www.instagram.com/" target="_blank">Nasz instagram</a>');
    $("#media2").css({
        "height": "1.2em",
        "padding": "3px 6px",
        "margin": "10px 0",
        "float": "left"
    });
}

)

