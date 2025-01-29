document.addEventListener("DOMContentLoaded", function () {
  const images = document.querySelectorAll(".image-container img");
  const textContainers = document.querySelectorAll(".text");
  const buttons = document.querySelectorAll(".redirect-button");
  const prevBtn = document.querySelector(".prev");
  const nextBtn = document.querySelector(".next");

  let currentIndex = 0;
  let autoSlideInterval;

  function showImage(index) {
    images.forEach((img, i) => {
      img.style.display = i === index ? "block" : "none";
    });

    textContainers.forEach((text, i) => {
      text.style.display = i === index ? "block" : "none";
    });

    buttons.forEach((button, i) => {
      button.style.display = i === index ? "block" : "none";
    });
  }

  function showNextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
  }

  function showPrevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    showImage(currentIndex);
  }

  function startAutoSlide() {
    autoSlideInterval = setInterval(showNextImage, 4000); // Change slide every 4 seconds (adjust as needed)
  }

  function stopAutoSlide() {
    clearInterval(autoSlideInterval);
  }

  // Initial display and start auto slide
  showImage(currentIndex);
  startAutoSlide();

  // Event listeners for navigation buttons
  nextBtn.addEventListener("click", function () {
    stopAutoSlide();
    showNextImage();
    startAutoSlide();
  });

  prevBtn.addEventListener("click", function () {
    stopAutoSlide();
    showPrevImage();
    startAutoSlide();
  });
});
