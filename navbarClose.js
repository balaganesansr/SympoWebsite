document.addEventListener('DOMContentLoaded', function() {
    // Check for the existence of the dynamically generated menu
    const observer = new MutationObserver(function(mutationsList) {
      for (let mutation of mutationsList) {
        if (mutation.type === 'childList') {
          // The menu has been dynamically added, attach click listeners to close the menu
          const menuItems = document.querySelectorAll('.slicknav_nav li a');
          menuItems.forEach(item => {
            item.addEventListener('click', function() {
              // Close the menu when any menu item is clicked
              const menuButton = document.querySelector('.slicknav_btn');
              const menu = document.querySelector('.slicknav_nav');
              
              menu.style.display = 'none'; // Hide the menu
              menu.setAttribute('aria-hidden', 'true');
              menuButton.classList.remove('slicknav_open');
              menuButton.classList.add('slicknav_close');
            });
          });
        }
      }
    });

    // Observe the parent element where the menu gets added dynamically
    const mobileMenuContainer = document.querySelector('.mobile_menu');
    if (mobileMenuContainer) {
      observer.observe(mobileMenuContainer, { childList: true, subtree: true });
    }
  });