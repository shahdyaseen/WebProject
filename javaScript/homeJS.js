
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
// var i=0;
// var time =1000;
// const img = [];
// img[0]='/products/p1home.JPG';
// img[1]='/products/mod1blur.jpg';
//
// let element = document.getElementById('description');
//
// function changeImg(){
//     element.style.backgroundImage='url('+ img[i]+')';
//     if(i<img.length){
//         i++;
//     }
//     else{
//         i=0;
//     }
//
//     setTimeout('changeImg()',time);
// }
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


//flash img at home page


var img1 = document.getElementById('img1');
var img2 = document.getElementById('img2');
var img3 = document.getElementById('img3');
var img4 = document.getElementById('img4');
var flag = 1;

function change() {
    if (flag === 1) {
        img1.style.display ='block';
        img2.style.display = 'none';
        img3.style.display = 'none';
        img4.style.display = 'none';
        flag = 2;
    }

    else if(flag===2) {
        img1.style.display ='none';
        img2.style.display = 'block';
        img3.style.display = 'none';
        img4.style.display = 'none';
        flag = 3;
    }
    else if (flag===3){
        img1.style.display ='none';
        img2.style.display = 'none';
        img3.style.display = 'block';
        img4.style.display = 'none';
        flag=4
    }
    else if(flag===4){
        img1.style.display ='none';
        img2.style.display = 'none';
        img3.style.display = 'none';
        img4.style.display = 'block';
        flag=1;
    }

}

window.onload = function() {
    img1.style.display = 'block'; // Show the first image on load
    setInterval(change, 3000); // Change image every 3 seconds
};
//end flash img