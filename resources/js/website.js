import './components/Search/Main';
import './contact/Main';
import './home/partners-slider/Main';
import './photo-gallery/Main';

document.querySelector('#apae-link').addEventListener('click', function () {
  document
    .querySelector("li[data-dropdown='apae-link']")
    .classList.toggle('hidden');
});

document.querySelector('#lgpd-link').addEventListener('click', function () {
  document
    .querySelector("li[data-dropdown='lgpd-link']")
    .classList.toggle('hidden');
});

for (let toggleSidebar of document.querySelectorAll('.toggle-sidebar')) {
  toggleSidebar.addEventListener('click', function () {
    document
      .querySelector('div[data-sidebar="sidebar"')
      .classList.toggle('hidden-sidebar');
  });
}

if (document.querySelector('div[data-sidebar="sidebar"')) {
  document
    .querySelector('div[data-sidebar="sidebar"')
    .addEventListener('click', function (event) {
      console.log(event.target);
    });
}

for (let toggleSidebar of document.querySelectorAll('.toggle-donatenow')) {
  toggleSidebar.addEventListener('click', function () {
    document
      .querySelector('div[data-card-donate="donatenow"')
      .classList.toggle('hidden');
  });
}

for (let item of document.querySelectorAll('.input-search-website')) {
  item.addEventListener('focus', function () {
    document
      .querySelector('.search-website-container')
      .classList.toggle('search-website-hidden');
  });
}

if (document.querySelector('.search-website'))
  document
    .querySelector('.search-website')
    .addEventListener('blur', function () {
      document
        .querySelector('.search-website-container')
        .classList.toggle('search-website-hidden');
    });

if (document.querySelector('.search-website-close'))
  document
    .querySelector('.search-website-close')
    .addEventListener('click', function () {
      document
        .querySelector('.search-website-container')
        .classList.toggle('search-website-hidden');
    });

document.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.key == 'k') {
    event.preventDefault();
    document
      .querySelector('.search-website-container')
      .classList.toggle('search-website-hidden');
  }

  if (event.key === 'Escape') {
    event.preventDefault();
    const searchWebsiteContainer = document.querySelector(
      '.search-website-container'
    );
    !searchWebsiteContainer.classList.contains('search-website-hidden') &&
      searchWebsiteContainer.classList.add('search-website-hidden');
  }
});

document
  .querySelector('#search-website-main')
  .addEventListener('click', function (event) {
    event.target.id === 'search-website-main' &&
      event.target.classList.add('search-website-hidden');
  });
