nav = document.querySelector("nav");
btt = document.querySelector("#btt");
const scrollSnap = 90;
document.addEventListener("scroll", (e) => {
  if (
    document.body.scrollTop > scrollSnap ||
    document.documentElement.scrollTop > scrollSnap
  ) {
    nav.classList.add("scrollednav");
    btt.style.display = "block";
    console.log(btt);
  } else {
    nav.classList.remove("scrollednav");
    btt.style.display = "none";
  }
});

function backToTop() {
  document.body.scrollTo({ top: 0, behavior: "smooth" });
}
