document.addEventListener("DOMContentLoaded", function () {
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({ behavior: "smooth" });
        } else {
            console.error(`Секция с ID "${sectionId}" не найдена!`);
        }
    }

    document.getElementById("scrollToContact").addEventListener("click", function () {
        scrollToSection("contact-section");
    });

    document.getElementById("scrollToCategories").addEventListener("click", function () {
        scrollToSection("categories");
    });
});


