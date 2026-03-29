function tbsCopy(text, btn) {
    navigator.clipboard.writeText(text).then(function() {
        var orig = btn.textContent;
        btn.textContent = '✅ Copied!';
        btn.style.background = '#059669';
        setTimeout(function() {
            btn.textContent = orig;
            btn.style.background = '';
        }, 2000);
    });
}
