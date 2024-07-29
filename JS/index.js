//#region CHARGEMENT
document.addEventListener('DOMContentLoaded', () => {

    //#region COMMANDS
    if (getURL() === "commands.php") {
        const allLinksCmds = document.querySelectorAll('.sidebar-sticky [data-category]');
        const commandItems = document.querySelectorAll('.command-item');
        allLinksCmds.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const category = link.getAttribute('data-category');

                commandItems.forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.classList.remove('category-hidden');
                    } else {
                        item.classList.add('category-hidden');
                    }
                });
            });
        });
        document.querySelector('.sidebar a[data-category="all"]').click();
    }
    //#endregion COMMANDS

    //#region DASHBOARD
    else if (getURL() === "dashboard.php") {
        document.getElementById('searchbarDash').addEventListener('input', searchBarDash);
    }
    //#endregion DASHBOARD

    //#region MANAGE
    else if (getURL().includes("manage_bot.php")) {
        //#region AFFICHER/CACHE
        const allLinks = document.querySelectorAll('.sidebar-sticky [data-category]');
        const mainItems = document.querySelectorAll('[data-category="main"]');
        const settingItems = document.querySelectorAll('[data-category="setting"]');
        let whatCate = document.getElementsByClassName("sidebar-sticky")

        allLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const category = link.getAttribute('data-category');

                if (category === 'main') {
                    //Main
                    whatCate[0].children[1].className = "active"
                    //Settings
                    whatCate[0].children[2].className = "category-hidden"
                    mainItems.forEach(item => item.classList.remove('category-hidden'));
                    settingItems.forEach(item => item.classList.add('category-hidden'));
                } else if (category === 'setting') {
                    //Main
                    whatCate[0].children[1].className = "category-hidden"
                    //Settings
                    whatCate[0].children[2].className = "active"
                    mainItems.forEach(item => item.classList.add('category-hidden'));
                    settingItems.forEach(item => item.classList.remove('category-hidden'));
                }
            });
        });
        settingsLink.addEventListener('click', (event) => {
            //Main
            whatCate[0].children[1].className = "category-hidden"
            //Settings
            whatCate[0].children[2].className = "active"
            event.preventDefault();
            mainItems.forEach(item => item.classList.add('category-hidden'));
            settingItems.forEach(item => item.classList.remove('category-hidden'));
        });

        document.querySelector('.sidebarMNG a[data-category="main"]').click(); // Default to showing main category
        //#endregion AFFICHER/CACHE

        //#region LANGUE
        let dropDownLangue = document.getElementById("language");
        let langueServElement = dropDownLangue.querySelector("img.mb-0");
        let langueServ = langueServElement.getAttribute("data-value");
        let allLangue = dropDownLangue.querySelectorAll(".dropdown-item");

        allLangue.forEach(function (item) {
            if (item.getAttribute("data-value") === langueServ) {
                item.classList.add("active");
            }
        });


        const valueLangueItems = document.querySelectorAll('#valueLangue li');
        valueLangueItems.forEach(function (item) {
            item.addEventListener('click', function () {
                const newLangue = this.getAttribute('data-value');
                const newLangueText = this.textContent.trim();
                const newLangueImgSrc = this.querySelector('img').getAttribute('src');
                const button = document.getElementById('dropdownMenuButton');
                button.innerHTML = '<img src="' + newLangueImgSrc + '" class="mb-0 me-2" data-value="' + newLangue + '" width="20">' + newLangueText;
            });
        });

        document.querySelectorAll('#valueLangue .dropdown-item').forEach(item => {
            item.addEventListener('click', function () {
                const selectedLangue = this.getAttribute('data-value');
                document.getElementById('selectedLangue').value = selectedLangue;
            });
        });
        //#endregion LANGUE

        //#region DROPSERVEUR
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        const currentServerId = getQueryParam('server_id');

        const dropdownItems = document.querySelectorAll('#serverChoose');

        dropdownItems.forEach(item => {
            const href = item.getAttribute('href');
            const serverIdFromLink = href.split('server_id=')[1];

            if (serverIdFromLink === currentServerId) {
                item.classList.add('active');
            }
        });
        //#endregion DROPSERVEUR

        //#region Premier/Dernier Serv
        const serverList = document.getElementById('serverList');
        const items = serverList.querySelectorAll('li');

        if (items.length > 0) {
            items[0].querySelector('a').classList.add('firstList');
            items[0].querySelector('a').classList.remove('dropdownSepare');

            items[items.length - 1].querySelector('a').classList.add('lastList');
        }
        //#endregion Premier/Dernier Serv
    }
    //#endregion MANAGE
});
//#endregion CHARGEMENT

//#region HEADER
const divMessDefil = document.getElementById("leMessDefilant")
const banderole = document.getElementsByClassName("isMaintenance")
if (screen.width <= 900) {
    divMessDefil.style.display = "none";
    banderole[0].style.display = "none";
}
//#endregion HEADER

//#region COMMANDS
if (getURL() === "commands.php") {
    function searchBarCmds() {
        let input = document.getElementById('searchbarCmds').value.toLowerCase();
        let commandItems = document.getElementsByClassName('command-item');

        for (let i = 0; i < commandItems.length; i++) {
            let commandItem = commandItems[i];
            let category = commandItem.getAttribute('data-category').toLowerCase();
            let subCategory = commandItem.getAttribute('data-subcategory') ? commandItem.getAttribute('data-subcategory').toLowerCase() : '';
            let name = commandItem.getElementsByTagName('h5')[0].innerText.toLowerCase();
            let description = commandItem.getElementsByTagName('p')[0].innerText.toLowerCase();

            if (category.includes(input) || subCategory.includes(input) || name.includes(input) || description.includes(input)) {
                commandItem.style.display = "";
            } else {
                commandItem.style.display = "none";
            }
        }
    }
}
//#endregion COMMANDS

//#region DASHBOARD
if (getURL() === "dashboard.php") {
    function searchBarDash() {
        let input = document.getElementById('searchbarDash').value.toLowerCase();
        let commandItems = document.querySelectorAll('.col-12.col-sm-4.col-md-3.col-lg-3');

        commandItems.forEach(commandItem => {
            let nameElement = commandItem.querySelector('.textGuildName');
            if (nameElement) {
                let name = nameElement.innerText.toLowerCase();

                if (name.includes(input)) {
                    commandItem.style.display = "";
                } else {
                    commandItem.style.display = "none";
                }
            }
        });
    }
}
//#endregion DASHBOARD

//#region MANAGE
if (getURL().includes("manage_bot.php")) {
    let footer = document.getElementsByClassName("leFooter")
    footer[0].className = "leFooter"
    footer[0].children[0].className = "container"

    if (screen.width < 1920 && screen.height < 1080) {
        let divCmd = document.getElementsByClassName('signCmd')
        divCmd[0].className = "col-md-9 col-lg-7 col-sm-9 px-md-4 mt-5 signCmd"
    }
}
//#endregion MANAGE

function getURL() {
    const url = window.location.href;
    const segments = url.split('/');
    const fileName = segments.pop();
    return fileName
}