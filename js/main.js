const navItems = document.querySelector('.nav__items');
const openNavBtn = document.querySelector('#open__nav-btn');
const closeNavBtn = document.querySelector('#close__nav-btn');

// opens nav dropdown
const openNav = () => {
  
    navItems.style.display = 'inline-block';
    openNavBtn.style.display = 'none';
    
    document.addEventListener('click', function handleClickOutsideBox(event) {
   
        if (!openNavBtn.contains(event.target)) {
            navItems.style.display = 'none';
            openNavBtn.style.display = 'inline-block';
        }
      });
}


openNavBtn.addEventListener('click', openNav);





