(() => {
    const card = document.querySelector('.draggable-card');
    if (!card) return;
    const formLike = document.getElementById("form-like");
    const formDislike = document.getElementById("form-dislike");
    const btnExpand = document.getElementById("btn-expand");
    const overview = document.getElementById("movie-overview");
    let startX = 0, currentX = 0, dragging = false;
    const threshold = 120;
    const ANIMATION_DURATION = 950;
    if (btnExpand && overview) {
        btnExpand.addEventListener("pointerdown", (e) => e.stopPropagation());
        btnExpand.addEventListener("click", (e) => {
            e.stopPropagation();
            const isExpanded = overview.classList.contains('line-clamp-none');
            if (isExpanded) {
                overview.classList.replace('line-clamp-none', 'line-clamp-3');
                btnExpand.textContent = "Ler mais";
            } else {
                overview.classList.replace('line-clamp-3', 'line-clamp-none');
                btnExpand.textContent = "Ler Menos";
            }
        });
    }

    function setTransform(x, y, rot) {
        card.style.transform = `translate(${x}px, ${y}px) rotate(${rot}deg)`;
    }

    card.addEventListener("pointerdown", e => {
        if (e.target.id === 'btn-expand') return;
        dragging = true;
        startX = e.clientX;
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
        if (!dragging) return;
        dragging = false;
        card.classList.remove("swiping");
        card.style.transition = `transform ${ANIMATION_DURATION}ms cubic-bezier(0.165, 0.84, 0.44, 1)`;

        if (Math.abs(currentX) > threshold) {
            card.style.pointerEvents = 'none';
            if (currentX > 0) {
                card.style.transform = "translate(1000px, 0) rotate(35deg)";
                setTimeout(() => formLike.submit(), ANIMATION_DURATION);
            } else {
                card.style.transform = "translate(-1000px, 0) rotate(-35deg)";
                setTimeout(() => formDislike.submit(), ANIMATION_DURATION);
            }
        } else {
            card.style.transform = "";
            card.classList.remove("show-like", "show-nope");
        }
    });

    document.getElementById("btn-like")?.addEventListener("click", () => {
        card.style.pointerEvents = 'none';
        card.style.transition = `transform ${ANIMATION_DURATION}ms cubic-bezier(0.165, 0.84, 0.44, 1)`;
        card.style.transform = "translate(1000px, 0) rotate(35deg)";
        setTimeout(() => formLike.submit(), ANIMATION_DURATION);
    });

    document.getElementById("btn-nope")?.addEventListener("click", () => {
        card.style.pointerEvents = 'none';
        card.style.transition = `transform ${ANIMATION_DURATION}ms cubic-bezier(0.165, 0.84, 0.44, 1)`;
        card.style.transform = "translate(-1000px, 0) rotate(-35deg)";
        setTimeout(() => formDislike.submit(), ANIMATION_DURATION);
    });
})();