document.getElementById('menuButton').addEventListener('click', function() {
    var menuDropdown = document.getElementById('menuDropdown');
    var menuIcon = document.getElementById('menuIcon');
    if (menuDropdown.classList.contains('hidden')) {
      menuDropdown.classList.remove('hidden');
      menuIcon.classList.remove('fa-bars');
      menuIcon.classList.add('fa-times');
    } else {
      menuDropdown.classList.add('hidden');
      menuIcon.classList.remove('fa-times');
      menuIcon.classList.add('fa-bars');
    }
  });