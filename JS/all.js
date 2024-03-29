//#region HOME
let mylet;
const mainMenu = document.querySelector('.mainMenu');
const closeMenu = document.querySelector('.closeMenu');
const openMenu = document.querySelector('.openMenu');
const sidePanel = document.querySelector('.sidepanel');
const collapse = document.querySelector('.collapse');
const expand = document.querySelector('.expand');
const rightCol = document.querySelector('.right-col')

const section = document.getElementsByClassName('section');
const subSection = document.getElementsByClassName('sub-section');
const title = document.getElementsByClassName('title');

let width = (window.innerWidth > 0) ? window.innerWidth : screen.width;

openMenu.addEventListener('click', show);
closeMenu.addEventListener('click', close);

function show() {
    mainMenu.style.display = 'flex';
    mainMenu.style.top = '0';
}
function close() {
    mainMenu.style.top = '-500%';
    mainMenu.style.display = 'flex';
}

function openSidePanel() {
    sidePanel.style.display = "block";
    collapse.style.display = 'block';
    expand.style.display = "none"
}

function closeSidePanel() {
    sidePanel.style.display = "none";
    collapse.style.display = 'none';
    expand.style.display = "block"
}

if (width < 900) {
    try {
        title[0].onclick = function () {
            closeSidePanel()
        }
        title[1].onclick = function () {
            closeSidePanel()
        }
        title[2].onclick = function () {
            closeSidePanel()
        }
        title[3].onclick = function () {
            closeSidePanel()
        }
        title[4].onclick = function () {
            closeSidePanel()
        }
    } catch (error) {
    }
}

if (width < 900) {
    try {

        section[0].onclick = function () {
            closeSidePanel()
        }
        section[1].onclick = function () {
            closeSidePanel()
        }
        section[2].onclick = function () {
            closeSidePanel()
        }
        section[3].onclick = function () {
            closeSidePanel()
        }
        section[4].onclick = function () {
            closeSidePanel()
        }
        section[5].onclick = function () {
            closeSidePanel()
        }
        section[6].onclick = function () {
            closeSidePanel()
        }
        section[7].onclick = function () {
            closeSidePanel()
        }
        section[8].onclick = function () {
            closeSidePanel()
        }
        section[9].onclick = function () {
            closeSidePanel()
        }
        section[10].onclick = function () {
            closeSidePanel()
        }

    } catch (error) {

    }
}

if (width < 650) {
    try {
        subSection[0].onclick = function () {
            closeSidePanel()
        }
        subSection[1].onclick = function () {
            closeSidePanel()
        }

    } catch (error) {
    }
}


function loaderFunction() {
    mylet = setTimeout(showPage, 1400);
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("page").style.display = "block";
}


//#endregion HOME


//#region COMMANDES
let coll = document.getElementsByClassName("collapsible");
let i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");
        let content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;

            setTimeout(() => {
                content.style.padding = "0px";
            }, 180)
        } else {
            content.style.padding = "20px";
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}

//#endregion COMMANDES