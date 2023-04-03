/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import logoPath from './image/img.png';
import logoPath1 from './image/foklores.jpg';
import logoPath from './image/img.png';
import logoPath3 from './image/ireland.jpg';
import logoPath3 from './image/mada.jpg';
import logoPath3 from './image/R.png';

let html = `<img src="${logoPath}" alt="ACME logo">`;

// start the Stimulus application
import './bootstrap';

const $ = require('jquery');
require('bootstrap');
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

