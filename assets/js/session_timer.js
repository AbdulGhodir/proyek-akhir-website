let timer;
const batasWaktu = 3600000;

function resetTimer() {
    clearTimeout(timer);
    timer = setTimeout(() => {
        alert("Session Anda telah berakhir, silahkan login kembali");
        window.location.href = BASEURL + "/app/controllers/auth/logout.php";
    }, batasWaktu);
}

["mousemove", "keydown", "click", "scroll", "touchstart"].forEach((event) => {
    document.addEventListener(event, resetTimer);
});

resetTimer();