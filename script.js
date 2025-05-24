document.querySelectorAll("a[href*='deleteEmployee']").forEach(link => {
    link.addEventListener("click", function(event) {
        if (!confirm("Êtes-vous sûr de vouloir supprimer cet employé ?")) {
            event.preventDefault();
        }
    });
});
