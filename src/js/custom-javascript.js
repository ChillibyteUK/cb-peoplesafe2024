// new WOW().init();

document.addEventListener('DOMContentLoaded', function() {
  const toggles = document.querySelectorAll('.toggle');
  const burgerMenu = document.getElementById('burger-menu');
  const navItems = document.getElementById('navItems');
  const navMenus = document.getElementById('navMenus');
  const navbar = document.querySelector('nav');
  const header = document.querySelector('header');
  const navbarExtras = document.querySelector('.navbar__extras');

  // Function to toggle burger menu
  if (burgerMenu && navItems && navMenus) {
      burgerMenu.addEventListener('click', function() {
          navbar.classList.toggle('active');
          navItems.classList.toggle('active');
          navMenus.classList.toggle('active');
          navbarExtras.classList.toggle('active');
          burgerMenu.classList.toggle('open');
      });
  } else {
      console.error('Burger menu, navItems, or navMenus not found');
  }

  // Function to reset the dropdown menu
  function resetDropdownMenu(dropdown) {
      const firstItem = dropdown.querySelector('.left > li');
      if (firstItem) {
          firstItem.classList.add('active');
          const siblingItems = firstItem.parentElement.children;
          for (const sibling of siblingItems) {
              if (sibling !== firstItem) {
                  sibling.classList.remove('active');
              }
          }

          const firstContentId = firstItem.getAttribute('aria-controls');
          const allContents = dropdown.querySelectorAll('.right');
          allContents.forEach(content => content.classList.remove('active'));

          if (firstContentId) {
              const firstContent = document.getElementById(firstContentId);
              if (firstContent) {
                  firstContent.classList.add('active');
                  const siblingContents = firstContent.parentElement.children;
                  for (const sibling of siblingContents) {
                      if (sibling !== firstContent) {
                          sibling.classList.remove('active');
                      }
                  }
              }
          }
      }
  }

  // Function to disable links on larger screens and enable on smaller screens
  function handleToggleLinks() {
      const screenWidth = window.innerWidth;
      toggles.forEach(toggle => {
          if (screenWidth >= 1200) {
              toggle.addEventListener('click', handleToggleClick);
              toggle.setAttribute('href', 'javascript:void(0);');
          } else {
              toggle.removeEventListener('click', handleToggleClick);
              const originalHref = toggle.getAttribute('data-href');
              toggle.setAttribute('href', originalHref);
          }
      });
  }

  // Click event handler for toggles
  function handleToggleClick(event) {
      event.preventDefault();
      event.stopPropagation();

      const dropdownId = event.currentTarget.getAttribute('aria-controls');
      const dropdownMenu = document.getElementById(dropdownId);

      const isActive = dropdownMenu.classList.contains('active');

      const allDropdowns = document.querySelectorAll('.dropdownMenu');
      const allToggles = document.querySelectorAll('.toggle');
      allDropdowns.forEach(dropdown => dropdown.classList.remove('active'));
      allToggles.forEach(t => t.classList.remove('active'));

      if (!isActive) {
          event.currentTarget.classList.add('active');
          dropdownMenu.classList.add('active');
      } else {
          resetDropdownMenu(dropdownMenu);
      }
  }

  // Function to add .scrolled class when page is scrolled more than 100px
  function handleScroll() {
      if (window.scrollY > 100) {
          header.classList.add('scrolled');
      } else {
          header.classList.remove('scrolled');
      }
  }

  // Initial setup
  handleToggleLinks();

  // Update links on window resize
  window.addEventListener('resize', handleToggleLinks);

  // Add scroll event listener
  window.addEventListener('scroll', handleScroll);

  // Add click event listener to the document
  document.addEventListener('click', function(event) {
      const activeDropdown = document.querySelector('.dropdownMenu.active');
      if (activeDropdown && !activeDropdown.contains(event.target)) {
          const activeToggle = document.querySelector('.toggle.active');
          if (activeToggle) {
              activeToggle.classList.remove('active');
          }
          activeDropdown.classList.remove('active');
          resetDropdownMenu(activeDropdown);
      }
  });

  // Function to handle left item clicks in a given dropdown
  function handleLeftItemClicks(dropdownId) {
      const leftItems = document.querySelectorAll(`#${dropdownId} .left > li`);
      leftItems.forEach(item => {
          item.addEventListener('click', function() {
              leftItems.forEach(li => li.classList.remove('active'));
              item.classList.add('active');

              const contentId = item.getAttribute('aria-controls');
              const rightContents = document.querySelectorAll(`#${dropdownId} .right`);
              rightContents.forEach(content => content.classList.remove('active'));
              document.getElementById(contentId).classList.add('active');
          });
      });
  }

  // Handle left item clicks for each dropdown
  handleLeftItemClicks('dropdownSolutions');
  handleLeftItemClicks('dropdownProducts');
});


/*
//SEARCH

(function (window, $) {
  var search = $('#search');
  search.on('focusin', function () {
      search.addClass('hover');
      // $('#search-s').focus();
  });
  search.on('focusout', function () {
      search.removeClass('hover');
  });
})(window, jQuery);

(function(){

  var doc = document.documentElement;
  var w = window;

  var prevScroll = w.scrollY || doc.scrollTop;
  var curScroll;
  var direction = 0;
  var prevDirection = 0;

  var header = document.getElementById('header');

  var checkScroll = function() {

    // Find the direction of scroll
    // 0 - initial, 1 - up, 2 - down

    curScroll = w.scrollY || doc.scrollTop;
    if (curScroll > prevScroll) { 
      //scrolled up
      direction = 2;
    }
    else if (curScroll < prevScroll) { 
      //scrolled down
      direction = 1;
    }

    if (direction !== prevDirection) {
      toggleHeader(direction, curScroll);
    }

    prevScroll = curScroll;
  };

  var toggleHeader = function(direction, curScroll) {
    if (direction === 2 && curScroll > 52) { 

      //replace 52 with the height of your header in px

      header.classList.add('hide');
      prevDirection = direction;
    }
    else if (direction === 1) {
      header.classList.remove('hide');
      prevDirection = direction;
    }
  };

  window.addEventListener('scroll', checkScroll);

})();
*/