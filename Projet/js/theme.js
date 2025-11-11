const savedTheme = localStorage.getItem('theme');

const toggleBtn = document.getElementById('theme-toggle');

document.body.classList.add(savedTheme);

function updateIcon() {
  if (!toggleBtn) return;
  toggleBtn.textContent = document.body.classList.contains('dark') ? '☀️' : '🌙';
}

updateIcon();

if (toggleBtn) {
  toggleBtn.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    document.body.classList.toggle('light');

    const currentTheme = document.body.classList.contains('dark') ? 'dark' : 'light';
    localStorage.setItem('theme', currentTheme);
    updateIcon();
  });
}