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
