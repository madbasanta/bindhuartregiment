
// Fetch HTML elements
const leftArrow = document.querySelector('.arrow--left');
const rightArrow = document.querySelector('.arrow--right');
const carousel = document.querySelector('.container');

let leftCard = document.querySelector('.card--left');
let middleCard = document.querySelector('.card--middle');
let rightCard = document.querySelector('.card--right');

// Add event listener to left arrow
leftArrow.addEventListener('click', e => {
  goRight();
});

// Add event listener for right arrow
rightArrow.addEventListener('click', e => {
  goLeft();
});

// Add event listener for arrow keys
document.addEventListener('keydown', e => {
  const key = e.key;
  if (key == 'ArrowRight') {
    goLeft()
  } else if (key == 'ArrowLeft') {
    goRight();
  }
})

function goLeft() {
  // Deactivate arrow
  deactivateButtons();
  
  // Change z-index order of cards
  leftCard.style.zIndex = "0";
  middleCard.style.zIndex = "1";
  rightCard.style.zIndex = "2";
  
  // Change position of cards
  leftCard.classList.remove('card--left');
  leftCard.classList.add('card--right');
  
  middleCard.classList.remove('card--middle');
  middleCard.classList.add('card--left');
  
  rightCard.classList.remove('card--right');
  rightCard.classList.add('card--middle');
  
  // Update variables to contain right card
  let tmp = rightCard;
  rightCard = leftCard;
  leftCard = middleCard;
  middleCard = tmp;
  
  // Reactivate arrow
  setTimeout(() => {
    activateButtons();
  }, 500);
}

function goRight() {
  // Deactivate arrow
  deactivateButtons();
  
  // Change z-index order of cards
  leftCard.style.zIndex = "2";
  middleCard.style.zIndex = "1";
  rightCard.style.zIndex = "0";
  
  // Change position of cards
  leftCard.classList.remove('card--left');
  leftCard.classList.add('card--middle');
  
  middleCard.classList.remove('card--middle');
  middleCard.classList.add('card--right');
  
  rightCard.classList.remove('card--right');
  rightCard.classList.add('card--left');
  
  // Update variables to contain right card
  let tmp = leftCard;
  leftCard = rightCard;
  rightCard = middleCard;
  middleCard = tmp;
  
  // Reactivate arrow
  setTimeout(() => {
    activateButtons();
  }, 500);
}

// Disable button. When disabled the button
// will have a lower opacity.
// @param button, button to be disabled
function deactivateButtons() {
  leftArrow.disabled = true;
  leftArrow.style.opacity = ".6";
  rightArrow.disabled = true;
  rightArrow.style.opacity = ".6";
}

// Activate button. When active the button
// will have a opacity of 100%
//@param button, button to be activated
function activateButtons() {
  leftArrow.disabled = false;
  leftArrow.style.opacity = "1";
  rightArrow.disabled = false;
  rightArrow.style.opacity = "1";
}