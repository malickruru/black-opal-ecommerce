const toggleBtn = document.getElementById("toggle-sidebar");
const sidebar = document.querySelector(".sidebar");

toggleBtn.addEventListener("click", function() {
  sidebar.classList.toggle("open");
  toggleBtn.classList.toggle("open");
});
