require('./bootstrap');

window.Vue = require('vue');

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

console.log(shows);


fetch(url)
    .then((blob) => blob.json())
    .then((data) => shows.push(...data));

function findMatches(wordToMatch, shows) {
    return shows.filter((show) => {
        const regex = new RegExp(wordToMatch, "gi");
        return show.city.match(regex) || show.address.match(regex);
    });
}


function displayMatches() {
    const matchArr = findMatches(this.value, shows);
    const html = matchArr
        .map((x) => {
            return `
      <li>${x.city}</li>
    `;
        })
        .join("");
    r.innerHTML = html;
}

q.addEventListener("change", displayMatches);
q.addEventListener("keyup", displayMatches);
