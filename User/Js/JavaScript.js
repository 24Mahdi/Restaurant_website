document.querySelector('.style02').addEventListener('click', function (e) {
  e.preventDefault();

  if (e.target.tagName === 'A' && e.target.getAttribute('href').startsWith('#')) {
    const id = e.target.getAttribute('href');
    document.querySelector(id).scrollIntoView({ behavior: 'smooth' });
  }
});

const btnsOpenModal = document.querySelectorAll('.btn--show-modal');
const section4 = document.querySelector('#section--4');

btnsOpenModal.forEach(btn => {
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    section4.scrollIntoView({ behavior: 'smooth' });
  });
});

////////////////////////////const slider = document.let currentIndex = 0;

let currentIndex = 0;

document.querySelector('.next').addEventListener('click', () => {
  const products = document.querySelector('.products');
  const totalProducts = document.querySelectorAll('.product').length;
  const visibleProducts = getVisibleProductsCount();

  if (currentIndex < totalProducts - visibleProducts) {
    currentIndex++;
    updateProductPosition();
  }
});

document.querySelector('.prev').addEventListener('click', () => {
  if (currentIndex > 0) {
    currentIndex--;
    updateProductPosition();
  }
});

function getVisibleProductsCount() {
  if (window.innerWidth >= 1024) {
    return 4;
  } else if (window.innerWidth >= 768) {
    return 2;
  } else {
    return 1;
  }
}

function updateProductPosition() {
  const products = document.querySelector('.products');
  const productWidth = document.querySelector('.product').offsetWidth;
  const margin = 20; // Adjust margin
  products.style.transform = `translateX(-${currentIndex * (productWidth + margin)}px)`;
}

window.addEventListener('resize', updateProductPosition);
////////////////

const tabs1 = document.querySelectorAll('.operations__tab');
const tabContents = document.querySelectorAll('.operations__content');

tabs1.forEach(tab => {
  tab.addEventListener('click', function () {
    tabs1.forEach(t => t.classList.remove('operations__tab--active'));
    this.classList.add('operations__tab--active');

    tabContents.forEach(content => content.classList.remove('operations__content--active'));
    const tabNumber = this.getAttribute('data-tab');
    const tabContent = document.querySelector(`.operations__content--${tabNumber}`);

    tabContent.classList.add('operations__content--active');
  });
});

/*/////////////////////////*/
// JavaScript for Drawer Menu */
function openDrawer() {
  document.getElementById("myDrawer").style.width = "250px"; /* فتح القائمة بعرض 250px */
}

function closeDrawer() {
  document.getElementById("myDrawer").style.width = "0"; /* إغلاق القائمة بعرض 0 */
}

function toggleDrawer() {
  var drawer = document.getElementById("myDrawer");
  drawer.classList.toggle("open"); // تبديل الفئة open لفتح وإغلاق القائمة
}


/****/


document.addEventListener('DOMContentLoaded', function () {
  const modal = document.querySelector('.modal');
  const overlay = document.querySelector('.overlay');
  const btnCloseModal = document.querySelector('.close-modal');
  const btnsOpenModal = document.querySelectorAll('.show-modal');

  const openModal = function () {
    modal.classList.remove('hidden');
    overlay.classList.remove('hidden');
  };

  const closeModal = function () {
    modal.classList.add('hidden');
    overlay.classList.add('hidden');
  };

  for (let i = 0; i < btnsOpenModal.length; i++) {
    if (btnsOpenModal[i]) {
      btnsOpenModal[i].addEventListener('click', openModal);
    }
  }

  if (btnCloseModal) {
    btnCloseModal.addEventListener('click', closeModal);
  }

  if (overlay) {
    overlay.addEventListener('click', closeModal);
  }

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      closeModal();
    }
  });

  const calorieForm = document.getElementById('calorie-form');
  const resultDisplay = document.getElementById('calorie-needs');
  const resultContainer = document.getElementById('calorie-result');

  if (calorieForm) {
    calorieForm.addEventListener('submit', function (e) {
      e.preventDefault();

      const age = parseInt(document.getElementById('age').value);
      const weight = parseInt(document.getElementById('weight').value);
      const height = parseInt(document.getElementById('height').value);
      const gender = document.getElementById('gender').value;
      const activityLevel = document.getElementById('activity-level').value;

      let bmr;

      if (gender === 'male') {
        bmr = 88.362 + (13.397 * weight) + (4.799 * height) - (5.677 * age);
      } else {
        bmr = 447.593 + (9.247 * weight) + (3.098 * height) - (4.330 * age);
      }

      let calories;
      switch (activityLevel) {
        case 'sedentary':
          calories = bmr * 1.2;
          break;
        case 'lightly-active':
          calories = bmr * 1.375;
          break;
        case 'moderately-active':
          calories = bmr * 1.55;
          break;
        case 'very-active':
          calories = bmr * 1.725;
          break;
        case 'extra-active':
          calories = bmr * 1.9;
          break;
      }

      resultDisplay.textContent = `You need ${calories.toFixed(2)} calories per day.`;
      resultContainer.style.display = 'block';
    });
  }
});
const allSections = document.querySelectorAll('.section--afect');

const revealSection = function (entries, observer) {
  const [entry] = entries;

  if (!entry.isIntersecting) return;

  entry.target.classList.remove('section--hidden');
  observer.unobserve(entry.target);
};

const sectionObserver = new IntersectionObserver(revealSection, {
  root: null,
  threshold: 0.15,
});

allSections.forEach(function (section) {
  sectionObserver.observe(section);
  section.classList.add('section--hidden');
});
