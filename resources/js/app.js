require('./bootstrap');

window.Vue = require('vue');
const moment = require('moment');


const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


const app = new Vue({
    el: '#app',
});

const land = new Vue({
    el: '#land',
});


const searchForm = document.querySelector('.landing-search');
const searchInput = document.querySelector('#land-search-input');
const searchBtn = document.querySelector('#land-search-btn');


searchForm.addEventListener('submit', function (e) {
    e.preventDefault();
});


function searchBtnAnimationStart(e) {
    gsap.to(searchBtn, {
        duration: 0.2,
        display: 'block',
        width: '40px'
    })
}

function searchBtnAnimationEnd(e) {
    gsap.to(searchBtn, {
        duration: 0.001,
        display: 'none',
        width: '0px'
    })
}

searchInput.addEventListener('focus', searchBtnAnimationStart);
searchBtn.addEventListener('click', searchBtnAnimationEnd);


// AJAX TYPED SEARCH
const q = document.querySelector(".q");
const r = document.querySelector(".r");

const url = "http://localhost:3000/api/shows";
const shows = [];


fetch(url)
    .then((blob) => blob.json())
    .then((data) => shows.push(...data));

function findMatches(wordToMatch, shows) {
    return shows.filter((show) => {
        const regex = new RegExp(wordToMatch, "gi");
        return show.city.match(regex);
    });
}

function displayMatches() {
    const matchArr = findMatches(this.value, shows);
    const html = matchArr
        .map((value) => {
            return `
                <div class="single-search-box">
                    <div id="searchOne">
                        <button type="button" data-toggle="collapse" data-target="#s1${value.id}"
                            aria-expanded="true">
                            <div class="ls-box">
                                <i class="fa fa-video fa-3x"></i>
                                <div>
                                    <h3>${value.city}</h3>
                                    <p>${value.name}</p>
                                </div>
                                <p class="ls-at">${moment(value.date).format('MMMM Do')} ${moment(value.time, 'HH:mm').format('HH:mm')}</p>
                            </div>
                        </button>
                    </div>

                    <div id="s1${value.id}" class="collapse"
                        data-parent="#searchAcc">
                        <div class="buy-ticket">
                            <h3>The Intruder</h3>
                            <a target="_blank" href="${value.ticket_url}"><i class="fa fa-ticket"></i> GET TICKETS</a>
                        </div>
                    </div>
                </div>
    `;
        })
        .join("");
    r.innerHTML = html;
}

q.addEventListener("change", displayMatches);
q.addEventListener("keyup", displayMatches);
