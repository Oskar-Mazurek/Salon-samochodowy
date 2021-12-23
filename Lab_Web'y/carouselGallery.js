$(document).ready(function () {
    let galleryImage = [
        ['./images/Peugeot.jpg', 'Peugeot 206'],
        ['./images/BMW.jpg', 'BMW E60'],
        ['./images/Citroen.jpg', 'Citroen C3'],
        ['./images/Toyota.jpg', 'Toyota Corolla']
    ];

    let licznik = 0;
    let timer = setInterval(ZmianaZdjęcia, 5000);

    function ZmianaZdjęcia() {
        licznik++;
        if (licznik > galleryImage.length - 1) {
            licznik = 0;
        }
        $("#mojaGaleria").fadeOut("fast", function () {
            $("#mojaGaleria").attr("src", galleryImage[licznik][0]);
            $("#mojaGaleria").attr("alt", galleryImage[licznik][1]);
            $("#mojaGaleria").fadeIn("fast");
            $("#podpis").text(galleryImage[licznik][1]);
        });

    }

    $("#rButton").click(function () {
        licznik++;
        if (licznik > galleryImage.length - 1) {
            licznik = 0;
        }
        $("#mojaGaleria").fadeOut("fast", function () {
            $("#mojaGaleria").attr("src", galleryImage[licznik][0]);
            $("#mojaGaleria").attr("alt", galleryImage[licznik][1]);
            $("#mojaGaleria").fadeIn("fast");
            $("#podpis").text(galleryImage[licznik][1]);
        });
    })

    $("#lButton").click(function () {
        licznik--;
        if (licznik < 0) {
            licznik = 3;
        }
        $("#mojaGaleria").fadeOut("fast", function () {
            $("#mojaGaleria").attr("src", galleryImage[licznik][0]);
            $("#mojaGaleria").attr("alt", galleryImage[licznik][1]);
            $("#mojaGaleria").fadeIn("fast");
            $("#podpis").text(galleryImage[licznik][1]);
        });
    })

}
)

