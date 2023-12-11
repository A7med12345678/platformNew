function test() {
    var tabsNewAnim = document.getElementById('navbarSupportedContent');
    var selectorNewAnim = tabsNewAnim.querySelectorAll('li').length;
    var activeItemNewAnim = tabsNewAnim.querySelector('.active');
    var activeWidthNewAnimHeight = activeItemNewAnim.offsetHeight;
    var activeWidthNewAnimWidth = activeItemNewAnim.offsetWidth;
    var itemPosNewAnimTop = activeItemNewAnim.offsetTop;
    var itemPosNewAnimLeft = activeItemNewAnim.offsetLeft;
    var horiSelector = document.querySelector(".hori-selector");

    horiSelector.style.top = itemPosNewAnimTop + "px";
    horiSelector.style.left = itemPosNewAnimLeft + "px";
    horiSelector.style.height = activeWidthNewAnimHeight + "px";
    horiSelector.style.width = activeWidthNewAnimWidth + "px";

    tabsNewAnim.addEventListener("click", function (e) {
        var target = e.target.closest('li');
        if (!target) return;

        var links = tabsNewAnim.querySelectorAll('li');
        links.forEach(function (link) {
            link.classList.remove("active");
        });

        target.classList.add('active');
        var activeWidthNewAnimHeight = target.offsetHeight;
        var activeWidthNewAnimWidth = target.offsetWidth;
        var itemPosNewAnimTop = target.offsetTop;
        var itemPosNewAnimLeft = target.offsetLeft;

        horiSelector.style.top = itemPosNewAnimTop + "px";
        horiSelector.style.left = itemPosNewAnimLeft + "px";
        horiSelector.style.height = activeWidthNewAnimHeight + "px";
        horiSelector.style.width = activeWidthNewAnimWidth + "px";

        // Collapse the navbar after clicking a link on mobile
        if (window.innerWidth < 768) {
            var navbarCollapse = document.querySelector(".navbar-collapse");
            navbarCollapse.classList.remove("show");
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        test();
    });
});

window.addEventListener('resize', function () {
    setTimeout(function () {
        test();
    }, 500);
});

