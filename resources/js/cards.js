(() => {
    const card = document.querySelector('.draggable-card');
    if (!card) return;

    const formLike = document.getElementById("form-like");
    const formDislike = document.getElementById("form-dislike");

    let startX = 0, currentX = 0, dragging = false;

    const threshold = 120; // distƒncia para aceitar swipe

    function setTransform(x, y, rot) {
        card.style.transform = `translate(${x}px, ${y}px) rotate(${rot}deg)`;
    }

    card.addEventListener("pointerdown", e => {
    dragging = true;
    startX = e.clientX;

    // ? ADICIONA A CLASSE
    card.classList.add("swiping");

    card.setPointerCapture(e.pointerId);
    card.style.transition = "none";
});

card.addEventListener("pointermove", e => {
    if (!dragging) return;

    currentX = e.clientX - startX;
    const rot = currentX / 12;

    setTransform(currentX, 0, rot);

    if (currentX > 30) {
        card.classList.add("show-like");
        card.classList.remove("show-nope");
    } else if (currentX < -30) {
        card.classList.add("show-nope");
        card.classList.remove("show-like");
    } else {
        card.classList.remove("show-like", "show-nope");
    }
});

card.addEventListener("pointerup", () => {
    dragging = false;

    // ? REMOVE A CLASSE QUANDO SOLTAR
    card.classList.remove("swiping");

    card.style.transition = "";

    if (Math.abs(currentX) > threshold) {

        if (currentX > 0) {
            // LIKE
            card.style.transform = "translate(900px, 0) rotate(25deg)";
            setTimeout(() => formLike.submit(), 250);
        } else {
            // DISLIKE
            card.style.transform = "translate(-900px, 0) rotate(-25deg)";
            setTimeout(() => formDislike.submit(), 250);
        }

    } else {
        card.style.transform = "";
        card.classList.remove("show-like", "show-nope");
    }
});


    // Botäes
    document.getElementById("btn-like")?.addEventListener("click", () => {
        card.style.transform = "translate(900px, 0) rotate(25deg)";
        setTimeout(() => formLike.submit(), 250);
    });

    document.getElementById("btn-nope")?.addEventListener("click", () => {
        card.style.transform = "translate(-900px, 0) rotate(-25deg)";
        setTimeout(() => formDislike.submit(), 250);
    });

})();
