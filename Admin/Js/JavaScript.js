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
  const margin = 20;
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
function openDrawer() {
  document.getElementById("myDrawer").style.width = "250px";
}

function closeDrawer() {
  document.getElementById("myDrawer").style.width = "0";
}

function toggleDrawer() {
  var drawer = document.getElementById("myDrawer");
  drawer.classList.toggle("open");
}



/**////////// */
