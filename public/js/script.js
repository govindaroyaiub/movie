const searchForm = document.querySelector(".landing-search");
const searchInput = document.querySelector("#land-search-input");
const searchBtn = document.querySelector("#land-search-btn");
const landSearchResult = document.querySelector(".land-search-result");
const cityUl = document.querySelector(".landing-city-list");
const q = document.querySelector(".q");
const r = document.querySelector(".main-acc");
const cr = document.querySelector(".city-acc");

const url = `${location.href}api/shows`;
const shows = [];

searchForm.addEventListener("submit", function(e) {
    e.preventDefault();
});

function searchBtnAnimationStart(e) {
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
                <div data-toggle="collapse" data-target="#collapse${
                    m.id
                }" aria-expanded="true" aria-controls="collapse${m.id}">
                     <div class="acc-title">
                        <div class="d-flex">
                           <i class="fa fa-file-video-o fa-3x text-red"></i>
                               <h3 class="ml-3">${m.city}</h3>
                                  </div>
                                            <div style="margin-left: 60px" class="d-flex justify-content-between mt-2">
                                                    <p class="m-0 text-expand">${
                                                        m.name
                                                    }</p>
                                                    <p class="m-0 text-expand">${moment(
                                                        m.date
                                                    ).format(
                                                        "MMMM Do"
                                                    )} ${moment(
                m.time,
                "HH:mm"
            ).format("HH:mm")}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="collapse${
                                    m.id
                                }" class="collapse" aria-labelledby="heading${
                m.id
            }"
                                    data-parent="#accordionExample">
                                    <div class="acc-description">
                                        <h4>${m.movie_title}</h4>
                                        <a target="_blank" href="${
                                            m.ticket_url
                                        }"><i class="fa fa-ticket"></i> GET TICKETS</a>
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
        aCity.addEventListener("click", function(e) {
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
                <div data-toggle="collapse" data-target="#collapse${
                    md.id
                }" aria-expanded="true" aria-controls="collapse${md.id}">
                   <div class="acc-title">
                      <div class="d-flex">
                         <i class="fa fa-file-video-o fa-3x text-red"></i>
                         <h3 class="ml-3">${md.city}</h3>
                      </div>
                      <div style="margin-left: 60px" class="d-flex justify-content-between mt-2">
                         <p class="m-0 text-expand">${md.name}</p>
                         <p class="m-0 text-expand">${moment(md.date).format(
                             "MMMM Do"
                         )} ${moment(md.time, "HH:mm").format("HH:mm")}</p>
                      </div>
                   </div>
                </div>
             </div>
             <div id="collapse${
                 md.id
             }" class="collapse" aria-labelledby="heading${md.id}"
                data-parent="#accordionExample">
                <div class="acc-description">
                   <h4>${md.movie_title}</h4>
                   <a target="_blank" href="${
                       md.ticket_url
                   }"><i class="fa fa-ticket"></i> GET TICKETS</a>
                </div>
             </div>
                `;
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
