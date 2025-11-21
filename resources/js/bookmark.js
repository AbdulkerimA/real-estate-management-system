const bookMarks = document.querySelectorAll('.bookMark');

bookMarks.forEach((bookMarkEl) => {
    let bookMarked = bookMarkEl.dataset.bookmarked == "1";
    const propertyId = bookMarkEl.dataset.id;

    bookMarkEl.addEventListener('click', () => {
        fetch(`/bookmark/${propertyId}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(async res => {

            // AUTO REDIRECT TO LOGIN IF NOT LOGGED IN
            if (res.redirected) {
                window.location = res.url;
                return;
            }

            // PARSE JSON SAFELY (graceful fallback)
            try {
                return await res.json();
            } catch (err) {
                console.error("Server error", err);
                return null;
            }
        })
        .then(data => {
            if (!data) return;

            // Update icon
            bookMarked = data.bookmarked;

            bookMarkEl.innerHTML = bookMarked
                ? '<i class="fas fa-bookmark"></i>'
                : '<i class="far fa-bookmark"></i>';
        })
        .catch(err => console.error(err));
    });
});
