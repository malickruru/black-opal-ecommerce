const toggleBtn = document.getElementById("toggle-sidebar");
const toggleBtn2 = document.getElementById("toggle-sidebar2");
const toggleBtn3 = document.getElementById("toggle-sidebar3");
const sidebar = document.querySelector(".sidebar");

toggleBtn.addEventListener("click", function() {
  sidebar.classList.toggle("open");
  toggleBtn.classList.toggle("open");
});


toggleBtn2.addEventListener("click", function() {
  sidebar.classList.toggle("open");
  // toggleBtn.classList.toggle("open");
});

toggleBtn3.addEventListener("click", function() {
  sidebar.classList.toggle("open");
  // toggleBtn.classList.toggle("open");
});







