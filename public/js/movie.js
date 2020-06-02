function openItem(evt, itemName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
        // document.querySelector('.menu').style.display = 'none';
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(itemName).style.display = "block";
    evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();


// Let's began
const searchForm = document.querySelector(".landing-search");
const searchInput = document.querySelector("#land-search-input");
const searchBtn = document.querySelector("#land-search-btn");
const landSearchResult = document.querySelector(".land-search-result");
const cityUl = document.querySelector(".landing-city-list");
const q = document.querySelector(".q");
const r = document.querySelector(".main-acc");
const cr = document.querySelector(".city-acc");


let url;
const shows = [];

if (location.pathname === '/en') {
    const enUrl = `${location.href}api/shows`;
    url = enUrl.replace(/\/en/g, '/');
} else {
    url = `${location.href}api/shows`;
}

searchForm.addEventListener("submit", function (e) {
    e.preventDefault();
});

function searchBtnAnimationStart(e) {
    cr.classList.remove('d-block');
    cr.classList.add('d-none');
    gsap.to(searchBtn, {
        duration: 0.2,
        display: "block",
        width: "40px"
    });
}

function searchBtnAnimationEnd(e) {
    gsap.to(searchBtn, {
        duration: 0.001,
        display: "none",
        width: "0px"
    });
}

function removeSearchoutput() {
    r.classList.add("d-none");
    cr.classList.remove("d-block");
    cr.classList.add("d-none");
}

fetch(url)
    .then(blob => blob.json())
    .then(data => shows.push(...data));

function findMatches(wordToMatch, shows) {
    return shows.filter(show => {
        const regex = new RegExp(wordToMatch, "gi");
        return show.city.match(regex);
    });
}

function displayMatches() {
    r.classList.remove("d-none");
    const matchArr = findMatches(this.value, shows);
    const html = matchArr
        .map(m => {
            return `
            <div id="heading${m.id}">
                <div data-toggle="collapse" data-target="#collapse${m.id}" aria-expanded="true" aria-controls="collapse${m.id}">
                     <div class="acc-title">
                        <div class="d-flex">
                           <i class="fa fa-file-video-o fa-3x text-red"></i>
                               <h3 class="ml-3">${m.name}</h3>
                                  </div>
                                         <div style="margin-left: 60px" class="d-flex justify-content-between mt-2">
                                             <p class="m-0">${m.address}, ${m.city}</p>
                                             <p class="m-0 text-expand">
                                                ${location.pathname === '/' ? moment(m.date).locale('nl').format("LL") : moment(m.date).locale('en').format("LL")} ${moment(m.time, "HH:mm").format("HH:mm")}
                                             </p>
                                         </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="collapse${m.id}" class="collapse" aria-labelledby="heading${m.id}"
                                    data-parent="#accordionExample">
                                    <div class="acc-description">
                                        <h4>${m.movie_title}</h4>
                                        <a class="text-uppercase" href="http://${m.url}" target="_blank"><i class="fa fa-ticket"></i> ${location.pathname === '/' ? 'Koop Tickets' : 'Get Tickets'}</a>
                                    </div>
                                </div>
    `;
        })
        .join("");
    r.innerHTML = html;
}

function getCities() {
    const shows2 = [];
    fetch(url)
        .then(blob => blob.json())
        .then(data => shows2.push(...data));

    const city = [...new Set(shows.map(item => item.city))];

    const cityHtml = city
        .map(c => {
            return `
        <li class="city-item">
          <a class="city-link" href="#"><iclass="fa fa-search"></i>${c}</a>
        </li>
      `;
        })
        .join("");

    cityUl.innerHTML = cityHtml;

    const allCities = document.querySelectorAll(".city-link");

    allCities.forEach(aCity => {
        aCity.addEventListener("click", function (e) {
            e.preventDefault();
            cr.classList.remove("d-block");
            cr.classList.add("d-block");

            const cityQuery = this.textContent;

            const filter = shows2.filter(el => {
                return el.city === cityQuery;
            });


            const cHtml = filter
                .map(md => {
                    return `
                <div id="heading${md.id}">
                <div data-toggle="collapse" data-target="#collapse${md.id}" aria-expanded="true" aria-controls="collapse${md.id}">
                   <div class="acc-title">
                      <div class="d-flex">
                         <i class="fa fa-file-video-o fa-3x text-red"></i>
                         <h3 class="ml-3">${md.name}</h3>
                      </div>
                      <div style="margin-left: 60px" class="d-flex justify-content-between mt-2">
                         <p class="m-0">${md.address}, ${md.city}</p>
                         <p class="m-0 text-expand">${location.pathname === '/' ? moment(md.date).locale('nl').format("LL") : moment(md.date).locale('en').format("LL")} ${moment(md.time, "HH:mm").format("HH:mm")}</p>
                      </div>
                   </div>
                </div>
             </div>
             <div id="collapse${md.id}" class="collapse" aria-labelledby="heading${md.id}"
                data-parent="#accordionExample">
                <div class="acc-description">
                   <h4>${md.movie_title}</h4>
                   <a target="_blank" href="http://${md.url}"><i class="fa fa-ticket"></i> ${location.pathname === '/' ? 'Koop Tickets' : 'Get Tickets'}</a>
                </div>
             </div>`;
                })
                .join("");
            cr.innerHTML = cHtml;
        });
    });
}

searchInput.addEventListener("focus", searchBtnAnimationStart);
searchBtn.addEventListener("click", searchBtnAnimationEnd);
searchBtn.addEventListener("click", removeSearchoutput);
q.addEventListener("change", displayMatches);
q.addEventListener("keyup", displayMatches);
window.addEventListener("load", getCities);





