function codeColor(color){

    document.body.style.backgroundColor=color;
    testo.style.display = "none";


}


function  returniii() {
    testo.style.display = "";
}
//setInterval(codeColor,10)
myFunction();

function myFunction() {

    setTimeout(function(){ codeColor("rgb(255,0,0)"); boh()}, 5000);
    setTimeout(function(){ codeColor("rgb(0,255,0)"); }, 5050);
    setTimeout(function(){ codeColor("blue"); },5100);
    setTimeout(function(){ codeColor("black"); returniii()}, 5150);

    setTimeout(function(){ codeColor("red"); }, 10000);
    setTimeout(function(){ codeColor("blue"); }, 10100);
    setTimeout(function(){ codeColor("green"); }, 10200);
    setTimeout(function(){ codeColor("black"); returniii()}, 10300);
}

    function cambiacolore()

    {

// Genero tre numeri random di valore compreso tra 1 e 256

        var r = Math.round(Math.random()*256);
        var g = Math.round(Math.random()*256);
        var b = Math.round(Math.random()*256);

// Costruisco un colore RGB utilizzando i 3 numeri creati sopra

        colore_rgb = "rgb(" + r + "," + g + ", " + b + ")";


// Applico il colore al div "testo"
        div.style.color = colore_rgb;
    }


// Temporizzo la funzione

setInterval(cambiacolore,50);
