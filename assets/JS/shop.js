const google = document.getElementById(`googleMaps`);
google.addEventListener(`load`, () => {
  google.classList.add("rotate");
});

/*----------------------------------
------------slide photos------------
----------------------------------*/

const slider = document.querySelector(".slider");
const sliderSlide = Array.from(slider.children);
const slideWidth = sliderSlide[0].getBoundingClientRect().width;

let currentIndex = 0;

function moveToSlide(index) {
  slider.style.transform = `translateX(-${index * slideWidth}px)`;
  currentIndex = index;
}

function autoSlide() {
  const nextIndex = (currentIndex + 1) % sliderSlide.length;
  moveToSlide(nextIndex);
}

// Auto-slide every 3 seconds
setInterval(autoSlide, 2000);
