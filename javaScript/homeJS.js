
//for smooth scroll for contact us
function smoothScroll(event) {
    event.preventDefault();
    const targetId = event.target.getAttribute('href').substring(1);
    const targetElement = document.getElementById(targetId);
    if (targetElement) {
        targetElement.scrollIntoView({
            behavior: 'smooth'
        });
    }
}
//end smooth scroll




//for change image in description
var i=0;
var time =1000;
const img = [];
img[0]='/products/p1home.JPG';
img[1]='/products/mod1blur.jpg';

let element = document.getElementById('description');

function changeImg(){
    element.style.backgroundImage='url('+ img[i]+')';
    if(i<img.length){
        i++;
    }
    else{
        i=0;
    }

    setTimeout('changeImg()',time);
}
//end function for image change description




//start slider product
let currentIndex = 0;
const slidesToShow = 3; // Number of slides to show at a time

function showSlide(index) {
    const slides = document.querySelector('.slides');
    const totalSlides = document.querySelectorAll('.slide').length;
    const maxIndex = 3;

    if (index > maxIndex) {
        currentIndex = 0;
    } else if (index < 0) {
        currentIndex = maxIndex;
    } else {
        currentIndex = index;
    }

    slides.style.transform = `translateX(-${currentIndex * 100 / slidesToShow}%)`;
}

function nextSlide() {
    showSlide(currentIndex + 1);
}

function prevSlide() {
    showSlide(currentIndex - 1);
}

// Initial call to display the first slide
showSlide(currentIndex);

// end slider product