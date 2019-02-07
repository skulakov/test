/* Top nav*/
let menuElem = document.getElementById('nav');
let titleElem = menuElem.querySelector('.toggle');
titleElem.onclick = function () {
    menuElem.classList.toggle('open');
};

window.onscroll = function () {
    stiky()
};

/* Stiky */
let navbar = document.getElementById("navbar");
let sticky = navbar.offsetTop;

function stiky() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}

/*Right aside*/
function rightColumn() {
    let element = document.getElementById("myNav");
    element.classList.toggle("active");
}

/* Accordeon*/
let acc = document.getElementsByClassName("accordion");
let i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}
// Get the modal
let modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
let img = document.getElementById('myImg');
let zoom = document.getElementById('zoom');
let modalImg = document.getElementById("img01");
let captionText = document.getElementById("caption");
zoom.onclick = function () {
    modal.style.display = "block";
    modalImg.src = img.src;
    captionText.innerHTML = img.alt;
};

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
};