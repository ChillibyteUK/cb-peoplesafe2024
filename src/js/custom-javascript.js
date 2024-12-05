// new WOW().init();

AOS.init({
    duration: 600,
    easing: "ease-in-out",
    once: true,
});

document.addEventListener('DOMContentLoaded', function() {


    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aos-animate');
            } else {
                entry.target.classList.remove('aos-animate');
            }
        });
    }, {
        rootMargin: '0px 0px -150px 0px' // Adjusts the threshold to trigger 100px before the bottom of the element
    });
    
    document.querySelectorAll('.aos-init').forEach((el) => {
        observer.observe(el);
    });

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


    // Select all section elements
    const sections = document.querySelectorAll('section');

    // Iterate through each section
    sections.forEach(section => {
        // Select pill and content elements within the section
        const pills = section.querySelectorAll('.pill');
        const contents = section.querySelectorAll('.content');

        // Add click event listener to each pill
        pills.forEach(pill => {
            pill.addEventListener('click', function() {
                // Remove 'active' class from all pills in the section
                pills.forEach(p => p.classList.remove('active'));
                // Add 'active' class to the clicked pill
                pill.classList.add('active');

                // Get the id of the content to show
                const contentId = pill.getAttribute('aria-controls');

                // Hide all content elements in the section
                contents.forEach(content => content.classList.remove('active'));

                // Show the related content element in the section
                section.querySelector(`#${contentId}`).classList.add('active');
            });
        });
    });

});