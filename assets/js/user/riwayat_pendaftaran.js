let activeStatus = "semua";

function filterRiwayat(status) {
  activeStatus = status;

  const pills = document.querySelectorAll(".filter-pill");

  pills.forEach((btn) => {
    btn.classList.remove("active");

    if (
      btn.innerText.toLowerCase() === status ||
      (status === "semua" && btn.innerText.toLowerCase() === "semua")
    ) {
      btn.classList.add("active");
    }
  });

  searchEvent();
}

function searchEvent() {
  const cards = document.querySelectorAll(".history-card");
  const searchInput = document.getElementById("searchInput");
  const emptyMessage = document.getElementById("emptyHistoryMessage");

  const keyword = searchInput ? searchInput.value.toLowerCase().trim() : "";
  let visibleCount = 0;

  cards.forEach((card) => {
    const statusCard = card.getAttribute("data-status").toLowerCase();
    const searchData = card.getAttribute("data-search").toLowerCase();

    const cocokStatus = activeStatus === "semua" || statusCard === activeStatus;
    const cocokSearch = keyword === "" || searchData.includes(keyword);

    if (cocokStatus && cocokSearch) {
      card.style.display = "";
      visibleCount++;
    } else {
      card.style.display = "none";
    }
  });

  if (emptyMessage) {
    emptyMessage.style.display = visibleCount === 0 ? "block" : "none";
  }
}
