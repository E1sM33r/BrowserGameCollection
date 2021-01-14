require('./bootstrap');

window.Vue = require('vue');

import StarRating from 'vue-star-rating';

Vue.component('star-rating', StarRating);


const app = new Vue({
    el: '#app',
    methods: {
        setRating: function(rating){
            document.getElementById('rating').value = rating;
            document.getElementById("ratingForm").submit();
        }
    },
    data: {
        rating: 0
    }
});
