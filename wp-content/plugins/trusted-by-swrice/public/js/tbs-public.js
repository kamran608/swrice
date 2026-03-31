(function () {
    document.addEventListener('DOMContentLoaded', function () {
        var els = document.querySelectorAll('.tbs-page .tbs-fade');
        if (!els.length) return;
        var obs = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) {
                    e.target.classList.add('tbs-visible');
                    obs.unobserve(e.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
        els.forEach(function (el) { obs.observe(el); });
    });
})();
